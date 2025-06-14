<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Products;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemAddons;
use App\Models\Transaction;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use URL;
use DB;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function user_login(Request $request)
    {

        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        if (
            SystemAddons::where('unique_identifier', 'customer_login')->first() != null &&
            SystemAddons::where('unique_identifier', 'customer_login')->first()->activated == 1
        ) {
            if (helper::appdata($vdata)->checkout_login_required == 1) {
                return view('web.auth.login', compact('vendordata'));
            } else {
                abort(404);
            }
        }
    }

    public function user_register(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        if (
            SystemAddons::where('unique_identifier', 'customer_login')->first() != null &&
            SystemAddons::where('unique_identifier', 'customer_login')->first()->activated == 1
        ) {
            if (helper::appdata($vdata)->checkout_login_required == 1) {
                return view('web.auth.register', compact('vendordata'));
            } else {
                abort(404);
            }
        }
    }
    public function userforgotpassword(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }
        if (empty($vendordata)) {
            abort(404);
        }
        if (
            SystemAddons::where('unique_identifier', 'customer_login')->first() != null &&
            SystemAddons::where('unique_identifier', 'customer_login')->first()->activated == 1
        ) {
            if (helper::appdata($vdata)->checkout_login_required == 1) {
                return view('web.auth.forgotpassword', compact('vendordata'));
            } else {
                abort(404);
            }
        }
    }
    public function register_customer(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where('vendor_id', $vdata)->where('is_deleted', 2)->where('type', 3),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->where('vendor_id', $vdata)->where('is_deleted', 2)->where('type', 3),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }
        if (
            SystemAddons::where('unique_identifier', 'google_recaptcha')->first() != null &&
            SystemAddons::where('unique_identifier', 'google_recaptcha')->first()->activated == 1
        ) {

            if (helper::appdata('')->recaptcha_version == 'v2') {
                $request->validate([
                    'g-recaptcha-response' => 'required'
                ], [
                    'g-recaptcha-response.required' => 'The g-recaptcha-response field is required.'
                ]);
            }

            if (helper::appdata('')->recaptcha_version == 'v3') {
                $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'contact');
                if ($score <= helper::appdata('')->score_threshold) {
                    return redirect()->back()->with('error', 'You are most likely a bot');
                }
            }
        }
        $checkreferral = User::select('id', 'name', 'referral_code', 'wallet', 'email', 'token')->where('referral_code', $request->referral_code)->where('type', 3)->where('is_available', 1)->where('is_deleted', 2)->first();

        $newuser = new User();
        $newuser->name = $request->name;
        $newuser->vendor_id = $vdata;
        $newuser->email = $request->email;
        $newuser->password = hash::make($request->password);
        $newuser->mobile = $request->mobile;
        $newuser->type = "3";
        $newuser->referral_code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
        $newuser->login_type = "normal";
        $newuser->image = "default.png";
        $newuser->is_available = "1";
        $newuser->is_verified = "1";
        $newuser->wallet = 0;
        $newuser->save();

        if ($request->referral_code != "") {
            $checkuser = User::where('email', $checkreferral->email)->where('type', 3)->first();

            // ---- for referral user ------
            $checkreferraluser = User::find($checkuser->id);

            $checkreferraluser->wallet += helper::appdata($vdata)->referral_amount;
            $checkreferraluser->update();
            $referral_tr = new Transaction();
            $referral_tr->vendor_id = $vdata;
            $referral_tr->user_id = $checkreferraluser->id;
            $referral_tr->amount = helper::appdata($vdata)->referral_amount;
            $referral_tr->transaction_type = 4;
            $referral_tr->username = $newuser->name;
            $referral_tr->save();
            // ---- for new user ------
            $checkusernew = User::where('email', $request->email)->first();

            $checkusernew->wallet = helper::appdata($vdata)->referral_amount;
            $checkusernew->update();
            $new_user_tr = new Transaction();
            $new_user_tr->vendor_id = $vdata;
            $new_user_tr->user_id = $checkusernew->id;
            $new_user_tr->amount = helper::appdata($vdata)->referral_amount;
            $new_user_tr->transaction_type = 4;
            $new_user_tr->username = $checkreferraluser->name;
            $new_user_tr->save();


            $title = trans('labels.referral_earning');
            $body = 'Your friend "' . $checkusernew->name . '" has used your referral code to register with ' . helper::appdata($vdata)->web_title . '. You have earned "' . helper::currency_formate(helper::appdata($vdata)->referral_amount, $vdata) . '" referral amount in your wallet.';
            helper::push_notification($checkreferraluser->token, $title, $body, "wallet", "", @helper::appdata('')->firebase);

            $var = ["{referral_user}", "{new_user}", "{company_name}", "{referral_amount}"];
            $newvar = [$checkreferraluser->name, $checkusernew->name, helper::appdata($vdata)->web_title, helper::currency_formate(helper::appdata($vdata)->referral_amount, $vdata)];
            $referralmessage = str_replace($var, $newvar, nl2br(helper::appdata($vdata)->referral_earning_email_message));

            $emaildata = helper::emailconfigration(helper::appdata($vdata)->id);
            Config::set('mail', $emaildata);
            helper::referral($checkreferraluser->email, $referralmessage);
        }
        return redirect($request->vendor_slug . '/login')->with('success', trans('messages.success'));
    }


    public function check_login(Request $request)
    {
        try {

            $host = $_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $vendordata = helper::vendordata($request->vendor_slug);
                $vdata = $vendordata->id;
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $vendordata = Settings::where('custom_domain', $host)->first();
                $vdata = $vendordata->vendor_id;
            }
            if ($request->logintype == "normal") {
                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ], [
                    'email.required' => trans('messages.email_required'),
                    'email.email' =>  trans('messages.invalid_email'),
                    'password.required' => trans('messages.password_required'),
                ]);

                $old_sid = session()->getId();
                session()->put('user_login', 1);
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'vendor_id' => $vdata, 'is_deleted' => 2, 'type' => 3])) {

                    if (Auth::user()->type == 3 && Auth::user()->is_deleted == 2) {
                        if (Auth::user()->is_available == 1) {
                            if (Str::contains(session()->get('previous_url'), 'products')) {
                                $previous_url = session()->get('previous_url');
                            } else {
                                $previous_url = URL::to($vendordata->slug);
                            }
                            session()->put('old_sid', $old_sid);
                            if (Auth::user() && Auth::user()->type == 3) {
                                Cart::where('session_id', $old_sid)->update(['user_id' => Auth::user()->id, 'session_id' => NULL]);
                            }
                            return redirect($previous_url)->with('sucess', trans('messages.success'));
                        } else {
                            Auth::logout();
                            return redirect()->back()->with('error', trans('messages.block'));
                        }
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', trans('messages.email_password_not_match'));
                    }
                } else {

                    return redirect()->back()->with('error', trans('messages.email_password_not_match'));
                }
            }
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function send_userpassword(Request $request)
    {
        try {
            $host = $_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $vendordata = helper::vendordata($request->vendor_slug);

                $vdata = $vendordata->id;
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $vendordata = Settings::where('custom_domain', $host)->first();

                $vdata = $vendordata->vendor_id;
            }
            if (empty($vendordata)) {
                abort(404);
            }
            $checkuser = User::where('email', $request->email)->where('is_available', 1)->where('type', 3)->where('is_deleted', 2)->first();
            if (!empty($checkuser)) {
                $password = substr(str_shuffle($checkuser->password), 1, 6);
                $emaildata = helper::emailconfigration($vdata);
                Config::set('mail', $emaildata);
                $check_send_mail = helper::send_mail_forpassword($request->email, $checkuser->name, $password, helper::appdata('')->logo);
                if ($check_send_mail == 1) {
                    $checkuser->password = Hash::make($password);
                    $checkuser->save();
                    return redirect('/' . $request->vendor_slug . '/login')->with('success', trans('messages.success'));
                } else {
                    return redirect('/' . $request->vendor_slug . '/forgotpassword')->with('error', trans('messages.wrong'));
                }
            } else {
                return redirect()->back()->with('error', trans('messages.invalid_user'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.sending_email'));
        }
    }
    public function logout(Request $request)
    {

        session()->flush();
        Auth::logout();
        return redirect('/' . $request->vendor_slug);
    }

    public function my_profile(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        $getprofile = User::where('id', Auth::user()->id)->first();
        return view('web.user.profile', compact('vendordata', 'getprofile'));
    }

    public function edit_profile(Request $request)
    {

        $user = User::where('id', $request->id)->first();
        $storeinfo = User::where('is_available', 1)->where('is_deleted', 2)->where('slug', $request->slug)->first();
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where('vendor_id', $vdata)->where('is_deleted', 2)->where('type', 3)->ignore($user->id),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->where('vendor_id', $vdata)->where('is_deleted', 2)->where('type', 3)->ignore($user->id),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }
        $request->validate([

            'image' => 'max:' . helper::imagesize() . '|' . helper::imageext(),
        ], [

            'image.max' => trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB',
        ]);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        if ($request->has('image')) {
            if ($user->image != "" && file_exists(storage_path('app/public/admin-assets/images/profile/' . $user->image))) {
                unlink(storage_path('app/public/admin-assets/images/profile/' . $user->image));
            }
            $profileImage = 'profile-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/profile/'), $profileImage);
            $user->image = $profileImage;
        }
        $user->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function changepassword(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        return view('web.user.changepassword', compact('vendordata'));
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ], [
            'current_password.required' => trans('messages.current_password_required'),
            'new_password.required' => trans('messages.new_password_required'),
            'confirm_password.unique' => trans('messages.confirm_password_required'),
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        if (Hash::check($request->current_password, Auth::user()->password)) {
            if ($request->current_password == $request->new_password) {
                return redirect()->back()->with('error', trans('messages.new_old_password_diffrent'));
            } else {
                if ($request->new_password == $request->confirm_password) {
                    $changepassword = User::where('id', Auth::user()->id)->first();
                    $changepassword->password = Hash::make($request->new_password);
                    $changepassword->update();
                    return redirect()->back()->with('success',  trans('messages.success'));
                } else {
                    return redirect()->back()->with('error', trans('messages.new_confirm_password_inccorect'));
                }
            }
        } else {
            return redirect()->back()->with('error', trans('messages.old_password_incorect'));
        }
        return view('front.user.changepassword', compact('vendordata'));
    }

    public function orders(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }
        $orders = Order::where('user_id', Auth::user()->id)->where('vendor_id', $vdata);
        if (!empty($request->type)) {
            if ($request->type == "rejected") {
                $orders = $orders->where('status_type', 4);
            }
            if ($request->type == "processing") {
                $orders = $orders->whereIn('status_type', [1, 2]);
            }
            if ($request->type == "completed") {
                $orders = $orders->where('status_type', 3);
            }
        }
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        $orders = $orders->orderByDesc('id')->get();
        $totalprocessing = Order::where('user_id', Auth::user()->id)->whereIn('status_type', [1, 2])->where('vendor_id', $vdata)->count();
        $totalrejected = Order::where('user_id', Auth::user()->id)->where('status_type', 4)->where('vendor_id', $vdata)->count();
        $totalcompleted = Order::where('user_id', Auth::user()->id)->where('status_type', 3)->where('vendor_id', $vdata)->count();
        return view('web.user.orders', compact('vendordata', 'orders', 'totalprocessing', 'totalrejected', 'totalcompleted'));
    }
    public function wishlist_product(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        $getfavourite = Products::with('product_image', 'multi_variation', 'category_info')->select('products.id', 'products.category_id', 'products.sub_category_id', 'products.name', 'products.slug', 'products.has_variation', 'products.attribute', 'products.price', 'products.original_price', 'products.tax', 'products.description', 'products.is_available', 'products.is_deleted', 'products.created_at', 'products.updated_at', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftjoin('favorite', 'favorite.product_id', '=', 'products.id')->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('favorite.vendor_id', $vdata)->where('products.vendor_id', $vdata)
            ->where('favorite.user_id', Auth::user()->id)->orderBy('products.reorder_id')
            ->where('products.is_available', 1)->where('products.is_deleted', 2)->where('products.vendor_id', $vdata)->paginate(9);
        return view('web.user.favourite', compact('vendordata', 'vdata', 'getfavourite'));
    }
    public function referearn(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        return view('web.user.referearn', compact('vendordata'));
    }
    public function deleteaccount(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);

            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();

            $vdata = $vendordata->vendor_id;
        }

        if (empty($vendordata)) {
            abort(404);
        }
        if (Auth::user() && Auth::user()->type == 3) {
            $user  = User::where('id', Auth::user()->id)->where('vendor_id', $vdata)->first();
            $user->is_deleted = 1;
            $user->update();
            $emaildata = helper::emailconfigration($vdata);
            Config::set('mail', $emaildata);
            helper::send_mail_delete_account($user);
            session()->flush();
            Auth::logout();
        }
        return redirect('/' . $request->vendor_slug);
    }

    public function deleteprofile(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }
        if (empty($vendordata)) {
            abort(404);
        }
        return view('web.user.delete_account', compact('vendordata'));
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\User;
use App\Models\Settings;
use App\Models\Footerfeatures;
use App\Models\Customdomain;
use App\Models\Country;
use App\Models\City;
use App\Models\PricingPlan;
use App\Models\Pixcel;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OtherSettings;
use App\Models\Payment;
use App\Models\StoreCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use URL;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemAddons;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Config;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $getuserslist = User::where('type', 2)->where('is_deleted', 2)->orderBydesc('id')->get();
        return view('admin.user.index', compact('getuserslist'));
    }
    public function add(Request $request)
    {
        $countries = Country::where('Is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $stores = StoreCategory::where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        return view('admin.user.add', compact('countries', 'stores'));
    }
    public function edit($slug)
    {
        $getuserdata = User::where('slug', $slug)->first();
        $getplanlist = PricingPlan::where('is_available', 1)->get();
        $countries = Country::where('Is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $stores = StoreCategory::where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        return view('admin.user.edit', compact('getuserdata', 'getplanlist', 'countries', 'stores'));
    }
    public function update(Request $request)
    {
        $edituser = User::where('id', $request->id)->first();
        $usersetting = Settings::where('vendor_id', $request->id)->first();
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2)->ignore($edituser->id),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2)->ignore($edituser->id),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }

        if (Auth::user()->type == "2") {
            $validatorslug = Validator::make(['slug' => $request->slug], [
                'slug' => [
                    'required',
                    Rule::unique('users')->where('type', 2)->where('is_deleted', 2)->ignore($edituser->id),
                ]
            ]);
            if ($validatorslug->fails()) {
                return redirect()->back()->with('error', trans('messages.unique_slug'));
            }
        }


        $request->validate([

            'profile' => 'max:' . helper::imagesize() . '|' . helper::imageext(),
        ], [
            'profile.max' => trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB',
        ]);

        $edituser->name = $request->name;
        $edituser->email = $request->email;
        $edituser->mobile = $request->mobile;
        $edituser->country_id = $request->country;
        $edituser->city_id = $request->city;
        if ($request->store != null && $request->store != "") {
            $edituser->store_id = $request->store;
        }
        if ($request->has('profile')) {
            if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $edituser->image))) {
                unlink(storage_path('app/public/admin-assets/images/profile/' . $edituser->image));
            }
            $edit_image = $request->file('profile');
            $profileImage = 'profile-' . uniqid() . "." . $edit_image->getClientOriginalExtension();
            $edit_image->move(storage_path('app/public/admin-assets/images/profile/'), $profileImage);
            $edituser->image = $profileImage;
        }
        if (!isset($request->allow_store_subscription)) {
            if (isset($request->plan_checkbox) && $request->plan != null && !empty($request->plan)) {

                $plan = PricingPlan::where('id', $request->plan)->first();
                $edituser->plan_id = $plan->id;
                $edituser->purchase_amount = $plan->price;
                $edituser->purchase_date = date("Y-m-d h:i:sa");
                $edituser->allow_without_subscription = 2;
                $transaction = new Transaction();
                $transaction->vendor_id = $edituser->id;
                $transaction->plan_id = $plan->id;
                $transaction->transaction_number = Str::upper(Str::random(8));
                $transaction->plan_name = $plan->name;
                $transaction->payment_type = "0";
                $transaction->payment_id = "";
                $transaction->amount = $plan->price;
                $transaction->grand_total = ($plan->price) +  ($plan->price * ($plan->tax / 100));
                $transaction->tax = $plan->tax == null ? 0 : $plan->tax;
                $transaction->service_limit = $plan->order_limit;
                $transaction->appoinment_limit = $plan->appointment_limit;
                $transaction->status = 2;
                $transaction->purchase_date = date("Y-m-d h:i:sa");
                $transaction->expire_date = helper::get_plan_exp_date($plan->duration, $plan->days);
                $transaction->duration = $plan->duration;
                $transaction->days = $plan->days;
                $transaction->custom_domain = $plan->custom_domain;
                $transaction->themes_id = $plan->themes_id;
                $transaction->google_analytics = $plan->google_analytics;
                $transaction->pos = $plan->pos;
                $transaction->vendor_app = $plan->vendor_app;
                $transaction->customer_app = $plan->customer_app;
                $transaction->role_management = $plan->role_management;
                $transaction->pwa = $plan->pwa;
                $transaction->coupons = $plan->coupons;
                $transaction->blogs = $plan->blogs;
                $transaction->social_logins = $plan->social_logins;
                $transaction->sound_notification = $plan->sound_notification;
                $transaction->whatsapp_message = $plan->whatsapp_message;
                $transaction->telegram_message = $plan->telegram_message;
                $transaction->pixel = $plan->pixel;
                $transaction->save();
                if ($plan->custom_domain == "2") {
                    Settings::where('vendor_id', Auth::user()->id)->update(['custom_domain' => "-"]);
                }
                if ($plan->custom_domain == "1") {
                    $checkdomain = Customdomain::where('vendor_id', Auth::user()->id)->first();
                    if (@$checkdomain->status == 2) {
                        Settings::where('vendor_id', Auth::user()->id)->update(['custom_domain' => $checkdomain->current_domain]);
                    }
                }
            }
        }
        if (Str::contains(request()->url(), 'users')) {
            if (isset($request->allow_store_subscription)) {
                $edituser->plan_id = "";
                $edituser->purchase_amount = "";
                $edituser->purchase_date = "";
            }

            $edituser->allow_without_subscription = isset($request->allow_store_subscription) ? 1 : 2;
            $edituser->available_on_landing = isset($request->show_landing_page) ? 1 : 2;
        }
        if (!empty($request->slug)) {
            $edituser->slug = $request->slug;
        }
        $edituser->update();
        if ($request->product_type != null && $request->product_type != "") {
            $usersetting->product_type = $request->product_type;
            $usersetting->update();
        }
        if ($request->has('updateprofile') && $request->updateprofile == 1) {
            return redirect('admin/settings')->with('success', trans('messages.success'));
        } else {
            return redirect('admin/users')->with('success', trans('messages.success'));
        }
    }
    public function status(Request $request)
    {

        $user = User::where('slug', $request->slug)->first();
        $user->is_available = $request->status;
        $user->update();
        if ($request->status == 2) {
            $emaildata = helper::emailconfigration(helper::appdata('')->id);
            Config::set('mail', $emaildata);
            helper::send_mail_vendor_block($user);
        }
        return redirect('admin/users')->with('success', trans('messages.success'));
    }
    public function vendor_login(Request $request)
    {
        $user = User::where('slug', $request->slug)->first();
        session()->put('vendor_login', Auth::user()->id);
        Auth::login($user);
        return redirect('admin/dashboard');
    }
    public function user_login(Request $request)
    {
        $slug = $request->vendor_slug;
        return view('admin.auth.userlogin', compact('slug'));
    }
    public function user_register(Request $request)
    {
        $slug = $request->vendor_slug;
        return view('admin.auth.userregister', compact('slug'));
    }
    public function admin_back()
    {
        $getuser = User::where('id', session()->get('vendor_login'))->first();
        Auth::login($getuser);
        session()->forget('vendor_login');
        return redirect('admin/users');
    }
    // ------------------------------------------------------------------------
    // ----------------- registration & Auth pages ----------------------------
    // ------------------------------------------------------------------------
    public function register()
    {
        Helper::language(1);
        if (helper::appdata('')->vendor_register == 2) {
            abort(404);
        }
        $countries = Country::where('Is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $stores = StoreCategory::where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        return view('admin.auth.register', compact('countries', 'stores'));
    }
    public function register_vendor(Request $request)
    {
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }
        $validatorslug = Validator::make(['slug' => $request->slug], [
            'slug' => [
                'required',
                Rule::unique('users')->where('type', 2)->where('is_deleted', 2),
            ]
        ]);
        if ($validatorslug->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_slug'));
        }
        if (@Auth::user()->type != 1) {
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
        }
        $check = User::where('slug', $request->slug)->first();
        if ($check != "") {
            return redirect()->back()->with('error', trans('messages.unique_slug'));
        }
        $data = helper::vendor_register($request->name, $request->email, $request->mobile, hash::make($request->password), '', $request->slug, '', '', $request->country, $request->city, $request->store, $request->product_type);
        if (Auth::user() && (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))) {
            return redirect('admin/users')->with('success', trans('messages.success'));
        } else {
            $newuser = User::select('id', 'name', 'email', 'mobile', 'image')->where('id', $data)->first();
            Auth::login($newuser);
            return redirect('admin/dashboard')->with('success', trans('messages.success'));
        }
    }
    public function forgot_password()
    {
        Helper::language(1);
        return view('admin.auth.forgotpassword');
    }
    public function send_password(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => trans('messages.email_required'),
                'email.email' => trans('messages.invalid_email'),
            ]);
            $checkuser = User::where('email', $request->email)->where('is_available', 1)->first();
            if (!empty($checkuser)) {
                $password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);
                $emaildata = helper::emailconfigration(helper::appdata("")->id);
                Config::set('mail', $emaildata);
                $check_send_mail = helper::send_mail_forpassword($request->email, $checkuser->name, $password, helper::appdata("")->logo);
                if ($check_send_mail == 1) {
                    $checkuser->password = Hash::make($password);
                    $checkuser->save();
                    return redirect('admin')->with('success', trans('messages.success'));
                } else {
                    return redirect('admin/forgot_password')->with('error', trans('messages.wrong'));
                }
            } else {
                return redirect()->back()->with('error', trans('messages.invalid_user'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.sending_email'));
        }
    }
    // ----------------------------------------------------------
    // ----------------------- Settings -------------------------
    // ----------------------------------------------------------
    public function settings_index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        $othersettingdata = OtherSettings::where('vendor_id', $vendor_id)->first();
        $countries = Country::where('Is_deleted', 2)->where('is_available', 1)->get();
        $getfooterfeatures = Footerfeatures::where('vendor_id', $vendor_id)->get();
        $theme = Transaction::select('themes_id')->where('vendor_id', $vendor_id)->orderByDesc('id')->first();
        $pixelsettings = Pixcel::where('vendor_id', Auth::user()->id)->first();
        $order = Order::where('vendor_id', $vendor_id)->get();
        $getpayment = Payment::where('is_available', '1')->where('vendor_id', $vendor_id)->where('is_activate', '1')->orderBy('reorder_id')->get();
        return view('admin.settings.index', compact('settingdata', 'othersettingdata', 'getfooterfeatures', 'theme', 'countries', 'pixelsettings', 'order', 'getpayment', 'vendor_id'));
    }
    public function delete_feature(Request $request)
    {
        Footerfeatures::where('id', $request->id)->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function settings_update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (isset($request->updatebasicinfo) && $request->updatebasicinfo == 1) {
            $request->validate([
                'currency' => 'required',
                'timezone' => 'required',
                'slug' => 'required_if:Auth::user()->type(),2|unique:users,slug,' . $vendor_id,
            ], [
                "currency.required" => trans('messages.currency_required'),
                "timezone.required" => trans('messages.timezone_required'),
                'slug.required_if' => trans('messages.slug_required'),
                'slug.unique' => trans('messages.unique_slug'),
            ]);
            $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
            if ($request->hasfile('notification_sound')) {
                $request->validate([
                    'notification_sound' => 'mimes:mp3',

                ]);
                if (file_exists(storage_path('app/public/admin-assets/notification/' . $settingsdata->notification_sound))) {
                    @unlink(storage_path('app/public/admin-assets/notification/' . $settingsdata->notification_sound));
                }
                $sound = 'audio-' . uniqid() . '.' . $request->notification_sound->getClientOriginalExtension();
                $request->notification_sound->move(storage_path('app/public/admin-assets/notification/'), $sound);
                $settingsdata->notification_sound = $sound;
            }
            $settingsdata->currency = $request->currency;
            if (Auth::user()->type == 1) {
                $settingsdata->copyright = $request->copyright;
                $settingsdata->web_title = $request->web_title;
            }
            $settingsdata->currency_position = $request->currency_position;
            $settingsdata->currency_formate = $request->currency_formate;
            $settingsdata->currency_space = $request->currency_space;
            $settingsdata->decimal_separator = $request->decimal_separator;
            $settingsdata->timezone = $request->timezone;
            $settingsdata->referral_amount = $request->referral_amount;

            $settingsdata->vendor_register = isset($request->vendor_register) ? 1 : 2;
            $settingsdata->maintenance_mode = isset($request->maintenance_mode) ? 1 : 2;
            $settingsdata->checkout_login_required = isset($request->checkout_login_required) ? 1 : 2;
            $settingsdata->time_format = $request->time_format;
            $settingsdata->date_format = $request->date_format;
            $settingsdata->order_prefix = $request->order_prefix;
            $settingsdata->min_order_amount = $request->min_order_amount;
            $settingsdata->min_order_amount_for_free_shipping = $request->min_order_amount_for_free_shipping;
            $settingsdata->shipping_charges = $request->shipping_charges;
            $order = Order::where('vendor_id', $vendor_id)->get();
            if ($order->count() == 0 && $request->order_number_start != null && $request->order_number_start != "") {
                $settingsdata->order_number_start = $request->order_number_start;
            }
            if (Auth::user()->type == 1) {
                $settingsdata->image_size = $request->image_size;
            }
            if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                $settingsdata->checkout_login_required = isset($request->checkout_login_required) ? 1 : 2;
                $settingsdata->is_checkout_login_required = isset($request->is_checkout_login_required) ? 1 : 2;
            }
            if (Auth::user()->type == 1) {
                $settingsdata->primary_color = $request->primary_color;
                $settingsdata->secondary_color = $request->secondary_color;
            }
            $settingsdata->save();

            return redirect()->back()->with('success', trans('messages.success'));
        }
        return redirect()->back();
    }

    public function safe_secure_store(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingsdata = OtherSettings::where('vendor_id', $vendor_id)->first();
        if (empty($settingsdata)) {
            $settingsdata = new OtherSettings();
            $settingsdata->vendor_id = $vendor_id;
        }
        if ($request->trusted_badges == 1) {
            // Handle image 1
            if ($request->hasFile('trusted_badge_image_1')) {
                if ($settingsdata->trusted_badge_image_1 != "trusted_badge_image_1.png" && file_exists(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_1))) {
                    @unlink(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_1));
                }
                $image1 = $request->file('trusted_badge_image_1');
                $imageName1 = 'trusted_badge-' . uniqid() . '.' . $image1->getClientOriginalExtension();
                $image1->move(storage_path('app/public/admin-assets/images/about/trusted_badge/'), $imageName1);
                $settingsdata->trusted_badge_image_1 = $imageName1;
            }

            // Handle image 2
            if ($request->hasFile('trusted_badge_image_2')) {
                if ($settingsdata->trusted_badge_image_2 != "trusted_badge_image_2.png" && file_exists(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_2))) {
                    @unlink(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_2));
                }
                $image2 = $request->file('trusted_badge_image_2');
                $imageName2 = 'trusted_badge-' . uniqid() . '.' . $image2->getClientOriginalExtension();
                $image2->move(storage_path('app/public/admin-assets/images/about/trusted_badge/'), $imageName2);
                $settingsdata->trusted_badge_image_2 = $imageName2;
            }

            // Handle image 3
            if ($request->hasFile('trusted_badge_image_3')) {
                if ($settingsdata->trusted_badge_image_3 != "trusted_badge_image_3.png" && file_exists(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_3))) {
                    @unlink(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_3));
                }
                $image3 = $request->file('trusted_badge_image_3');
                $imageName3 = 'trusted_badge-' . uniqid() . '.' . $image3->getClientOriginalExtension();
                $image3->move(storage_path('app/public/admin-assets/images/about/trusted_badge/'), $imageName3);
                $settingsdata->trusted_badge_image_3 = $imageName3;
            }

            // Handle image 4
            if ($request->hasFile('trusted_badge_image_4')) {
                if ($settingsdata->trusted_badge_image_4 != "trusted_badge_image_4.png" && file_exists(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_4))) {
                    @unlink(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $settingsdata->trusted_badge_image_4));
                }
                $image4 = $request->file('trusted_badge_image_4');
                $imageName4 = 'trusted_badge-' . uniqid() . '.' . $image4->getClientOriginalExtension();
                $image4->move(storage_path('app/public/admin-assets/images/about/trusted_badge/'), $imageName4);
                $settingsdata->trusted_badge_image_4 = $imageName4;
            }
        }
        if ($request->safe_secure == 1) {
            $settingsdata->safe_secure_checkout_payment_selection = $request->safe_secure_checkout_payment_selection == null ? null : implode(',', $request->safe_secure_checkout_payment_selection);
            $settingsdata->safe_secure_checkout_text = $request->safe_secure_checkout_text;
            $settingsdata->safe_secure_checkout_text_color = $request->safe_secure_checkout_text_color;
        }
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_viewall_page_image()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
        if (!empty($settingsdata)) {
            if (!empty($settingsdata->viewallpage_banner) && file_exists(storage_path('app/public/admin-assets/images/about/viewallpage_banner/' . $settingsdata->viewallpage_banner))) {
                unlink(storage_path('app/public/admin-assets/images/about/viewallpage_banner/' . $settingsdata->viewallpage_banner));
            }
            $settingsdata->viewallpage_banner = "";
            $settingsdata->update();
            return redirect('admin/settings')->with('success', trans('messages.success'));
        }
        return redirect('admin/settings');
    }
    public function change_password(Request $request)
    {
        if ($request->type != "" || $request->type != null) {
            if ($request->new_password == $request->confirm_password) {
                $changepassword = User::where('id', $request->modal_vendor_id)->first();
                $changepassword->password = Hash::make($request->new_password);
                $changepassword->update();
                $emaildata = helper::emailconfigration(helper::appdata("")->id);
                Config::set('mail', $emaildata);
                helper::send_mail_forpassword($changepassword->email, $changepassword->name, $request->new_password, helper::appdata("")->logo);
                return redirect()->back()->with('success', trans('messages.success'));
            } else {
                return redirect()->back()->with('error', trans('messages.new_confirm_password_inccorect'));
            }
        } else {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required',
            ], [
                'current_password.required' => trans('messages.cuurent_password_required'),
                'new_password.required' => trans('messages.new_password_required'),
                'confirm_password.required' => trans('messages.confirm_password_required'),
            ]);
            if (Hash::check($request->current_password, Auth::user()->password)) {
                if ($request->current_password == $request->new_password) {
                    return redirect()->back()->with('error', trans('messages.new_old_password_diffrent'));
                } else {
                    if ($request->new_password == $request->confirm_password) {
                        $changepassword = User::where('id', Auth::user()->id)->first();
                        $changepassword->password = Hash::make($request->new_password);
                        $changepassword->update();
                        return redirect()->back()->with('success', trans('messages.success'));
                    } else {
                        return redirect()->back()->with('error', trans('messages.new_confirm_password_inccorect'));
                    }
                }
            } else {
                return redirect()->back()->with('error', trans('messages.old_password_incorect'));
            }
        }
    }


    public function userforgotpassword(Request $request)
    {
        $slug = $request->vendor_slug;
        return view('admin.auth.userforgotpassword', compact('slug'));
    }

    public function check_login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => trans('messages.email_required'),
                'email.email' =>  trans('messages.invalid_email'),
                'password.required' => trans('messages.password_required'),
            ]);
            if (Auth::attempt($request->only('email', 'password'))) {
                if (Auth::user()->type == 3) {
                    if (Str::contains(session()->get('previous_url'), 'service-')) {
                        $previous_url = session()->get('previous_url');
                    } else {
                        $previous_url = URL::to('/' . $request->vendor);
                    }
                    session()->forget("previous_url");
                    return redirect($previous_url)->with('sucess', trans('messages.success'));
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', trans('messages.email_password_not_match'));
                }
            } else {
                return redirect()->back()->with('error', trans('messages.email_password_not_match'));
            }
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function send_userpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' =>  trans('messages.invalid_email'),
        ]);
        $checkuser = User::where('email', $request->email)->where('is_available', 1)->whereIn('type', [1, 2])->first();
        if (!empty($checkuser)) {
            $password = substr(str_shuffle($checkuser->password), 1, 6);
            $emaildata = helper::emailconfigration(helper::appdata('')->id);
            Config::set('mail', $emaildata);
            $check_send_mail = helper::send_mail_forpassword($request->email, $checkuser->name, $password, helper::appdata('')->logo);
            if ($check_send_mail == 1) {
                $checkuser->password = Hash::make($password);
                $checkuser->save();
                return redirect('/' . $request->vendor . '/login')->with('success', trans('messages.success'));
            } else {
                return redirect('/' . $request->vendor . '/forgot_password')->with('error', trans('messages.wrong'));
            }
        } else {
            return redirect()->back()->with('error', trans('messages.invalid_user'));
        }
    }


    public function getcity(Request $request)
    {
        try {
            $data['city'] = City::select("id", "city")->where('country_id', $request->country)->where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    public function deleteaccount(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->is_deleted == 1) {
            return redirect('admin/settings')->with('error', trans('messages.block'));
        }
        $user->is_deleted = 1;
        $user->update();
        $emaildata = helper::emailconfigration(helper::appdata("")->id);
        Config::set('mail', $emaildata);
        helper::send_mail_delete_account($user);
        session()->flush();
        Auth::logout();
        return redirect('admin');
    }
    public function deletevendor(Request $request)
    {
        $user = User::where('slug', $request->slug)->first();
        $user->is_deleted = 1;
        $user->slug = '';
        $user->update();
        $emaildata = helper::emailconfigration(helper::appdata("")->id);
        Config::set('mail', $emaildata);
        helper::send_mail_delete_account($user);
        return redirect('admin/users')->with('success', trans('messages.success'));
    }
}

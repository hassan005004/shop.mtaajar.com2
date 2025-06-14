<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use App\helper\helper;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register_customer(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => trans('messages.name_required')], 200);
        }
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => trans('messages.email_required')], 200);
        }
        if ($request->mobile == "") {
            return response()->json(["status" => 0, "message" => trans('messages.mobile_required')], 200);
        }
        if ($request->password == "") {
            return response()->json(["status" => 0, "message" => trans('messages.password_required')], 200);
        }
        $checkemail = User::where('email', $request->email)->where('vendor_id', $request->vendor_id)->where('is_deleted',2)->where('type',3)->first();
        $checkmobile = User::where('mobile', $request->mobile)->where('vendor_id', $request->vendor_id)->where('is_deleted',2)->where('type',3)->first();

        if (!empty($checkemail)) {
            return response()->json(['status' => 0, 'message' => trans('messages.unique_email')], 200);
        }
        if (!empty($checkmobile)) {
            return response()->json(['status' => 0, 'message' => trans('messages.unique_mobile')], 200);
        }
        $newuser = new User();
        $newuser->name = $request->name;
        $newuser->email = $request->email;
        $newuser->password = hash::make($request->password);
        $newuser->mobile = $request->mobile;
        $newuser->type = "3";
        $newuser->vendor_id = $request->vendor_id;
        $newuser->token = $request->token;
        $newuser->login_type = "normal";
        $newuser->image = "default.png";
        $newuser->is_available = "1";
        $newuser->is_verified = "1";
        $newuser->wallet = 0;
        $newuser->save();

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $newuser], 200);
    }

    public function login_customer(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => trans('messages.email_required')], 200);
        }
        if ($request->password == "") {
            return response()->json(["status" => 0, "message" => trans('messages.password_required')], 200);
        }
        $checkuser = User::where('email', $request->email)->where('is_available', 1)->where('type', 3)->where('vendor_id',$request->vendor_id)->where('is_deleted',2)->first();
       
        if (!empty($checkuser)) {
            if (Hash::check($request->password, $checkuser->password)) {
                if ($checkuser->is_available == '1' ) {
                    $checkuser->token = $request->token;
                    $checkuser->save();
                    $checkuser = $checkuser::select('id', 'name', 'email', 'mobile', 'image')->where('id', $checkuser->id)->first();
                    $checkuser->image = helper::image_path($checkuser->image);
                    if ($request->session_id != "") {
                        Cart::where('session_id', $request->sessoin_id)->update(['user_id' => $checkuser->id, 'session_id' => NULL]);
                    }
                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $checkuser], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.blocked')], 200);
                }
            } else {
                return response()->json(['status' => 0, 'message' => trans('messages.email_password_not_match')], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.email_password_not_match')], 200);
        }
    }

    public function forgotpassword(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => trans('messages.email_required')], 200);
        }
        $checkuser = User::where('email', $request->email)->where('is_available', 1)->where('type', 3)->where('is_deleted',2)->first();
        if (!empty($checkuser)) {
            $password = substr(str_shuffle($checkuser->password), 1, 6);
            $check_send_mail = helper::send_mail_forpassword($request->email,$checkuser->name, $password, helper::appdata('')->logo);
            if ($check_send_mail == 1) {
                $checkuser->password = Hash::make($password);
                $checkuser->save();
                return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
            } else {
                return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_user')], 200);
        }
    }

    public function edit_profile(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
        }
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 400);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => trans('messages.name_required')], 200);
        }
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => trans('messages.email_required')], 200);
        }
        if ($request->mobile == "") {
            return response()->json(["status" => 0, "message" => trans('messages.mobile_required')], 200);
        }
        $edituser = User::where('id', $request->user_id)->first();
        $checkemail = User::where('email', $request->email)->where('vendor_id', $request->vendor_id)->where('is_deleted',2)->where('type',3)->where('id','!=',$edituser->id)->first();
        $checkmobile = User::where('mobile', $request->mobile)->where('vendor_id', $request->vendor_id)->where('is_deleted',2)->where('type',3)->where('id','!=',$edituser->id)->first();
        if (!empty($checkemail)) {
            return response()->json(['status' => 0, 'message' => trans('messages.unique_email')], 200);
        }
        if (!empty($checkmobile)) {
            return response()->json(['status' => 0, 'message' => trans('messages.unique_mobile')], 200);
        }
       
        $edituser->name = $request->name;
        $edituser->email = $request->email;
        $edituser->mobile = $request->mobile;
        if ($request->has('profile')) {
            if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $edituser->image))) {
                unlink(storage_path('app/public/admin-assets/images/profile/' .  $edituser->image));
            }
            $edit_image = $request->file('profile');
            $profileImage = 'profile-' . uniqid() . "." . $edit_image->getClientOriginalExtension();
            $edit_image->move(storage_path('app/public/admin-assets/images/profile/'), $profileImage);
            $edituser->image = $profileImage;
        }
        $edituser->update();
        return response()->json(['status' => 1, 'message' => trans('messages.success'), "name" => $request->name, "email" => $request->email, "mobile" => $request->mobile, "image" => helper::image_path($edituser->image)], 200);
    }

    public function change_password(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 400);
        }
        if ($request->current_password == "") {
            return response()->json(["status" => 0, "message" => trans('messages.cuurent_password_required')], 200);
        }
        if ($request->new_password == "") {
            return response()->json(["status" => 0, "message" => trans('messages.new_password_required')], 200);
        }
        if ($request->confirm_password == "") {
            return response()->json(["status" => 0, "message" => trans('messages.confirm_password_required')], 200);
        }
        $user = User::where('id', $request->user_id)->first();
        if (Hash::check($request->current_password, $user->password)) {
            if ($request->current_password == $request->new_password) {
                return redirect()->back()->with('error', trans('messages.new_old_password_diffrent'));
            } else {
                if ($request->new_password == $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                    $user->update();
                    return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.new_confirm_password_inccorect')], 200);
                }
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.old_password_incorect')], 200);
        }
    }
    public function wishlist_product(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 400);
        }
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
        }
        $getfavourite = Products::with('product_image', 'multi_variation', 'category_info')->select('products.id', 'products.category_id', 'products.sub_category_id', 'products.name', 'products.slug', 'products.has_variation', 'products.attribute', 'products.price', 'products.original_price', 'products.tax', 'products.description', 'products.is_available', 'products.is_deleted', 'products.created_at', 'products.updated_at',DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftjoin('favorite', 'favorite.product_id', '=', 'products.id')->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('favorite.vendor_id', $request->vendor_id)->where('products.vendor_id', $request->vendor_id)
        ->where('favorite.user_id', $request->user_id)
        ->where('products.is_available', 1)->where('products.is_deleted', 2)->where('products.top_deals','!=','1')->paginate(9);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $getfavourite], 200);
    }
    public function deleteaccount(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 400);
        }
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
        }
        $user  = User::where('id', $request->user_id)->first();
        $user->is_deleted = 1;
        $user->update();
        $emaildata = helper::emailconfigration($request->vendor_id);
        Config::set('mail', $emaildata);
        helper::send_mail_delete_account($user);
        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    }
}

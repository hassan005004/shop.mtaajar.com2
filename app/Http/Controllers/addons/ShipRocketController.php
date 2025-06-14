<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\helper\ship_rocket;
use App\Models\Settings;

class ShipRocketController extends Controller
{
    public function ship_rocket_settings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $checkdetails = ship_rocket::CheckAPIUser($request->api_user_email,$request->api_user_password,$vendor_id);
        
        if (@$checkdetails->token != "") {
            $shiprocketsetting = Settings::where('vendor_id', $vendor_id)->first();
            $shiprocketsetting->ship_rocket_on_off = isset($request->ship_rocket_on_off) ? 1 : 2;
            $shiprocketsetting->api_user_email = $request->api_user_email;
            $shiprocketsetting->api_user_password = $request->api_user_password;
            $shiprocketsetting->update();

            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('error', $checkdetails->message);
        }
    }

    public function create_order($vendor_id,$order_id)
    {

        $gettoken = ship_rocket::GetToken($vendor_id);

        $creatorder = ship_rocket::CreateCustomOrder($gettoken, $order_id);

        return redirect()->back()->with('success', trans('messages.success'));
    }
}

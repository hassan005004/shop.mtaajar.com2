<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Settings;

class ToyyibpayController extends Controller
{
    // toyyibpay
    public function toyyibpayrequest(Request $request)
    {
        $gettoken = Payment::select('environment', 'secret_key', 'public_key')->where('payment_type', '10')->where('vendor_id', 1)->first();
        $some_data = array(
            'userSecretKey' => $gettoken->secret_key,
            'categoryCode' => $gettoken->public_key,
            'billName' => Auth::user()->name,
            'billDescription' => "Plan Subscription",
            'billPriceSetting' => 1,
            'billPayorInfo' => 0,
            'billAmount' => $request->amount * 100,
            'billReturnUrl' => $request->successurl,
            'billCallbackUrl' => $request->successurl,
            'billExternalReferenceNo' => '',
            'billTo' => '',
            'billEmail' => '',
            'billPhone' => '',
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => 0,
            'billContentEmail' => 'Thank you for using our platform!',
            'billChargeToCustomer' => ""
        );

        if ($gettoken->environment == 1) {
            $url = "https://dev.toyyibpay.com/index.php/api/createBill/";
        } else {
            $url = "https://toyyibpay.com/index.php/api/createBill/";
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

        $result = curl_exec($curl);
        curl_close($curl);
        $obj = json_decode($result);

        if ($gettoken->environment == 1) {
            $redirecturl = "https://dev.toyyibpay.com/" . $obj[0]->BillCode;
        } else {
            $redirecturl = "https://toyyibpay.com/" . $obj[0]->BillCode;
        }

        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 10);
        session()->put('amount', $request->amount);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl], 200);
    }
    //  front----------------------------------------------------------------
    public function front_toyyibpayrequest(Request $request)
    {
        try {
            session()->forget('mdata');
            $host = $_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $vendordata = helper::vendordata($request->vendor_slug);
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $vendordata = Settings::where('custom_domain', $host)->first();
            }
            $mdata = $request->input();
            $mdata['vendor_slug'] = $request->vendor_slug;
            session()->put('mdata', $mdata);
            $gettoken = Payment::where('payment_type', '10')->where('vendor_id', @$vendordata->id)->first();

            if (Auth::user() && Auth::user()->type == 3) {
                $user_name = Auth::user()->name;
            } else {
                $user_name = session()->get('mdata')['user_name'];
            }

            $some_data = array(
                'userSecretKey' => $gettoken->secret_key,
                'categoryCode' => $gettoken->public_key,
                'billName' => $user_name,
                'billDescription' => "Order",
                'billPriceSetting' => 1,
                'billPayorInfo' => 0,
                'billAmount' => $request->grand_total * 100,
                'billReturnUrl' => $request->successurl,
                'billCallbackUrl' => $request->failure,
                'billExternalReferenceNo' => '',
                'billTo' => '',
                'billEmail' => '',
                'billPhone' => '',
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => 0,
                'billContentEmail' => 'Thank you for using our platform!',
                'billChargeToCustomer' => ""
            );
            $curl = curl_init();

            if ($gettoken->environment == 1) {
                $url = "https://dev.toyyibpay.com/index.php/api/createBill/";
            } else {
                $url = "https://toyyibpay.com/index.php/api/createBill/";
            }

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
            $result = curl_exec($curl);
            curl_close($curl);
            $obj = json_decode($result);

            if ($gettoken->environment == 1) {
                $redirecturl = "https://dev.toyyibpay.com/" . $obj[0]->BillCode;
            } else {
                $redirecturl = "https://toyyibpay.com/" . $obj[0]->BillCode;
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function toyyibpayrequestapi(Request $request)
    {
        try {
            $mdata = $request->input();
            $mdata['successurl'] = "https://www.google.com/";
            $mdata['failure'] = "https://www.facebook.com/";
            session()->put('mdata', $mdata);
            $gettoken = Payment::where('payment_type', '10')->where('vendor_id', $request->vendor_id)->first();

            $some_data = array(
                'userSecretKey' => $gettoken->secret_key,
                'categoryCode' => $gettoken->public_key,
                'billName' => session()->get('mdata')['user_name'],
                'billDescription' => "Order",
                'billPriceSetting' => 1,
                'billPayorInfo' => 0,
                'billAmount' => session()->get('mdata')['grand_total'] * 100,
                'billReturnUrl' => session()->get('mdata')['successurl'],
                'billCallbackUrl' => session()->get('mdata')['failure'],
                'billExternalReferenceNo' => '',
                'billTo' => '',
                'billEmail' => '',
                'billPhone' => '',
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => 0,
                'billContentEmail' => 'Thank you for using our platform!',
                'billChargeToCustomer' => ""
            );
            $curl = curl_init();

            if ($gettoken->environment == 1) {
                $url = "https://dev.toyyibpay.com/index.php/api/createBill/";
            } else {
                $url = "https://toyyibpay.com/index.php/api/createBill/";
            }

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
            $result = curl_exec($curl);
            curl_close($curl);
            $obj = json_decode($result);

            if ($gettoken->environment == 1) {
                $redirecturl = "https://dev.toyyibpay.com/" . $obj[0]->BillCode;
            } else {
                $redirecturl = "https://toyyibpay.com/" . $obj[0]->BillCode;
            }
            $response = ['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl, 'successurl' => session()->get('mdata')['successurl'], 'failureurl' => session()->get('mdata')['failure'], 200];
        } catch (\Exception $e) {
            $response = ['status' => 0, 'message' => trans('messages.wrong'), 200];
        }
        return response()->json($response);
    }
}

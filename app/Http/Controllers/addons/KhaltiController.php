<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Settings;

class KhaltiController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function khalti(Request $request)
    {
        $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '14')->where('vendor_id', '1')->first();

        if ($gettoken->environment == 1) {
            $url = "https://a.khalti.com/api/v2/epayment/initiate/"; // <TESTING URL>
        } else {
            $url = "https://khalti.com/api/v2/epayment/initiate/"; // <PRODUCTION URL>
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "return_url": "' . $request->successurl . '",
            "website_url": "' . $request->successurl . '",
            "amount": "' . $request->amount * 100 . '",
            "purchase_order_id": "' . time() . '",
            "purchase_order_name": "Plan Subscription"
        }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: key ' . $gettoken->secret_key,
                'Content-Type: application/json',
            ),
        ));


        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);

        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 14);
        session()->put('amount', $request->amount);
        session()->put('tran_ref', $rData->pidx);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->payment_url], 200);
    }

    //  front----------------------------------------------------------------
    public function front_khaltirequest(Request $request)
    {
        try {
            session()->forget('mdata');
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

            $gettoken = Payment::select('environment', 'currency', 'secret_key')->where('payment_type', '14')->where('vendor_id', $vdata)->first();

            $failurl = $request->failure;
            $successurl = $request->successurl;

            if ($gettoken->environment == 1) {
                $url = "https://a.khalti.com/api/v2/epayment/initiate/"; // <TESTING URL>
            } else {
                $url = "https://khalti.com/api/v2/epayment/initiate/"; // <PRODUCTION URL>
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "return_url": "' . $successurl . '",
                "website_url": "' . $failurl . '",
                "amount": "' . $request->grand_total * 100 . '",
                "purchase_order_id": "' . time() . '",
                "purchase_order_name": "SaaS Order"
            }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key ' . $gettoken->secret_key,
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $rData = json_decode($response);

            $mdata = $request->input();
            $mdata['vendor_slug'] = $request->vendor_slug;
            $mdata['vendor_id'] = $vdata;
            $mdata['tran_ref'] = $rData->pidx;
            $mdata['failureurl'] = $failurl;

            session()->put('mdata', $mdata);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->payment_url, 'successurl' => $successurl, 'failureurl' => $failurl], 200);;
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function khaltirequestapi(Request $request)
    {
        try {

            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $getkey = Payment::select('environment', 'currency', 'secret_key')->where('payment_name', 'khalti')->where('vendor_id', $request->vendor_id)->first();

            if ($getkey->environment == 1) {
                $url = "https://a.khalti.com/api/v2/epayment/initiate/"; // <TESTING URL>
            } else {
                $url = "https://khalti.com/api/v2/epayment/initiate/"; // <PRODUCTION URL>
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "return_url": "' . $successurl . '",
                "website_url": "' . $failurl . '",
                "amount": "' . $request->grand_total * 100 . '",
                "purchase_order_id": "' . time() . '",
                "purchase_order_name": "SaaS Order"
            }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key ' . $getkey->secret_key,
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $rData = json_decode($response);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $rData->payment_url, 'successurl' => $successurl, 'failureurl' => $failurl], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    public function gettransactionid(Request $request)
    {
        try {
            parse_str(parse_url($request->url)['query'], $params);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'transaction_id' => $params['transaction_id']], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Settings;
use Illuminate\Support\Facades\Session;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

class XenditController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function xendit(Request $request)
    {
        $gettoken = Payment::select('environment', 'currency', 'public_key')->where('payment_type', '15')->where('vendor_id', '1')->first();
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

        $currency = $gettoken->currency;
        Configuration::setXenditKey($gettoken->public_key);
        $params = [
            'external_id' => $orderID,
            'description' => 'Plan Subscription',
            'amount' => $request->amount * 100,
            'callback_url' =>  $request->successurl,
            'success_redirect_url' => $request->successurl,
        ];

        $apiInstance = new InvoiceApi();
        $Xenditinvoice = $apiInstance->createInvoice($params);

        Session::put('invoicepay', $Xenditinvoice);

        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 15);
        session()->put('amount', $request->amount);
        session()->put('payment_id', $orderID);
        session()->put('tran_ref', $Xenditinvoice['id']);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $Xenditinvoice['invoice_url']], 200);
    }

    public function checkpaymentstatus($tran_ref, $vendor_id)
    {
        $gettoken = Payment::select('environment', 'secret_key', 'public_key', 'currency')->where('payment_type', '15')->where('vendor_id', $vendor_id)->first();

        $xendit_api = $gettoken->public_key;
        Configuration::setXenditKey($xendit_api);
        $apiInstance = new InvoiceApi();
        $getInvoice = $apiInstance->getInvoiceById($tran_ref);
        return $getInvoice['status'];
    }

    //  front----------------------------------------------------------------
    public function front_xenditrequest(Request $request)
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
            $gettoken = Payment::select('environment', 'currency', 'public_key')->where('payment_type', '15')->where('vendor_id', $vdata)->first();

            $failurl = $request->failure;
            $successurl = $request->successurl;

            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

            Configuration::setXenditKey($gettoken->public_key);
            $params = [
                'external_id' => $orderID,
                'description' => 'SaaS Order',
                'amount' => $request->grand_total * 1000,
                'callback_url' =>  $failurl,
                'success_redirect_url' => $successurl,
            ];

            $apiInstance = new InvoiceApi();
            $Xenditinvoice = $apiInstance->createInvoice($params);

            $mdata = $request->input();
            $mdata['vendor_slug'] = $request->vendor_slug;
            $mdata['vendor_id'] = $vdata;
            $mdata['tran_ref'] = $Xenditinvoice['id'];
            $mdata['payment_id'] = $orderID;
            $mdata['invoicepay'] = $Xenditinvoice;
            $mdata['failureurl'] = $failurl;

            session()->put('mdata', $mdata);


            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $Xenditinvoice['invoice_url'], 'successurl' => $successurl, 'failureurl' => $failurl], 200);;
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function xenditrequestapi(Request $request)
    {
        try {
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $gettoken = Payment::where('payment_type', '15')->where('vendor_id', $request->vendor_id)->first();

            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

            $currency = $gettoken->currency;
            Configuration::setXenditKey($gettoken->public_key);
            $params = [
                'external_id' => $orderID,
                'description' => 'SaaS Order',
                'amount' => $request->grand_total * 100,
                'callback_url' =>  $failurl,
                'success_redirect_url' => $successurl,
            ];
            $apiInstance = new InvoiceApi();
            $Xenditinvoice = $apiInstance->createInvoice($params);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $Xenditinvoice['invoice_url'], 'successurl' => $successurl, 'failureurl' => $failurl, 'tran_ref' => $Xenditinvoice['id'], 'payment_id' => $orderID], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    public function checkpaymentstatusapi(Request $request)
    {
        try {
            $status = self::checkpaymentstatus($request->tran_ref, $request->vendor_id);

            return response()->json(['status' => 1, 'message' => $status], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}

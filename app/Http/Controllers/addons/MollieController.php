<?php

namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Settings;

class MollieController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function mollie(Request $request)
    {   
        $gettoken = Payment::select('environment','currency','secret_key')->where('payment_type', '13')->where('vendor_id', '1')->first();

        Mollie::api()->setApiKey($gettoken->secret_key); // your mollie test api key

        $payment = Mollie::api()->payments->create([
        'amount' => [
            'currency' => $gettoken->currency, // Type of currency you want to send
            'value' => number_format( $request->amount,2), // You must send the correct number of decimals, thus we enforce the use of strings
        ],
        'description' => 'Plan Subscription', 
        'redirectUrl' => $request->successurl, // after the payment completion where you to redirect
        ]);
    
        $payment = Mollie::api()->payments->get($payment->id);
        
        session()->put('plan_id', $request->plan_id);
        session()->put('payment_type', 13);
        session()->put('amount', $request->amount);
        session()->put('tran_ref', $payment->id);
        session()->put('offer_code', $request->offer_code);
        session()->put('discount', $request->discount);

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $payment->getCheckoutUrl()], 200);
    }

    //  front----------------------------------------------------------------
    public function front_mollierequest(Request $request)
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

            $gettoken = Payment::select('environment','currency','secret_key')->where('payment_type', '13')->where('vendor_id', $vdata)->first();

            $failurl = $request->failure;
            $successurl = $request->successurl;

            Mollie::api()->setApiKey($gettoken->secret_key); // your mollie test api key

            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => $gettoken->currency, // Type of currency you want to send
                    'value' => number_format( $request->grand_total,2), // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => 'SaaS Order', 
                'redirectUrl' => $successurl, // after the payment completion where you to redirect
            ]);
        
            $payment = Mollie::api()->payments->get($payment->id);

            $mdata = $request->input();
            $mdata['vendor_slug'] = $request->vendor_slug;
            $mdata['vendor_id'] = $vdata;
            $mdata['tran_ref'] = $payment->id;
            $mdata['failureurl'] = $failurl;

            session()->put('mdata', $mdata);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $payment->getCheckoutUrl() ,'successurl' => $successurl, 'failureurl' => $failurl], 200);
            ;
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    //  api----------------------------------------------------------------
    public function mollierequestapi(Request $request)
    {
        try {
            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            $getkey = Payment::select('environment','currency','secret_key')->where('payment_type', '13')->where('vendor_id', $request->vendor_id)->first();

            Mollie::api()->setApiKey($getkey->secret_key); // your mollie test api key

            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => $getkey->currency, // Type of currency you want to send
                    'value' => number_format( $request->grand_total,2), // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => 'SaaS Order', 
                'redirectUrl' => $successurl, // after the payment completion where you to redirect
            ]);
        
            $payment = Mollie::api()->payments->get($payment->id);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $payment->getCheckoutUrl() ,'successurl' => $successurl, 'failureurl' => $failurl, 'tran_ref' => $payment->id], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200); 
        }
    }

    /**
     * Page redirection after the successfull payment
     *
     * @return Response
     */
    public function checkpaymentstatus($tran_ref,$vendor_id) {

        $gettoken = Payment::select('environment','currency','secret_key')->where('payment_type', '13')->where('vendor_id', $vendor_id)->first();

        Mollie::api()->setApiKey($gettoken->secret_key); // your mollie test api key

        $payment = Mollie::api()->payments->get($tran_ref);
        if ($payment->isPaid())
        {
            return "A";
        } else {
            return "C";
        }
    }

    public function checkpaymentstatusapi(Request $request)
    {
        try {
            $status = self::checkpaymentstatus($request->tran_ref,$request->vendor_id);
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'status' => $status], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200); 
        }
    }
}
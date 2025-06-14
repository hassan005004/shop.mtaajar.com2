<?php
namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Settings;
use App\helper\helper;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
class PaypalController extends Controller
{
  
    private $gateway;
   
    public function __construct()
    {
        $getpaypal = Payment::where('payment_type', '8')->where('vendor_id', 1)->first();
        if ($getpaypal->environment == 1) {
            $mode = true;
        } else {
            $mode = false;
        }
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($getpaypal->public_key);
        $this->gateway->setSecret($getpaypal->secret_key);
        $this->gateway->setTestMode($mode); //set it to 'false' when go live
    }

    public function paypalrequest(Request $request)
    {
        if ($request->return == "1") {

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

            $mdata = $request->input();
            $mdata['vendor_slug'] = $request->vendor_slug;
            $mdata['vendor_id'] = $vdata;
            $mdata['failureurl'] = $request->failure;

            session()->put('mdata', $mdata);

            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        }
        if ($request->return == "2") {
            $getpaypal = Payment::where('payment_type', '8')->where('vendor_id', 1)->first();
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => session()->get('mdata')['grand_total'],
                    'currency' => $getpaypal->currency,
                    'returnUrl' => session()->get('mdata')['successurl'],
                    'cancelUrl' => session()->get('mdata')['failure'],
                ))->send();
            
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }
    // front-----------------------------------------------------
    public function front_paypalrequest(Request $request)
    {
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
        $gettoken = Payment::where('payment_type', '8')->where('vendor_id', @$vendordata->id)->first();
        if ($gettoken->environment == 1) {
            $mode = true;
        } else {
            $mode = false;
        }
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($gettoken->public_key);
        $this->gateway->setSecret($gettoken->secret_key);
        $this->gateway->setTestMode($mode); //set it to 'false' when go live
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->grand_total,
                'currency' => $gettoken->currency,
                'returnUrl' => $request->successurl,
                'cancelUrl' => $request->failure,
            ))->send();

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'successurl' => $response->getRedirectUrl()], 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
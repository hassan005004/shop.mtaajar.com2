<?php



namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Settings;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyfatoorahController extends Controller
{
    public $mfObj;

    /**
     * create MyFatoorah object
     */

    public function myfatoorahrequest(Request $request)
    {

        try {

            session()->put('amount', $request->amount);
            session()->put('plan_id', $request->plan_id);
            session()->put('payment_type', 9);
            session()->put('successurl', $request->successurl);
            session()->put('failureurl', $request->failureurl);

            $getkey = Payment::select('environment', 'secret_key')->where('payment_type', 9)->where('vendor_id', 1)->first();
            if ($getkey->environment == 0) {
                $mode = false;
            } else {
                $mode = true;
            }
            $this->mfObj = new PaymentMyfatoorahApiV2($getkey->secret_key, $getkey->currency, $mode);

            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode
            $data            = $this->mfObj->getInvoiceURL($this->getPayLoadData(), $paymentMethodId);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $data['invoiceURL']], 200);

            // return response()->json(['IsSuccess' => 'true', 'Message' => 'Invoice created successfully.', 'Data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * 
     * @param int|string $orderId
     * @return array
     */
    private function getPayLoadData($orderId = null)
    {
        return [
            'CustomerName'       => Auth::user()->name,
            'InvoiceValue'       => session()->get('amount'),
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => Auth::user()->email,
            'CallBackUrl'        => session()->get('successurl'),
            'ErrorUrl'           => session()->get('failureurl'),
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => '12345678',
            'Language'           => 'en',
            'CustomerReference'  => $orderId,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }


    // front------------------------------------------


    public function front_myfatoorahrequest(Request $request)
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
            $gettoken = Payment::where('payment_type', 9)->where('vendor_id', @$vendordata->id)->first();

            if ($gettoken->environment == 0) {
                $mode = false;
            } else {
                $mode = true;
            }
            $this->mfObj = new PaymentMyfatoorahApiV2($gettoken->secret_key, $gettoken->currency, $mode);
            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode
            $data            = $this->mfObj->getInvoiceURL($this->front_getPayLoadData(), $paymentMethodId);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $data['invoiceURL']], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * @param int|string $orderId
     * @return array
     */
    private function front_getPayLoadData($orderId = null)
    {
        if (Auth::user() && Auth::user()->type == 3) {
            $user_name = Auth::user()->name;
            $user_email = Auth::user()->email;
        } else {
            $user_name = session()->get('mdata')['user_name'];
            $user_email = session()->get('mdata')['user_email'];
        }
        $successurl = session()->get('mdata')['successurl'];

        $failure = session()->get('mdata')['failure'];
        return [
            'CustomerName'       =>  $user_name,
            'InvoiceValue'       => session()->get('mdata')['grand_total'],
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      =>  $user_email,
            'CallBackUrl'        => $successurl,
            'ErrorUrl'           => $failure,
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => '12345678',
            'Language'           => 'en',
            'CustomerReference'  => $orderId,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }

    //  api----------------------------------------------------------------
    public function myfattorahrequestapi(Request $request)
    {
        try {
            $mdata = $request->input();
            $mdata['successurl'] = "https://www.google.com/";
            $mdata['failure'] = "https://www.facebook.com/";
            session()->put('mdata', $mdata);

            $getkey = Payment::where('payment_type', '9')->where('vendor_id', $request->vendor_id)->first();

            if ($getkey->environment == 0) {
                $mode = false;
            } else {
                $mode = true;
            }
            $this->mfObj = new PaymentMyfatoorahApiV2($getkey->secret_key, $getkey->currency, $mode);

            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode
            $data            = $this->mfObj->getInvoiceURL($this->getPayLoadDataapi(), $paymentMethodId);

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $data['invoiceURL'], 'successurl' => session()->get('mdata')['successurl'], 'failureurl' => session()->get('mdata')['failure']], 200);
        } catch (\Exception $e) {
            $response = ['status' => 0, 'message' => trans('messages.wrong'), 200];
        }
        return response()->json($response);
    }

    private function getPayLoadDataapi($orderId = null)
    {
        return [
            'CustomerName'       => session()->get('mdata')['user_name'],
            'InvoiceValue'       => session()->get('mdata')['grand_total'],
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => session()->get('mdata')['user_email'],
            'CallBackUrl'        => session()->get('mdata')['successurl'],
            'ErrorUrl'           => session()->get('mdata')['failure'],
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => '12345678',
            'Language'           => 'en',
            'CustomerReference'  => $orderId,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }
}

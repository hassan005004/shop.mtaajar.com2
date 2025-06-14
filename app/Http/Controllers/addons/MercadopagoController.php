<?php



namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Settings;

class MercadopagoController extends Controller
{
    public function mercadorequest(Request $request)
    {
        try {
            $gettoken = Payment::where('payment_type', '7')->where('vendor_id', 1)->first();
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                "items": [
                    {
                        "title": "' . trans('labels.plan') . ' : ' . $request->plan_name . '",
                        "description": "' . $request->plan_description . '",
                        "quantity": 1,
                        "unit_price": ' . $request->amount . ',
                    }
                ],
                "payer": {
                    "name": "' . Auth::user()->name . '",
                    "email": "' . Auth::user()->email . '",
                },
                "payment_methods": {
                    "installments": 1
                },
                "back_urls": {
                    "success": "' . $request->successurl . '",
                    "failure": "' . $request->failureurl . '",
                    "pending": "' . $request->failureurl . '",
                },
                "auto_return" : "approved",
            }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $gettoken->secret_key . '',
                        'Content-Type: application/json'
                    ),
                )
            );
            $response = curl_exec($curl);
            curl_close($curl);
            $responseurl = json_decode($response);

            if ($gettoken->environment == 1) {
                $redirecturl = $responseurl->sandbox_init_point;
            }
            if ($gettoken->environment == 2) {
                $redirecturl = $responseurl->init_point;
            }

            session()->put('plan_id', $request->plan_id);
            session()->put('payment_type', 7);
            session()->put('amount', $request->amount);
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl], 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    // front--------------------------------------------------------
    public function mercadopagorequest(Request $request)
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

            $mdata = $request->input();
            $mdata['vendor_slug'] = $request->vendor_slug;

            session()->put('mdata', $mdata);
            $gettoken = Payment::where('payment_type', '7')->where('vendor_id', @$vdata)->first();
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                "items": [{
                    "title": "Item purchase",
                    "description": "Order Payment",
                    "quantity": 1,
                    "unit_price": ' . session()->get('mdata')['grand_total'] . ',
                }],
                "payer": {
                    "name": "' . session()->get('mdata')['user_name'] . '",
                    "email": "' . session()->get('mdata')['user_email'] . '",
                },
                "payment_methods": {
                    "installments": 1
                },
                "back_urls": {
                    "success": "' . $request->successurl . '",
                    "failure": "' . $request->failure . '",
                    "pending": "' . $request->failure . '",
                },
                "auto_return" : "approved",
            }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $gettoken->secret_key . '',
                        'Content-Type: application/json'
                    ),
                )
            );
            $response = curl_exec($curl);

            curl_close($curl);
            $responseurl = json_decode($response);

            if ($gettoken->environment == 1) {
                $redirecturl = $responseurl->sandbox_init_point;
            } else {
                $redirecturl = $responseurl->init_point;
            }

            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl], 200);
        } catch (\Throwable $th) {
            dd($th);
            return $th;
        }
    }

    // api--------------------------------------------------------
    public function mercadorequestapi(Request $request)
    {
        try {

            $mdata = $request->input();

            if ($request->grand_total == "") {
                return response()->json(['status' => 0, 'message' => trans('messages.grand_total_required')], 200);
            }

            $successurl = "https://www.google.com/";
            $failurl = "https://www.facebook.com/";

            session()->put('mdata', $mdata);
            $gettoken = Payment::where('payment_type', '7')->where('vendor_id', session()->get('mdata')['vendor_id'])->first();
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
            "items": [
                { 
                    "title": "Online Order",
                    "quantity": 1,
                    "unit_price": ' . session()->get('mdata')['grand_total'] . ',
                }
            ],
            "payer": {
                "name": "' . session()->get('mdata')['user_name'] . '",
                "email": "' . session()->get('mdata')['user_email'] . '",
            },
            "payment_methods": {
                "installments": 1
            },
            "back_urls": {
                "success": "' . $successurl . '",
                "failure": "' . $failurl . '",
                "pending": "' . $failurl . '",
            },
            "auto_return" : "approved",
        }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $gettoken->secret_key . '',
                        'Content-Type: application/json'
                    ),
                )
            );
            $response = curl_exec($curl);
            curl_close($curl);
            $responseurl = json_decode($response);

            if ($gettoken->environment == 1) {
                $redirecturl = $responseurl->sandbox_init_point;
            }
            if ($gettoken->environment == 2) {
                $redirecturl = $responseurl->init_point;
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'redirecturl' => $redirecturl, 'successurl' => $successurl, 'failureurl' => $failurl], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}

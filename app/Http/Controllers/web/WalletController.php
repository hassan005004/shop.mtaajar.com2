<?php

namespace App\Http\Controllers\web;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\SystemAddons;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;

class WalletController extends Controller
{
    public function wallet(Request $request)
    {
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

        if (empty($vendordata)) {
            abort(404);
        }
        if (
            SystemAddons::where('unique_identifier', 'customer_login')->first() != null &&
            SystemAddons::where('unique_identifier', 'customer_login')->first()->activated == 1
        ) {
            if (helper::appdata($vdata)->checkout_login_required == 1) {
                $gettransactions = Transaction::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(10);
                return view('web.user.wallet', compact('vendordata', 'gettransactions'));
            } else {
                abort(404);
            }
        }
    }

    public function addmoneywallet(Request $request)
    {
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

        if (empty($vendordata)) {
            abort(404);
        }
        if (
            SystemAddons::where('unique_identifier', 'customer_login')->first() != null &&
            SystemAddons::where('unique_identifier', 'customer_login')->first()->activated == 1
        ) {
            if (helper::appdata($vdata)->checkout_login_required == 1) {
                $getpaymentmethods = Payment::select('id', 'unique_identifier', 'environment', 'payment_name', 'payment_type', 'currency', 'public_key', 'secret_key', 'encryption_key', 'image')
                    ->whereNotIn('payment_type', array(1, 6, 16))->where('vendor_id', $vendordata->id)->where('is_available', 1)->where('is_activate', '1')->orderBy('reorder_id')->get();
                return view('web.user.addmoney', compact('vendordata', 'getpaymentmethods'));
            } else {
                abort(404);
            }
        }
    }

    public function addwallet(Request $request)
    {
        if (empty($request->transaction_type) && empty($request->amount)) {
            $userdata = Session::get('mdata');
            $amount = $userdata['grand_total'];
            $transaction_type = $userdata['transaction_type'];
        } else {
            Session::forget('mdata');
            $amount = $request->amount;
            $transaction_type = $request->transaction_type;
        }

        try {
            $checkuser = User::where('id', Auth::user()->id)->where('is_available', 1)->where('is_deleted', 2)->where('type', 3)->first();
            if (empty($checkuser)) {
                return response()->json(["status" => 0, "message" => trans('messages.invalid_user')], 200);
            }
            if ($transaction_type == "") {
                return response()->json(["status" => 0, "message" => trans('messages.payment_selection_required')], 200);
            }
            if ($amount == "") {
                return response()->json(["status" => 0, "message" => trans('messages.enter_amount')], 200);
            }
            if ($transaction_type == 3) {
                $getstripe = Payment::select('environment', 'secret_key', 'currency')->where('payment_type', 3)->where('vendor_id', $request->vendor_id)->first();
                $skey = $getstripe->secret_key;
                $token = $request->transaction_id;
                try {
                    Stripe\Stripe::setApiKey($skey);
                    $charge = Stripe\Charge::create([
                        'amount' => $amount * 100,
                        'currency' => $getstripe->currency,
                        'description' => 'Fashionhub',
                        'source' => $token,
                    ]);
                    $transaction_id = $charge['id'];
                } catch (\Throwable $th) {
                    dd($th);
                    return response()->json(['status' => 0, 'message' => trans('messages.unable_to_complete_payment')], 200);
                }
            } else {
                if ($request->transaction_id == "") {
                    return response()->json(["status" => 0, "message" => trans('messages.enter_transaction_id')], 200);
                }
                $transaction_id = $request->transaction_id;
            }
            $checkuser->wallet += $amount;
            $checkuser->save();
            // 2 = added-money-wallet-using- Razorpay 
            // 3 = added-money-wallet-using- Stripe 
            // 4 = added-money-wallet-using- Flutterwave 
            // 5 = added-money-wallet-using- Paystack
            // 7 = added-money-wallet-using- mercadopago
            // 8 = added-money-wallet-using- paypal
            // 9 = added-money-wallet-using- myfatoorah
            // 10 = added-money-wallet-using- toyyibpay
            // 11 = added-money-wallet-using- phonepe
            // 12 = added-money-wallet-using- paytab
            // 13 = added-money-wallet-using- mollie
            // 14 = added-money-wallet-using- khalti
            // 15 = added-money-wallet-using- xendit

            $transaction = new Transaction();
            $transaction->vendor_id = $checkuser->vendor_id;
            $transaction->user_id = $checkuser->id;
            $transaction->payment_id = $transaction_id;
            $transaction->payment_type = $transaction_type;
            $transaction->transaction_type = 1;
            $transaction->amount = $amount;
            $transaction->save();

            if ($transaction_type == 7 || $transaction_type == 8 || $transaction_type == 9 || $transaction_type == 10 || $transaction_type == 11 || $transaction_type == 12 || $transaction_type == 13 || $transaction_type == 14 || $transaction_type == 15) {
                return redirect(Session::get('mdata')['vendor_slug'] . '/' . 'wallet')->with('success', trans('messages.add_money_success'));
            }
            Session::forget('mdata');
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }


    public function addsuccess(Request $request)
    {
        try {
            if ($request->has('paymentId')) {
                $paymentId = request('paymentId');
                $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
            }
            if ($request->has('payment_id')) {
                $paymentId = request('payment_id');
                $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
            }

            if ($request->has('transaction_id')) {
                $paymentId = request('transaction_id');
                $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
            }
            if (session()->get('mdata')['transaction_type'] == "11") {
                if ($request->code == "PAYMENT_SUCCESS") {
                    $paymentId = $request->transactionId;
                    $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
                } else {
                    return redirect(Session::get('mdata')['vendor_slug'] . '/' . ' wallet')->with('error', trans('messages.unable_to_complete_payment'));
                }
            }
            if (session()->get('mdata')['transaction_type'] == "12") {
                $checkstatus = app('App\Http\Controllers\addons\PayTabController')->checkpaymentstatus(Session::get('mdata')['tran_ref'], Session::get('mdata')['vendor_id']);
                if ($checkstatus == "A") {
                    $paymentId = Session::get('mdata')['tran_ref'];
                    $response = ['status' => '1', 'msg' => 'paid', 'transaction_id' => $paymentId];
                } else {
                    return redirect(Session::get('mdata')['failureurl'])->with('error', session()->get('paytab_response'));
                }
            }


            if (session()->get('mdata')['transaction_type'] == "13") {
                $checkstatus = app('App\Http\Controllers\addons\MollieController')->checkpaymentstatus(Session::get('mdata')['tran_ref'], Session::get('mdata')['vendor_id']);

                if ($checkstatus == "A") {
                    $paymentId = Session::get('mdata')['tran_ref'];
                    $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
                } else {
                    return redirect(Session::get('mdata')['failureurl'])->with('error', session()->get('paytab_response'));
                }
            }

            if (session()->get('mdata')['transaction_type'] == "14") {

                if ($request->status == "Completed") {
                    $paymentId = $request->transaction_id;
                    $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
                } else {
                    return redirect(Session::get('mdata')['failureurl'])->with('error', session()->get('paytab_response'));
                }
            }

            if (session()->get('mdata')['transaction_type'] == "15") {

                $checkstatus = app('App\Http\Controllers\addons\XenditController')->checkpaymentstatus(Session::get('mdata')['tran_ref'], Session::get('mdata')['vendor_id']);

                if ($checkstatus == "PAID") {
                    $paymentId = Session::get('mdata')['payment_id'];
                    $response = ['status' => 1, 'msg' => 'paid', 'transaction_id' => $paymentId];
                } else {
                    return redirect(Session::get('mdata')['failureurl'])->with('error', session()->get('paytab_response'));
                }
            }
        } catch (\Exception $e) {
            $response = ['status' => 0, 'msg' => $e->getMessage()];
        }

        $request = new Request($response);
        return $this->addwallet($request);
    }

    public function addfail(Request $request)
    {
        if (count(request()->all()) > 0) {
            return redirect(Session::get('mdata')['vendor_slug'] . '/' . 'wallet')->with('error', trans('messages.unable_to_complete_payment'));
        } else {
            return redirect(Session::get('mdata')['vendor_slug'] . '/' . 'wallet');
        }
    }
}

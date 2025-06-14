<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Cart;
use App\Models\CustomStatus;
use App\Models\Payment;
use App\Models\Shippingarea;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Settings;
use App\Models\Products;
use App\Models\Promocode;
use App\Models\Variation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;
use DB;
use Config;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);

            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $user = Settings::where('custom_domain', $host)->first();
            $vendordata = User::where('id', $user->vendor_id)->first();

            $vdata = $vendordata->id;
        }
        if (empty($vendordata)) {
            abort(404);
        }
        $getcartlist = Cart::select('carts.*')
            ->leftjoin("tax", \DB::raw("FIND_IN_SET(tax.id,carts.tax)"), ">", \DB::raw("'0'"))
            ->where('carts.vendor_id', @$vdata);
        if (Auth::user() && Auth::user()->type == 3) {
            $getcartlist->where('carts.user_id', @Auth::user()->id);
        } else {
            $getcartlist->where('carts.session_id', Session::getId());
        }
        if ($request->buynow == 1) {
            $getcartlist = $getcartlist->where('carts.buynow', 1);
        } else {
            $getcartlist = $getcartlist->where('carts.buynow', 0);
        }
        $getcartlist = $getcartlist->get();
        if (@session()->get('discount_data')['vendor_id'] != @$vdata) {
            session()->forget('discount_data');
        }

        foreach ($getcartlist as $cart) {
            if ($cart->variation_id != "" && $cart->variation_id != null) {
                if (Auth::user() && Auth::user()->type == 3) {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $cart->variation_id)->where('user_id', Auth::user()->id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $cart->variation_id)->where('session_id', Session::getId())->first();
                }
                $variant = Variation::where('id', $cart->variation_id)->first();

                $item_name = Products::select('name')->where('id', $cart->product_id)->first();
                if ($variant->stock_management == 1) {

                    if ($variant->min_order != null && $variant->min_order != ""  && $variant->min_order != 0) {
                        if ($cartqty->totalqty < $variant->min_order) {
                            return redirect()->back()->with('error', trans('messages.min_qty_message') . $variant->min_order . " " . ($item_name->name));
                        }
                    }
                    if ($variant->max_order != null && $variant->max_order != "" && $variant->max_order != 0) {
                        if ($variant->max_order < $cartqty->totalqty) {
                            return redirect()->back()->with('error', trans('messages.max_qty_message') . $variant->max_order . ' ' . ($item_name->name));
                        }
                    }
                    if ($cart->qty > $variant->qty) {
                        return redirect()->back()->with('error', trans('messages.cart_qty_msg') . ' ' . trans('labels.out_of_stock_msg') . ' ' . $item_name->name . '(' . $variant->name . ')');
                    }
                }
            } else {

                $item = Products::where('id', $cart->product_id)->first();
                if (Auth::user() && Auth::user()->type == 3) {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $cart->product_id)->where('user_id', Auth::user()->id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $cart->product_id)->where('session_id', Session::getId())->first();
                }

                if ($item->stock_management == 1) {
                    if ($item->min_order != null && $item->min_order != ""  && $item->min_order != 0) {
                        if ($cartqty->totalqty < $item->min_order) {
                            return redirect()->back()->with('error', trans('messages.min_qty_message') . $item->min_order . ' ' . ($item->name));
                        }
                    }

                    if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                        if ($item->max_order < $cartqty->totalqty) {
                            return redirect()->back()->with('error', trans('messages.max_qty_message') . $item->max_order . ' ' . ($item->name));
                        }
                    }
                    if ($cart->qty > $item->qty) {
                        return redirect()->back()->with('error',  trans('messages.cart_qty_msg') . ' ' . trans('labels.out_of_stock_msg') . ' ' . $item->name);
                    }
                }
            }
        }
        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];
        foreach ($getcartlist as $cart) {

            $taxlist =  helper::gettax($cart->product_tax);

            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->product_price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->product_price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }

        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;
        if (Auth::user()) {
            if (helper::allpaymentcheckaddons($vendordata->id)) {
                $getpaymentmethodslist = Payment::where('is_available', 1)->where('vendor_id', @$vdata)->where('is_activate', 1)->orderBy('reorder_id')->get();
            } else {
                $getpaymentmethodslist = Payment::where('is_available', 1)->where('vendor_id', @$vdata)->whereNotIn('payment_type', ['16'])->where('is_activate', 1)->orderBy('reorder_id')->get();
            }
        } else {
            $getpaymentmethodslist = Payment::where('is_available', 1)->where('vendor_id', @$vdata)->whereNotIn('payment_type', ['16'])->where('is_activate', 1)->orderBy('reorder_id')->get();
        }
        $getshippingarealist = Shippingarea::where('vendor_id', @$vdata)->where('is_available', 1)->orderBy('reorder_id')->get();
        return view('web.checkout.index', compact('vendordata', 'getcartlist', 'getpaymentmethodslist', 'getshippingarealist', 'itemtaxes', 'taxArr'));
    }
    public function ordersuccess(Request $request)
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
        $order_number = $request->order_number;
        $checkorderdata = Order::where('vendor_id', @$vdata)->where('order_number', $order_number)->first();
        $whmessage = helper::whatsappmessage($order_number, $request->vendor_slug, $vendordata);
        if (empty($checkorderdata)) {
            abort(404);
        }
        return view('web.orders.success', compact('vendordata', 'order_number', 'whmessage', 'vdata'));
    }
    public function orderdetails(Request $request)
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
        $order_number = $request->order;
        $getorderdata = Order::where('vendor_id', @$vdata)->where('order_number', $request->order)->first();

        $getorderitemlist = OrderDetails::where('order_id', @$getorderdata->id)->get();
        return view('web.orders.order_details', compact('vendordata', 'getorderdata', 'getorderitemlist', 'order_number'));
    }
    public function cancelorder(Request $request)
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
        $getorderdata = Order::where('vendor_id', @$vdata)->where('order_number', $request->order_number)->first();
        if (empty($getorderdata)) {
            abort(404);
        }
        if ($getorderdata->status_type == 2) {
            return redirect()->back()->with('error', trans('messages.already_accepted'));
        } else if ($getorderdata->status_type == 4) {
            return redirect()->back()->with('error', trans('messages.already_rejected'));
        } else if ($getorderdata->status_type == 3) {
            return redirect()->back()->with('error', trans('messages.already_delivered'));
        }
        $defaultsatus = CustomStatus::where('vendor_id', $getorderdata->vendor_id)->where('order_type', $getorderdata->order_type)->where('type', 4)->where('is_available', 1)->where('is_deleted', 2)->first();
        if (empty($defaultsatus) && $defaultsatus == null) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        } else {
            $getorderdata->status_type = $defaultsatus->type;
            $getorderdata->status = $defaultsatus->id;
            $getorderdata->update();
            $orderdetail = OrderDetails::where('order_id', $getorderdata->id)->where('vendor_id', $getorderdata->vendor_id)->get();
            foreach ($orderdetail as $orders) {
                if ($orders->variation_id != null && $orders->variation_id != "") {
                    $item = Variation::where('id', $orders->variation_id)->where('product_id', $orders->product_id)->first();
                } else {
                    $item = Products::where('id', $orders->product_id)->where('vendor_id', $orders->vendor_id)->first();
                }
                $item->qty = $item->qty + $orders->qty;
                $item->update();
            }
            if (helper::appdata($vdata)->product_type == 1) {
                $title = helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name;
            } else {
                $title = "{{trans('labels.order_cancelled')}}";
            }
            $title = helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name;
            $message_text = 'Order ' . $getorderdata->order_number . ' has been cancelled by ' . $getorderdata->user_name;
            $emaildata = helper::emailconfigration($vdata);
            Config::set('mail', $emaildata);
            helper::cancel_order($vendordata->email, $vendordata->name, $title, $message_text, $getorderdata);
            return redirect($request->vendor_slug . '/find-order?order=' . $request->order_number)->with('success', trans('messages.success'));
        }
    }
    public function orderlimit(Request $request)
    {
        // PASS SECOND PARAM 3 WHEN CHECKING HELPER FROM WEB END PASS IS BLANK --> ''

        $checkplan = helper::checkplan($request->vendor_id, 3);
        $v = json_decode(json_encode($checkplan));
        if (@$v->original->status == 2) {
            return response()->json(['status' => 0, 'message' => @$v->original->message], 200);
        }
    }
    public function placeorder(Request $request)
    {

        try {
            $transaction_id = $request->transaction_id;
            $filename = "";
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
            if (Auth::user() && Auth::user()->type == 3) {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->name;
                $user_email = Auth::user()->email;
                $user_mobile = Auth::user()->mobile;
            } else {
                $user_id = 0;
                $user_name = $request->user_name;
                $user_email = $request->user_email;
                $user_mobile = $request->user_mobile;
            }
            if (Auth::user() && Auth::user()->type == 3) {
                $checkuser = User::where('is_available', 1)->where('vendor_id', $vdata)->where('id', Auth::user()->id)->first();
                if ($request->transaction_type == 16) {
                    if ($checkuser->wallet == "" || ($checkuser->wallet < $request->grand_total)) {
                        return response()->json(['status' => 0, 'message' => trans('messages.insufficient_wallet')], 200);
                    }
                }
            }
            if ($request->transaction_type == '3') {
                try {
                    $stripekey = helper::stripe_data($vdata)->secret_key;
                    Stripe\Stripe::setApiKey($stripekey);
                    $charge = Stripe\Charge::create([
                        'amount' => $request->grand_total * 100,
                        'currency' => helper::stripe_data($vdata)->currency,
                        "description" => "Ecom-SAAS-OrderPayment",
                        'source' => $request->transaction_id,
                    ]);

                    if ($request->transaction_id == "") {
                        $transaction_id = $charge->id;
                    } else {
                        $transaction_id = $request->transaction_id;
                    }
                } catch (\Exception $th) {
                    return response()->json(['status' => 0, 'message' => trans('messages.unable_to_complete_payment')], 200);
                }
            }

            if (helper::appdata($vdata)->product_type == 1) {
                $order_type = 1;
            } else {
                $order_type = 5;
            }


            if ($request->modal_transaction_type == '6') {
                if ($request->hasFile('screenshot')) {
                    $validator = Validator::make($request->all(), [
                        'screenshot' => 'image|mimes:jpg,jpeg,png',
                    ], [
                        'screenshot.mage' => trans('messages.enter_image_file'),
                        'screenshot.mimes' => trans('messages.valid_image'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    } else {
                        $filename = 'screenshot-' . uniqid() . "." . $request->file('screenshot')->getClientOriginalExtension();
                        $request->file('screenshot')->move(env('ASSETPATHURL') . 'admin-assets/images/screenshot/', $filename);
                    }
                }
                $transaction_id = "";
                $data = helper::createorder($request->modal_vendor_slug, "", $user_id, $request->modal_user_name, $request->modal_user_email, $request->modal_user_mobile, 6, $transaction_id, $request->modal_billing_address, $request->modal_billing_landmark, $request->modal_billing_postal_code, $request->modal_billing_city, $request->modal_billing_state, $request->modal_billing_country, $request->modal_shipping_address, $request->modal_shipping_landmark, $request->modal_shipping_postal_code, $request->modal_shipping_city, $request->modal_shipping_state, $request->modal_shipping_country, $request->modal_shipping_area, $request->modal_delivery_charge, $request->modal_grand_total, $request->modal_sub_total, $request->modal_tax, $request->modal_tax_name, $request->modal_notes, $request->modal_offer_code, $request->modal_offer_amount, $filename, $order_type);

                if ($data == false) {
                    return redirect()->back()->with('error', trans('messages.order_default_status_message'));
                }
                $data = json_decode(json_encode($data), true);

                session()->forget(['offer_amount', 'offer_code', 'offer_type']);

                return redirect($request->modal_vendor_slug . '/orders-success-' . $data['original']['order_number'])->with('success', trans('messages.success'));
            } else {
                $data = helper::createorder($request->vendor_slug, "", $user_id, $user_name, $user_email, $user_mobile, $request->transaction_type, $transaction_id, $request->billing_address, $request->billing_landmark, $request->billing_postal_code, $request->billing_city, $request->billing_state, $request->billing_country, $request->shipping_address, $request->shipping_landmark, $request->shipping_postal_code, $request->shipping_city, $request->shipping_state, $request->shipping_country, $request->shipping_area, $request->delivery_charge, $request->grand_total, $request->sub_total, $request->tax_amount, $request->tax_name, $request->notes, $request->offer_code, $request->offer_amount, $filename, $order_type);
                $data = json_decode(json_encode($data), true);

                if ($data == false) {
                    return redirect()->back()->with('error', trans('messages.order_default_status_message'));
                }
                session()->forget(['offer_amount', 'offer_code', 'offer_type']);

                return response()->json(['status' => 1, 'order_number' => $data['original']['order_number'], $data['original']], 200);
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function paymentrequestsuccess(Request $request)
    {
        try {
            if (session()->has('mdata')) {
                if (Auth::user() && Auth::user()->type == 3) {
                    $user_id = Auth::user()->id;
                    $user_name = Auth::user()->name;
                    $user_email = Auth::user()->email;
                    $user_mobile = Auth::user()->mobile;
                } else {
                    $user_id = 0;
                    $user_name = session()->get('mdata')['user_name'];
                    $user_email = session()->get('mdata')['user_email'];
                    $user_mobile = session()->get('mdata')['user_mobile'];
                }
                $paymentid = "";
                if (@$request->paymentId != "") {
                    $paymentid = $request->paymentId;
                }
                if (@$request->payment_id != "") {
                    $paymentid = $request->payment_id;
                }
                if (@$request->transaction_id != "") {
                    $paymentid = $request->transaction_id;
                }

                if (session()->get('mdata')['transaction_type'] == "11") {
                    if ($request->code == "PAYMENT_SUCCESS") {
                        $paymentid = $request->transactionId;
                    }
                }

                if (session()->get('mdata')['transaction_type'] == "12") {
                    $checkstatus = app('App\Http\Controllers\addons\PayTabController')->checkpaymentstatus(session()->get('mdata')['tran_ref'], session()->get('mdata')['vendor_id']);

                    if ($checkstatus == "A") {
                        $paymentid = session()->get('mdata')['tran_ref'];
                    } else {
                        return redirect(session()->get('mdata')['failureurl'])->with('error', trans('messages.wrong'));
                    }
                }

                if (session()->get('mdata')['transaction_type'] == "13") {
                    $checkstatus = app('App\Http\Controllers\addons\MollieController')->checkpaymentstatus(session()->get('mdata')['tran_ref'], session()->get('mdata')['vendor_id']);

                    if ($checkstatus == "A") {
                        $paymentid = session()->get('mdata')['tran_ref'];
                    } else {
                        return redirect(session()->get('mdata')['failureurl'])->with('error', trans('messages.wrong'));
                    }
                }

                if (session()->get('mdata')['transaction_type'] == "14") {
                    if ($request->status == "Completed") {
                        $paymentid = $request->transaction_id;
                    } else {
                        return redirect(session()->get('mdata')['failureurl'])->with('error', trans('messages.wrong'));
                    }
                }

                if (session()->get('mdata')['transaction_type'] == "15") {

                    $checkstatus = app('App\Http\Controllers\addons\XenditController')->checkpaymentstatus(session()->get('mdata')['tran_ref'], session()->get('mdata')['vendor_id']);

                    if ($checkstatus == "PAID") {
                        $paymentid = session()->get('mdata')['payment_id'];
                    } else {
                        return redirect(session()->get('mdata')['failureurl'])->with('error', trans('messages.wrong'));
                    }
                }

                $user = User::where('slug', session()->get('mdata')['vendor_slug'])->where('is_available', 1)->where('is_deleted', 2)->first();

                if (helper::appdata($user->id)->product_type == 1) {
                    $order_type = 1;
                } else {
                    $order_type = 5;
                }

                $billing_address = session()->get('mdata')['billing_address'];
                $billing_landmark = session()->get('mdata')['billing_landmark'];
                $billing_postal_code = session()->get('mdata')['billing_postal_code'];
                $billing_city = session()->get('mdata')['billing_city'];
                $billing_state = session()->get('mdata')['billing_state'];
                $billing_country = session()->get('mdata')['billing_state'];
                $shipping_address = session()->get('mdata')['shipping_address'];
                $shipping_landmark = session()->get('mdata')['shipping_landmark'];
                $shipping_postal_code = session()->get('mdata')['shipping_postal_code'];
                $shipping_city = session()->get('mdata')['shipping_city'];
                $shipping_state = session()->get('mdata')['shipping_state'];
                $shipping_country = session()->get('mdata')['shipping_country'];
                $shipping_area = session()->get('mdata')['shipping_area'];
                $delivery_charge = session()->get('mdata')['delivery_charge'];

                $data = helper::createorder(session()->get('mdata')['vendor_slug'], "", $user_id, $user_name, $user_email, $user_mobile, session()->get('mdata')['transaction_type'], $paymentid, $billing_address, $billing_landmark, $billing_postal_code, $billing_city, $billing_state, $billing_country, $shipping_address, $shipping_landmark, $shipping_postal_code, $shipping_city, $shipping_state, $shipping_country, $shipping_area, $delivery_charge, session()->get('mdata')['grand_total'], session()->get('mdata')['sub_total'], session()->get('mdata')['tax_amount'], session()->get('mdata')['tax_name'], session()->get('mdata')['notes'], session()->get('mdata')['offer_code'], session()->get('mdata')['offer_amount'], '', $order_type);
                if ($data == false) {
                    return redirect()->back()->with('error', trans('order not placed without default status !!'));
                }
                $data = json_decode(json_encode($data), true);
                session()->forget('mdata');
                return redirect()->to(@$data['original']['successurl']);
            }
        } catch (\Throwable $th) {
            dd($th);
            return $th;
        }
    }
    public function copycode(Request $request)
    {
        $remove = session()->forget(['offer_amount', 'offer_code', 'offer_type']);
        if (!$remove) {
            return response()->json(['status' => 1, 'message' => 'success', 'element' => $request->code], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    public function applypromocode(Request $request)
    {

        if ($request->promocode == "") {
            return response()->json(["status" => 0, "message" => trans('messages.enter_promocode')], 200);
        }
        $promocode = Promocode::select('offer_amount', 'offer_type', 'offer_code', 'min_amount')->where('offer_code', $request->promocode)->where('vendor_id', $request->vendor_id)->first();
        if ($request->sub_total < @$promocode->min_amount) {
            return response()->json(["status" => 0, "message" => trans('messages.not_eligible')], 200);
        }

        $offer_amount = $promocode->offer_amount;
        // if ($promocode->offer_type == 2) {
        //     $offer_amount = $request->sub_total * $promocode->offer_amount / 100;
        // }
        session([
            'offer_amount' => @$offer_amount,
            'offer_code' => @$promocode->offer_code,
            'offer_type' => @$promocode->offer_type,
        ]);
        if (@$promocode->offer_code == $request->promocode) {

            return response()->json(['status' => 1, 'message' => trans('messages.promocode_applied'), 'data' => $promocode], 200);
        } else {

            return response()->json(['status' => 0, 'message' => trans('messages.wrong_promocode')], 200);
        }
    }
    public function removepromocode(Request $request)
    {
        $remove = session()->forget(['offer_amount', 'offer_code', 'offer_type']);
        if (!$remove) {
            return response()->json(['status' => 1, 'message' => trans('messages.promocode_removed')], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}

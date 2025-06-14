<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\CustomStatus;
use App\Models\Payment;
use App\Models\Products;
use App\Models\Variation;
use App\Models\OrderDetails;
use App\Models\SystemAddons;
use Illuminate\Support\Facades\DB;
use Stripe;
use Config;

class OrderController extends Controller
{
    public function placeorder(Request $request)
    {
        try {
            $transaction_id = $request->transaction_id;
            if ($request->vendor_id == "") {
                return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
            }
            if ($request->user_name == "") {
                return response()->json(["status" => 0, "message" => trans('messages.user_name_required')], 400);
            }
            if ($request->user_email == "") {
                return response()->json(["status" => 0, "message" => trans('messages.user_email_required')], 400);
            }
            if ($request->user_mobile == "") {
                return response()->json(["status" => 0, "message" => trans('messages.user_mobile_required')], 400);
            }
            if ($request->transaction_type == "") {
                return response()->json(["status" => 0, "message" => trans('messages.transaction_type_required')], 400);
            }
            if ($request->billing_address == "") {
                return response()->json(["status" => 0, "message" => trans('messages.billing_address_required')], 400);
            }
            if ($request->billing_landmark == "") {
                return response()->json(["status" => 0, "message" => trans('messages.billing_landmark_required')], 400);
            }
            if ($request->billing_postal_code == "") {
                return response()->json(["status" => 0, "message" => trans('messages.billing_postal_code_required')], 400);
            }
            if ($request->billing_city == "") {
                return response()->json(["status" => 0, "message" => trans('messages.billing_city_required')], 400);
            }
            if ($request->billing_state == "") {
                return response()->json(["status" => 0, "message" => trans('messages.billing_state_required')], 400);
            }
            if ($request->billing_country == "") {
                return response()->json(["status" => 0, "message" => trans('messages.billing_country_required')], 400);
            }
            if ($request->shipping_address == "") {
                return response()->json(["status" => 0, "message" => trans('messages.shipping_address_required')], 400);
            }
            if ($request->shipping_landmark == "") {
                return response()->json(["status" => 0, "message" => trans('messages.shipping_landmark_required')], 400);
            }
            if ($request->shipping_postal_code == "") {
                return response()->json(["status" => 0, "message" => trans('messages.shipping_postal_code_required')], 400);
            }
            if ($request->shipping_city == "") {
                return response()->json(["status" => 0, "message" => trans('messages.shipping_city_required')], 400);
            }
            if ($request->shipping_state == "") {
                return response()->json(["status" => 0, "message" => trans('messages.shipping_state_required')], 400);
            }
            if ($request->shipping_country == "") {
                return response()->json(["status" => 0, "message" => trans('messages.shipping_country_required')], 400);
            }
            if ($request->delivery_charge == "") {
                return response()->json(["status" => 0, "message" => trans('messages.delivery_charge_required')], 400);
            }
            if ($request->grand_total == "") {
                return response()->json(["status" => 0, "message" => trans('messages.grand_total_required')], 400);
            }
            if ($request->sub_total == "") {
                return response()->json(["status" => 0, "message" => trans('messages.sub_total_required')], 400);
            }
           
    
            if ($request->transaction_type == "3") {
                $stripekey = helper::stripe_data($request->vendor_id)->secret_key;
                $stripe = new \Stripe\StripeClient($stripekey);
                $gettoken = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->card_number,
                        'exp_month' => $request->card_exp_month,
                        'exp_year' => $request->card_exp_year,
                        'cvc' => $request->card_cvc,
                    ],
                ]);
                Stripe\Stripe::setApiKey($stripekey);
                $payment = Stripe\Charge::create([
                    "amount" => $request->grand_total * 100,
                    "currency" => helper::stripe_data($request->vendor_id)->currency,
                    "source" => $gettoken->id,
                    "description" => "Ecom-SAAS-OrderPayment",
                ]);
                $transaction_id = $payment->id;
            }
            $filename = "";
            if ($request->transaction_type == "6") {
                if ($request->screenshot != "") {
                    $filename = 'screenshot-' . uniqid() . "." . $request->file('screenshot')->getClientOriginalExtension();
                    $request->file('screenshot')->move(env('ASSETPATHURL') . 'admin-assets/images/screenshot/', $filename);
                }
                $transaction_id = "";
            }
            if(helper::appdata($request->vendor_id)->product_type == 1)
            {
                $order_type = 1;
            }else{
                $order_type= 4;
            }
            $vendordata = User::where('id', $request->vendor_id)->first();
            $data = helper::createorder($vendordata->slug, $request->session_id, $request->user_id, $request->user_name, $request->user_email, $request->user_mobile, $request->transaction_type, $transaction_id, $request->billing_address, $request->billing_landmark, $request->billing_postal_code, $request->billing_city, $request->billing_state, $request->billing_country, $request->shipping_address, $request->shipping_landmark, $request->shipping_postal_code, $request->shipping_city, $request->shipping_state, $request->shipping_country, $request->delivery_charge, $request->grand_total, $request->sub_total, $request->tax_amount,$request->tax_name, $request->notes, $request->offer_code, $request->offer_amount, $filename,$order_type);
            $data = json_decode(json_encode($data), true);
            if ($data['original']['status'] == 1) {
                if (SystemAddons::where('unique_identifier', 'whatsapp_message')->first() != null && SystemAddons::where('unique_identifier', 'whatsapp_message')->first()->activated == 1) {
                    $whmessage = helper::whatsappmessage($data['original']['order_number'], $vendordata->slug, $vendordata);
                    $whatsapp_number = helper::appdata($vendordata->id)->whatsapp_number;
                } else {
                    $whmessage = "";
                    $whatsapp_number = "";
                }
                if (SystemAddons::where('unique_identifier', 'firebase_notification')->first() != null && SystemAddons::where('unique_identifier', 'firebase_notification')->first()->activated == 1)
                {
                    $vendortitle = trans('labels.order_placed');
                    $vendorbody = trans('messages.new_order_arrive') . ' #' . $data['original']['order_number'];
                    $vendordata = User::where('id', $request->vendor_id)->first();
                    helper::push_notification($vendordata->token, $vendortitle, $vendorbody, "order", $data['original']['order_number'], @helper::appdata('')->firebase);
                    
                    // customer notification
                    if($request->user_id != "" && $request->user_id != null)
                    {
                        $customertitle = trans('labels.order_placed');
                        $customerbody = trans('messages.order_placed') . ' #' . $data['original']['order_number'];
                        $customer = User::where('id', $request->user_id)->first();
                        helper::push_notification($customer->token, $customertitle, $customerbody, "order", $data['original']['order_number'], helper::appdata($request->vendor_id)->firebase);
                    }
                    // vendor notification
                }
                return response()->json(["status" => 1, "message" => trans('messages.success'), 'whmessage' => $whmessage, "whatsapp_number" => $whatsapp_number, 'order_number' => $data['original']['order_number']], 200);
            } else {
                return response()->json(["status" => 0, "message" => $data['original']['message']], 200);
            }
        } catch (\Throwable $th) {
           
        }
        

    }
    public function orderhistory(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
        }
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 400);
        }
        if(helper::appdata($request->vendor_id)->online_order == 1)
        {
            $orders = Order::select("orders.id","orders.order_number","orders.grand_total","orders.order_type","orders.status","orders.status_type",DB::raw('DATE_FORMAT(orders.created_at, "%d-%m-%Y") as order_date'),'custom_status.name as status_name','orders.payment_status','orders.transaction_type','payment.payment_name')->join('custom_status','custom_status.id','orders.status')->join("payment",function($join){
                $join->on("payment.vendor_id","=","orders.vendor_id")
                    ->on("payment.payment_type","=","orders.transaction_type");
            })->where('orders.vendor_id',$request->vendor_id)->orderByDesc('orders.id')->get();
        }else{
            $orders = Order::select("orders.id","orders.order_number","orders.grand_total","orders.order_type","orders.status","orders.status_type",DB::raw('DATE_FORMAT(orders.created_at, "%d-%m-%Y") as order_date'),'payment.payment_name')->join('payment','payment.vendor_id','orders.vendor_id')->where('orders.vendor_id',$request->vendor_id)->orderByDesc('orders.id')->get();
        }

        // $orders = Order::select("id", "order_number", "grand_total", "transaction_type", "status", DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as order_date'))->where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->orderByDesc('id')->get();

        // foreach($orders as $paymentname)
        // {
        //     $paymentname->payment_name = helper::getpayment($paymentname->transaction_type, $request->vendor_id)->payment_name;
        // }

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $orders], 200);
    }
    public function orderdetails(Request $request)
    {
        if ($request->vendor_id == "") {

            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
        }
        if ($request->order_number == "") {
            return response()->json(["status" => 0, "message" => trans('messages.order_number_required')], 400);
        }
        $orders = Order::where('vendor_id',$request->vendor_id)->where("order_number",$request->order_number)->orderByDesc('id');
        $order =  $orders->select("id","order_number","user_name","user_email","user_mobile","grand_total","sub_total","offer_code","offer_amount","tax_amount","delivery_charge","transaction_id","transaction_type","status",DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as order_date'),"notes","status_type","order_type","transaction_type","payment_status","vendor_note","tax_name",DB::raw("CONCAT('".url(env('ASSETPATHURL').'admin-assets/images/screenshot/')."/', screenshot) AS screenshot"))->first();
        $biilinginfo = $orders->select("billing_address","billing_landmark","billing_postal_code","billing_city","billing_state","billing_country")->first();
        $shippinginfo = $orders->select("shipping_address","shipping_landmark","shipping_postal_code","shipping_city","shipping_state","shipping_country")->first();
        $order_detail = OrderDetails::select("id","order_id","product_id","product_name",DB::raw("CONCAT('".url(env('ASSETPATHURL').'admin-assets/images/product/')."/', product_image) AS product_image"),"attribute","variation_id","variation_name","product_price","product_tax","qty","extras_id","extras_name","extras_price")->where('order_id',$order->id)->get();
        $custom_status = CustomStatus::where('vendor_id', $request->vendor_id)->where('order_type', $order->order_type)->where('type', $order->status_type)->where('id', $order->status)->first();
        $payment = Payment::where('vendor_id', $request->vendor_id)->where('payment_type',$order->transaction_type)->first();
       
        if ($order->transaction_type == 0) {
            $payment_name = trans('labels.offline');
        } else {
            $payment_name = $payment->payment_name;
        }
        $statuslist = CustomStatus::where('vendor_id', $request->vendor_id)->where('is_available',1)->where('is_deleted',2)->where('order_type',$order->order_type)->orderBy('reorder_id')->get();
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $order, 'ordrdetail' => $order_detail, "biilinginfo" => $biilinginfo, "shippinginfo" => $shippinginfo,'payment_name'=>$payment_name,'status_name'=>$custom_status->name,'custom_status'=>$statuslist], 200);
    }

    public function cancelorder(Request $request)
    {
        if ($request->order_number == "") {
            return response()->json(["status" => 0, "message" => trans('messages.order_number_required')], 200);
        }
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $order = Order::where('order_number', $request->order_number)->where('vendor_id',$request->vendor_id)->first();
        $orderdetail = OrderDetails::where('order_id', $order->id)->get();
        $storeinfo = User::where('id', $order->vendor_id)->first();
        $defaultsatus = CustomStatus::where('vendor_id', $order->vendor_id)->where('order_type', $order->order_type)->where('type', 4)->where('is_available', 1)->where('is_deleted', 2)->first();
        if (helper::appdata($storeinfo->id)->product_type == 1) {
            if (empty($defaultsatus) && $defaultsatus == null) {
               
                return response()->json(['status' => 0, 'message' => trans('messages.not_cancel_order')], 200);
            } else {
              
                if ($order->status_type == 1 || $order->status_type == 2) {
                    
                    $order->status_type = 4;
                    if (helper::appdata($storeinfo->id)->product_type == 1) {
                        $order->status = $defaultsatus->id;
                    }
                    $order->update();
                    foreach ($orderdetail as $orders) {
                        if ($orders->variation_id != null && $orders->variation_id != "") {
                            $item = Variation::where('id', $orders->variation_id)->where('product_id', $orders->product_id)->first();
                        } else {
                            $item = Products::where('id', $orders->product_id)->where('vendor_id', $storeinfo->id)->first();
                        }
                        $item->qty = $item->qty + $orders->qty;
                        $item->update();
                    }
                    if (helper::appdata($storeinfo->id)->product_type == 1) {
                        $title = helper::gettype($order->status, $order->status_type, $order->order_type, $order->vendor_id)->name;
                    } else {
                        $title = "{{trans('labels.order_cancelled')}}";
                    }
                    $message_text = 'Order ' . $order->order_number . ' has been cancelled by' . $order->user_name;
                    $emaildata = helper::emailconfigration($order->vendor_id);
                    Config::set('mail', $emaildata);
                    // Order::where('order_number', $order_number)->update(['status_type' => "4"]);
                    $checkmail = helper::cancel_order($storeinfo->email, $storeinfo->name, $title, $message_text, $order);
                    $emaildata = User::select('id', 'name', 'slug', 'email', 'mobile', 'token')->where('id', $order->vendor_id)->first();
                    $body = "#" . $order->order_number . " has been cancelled";
                    helper::push_notification($emaildata->token, $title, $body, "order", $request->order_number,helper::appdata($request->vendor_id)->firebase);
                    return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.not_cancel_order')], 200);
                }
            }
        } else {
            if ($order->payment_status == 1) {
                $order->status_type = 4;
                $order->update();
                if (helper::appdata($storeinfo->id)->product_type == 1) {
                    $title = helper::gettype($order->status, $order->status_type, $order->order_type, $order->vendor_id)->name;
                } else {
                    $title = "{{trans('labels.order_cancelled')}}";
                }
                $message_text = 'Order ' . $order->order_number . ' has been cancelled by' . $order->user_name;
                $emaildata = helper::emailconfigration($order->vendor_id);
                Config::set('mail', $emaildata);
                // Order::where('order_number', $order_number)->update(['status_type' => "4"]);
                $checkmail = helper::cancel_order($storeinfo->email, $storeinfo->name, $title, $message_text, $order);
                $emaildata = User::select('id', 'name', 'slug', 'email', 'mobile', 'token')->where('id', $order->vendor_id)->first();
                $body = "#" . $order->order_number . " has been cancelled";
                helper::push_notification($emaildata->token, $title, $body, "order", $request->order_number,helper::appdata($request->vendor_id)->firebase);
                return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
            }
        }
    }

    // public function cancelorder(Request $request)
    // {
    //     if ($request->order_number == "") {
    //         return response()->json(["status" => 0, "message" => trans('messages.order_number_required')], 400);
    //     }
    //     if ($request->user_id == "") {
    //         return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 400);
    //     }
    //     $order = Order::where('order_number', $request->order_number)->first();
    //     if ($order->status == 1 || $order->status == 2) {
    //         $order->status = 4;
    //         $order->update();

    //         // vendor notification for order cancel
    //         $vendortitle = trans('labels.order_calcelled');
    //         $vendorbody = trans('messages.order_calcelled_by_user') . ' #' . $order->vendor_id;
    //         $vendordata = User::where('id', $order->vendor_id)->first();
    //         helper::push_notification($vendordata->token, $vendortitle, $vendorbody, "order", $order->vendor_id, @helper::appdata('')->firebase);

    //         // customer notification for order cancel
    //         $customertitle = trans('labels.order_calcelled');
    //         $customerbody = trans('messages.order_calcelled') . ' #' . $request->order_number;
    //         $customer = User::where('id', $request->user_id)->first();
    //         helper::push_notification($customer->token, $customertitle, $customerbody, "order", $request->order_number, helper::appdata($request->vendor_id)->firebase);
    //         return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    //     } else {
    //         return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 400);
    //     }
    // }
    public function qtycheckurl(Request $request)
    {
       
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->buynow == "") {
            return response()->json(["status" => 0, "message" => trans('messages.buynow_required')], 200);
        }
        try {
            $cartitems = Cart::select('carts.id', 'carts.product_id', 'carts.product_name', 'carts.product_image', 'carts.product_price', 'carts.extras_name', 'carts.extras_price', 'carts.qty','carts.product_tax', 'carts.variation_id', 'carts.variation_name', \DB::raw("GROUP_CONCAT(tax.name) as name"))
                ->leftjoin("tax", \DB::raw("FIND_IN_SET(tax.id,carts.product_tax)"), ">", \DB::raw("'0'"), DB::raw('SUM((qty)*(product_price)) AS sub_total'))
                ->where('carts.vendor_id', $request->vendor_id);
            if ($request->user_id != null && $request->user_id != "") {
                $cartitems->where('carts.user_id', $request->user_id);
                if($request->buynow == 0)
                {
                    $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->where('buynow',0)->first();
                }else{
                    $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->where('buynow',1)->first();
                }
            } else {
                if($request->buynow == 0)
                {
                    $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id)->where('buynow',0)->first();
                }else{
                    $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id)->where('buynow',1)->first();
                }
                
                $cartitems->where('carts.session_id', $request->session_id);
            }
            if($request->buynow == 0)
            {
                $cartitems->where('buynow',0);
            }else{
                $cartitems->where('buynow',1);
            }
            $cartdata = $cartitems->groupBy("carts.id")->get();
            
            $qtyexist = 0;
            $itemtaxes = [];
            $producttax = 0;
            $tax_name = [];
            $tax_price = [];
            $taxArr = [];
            if($cartdata->count() > 0)
            {
                foreach ($cartdata as $cart) {
                    $taxlist =  helper::gettax($cart->product_tax);
                    if (!empty($taxlist)) {
                        foreach ($taxlist as $tax) {
                            if (!empty($tax)) {
                                $producttax = helper::taxRate($tax->tax, $cart->product_price, $cart->qty, $tax->type);
                                $itemTax['tax_name'] = $tax->name;
                                $itemTax['tax'] = $tax->tax;
                                $itemTax['tax_rate'] = $producttax;
                                $itemtaxes[] = $itemTax;
                                if (!in_array($tax->name, $tax_name)) {
                                    $tax_name[] = $tax->name;
                                    if ($tax->type == 1) {
                                        $price = number_format($tax->tax * $cart->qty,2);
                                    }
                                    if ($tax->type == 2) {
                                        $price = number_format(($tax->tax / 100) * ($cart->product_price),2);
                                    }
                                    $tax_price[] = $price;
                                } else {
                                    if ($tax->type == 1) {
                                        $price = number_format($tax->tax * $cart->qty);
                                    }
                                    if ($tax->type == 2) {
                                        $price = number_format(($tax->tax / 100) * ($cart->product_price),2);
                                    }
                                    $tax_price[array_search($tax->name, $tax_name)] += $price;
                                }
                            }
                        }
                    }
                    $taxArr['tax'] = $tax_name;
                    $taxArr['rate'] = $tax_price;
                    $totalcarttax = 0;
                    foreach ($taxArr['tax'] as $k => $tax) {
                        $totalcarttax += (float)$taxArr['rate'][$k];
                    }
                    $item = Products::where('id', $cart->product_id)->first();
                    if ($cart->variation_id != "" && $cart->variation_id != null) {
                        $variant = Variation::where('id', $cart->variation_id)->first();
                        if ($variant->stock_management == 1) {
                            if ($cart->qty > $variant->qty) {
                                $qtyexist = 1;
                            }
                        } else {
                            $qtyexist = 0;
                        }
                    } else {
    
                        if ($item->stock_management == 1) {
                            if ($cart->qty > $item->qty) {
                                $qtyexist = 1;
                                // return response()->json(['status' => 0, 'message' => trans($item->item_name . ' qty not enough for order !!')], 200);
                            }
                        } else {
                            $qtyexist = 0;
                        }
                    }
                }
                if ($qtyexist == 1) {
                    return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('labels.out_of_stock_msg') . ' ' . $item->name . ''  . '(' . $variant->name . ')', 'sub_total' => $carttax->sub_total, 'tax_name' =>  $taxArr['tax'], 'tax_rate' => $taxArr['rate'], 'total_tax' => $totalcarttax], 200);
                } else {
                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'sub_total' => $carttax->sub_total, 'tax_name' =>  $taxArr['tax'], 'tax_rate' => $taxArr['rate'], 'total_tax' => $totalcarttax], 200);
                }
            }else{
                return response()->json(['status' => 0, 'message' => trans('messages.cart_empty')], 200);
            }
          
        } catch (\Throwable $th) {
           
            return response()->json(['status' => 0, 'message' => $th], 400);
        }
    }
}

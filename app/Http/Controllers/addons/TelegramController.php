<?php
namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\User;
use App\Models\Settings;
use App\Models\Order;
use App\Models\OrderDetails;
use URL;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    public function telegrammessage(Request $request)
    {
        if(Auth::user()->type == 4){
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $request->validate([
            'telegram_message' => 'required',
            'telegram_access_token' => 'required',
            'telegram_chat_id' => 'required',
        ], [
            "telegram_message.required" => trans('messages.telegramhatsapp_message_required'),
            "telegram_access_token.required" => trans('messages.telegramhatsapp_message_required'),
            "telegram_chat_id.required" => trans('messages.telegramhatsapp_message_required'),
        ]);
        $settingsdata = Settings::where('vendor_id', $vendor_id )->first();
        $settingsdata->telegram_message = $request->telegram_message;
        $settingsdata->telegram_access_token = $request->telegram_access_token;
        $settingsdata->telegram_chat_id = $request->telegram_chat_id;
        $settingsdata->telegram_on_off =  isset($request->telegram_on_off) ? 1 : 2;
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function telegram(Request $request)
    {
        try {
            $order_number = $request->order_number;
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
            $pagee[]="";
            $payment_type = "-";
            $payment_status = "";
            $getorder = Order::where('order_number', $order_number)->first();
            if ($getorder->payment_status == "1") {
                $payment_status = "UnPaid";
            }
            if ($getorder->payment_status == "2") {
                $payment_status = "Paid";
            }
          
            $data = OrderDetails::where('order_id', $getorder->id)->get();
            foreach ($data as $value) {
                if ($value['variation_id'] != "") {
                    $item_p =  $value['product_price'];
                    $variantsdata = '(' . $value['variation_name'] . ')';
                } else {
                    $variantsdata = "";
                    $item_p =  $value['product_price'];
                }
                // $extras_id = explode(",", $value['extras_id']);
                // $extras_name = explode(",", $value['extras_name']);
                // $extras_price = explode(",", $value['extras_price']);
                $item_message = helper::appdata($vdata)->item_message;
                $itemvar = ["{qty}", "{item_name}", "{variantsdata}", "{item_price}"];
                $newitemvar   = [$value['qty'], $value['product_name'], $variantsdata, helper::currency_formate($item_p, $vdata)];
                $pagee[] = str_replace($itemvar, $newitemvar, $item_message);
                // if ($value['extras_id'] != "") {
                //     foreach ($extras_id as $key =>  $addons) {
                //         $pagee[] .= "👉" . $extras_name[$key] . ':' . helper::currency_formate($extras_price[$key], $vdata) . '%0a';
                //     }
                // }
            }
            $items = implode(",", $pagee);
            $itemlist = str_replace(',', "\n", $items);
            $tax = explode("|", $getorder['tax_amount']);
            $tax_name = explode("|", $getorder['tax_name']);
    
            $tax_data[] = "";
            if ($tax != "") {
                foreach ($tax as $key => $tax_value) {
                    @$tax_data[] .= "👉" . $tax_name[$key] . ' : ' . helper::currency_formate((float)$tax[$key], $vdata) . '%0a';
                }
            }
            $tdata = implode(",", $tax_data);
    
    
            $tax_val = str_replace(',', '%0a', $tdata);
            if (helper::appdata($vdata)->product_type == 1) {
                $var = ["{order_no}", "{payment_status}", "{item_variable}", "{sub_total}", "{total_tax}", "{offer_code}", "{discount_amount}", "{delivery_charge}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{customer_email}", "{billing_address}", "{billing_city}", "{billing_state}", '{billing_country}', "{billing_landmark}", "{billing_postal_code}", "{shipping_address}", "{shipping_city}", "{shipping_state}", "{shipping_country}", "{shipping_postal_code}", "{shipping_landmark}", "{payment_type}", "{track_order_url}", "{store_url}", "{store_name}","{date}","{time}"];
                $newvar   = [$getorder->order_number, $payment_status, $itemlist, helper::currency_formate($getorder->sub_total, $vdata), $tax_val, $getorder->offer_code, helper::currency_formate($getorder->offer_amount, $vdata), helper::currency_formate($getorder->delivery_charge, $vdata), helper::currency_formate($getorder->grand_total, $vdata), $getorder->notes, $getorder->user_name, $getorder->user_mobile, $getorder->user_email, $getorder->billing_address, $getorder->billing_city, $getorder->billing_state, $getorder->billing_country, $getorder->billing_landmark, $getorder->billing_postal_code,  $getorder->shipping_address, $getorder->shipping_city, $getorder->shipping_state, $getorder->shipping_country, $getorder->shipping_postal_code, $getorder->shipping_landmark, @helper::getpayment($getorder->transaction_type, $vdata)->payment_name, $vendordata->name, URL::to($vendordata->slug . '/find-order?order=' . $order_number), URL::to($vendordata->slug), $vendordata->name,helper::date_formate($getorder->created_at,$vdata),helper::time_formate($getorder->created_at,$vdata)];
            }
            else
            {
                $var = ["{order_no}", "{payment_status}", "{item_variable}", "{sub_total}", "{total_tax}", "{offer_code}", "{discount_amount}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{customer_email}", "{payment_type}", "{track_order_url}", "{store_url}", "{store_name}"];
                $newvar   = [$getorder->order_number, $payment_status, $itemlist, helper::currency_formate($getorder->sub_total, $vdata), $tax_val, $getorder->offer_code, helper::currency_formate($getorder->offer_amount, $vdata), helper::currency_formate($getorder->grand_total, $vdata), $getorder->notes, $getorder->user_name, $getorder->user_mobile, $getorder->user_email,@helper::getpayment($getorder->transaction_type, $vdata)->payment_name, $vendordata->name, URL::to($vendordata->name . '/find-order?order=' . $order_number), URL::to($vendordata->slug), $vendordata->slug,helper::date_formate($getorder->created_at,$vdata),helper::time_formate($getorder->created_at,$vdata)];
            }

            $telegrammessage = str_replace($var, $newvar, helper::appdata($vdata)->telegram_message);

            $apiToken = helper::appdata($vdata)->telegram_access_token;
            $chatIds = array(helper::appdata($vdata)->telegram_chat_id); // AND SOME MORE
            $data = [
                'text' => $telegrammessage
            ];
            foreach($chatIds as $chatId) {
                // Send Message To chat id
                file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&".http_build_query($data));
            }
            return redirect($vendordata->slug.'/find-order?order=' . $order_number)->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect($vendordata->slug.'/orders-success-'. $order_number)->with('error', trans('messages.wrong'));
        }
    }

    // api===========================================================
    public function telegram_msg(Request $request)
    {
        try {

            if($request->vendor_id == "")
            {
                return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
            }
            if($request->order_number == "")
            {
                return response()->json(["status" => 0, "message" => trans('messages.order_number_required')], 400);
            }

            $order_number = $request->order_number;
            $vendordata = User::where('id', $request->vendor_id)->first();

            $pagee[]="";
            $payment_type = "-";
            $payment_status = "";
            $getorder = Order::where('order_number', $order_number)->first();
            if ($getorder->payment_status == "1") {
                $payment_status = "UnPaid";
            }
            if ($getorder->payment_status == "2") {
                $payment_status = "Paid";
            }
            if (strtolower($getorder->transaction_type) == "1") {
                $payment_type = "COD";
            }
            if (strtolower($getorder->transaction_type) == "2") {
                $payment_type = "RazorPAy";
            }
            if (strtolower($getorder->transaction_type) == '3') {
                $payment_type = "Stripe";
            }
            if (strtolower($getorder->transaction_type) == '4') {
                $payment_type = "Flutterwave";
            }
            if (strtolower($getorder->transaction_type) == '5') {
                $payment_type = "PayStack";
            }
            if (strtolower($getorder->transaction_type) == '6') {
                $payment_type = "Bank Transfer";
            }
            if (strtolower($getorder->transaction_type) == '7') {
                $payment_type = "Mercadopago";
            }
            if (strtolower($getorder->transaction_type) == '8') {
                $payment_type = "PayPal";
            }
            if (strtolower($getorder->transaction_type) == '9') {
                $payment_type = "MyFatoorah";
            }
            if (strtolower($getorder->transaction_type) == '9') {
                $payment_type = "Toyyibpay";
            }
            $data = OrderDetails::where('order_id', $getorder->id)->get();
            foreach ($data as $value) {
                if ($value['variation_id'] != "") {
                    $item_p =  $value['product_price'];
                    $variantsdata = '(' . $value['variation_name'] . ')';
                } else {
                    $variantsdata = "";
                    $item_p =  $value['product_price'];
                }
                $extras_id = explode(",", $value['extras_id']);
                $extras_name = explode(",", $value['extras_name']);
                $extras_price = explode(",", $value['extras_price']);
                $item_message = helper::appdata($vendordata->id)->item_message;
                $itemvar = ["{qty}", "{item_name}", "{variantsdata}", "{item_price}"];
                $newitemvar   = [$value['qty'], $value['product_name'], $variantsdata, helper::currency_formate($item_p, $vendordata->id)];
                $pagee[] = str_replace($itemvar, $newitemvar, $item_message);
                if ($value['extras_id'] != "") {
                    foreach ($extras_id as $key =>  $addons) {
                        $pagee[] .= "👉" . $extras_name[$key] . ':' . helper::currency_formate($extras_price[$key], $vendordata->id) . '%0a';
                    }
                }
            }
            $items = implode(",", $pagee);
            $itemlist = str_replace(',', "\n", $items);
            $var = ["{order_no}", "{payment_status}", "{item_variable}", "{sub_total}", "{total_tax}", "{offer_code}", "{discount_amount}", "{delivery_charge}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{customer_email}", "{billing_address}", "{billing_city}", "{billing_state}", '{billing_country}', "{billing_landmark}", "{billing_postal_code}", "{shipping_address}", "{shipping_city}", "{shipping_state}", "{shipping_country}", "{shipping_postal_code}", "{shipping_landmark}", "{payment_type}", "{track_order_url}", "{store_url}", "{store_name}"];
            $newvar   = [$getorder->order_number, $payment_status, $itemlist, helper::currency_formate($getorder->sub_total, $vendordata->id), helper::currency_formate($getorder->tax_amount, $vendordata->id), $getorder->offer_code, helper::currency_formate($getorder->offer_amount, $vendordata->id), helper::currency_formate($getorder->delivery_charge, $vendordata->id), helper::currency_formate($getorder->grand_total, $vendordata->id), $getorder->notes, $getorder->user_name, $getorder->user_mobile, $getorder->user_email, $getorder->billing_address, $getorder->billing_city, $getorder->billing_state, $getorder->billing_country, $getorder->billing_landmark, $getorder->billing_postal_code,  $getorder->shipping_address, $getorder->shipping_city, $getorder->shipping_state, $getorder->shipping_country, $getorder->shipping_postal_code, $getorder->shipping_landmark, $payment_type, URL::to($vendordata->slug . '/find-order?order=' . $order_number), URL::to($vendordata->slug), $vendordata->slug];

            $telegrammessage = str_replace($var, $newvar, helper::appdata($vendordata->id)->telegram_message);

            $apiToken = helper::appdata($vendordata->id)->telegram_access_token;
            $chatIds = array(helper::appdata($vendordata->id)->telegram_chat_id); // AND SOME MORE
            $data = [
                'text' => $telegrammessage
            ];
            foreach($chatIds as $chatId) {
                // Send Message To chat id
                file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&".http_build_query($data));
            }
            return response()->json(["status" => 1, "message" => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => trans('messages.wrong')], 400);
        }
    }
}

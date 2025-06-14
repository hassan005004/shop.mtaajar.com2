<?php

namespace App\helper;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\URL;

class whatsapp_helper
{
    public static function whatsapp_message_config($vendor_id)
    {
        if (empty($vendor_id)) {
            $whatsappp = WhatsappMessage::first();
        } else {
            $whatsappp = WhatsappMessage::where('vendor_id', $vendor_id)->first();
        }
        return $whatsappp;
    }

    public static function whatsappmessage($order_number, $vendor_slug, $vendordata)
    {
        try {
            $pagee[] = "";
            $getorder = Order::where('order_number', $order_number)->where('vendor_id', $vendordata->id)->first();

            if ($getorder->payment_status == "1") {
                $payment_status = trans('labels.unpaid');
            }
            if ($getorder->payment_status == "2") {
                $payment_status = trans('labels.paid');
            }

            if ($getorder->delivery_charge > 0) {
                $delivery_charge = helper::currency_formate($getorder->delivery_charge, $vendordata->id);
            } else {
                $delivery_charge = trans('labels.free');
            }

            $data = OrderDetails::where('order_id', $getorder->id)->get();
            foreach ($data as $value) {
                if ($value['variation_id'] != "") {
                    $variantsdata = '(' . $value['variation_name'] . ')';
                } else {
                    $variantsdata = "";
                }
                $item_message = whatsapp_helper::whatsapp_message_config($vendordata->id)->item_message;
                $itemvar = ["{qty}", "{item_name}", "{variantsdata}", "{item_price}", "{total}"];
                $newitemvar = [$value['qty'], urlencode($value['product_name']), $variantsdata, helper::currency_formate($value->product_price, $vendordata->id), helper::currency_formate($value->product_price * $value['qty'], $vendordata->id)];
                $pagee[] = str_replace($itemvar, $newitemvar, $item_message);

                $extras_id = explode("|", $value['extras_id']);
                $extras_name = explode("|", $value['extras_name']);
                $extras_price = explode("|", $value['extras_price']);
                if ($value['extras_id'] != "") {
                    foreach ($extras_id as $key =>  $addons) {
                        $pagee[] .= "👉" . $extras_name[$key] . ':' . helper::currency_formate($extras_price[$key], $vendordata->id) . '%0a';
                    }
                }
            }

            $items = implode("|", $pagee);
            $itemlist = str_replace('|', '%0a', $items);

            $tax_amount = explode("|", $getorder->tax_amount);
            $tax_name = explode("|", $getorder->tax_name);

            $tax_data[] = "";
            if ($tax_amount != "") {
                foreach ($tax_amount as $key => $tax_value) {
                    @$tax_data[] .= "👉 " . $tax_name[$key] . ' : ' . helper::currency_formate((float)$tax_amount[$key], $vendordata->id);
                }
            }
            $tdata = implode("|", $tax_data);
            $tax_val = str_replace('|', '%0a', $tdata);

            $var = ["{order_no}", "{payment_status}", "{item_variable}", "{tips}", "{sub_total}", "{total_tax}", "{offer_code}", "{discount_amount}", "{delivery_charge}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{customer_email}", "{billing_address}", "{billing_city}", "{billing_state}", '{billing_country}', "{billing_landmark}", "{billing_postal_code}", "{shipping_address}", "{shipping_city}", "{shipping_state}", "{shipping_country}", "{shipping_postal_code}", "{shipping_landmark}", "{payment_type}", "{track_order_url}", "{store_url}", "{store_name}"];
            $newvar = [$getorder->order_number, $payment_status, $itemlist, helper::currency_formate($getorder->tips, $vendordata->id), helper::currency_formate($getorder->sub_total, $vendordata->id), $tax_val, $getorder->offer_code, helper::currency_formate($getorder->offer_amount, $vendordata->id), $delivery_charge, helper::currency_formate($getorder->grand_total, $vendordata->id), $getorder->notes, $getorder->user_name, $getorder->user_mobile, $getorder->user_email, $getorder->billing_address, $getorder->billing_city, $getorder->billing_state, $getorder->billing_country, $getorder->billing_landmark, $getorder->billing_postal_code,  $getorder->shipping_address, $getorder->shipping_city, $getorder->shipping_state, $getorder->shipping_country, $getorder->shipping_postal_code, $getorder->shipping_landmark, @helper::getpayment($getorder->transaction_type, $vendordata->id)->payment_name, URL::to($vendordata->slug . '/find-order?order=' . $order_number), URL::to($vendordata->slug), $vendordata->name];
            $whmessage = str_replace($var, $newvar, str_replace("\n", "%0a", whatsapp_helper::whatsapp_message_config($vendordata->id)->order_whatsapp_message));
            if (whatsapp_helper::whatsapp_message_config($vendordata->id)->message_type == 1) {
                $whmessage = str_replace($var, $newvar, str_replace("\r\n", "%0a", @whatsapp_helper::whatsapp_message_config($vendordata->id)->order_whatsapp_message));
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . whatsapp_helper::whatsapp_message_config($vendordata->id)->whatsapp_phone_number_id . '/messages',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                    "messaging_product": "whatsapp",
                    "to": "917016428845",
                    "text": {
                        "body" : "' . $whmessage . '"
                    }
                }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . whatsapp_helper::whatsapp_message_config($vendordata->id)->whatsapp_access_token . ''
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }

            return $whmessage;
        } catch (\Throwable $th) {
        }
    }

    public static function orderstatusupdatemessage($order_number, $status, $vendor_id)
    {
        $getorder = Order::where('order_number', $order_number)->where('vendor_id', $vendor_id)->first();
        $vendordata = User::where('id', $vendor_id)->first();
        $var = ["{order_no}", "{customer_name}", "{track_order_url}", "{status}"];
        $newvar = [$order_number, $getorder->user_name, URL::to($vendordata->slug . '/find-order?order=' . $order_number), $status];
        $whmessage = str_replace($var, $newvar, str_replace("\r\n", "%0a", @whatsapp_helper::whatsapp_message_config($vendor_id)->order_status_message));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . whatsapp_helper::whatsapp_message_config($vendor_id)->whatsapp_phone_number_id . '/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
              "messaging_product": "whatsapp",
              "to": "917016428845",
              "text": {
                  "body" : "' . $whmessage . '"
              }
          }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . whatsapp_helper::whatsapp_message_config($vendor_id)->whatsapp_access_token . ''
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $whmessage;
    }
}

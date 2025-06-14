<?php

namespace App\helper;

use App\Models\Order; 
use App\Models\OrderDetails; 
use App\helper\helper;

class ship_rocket
{

    public static function CheckAPIUser($email,$password,$vendor_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "email": "' . $email . '",
            "password": "' . $password . '"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);

        return $rData;
    }

    public static function GetToken($vendor_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "email": "' . helper::appdata($vendor_id)->api_user_email . '",
            "password": "' . helper::appdata($vendor_id)->api_user_password . '"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);

        return $rData->token;
    }

    public static function CreateCustomOrder($gettoken,$order_id)
    {
        $orderdata = Order::where('id',$order_id)->first();
        $orderdetail = OrderDetails::where('order_id', $orderdata->id)->get();

        $arrNewSku = array();
        $incI = 0;

        foreach($orderdetail as $arrKey => $sidorderdata){
            $arrNewSku[$incI]['name'] = $sidorderdata->product_name;
            $arrNewSku[$incI]['sku'] = $arrKey;
            $arrNewSku[$incI]['units'] = $sidorderdata->qty;
            $arrNewSku[$incI]['selling_price'] = $sidorderdata->price;
            
            $incI++;
        }

        //Convert array to json form...
        $encodedSku = json_encode($arrNewSku);

        if ($orderdata->payment_status == 2) {
            $payment_method = "Prepaid";
        } else {
            $payment_method = "Postpaid";
        }   
                            
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "order_id": "' . $orderdata->order_number . '",
            "order_date": "'.$orderdata->created_at.'",
            "pickup_location": "Primary",
            "billing_customer_name": "'.$orderdata->user_name.'",  
            "billing_last_name": "'.$orderdata->user_name.'",  
            "billing_address": "'.$orderdata->billing_address.'",  
            "billing_address_2": "'.$orderdata->billing_landmark.'",
            "billing_city": "'.$orderdata->billing_city.'",
            "billing_pincode": "'.$orderdata->billing_postal_code.'",
            "billing_state": "'.$orderdata->billing_state.'",
            "billing_country": "'.$orderdata->billing_country.'",
            "billing_email": "'.$orderdata->user_email.'",
            "billing_phone": "'.$orderdata->user_mobile.'",
            "shipping_is_billing": true,
            "order_items": '.$encodedSku.',
            "payment_method": "'.$payment_method.'",
            "shipping_charges": "'.$orderdata->delivery_charge.'",
            "giftwrap_charges": 0,
            "transaction_charges": 0,
            "total_discount": 0,
            "sub_total": "'.$orderdata->grand_total - $orderdata->delivery_charge.'",
            "length": 0.5,
            "breadth": 0.5,
            "height": 0.5,
            "weight": 0.5
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$gettoken,
        ),
        ));

        $oresponse = curl_exec($curl);
        curl_close($curl);

        return $oresponse;
    }
}
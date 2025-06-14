<?php

namespace App\Imports;

use App\Models\CustomStatus;
use App\Models\LandingSettings;
use App\Models\Payment;
use App\Models\Settings;
use App\helper\helper;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportVendor implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        try {
            foreach ($rows as $row) {
                $rec = Settings::where('vendor_id', '1')->first();

                $user = new User();
                $user->id = $row['id'];
                $user->store_id = $row['store_id'];
                $user->name = $row['name'];
                $user->slug = $row['slug'];
                $user->email = $row['email'];
                $user->mobile = $row['mobile'];
                $user->password = Hash::make($row['password']);
                $user->google_id = '';
                $user->facebook_id = '';
                $user->image = "default.png";
                $user->login_type = '';
                $user->type = 2;
                $user->token = '';
                $user->country_id = $row['country_id'];
                $user->city_id = $row['city_id'];
                $user->is_verified = 2;
                $user->is_available = 1;
                $user->store_id = '';
                $user->save();

                $vendor_id = \DB::getPdo()->lastInsertId();

                $status_name = CustomStatus::where('vendor_id', '1')->get();

                foreach ($status_name as $name) {
                    $customstatus = new CustomStatus;
                    $customstatus->vendor_id = $vendor_id;
                    $customstatus->name = $name->name;
                    $customstatus->type = $name->type;
                    $customstatus->order_type = $name->order_type;
                    $customstatus->is_available = $name->is_available;
                    $customstatus->is_deleted = $name->is_deleted;
                    $customstatus->save();
                }
                $paymentlist = Payment::where('vendor_id', '1')->get();
                foreach ($paymentlist as $payment) {
                    $gateway = new Payment;
                    $gateway->vendor_id = $vendor_id;
                    $gateway->payment_name = $payment->payment_name;
                    $gateway->currency = $payment->currency;
                    $gateway->image = $payment->image;
                    $gateway->public_key = '-';
                    $gateway->secret_key = '-';
                    $gateway->encryption_key = '-';
                    $gateway->payment_type = $payment->payment_type;
                    $gateway->environment = '1';
                    $gateway->is_available = '1';
                    $gateway->is_activate = $payment->is_activate;
                    $gateway->save();
                }

                $messagenotification = "Hi, 
I would like to place an order 👇

Order No: {order_no}
---------------------------
{item_variable}
---------------------------
👉Subtotal : {sub_total}
👉Tax : {total_tax}
👉Delivery charge : {delivery_charge}
👉Discount : - {discount_amount}
---------------------------
📃 Total : {grand_total}
---------------------------
📄 Comment : {notes}
✅ Customer Info
---------------------------
Customer name : {customer_name}
Customer email: {customer_email}
Customer phone : {customer_mobile}
---------------------------
📍 Billing Details
Address : {billing_address}, {billing_landmark}, {billing_postal_code}, {billing_city}, {billing_state}, {billing_country}.
---------------------------
📍 Shipping Details
Address : {shipping_address}, {shipping_landmark}, {shipping_postal_code}, {shipping_city}, {shipping_state}, {shipping_country}.
---------------------------
🗓️Date : {date}
⏱️Time : {time}
---------------------------
💳 Payment type : {payment_type}

{store_name} will confirm your order upon receiving the message.

Track your order 👇
{track_order_url}

Click here for next order 👇
{store_url}

Thanks for the Order 🥳";

                $landingsettings = LandingSettings::where('vendor_id', 1)->first();
                $data = new Settings();

                $data->logo = "default.png";
                $data->favicon = "default.png";
                $data->viewallpage_banner = "";
                $data->email = $row['email'];
                $data->mobile = $row['mobile'];
                $data->contact = '-';
                $data->address = "ADDRESS";
                $data->currency = helper::appdata("")->currency;
                $data->currency_position = helper::appdata("")->currency_position;
                $data->timezone = helper::appdata("")->timezone;
                $data->web_title = helper::appdata("")->web_title;
                $data->copyright = helper::appdata("")->copyright;
                $data->vendor_id = $vendor_id;
                $data->whatsapp_message = $messagenotification;
                $data->telegram_message = $messagenotification;
                $data->whatsapp_number = $row['mobile'];
                $data->item_message = "🔵{item_name} X  {qty}  {variantsdata} - {item_price}";
                $data->product_type = 1;
                $data->decimal_separator = $rec->decimal_separator;
                $data->currency_formate = $rec->currency_formate;
                $data->time_format = $rec->time_format;
                $data->date_format = $rec->date_format;
                $data->order_prefix = 'PITS';
                $data->order_number_start = 1001;
                $data->firebase = '-';
                $data->default_language = 'en';
                $data->primary_color = $landingsettings->primary_color;
                $data->secondary_color = $landingsettings->secondary_color;
                $data->secondary_color = $landingsettings->secondary_color;
                $data->save();
           
            }
        } catch (\Throwable $th) {
            dd($th);
            return $th;
        }
    }
}
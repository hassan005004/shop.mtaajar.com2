<?php

namespace App\helper;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Settings;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Blog;
use App\Models\PricingPlan;
use App\Models\Products;
use App\Models\SystemAddons;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Languages;
use App\Models\TopDeals;
use App\Models\RoleAccess;
use App\Models\Variation;
use App\Models\RoleManager;
use App\Models\Payment;
use App\Models\Customdomain;
use App\Models\LandingSettings;
use App\Models\CustomStatus;
use App\Models\Pixcel;
use App\Models\Tax;
use App\Models\SocialLinks;
use App\Models\AgeVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use URL;
use App;
use App\Models\Footerfeatures;
use App\Models\OtherSettings;
use App\Models\Promocode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Config;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use File;

class helper
{
    // admin
    public static function appdata($vendor_id)
    {
        if (file_exists(storage_path('installed'))) {
            $host = @$_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $data = Settings::first();
                if (!empty($vendor_id)) {
                    $data = Settings::where('vendor_id', $vendor_id)->first();
                }
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $data = Settings::where('custom_domain', $host)->first();
            }

            return $data;
        } else {
            return redirect('install');
            exit;
        }
    }
    public static function otherappdata($vendor_id)
    {
        if (file_exists(storage_path('installed'))) {
            
            $host = $_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $data = OtherSettings::first();
                if (!empty($vendor_id)) {
                    $data = OtherSettings::where('vendor_id', $vendor_id)->first();
                }
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $storeinfo = Settings::where('custom_domain', $host)->first();
                date_default_timezone_set(helper::appdata($storeinfo->vendor_id)->timezone);
                $data = OtherSettings::first();
                if (!empty($vendor_id)) {
                    $data = OtherSettings::where('vendor_id', $storeinfo->vendor_id)->first();
                }
            }

            return $data;
        } else {
            return redirect('install');
            exit;
        }
    }
    public static function getsociallinks($vendor_id)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $links = SocialLinks::where('vendor_id', $vendor_id)->get();
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
            $links = SocialLinks::where('vendor_id', $vdata)->get();
        }

        return $links;
    }
    public static function decimal_formate($price)
    {
        $price = floatval($price);
        return number_format($price, 2);
    }

    public static function currency_formate($price, $vendor_id)
    {
        if (helper::appdata($vendor_id)->currency_position == "1") {
            if (helper::appdata($vendor_id)->decimal_separator == 1) {
                if (helper::appdata($vendor_id)->currency_space == 1) {
                    return helper::appdata($vendor_id)->currency . ' ' . number_format((float)$price, helper::appdata($vendor_id)->currency_formate, '.', ',');
                } else {
                    return helper::appdata($vendor_id)->currency . number_format((float)$price, helper::appdata($vendor_id)->currency_formate, '.', ',');
                }
            } else {
                if (helper::appdata($vendor_id)->currency_space == 1) {
                    return helper::appdata($vendor_id)->currency . ' ' . number_format((float)$price, helper::appdata($vendor_id)->currency_formate, ',', '.');
                } else {
                    return helper::appdata($vendor_id)->currency . number_format((float)$price, helper::appdata($vendor_id)->currency_formate, ',', '.');
                }
            }
        }
        if (helper::appdata($vendor_id)->currency_position == "2") {
            if (helper::appdata($vendor_id)->decimal_separator == 1) {
                if (helper::appdata($vendor_id)->currency_space == 1) {
                    return number_format((float)$price, helper::appdata($vendor_id)->currency_formate, '.', ',') . ' ' . helper::appdata($vendor_id)->currency;
                } else {
                    return number_format((float)$price, helper::appdata($vendor_id)->currency_formate, '.', ',') . helper::appdata($vendor_id)->currency;
                }
            } else {
                if (helper::appdata($vendor_id)->currency_space == 1) {
                    return number_format((float)$price, helper::appdata($vendor_id)->currency_formate, ',', '.') . ' ' . helper::appdata($vendor_id)->currency;
                } else {
                    return number_format((float)$price, helper::appdata($vendor_id)->currency_formate, ',', '.') . helper::appdata($vendor_id)->currency;
                }
                return number_format((float)$price, helper::appdata($vendor_id)->currency_formate, ',', '.') . helper::appdata($vendor_id)->currency;
            }
        }
        return $price;
    }

    public static function gettax($tax_id)
    {
        $taxArr = explode('|', $tax_id);
        $taxes = [];
        foreach ($taxArr as $tax) {
            $taxes[] = Tax::find($tax);
        }
        return $taxes;
    }

    public static function taxRate($taxRate, $price, $quantity, $tax_type)
    {
        if ($tax_type == 1) {
            return $taxRate * $quantity;
        }

        if ($tax_type == 2) {
            return ($taxRate / 100) * ($price * $quantity);
        }
    }
    public static function date_formate($date, $vendor_id)
    {
        return date(helper::appdata($vendor_id)->date_format, strtotime($date));
    }
    public static function time_formate($time, $vendor_id)
    {
        if (helper::appdata($vendor_id)->time_format == 1) {
            return $time->format('H:i');
        } else {
            return $time->format('h:i A');
        }
    }
    // all mail=================================================================
    public static function send_mail_forpassword($email, $name, $password, $logo)
    {
        $var = ["{user}", "{password}"];
        $newvar = [$name, $password];
        $forpasswordmessage = str_replace($var, $newvar, nl2br(helper::appdata('')->forget_password_email_message));
        $data = ['title' => trans('labels.email_verification'), 'email' => $email, 'forpasswordmessage' => $forpasswordmessage, 'logo' => helper::image_path($logo)];
        try {
            Mail::send('email.sendpassword', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function send_mail_delete_account($vendor)
    {
        $var = ["{vendorname}"];
        $newvar = [$vendor->name];
        $userdeletemessage = str_replace($var, $newvar, nl2br(helper::appdata('')->delete_account_email_message));
        $data = ['title' => trans('labels.account_deleted'), 'userdeletemessage' => $userdeletemessage, 'email' => $vendor->email];
        try {
            Mail::send('email.accountdeleted', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    // public static function send_mail_forotp($name, $email, $otp, $logo)
    // {
    //     $data = ['title' => trans('labels.email_verification'), 'email' => $email, 'name' => $name, 'otp' => $otp, 'logo' => helper::image_path($logo)];
    //     try {
    //         Mail::send('email.otpverification', $data, function ($message) use ($data) {
    //             $message->to($data['email'])->subject($data['title']);
    //         });
    //         return 1;
    //     } catch (\Throwable $th) {
    //         return 0;
    //     }
    // }

    public static function referral($email, $referralmessage)
    {
        $data = ['title' => trans('labels.referral_earning'), 'email' => $email, 'logo' => helper::image_path(@helper::appdata('')->logo), 'referralmessage' => $referralmessage];
        try {
            Mail::send('email.referral', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function bank_transfer_request($vendor_email, $vendor_name, $plan_name, $duration, $price, $payment_method, $transaction_id)
    {
        $admininfo = User::where('id', '1')->first();
        $vendorvar = ["{vendorname}", "{adminname}", "{adminemail}"];
        $vendornewvar = [$vendor_name, $admininfo->name, $admininfo->email];
        $vendormessage = str_replace($vendorvar, $vendornewvar, nl2br(helper::appdata('')->banktransfer_request_email_message));

        $adminvar = ["{adminname}", "{vendorname}", "{vendoremail}", "{plan_name}", "{subscription_duration}", "{subscription_price}", "{payment_type}"];
        $adminnewvar = [$admininfo->name, $vendor_name, $vendor_email, $plan_name, $duration, $price, $payment_method];
        $adminmessage = str_replace($adminvar, $adminnewvar, nl2br(helper::appdata('')->admin_subscription_request_email_message));

        $data = ['title' =>  trans('labels.banktransfer'), 'vendor_email' => $vendor_email, 'vendormessage' => $vendormessage];

        $adminemail = ['title' =>  trans('labels.banktransfer'), 'adminmessage' => $adminmessage, 'admin_email' => $admininfo->email];
        try {
            Mail::send('email.banktransfervendor', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });

            Mail::send('email.banktransferadmin', $adminemail, function ($message) use ($adminemail) {
                $message->to($adminemail['admin_email'])->subject($adminemail['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function cod_request($vendor_email, $vendor_name, $plan_name, $duration, $price, $payment_method, $transaction_id)
    {
        $admininfo = User::where('id', '1')->first();
        $vendorvar = ["{vendorname}", "{adminname}", "{adminemail}"];
        $vendornewvar = [$vendor_name, $admininfo->name, $admininfo->email];
        $vendormessage = str_replace($vendorvar, $vendornewvar, nl2br(helper::appdata('')->cod_request_email_message));

        $adminvar = ["{adminname}", "{vendorname}", "{vendoremail}", "{plan_name}", "{subscription_duration}", "{subscription_price}", "{payment_type}"];
        $adminnewvar = [$admininfo->name, $vendor_name, $vendor_email, $plan_name, $duration, $price, $payment_method];
        $adminmessage = str_replace($adminvar, $adminnewvar, nl2br(helper::appdata('')->admin_subscription_request_email_message));

        $data = ['title' =>  trans('labels.cod'), 'vendor_email' => $vendor_email, 'vendormessage' => $vendormessage];

        $adminemail = ['title' =>  trans('labels.cod'), 'adminmessage' => $adminmessage, 'admin_email' => $admininfo->email];
        try {
            Mail::send('email.codvendor', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });

            Mail::send('email.banktransferadmin', $adminemail, function ($message) use ($adminemail) {
                $message->to($adminemail['admin_email'])->subject($adminemail['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function subscription_rejected($vendor_email, $vendor_name, $plan_name, $payment_method)
    {
        $title = trans('labels.plan_request_rejected');
        if ($payment_method == 6) {
            $payment_method = "Bank Transfer";
        }
        if ($payment_method == 1) {
            $payment_method = "COD";
        }
        $admindata = User::select('name', 'email')->where('id', '1')->first();

        $var = ["{vendorname}", "{payment_type}", "{plan_name}", "{adminname}", "{adminemail}"];
        $newvar = [$vendor_name, $payment_method, $plan_name, $admindata->name, $admindata->email];
        $rejectmessage = str_replace($var, $newvar, nl2br(helper::appdata('')->subscription_reject_email_message));

        $data = ['title' => "$title", 'vendor_email' => $vendor_email, 'rejectmessage' => $rejectmessage];
        try {
            Mail::send('email.banktransferreject', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function send_subscription_email($vendor_email, $vendor_name, $plan_name, $duration, $price, $payment_method, $transaction_id)
    {
        $title = trans('labels.new_subscription_plan');
        $admininfo = User::where('id', '1')->first();
        $vendorvar = ["{vendorname}", "{payment_type}", "{subscription_duration}", "{subscription_price}", "{plan_name}", "{adminname}", "{adminemail}"];
        $vendornewvar = [$vendor_name, $payment_method, $duration, $price, $plan_name, $admininfo->name, $admininfo->email];
        $vendormessage = str_replace($vendorvar, $vendornewvar, nl2br(helper::appdata('')->subscription_success_email_message));

        $adminvar = ["{adminname}", "{vendorname}", "{vendoremail}", "{plan_name}", "{subscription_duration}", "{subscription_price}", "{payment_type}"];
        $adminnewvar = [$admininfo->name, $vendor_name, $vendor_email, $plan_name, $duration, $price, $payment_method];
        $adminmessage = str_replace($adminvar, $adminnewvar, nl2br(helper::appdata('')->admin_subscription_success_email_message));

        $data = ['title' => $title, 'vendor_email' => $vendor_email, 'vendormessage' => $vendormessage];

        $adminemail = ['title' => $title, 'admin_email' => $admininfo->email, 'adminmessage' => $adminmessage];

        try {
            Mail::send('email.subscription', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });

            Mail::send('email.adminsubscription', $adminemail, function ($message) use ($adminemail) {
                $message->to($adminemail['admin_email'])->subject($adminemail['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 1;
        }
    }
    public static function create_order_invoice($customer_email, $customer_name, $vendoremail, $vendorname, $vendorid, $order_number, $date, $trackurl, $grandtotal)
    {
        $orderinvoicevar = ["{customername}", "{ordernumber}", "{orderdate}", "{grandtotal}", "{track_order_url}", "{vendorname}"];
        $orderinvoicenewvar = [$customer_name, $order_number, $date, $grandtotal, $trackurl, $vendorname];
        $neworderinvoicemessage = str_replace($orderinvoicevar, $orderinvoicenewvar, nl2br(helper::appdata($vendorid)->new_order_invoice_email_message));

        $orderemailvar = ["{customername}", "{ordernumber}", "{orderdate}", "{grandtotal}", "{vendorname}"];
        $orderemailnewvar = [$customer_name, $order_number, $date, $grandtotal, $vendorname];
        $neworderemailmessage = str_replace($orderemailvar, $orderemailnewvar, nl2br(helper::appdata($vendorid)->vendor_new_order_email_message));

        $data = ['title' => trans('labels.new_order_invoice'), 'customer_email' => $customer_email, 'neworderinvoicemessage' => $neworderinvoicemessage, 'neworderemailmessage' => $neworderemailmessage, 'company_email' => $vendoremail];

        try {
            Mail::send('email.emailinvoice', $data, function ($message) use ($data) {
                $message->to($data['customer_email'])->subject($data['title']);
            });

            Mail::send('email.orderemail', $data, function ($message) use ($data) {
                $message->to($data['company_email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function vendor_contact_data($id, $vendor_name, $vendor_email, $full_name, $useremail, $usermobile, $usermessage)
    {
        $var = ["{vendorname}", "{username}", "{useremail}", "{usermobile}", "{usermessage}"];
        $newvar = [$vendor_name, $full_name, $useremail, $usermobile, $usermessage];
        $vendorcontactmessage = str_replace($var, $newvar, nl2br(helper::appdata($id)->contact_email_message));

        $data = ['title' => trans('labels.inquiry'), 'vendor_email' => $vendor_email, 'vendorcontactmessage' => $vendorcontactmessage];
        try {
            Mail::send('email.vendorcontact', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function send_mail_vendor_register($vendor)
    {
        $admininfo = User::where('id', 1)->first();
        $vendorvar = ["{vendorname}"];
        $vendornewvar = [$vendor->name];
        $vendormessage = str_replace($vendorvar, $vendornewvar, nl2br(helper::appdata('')->vendor_register_email_message));

        $adminvar = ["{adminname}", "{vendorname}", "{vendoremail}", "{vendormobile}"];
        $adminnewvar = [$admininfo->name, $vendor->name, $vendor->email, $vendor->mobile];
        $adminmessage = str_replace($adminvar, $adminnewvar, nl2br(helper::appdata('')->admin_vendor_register_email_message));

        $data = ['title' => trans('labels.registration'), 'title1' => 'New Vendor Registration', 'vendor_email' => $vendor->email, 'admin_email' => $admininfo->email, "vendormessage" => $vendormessage, 'adminmessage' => $adminmessage];
        try {
            Mail::send('email.vendorregister', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });

            Mail::send('email.newvendorregistration', $data, function ($message) use ($data) {
                $message->to($data['admin_email'])->subject($data['title1']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function send_mail_vendor_block($vendor)
    {
        $var = ["{vendorname}"];
        $newvar = [$vendor->name];
        $vendorblokedmessage = str_replace($var, $newvar, nl2br(helper::appdata('')->vendor_status_change_email_message));

        $data = ['title' => trans('labels.account_deleted'), 'vendorblokedmessage' => $vendorblokedmessage, 'vendor_email' => $vendor->email];
        try {
            Mail::send('email.vendorbloked', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            dd($th);
            return 0;
        }
    }
    public static function order_status_email($email, $name, $title, $message_text, $vendor)
    {
        $var = ["{customername}", "{status_message}", "{vendorname}"];
        $newvar = [$name, $message_text, $vendor->name];
        $orderstatusmessage = str_replace($var, $newvar, nl2br(helper::appdata($vendor->id)->order_status_email_message));
        $data = ['user_email' => $email, 'title' => $title, 'orderstatusmessage' => $orderstatusmessage, 'logo' => Helper::image_path(@Helper::appdata($vendor->id)->logo)];
        try {
            Mail::send('email.orderstatus', $data, function ($message) use ($data) {
                $message->to($data['user_email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function cancel_order($email, $name, $title, $message_text, $vendor)
    {
        $var = ["{customername}", "{status_message}", "{vendorname}"];
        $newvar = [$name, $message_text, $vendor->user_name];
        $orderstatusmessage = str_replace($var, $newvar, nl2br(helper::appdata($vendor->vendor_id)->order_status_email_message));
        $data = ['email' => $email, 'title' => $title, 'orderstatusmessage' => $orderstatusmessage, 'logo' => Helper::image_path(@Helper::appdata($vendor->id)->logo)];
        try {
            Mail::send('email.orderstatus', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    // all Mail End===========================================================================================
    public static function image_path($image)
    {
        if ($image == "" && $image == null) {
            $url = asset('storage/app/public/admin-assets/images/about/defaultimages/item-placeholder.png');
        } else {
            $url = asset('storage/app/public/admin-assets/images/about/defaultimages/item-placeholder.png');
        }
        if (Str::contains($image, 'profile')) {
            if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/profile/' . $image);
            }
        }
        if (Str::contains($image, 'category')) {
            if (file_exists(storage_path('app/public/admin-assets/images/categories/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/categories/' . $image);
            }
        }
        if (Str::contains($image, 'product')) {
            if (file_exists(storage_path('app/public/admin-assets/images/product/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/product/' . $image);
            }
        }
        if (Str::contains($image, 'login') || Str::contains($image, 'default') || Str::contains($image, 'quick-call-')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/' . $image);
            }
        }
        if (Str::contains($image, 'banktransfer') || Str::contains($image, 'cod') || Str::contains($image, 'razorpay') || Str::contains($image, 'stripe') || Str::contains($image, 'wallet') || Str::contains($image, 'flutterwave') || Str::contains($image, 'paystack') || Str::contains($image, 'mercadopago') || Str::contains($image, 'paypal') || Str::contains($image, 'myfatoorah') || Str::contains($image, 'toyyibpay') || Str::contains($image, 'phonepe') || Str::contains($image, 'paytab') || Str::contains($image, 'mollie') || Str::contains($image, 'khalti') || Str::contains($image, 'xendit') || Str::contains($image, 'payment')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/payment/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/payment/' . $image);
            }
        }
        if (Str::contains($image, 'logo')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/defaultimages/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/' . $image);
            }
            if (file_exists(storage_path('app/public/admin-assets/images/about/logo/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/logo/' . $image);
            }
        }
        if (Str::contains($image, 'favicon')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/favicon/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/favicon/' . $image);
            }
            if (file_exists(storage_path('app/public/admin-assets/images/about/defaultimages/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/' . $image);
            }
        }
        if (Str::contains($image, 'og_image')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/og_image/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/og_image/' . $image);
            }
            if (file_exists(storage_path('app/public/admin-assets/images/about/defaultimages/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/defaultimages/' . $image);
            }
        }
        if (Str::contains($image, 'banner') || Str::contains($image, 'promotion')) {
            if (file_exists(storage_path('app/public/admin-assets/images/banners/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/banners/' . $image);
            }
        }
        if (Str::contains($image, 'blog')) {
            if (file_exists(storage_path('app/public/admin-assets/images/blog/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/blog/' . $image);
            }
        }
        if (Str::contains($image, 'flag')) {
            if (file_exists(storage_path('app/public/admin-assets/images/language/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/language/' . $image);
            }
        }
        if (Str::contains($image, 'subscribe')) {
            if (file_exists(storage_path('app/public/admin-assets/images/index/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/index/' . $image);
            }
        }
        if (Str::contains($image, 'screenshot')) {
            if (file_exists(storage_path('app/public/admin-assets/images/screenshot/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/screenshot/' . $image);
            }
        }
        if (Str::contains($image, 'viewallpage_banner')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/viewallpage_banner/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/viewallpage_banner/' . $image);
            }
        }
        if (Str::contains($image, 'trusted_badge')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/trusted_badge/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/about/trusted_badge/' . $image);
            }
        }

        if (Str::contains($image, 'feature-')) {
            if (file_exists(storage_path('app/public/admin-assets/images/feature/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/feature/' . $image);
            }
        }
        if (Str::contains($image, 'testimonial-')) {
            if (file_exists(storage_path('app/public/admin-assets/images/testimonials/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/testimonials/' . $image);
            }
        }
        if (Str::contains($image, 'theme-')) {
            if (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            }
        }
        if (Str::contains($image, 'cover')) {
            if (file_exists(storage_path('app/public/admin-assets/images/coverimage/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/coverimage/' . $image);
            }
        }
        if (Str::contains($image, 'app') || Str::contains($image, 'work') || Str::contains($image, 'whoweare') || Str::contains($image, 'order') || Str::contains($image, 'auth') || Str::contains($image, 'order_detail') || Str::contains($image, 'order_success') || Str::contains($image, 'no_data') || Str::contains($image, 'referral') || Str::contains($image, 'maintenance') || Str::contains($image, 'store_unavailable') || Str::contains($image, 'faq')) {
            if (file_exists(storage_path('app/public/admin-assets/images/index/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/index/' . $image);
            }
        }
        if (Str::contains($image, 'gallery')) {
            if (file_exists(storage_path('app/public/admin-assets/images/gallery/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/gallery/' . $image);
            }
        }
        if (Str::contains($image, 'contact')) {
            if (file_exists(storage_path('app/public/admin-assets/images/contact/' . $image))) {
                $url = url(env('ASSETPATHURL') . 'admin-assets/images/contact/' . $image);
            }
        }
        return $url;
    }

    public static function checkplan($id, $type)
    {

        $check = SystemAddons::where('unique_identifier', 'subscription')->first();

        if (@$check->activated != 1) {
            return response()->json(['status' => 1, 'message' => '', 'expdate' => "", 'showclick' => "0", 'plan_message' => '', 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
        }
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            date_default_timezone_set(helper::appdata($id)->timezone);
            $vendorinfo = User::where('id', $id)->first();
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $storeinfo = Settings::where('custom_domain', $host)->first();
            date_default_timezone_set(helper::appdata($storeinfo->vendor_id)->timezone);
            $vendorinfo = User::where('id', $storeinfo->vendor_id)->first();
        }

        if ($vendorinfo->is_available == 2) {
            return response()->json(['status' => 2, 'message' => trans('messages.account_blocked_by_admin'), 'showclick' => "0", 'plan_message' => '', 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
        }
        $checkplan = Transaction::where('plan_id', $vendorinfo->plan_id)->where('vendor_id', $vendorinfo->id)->orderByDesc('id')->first();
        $totalservice = Products::where('vendor_id', $vendorinfo->id)->count();
        if ($vendorinfo->allow_without_subscription != 1) {

            if (!empty($checkplan)) {
                if ($vendorinfo->is_available == 2) {
                    return response()->json(['status' => 2, 'message' => trans('messages.account_blocked_by_admin'), 'showclick' => "0", 'plan_message' => '', 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                }
                if ($checkplan->payment_type == 1) {
                    if ($checkplan->status == 1) {
                        return response()->json(['status' => 2, 'message' => trans('messages.cod_pending'), 'showclick' => "0", 'plan_message' => trans('messages.cod_pending'), 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => '1'], 200);
                    } elseif ($checkplan->status == 3) {
                        return response()->json(['status' => 2, 'message' => trans('messages.cod_rejected'), 'showclick' => "1", 'plan_message' => trans('messages.cod_rejected'), 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                    }
                }
                if ($checkplan->payment_type == 6) {
                    if ($checkplan->status == 1) {
                        return response()->json(['status' => 2, 'message' => trans('messages.bank_request_pending'), 'showclick' => "0", 'plan_message' => trans('messages.bank_request_pending'), 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => '1'], 200);
                    } elseif ($checkplan->status == 3) {
                        return response()->json(['status' => 2, 'message' => trans('messages.bank_request_rejected'), 'showclick' => "1", 'plan_message' => trans('messages.bank_request_rejected'), 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                    }
                }
                if ($checkplan->expire_date != "") {
                    if (date('Y-m-d') > $checkplan->expire_date) {

                        return response()->json(['status' => 2, 'message' => trans('messages.plan_expired'), 'expdate' => $checkplan->expire_date, 'showclick' => "1", 'plan_message' => trans('messages.plan_expired'), 'plan_date' => $checkplan->expire_date, 'checklimit' => '', 'bank_transfer' => ''], 200);
                    }
                }
                if (Str::contains(request()->url(), 'admin')) {
                    if ($checkplan->service_limit != -1) {
                        if ($totalservice >= $checkplan->service_limit) {
                            if (Auth::user()->type == 1) {
                                return response()->json(['status' => 2, 'message' => trans('messages.products_limit_exceeded'), 'expdate' => '', 'showclick' => "1", 'plan_message' => trans('messages.plan_expires'), 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                            }
                            if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                if ($checkplan->expire_date != "") {
                                    return response()->json(['status' => 2, 'message' => trans('messages.vendor_products_limit_message'), 'expdate' => '', 'showclick' => "2", 'plan_message' => trans('messages.plan_expires'), 'plan_date' => $checkplan->expire_date, 'checklimit' => 'service', 'bank_transfer' => ''], 200);
                                } else {
                                    return response()->json(['status' => 2, 'message' => trans('messages.vendor_products_limit_message'), 'expdate' => '', 'showclick' => "2", 'plan_message' => trans('messages.lifetime_subscription'), 'plan_date' => $checkplan->expire_date, 'checklimit' => 'service', 'bank_transfer' => ''], 200);
                                }
                            }
                        }
                    }
                    if ($checkplan->appoinment_limit != -1) {
                        if ($checkplan->appoinment_limit <= 0) {
                            if (Auth::user()->type == 1) {
                                return response()->json(['status' => 2, 'message' => trans('messages.order_limit_exceeded'), 'expdate' => '', 'showclick' => "1", 'plan_message' => trans('messages.plan_expires'), 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                            }
                            if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                if ($checkplan->expire_date != "") {
                                    return response()->json(['status' => 2, 'message' => trans('messages.vendor_order_limit_message'), 'expdate' => '', 'showclick' => "1", 'plan_message' => trans('messages.plan_expires'), 'plan_date' => $checkplan->expire_date, 'checklimit' => 'booking', 'bank_transfer' => ''], 200);
                                } else {
                                    return response()->json(['status' => 2, 'message' => trans('messages.vendor_order_limit_message'), 'expdate' => '', 'showclick' => "1", 'plan_message' => trans('messages.lifetime_subscription'), 'plan_date' => $checkplan->expire_date, 'checklimit' => 'service', 'bank_transfer' => ''], 200);
                                }
                            }
                        }
                    }
                }
                if ($type == 3) {

                    if ($checkplan->appoinment_limit != -1) {
                        if ($checkplan->appoinment_limit <= 0) {
                            return response()->json(['status' => 2, 'message' => trans('messages.front_store_unavailable'), 'expdate' => '', 'showclick' => "1", 'plan_message' => trans('messages.plan_expires'), 'plan_date' => '', 'checklimit' => 'booking', 'bank_transfer' => ''], 200);
                        }
                    }
                }
                if ($checkplan->expire_date != "") {

                    return response()->json(['status' => 1, 'message' => trans('messages.plan_expires'), 'expdate' => $checkplan->expire_date, 'showclick' => "0", 'plan_message' => trans('messages.plan_expires'), 'plan_date' => $checkplan->expire_date, 'checklimit' => '', 'bank_transfer' => ''], 200);
                } else {

                    return response()->json(['status' => 1, 'message' => trans('messages.lifetime_subscription'), 'expdate' => $checkplan->expire_date, 'showclick' => "0", 'plan_message' => trans('messages.lifetime_subscription'), 'plan_date' => $checkplan->expire_date, 'checklimit' => '', 'bank_transfer' => ''], 200);
                }
            } else {
                if (Auth::user()->type == 1) {
                    return response()->json(['status' => 2, 'message' => trans('messages.doesnot_select_any_plan'), 'expdate' => '', 'showclick' => "0", 'plan_message' => '', 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                }
                if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                    return response()->json(['status' => 2, 'message' => trans('messages.vendor_plan_purchase_message'), 'expdate' => '', 'showclick' => "1", 'plan_message' => '', 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
                }
            }
        } else {
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'expdate' => '', 'showclick' => "1", 'plan_message' => '', 'plan_date' => '', 'checklimit' => '', 'bank_transfer' => ''], 200);
        }
    }
    public static function plandetail($plan_id)
    {
        $planinfo = PricingPlan::where('id', $plan_id)->first();
        return $planinfo;
    }

    // front
    public static function vendordata($slug)
    {
        $data = User::where('slug', $slug)->where('is_available', 1)->where('is_deleted', 2)->first();
        if (empty($data)) {
            abort(404);
        }
        return $data;
    }
    public static function footer_features($vendor_id)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            return Footerfeatures::select('id', 'icon', 'title', 'description')->where('vendor_id', $vendor_id)->get();
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
            return Footerfeatures::select('id', 'icon', 'title', 'description')->where('vendor_id', $vdata)->get();
        }
        
        
    }

    public static function stripe_data($vendor_id)
    {
        $data = Payment::select('environment', 'payment_name', 'public_key', 'secret_key', 'currency')->where('payment_name', 'stripe')->where('is_available', 1)->first();
        if ($vendor_id != "") {
            $data = Payment::select('environment', 'payment_name', 'public_key', 'secret_key', 'currency')->where('payment_name', 'stripe')->where('is_available', 1)->where('vendor_id', $vendor_id)->first();
        }
        return $data;
    }
    public static function get_plan_exp_date($duration, $days)
    {
        date_default_timezone_set(helper::appdata('')->timezone);
        $purchasedate = date("Y-m-d h:i:sa");
        $exdate = "";
        if (!empty($duration) && $duration != "") {
            if ($duration == "1") {
                $exdate = date('Y-m-d', strtotime($purchasedate . ' + 30 days'));
            }
            if ($duration == "2") {
                $exdate = date('Y-m-d', strtotime($purchasedate . ' + 90 days'));
            }
            if ($duration == "3") {
                $exdate = date('Y-m-d', strtotime($purchasedate . ' + 180 days'));
            }
            if ($duration == "4") {
                $exdate = date('Y-m-d', strtotime($purchasedate . ' + 365 days'));
            }
            if ($duration == "5") {
                $exdate = "";
            }
        }
        if (!empty($days) && $days != "") {
            $exdate = date('Y-m-d', strtotime($purchasedate . ' + ' . $days .  'days'));
        }
        return $exdate;
    }
    // Web
    public static function getmaxprice($vendor_id)
    {
        $d = Products::select('price')->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->orderByDesc('price')->first();
        if (!empty($d)) {
            $d = $d->price;
        } else {
            $d = 0;
        }
        return $d;
    }
    public static function getcartcount($vendor_id, $session_id, $user_id)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vdata = $vendor_id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }

        if ($user_id != "") {
            $cnt = Cart::where('vendor_id', $vdata)->where('user_id', $user_id)->where('buynow', 0)->count();
        } else {
            $cnt = Cart::where('vendor_id', $vdata)->where('session_id', $session_id)->where('buynow', 0)->count();
        }
        return $cnt;
    }
    public static function getcategories($vendor_id, $limit)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vdata = $vendor_id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }
        // NOTE :-- pass $limit = "" (blank) if need all records
        return Category::select('id', 'name', 'slug', 'image')->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vdata)->take($limit)->orderBy('reorder_id')->get();
    }
    public static function getsubcategories($category_id, $limit)
    {
        // NOTE :-- pass $limit = "" (blank) if need all records
        return SubCategory::select('id', 'category_id', 'name', 'slug')->where('is_available', 1)->where('is_deleted', 2)->where('category_id', $category_id)->orderBy('reorder_id')->take($limit)->get();
    }
    public static function getblogs($vendor_id, $limit, $unique)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vdata = $vendor_id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();

            $vdata = $vendordata->vendor_id;
        }

        // NOTE :-- pass $limit = "" (blank) if need all records
        $data = Blog::where('vendor_id', $vdata)->orderBy('reorder_id')->take($limit)->get();
        if ($unique != "") {
            $data = Blog::where('vendor_id', $vdata)->where('id', '!=', $unique)->orderBy('reorder_id')->take($limit)->get();
        }
        return $data;
    }
    public static function getcouponcodecount($vendor_id, $coupon_code)
    {
        $count = Order::where('vendor_id', $vendor_id)->where('offer_code', $coupon_code)->count();
        return $count;
    }
    public static function getcoupons($vendor_id)
    {
        $coupons = Promocode::where('vendor_id', $vendor_id)->where('is_available', 1)->where('start_date', '<=', date('Y-m-d'))->where('exp_date', '>=', date('Y-m-d'))->orderBy('reorder_id')->get();
        $data = array();
        foreach ($coupons as $prod) {
            $count = helper::getcouponcodecount($vendor_id, $prod->offer_code);
            if ($prod->usage_type == 1) {
                if ($count < $prod->usage_limit) {
                    $data[] = $prod;
                }
            } else {
                $data[] = $prod;
            }
        }
        return $data;
    }
    public static function createorder($vendor_slug, $session_id, $user_id, $user_name, $user_email, $user_mobile, $transaction_type, $transaction_id, $billing_address, $billing_landmark, $billing_postal_code, $billing_city, $billing_state, $billing_country, $shipping_address, $shipping_landmark, $shipping_postal_code, $shipping_city, $shipping_state, $shipping_country, $shipping_area, $delivery_charge, $grand_total, $sub_total, $tax_amount, $tax_name, $notes, $offer_code, $offer_amount, $filename, $order_type)
    {
        try {

            $host = $_SERVER['HTTP_HOST'];
            if ($host  ==  env('WEBSITE_HOST')) {
                $vendordata = helper::vendordata($vendor_slug);

                $vdata = $vendordata->id;
            }
            // if the current host doesn't contain the website domain (meaning, custom domain)
            else {
                $vendordata = Settings::where('custom_domain', $host)->first();

                $vdata = $vendordata->vendor_id;
            }
            if (helper::appdata($vdata)->product_type == 1) {
                $defaultsatus = CustomStatus::where('vendor_id', $vdata)->where('type', 1)->where('order_type', $order_type)->where('is_available', 1)->where('is_deleted', 2)->first();

                if (empty($defaultsatus) && $defaultsatus == null) {
                    return false;
                }
            }
            $checkplan = Transaction::where('vendor_id', @$vdata)->where('transaction_type', null)->orderByDesc('id')->first();

            date_default_timezone_set(helper::appdata(@$vdata)->timezone);
            $getordernumber = Order::select('order_number', 'order_number_digit', 'order_number_start')->where('vendor_id', $vdata)->orderBy('id', 'DESC')->first();
            if (empty($getordernumber->order_number_digit)) {
                $n = helper::appdata($vdata)->order_number_start;
                $newbooking_number = str_pad($n, 0, STR_PAD_LEFT);
            } else {
                if ($getordernumber->order_number_start == helper::appdata($vdata)->order_number_start) {
                    $n = (int)($getordernumber->order_number_digit);
                    $newbooking_number = str_pad($n + 1, 0, STR_PAD_LEFT);
                } else {
                    $n = helper::appdata($vdata)->order_number_start;
                    $newbooking_number = str_pad($n, 0, STR_PAD_LEFT);
                }
            }
            $order = new Order;
            $order_number = helper::appdata($vdata)->order_prefix . $newbooking_number;

            $trackurl = URL::to(@$vendordata->slug . '/find-order?order=' . $order_number);
            $successurl = URL::to(@$vendordata->slug . '/orders-success-' . $order_number);

            if ($user_id == "" || $user_id == null) {
                if ($session_id == "" || $session_id == null) {
                    $session_id = session()->getId();
                }
            } else {
                $order->user_id = $user_id;
            }
            if ($user_id > 0) {
                $checkcart = Cart::where('vendor_id', @$vdata)->where('user_id', $user_id)->get();
            } else {
                $checkcart = Cart::where('vendor_id', @$vdata)->where('session_id', $session_id)->get();
            }

            if ($checkcart->count() > 0) {
                $order->order_number = $order_number;
                $order->order_number_digit = $newbooking_number;
                $order->order_number_start = helper::appdata($vdata)->order_number_start;
                $order->vendor_id = @$vdata;
                $order->user_name = $user_name;
                $order->user_email = $user_email;
                $order->user_mobile = $user_mobile;
                $order->session_id = $session_id;
                $order->billing_address = $billing_address;
                $order->billing_landmark = $billing_landmark;
                $order->billing_postal_code = $billing_postal_code;
                $order->billing_city = $billing_city;
                $order->billing_state = $billing_state;
                $order->billing_country = $billing_country;
                $order->shipping_address = $shipping_address;
                $order->shipping_landmark = $shipping_landmark;
                $order->shipping_postal_code = $shipping_postal_code;
                $order->shipping_city = $shipping_city;
                $order->shipping_state = $shipping_state;
                $order->shipping_country = $shipping_country;
                $order->shipping_area = $shipping_area;
                $order->offer_code = $offer_code;
                $order->offer_amount = $offer_amount;
                $order->transaction_type = $transaction_type;
                if ($transaction_type != 1) {
                    $order->transaction_id = $transaction_id;
                } else {
                    $order->transaction_id = "";
                }
                $order->delivery_charge = $delivery_charge;
                $order->grand_total = $grand_total;
                $order->sub_total = $sub_total;
                $order->tax_amount = $tax_amount;
                $order->tax_name = $tax_name;
                $order->notes = $notes;
                if (helper::appdata($vdata)->product_type == 1) {
                    $order->status = $defaultsatus->id;
                    $order->status_type = $defaultsatus->type;
                } else {
                    $order->status_type = 3;
                }
                $order->order_type = $order_type;
                if ($transaction_type == 1 || $transaction_type == 6) {
                    $payment_status = 1;
                } else {
                    $payment_status = 2;
                }
                if ($transaction_type == 6) {
                    $order->screenshot = $filename;
                }
                $order->payment_status = $payment_status;

                if ($order->save()) {
                    $checkuser = User::where('is_available', 1)->where('vendor_id', $vdata)->where('id', @Auth::user()->id)->first();
                    if ($transaction_type == 16) {
                        $checkuser->wallet = $checkuser->wallet - $grand_total;
                        $transaction = new Transaction();
                        $transaction->user_id = @$checkuser->id;
                        $transaction->order_id = $order->id;
                        $transaction->order_number = $order_number;
                        $transaction->payment_type = 16;
                        $transaction->transaction_type = 2;
                        $transaction->amount = $grand_total;
                        if ($transaction->save()) {
                            $checkuser->save();
                        }
                    }
                    foreach ($checkcart as $cart) {
                        $od = new OrderDetails();
                        $od->vendor_id = @$vdata;
                        $od->order_id = $order->id;
                        $od->user_id = $user_id;
                        $od->session_id = session()->getId();
                        $od->product_id = $cart->product_id;
                        $od->product_name = $cart->product_name;
                        $od->product_slug = $cart->product_slug;
                        $od->product_image = $cart->product_image;
                        $od->variation_id = $cart->variation_id;
                        $od->variation_name = $cart->variation_name;
                        $od->extras_id = $cart->extras_id;
                        $od->extras_name = $cart->extras_name;
                        $od->extras_price = $cart->extras_price;
                        $od->attribute = $cart->attribute;
                        $od->product_tax = $cart->product_tax;
                        $od->product_price = $cart->product_price;
                        $od->price = $cart->price;
                        $od->qty = $cart->qty;

                        $od->save();
                        if ($cart->variation_id == 0 || $cart->variation_id == "" || $cart->variation_id == null) {
                            $product = Products::where('id', $cart->product_id)->where('vendor_id', $cart->vendor_id)->first();
                            $product->qty = $product->qty != 0 ?  (int)$product->qty - (int)$cart->qty : 0;
                            $product->update();
                        } else {

                            $variant = Variation::where('product_id', $cart->product_id)->where('id', $cart->variation_id)->first();
                            $variant->qty = $variant->qty != 0 ? (int)$variant->qty - (int)$cart->qty : 0;
                            $variant->update();
                        }
                        $cart->delete();
                    }
                    if (!empty($checkplan)) {
                        if ($checkplan->appoinment_limit != -1) {
                            $checkplan->appoinment_limit -= 1;
                            $checkplan->save();
                        }
                    }
                    $orderdata = Order::where('id', $order->id)->first();
                    $emaildata = helper::emailconfigration($vdata);
                    Config::set('mail', $emaildata);
                    helper::create_order_invoice($user_email, $user_name, $vendordata->email, $vendordata->name, $vdata, $order_number, helper::date_formate($orderdata->created_at, $vdata), $trackurl, helper::currency_formate($grand_total, $vdata));

                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'successurl' => $successurl, 'order_number' => $order_number], 200);
                } else {

                    return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
                }
            } else {

                return response()->json(['status' => 0, 'message' => trans('messages.cart_empty')], 200);
            }
        } catch (\Throwable $th) {

            dd($th);
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }


    public static function whatsappmessage($order_number, $vendor_slug, $vendordata)
    {
        $pagee[] = "";
        $payment_type = "-";
        $payment_status = "";

        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($vendor_slug);

            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();

            $vdata = $vendordata->vendor_id;
        }

        $getorder = Order::where('order_number', $order_number)->where('vendor_id', $vdata)->first();
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
            $item_message = helper::appdata($vendordata->id)->item_message;
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
        $itemlist = str_replace(',', '%0a', $items);
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
            $var = ["{order_no}", "{payment_status}", "{item_variable}", "{sub_total}", "{total_tax}", "{offer_code}", "{discount_amount}", "{delivery_charge}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{customer_email}", "{billing_address}", "{billing_city}", "{billing_state}", '{billing_country}', "{billing_landmark}", "{billing_postal_code}", "{shipping_address}", "{shipping_city}", "{shipping_state}", "{shipping_country}", "{shipping_postal_code}", "{shipping_landmark}", "{payment_type}", "{track_order_url}", "{store_url}", "{store_name}", "{date}", "{time}"];
            $newvar   = [$getorder->order_number, $payment_status, $itemlist, helper::currency_formate($getorder->sub_total, $vdata), $tax_val, $getorder->offer_code, helper::currency_formate($getorder->offer_amount, $vdata), helper::currency_formate($getorder->delivery_charge, $vdata), helper::currency_formate($getorder->grand_total, $vdata), $getorder->notes, $getorder->user_name, $getorder->user_mobile, $getorder->user_email, $getorder->billing_address, $getorder->billing_city, $getorder->billing_state, $getorder->billing_country, $getorder->billing_landmark, $getorder->billing_postal_code,  $getorder->shipping_address, $getorder->shipping_city, $getorder->shipping_state, $getorder->shipping_country, $getorder->shipping_postal_code, $getorder->shipping_landmark, @helper::getpayment($getorder->transaction_type, $vdata)->payment_name, URL::to($vendordata->slug . '/find-order?order=' . $order_number), URL::to($vendordata->slug), $vendordata->name, helper::date_formate($getorder->created_at, $vdata), helper::time_formate($getorder->created_at, $vdata)];
        } else {
            $var = ["{order_no}", "{payment_status}", "{item_variable}", "{sub_total}", "{total_tax}", "{offer_code}", "{discount_amount}", "{grand_total}", "{notes}", "{customer_name}", "{customer_mobile}", "{customer_email}", "{payment_type}", "{track_order_url}", "{store_url}", "{store_name}", "{date}", "{time}"];
            $newvar   = [$getorder->order_number, $payment_status, $itemlist, helper::currency_formate($getorder->sub_total, $vdata), $tax_val, $getorder->offer_code, helper::currency_formate($getorder->offer_amount, $vdata), helper::currency_formate($getorder->grand_total, $vdata), $vendordata->name, $getorder->notes, $getorder->user_name, $getorder->user_mobile, $getorder->user_email, @helper::getpayment($getorder->transaction_type, $vdata)->payment_name, URL::to($vendordata->slug . '/find-order?order=' . $order_number), URL::to($vendordata->slug), $vendordata->name, helper::date_formate($getorder->created_at, $vdata), helper::time_formate($getorder->created_at, $vdata)];
        }

        $whmessage = str_replace($var, $newvar, str_replace("\n", "%0a", helper::appdata($vdata)->whatsapp_message));

        return $whmessage;
    }
    public static function ceckfavorite($product_id, $vendor_id, $user_id)
    {
        $getfavorite = Favorite::where('vendor_id', $vendor_id)->where('user_id', $user_id)->where('product_id', $product_id)->first();
        return $getfavorite;
    }

    public static function language($vendor_id)
    {
        if (session()->get('locale') == null) {
            $layout = Languages::select('name', 'layout', 'image', 'is_default', 'code')->where('code', helper::appdata($vendor_id)->default_language)->first();
            App::setLocale($layout->code);
            session()->put('locale', $layout->code);
            session()->put('language', $layout->name);
            session()->put('flag', $layout->image);
            session()->put('direction', $layout->layout);
        } else {
            $layout = Languages::select('name', 'layout', 'image', 'is_default', 'code')->where('code', session()->get('locale'))->first();
            App::setLocale(session()->get('locale'));
            session()->put('locale', @$layout->code);
            session()->put('language', @$layout->name);
            session()->put('flag', @$layout->image);
            session()->put('direction', @$layout->layout);
        }
    }

    public static function listoflanguage()
    {
        $listoflanguage = Languages::where('is_available', '1')->get();
        return $listoflanguage;
    }

    public static function vendor_register($vendor_name, $vendor_email, $vendor_mobile, $vendor_password, $firebasetoken, $slug, $google_id, $facebook_id, $country_id, $city_id, $store, $product_type)
    {
        try {
            if (!empty($slug)) {
                $slug;
            } else {
                $check = User::where('slug', Str::slug($vendor_name, '-'))->first();
                if ($check != "") {
                    $last = User::select('id')->orderByDesc('id')->first();
                    $slug =   Str::slug($vendor_name . " " . ($last->id + 1), '-');
                } else {
                    $slug = Str::slug($vendor_name, '-');
                }
            }
            $rec = Settings::where('vendor_id', '1')->first();

            date_default_timezone_set($rec->timezone);
            $logintype = "normal";
            if ($google_id != "") {
                $logintype = "google";
            }

            if ($facebook_id != "") {
                $logintype = "facebook";
            }
            if ($product_type == null) {
                $product_type = 1;
            }
            $user = new User();
            $otp = rand(111111, 999999);
            $user->name = $vendor_name;
            $user->email = $vendor_email;
            $user->password = $vendor_password;
            $user->google_id = $google_id;
            $user->facebook_id = $facebook_id;
            $user->mobile = $vendor_mobile;
            $user->login_type = $logintype;
            $user->type = 2;
            $user->image = "default.png";
            $user->token = $firebasetoken;
            $user->slug = $slug;
            $user->is_available = "1";
            $user->is_verified = "1";
            $user->otp = $otp;
            $user->country_id = $country_id;
            $user->city_id = $city_id;
            $user->store_id = $store;
            $user->save();
            $vendor_id = \DB::getPdo()->lastInsertId();
            $status_name = CustomStatus::where('vendor_id', '1')->get();

            foreach ($status_name as $name) {
                $customstatus = new CustomStatus();
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
                $gateway = new Payment();
                $gateway->vendor_id = $vendor_id;
                $gateway->payment_name = $payment->payment_name;
                $gateway->unique_identifier = $payment->unique_identifier;
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

            $vendorcontactemailmessage = "Dear {vendorname},

You have received new inquiry

Full Name : {username}

Email : {useremail}

Mobile : {usermobile}

Message : {usermessage}";

            $neworderinvoicemailmessage = "Dear {customername},

We are pleased to confirm that we have received your Order.

Order details

Order number : #{ordernumber}
Order Date : {orderdate}
Grand Total : {grandtotal}

Click Here : {track_order_url}

Thank you for choosing.

Sincerely,
{vendorname}";

            $vendorneworderemailmessage = "Dear {vendorname},

We are writing to confirm that you have received new Order.

Order details

Order number : #{ordernumber}
Order Date : {orderdate}
Grand Total : {grandtotal}

Sincerely,
{customername}";

            $orderstatusemailmessage = "Dear {customername},

I am writing to inform you that {status_message}

Sincerely
{vendorname}";

            $userreferralearningmessage = "Dear {referral_user},

Your friend {new_user} has used your referral code to register with {company_name}.
You have earned {referral_amount} referral amount in your wallet.

Note : Do not reply to this notification message,this message was auto-generated by the sender's security system.

All Rights Reserved.";
            $landingsettings = LandingSettings::where('vendor_id', 1)->first();
            $data = new Settings();

            $data->logo = "default.png";
            $data->favicon = "default.png";
            $data->viewallpage_banner = "";
            $data->email = $vendor_email;
            $data->mobile = $vendor_mobile;
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
            $data->whatsapp_number = $vendor_mobile;
            $data->item_message = "🔵{item_name} X  {qty}  {variantsdata} - {item_price}";
            $data->product_type = $product_type;
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
            $data->contact_email_message = $vendorcontactemailmessage;
            $data->new_order_invoice_email_message = $neworderinvoicemailmessage;
            $data->vendor_new_order_email_message = $vendorneworderemailmessage;
            $data->order_status_email_message = $orderstatusemailmessage;
            $data->referral_earning_email_message = $userreferralearningmessage;
            $data->save();
            $emaildata = helper::emailconfigration(helper::appdata('')->id);
            Config::set('mail', $emaildata);
            helper::send_mail_vendor_register($user);
            return $vendor_id;
            $data->og_image = "default.png";
        } catch (\Throwable $th) {

            return $th;
        }
    }

    public static function product_count($category_id)
    {
        $count = Products::where('category_id', $category_id)->count();
        return $count;
    }
    public static function role($id)
    {
        $role = RoleManager::where('id', $id)->first();
        return $role;
    }
    public static function check_menu($role_id, $slug)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        if ($role_id == "" || $role_id == null || $role_id == 0) {
            return 1;
        } else {
            $module = RoleManager::where('id', $role_id)->where('vendor_id', $vendor_id)->first();
            $module = explode(',', $module->module);
            if (in_array($slug, $module)) {
                return 1;
            } else {

                return 0;
            }
        }
    }
    public static function check_access($module, $role_id, $vendor_id, $action)
    {
        $module = RoleAccess::where('module_name', $module)->where('role_id', $role_id)->where('vendor_id', $vendor_id)->first();
        if (!empty($module) && $module != null) {
            if ($action == 'add' && $module->add == 1) {
                return 1;
            } elseif ($action == 'edit' && $module->edit == 1) {
                return 1;
            } elseif ($action == 'delete' && $module->delete == 1) {
                return 1;
            } elseif ($action == 'manage' && $module->manage == 1) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public static function getplantransaction($vendor_id)
    {
        $plan = Transaction::where('vendor_id', $vendor_id)->orderbyDesc('id')->first();
        return $plan;
    }
    public static function getslug($vendor_id)
    {
        $data = User::where('id', $vendor_id)->first();
        return $data;
    }
    public static function getpixelid($vendor_id)
    {
        $pixcel = Pixcel::where('vendor_id', $vendor_id)->first();
        return $pixcel;
    }
    public static function checklowqty($item_id, $vendor_id)
    {
        $item = Products::where('id', $item_id)->where('vendor_id', $vendor_id)->first();
        if ($item->has_variants == 1) {
            $qty = Variation::select('product_id', 'qty')->where('product_id', $item_id)->get();
            $array = [];

            foreach ($qty as $qty) {
                array_push($array, $qty->qty);
            }
            if (in_array(0, $array)) {
                return 2;
            }
            if (count(array_filter($array)) == 0) {
                return 3;
            }
            foreach ($array as $qty) {
                if ($qty != null && $qty != "") {
                    if ($qty <= $item->low_qty) {
                        return 1;
                    }
                }
            }
        } else {

            if ($item->qty == null && $item->qty == "") {
                return 3;
            }
            if ((string)$item->qty != null && (string)$item->qty != "") {
                if ((string)$item->qty == 0) {
                    return 2;
                }
                if ($item->qty <= $item->low_qty) {
                    return 1;
                }
            }
        }
    }

    // dynamic email configration
    public static function emailconfigration($vendor_id)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = User::where('id', $vendor_id)->where('is_available', 1)->first();
            $vdata = $vendordata->id;
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }
        $mailsettings = Settings::where('vendor_id', $vdata)->first();
        if ($mailsettings) {
            $emaildata = [
                'driver' => $mailsettings->mail_driver,
                'host' => $mailsettings->mail_host,
                'port' => $mailsettings->mail_port,
                'encryption' => $mailsettings->mail_encryption,
                'username' => $mailsettings->mail_username,
                'password' => $mailsettings->mail_password,
                'from'     => ['address' => $mailsettings->mail_fromaddress, 'name' => $mailsettings->mail_fromname]
            ];
        }
        return $emaildata;
    }
    public static function getpayment($payment_type, $vendor_id)
    {
        $payment = Payment::where('payment_type', $payment_type)->where('vendor_id', $vendor_id)->first();
        return $payment;
    }
    public static function paymentlist($vendor_id)
    {
        
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $payment = Payment::where('vendor_id', $vendor_id)->where('is_available', 1)->where('is_activate', 1)->orderBy('reorder_id')->get();
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
            $payment = Payment::where('vendor_id', $vdata)->where('is_available', 1)->where('is_activate', 1)->orderBy('reorder_id')->get();
        }
    
        return $payment;
    }

    public static function allpaymentcheckaddons($vendor_id)
    {
        $getpaymentmethods = Payment::where('is_available', '1')->where('vendor_id', $vendor_id)->where('is_activate', 1)->where('payment_type', '!=', 6)->get();
        foreach ($getpaymentmethods as $pmdata) {
            $systemAddonActivated = false;
            $addon = SystemAddons::where('unique_identifier', $pmdata->unique_identifier)->first();
            if ($addon != null && $addon->activated == 1) {
                $systemAddonActivated = true;
                break;
            }
        }
        return $systemAddonActivated;
    }
    public static function top_deals($vendor_id)
    {
        date_default_timezone_set(helper::appdata($vendor_id)->timezone);
        $current_date  = Carbon::now()->format('Y-m-d');
        $current_time  = Carbon::now()->format('H:i:s');
        $topdeal = TopDeals::where('vendor_id', $vendor_id)->first();
        $topdeals = null;
        if (SystemAddons::where('unique_identifier', 'top_deals')->first() != null && SystemAddons::where('unique_identifier', 'top_deals')->first()->activated == 1) {
            if (isset($topdeal) && $topdeal->top_deals_switch == 1) {
                $startDate = $topdeal['start_date'];
                $starttime = $topdeal['start_time'];
                $endDate = $topdeal['end_date'];
                $endtime = $topdeal['end_time'];
                // Checking validity of top deal offer
                if ($topdeal->deal_type == 1) {
                    if ($current_date > $startDate) {
                        if ($current_date < $endDate) {
                            $topdeals = TopDeals::where('vendor_id', $vendor_id)->first();
                        } elseif ($current_date == $endDate) {
                            if ($current_time < $endtime) {
                                $topdeals = TopDeals::where('vendor_id', $vendor_id)->first();
                            }
                        }
                    } elseif ($current_date == $startDate) {
                        if ($current_date < $endDate && $current_time >= $starttime) {
                            $topdeals = TopDeals::where('vendor_id', $vendor_id)->first();
                        } elseif ($current_date == $endDate) {
                            if ($current_time >= $starttime && $current_time <= $endtime) {
                                $topdeals = TopDeals::where('vendor_id', $vendor_id)->first();
                            }
                        }
                    }
                } else if ($topdeal->deal_type == 2) {
                    if ($current_time >= $starttime && $current_time <= $endtime) {
                        $topdeals = TopDeals::where('vendor_id', $vendor_id)->first();
                    }
                }
            }
        }
        return $topdeals;
    }
    public static function push_notification($token, $title, $body, $type, $order_id, $firebase)
    {
        $customdata = array(
            "type" => $type,
            "order_id" => $order_id,
        );

        $msg = array(
            'body' => $body,
            'title' => $title,
            'sound' => 1/*Default sound*/
        );
        $fields = array(
            'to'           => $token,
            'notification' => $msg,
            'data' => $customdata
        );
        $headers = array(
            'Authorization: key=' . @$firebase,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $firebaseresult = curl_exec($ch);
        curl_close($ch);
        return $firebaseresult;
    }

    public static function checkcustomdomain($vendor_id)
    {
        $customdomain = Customdomain::select('current_domain')->where('vendor_id', $vendor_id)->where('status', 2)->first();

        return @$customdomain->current_domain;
    }
    public static function subscriptionimage()
    {
        $LandingSettings = LandingSettings::where('vendor_id', 1)->first();
        return $LandingSettings;
    }
    public static function imagesize()
    {
        $imagesize  = (int)1024 * (int)helper::appdata('')->image_size;
        return $imagesize;
    }
    public static function imageext()
    {
        $imageext = 'mimes:jpeg,jpg,png,webp';
        return $imageext;
    }
    public static function getmin_maxorder($item_id, $vendor_id)
    {
        $item = Products::where('vendor_id', $vendor_id)->where('id', $item_id)->first();
        return $item;
    }
    public static function customstauts($vendor_id, $order_type)
    {
        $status = CustomStatus::where('vendor_id', $vendor_id)->where('order_type', $order_type)->where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        return $status;
    }
    public static function gettype($status, $type, $order_type, $vendor_id)
    {
        $status = CustomStatus::where('vendor_id', $vendor_id)->where('order_type', $order_type)->where('type', $type)->where('id', $status)->first();
        return $status;
    }
    public static function imageresize($file, $directory_name)
    {
        $reimage = 'product-' . uniqid() . "." . $file->getClientOriginalExtension();

        $new_width = 1000;

        // create image manager with desired driver      

        $manager = new ImageManager(new Driver());

        // read image from file system
        $image = $manager->read($file);


        // Get Height & Width
        list($width, $height) = getimagesize("$file");

        // Get Ratio
        $ratio = $width / $height;

        // Create new height & width
        $new_height = $new_width / $ratio;

        // resize image proportionally to 200px width
        $image->scale(width: $new_width, height: $new_height);

        $extension = File::extension($reimage);

        $exif = @exif_read_data("$file");

        $degrees = 0;
        if (isset($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 8:
                    $degrees = 90;
                    break;
                case 3:
                    $degrees = 180;
                    break;
                case 6:
                    $degrees = -90;
                    break;
            }
        }

        // $image->rotate($degrees);
        $convert = $image;
        if (Str::endsWith($reimage, '.jpeg')) {
            $convert = $convert->toJpeg();
        } else if (Str::endsWith($reimage, '.jpg')) {
            $convert = $convert->toJpeg();
        } else if (Str::endsWith($reimage, '.webp')) {
            $convert = $convert->toWebp();
        } else if (Str::endsWith($reimage, '.gif')) {
            $convert = $convert->toGif();
        } else if (Str::endsWith($reimage, '.png')) {
            $convert = $convert->toPng();
        } else if (Str::endsWith($reimage, '.avif')) {
            $convert = $convert->toAvif();
        } else if (Str::endsWith($reimage, '.bmp')) {
            $convert = $convert->toBitmap();
        }
        if ($extension == "webp") {
            $convertimg = $reimage;
        } else {
            $convertimg = str_replace($extension, 'webp', $reimage);
        }
        $convert->save("$directory_name/$convertimg");

        return $convertimg;
    }
    public static function available_language($vendor_id)
    {
        if ($vendor_id == "") {
            $listoflanguage = Languages::where('is_available', '1')->where('is_deleted', 2)->get();
        } else {
            $listoflanguage = Languages::where('is_deleted', 2)->get();
        }
        return $listoflanguage;
    }

    public static function getagedetails($vendor_id)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $agedetails = AgeVerification::where('vendor_id', $vendor_id)->first();
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
            $agedetails = AgeVerification::where('vendor_id', $vdata)->first();
        }
        
        return $agedetails;
    }

    public static function checkaddons($addons)
    {
        if (str_contains(url()->current(), 'admin')) {
            if (session()->get('demo') == "free-addon") {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->where('type', 1)->first();
            } elseif (session()->get('demo') == "free-with-extended-addon") {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->whereIn('type', ['1', '2'])->first();
            } elseif (session()->get('demo') == "all-addon") {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->whereIn('type', ['1', '2', '3'])->first();
            } else {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->first();
            }
        } else {
            $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->first();
        }

        return $check;
    }

    public static function checkthemeaddons($addons)
    {
        if (session()->get('demo') == "free-addon") {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->where('type', 1)->get();
        } elseif (session()->get('demo') == "free-with-extended-addon") {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->whereIn('type', ['1', '2'])->get();
        } elseif (session()->get('demo') == "all-addon") {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->whereIn('type', ['1', '2', '3'])->get();
        } else {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->get();
        }
        return $check;
    }
}

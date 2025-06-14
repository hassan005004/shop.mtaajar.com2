<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\AppSettings;
use App\Models\Transaction;
use App\Models\LandingSettings;
use App\Models\Footerfeatures;
use App\Models\SocialLinks;
use App\Models\FunFact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\helper\helper;
use App\Models\OtherSettings;

class WebSettingsController extends Controller
{
    public function basic_settings()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        $othersettingdata = OtherSettings::where('vendor_id', $vendor_id)->first();
        $theme = Transaction::select('themes_id')->where('vendor_id', $vendor_id)->orderByDesc('id')->first();
        $getfooterfeatures = Footerfeatures::where('vendor_id', $vendor_id)->get();
        $app = AppSettings::where('vendor_id', $vendor_id)->first();

        $funfacts = FunFact::where('vendor_id', $vendor_id)->get();
        $landingdata = LandingSettings::where('vendor_id', $vendor_id)->first();
        $getsociallinks = SocialLinks::where('vendor_id', $vendor_id)->get();

        return view('admin.landing.index', compact('settingdata', 'othersettingdata', 'theme', 'app', 'funfacts', 'landingdata', 'getfooterfeatures', 'getsociallinks'));
    }
    public function themeupdate(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
        if ($request->hasfile('logo')) {

            $validator = Validator::make($request->all(), [
                'logo' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
            ], [
                "logo.image" => trans('messages.enter_image_file'),
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
            }
            if (Auth::user()->type == 1) {

                if ($settingsdata->logo != "default-logo.png" && $settingsdata->logo != "" && file_exists(storage_path('app/public/admin-assets/images/about/defaultimages/' . $settingsdata->logo))) {
                    unlink(storage_path('app/public/admin-assets/images/about/defaultimages/' . $settingsdata->logo));
                }
                $logo_name = 'logo-' . uniqid() . '.' . $request->logo->getClientOriginalExtension();
                $request->file('logo')->move(storage_path('app/public/admin-assets/images/about/defaultimages/'), $logo_name);
            } else {
                if ($settingsdata->logo != "default-logo.png" && $settingsdata->logo != "" && file_exists(storage_path('app/public/admin-assets/images/about/logo/' . $settingsdata->logo))) {
                    unlink(storage_path('app/public/admin-assets/images/about/logo/' . $settingsdata->logo));
                }
                $logo_name = 'logo-' . uniqid() . '.' . $request->logo->getClientOriginalExtension();
                $request->file('logo')->move(storage_path('app/public/admin-assets/images/about/logo/'), $logo_name);
            }

            $settingsdata->logo = $logo_name;
        }
        if ($request->hasfile('favicon')) {
            $validator = Validator::make($request->all(), [
                'favicon' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
            ], [
                "favicon.image" => trans('messages.enter_image_file'),
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
            }
            if (Auth::user()->type == 1) {
                if ($settingsdata->favicon != "defaultlogo.png" && $settingsdata->favicon != "" && file_exists(storage_path('app/public/admin-assets/images/about/defaultimages/' . $settingsdata->favicon))) {
                    unlink(storage_path('app/public/admin-assets/images/about/defaultimages/' . $settingsdata->favicon));
                }
                $favicon_name = 'favicon-' . uniqid() . '.' . $request->favicon->getClientOriginalExtension();
                $request->favicon->move(storage_path('app/public/admin-assets/images/about/defaultimages/'), $favicon_name);
            } else {
                if ($settingsdata->favicon != "defaultlogo.png" && $settingsdata->favicon != "" && file_exists(storage_path('app/public/admin-assets/images/about/favicon/' . $settingsdata->favicon))) {
                    unlink(storage_path('app/public/admin-assets/images/about/favicon/' . $settingsdata->favicon));
                }
                $favicon_name = 'favicon-' . uniqid() . '.' . $request->favicon->getClientOriginalExtension();
                $request->favicon->move(storage_path('app/public/admin-assets/images/about/favicon/'), $favicon_name);
            }

            $settingsdata->favicon = $favicon_name;
        }

        if (Auth::user()->type == 1) {
            $settingsdata->landing_website_title = $request->landing_website_title;
        }
        if (Auth::user()->type == 2) {
            $settingsdata->web_title = $request->web_title;
            $settingsdata->copyright = $request->copyright;
        }
        if (Auth::user()->type == 1) {
            $landingsettings = LandingSettings::where('vendor_id', 1)->first();
            $landingsettings->primary_color = $request->landing_primary_color;
            $landingsettings->secondary_color = $request->landing_secondary_color;
            $landingsettings->update();
        } else {
            $settingsdata->primary_color = $request->landing_primary_color;
            $settingsdata->secondary_color = $request->landing_secondary_color;
        }
        $settingsdata->landing_page = isset($request->landing_page) ? 1 : 2;
        $settingsdata->theme = !empty($request->template) ? $request->template : 1;
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function seo_update(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
            $settingsdata->meta_title = $request->meta_title;
            $settingsdata->meta_description = $request->meta_description;
            if ($request->hasfile('og_image')) {

                $validator = Validator::make($request->all(), [
                    'og_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                ], [
                    "og_image.image" => trans('messages.enter_image_file'),
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                }
                if (Auth::user()->type == 1) {

                    if ($settingsdata->og_image != "" && file_exists(storage_path('app/public/admin-assets/images/about/defaultimages/' . $settingsdata->og_image))) {
                        unlink(storage_path('app/public/admin-assets/images/about/defaultimages/' . $settingsdata->og_image));
                    }
                    $image = 'og_image-' . uniqid() . '.' . $request->og_image->getClientOriginalExtension();
                    $request->og_image->move(storage_path('app/public/admin-assets/images/about/defaultimages/'), $image);
                } else {
                    if ($settingsdata->og_image != "" && file_exists(storage_path('app/public/admin-assets/images/about/og_image/' . $settingsdata->og_image))) {
                        unlink(storage_path('app/public/admin-assets/images/about/og_image/' . $settingsdata->og_image));
                    }
                    $image = 'og_image-' . uniqid() . '.' . $request->og_image->getClientOriginalExtension();
                    $request->og_image->move(storage_path('app/public/admin-assets/images/about/og_image/'), $image);
                }
                $settingsdata->og_image = $image;
            }
            $settingsdata->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', trans('messages.success'));
        }
    }
    public function footer_features_update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (!empty($request->feature_icon)) {
            foreach ($request->feature_icon as $key => $icon) {
                if (!empty($icon) && !empty($request->feature_title[$key]) && !empty($request->feature_description[$key])) {
                    $feature = new Footerfeatures;
                    $feature->vendor_id = $vendor_id;
                    $feature->icon = $icon;
                    $feature->title = $request->feature_title[$key];
                    $feature->description = $request->feature_description[$key];
                    $feature->save();
                }
            }
        }
        if (!empty($request->edit_icon_key)) {
            foreach ($request->edit_icon_key as $key => $id) {
                $feature = Footerfeatures::find($id);
                $feature->icon = $request->edi_feature_icon[$id];
                $feature->title = $request->edi_feature_title[$id];
                $feature->description = $request->edi_feature_description[$id];
                $feature->save();
            }
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_feature(Request $request)
    {
        Footerfeatures::where('id', $request->id)->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function app_section(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $appsection = AppSettings::where('vendor_id', $vendor_id)->first();
        $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
        if (empty($appsection)) {
            $appsection = new AppSettings();
        }
        $appsection->vendor_id = $vendor_id;

        if (Auth::user()->type == 2 || Auth::user()->type == 4) {
            $appsection->title = $request->title;
            $appsection->subtitle = $request->sub_title;
        }
        $appsection->android_link = $request->android_link;
        $appsection->ios_link = $request->ios_link;
        $appsection->mobile_app_on_off = isset($request->mobile_app_on_off) ? 1 : 2;
        $settingsdata->firebase = $request->firebase_server_key;
        $settingsdata->update();
        if ($request->has('image')) {

            $validator = Validator::make($request->all(), [
                'image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
            ], [
                "image.image" => trans('messages.enter_image_file'),
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
            }

            if (!empty($appsection->image)) {
                if (file_exists(storage_path('app/public/admin-assets/images/index/' .  $appsection->image))) {
                    unlink(storage_path('app/public/admin-assets/images/index/' .  $appsection->image));
                }
            }
            $image = 'appsection-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/index/'), $image);
            $appsection->image = $image;
        }
        $appsection->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function fun_fact_update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (!empty($request->funfact_icon)) {
            foreach ($request->funfact_icon as $key => $icon) {
                if (!empty($icon) && !empty($request->funfact_title[$key]) && !empty($request->funfact_subtitle[$key])) {
                    $funfact = new FunFact;
                    $funfact->vendor_id = $vendor_id;
                    $funfact->icon = $icon;
                    $funfact->title = $request->funfact_title[$key];
                    $funfact->description = $request->funfact_subtitle[$key];
                    $funfact->save();
                }
            }
        }
        if (!empty($request->edit_icon_key)) {
            foreach ($request->edit_icon_key as $key => $id) {
                $funfact = FunFact::find($id);
                $funfact->icon = $request->edi_funfact_icon[$id];
                $funfact->title = $request->edi_funfact_title[$id];
                $funfact->description = $request->edi_funfact_subtitle[$id];
                $funfact->save();
            }
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function fun_fact_delete(Request $request)
    {
        FunFact::where('id', $request->id)->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function contact_settings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        if (empty($settingdata)) {
            $settingdata = new Settings();
        }
        $settingdata->email = $request->landing_email;
        $settingdata->contact = $request->landing_mobile;
        $settingdata->address = $request->landing_address;
        if (Auth::user()->type  == 1) {
            $settingdata->whatsapp_number = $request->contact;

            $settingdata->whatsapp_chat_on_off =  isset($request->whatsapp_chat_on_off) ? 1 : 2;
            $settingdata->whatsapp_chat_position = $request->whatsapp_chat_position;
        }
        $settingdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function other_update(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            if (Auth::user()->type == 1) {
                $landingsettings = LandingSettings::where('vendor_id', $vendor_id)->first();
                $adminsetting = Settings::where('vendor_id', 1)->first();
                if (empty($landingsettings)) {

                    $landingsettings = new LandingSettings();
                }
                if ($request->hasfile('landing_home_banner')) {

                    $validator = Validator::make($request->all(), [
                        'landing_home_banner' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "landing_home_banner.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/banners/' . $landingsettings->landing_home_banner))) {
                        @unlink(storage_path('app/public/admin-assets/images/banners/' . $landingsettings->landing_home_banner));
                    }
                    $bannerimage = 'banner-' . uniqid() . '.' . $request->landing_home_banner->getClientOriginalExtension();
                    $request->landing_home_banner->move(storage_path('app/public/admin-assets/images/banners/'), $bannerimage);
                    $landingsettings->landing_home_banner = $bannerimage;
                }
                
                if ($request->hasfile('testimonial_image')) {

                    $validator = Validator::make($request->all(), [
                        'testimonial_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "testimonial_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/testimonials/' . $landingsettings->testimonial_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/testimonials/' . $landingsettings->testimonial_image));
                    }
                    $bannerimage = 'testimonial-' . uniqid() . '.' . $request->testimonial_image->getClientOriginalExtension();
                    $request->testimonial_image->move(storage_path('app/public/admin-assets/images/testimonials/'), $bannerimage);
                    $landingsettings->testimonial_image = $bannerimage;
                }

                if ($request->hasfile('subscribe_image')) {

                    $validator = Validator::make($request->all(), [
                        'subscribe_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "subscribe_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }


                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $landingsettings->subscribe_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $landingsettings->subscribe_image));
                    }
                    $bannerimage = 'subscribe-' . uniqid() . '.' . $request->subscribe_image->getClientOriginalExtension();
                    $request->subscribe_image->move(storage_path('app/public/admin-assets/images/index/'), $bannerimage);
                    $landingsettings->subscribe_image = $bannerimage;
                }
                if ($request->hasfile('faq_image')) {

                    $validator = Validator::make($request->all(), [
                        'faq_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "faq_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $landingsettings->faq_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $landingsettings->faq_image));
                    }
                    $bannerimage = 'faq-' . uniqid() . '.' . $request->faq_image->getClientOriginalExtension();
                    $request->faq_image->move(storage_path('app/public/admin-assets/images/index/'), $bannerimage);
                    $landingsettings->faq_image = $bannerimage;
                }
                if ($request->hasfile('maintenance_image')) {

                    $validator = Validator::make($request->all(), [
                        'maintenance_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "maintenance_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $adminsetting->maintenance_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $adminsetting->maintenance_image));
                    }
                    $maintenanceimage = 'maintenance-' . uniqid() . '.' . $request->maintenance_image->getClientOriginalExtension();
                    $request->maintenance_image->move(storage_path('app/public/admin-assets/images/index/'), $maintenanceimage);
                    $adminsetting->maintenance_image = $maintenanceimage;
                    $adminsetting->save();
                }
                if ($request->hasfile('store_unavailable_image')) {

                    $validator = Validator::make($request->all(), [
                        'store_unavailable_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "store_unavailable_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $adminsetting->store_unavailable_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $adminsetting->store_unavailable_image));
                    }
                    $maintenanceimage = 'store_unavailable-' . uniqid() . '.' . $request->store_unavailable_image->getClientOriginalExtension();
                    $request->store_unavailable_image->move(storage_path('app/public/admin-assets/images/index/'), $maintenanceimage);
                    $adminsetting->store_unavailable_image = $maintenanceimage;
                    $adminsetting->save();
                }
                if ($request->hasfile('auth_image')) {

                    $validator = Validator::make($request->all(), [
                        'auth_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "auth_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $adminsetting->auth_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $adminsetting->auth_image));
                    }
                    $authimage = 'auth_image-' . uniqid() . '.' . $request->auth_image->getClientOriginalExtension();
                    $request->auth_image->move(storage_path('app/public/admin-assets/images/index/'), $authimage);
                    $adminsetting->auth_image = $authimage;
                    $adminsetting->save();
                }
                $landingsettings->vendor_id = $vendor_id;
                $landingsettings->save();
            }
            if (Auth::user()->type == 2) {
                $settingdata = Settings::where('vendor_id', $vendor_id)->first();
                if ($request->hasfile('landin_page_cover_image')) {
                    $validator = Validator::make($request->all(), [
                        'landin_page_cover_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "landin_page_cover_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if ($settingdata->cover_image != "cover.png" && file_exists(storage_path('app/public/admin-assets/images/coverimage/' . $settingdata->cover_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/coverimage/' . $settingdata->cover_image));
                    }
                    $coverimage = 'cover-' . uniqid() . '.' . $request->landin_page_cover_image->getClientOriginalExtension();
                    $request->landin_page_cover_image->move(storage_path('app/public/admin-assets/images/coverimage/'), $coverimage);
                    $settingdata->cover_image = $coverimage;
                }
                if ($request->hasfile('subscribe_image')) {
                    $validator = Validator::make($request->all(), [
                        'subscribe_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "subscribe_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $settingdata->subscribe_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $settingdata->subscribe_image));
                    }
                    $bannerimage = 'subscribe-' . uniqid() . '.' . $request->subscribe_image->getClientOriginalExtension();
                    $request->subscribe_image->move(storage_path('app/public/admin-assets/images/index/'), $bannerimage);
                    $settingdata->subscribe_image = $bannerimage;
                }
                if ($request->hasfile('order_detail_image')) {

                    $validator = Validator::make($request->all(), [
                        'order_detail_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "order_detail_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $settingdata->order_detail_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $settingdata->order_detail_image));
                    }
                    $bannerimage = 'order_detail-' . uniqid() . '.' . $request->order_detail_image->getClientOriginalExtension();
                    $request->order_detail_image->move(storage_path('app/public/admin-assets/images/index/'), $bannerimage);
                    $settingdata->order_detail_image = $bannerimage;
                }
                if ($request->hasfile('viewallpage_banner')) {

                    $validator = Validator::make($request->all(), [
                        'viewallpage_banner' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "viewallpage_banner.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/about/viewallpage_banner/' . $settingdata->viewallpage_banner))) {
                        @unlink(storage_path('app/public/admin-assets/images/about/viewallpage_banner/' . $settingdata->viewallpage_banner));
                    }
                    $bannerimage = 'viewallpage_banner-' . uniqid() . '.' . $request->viewallpage_banner->getClientOriginalExtension();
                    $request->viewallpage_banner->move(storage_path('app/public/admin-assets/images/about/viewallpage_banner/'), $bannerimage);
                    $settingdata->viewallpage_banner = $bannerimage;
                }
                if ($request->hasfile('contact_image')) {

                    $validator = Validator::make($request->all(), [
                        'contact_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "contact_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/contact/' . $settingdata->contact_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/contact/' . $settingdata->contact_image));
                    }
                    $contact_image = 'contact-' . uniqid() . '.' . $request->contact_image->getClientOriginalExtension();
                    $request->contact_image->move(storage_path('app/public/admin-assets/images/contact/'), $contact_image);
                    $settingdata->contact_image = $contact_image;
                }
                if ($request->hasfile('auth_image')) {

                    $validator = Validator::make($request->all(), [
                        'auth_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "auth_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $settingdata->auth_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $settingdata->auth_image));
                    }
                    $auth_image = 'auth_image-' . uniqid() . '.' . $request->auth_image->getClientOriginalExtension();
                    $request->auth_image->move(storage_path('app/public/admin-assets/images/index/'), $auth_image);
                    $settingdata->auth_image = $auth_image;
                }
                if ($request->hasfile('order_success_image')) {
                    $validator = Validator::make($request->all(), [
                        'order_success_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "order_success_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }

                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $settingdata->order_success_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $settingdata->order_success_image));
                    }
                    $ordersuccess = 'order_success-' . uniqid() . '.' . $request->order_success_image->getClientOriginalExtension();
                    $request->order_success_image->move(storage_path('app/public/admin-assets/images/index/'), $ordersuccess);
                    $settingdata->order_success_image = $ordersuccess;
                }
                if ($request->hasfile('no_data_image')) {
                    $validator = Validator::make($request->all(), [
                        'no_data_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "no_data_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $settingdata->no_data_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $settingdata->no_data_image));
                    }
                    $ordersuccess = 'no_data-' . uniqid() . '.' . $request->no_data_image->getClientOriginalExtension();
                    $request->no_data_image->move(storage_path('app/public/admin-assets/images/index/'), $ordersuccess);
                    $settingdata->no_data_image = $ordersuccess;
                }
                if ($request->hasfile('referral_image')) {
                    $validator = Validator::make($request->all(), [
                        'referral_image' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
                    ], [
                        "referral_image.image" => trans('messages.enter_image_file'),
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
                    }
                    if (file_exists(storage_path('app/public/admin-assets/images/index/' . $settingdata->referral_image))) {
                        @unlink(storage_path('app/public/admin-assets/images/index/' . $settingdata->referral_image));
                    }
                    $referral = 'referral-' . uniqid() . '.' . $request->referral_image->getClientOriginalExtension();
                    $request->referral_image->move(storage_path('app/public/admin-assets/images/index/'), $referral);
                    $settingdata->referral_image = $referral;
                }
                $settingdata->product_ratting_switch = isset($request->product_ratting_switch) ? 1 : 2;
                $settingdata->subscribe_newsletter = isset($request->subscribe_newsletter) ? 1 : 2;
                $settingdata->online_order = isset($request->online_order_switch) ? 1 : 2;
                if (isset($request->online_order_switch)) {
                    if ($settingdata->delivery_type == "" && $settingdata->delivery_type == null) {
                        $settingdata->delivery_type = "delivery";
                    }
                }
                $settingdata->google_review = $request->google_review_url;
                $settingdata->footer_description = $request->footer_description;
                $settingdata->save();
            }
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', trans('messages.wrong'));
        }
    }

    public function social_links_update(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if (!empty($request->social_icon)) {
            foreach ($request->social_icon as $key => $icon) {
                if (!empty($icon) && !empty($request->social_link[$key])) {
                    $sociallink = new SocialLinks;
                    $sociallink->vendor_id = $vendor_id;
                    $sociallink->icon = $icon;
                    $sociallink->link = $request->social_link[$key];
                    $sociallink->save();
                }
            }
        }
        if (!empty($request->edit_icon_key)) {
            foreach ($request->edit_icon_key as $key => $id) {
                $sociallink = SocialLinks::find($id);
                $sociallink->icon = $request->edi_sociallink_icon[$id];
                $sociallink->link = $request->edi_sociallink_link[$id];
                $sociallink->save();
            }
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_sociallinks(Request $request)
    {
        SocialLinks::where('id', $request->id)->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function tips_settings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $othersettingsdata = OtherSettings::where('vendor_id', $vendor_id)->first();
        if (empty($othersettingdata)) {
            $othersettingdata = new OtherSettings();
            $othersettingdata->vendor_id = $vendor_id;
        }
        $othersettingsdata->tips_settings = isset($request->tips_settings) ? 1 : 2;
        $othersettingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function shopify_settings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingsdata = Settings::where('vendor_id', $vendor_id)->first();
        $settingsdata->shopify_store_url = $request->shopify_store_url;
        $settingsdata->shopify_access_token = $request->shopify_access_token;
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}

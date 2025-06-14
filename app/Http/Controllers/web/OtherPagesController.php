<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Subscriber;
use App\Models\Settings;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\Contact;
use Config;

class OtherPagesController extends Controller
{
    public function termscondition(Request $request)
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
        $termscondition = Settings::select('terms_content')->where('vendor_id', $vdata)->first();
        return view('web.other.terms_condition', compact('vendordata', 'termscondition'));
    }
    public function privacypolicy(Request $request)
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
        $privacypolicy = Settings::select('privacy_content')->where('vendor_id', $vdata)->first();
        return view('web.other.privacy_policy', compact('vendordata', 'privacypolicy'));
    }
    public function aboutus(Request $request)
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
        $aboutus = Settings::select('about_content')->where('vendor_id', $vdata)->first();
        return view('web.other.about_us', compact('vendordata', 'aboutus'));
    }
    public function refund_policy(Request $request)
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
        $policy = Settings::select('refund_policy')->where('vendor_id', $vdata)->first();
        return view('web.other.refund_policy', compact('vendordata', 'policy'));
    }
    public function subscribe(Request $request)
    {
        try {

            $subscriber = new Subscriber();
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
            $subscriber->vendor_id = $vdata;
            $subscriber->email = $request->subscribe_email;
            $subscriber->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function contact_us(Request $request)
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
        return view('web.contact_us', compact('vendordata'));
    }
    public function contact_store(Request $request)
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
        try {
            $contact = new Contact();
            $contact->vendor_id = $vdata;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->mobile = $request->mobile;
            $contact->message = $request->message;
            $contact->save();
            $emaildata = helper::emailconfigration($vdata);
            Config::set('mail', $emaildata);
            helper::vendor_contact_data($vdata, $vendordata->name, $vendordata->email, $request->name, $request->email, $request->mobile, $request->message);
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'))->withInput();
        }
    }
    public function gallery(Request $request)
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
        $images = Gallery::where('vendor_id', $vendordata->id)->orderBy('reorder_id')->get();
        return view('web.gallery.index', compact('vendordata', 'images'));
    }
    public function faqs(Request $request)
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
        $faqs = Faq::where('vendor_id', $vdata)->orderBy('reorder_id')->get();
        return view('web.faq', compact('vendordata', 'faqs'));
    }
}

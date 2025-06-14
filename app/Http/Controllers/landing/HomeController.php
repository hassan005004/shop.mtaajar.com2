<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Features;
use App\Models\PricingPlan;
use App\Models\User;
use App\Models\Testimonials;
use App\Models\Blog;
use App\Models\Subscriber;
use App\Models\Settings;
use App\Models\StoreCategory;
use App\Models\Country;
use App\Models\City;
use App\Models\Promotionalbanner;
use App\Models\Faq;
use App\Models\Contact;
use App\helper\helper;
use App\Models\HowWorks;
use App\Models\Theme;
use App\Models\LandingSettings;
use App\Models\FunFact;
use App\Models\AppSettings;
use App\Models\SystemAddons;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Config;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $admindata = User::where('type', 1)->first();
        $features = Features::where('vendor_id', $admindata->id)->orderBy('reorder_id')->get();
        $planlist = PricingPlan::where('is_available', 1)->orderBy('reorder_id')->get();
        $testimonials = Testimonials::where('vendor_id', $admindata->id)->where('user_id', null)->where('product_id', null)->orderBy('reorder_id')->get();
        $blogs = Blog::where('vendor_id', $admindata->id)->orderBy('reorder_id')->take(6)->get();
        $userdata = User::select('users.id', 'name', 'slug', 'settings.footer_description', 'web_title', 'cover_image')->where('available_on_landing', 1)->join('settings', 'users.id', '=', 'settings.vendor_id')->get();
        $settingdata = Settings::where('vendor_id', $admindata->id)->first();
        $workdata = HowWorks::where('vendor_id', $admindata->id)->orderBy('reorder_id')->get();
        $themes = Theme::where('vendor_id', $admindata->id)->orderBy('reorder_id')->get();
        $app_settings = AppSettings::where('vendor_id', $admindata->id)->where('mobile_app_on_off', 1)->first();
        $landingsettings = LandingSettings::where('vendor_id', $admindata->id)->first();
        $funfacts = FunFact::where('vendor_id', $admindata->id)->orderByDesc('id')->get();
        return view('landing.index', compact('features', 'planlist', 'testimonials', 'blogs', 'userdata', 'settingdata', 'workdata', 'themes', 'app_settings', 'landingsettings', 'funfacts'));
    }
    public function emailsubscribe(Request $request)
    {
        $newsubscriber = new Subscriber();
        $newsubscriber->vendor_id = 1;
        $newsubscriber->email = $request->email;
        $newsubscriber->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function inquiry(Request $request)
    {
        try {
            if (
                SystemAddons::where('unique_identifier', 'google_recaptcha')->first() != null &&
                SystemAddons::where('unique_identifier', 'google_recaptcha')->first()->activated == 1
            ) {

                if (helper::appdata('')->recaptcha_version == 'v2') {
                    $request->validate([
                        'g-recaptcha-response' => 'required'
                    ], [
                        'g-recaptcha-response.required' => 'The g-recaptcha-response field is required.'
                    ]);
                }

                if (helper::appdata('')->recaptcha_version == 'v3') {
                    $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'contact');
                    if ($score <= helper::appdata('')->score_threshold) {
                        return redirect()->back()->with('error', 'You are most likely a bot');
                    }
                }
            }
            $vendordata = User::where('id', 1)->first();
            $newinquiry = new Contact();
            $newinquiry->vendor_id = $vendordata->id;
            $newinquiry->name = $request->name;
            $newinquiry->email = $request->email;
            $newinquiry->mobile = $request->mobile;
            $newinquiry->message = $request->message;
            $newinquiry->save();
            $emaildata = helper::emailconfigration(helper::appdata('')->id);
            Config::set('mail', $emaildata);
            helper::vendor_contact_data($vendordata->id, $vendordata->name, $vendordata->email, $request->name, $request->email, $request->mobile, $request->message);
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function termscondition()
    {

        $terms = Settings::select('terms_content')->where('vendor_id', 1)->first();
        return view('landing.terms_condition', compact('terms'));
    }
    public function aboutus()
    {

        $aboutus = Settings::select('about_content')->where('vendor_id', 1)->first();
        return view('landing.aboutus', compact('aboutus'));
    }
    public function privacypolicy()
    {

        $privacypolicy = Settings::select('privacy_content')->where('vendor_id', 1)->first();
        return view('landing.privacypolicy', compact('privacypolicy'));
    }
    public function refund_policy()
    {
        $policy = Settings::select('refund_policy')->where('vendor_id', 1)->first();
        return view('landing.refund_policy', compact('policy'));
    }
    public function faqs(Request $request)
    {

        $allfaqs = Faq::where('vendor_id', 1)->orderBy('reorder_id')->get();
        return view('landing.faq', compact('allfaqs'));
    }
    public function contact()
    {

        return view('landing.contact');
    }
    public function allstores(Request $request)
    {
        $countries = Country::where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $banners = Promotionalbanner::with('vendor_info')->orderBy('reorder_id')->get();
        $storecategory = StoreCategory::where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        $stores = User::where('type', 2)->where('is_available', 1)->where('is_deleted', 2);
        if ($request->country == "" && $request->city == "") {
            $stores = $stores;
        }
        $city_name = "";
        if ($request->has('country') && $request->country != "") {
            $country = Country::select('id')->where('name', $request->country)->first();
            $stores =  $stores->where('country_id', $country->id);
        }
        if ($request->has('city') && $request->city != "") {
            $city = City::where('city', $request->city)->first();
            $stores =  $stores->where('city_id', $city->id);
            $city_name = $city->city;
        }
        if ($request->has('store') && $request->store != "") {
            $storeinfo = StoreCategory::where('name', $request->store)->first();
            $stores =  $stores->where('store_id', $storeinfo->id);
        }

        if ($stores != null) {
            $stores = $stores->paginate(12);
        }
        return view('landing.stores', compact('countries', 'stores', 'city_name', 'banners', 'storecategory'));
    }
    public function themeimages(Request $request)
    {
        $newpath = [];
        $output = '';
        foreach ($request->theme_id as $theme_id) {
            $image = 'theme-' . $theme_id;
            if (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.png'))) {
                $image = 'theme-' . $theme_id . '.png';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } elseif (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.jpeg'))) {
                $image = 'theme-' . $theme_id . '.jpeg';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } elseif (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.jpg'))) {
                $image = 'theme-' . $theme_id . '.jpg';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } elseif (file_exists(storage_path('app/public/admin-assets/images/theme/' . $image . '.webp'))) {
                $image = 'theme-' . $theme_id . '.webp';
                $path = url(env('ASSETPATHURL') . 'admin-assets/images/theme/' . $image);
            } else {
                $path =  asset('storage/app/public/admin-assets/images/about/defaultimages/item-placeholder.png');
            }
            $newpath[] = $path;
        }
        $html = view('admin.theme.themeimages', compact('newpath'))->render();
        return response()->json(['status' => 1, 'output' => $html], 200);
    }
}

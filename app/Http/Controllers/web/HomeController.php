<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\AppSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;
use App\Models\Favorite;
use App\Models\Promocode;
use App\Models\TopDeals;
use App\Models\Products;
use App\Models\Testimonials;
use App\Models\WhoWeAre;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
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
            $vendordata = Settings::where('custom_domain', $host)->first();
            $vdata = $vendordata->vendor_id;
        }
        if (empty($vendordata)) {
            abort(404);
        }
        $getbanners = Banner::where('vendor_id', @$vdata)->where('is_available', 1)->orderBy('reorder_id')->get();
        $getsliderlist = $getbannerslist['bannersection1'] = $getbannerslist['bannersection2'] = $getbannerslist['bannersection3'] = array();
        foreach ($getbanners as $bannerdata) {
            $data = array(
                "id" => $bannerdata->id,
                "product_id" => $bannerdata->product_id,
                "type" => $bannerdata->type,
                "catgeory_id" => $bannerdata->catgeory_id,
                "category_info" => $bannerdata->category_info,
                "product_info" => $bannerdata->product_info,
                "title" => $bannerdata->title,
                "sub_title" => $bannerdata->sub_title,
                "description" => $bannerdata->description,
                "link_text" => $bannerdata->link_text,
                "custom_link" => $bannerdata->custom_link,
                "image" => helper::image_path($bannerdata->image),
            );
            if ($bannerdata->section == 0) {
                $getsliderlist[] = $data;
            }
            if ($bannerdata->section == 1) {
                $getbannerslist['bannersection1'][] = $data;
            }
            if ($bannerdata->section == 2) {
                $getbannerslist['bannersection2'][] = $data;
            }
            if ($bannerdata->section == 3) {
                $getbannerslist['bannersection3'][] = $data;
            }
        }
        $coupons = Promocode::where('vendor_id', $vdata)->where('is_available', 1)->where('start_date', '<=', Carbon::now())->where('exp_date', '>=', Carbon::now())->orderBy('reorder_id')->get();

        $whoweare = WhoWeAre::where('vendor_id', $vdata)->orderBy('reorder_id')->get();
        $testimonials = Testimonials::where('vendor_id', $vdata)->where('user_id', null)->where('product_id', null)->orderBy('reorder_id')->get();
        $appsection = AppSettings::where('vendor_id', $vdata)->where('mobile_app_on_off', 1)->first();
        $getbestsellingproducts = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")
            ->where('products.vendor_id', @$vdata)
            ->orderBy('products.reorder_id')
            ->inRandomOrder();
        $getnewarrivalproducts = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")
            ->where('products.vendor_id', @$vdata)
            ->orderBy('products.reorder_id');
        $topdealsproducts = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")
            ->where('products.vendor_id', @$vdata)
            ->where('products.top_deals', 1)
            ->orderBy('products.reorder_id')->get();
        if (helper::appdata($vdata)->theme == 5 || helper::appdata($vdata)->theme == 7) {
            $getbestsellingproducts = $getbestsellingproducts->take(15)->get();
            $getnewarrivalproducts =  $getnewarrivalproducts->take(15)->get();
        } else if (helper::appdata($vdata)->theme == 3) {
            $getbestsellingproducts = $getbestsellingproducts->take(12)->get();
            $getnewarrivalproducts =  $getnewarrivalproducts->take(12)->get();
        } else {
            $getbestsellingproducts = $getbestsellingproducts->take(15)->get();
            $getnewarrivalproducts =  $getnewarrivalproducts->take(12)->get();
        }

        $topdeals = helper::top_deals($vendordata->id);
        return view('web.theme-' . helper::appdata(@$vdata)->theme . '.index', compact('vendordata', 'getsliderlist', 'getbannerslist', 'getbestsellingproducts', 'getnewarrivalproducts', 'coupons', 'whoweare', 'testimonials', 'appsection', 'topdealsproducts', 'topdeals', 'vdata'));
    }

    public function pwaindex(Request $request)
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
        $getbanners = Banner::where('vendor_id', @$vdata)->where('is_available', 1)->orderBy('reorder_id')->get();
        $getsliderlist = $getbannerslist['bannersection1'] = $getbannerslist['bannersection2'] = $getbannerslist['bannersection3'] = array();
        foreach ($getbanners as $bannerdata) {
            $data = array(
                "id" => $bannerdata->id,
                "product_id" => $bannerdata->product_id,
                "type" => $bannerdata->type,
                "catgeory_id" => $bannerdata->catgeory_id,
                "category_info" => $bannerdata->category_info,
                "product_info" => $bannerdata->product_info,
                "title" => $bannerdata->title,
                "sub_title" => $bannerdata->sub_title,
                "description" => $bannerdata->description,
                "link_text" => $bannerdata->link_text,
                "custom_link" => $bannerdata->custom_link,
                "image" => helper::image_path($bannerdata->image),
            );
            if ($bannerdata->section == 0) {
                $getsliderlist[] = $data;
            }
            if ($bannerdata->section == 1) {
                $getbannerslist['bannersection1'][] = $data;
            }
            if ($bannerdata->section == 2) {
                $getbannerslist['bannersection2'][] = $data;
            }
            if ($bannerdata->section == 3) {
                $getbannerslist['bannersection3'][] = $data;
            }
        }
        $coupons = Promocode::where('vendor_id', $vdata)->where('is_available', 1)->where('start_date', '<=', Carbon::now())->where('exp_date', '>=', Carbon::now())->orderBy('reorder_id')->get();

        $whoweare = WhoWeAre::where('vendor_id', $vdata)->orderBy('reorder_id')->get();
        $testimonials = Testimonials::where('vendor_id', $vdata)->where('user_id', null)->where('product_id', null)->orderBy('reorder_id')->get();
        $appsection = AppSettings::where('vendor_id', $vdata)->where('mobile_app_on_off', 1)->first();
        $getbestsellingproducts = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")
            ->where('products.vendor_id', @$vdata)
            ->orderBy('products.reorder_id')
            ->inRandomOrder();
        $getnewarrivalproducts = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")
            ->where('products.vendor_id', @$vdata)
            ->orderBy('products.reorder_id');
        $topdealsproducts = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")
            ->where('products.vendor_id', @$vdata)
            ->where('products.top_deals', 1)
            ->orderBy('products.reorder_id')->get();
        if (helper::appdata($vdata)->theme == 5 || helper::appdata($vdata)->theme == 7) {
            $getbestsellingproducts = $getbestsellingproducts->take(15)->get();
            $getnewarrivalproducts =  $getnewarrivalproducts->take(15)->get();
        } else if (helper::appdata($vdata)->theme == 3) {
            $getbestsellingproducts = $getbestsellingproducts->take(12)->get();
            $getnewarrivalproducts =  $getnewarrivalproducts->take(12)->get();
        } else {
            $getbestsellingproducts = $getbestsellingproducts->take(15)->get();
            $getnewarrivalproducts =  $getnewarrivalproducts->take(12)->get();
        }

        $topdeals = TopDeals::where('vendor_id', $vdata)->first();
        return view('web.themepwa', compact('vendordata', 'getsliderlist', 'getbannerslist', 'getbestsellingproducts', 'getnewarrivalproducts', 'coupons', 'whoweare', 'testimonials', 'appsection', 'topdealsproducts', 'topdeals', 'vdata'));
    }
    public function categories(Request $request)
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
        return view('web.categorieslist', compact('vendordata'));
    }
    public function managefavorite(Request $request)
    {

        try {
            $favorite = Favorite::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->where('user_id', Auth::user()->id)->first();
            if (!empty($favorite)) {
                $favorite->delete();
            } else {
                $favorite = new Favorite();
                $favorite->vendor_id = $request->vendor_id;
                $favorite->user_id = Auth::user()->id;
                $favorite->product_id = $request->product_id;
                $favorite->save();
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\helper\helper;
use App\Models\Banner;
use App\Models\Products;
use App\Models\Variation;
use App\Models\Category;
use App\Models\Cart;
use App\Models\SystemAddons;
use App\Models\WhoWeAre;
use App\Models\SubCategory;
use App\Models\Favorite;
use App\Models\OrderDetails;
use App\Models\TopDeals;
use App\Models\User;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Testimonials;
class HomeController extends Controller
{
    public function home(Request $request)
    {

        $checkplan = helper::checkplan($request->vendor_id, '');
                       
        $plan = json_decode(json_encode($checkplan));

        if (@$plan->original->status == '2' && @$plan->original->showclick != 2) {
            return response()->json(["status" => 3, "message" => trans('messages.store_close')], 200);
        }

        $userid = "";
        if ($request->user_id != "") {
            $userid = $request->user_id;

            $userinfo = User::where('id', $userid)->first();
            if (@$userinfo->is_available == '2') {
                return response()->json(["status" => 3, "message" => trans('messages.block')], 200);
            }
        }
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $currencyinfo = Settings::select('currency', 'currency_position')->where('vendor_id', $request->vendor_id)->first();
        $getbanners = Banner::where('vendor_id', $request->vendor_id)->where('is_available', 1)->orderByDesc('id')->get();
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
        $getbestsellingproducts = Products::with('product_image', 'multi_variation', 'category_info','extras')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2) ->where('products.top_deals','!=','1')->orderBy('products.reorder_id')->inRandomOrder()->take(10)->get();

        $getnewarrivalproducts = Products::with('product_image', 'multi_variation', 'category_info','extras')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2)->where('products.top_deals','!=','1')->orderBy('products.reorder_id')->take(10)->get();

        $topdealsproducts = Products::with('product_image', 'multi_variation', 'category_info','extras')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2)->where('products.top_deals',1)->orderBy('products.reorder_id')->get();


        $getblogs =  helper::getblogs($request->vendor_id, "6", "");

        $bloglist = array();
        foreach ($getblogs as $blogvalue) {
            $blogdata = array(
                "id" => $blogvalue->id,
                "vendor_id" => $blogvalue->vendor_id,
                "title" => $blogvalue->title,
                "description" => $blogvalue->description,
                "image" => helper::image_path($blogvalue->image),
                "created_at" => $blogvalue->created_at,
            );
            $bloglist[] = $blogdata;
        }
        if ($request->user_id == "" || $request->user_id == null) {
            $cartcount = Cart::where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->count();
        } else {
            $cartcount = Cart::where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->count();
        }
        $testimonials = Testimonials::select('*', \DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/testimonials/') . "/', image) AS image_url"))->where('vendor_id', $request->vendor_id)->where('user_id', null)->where('product_id', null)->get();

        $whoweare_title = helper::appdata($request->vendor_id)->whoweare_title;
        $whoweare_subtitle = helper::appdata($request->vendor_id)->whoweare_subtitle;
        $whoweare_description = helper::appdata($request->vendor_id)->whoweare_description;
        $whoweare_image = helper::image_path(helper::appdata($request->vendor_id)->whoweare_image);
        $whoweare = WhoWeAre::select('*',\DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/index/') . "/', image) AS image_url"))->where('vendor_id',$request->vendor_id)->get();
        $topdeals = TopDeals::where('vendor_id',$request->vendor_id)->first();
        $start_datetime = @$topdeals->start_date.' '.@$topdeals->start_time;
        $end_datetime = @$topdeals->end_date.' '. @$topdeals->end_time;
        $offer_type = @$topdeals->offer_type;
        $offer_amount = @$topdeals->offer_amount;
        $deals_start = 0;
        date_default_timezone_set(helper::appdata($request->vendor_id)->timezone);
        if(@$topdeals->start_date <= now()->format('Y-m-d') &&  date('H:i:s', strtotime(@$topdeals->start_time)) <=  date('H:i:s'))
        {
            $deals_start = 1;
        }
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'getsliderlist' => $getsliderlist, 'getbannerslist' => $getbannerslist, 'getbestsellingproducts' => $getbestsellingproducts, 'getnewarrivalproducts' => $getnewarrivalproducts, 'getblogs' => $bloglist, 'currency' => $currencyinfo->currency, "currency_info" => $currencyinfo->currency_position, "cartcount" => $cartcount, 'testimonials' => $testimonials,'topdealsproducts' => $topdealsproducts,'whoweare_title' => $whoweare_title,'whoweare_subtitle'=> $whoweare_subtitle,'whoweare_image' => $whoweare_image,'whoweare_description' => $whoweare_description,'whoweare' => $whoweare,'start_datetime' => $start_datetime,'end_datetime' => $end_datetime,'offer_type' => $offer_type,'offer_amount'=> $offer_amount,'deals_start' => $deals_start,'date_format'=>helper::appdata($request->vendor_id)->date_format,'time_format'=>helper::appdata($request->vendor_id)->time_format,'store_type'=>helper::appdata($request->vendor_id)->product_type,'online_order'=>helper::appdata($request->vendor_id)->online_order,'decimal_separator'=>helper::appdata($request->vendor_id)->decimal_separator,'currency_space'=>helper::appdata($request->vendor_id)->currency_space,'currency_formate'=>helper::appdata($request->vendor_id)->currency_formate], 200);
    }
    public function productlist(Request $request)
    {
        $userid = "";
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->user_id != "") {
            $userid = $request->user_id;
        }
        // GET PRODUCTS LIST
        $getproductslist = Products::with('product_image', 'multi_variation', 'category_info','extras')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2)->where('products.top_deals','!=','1')->orderBy('products.reorder_id');
        $getproductslist->variants_json = json_decode($getproductslist->variants_json, true);
        $fromprice = (int)$request->from;

        $toprice = (int)$request->to;

        if ($request->has('from') && $fromprice >= 0 && $request->has('to') && $toprice > 0) {

            $getproductslist = $getproductslist->whereBetween('price', [$fromprice, $toprice]);
        }

        if ($request->has('name') && $request->name != "") {

            $getproductslist = $getproductslist->where('name', 'like', '%' . $request->name . '%');
        }

        // Sortby

        if ($request->type == "oldest") {

            $getproductslist = $getproductslist->orderBy('id');
        } elseif ($request->type == "price-low-high") {

            $getproductslist = $getproductslist->orderBy('price');
        } elseif ($request->type == "price-high-low") {

            $getproductslist = $getproductslist->orderByDesc('price');
        } elseif ($request->type == "best-selling-products") {

            $getproductslist = $getproductslist->inRandomOrder();
        } else {

            // type = "" || "all" || "newest"

            $getproductslist = $getproductslist->orderBydesc('id');
        }

        $getproductslist = $getproductslist->paginate(12);

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'getproductslist' => $getproductslist], 200);
    }

    public function allcategory(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }

        $getcategorydata = Category::select('id', 'name', 'image')->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $request->vendor_id)->orderBy('reorder_id')->get();
        foreach ($getcategorydata as $categorydata) {
            $catdata = array(
                "id" => $categorydata->id,
                "name" => $categorydata->name,
                "image" => helper::image_path($categorydata->image),
            );

            $data[] = $catdata;
        }

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'categorydata' => $data], 200);
    }

    public function subcategory(Request $request)
    {
        if ($request->cat_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.cat_id_required')], 200);
        }

        $getsubcategorydata = helper::getsubcategories($request->cat_id, '');
       
      
            foreach ($getsubcategorydata as $subcategorydata) {
                $catdata = array(
                    "id" => $subcategorydata->id,
                    "name" => $subcategorydata->name,
                );
    
                $data[] = $catdata;
            }
        
       
        if(!empty($data)) {
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'getsubcategorydata' => $data], 200);
        } else {
            return response()->json(["status" => 1, "message" => trans('labels.nodata_found'),'getsubcategorydata' => []], 200);
        }
    }

    public function category_items(Request $request)
    {
        $userid = "";
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->cat_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.category_required')], 200);
        }
        if ($request->user_id != "") {
            $userid = $request->user_id;
        }
        // CHECK VALID SUBCATEGORY
        $getsubcategorydata = SubCategory::select('id', 'category_id', 'name', 'slug')->where('category_id', $request->cat_id)->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $request->vendor_id)->orderBy('reorder_id')->get();

        $getproductslist = Products::with('product_image', 'multi_variation', 'category_info')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.vendor_id', $request->vendor_id)->where('products.category_id', $request->cat_id)->where('products.top_deals','!=','1')->where('products.is_available', 1)->where('products.is_deleted', 2)->orderBy('products.reorder_id');
        $getproductslist->variants_json = json_decode($getproductslist->variants_json, true);
        if ($request->sub_cat_id != "") {
            $getproductslist = $getproductslist->where('sub_category_id', $request->sub_cat_id);
        }
        if ($request->product_name != "") {
            $getproductslist = $getproductslist->where('name', 'like', '%' . $request->product_name . '%');
        }
        $getproductslist =  $getproductslist->get();
        $banner = helper::image_path(@helper::appdata($request->vendor_id)->viewallpage_banner);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'allproducts' => $getproductslist, 'subcategory' => $getsubcategorydata,'banner' => $banner], 200);
    }
    public function productdetails(Request $request)
    {
        $userid = "";
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->product_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_id_required')], 200);
        }
        if ($request->user_id != "") {
            $userid = $request->user_id;
        }
        $getproductdata = Products::with('multi_image', 'multi_variation', 'category_info', 'subcategory_info','extras')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->where('products.id', $request->product_id)->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2)->first();
        $getproductdata->variants_json = json_decode($getproductdata->variants_json, true);
        $raplceid = str_replace('|', ',', $getproductdata->sub_category_id);
        $getrelatedproductslist = Products::with('product_image', 'multi_variation', 'category_info')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.id', '!=', @$getproductdata->id)->where('products.category_id', @$getproductdata->category_id)->whereIn('products.sub_category_id', explode(',', $raplceid))->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2)->orderBydesc('products.reorder_id')->take(10)->get();
        if ($request->user_id == "" || $request->user_id == null) {
            $cartcount = Cart::where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->count();
        } else {
            $cartcount = Cart::where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->count();
        }
        $review = Testimonials::select('*',\DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/testimonials/') . "/', image) AS image_url"))->where('vendor_id', $request->vendor_id)->where('product_id', $request->product_id)->get();
        $averagerating = Testimonials::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->avg('star');
        $totalreview = Testimonials::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->count();
        $fivestaraverage = Testimonials::where('product_id',$request->product_id)->where('vendor_id', $request->vendor_id)->where('star', 5)->avg('star');
        $fourstaraverage = Testimonials::where('product_id',$request->product_id)->where('vendor_id', $request->vendor_id)->where('star', 4)->avg('star');
        $threestaraverage = Testimonials::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->where('star', 3)->avg('star');
        $twostaraverage = Testimonials::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->where('star', 2)->avg('star');
        $onestaraverage = Testimonials::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->where('star', 1)->avg('star');
        if (empty($getproductdata)) {
            return response()->json(["status" => 1, "message" => trans('labels.nodata_found')], 200);
        } else {
            return response()->json(["status" => 1, "message" => trans('messages.success'), 'items' => $getproductdata, 'relatedproducts' => $getrelatedproductslist, "cartcount" => $cartcount,'review' => $review,'averagerating' => $averagerating,'totalreview' =>$totalreview,'fivestaraverage'=> $fivestaraverage,'fourstaraverage'=> $fourstaraverage,'threestaraverage' =>$threestaraverage,'twostaraverage' => $twostaraverage,'onestaraverage'=> $onestaraverage,'whatsapp_number' => helper::appdata($request->vendor_id)->whatsapp_number,'google_review'=>helper::appdata($request->vendor_id)->google_review], 200);
        }
    }

    public function systemaddon(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $addons = SystemAddons::select('unique_identifier', 'activated')->get();
        
        $checkcustomerlogin = helper::appdata($request->vendor_id)->checkout_login_required;
        $primary_color = helper::appdata($request->vendor_id)->primary_color;
        
        return response()->json(["status" => 1, "message" => trans('messages.success'), 'addons' =>  $addons, 'checkout_login_required' => $checkcustomerlogin, 'session_id' => session()->getId(),'primary_color'=>$primary_color], 200);
    }
    public function managefavorite(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->product_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_id_required')], 200);
        }
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.user_id_required')], 200);
        }
        if ($request->type == "") {
            return response()->json(["status" => 0, "message" => trans('messages.type_required')], 200);
        }
        try {
            $favorite = Favorite::where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->first();
            if ($request->type == 2 && !empty($favorite)) {
                $favorite->delete();
            }
            if ($request->type == 1 && empty($favorite)) {
                $favorite = new Favorite();
                $favorite->vendor_id = $request->vendor_id;
                $favorite->user_id = $request->user_id;
                $favorite->product_id = $request->product_id;
                $favorite->save();
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function paymentmethods(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $getpaymentmethodslist = Payment::where('is_available', 1)->where('vendor_id', $request->vendor_id)->whereNotIn('payment_name', ['wallet'])->where('is_activate', 1)->get();
        foreach ($getpaymentmethodslist as $paymentlist) {
            $paymentlist->image = helper::image_path($paymentlist->image);
        }
        return response()->json(['status' => 1, 'message' => trans('messages.success'), "paymentmethods" => $getpaymentmethodslist], 200);
    }
    public function search(Request $request)
    {
        $userid = "";
        if ($request->vendor_id == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.vendor_id_required')], 200);
        }
        if ($request->user_id != "") {
            $userid = $request->user_id;
        }
        if ($request->product_name == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.product_name_required')], 200);
        }
        $getproductslist = Products::with('product_image', 'multi_variation', 'category_info')->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
            $query->on('favorite.product_id', '=', 'products.id')
                ->where('favorite.user_id', '=', $userid);
        })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')->groupBy('products.id')->where('products.name', 'like', '%' . $request->product_name . '%')->where('products.vendor_id', $request->vendor_id)->where('products.is_available', 1)->where('products.is_deleted', 2)->get();
        $getproductslist->variants_json = json_decode($getproductslist->variants_json, true);
        return response()->json(['status' => 1, 'message' => trans('messages.success'), "products" => $getproductslist], 200);
    }
    public function filteration(Request $request)
    {
        $userid = "";
        if ($request->vendor_id == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.vendor_id_required')], 200);
        }
        if ($request->user_id != "") {
            $userid = $request->user_id;
        }
        $getproductslist = Products::with('product_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('(case when favorite.product_id is null then 0 else 1 end) as is_favorite'),DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))->leftJoin('favorite', function ($query) use ($userid) {
                $query->on('favorite.product_id', '=', 'products.id')
                    ->where('favorite.user_id', '=', $userid);
            })->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")->where('products.vendor_id', $request->vendor_id);
        if (!empty($getproductslist) && $request->category_id != "") {
            $getproductslist = $getproductslist->where('products.category_id', $request->category_id);
        }
        if (!empty($getproductslist) && $request->subcategory_id) {
            $getproductslist = $getproductslist->where(DB::Raw("FIND_IN_SET($request->subcategory_id, replace(products.sub_category_id, '|', ','))"), '>', 0);
        }
        if ($request->type == "oldest") {
            $getproductslist = $getproductslist->orderBy('products.reorder_id');
        } elseif ($request->type == "price-low-high") {
            $getproductslist = $getproductslist->orderBy('products.price');
        } elseif ($request->type == "price-high-low") {
            $getproductslist = $getproductslist->orderByDesc('products.price');
        } elseif ($request->type == "best-selling-products") {
            $getproductslist = $getproductslist->inRandomOrder();
        } else {
            // type = "" || "all" || "newest"
            $getproductslist = $getproductslist->orderByDesc('products.reorder_id');
        }
        $fromprice = (int)$request->low_price;
        $toprice = (int)$request->high_price;
        if ($fromprice >= 0 && $toprice > 0) {
            $getproductslist = $getproductslist->whereBetween('products.price', [$fromprice, $toprice]);
        }
        $getproductslist =  $getproductslist->get();
        return response()->json(['status' => 1, 'message' => trans('messages.success'), "products" => $getproductslist,"viewallpage_banner"=>helper::image_path(@helper::appdata(@$request->vendor_id)->viewallpage_banner)], 200);
    }
    public function postreview(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.vendor_id_required')], 200);
        }
        if ($request->user_id == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.user_id_required')], 200);
        }
        if ($request->product_id == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.user_id_required')], 200);
        }
        if ($request->review == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.review_required')], 200);
        }
        if ($request->ratting == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.ratting_required')], 200);
        }
        if ($request->user_id != "") {
            $orders = OrderDetails::where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->where('product_id', $request->product_id)->count();
            $rattingcount = Testimonials::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('vendor_id', $request->vendor_id)->count();
            if ($orders > 0 && $rattingcount == 0) {
                $user = User::where('id', $request->user_id)->first();
                $review = new Testimonials();
                $review->vendor_id = $request->vendor_id;
                $review->user_id = $request->user_id;
                $review->product_id = $request->product_id;
                $review->star = $request->ratting;
                $review->description = $request->review;
                $review->name = $user->name;
                $review->image = $user->image;
                $review->save();
                return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
            } else {
                return response()->json(['status' => 0, 'message' => trans('messages.post_review_message')], 200);
            }
        } 
    }
    public function getvariationprice(Request $request)
    {

        if ($request->product_id == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.item_id_required')], 200);
        }
        if ($request->variant_name == "") {
            return response()->json(['status' => 0, 'message' => trans('messages.variant_name_required')], 200);
        }
        $quantity = $variant_id = 0;
        $product = Products::find($request->product_id);
        $price = 0;
        $status = false;
        if ($product && $request->variant_name != '') {
            $variant = Variation::where('product_id', $request->product_id)->where('name', $request->variant_name)->first();
            $status = 1;
            $quantity = @$variant->qty;
            $price = @$variant->price;
            $original_price = @$variant->original_price;
            $variant_id = @$variant->id;
            $min_order = @$variant->min_order;
            $max_order = @$variant->max_order;
            $stock_management = @$variant->stock_management;
            $variants_name = @$request->name;
            $is_available = @$variant->is_available;
        }
        return response()->json(
            [
                'status' => $status,
                'price' => $price,
                'original_price' => $original_price,
                'quantity' => $quantity,
                'variant_id' => $variant_id,
                'min_order' => $min_order,
                'max_order' => $max_order,
                'stock_management' => $stock_management,
                'variants_name' => $variants_name,
                'is_available' => $is_available,
            ]
        );
    }
}

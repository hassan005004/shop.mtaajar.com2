<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Products;
use App\Models\Category;
use App\Models\Settings;
use App\Models\OrderDetails;
use App\Models\SubCategory;
use App\Models\Testimonials;
use App\Models\Variation;
use App\Models\TopDeals;
use App\Models\Cart;
use App\Models\User;
use URL;
use DB;
use App;
use Session;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productdetails(Request $request)
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
        $productdata = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info', 'subcategory_info')->select('products.*', \DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/product') . "/', products.attchment_file) AS attchment_url"))->where('slug', $request->product_slug)->where('vendor_id', $vdata)->first();
        $productdata->variants_json = json_decode($productdata->variants_json, true);
        $raplceid = str_replace('|', ',', $productdata->sub_category_id);

        $getrelatedproductslist = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info', 'subcategory_info')->where('id', '!=', @$productdata->id)->where('category_id', @$productdata->category_id)->where('vendor_id', $vdata)->where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->paginate(8)->onEachSide(0);

        $review = Testimonials::where('vendor_id', $vendordata->id)->where('product_id', $productdata->id)->orderBy('reorder_id')->get();
        $averagerating = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->avg('star');
        $totalreview = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->count();
        $fivestaraverage = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->where('star', 5)->avg('star');
        $fourstaraverage = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->where('star', 4)->avg('star');
        $threestaraverage = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->where('star', 3)->avg('star');
        $twostaraverage = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->where('star', 2)->avg('star');
        $onestaraverage = Testimonials::where('product_id', $productdata->id)->where('vendor_id', $vendordata->id)->where('star', 1)->avg('star');
        return view('web.productdetails', compact('vendordata', 'productdata', 'getrelatedproductslist', 'review', 'averagerating', 'totalreview', 'fivestaraverage', 'fourstaraverage', 'threestaraverage', 'twostaraverage', 'onestaraverage', 'vdata'));
    }
    public function category_wise_products(Request $request)
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
        if ($request->has('category')) {
            $category_slug = $request->category;
        } else {
            $category_slug = $request->category_slug;
        }
        if ($request->has('subcategory')) {
            $subcategory_slug = $request->subcategory;
        } else {
            $subcategory_slug = $request->categorsubcategory_slugy_slug;
        }
        // CHECK VALID CATEGORY
        $getcategorydata = Category::select('id', 'name', 'slug', 'image')->where('slug', $category_slug)->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vdata)->first();
        if (!empty($request->category_slug) && empty($getcategorydata)) {
            return redirect(@$vendordata->slug . '/categories');
        }

        // CHECK VALID SUBCATEGORY
        $getsubcategorydata = SubCategory::select('id', 'category_id', 'name', 'slug')->where('slug', $subcategory_slug)->where('category_id', @$getcategorydata->id)->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vdata)->first();
        if (!empty($request->subcategory_slug) && empty($getsubcategorydata)) {
            if (!empty($request->category_slug) && empty($getcategorydata)) {
                return redirect(@$vendordata->slug . '/categories');
            }
            return redirect(@$vendordata->slug . '/categories-' . $getcategorydata->slug);
        }
        // GET PRODUCTS LIST
        $getproductslist = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.is_deleted', "2")->where('products.vendor_id', $vdata);

        if (!empty($getcategorydata)) {
            $getproductslist = $getproductslist->where('products.category_id', $getcategorydata->id);
        }
        if (!empty($getsubcategorydata)) {
            $getproductslist = $getproductslist->where(DB::Raw("FIND_IN_SET($getsubcategorydata->id, replace(products.sub_category_id, '|', ','))"), '>', 0);
        }
        $fromprice = (int)$request->from;
        $toprice = (int)$request->to;
        if ($request->has('from') && $fromprice >= 0 && $request->has('to') && $toprice > 0) {
            $getproductslist = $getproductslist->whereBetween('products.price', [$fromprice, $toprice]);
        }
        if ($request->has('name') && $request->name != "") {
            $getproductslist = $getproductslist->where('products.name', 'like', '%' . $request->name . '%');
        }
        // Sortby
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
        $subcategories = [];
        if ($request->category_slug != null && $request->category_slug != "") {
            $category = Category::where('slug', $request->category_slug)->first();
            $subcategories = SubCategory::where('category_id', $category->id)->where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        }
        if ($request->has('category') && $request->category != "") {
            $category = Category::where('slug', $request->category)->first();
            $subcategories = SubCategory::where('category_id', $category->id)->where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        }
        $getproductslist = $getproductslist->paginate(20)->onEachSide(0);
        return view('web.viewallproducts', compact('vendordata', 'getproductslist', 'getcategorydata', 'getsubcategorydata', 'subcategories', 'vdata'));
    }
    public function getproductdata(Request $request)
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
        $item_check = Products::where('id', $request->id)->first();
        $totalratting = Testimonials::where('product_id', $request->id)->where('vendor_id', $vdata)->count();
        $getitem = Products::with('product_image', 'multi_image', 'multi_variation', 'category_info', 'extras')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'), \DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/product') . "/', products.attchment_file) AS attchment_url"))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->where('products.vendor_id', $vdata)
            ->where('products.id', $request->id)
            ->first();
        $getitem->variants_json = json_decode($getitem->variants_json, true);
        $dealtype = $request->type;
        if ($request->ajax()) {
            App::setLocale(session()->get('locale'));

            $html = view('web.productmodal', compact('getitem', 'vendordata', 'item_check', 'totalratting', 'dealtype'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        } else {
            return view('front.detail', compact('getitem', 'vendordata', 'item_check', 'dealtype'));
        }
        // return response()->json(['status' => 1, 'message' => trans('messages.success'), 'productdata' => $getitem, 'totalratting' => $totalratting], 200);
    }
    public function postreview(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $vendordata = helper::vendordata($request->vendor_slug);
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            $vendordata = Settings::where('custom_domain', $host)->first();
        }
        if (empty($vendordata)) {
            abort(404);
        }
        $product = Products::where('id', $request->product_id)->first();
        if (Auth::user() && Auth::user()->type == 3) {

            $orders = OrderDetails::where('user_id', Auth::user()->id)->where('vendor_id', $vendordata->id)->where('product_id', $request->product_id)->count();
            $rattingcount = Testimonials::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->where('vendor_id', $vendordata->id)->count();
            if ($orders > 0 && $rattingcount == 0) {
                $user = User::where('id', Auth::user()->id)->first();
                $review = new Testimonials();
                $review->vendor_id = $vendordata->id;
                $review->user_id = Auth::user()->id;
                $review->product_id = $request->product_id;
                $review->star = $request->ratting;
                $review->description = $request->review;
                $review->name = $user->name;
                $review->image = $user->image;
                $review->save();
                return redirect()->back()->with('success', trans('messages.success'));
            } else {
                return redirect()->back()->with('error', trans('messages.post_review_message'));
            }
        } else {
            session()->put('previous_url', URL::to($vendordata->slug . '/products/' . $product->slug));
            return redirect($vendordata->slug . '/login');
        }
    }
    public function alltopdeals(Request $request)
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
        $topdealsproducts = Products::with('product_image', 'multi_variation', 'category_info')
            ->select('products.*', DB::raw('ROUND(AVG(testimonials.star),1) as ratings_average'))
            ->leftJoin('testimonials', 'testimonials.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('products.is_available', "1")
            ->where('products.top_deals', '1')
            ->where('products.is_deleted', "2")->where('products.vendor_id', $vendordata->id)->paginate(20)->onEachSide(0);
        $topdeals = TopDeals::where('vendor_id', $vendordata->id)->first();
        return view('web.viewalltopdeals', compact('topdealsproducts', 'vendordata', 'vdata', 'topdeals'));
    }
    public function getProductsVariantQuantity(Request $request)
    {
        $quantity = $variant_id = 0;
        $price = 0;
        $item = Products::where('id', $request->item_id)->first();
        $variant = Variation::where('product_id', $request->item_id)->where('name', implode('|', str_replace('_', ' ', $request->name)))->first();
        $quantity = @$variant->qty - (isset($cart[@$variant->id]['qty']) ? $cart[@$variant->id]['qty'] : 0);

        if (Auth::user() && (Auth::user()->type == 2 || Auth::user()->type == 4)) {
            $price = $variant->price;
            $original_price = $variant->original_price;
        } else {
            if ($item->top_deals == 1 && helper::top_deals($request->vendor_id) != null) {
                if (@helper::top_deals($request->vendor_id)->offer_type == 1) {
                    $price = $variant->price - @helper::top_deals($request->vendor_id)->offer_amount;
                } else {
                    $price =
                        $variant->price -
                        $variant->price * (@helper::top_deals($request->vendor_id)->offer_amount / 100);
                }
                $original_price = $variant->price;
            } else {
                $price = $variant->price;
                $original_price = $variant->original_price;
            }
        }
        $variant_id = @$variant->id;
        $min_order = @$variant->min_order;
        $max_order = @$variant->max_order;
        $stock_management = @$variant->stock_management;
        $variants_name = @$request->name;
        if ($item->is_available == 2 || $item->is_deleted == 1) {
            $is_available = 2;
        } else {
            $is_available = @$variant->is_available;
        }

        return response()->json([
            'status' => 1,
            'price' => $price,
            'original_price' => $original_price,
            'quantity' => $quantity,
            'variant_id' => $variant_id,
            'min_order' => $min_order,
            'max_order' => $max_order,
            'stock_management' => $stock_management,
            'variants_name' => $variants_name,
            'is_available' => $is_available
        ], 200);
    }

    public function changeqty(Request $request)
    {
        if ($request->variants_name == null) {

            $item = Products::where('id', $request->item_id)->where('vendor_id', $request->vendor_id)->first();
            if (Auth::user() && Auth::user()->type == 3) {
                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $item->id)->where('user_id', Auth::user()->id)->first();
            } else {

                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $item->id)->where('session_id', Session::getId())->first();
            }
            if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                $qty = $cartqty->totalqty + $request->qty;
            } else {
                $qty = $request->qty;
            }

            if ($item->stock_management == 1) {
                // if ($item->min_order != null && $item->min_order != "" && $item->min_order != 0) {
                //     if ($item->min_order > $qty) {
                //         return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order, 'qty' => $request->qty], 200);
                //     }
                // }
                if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                    if ($item->max_order < $qty) {
                        if ($cartqty->totalqty == null) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order, 'qty' => $request->qty - 1], 200);
                        } else {
                            return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $item->max_order, 'qty' => $request->qty - 1], 200);
                        }
                    }
                }
                if ($qty == $item->qty) {
                    return response()->json(['status' => 1, 'message' => 'success', 'qty' => $qty], 200);
                }
                if ($qty > $item->qty && ($item->qty != null && $item->qty != "")) {
                    return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->item_name, 'qty' => $request->qty - 1], 200);
                } else {
                    return response()->json(['status' => 1, 'message' => 'success', 'qty' => $request->qty], 200);
                }
            } else {
                return response()->json(['status' => 1, 'message' => 'success', 'qty' => $request->qty], 200);
            }
        } else {
            $variant_name = str_replace('_', ' ', $request->variants_name);
            $item = Variation::where('name', str_replace(',', '|', $variant_name))->where('product_id', $request->item_id)->first();
            $item_name = Products::select('name')->where('id', $request->item_id)->first();
            if (Auth::user() && Auth::user()->type == 3) {
                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $item->id)->where('user_id', Auth::user()->id)->first();
            } else {

                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $item->id)->where('session_id', Session::getId())->first();
            }

            if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                $qty = $cartqty->totalqty + $request->qty;
            } else {
                $qty = $request->qty;
            }

            if ($item->stock_management == 1) {
                if ($item->min_order != null && $item->min_order != "" && $item->min_order != 0) {
                    if ($item->min_order > $qty && $item->min_order != $qty) {
                        return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order, 'qty' => $request->qty], 200);
                    }
                }
                if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                    if ($item->max_order < $qty && $item->max_order != $qty) {
                        if ($cartqty->totalqty == null) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order, 'qty' => $request->qty - 1], 200);
                        } else {
                            return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $item->max_order, 'qty' => $request->qty - 1], 200);
                        }
                    }
                }
                if ($qty == $item->qty) {
                    return response()->json(['status' => 1, 'message' => 'success', 'qty' => $qty], 200);
                }
                if ($qty > $item->qty  && ($item->qty != null && $item->qty != "")) {
                    return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item_name->item_name . '(' . $item->name . ')', 'qty' => $request->qty - 1], 200);
                } else {
                    return response()->json(['status' => 1, 'message' => 'success', 'qty' => $request->qty], 200);
                }
            } else {
                return response()->json(['status' => 1, 'message' => 'success', 'qty' => $request->qty], 200);
            }
        }
    }
    public function qtyupdate(Request $request)
    {
        try {
            $item = Products::where('id', $request->item_id)->first();

            if ($request->variants_id != null) {
                $variant = Variation::where('id', $request->variants_id)->where('product_id', $request->item_id)->first();
                if (Auth::user() && Auth::user()->type == 3) {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variant->id)->where('id', '!=', $request['cart_id'])->where('user_id', Auth::user()->id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variant->id)->where('id', '!=', $request['cart_id'])->where('session_id', Session::getId())->first();
                }
                if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                    $qty = $cartqty->totalqty + $request->qty;
                } else {
                    $qty = $request->qty;
                }
                if ($variant->stock_management == 1) {
                    if ($variant->min_order != null && $variant->min_order != "" && $variant->min_order != 0) {
                        if ($variant->min_order > $qty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variant->min_order, 'qty' => $request->qty], 200);
                        }
                    }
                    if ($variant->max_order != null && $variant->max_order != "" && $variant->max_order != 0) {
                        if ($variant->max_order < $qty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variant->max_order, 'qty' => $request->qty - 1], 200);
                        }
                    }
                    if ($request->qty == $variant->qty) {
                        Cart::where('id', $request['cart_id'])->update(['qty' => $request->qty]);
                        return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                    }
                    if ($variant->qty < $request->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->name . '(' . $variant->name . ')', 'qty' => $request->qty - 1], 200);
                    } else {
                        Cart::where('id', $request['cart_id'])->update(['qty' => $request->qty]);
                        return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                    }
                } else {
                    Cart::where('id', $request['cart_id'])->update(['qty' => $request->qty]);
                    return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                }
            } elseif ($request->variants_id == null) {


                if (Auth::user() && Auth::user()->type == 3) {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $item->id)->where('id', '!=', $request['cart_id'])->where('user_id', Auth::user()->id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $item->id)->where('id', '!=', $request['cart_id'])->where('session_id', Session::getId())->first();
                }

                if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                    $qty = $cartqty->totalqty + $request->qty;
                } else {
                    $qty = $request->qty;
                }

                if ($item->stock_management == 1) {
                    if ($item->min_order != null && $item->min_order != "" && $item->min_order != 0) {
                        if ($item->min_order > $qty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order, 'qty' => $request->qty], 200);
                        }
                    }
                    if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                        if ($item->max_order < $qty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order, 'qty' => $request->qty - 1], 200);
                        }
                    }

                    if ($request->qty == $item->qty) {
                        Cart::where('id', $request['cart_id'])->update(['qty' => $request->qty]);
                        return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                    }
                    if ($item->qty < $request->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->item_name, 'qty' => $request->qty - 1], 200);
                    } else {
                        Cart::where('id', $request['cart_id'])->update(['qty' => $request->qty]);
                        return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                    }
                } else {
                    Cart::where('id', $request['cart_id'])->update(['qty' => $request->qty]);
                    return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}

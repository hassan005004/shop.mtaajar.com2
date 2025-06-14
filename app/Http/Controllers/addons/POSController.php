<?php

namespace App\Http\Controllers\addons;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\User;
use App\Models\CustomStatus;
use App\Models\Settings;
use App\Models\Testimonials;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class POSController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $user_id = $vendor_id;
            $session_id = Session::getId();

            $getcategory = Category::where('vendor_id', $user_id)->where('is_available', '=', '1')->where('is_deleted', '2')->orderBy('id', 'ASC')->get();
            $getproduct = Products::with(['multi_variation', 'product_image', 'extras'])
                ->select('products.*', DB::raw('(case when carts.product_id is null then 0 else 1 end) as is_cart'), 'carts.id as cart_id', 'carts.qty as cart_qty')
                ->leftJoin('carts', function ($query) use ($session_id) {
                    $query->on('carts.product_id', '=', 'products.id')
                        ->where('carts.session_id', '=', $session_id);
                })
                ->groupBy('products.id', 'carts.product_id')
                ->where('products.vendor_id',  $user_id)->where('products.is_available', '1')->orderBy('products.id', 'ASC')->get();

            $cartitems = Cart::select('id', 'product_id', 'product_name', 'product_image', 'product_price', 'qty', 'tax', 'variation_id', 'variation_name', 'extras_name', 'extras_id', 'extras_price')
                ->where('vendor_id', $user_id)->where('session_id', $session_id)->orderByDesc('id')->get();
            $ordersdetails = array();
            $taxArr['tax'] = [];
            $taxArr['rate'] = [];
            $customers = User::where('type', 3)->where('vendor_id', $vendor_id)->where('is_deleted', 2)->get();
            if ($request->ajax()) {
                if ($request->id != null) {
                    $getproduct = Products::with(['multi_variation', 'product_image'])->where('vendor_id', $user_id)->where('is_available', '1')->where('category_id', $request->id)->orderBy('id', 'ASC')->get();
                }
                if ($request->keyword != null) {
                    if ($request->id != null) {
                        $getproduct = Products::with(['multi_variation', 'product_image'])->where('vendor_id', $user_id)->where('is_available', '1')->where('category_id', $request->id)->where('name', 'LIKE', '%' . $request->keyword . '%')->orderBy('id', 'ASC')->get();
                    } else {
                        $getproduct = Products::with(['multi_variation', 'product_image'])->where('vendor_id', $user_id)->where('name', 'LIKE', '%' . $request->keyword . '%')->where('is_available', '1')->orderBy('id', 'ASC')->get();
                    }
                }
                $cat_id = $request->id;
                return view('admin.pos.positem', compact('getproduct', 'cat_id'));
            } else {

                return view('admin.pos.index', compact('getcategory', 'getproduct', 'cartitems', 'ordersdetails', 'taxArr', 'customers'));
            }
        } catch (\Throwable $th) {
        }
    }
    public function item_details(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            if (Auth::user()->type == 4) {
                $vdata = Auth::user()->vendor_id;
            } else {
                $vdata = Auth::user()->id;
            }
            $vendordata = User::where('id', $vdata)->first();
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
            $html = view('web.productmodal', compact('getitem', 'vendordata', 'item_check', 'totalratting', 'dealtype'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        } else {
            return view('front.detail', compact('getitem', 'vendordata', 'item_check', 'dealtype'));
        }
    }
    public function addtocart(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            if (Auth::user()->type == 4) {
                $vdata = Auth::user()->vendor_id;
            } else {
                $vdata = Auth::user()->id;
            }
            $vendordata = User::where('id', $vdata)->first();
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
            $item = Products::where('id', $request->product_id)->where('vendor_id', $vdata)->first();

            $variation = Variation::where('product_id', $request->product_id)->where('name', str_replace(',', '|', $request->variation_name))->first();
            if ($request->variants_name != null && $request->variants_name != "") {
                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variation->id)->where('session_id', Session::getId())->first();
            } else {
                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $request->product_id)->where('session_id', Session::getId())->first();
            }
            if ($request->qty != null && $request->qty != null) {
                $orderqty = $request->qty;
            } else {
                $orderqty = 1;
            }
            if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                $qty = $cartqty->totalqty + $orderqty;
            } else {
                $qty = $orderqty;
            }

            if (!empty($variation)) {
                if ($variation->stock_management == 1) {
                    if ($variation->min_order != null && $variation->min_order != ""  && $variation->min_order != 0) {
                        if ($qty < $variation->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variation->min_order], 200);
                        }
                    }

                    if ($variation->max_order != null && $variation->max_order != "" && $variation->max_order != 0) {
                        if ($qty > $variation->max_order) {
                            if ($cartqty->totalqty == null) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variation->max_order], 200);
                            } else {
                                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $variation->max_order], 200);
                            }
                        }
                    }
                    if ($qty > $variation->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->name . '(' . $variation->name . ')'], 200);
                    }
                }
            } else {

                if ($item->stock_management == 1) {
                    if ($item->min_order != null && $item->min_order != ""  && $item->min_order != 0) {
                        if ($qty < $item->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order], 200);
                        }
                    }


                    if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                        if ($qty > $item->max_order) {
                            if ($cartqty->totalqty == null) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order], 200);
                            } else {
                                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $item->max_order], 200);
                            }
                        }
                    }
                    if ($qty > $item->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->name], 200);
                    }
                }
            }

            if (!empty($variation)) {
                $cartprice = $variation->price;
                $itemprice = $variation->price;
            } else {
                $cartprice = $request->product_price;
                $itemprice = $request->product_price;
            }

            $cart = new Cart();
            $cart->vendor_id = @$vdata;
            $cart->session_id = session()->getId();
            $cart->product_id = $request->product_id;
            $cart->product_name = $request->product_name;
            $cart->product_slug = $request->product_slug;
            $cart->product_image = $request->product_image;
            if (!empty($variation)) {
                $cart->variation_id = $variation->id == "" ? 0 : $variation->id;
                $cart->variation_name = $request->variation_name == "" ? "" : str_replace(',', '|', $request->variation_name);
            }
            $extra_price = explode('|', $request->extras_price);
            if ($request->extras_price != null || $request->extras_price != "") {
                foreach ($extra_price as $price) {
                    $cartprice  = $cartprice +  $price;
                }
            }
            $cart->attribute = $request->attribute == "" ? "" : $request->attribute;
            $cart->product_tax = $request->product_tax;
            $cart->product_price = $cartprice;
            $cart->price = $itemprice;
            $cart->tax = $item->tax;
            $cart->extras_name = $request->extras_name;
            $cart->extras_price = $request->extras_price;
            $cart->extras_id = $request->extras_id;
            $cart->qty = $request->qty;
            $cart->buynow = null;
            $cart->save();
            $total_cart_count = Cart::where('vendor_id', $vdata)->where('session_id', session()->getId())->count();
            return response()->json(['status' => 1, 'message' => $request->product_name . ' ' . trans('messages.cart_success_message'), 'total_cart_count' => $total_cart_count], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    public function cartview(Request $request)
    {
        session()->forget('discount');
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $customers = User::where('type', 3)->where('vendor_id', $vendor_id)->where('is_deleted', 2)->get();

        $cartitems = Cart::select('id', 'product_id', 'product_name', 'product_image', 'product_price', 'price', 'qty', 'tax', 'variation_id', 'variation_name', 'extras_name', 'extras_id', 'extras_price')
            ->where('vendor_id', $vendor_id)
            ->where('session_id', Session::getId())
            ->orderByDesc('id')->get();

        $tax_name = [];
        $tax_price = [];
        foreach ($cartitems as $cart) {
            $taxlist =  helper::gettax($cart->tax);
            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->product_price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }
        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;

        if ($request->ajax()) {
            $html = view('admin.pos.cartview', compact('cartitems', 'customers', 'taxArr'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        }
    }

    public function qtyupdate(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $cart = Cart::where('id', $request->id)->first();
        if ($request->variant_id == null) {
            $checkcart = Cart::select(DB::raw("SUM(qty) as qty"))->where('product_id', $request->item_id)->where('vendor_id', $vendor_id)->where('session_id', Session::getId())->first();
        } else {
            $checkcart = Cart::select(DB::raw("SUM(qty) as qty"))->where('product_id', $request->item_id)->where('variation_id', $request->variant_id)->where('vendor_id', $vendor_id)->where('session_id', Session::getId())->first();
        }

        if ($request->type == "plus") {

            $totalqty = $checkcart->qty + 1;

            if ($request->variant_id != null || $request->variant_id != 0) {
                $variants = Variation::where('product_id', $request->item_id)->where('id', $request->variant_id)->first();
                if ($variants->stock_management == 1) {
                    if ($variants->min_order != null && $variants->min_order != "" && $variants->min_order != 0) {
                        if ($variants->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $variants->min_order], 200);
                        }
                    }

                    if ($variants->max_order != null && $variants->max_order != "" && $variants->max_order != 0) {
                        if ($variants->max_order < $totalqty) {
                            if ($checkcart->qty  == null) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . ' ' . $variants->max_order], 200);
                            } else {
                                return response()->json(['status' => 0, 'message' => trans('messages.cart_qty_msg') . ' ' . trans('messages.max_qty_message') . $variants->max_order], 200);
                            }
                        }
                    }
                    if ($variants->qty < $totalqty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg')], 200);
                    }
                }
            } elseif ($request->variant_id == null || $request->variant_id == 0) {
                $items = Products::where('id', $request->item_id)->where('vendor_id', $vendor_id)->first();
                if ($items->stock_management == 1) {
                    if ($items->min_order != null && $items->min_order != "" && $items->min_order != 0) {
                        if ($items->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $items->min_order], 200);
                        }
                    }
                    if ($items->max_order != null && $items->max_order != "" && $items->max_order != 0) {
                        if ($items->max_order < $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . ' ' . $items->max_order], 200);
                        }
                    }
                    if ($items->qty < $totalqty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg')], 200);
                    }
                }
            }
            $cart->qty =  $request->qty + 1;
        } else {
            $totalqty = $checkcart->qty - 1;
            if ($request->variant_id != null || $request->variant_id != 0) {
                $variants = Variation::where('product_id', $request->item_id)->where('id', $request->variant_id)->first();
                if ($variants->stock_management == 1) {
                    if ($variants->min_order != null && $variants->min_order != "" && $variants->min_order != 0) {
                        if ($variants->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $variants->min_order], 200);
                        }
                    }
                }
            } else {
                $items = Products::where('id', $request->item_id)->where('vendor_id', $vendor_id)->first();
                if ($items->stock_management == 1) {
                    if ($items->min_order != null && $items->min_order != "" && $items->min_order != 0) {
                        if ($items->min_order > $totalqty) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . ' ' . $items->min_order], 200);
                        }
                    }
                }
            }
            if ($cart->qty > 1) {
                $cart->qty -= 1;
            }
        }
        $cart->save();
        $cartitems = Cart::select('id', 'product_id', 'product_name', 'product_image', 'product_price', 'price', 'qty', 'tax', 'variation_id', 'variation_name', 'extras_name', 'extras_price', 'extras_id')
            ->where('vendor_id',  $vendor_id)->where('session_id', Session::getId())->orderByDesc('id')->get();
        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];
        foreach ($cartitems as $cart) {
            $taxlist =  helper::gettax($cart->tax);
            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->product_price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }
        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;

        $customers = User::where('type', 3)->where('vendor_id', $vendor_id)->where('is_deleted', 2)->get();
        $ordersdetails = array();
        if ($request->ajax()) {
            $html = view('admin.pos.cartview', compact('cartitems', 'customers', 'ordersdetails', 'taxArr'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        }
    }

    public function deletecart(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if ($request->cart_id != '') {
            Cart::where('id', $request->cart_id)->delete();
        } else {
            Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->delete();
        }

        return response()->json(['status' => 1, 'message' => 'product Deleted!!'], 200);
    }

    public function applydiscount(Request $request)
    {
        $discountValue = $request->input('discount');

        $request->session()->put('discount', $discountValue);

        return response()->json([
            'message' => 'Discount applied successfully!',
            'discount' => $discountValue
        ]);
    }

    public function removeDiscount(Request $request)
    {
        $request->session()->forget('discount');
        return response()->json([
            'message' => 'Discount removed successfully!',
            'discount' => 0
        ]);
    }


    public function ordernow(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $cartitems = Cart::select('id', 'product_id', 'product_name', 'product_image', 'product_price', 'price', 'qty', 'tax', 'variation_id', 'variation_name', 'extras_name', 'extras_price', 'extras_id')
            ->where('vendor_id',  $vendor_id)
            ->where('session_id', Session::getId())
            ->orderByDesc('id')->get();

        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];

        foreach ($cartitems as $cart) {
            $taxlist = helper::gettax($cart->tax);
            if (!empty($taxlist)) {
                foreach ($taxlist as $tax) {
                    if (!empty($tax)) {
                        $producttax = helper::taxRate($tax->tax, $cart->price, $cart->qty, $tax->type);
                        $itemTax['tax_name'] = $tax->name;
                        $itemTax['tax'] = $tax->tax;
                        $itemTax['tax_rate'] = $producttax;
                        $itemtaxes[] = $itemTax;

                        if (!in_array($tax->name, $tax_name)) {
                            $tax_name[] = $tax->name;

                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            } elseif ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            } elseif ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->price);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }

        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;

        $ordersdetails = [];
        $customers1 = User::where('id', $request->customerid)->first();

        if ($request->ajax()) {
            $html = view('admin.pos.ordernow', compact('cartitems', 'customers1', 'ordersdetails', 'taxArr', 'itemtaxes'))->render();
            return response()->json(['status' => 1, 'output' => $html,], 200);
        }
    }


    public function createorder(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $order_number = "";
        try {
            date_default_timezone_set(helper::appdata($vendor_id)->timezone);
            $vendorinfo = User::where('id', $vendor_id)->first();
            $customerinfo = User::where('id', $request->customer)->first();

            $data = Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->get();

            foreach ($data as $cart) {
                if ($cart->variation_id != "" && $cart->variation_id != null) {
                    $variant = Variation::where('id', $cart->variation_id)->first();
                    $item_name = Products::select('name')->where('id', $cart->item_id)->first();
                    $cartqty = Cart::select(DB::raw("SUM(qty) as qty"))->where('variation_id', $cart->variation_id)->where('session_id', Session::getId())->first();
                    if ($variant->stock_management == 1) {
                        if ($variant->min_order != null && $variant->min_order != ""  && $variant->min_order != 0) {
                            if ($cartqty->qty < $variant->min_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variant->min_order . ' ' . '(' . $item_name->name . ')'], 200);
                            }
                        }

                        if ($variant->max_order != null && $variant->max_order != "" && $variant->max_order != 0) {
                            if ($cartqty->qty > $variant->max_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variant->max_order . ' ' . '(' . $item_name->name . ')'], 200);
                            }
                        }
                        if ($cartqty->qty > $variant->qty) {
                            return response()->json(['status' => 0, 'message' => trans($variant->name . 'qty not enough for order !!')], 200);
                        }
                    }
                } else {
                    $item = Products::where('id', $cart->product_id)->first();

                    $cartqty = Cart::select(DB::raw("SUM(qty) as qty"))->where('product_id', $cart->product_id)->where('session_id', Session::getId())->first();
                    if ($item->stock_management == 1) {
                        if ($item->min_order != null && $item->min_order != ""  && $item->min_order != 0) {
                            if ($cartqty->qty < $item->min_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order . ' ' . '(' . $item->name . ')'], 200);
                            }
                        }

                        if ($item->max_order != null && $item->max_order != "" && $item->max_order != 0) {
                            if ($cartqty->qty > $item->max_order) {
                                return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $item->max_order . ' ' . '(' . $item->name . ')'], 200);
                            }
                        }
                        if ($cartqty->qty > $item->qty) {
                            return response()->json(['status' => 0, 'message' => trans($item->name . 'qty not enough for order !!')], 200);
                        }
                    }
                }
            }
            if ($data->count() > 0) {
                //payment_type = COD : 1, Online : 2
                $payment_type = $request->payment_type;

                $address = "";


                if ($request->discount_amount == "NaN") {
                    $discount_amount = 0;
                } else {
                    $discount_amount = $request->discount_amount;
                }
                $defaultsatus = CustomStatus::where('vendor_id', $vendor_id)->where('type', 1)->where('order_type', 4)->where('is_available', 1)->where('is_deleted', 2)->first();
                if (empty($defaultsatus) && $defaultsatus == null) {
                    return response()->json(['status' => 0, 'message' => trans('messages.order_default_status_message')], 200);
                }
                $getordernumber = Order::select('order_number', 'order_number_digit', 'order_number_start')->where('vendor_id', $vendor_id)->orderBy('id', 'DESC')->first();
                if (empty($getordernumber->order_number_digit)) {
                    $n = helper::appdata($vendor_id)->order_number_start;
                    $newbooking_number = str_pad($n, 0, STR_PAD_LEFT);
                } else {
                    if ($getordernumber->order_number_start == helper::appdata($vendor_id)->order_number_start) {
                        $n = (int)($getordernumber->order_number_digit);
                        $newbooking_number = str_pad($n + 1, 0, STR_PAD_LEFT);
                    } else {
                        $n = helper::appdata($vendor_id)->order_number_start;
                        $newbooking_number = str_pad($n, 0, STR_PAD_LEFT);
                    }
                }
                $order = new Order;
                $order_number = helper::appdata($vendor_id)->order_prefix . $newbooking_number;
                $order->order_number = $order_number;
                $order->order_number_digit = $newbooking_number;
                $order->order_number_start = helper::appdata($vendor_id)->order_number_start;
                $order->vendor_id = $vendor_id;
                $order->order_number = $order_number;
                $order->transaction_type = $payment_type;

                $order->sub_total = $request->sub_total;
                $order->tax_amount = $request->tax_rates;
                $order->tax_name = $request->tax_names;
                $order->grand_total = $request->grand_total;
                $order->status = $defaultsatus->id;
                $order->status_type = $defaultsatus->type;
                $order->is_notification = 2;
                $order->notes = $request->order_note;
                $order->offer_amount = $discount_amount;
                $order->order_type = '4';
                $order->order_from = 'pos';
                $order->payment_status = 2;
                if (!empty($customerinfo)) {
                    $order->user_name = $customerinfo->name;
                    $order->user_email = $customerinfo->email;
                    $order->user_mobile = $customerinfo->mobile;
                } else {
                    $order->user_name = $request->customer_name;
                    $order->user_email = $request->customer_email;
                    $order->user_mobile = $request->customer_phone;
                }
                $order->save();
                $order_id = DB::getPdo()->lastInsertId();
                foreach ($data as $value) {

                    $OrderPro = new OrderDetails();
                    $OrderPro->order_id = $order_id;
                    $OrderPro->product_id = $value['product_id'];
                    $OrderPro->product_name = $value['product_name'];
                    $OrderPro->product_image = $value['product_image'];
                    $OrderPro->attribute = $value['attribute'];
                    $OrderPro->extras_id = $value['extras_id'];
                    $OrderPro->extras_name = $value['extras_name'];
                    $OrderPro->extras_price = $value['extras_price'];
                    $OrderPro->price = $value['price'];
                    if ($value['variation_id'] == "") {
                        $OrderPro->product_price = $value['product_price'];
                        $product = Products::where('id', $value['product_id'])->first();
                        $product->qty = (int)$product->qty - (int)$value['qty'];
                        $product->update();
                    } else {
                        $OrderPro->product_price = $value['product_price'];
                        $variant = Variation::where('product_id', $value['product_id'])->where('id', $value['variation_id'])->first();
                        $variant->qty = (int)$variant->qty - (int)$value['qty'];
                        $variant->update();
                    }
                    $OrderPro->variation_id = $value['variation_id'];
                    $OrderPro->variation_name = $value['variation_name'];

                    $OrderPro->qty = $value['qty'];
                    $OrderPro->save();
                }
                if (Auth::user() && (Auth::user()->type == 2 || Auth::user()->type == 4)) {
                    Cart::where('vendor_id', $vendor_id)->where('session_id', Session::getId())->delete();
                }
                $checkplan = Transaction::where('vendor_id', $vendor_id)->where('transaction_type', null)->orderByDesc('id')->first();

                if (!empty($checkplan)) {
                    if ($checkplan->appoinment_limit != -1) {
                        $checkplan->appoinment_limit -= 1;
                        $checkplan->save();
                    }
                }

                $request->session()->forget('discount');
                $url = URL::to('/admin/orders/print/' . $order_number);
                return response()->json(['status' => 1, 'url' => $url], 200);
            } else {
                return response()->json(['status' => 0, 'message' => 'Cart Empty!!'], 200);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}

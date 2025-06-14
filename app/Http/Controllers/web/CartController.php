<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Cart;
use App\Models\Promocode;
use App\Models\Settings;
use App\Models\Products;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class CartController extends Controller
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
        if (Auth::user() && Auth::user()->type == 3) {
            $getcartlist = Cart::where('vendor_id', @$vdata)->where('user_id', Auth::user()->id)->where('carts.buynow', '!=', 1)->get();
        } else {
            $getcartlist = Cart::where('vendor_id', @$vdata)->where('session_id', session()->getId())->where('carts.buynow', '!=', 1)->get();
        }
        $dt = date('Y-m-d');
        $getpromocodelist = Promocode::where('start_date', '<=', $dt)
            ->where('exp_date', '>=', $dt)
            ->where('vendor_id', $vdata)
            ->orderBy('reorder_id')
            ->get();

        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];
        foreach ($getcartlist as $cart) {

            $taxlist =  helper::gettax($cart->product_tax);

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
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->product_price * $cart->qty);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }

                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->product_price * $cart->qty);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }

        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;
        if (@session()->get('discount_data')['vendor_id'] != @$vdata) {
            session()->forget('discount_data');
        }
        return view('web.cart.index', compact('vendordata', 'getcartlist', 'getpromocodelist', 'taxArr', 'itemtaxes'));
    }
    public function addtocart(Request $request)
    {

        if ($request->buynow == 1) {
            if (Auth::user() && Auth::user()->type == 3) {
                $checkcart = Cart::where('buynow', 1)->where('user_id', Auth::user()->id)->delete();
            } else {
                $checkcart = Cart::where('buynow', 1)->where('session_id', Session::getId())->delete();
            }
        }
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
            $item = Products::where('id', $request->product_id)->where('vendor_id', $vdata)->first();

            $variation = Variation::where('product_id', $request->product_id)->where('name', str_replace(',', '|', $request->variation_name))->first();
            if ($request->variants_name != null && $request->variants_name != "") {
                if (Auth::user() && Auth::user()->type == 3) {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variation->id)->where('user_id', Auth::user()->id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variation->id)->where('session_id', Session::getId())->first();
                }
            } else {
                if (Auth::user() && Auth::user()->type == 3) {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $request->product_id)->where('session_id', Session::getId())->first();
                }
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

            $cartprice = $request->product_price;
            $itemprice = $request->product_price;

            $cart = new Cart();
            $cart->vendor_id = @$vdata;
            if (Auth::user() && Auth::user()->type == 3) {
                $cart->user_id = Auth::user()->id;
            } else {
                $cart->session_id = session()->getId();
            }
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
            $cart->qty = $orderqty;
            if ($request->buynow == null && $request->buynow == "") {
                $cart->buynow = 0;
            } else {
                $cart->buynow = $request->buynow;
            }
            $cart->save();
            $total_cart_count = helper::getcartcount(@$vdata, session()->getId(), Auth::user() && Auth::user()->type == 3 ? Auth::user()->id : "");
            return response()->json(['status' => 1, 'message' => $request->product_name . ' ' . trans('messages.cart_success_message'), 'total_cart_count' => $total_cart_count, 'buynow' => $request->buynow], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function clearcart(Request $request)
    {
        try {
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

            if (Auth::user() && Auth::user()->type == 3) {
                $getcartlist = Cart::where('user_id', Auth::user()->id)->where('vendor_id', @$vdata)->where('id', $request->vid)->first();
            } else {
                $getcartlist = Cart::where('session_id', session()->getId())->where('vendor_id', @$vdata)->where('id', $request->vid)->first();
            }
            $getcartlist->delete();
            session()->forget('discount_data');
            return redirect($request->vendor_slug . '/cart')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function qtyupdate(Request $request)
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
        if (Auth::user() && Auth::user()->type == 3) {
            $checkcart = Cart::where('user_id', Auth::user()->id)->where('vendor_id', @$vdata);
        } else {
            $checkcart = Cart::where('session_id', session()->getId())->where('vendor_id', @$vdata);
        }
        if ($request->pid != "") {
            $checkcart = $checkcart->where('product_id', $request->pid);
        }
        if ($request->vid != "") {
            $checkcart = $checkcart->where('variation_id', $request->vid);
        }
        $checkcart = $checkcart->first();
        if (!empty($checkcart)) {
            try {
                if (in_array($request->type, ['minus', 'plus'])) {
                    if ($checkcart->qty == 1 && $request->type == "minus") {
                        $checkcart->delete();
                        session()->forget('discount_data');
                    } else {
                        if ($request->type == "plus") {
                            if ($request->vid != "" && $request->vid != 0) {
                                $variant = Variation::where('id', $request->vid)->where('product_id', $request->pid)->first();
                                if ($checkcart->qty >= $variant->qty) {
                                    return redirect($request->vendor_slug . '/cart')->with('error', trans('messages.out_of_stock'));
                                } else {
                                    $checkcart->qty += 1;
                                }
                            } else {
                                $product = Products::where('id', $request->pid)->where('vendor_id', $checkcart->vendor_id)->first();
                                if ($checkcart->qty >= $product->qty) {
                                    return redirect($request->vendor_slug . '/cart')->with('error', trans('messages.out_of_stock'));
                                } else {
                                    $checkcart->qty += 1;
                                }
                            }
                        }
                        if ($request->type == "minus") {
                            $checkcart->qty -= 1;
                            session()->forget('discount_data');
                        }
                        $checkcart->save();
                    }
                    session()->forget('discount_data');
                    return redirect($request->vendor_slug . '/cart')->with('success', trans('messages.success'));
                } else {
                    return redirect($request->vendor_slug . '/cart')->with('error', trans('messages.wrong'));
                }
            } catch (\Throwable $th) {
                return redirect($request->vendor_slug . '/cart')->with('error', trans('messages.wrong'));
            }
        } else {
            return redirect($request->vendor_slug . '/cart')->with('error', trans('messages.nodata_found'));
        }
    }
    // public function applypromocode(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'offer_code' => 'required',
    //         'subtotal' => 'required',
    //     ], [
    //         "offer_code.required" => trans('messages.promocode_required'),
    //         "subtotal.required" => trans('messages.wrong'),
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     } else {
    //         $host = $_SERVER['HTTP_HOST'];
    //         if ($host  ==  env('WEBSITE_HOST')) {
    //             $vendordata = helper::vendordata($request->vendor_slug);

    //             $vdata = $vendordata->id;
    //         }
    //         // if the current host doesn't contain the website domain (meaning, custom domain)
    //         else {
    //             $vendordata = Settings::where('custom_domain', $host)->first();

    //             $vdata = $vendordata->vendor_id;
    //         }

    //         if(empty($vendordata))
    //         {
    //             abort(404);
    //         }
    //         date_default_timezone_set(helper::appdata(@$vdata)->timezone);
    //         $checkoffercode = Promocode::where('offer_code', $request->offer_code)->where('vendor_id', @$vdata)->where('is_available', 1)->first();
    //         if (!empty($checkoffercode)) {
    //             if ((date('Y-m-d') >= $checkoffercode->start_date) && (date('Y-m-d') <= $checkoffercode->exp_date)) {
    //                 if ($request->subtotal >= $checkoffercode->min_amount) {
    //                     if ($checkoffercode->usage_type == 1) {
    //                         if (Auth::user() && Auth::user()->type == 3) {
    //                         $checkcount = Order::select('offer_code')->where('offer_code', $request->offer_code)->where('vendor_id', @$vdata)->where('user_id', Auth::user()->id)->count();
    //                         }
    //                         else
    //                         {
    //                             $checkcount = Order::select('offer_code')->where('offer_code', $request->offer_code)->where('vendor_id', @$vdata)->where('session_id', session()->getId())->count();
    //                         }
    //                         if ($checkcount >= $checkoffercode->usage_limit) {
    //                             return redirect()->back()->with('error', trans('messages.usage_limit_exceeded'))->withInput();
    //                         }
    //                     }
    //                     $offer_amount = $checkoffercode->offer_amount;
    //                     if ($checkoffercode->offer_type == 2) {
    //                         $offer_amount = $request->subtotal * $checkoffercode->offer_amount / 100;
    //                     }
    //                     $arr = array(
    //                         "offer_code" => $checkoffercode->offer_code,
    //                         "offer_amount" => $offer_amount,
    //                         "vendor_id" => @$vdata,
    //                     );
    //                     session()->put('discount_data', $arr);
    //                     return redirect()->back()->with('success', trans('messages.success'));
    //                 } else {
    //                     return redirect()->back()->with('error', trans('messages.order_amount_greater_then') . ' ' . helper::currency_formate($checkoffercode->min_amount, @$vdata))->withInput();
    //                 }
    //             } else {
    //                 return redirect()->back()->with('error', trans('messages.invalid_promocode'))->withInput();
    //             }
    //         } else {
    //             return redirect()->back()->with('error', trans('messages.invalid_promocode'))->withInput();
    //         }
    //     }
    // }
    // public function removepromocode()
    // {
    //     if (session()->has('discount_data')) {
    //         session()->forget('discount_data');
    //         return redirect()->back()->with('success', trans('messages.success'));
    //     }
    //     abort(404);
    // }
}

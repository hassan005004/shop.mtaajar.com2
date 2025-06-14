<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Variation;
use App\helper\helper;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(Request $request)
    {

        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->user_id != "" || $request->user_id != null) {
            if ($request->buynow == 0) {
                $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->where('buynow', 0)->get();
            } else {
                $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->where('buynow', 1)->get();
            }
        } else {
            if ($request->buynow == 0) {
                $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->where('buynow', 0)->get();
            } else {
                $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->where('buynow', 1)->get();
            }
        }
        if ($request->user_id != "") {
            $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->where('buynow', 0)->first();
        } else {
            $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id)->where('buynow', 0)->first();
        }
        foreach ($getcartlist as $cart) {
            $cart->product_image = helper::image_path($cart->product_image);
            // $cart->product_tax = helper::decimal_formate($cart->product_tax);
        }

        $itemtaxes = [];
        $producttax = 0;
        $tax_name = [];
        $tax_price = [];

        foreach ($getcartlist as $cart) {
            $taxlist =  helper::gettax($cart->product_tax);
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
                                $price = ($tax->tax / 100) * ($cart->product_price);
                            }
                            $tax_price[] = $price;
                        } else {
                            if ($tax->type == 1) {
                                $price = $tax->tax * $cart->qty;
                            }
                            if ($tax->type == 2) {
                                $price = ($tax->tax / 100) * ($cart->product_price);
                            }
                            $tax_price[array_search($tax->name, $tax_name)] += $price;
                        }
                    }
                }
            }
        }
        $taxArr['tax'] = $tax_name;
        $taxArr['rate'] = $tax_price;
        $totalcarttax = 0;
        foreach ($taxArr['tax'] as $k => $tax) {
            $totalcarttax += (float)$taxArr['rate'][$k];
        }

        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'cartdata' => $getcartlist, 'sub_total' => $carttax->sub_total, 'tax_name' =>  $taxArr['tax'], 'tax_rate' => $taxArr['rate'], 'total_tax' => $totalcarttax], 200);
    }
    public function addtocart(Request $request)
    {

        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->product_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_id_required')], 200);
        }
        if ($request->product_name == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_name_required')], 200);
        }
        if ($request->product_slug == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_slug_required')], 200);
        }
        if ($request->product_image == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_image_required')], 200);
        }

        if ($request->product_price == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_price_required')], 200);
        }

        if ($request->buynow == "") {
            return response()->json(["status" => 0, "message" => trans('messages.buynow_required')], 200);
        }
        try {
            $cart = new Cart;
            $item = Products::where('id', $request->product_id)->first();

            $variation = Variation::where('name', $request->variation_name)->where('product_id', $request->product_id)->first();

            if ($request->variation_name != null && $request->variation_name != "") {

                if ($request->user_id != null && $request->user_id != "") {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variation->id)->where('user_id', $request->user_id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $variation->id)->where('session_id', $request->session_id)->first();
                }
                if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                    $qty = $cartqty->totalqty + $request->qty;
                } else {
                    $qty = $request->qty;
                }

                if ($variation->stock_management == 1) {

                    if ($variation->min_order != null && $variation->min_order != ""  && $variation->min_order != 0) {
                        if ($qty < $variation->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variation->min_order], 200);
                        }
                    }
                    if ($qty > $variation->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->name . '(' . $request->variants_name . ')'], 200);
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
                }
            } else {
                if ($request->user_id != null && $request->user_id != "") {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
                } else {
                    $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $request->product_id)->where('session_id', $request->session_id)->first();
                }
                if ($cartqty->totalqty != null && $cartqty->totalqty != "") {
                    $qty = $cartqty->totalqty + 1;
                } else {
                    $qty = 1;
                }
                if ($item->stock_management == 1) {
                    if ($item->min_order != null && $item->min_order != ""  && $item->min_order != 0) {
                        if ($qty < $item->min_order) {
                            return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $item->min_order], 200);
                        }
                    }

                    if ($qty > $item->qty) {
                        return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item->name], 200);
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
                }
            }


            $cart->qty = $request->qty;
            $cart->vendor_id = $request->vendor_id;
            if ($request->user_id != "" || $request->user_id != null) {
                $cart->user_id = $request->user_id;
            } else {
                $cart->session_id = $request->session_id;
            }
            $cart->product_id = $request->product_id;
            $cart->product_name = $request->product_name;
            $cart->product_slug = $request->product_slug;
            $cart->product_image = $request->product_image;
            if ($request->variation_name != null && $request->variation_name != "") {
                $cartprice = $variation->price;
                $cart->variation_id =  $variation->id;
                $cart->variation_name = $request->variation_name;
                $itemprice = $variation->price;
            } else {
                $cartprice = $request->product_price;
                $itemprice = $request->product_price;
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
            $cart->extras_name = $request->extras_name;
            $cart->extras_price = $request->extras_price;
            $cart->extras_id = $request->extras_id;
            $cart->buynow = $request->buynow;
            $cart->save();

            $total_cart_count = helper::getcartcount($request->vendor_id, $request->session_id, $request->user_id);
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'total_cart_count' => $total_cart_count], 200);
        } catch (\Throwable $th) {

            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function qtyupdate(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->product_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.product_id_required')], 200);
        }
        if ($request->type == "") {
            return response()->json(["status" => 0, "message" => trans('messages.type_required')], 200);
        }
        if ($request->user_id != "" || $request->user_id != null) {
            $checkcart = Cart::where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id);
        } else {
            $checkcart = Cart::where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id);
        }

        if ($request->product_id != "") {
            $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $request->product_id)->where('user_id', $request->user_id)->where('buynow', 0)->first();
            $checkcart = $checkcart->where('product_id', $request->product_id);
        }
        if ($request->variation_id != "") {
            $checkcart = $checkcart->where('variation_id', $request->variation_id);
            $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $request->variation_id)->where('user_id', $request->user_id)->where('buynow', 0)->first();
        }

        $checkcart = $checkcart->where('buynow', 0)->first();
        if (!empty($checkcart)) {
            try {
                if (in_array($request->type, ['minus', 'plus'])) {
                    if ($checkcart->qty == 1 && $request->type == "minus") {
                        $checkcart->delete();
                        session()->forget('discount_data');
                    } else {
                        if ($request->type == "plus") {
                            $updateqty = (int)$checkcart->qty + 1;
                            $qty = (int)$cartqty->totalqty + 1;
                        }
                        if ($request->type == "minus") {
                            $updateqty = (int)$checkcart->qty - 1;
                            $qty = (int)$cartqty->totalqty - 1;
                            session()->forget('discount_data');
                        }
                        if ($checkcart->variation_name != "" && $checkcart->variation_name != null) {
                            $variants = Variation::where('name', $checkcart->variation_name)->first();
                        } else {
                            $variants = Products::where('id', $checkcart->product_id)->first();
                        }
                        if ($variants->stock_management == 1) {
                            if ($variants->min_order != null && $variants->min_order != "" && $variants->min_order != 0) {
                                if ($variants->min_order > $qty) {
                                    return response()->json(['status' => 0, 'message' => trans('messages.min_qty_message') . $variants->min_order], 200);
                                }
                            }
                            if ($variants->max_order != null && $variants->max_order != "" && $variants->max_order != 0) {
                                if ($variants->max_order < $qty) {
                                    return response()->json(['status' => 0, 'message' => trans('messages.max_qty_message') . $variants->max_order], 200);
                                }
                            }
                            if ($qty == $variants->qty) {
                                $checkcart->qty = $updateqty;
                                $checkcart->update();
                                return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                            }
                            if ($variants->qty < $qty) {
                                if ($checkcart->variants_name != "" && $checkcart->variants_name != null) {
                                    $item_name = Products::select('name')->where('id', $checkcart->item_id)->first();
                                    return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $item_name->item_name . '(' . $checkcart->variants_name . ')'], 200);
                                } else {
                                    return response()->json(['status' => 0, 'message' => trans('labels.out_of_stock_msg') . ' ' . $variants->item_name], 200);
                                }
                            } else {
                                $checkcart->qty = $updateqty;
                                $checkcart->update();
                                return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                            }
                        } else {
                            $checkcart->qty = $updateqty;
                            $checkcart->update();
                            return response()->json(['status' => 1, 'message' => trans('messages.qty_update_msg')], 200);
                        }
                    }
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
                }
            } catch (\Throwable $th) {
                return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.nodata_found')], 200);
        }
    }

    public function deletecartitem(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->cart_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.cart_id_required')], 200);
        }

        $cart = Cart::where('vendor_id', $request->vendor_id)->where('id', $request->cart_id)->where('buynow', 0)->delete();

        if ($cart) {
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    // public function shippingarea(Request $request)
    // {
    //     if ($request->vendor_id == "") {
    //         return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
    //     }
    //     if ($request->buynow == "") {
    //         return response()->json(["status" => 0, "message" => trans('messages.buynow_required')], 200);
    //     }
    //     if ($request->user_id != "" || $request->user_id != null) {
    //         if ($request->buynow == 0) {
    //             $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->where('buynow', 0)->get();
    //             $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->where('buynow', 0)->first();
    //         } else {
    //             $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('user_id', $request->user_id)->where('buynow', 1)->get();
    //             $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->where('buynow', 1)->first();
    //         }
    //     } else {
    //         if ($request->buynow == 0) {
    //             $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->where('buynow', 0)->get();
    //             $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id)->where('buynow', 0)->first();
    //         } else {
    //             $getcartlist = Cart::where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->where('buynow', 1)->get();
    //             $carttax = Cart::select(DB::raw('SUM((qty)*(product_price)) AS sub_total'))->where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id)->where('buynow', 1)->first();
    //         }
    //     }
    //     $itemtaxes = [];
    //     $producttax = 0;
    //     $tax_name = [];
    //     $tax_price = [];

    //     foreach ($getcartlist as $cart) {
    //         $taxlist =  helper::gettax($cart->product_tax);
    //         if (!empty($taxlist)) {
    //             foreach ($taxlist as $tax) {
    //                 if (!empty($tax)) {
    //                     $producttax = helper::taxRate($tax->tax, $cart->product_price, $cart->qty, $tax->type);
    //                     $itemTax['tax_name'] = $tax->name;
    //                     $itemTax['tax'] = $tax->tax;
    //                     $itemTax['tax_rate'] = $producttax;
    //                     $itemtaxes[] = $itemTax;
    //                     if (!in_array($tax->name, $tax_name)) {
    //                         $tax_name[] = $tax->name;
    //                         if ($tax->type == 1) {
    //                             $price = $tax->tax * $cart->qty;
    //                         }
    //                         if ($tax->type == 2) {
    //                             $price = ($tax->tax / 100) * ($cart->product_price);
    //                         }
    //                         $tax_price[] = $price;
    //                     } else {
    //                         if ($tax->type == 1) {
    //                             $price = $tax->tax * $cart->qty;
    //                         }
    //                         if ($tax->type == 2) {
    //                             $price = ($tax->tax / 100) * ($cart->product_price);
    //                         }
    //                         $tax_price[array_search($tax->name, $tax_name)] += $price;
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     $taxArr['tax'] = $tax_name;
    //     $taxArr['rate'] = $tax_price;
    //     $totalcarttax = 0;
    //     foreach ($taxArr['tax'] as $k => $tax) {
    //         $totalcarttax += (float)$taxArr['rate'][$k];
    //     }
    //     return response()->json(["status" => 1, "message" => trans('messages.success'), 'sub_total' => $carttax->sub_total, 'total_tax' => $totalcarttax, 'tax_name' =>  $taxArr['tax'], 'tax_rate' => $taxArr['rate']], 200);
    // }

    public function changeqty(Request $request)
    {
        if ($request->variants_name == null) {

            $item = Products::where('id', $request->product_id)->where('vendor_id', $request->vendor_id)->first();
            if ($request->user_id != "" && $request->user_id != null) {
                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $item->id)->where('user_id', $request->user_id)->where('vendor_id', $request->vendor_id)->first();
            } else {

                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('product_id', $item->id)->where('session_id', $request->session_id)->where('vendor_id', $request->vendor_id)->first();
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
            if ($request->user_id != "" && $request->user_id != null) {
                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $item->id)->where('user_id', $request->user_id)->first();
            } else {

                $cartqty = Cart::select(DB::raw("SUM(qty) as totalqty"))->where('variation_id', $item->id)->where('session_id', $request->sessoin_id)->first();
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
}

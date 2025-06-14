<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TopDeals;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopdealsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $productlist = Products::where('top_deals', 1)->where('is_available', 1)->where('vendor_id', $vendor_id)->get();
        $topdeals = TopDeals::where('vendor_id', $vendor_id)->first();
        $getproducts = Products::where('is_available', 1)->where('vendor_id', $vendor_id)->get();
        return view('admin.top_deals.index', compact('productlist', 'topdeals', 'getproducts'));
    }

    public function top_deals(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = TopDeals::where('vendor_id', $vendor_id)->first();
        if (empty($settingdata)) {
            $settingdata = new TopDeals();
        }

        $settingdata->vendor_id = $vendor_id;
        $settingdata->start_date = $request->top_deals_start_date;
        $settingdata->end_date = $request->top_deals_end_date;
        $settingdata->start_time = $request->top_deals_start_time;
        $settingdata->end_time = $request->top_deals_end_time;
        $settingdata->offer_type = $request->offer_type;
        $settingdata->offer_amount = $request->amount;
        $settingdata->deal_type = $request->deal_type;
        $settingdata->top_deals_switch = isset($request->top_deals_switch) ? 1 : 2;
        if ($request->products != "" && $request->products != null) {
            foreach ($request->products as $product) {
                $dealproduct = Products::where('id', $product)->first();
                $dealproduct->top_deals = 1;
                $dealproduct->update();
            }
        }
        $settingdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $product = Products::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        $product->top_deals = 2;
        $product->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}

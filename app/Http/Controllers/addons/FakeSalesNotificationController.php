<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\helper\helper;

class FakeSalesNotificationController extends Controller
{
    public function fake_sales_notification(Request $request)
    {
        $request->validate([
            'product_source' => 'required',
            'next_time_popup' => 'required',
            'notification_display_time' => 'required',
        ]);

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $data = Settings::where('vendor_id', $vendor_id)->first();        
        $data->fake_sales_notification =  isset($request->fake_sales_notification) ? 1 : 2;
        $data->product_source = $request->product_source;
        $data->next_time_popup = $request->next_time_popup;
        $data->notification_display_time = $request->notification_display_time;
        $data->sales_notification_position = $request->sales_notification_position;
        $data->update();
        
        return redirect()->back()->with('success', trans('messages.update'));
    }
    
    public function get_notification_data(Request $request)
    {
        if (helper::appdata($request->vendor_id)->product_source == 1) {
            $productdata = Products::select(
                'products.name',
                'products.slug',
                'product_images.image',
            )
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->where('products.vendor_id',$request->vendor_id)
            ->where('products.is_deleted', '2')
            ->where('products.is_deleted', '2')
            ->inRandomOrder()->limit(1)->first();
        }

        if (helper::appdata($request->vendor_id)->product_source == 2) {
            $productdata = Order::select(
                'products.name',
                'products.slug',
                'product_images.image',
            )
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('product_images', 'order_details.product_id', '=', 'product_images.product_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('orders.vendor_id',$request->vendor_id)
            ->inRandomOrder()->limit(1)->first();
        }

        $vendordata = helper::getslug($request->vendor_id);
        
        if ($request->ajax()) {
            $html = view('web.sales_notification.index', compact('vendordata','productdata'))->render();
            return response()->json(['status' => 1, 'output' => $html], 200);
        }
        return redirect()->back()->with('success', trans('messages.update'));
    }
}

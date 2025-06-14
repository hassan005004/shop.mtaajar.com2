<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetails;
use App\Models\SystemAddons;
use App\Models\CustomStatus;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\helper\helper;
class HomeController extends Controller
{
     public function index(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],400);
        }
        $currency = helper::appdata($request->vendor_id)->currency;
        $currency_position = helper::appdata($request->vendor_id)->currency_position;
        $decimal_separator = helper::appdata($request->vendor_id)->decimal_separator;
        $currency_space = helper::appdata($request->vendor_id)->currency_space;
        $currency_formate = helper::appdata($request->vendor_id)->currency_formate;
        $admindata = User::select('mobile','email')->where('type',1)->first();
        
        $revenue = Order::where('vendor_id', $request->vendor_id)->where('status_type', '3')->sum('grand_total');
        $totalorders = Order::where('vendor_id', $request->vendor_id)->count();
        $completedorders = Order::where('status_type', 3)->where('vendor_id',$request->vendor_id)->count();
        $cancelorders = Order::where('vendor_id', $request->vendor_id)->where('status_type',4)->count();
        $orderlist = Order::select("orders.id","orders.order_number","orders.grand_total","orders.order_type","orders.status_type","orders.payment_status","orders.transaction_type","orders.status",DB::raw('DATE_FORMAT(orders.created_at,"%d-%m-%Y" ) as order_date'),'custom_status.name as status_name','payment.payment_name as payment_name')->join('custom_status','custom_status.id','orders.status')->join('payment','payment.payment_type','orders.transaction_type')->where('orders.vendor_id', $request->vendor_id)->whereIn('orders.status_type',[1, 2])->orderByDesc('id')->get();


        return response()->json(['status'=>1,'message'=>trans('messages.success'),'revenue'=>$revenue,'totalorders'=>$totalorders,'completedorders'=>$completedorders,'cancelorders'=>$cancelorders,'data'=>$orderlist,'currency'=>$currency,'currency_position'=>$currency_position,'admin_mobile' => $admindata->mobile,'admin_email'=> $admindata->email,'admin_address'=>$admindata->address,'decimal_separator'=>$decimal_separator,'currency_space'=>$currency_space,'currency_formate'=>$currency_formate,'date_format'=>helper::appdata($request->vendor_id)->date_format,"time_format"=>helper::appdata($request->vendor_id)->time_format],200);
    }
    public function order_history(Request $request)
    { 
           
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],400);
        }
        if(helper::appdata($request->vendor_id)->online_order == 1)
        {
            $orders = Order::select("orders.id","orders.order_number","orders.grand_total","orders.order_type","orders.status","orders.status_type",DB::raw('DATE_FORMAT(orders.created_at, "%d-%m-%Y") as order_date'),'custom_status.name as status_name','orders.payment_status','orders.transaction_type','payment.payment_name')->join('custom_status','custom_status.id','orders.status')->join("payment",function($join){
                $join->on("payment.vendor_id","=","orders.vendor_id")
                    ->on("payment.payment_type","=","orders.transaction_type");
            })->where('orders.vendor_id',$request->vendor_id)->orderByDesc('orders.id')->get();
        }else{
            $orders = Order::select("orders.id","orders.order_number","orders.grand_total","orders.order_type","orders.status","orders.status_type",DB::raw('DATE_FORMAT(orders.created_at, "%d-%m-%Y") as order_date'),'payment.payment_name')->join('payment','payment.vendor_id','orders.vendor_id')->where('orders.vendor_id',$request->vendor_id)->orderByDesc('orders.id')->get();
        }
        return response()->json(['status'=>1,'message'=>trans('messages.success'),'data'=>$orders],200);
    }
    public function order_detail(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],400);
        }
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_number_required')],400);
        }
        $orders = Order::where('vendor_id',$request->vendor_id)->where("order_number",$request->order_number)->orderByDesc('id');
        $order =  $orders->select("id","order_number","user_name","user_email","user_mobile","grand_total","sub_total","offer_code","offer_amount","tax_amount","delivery_charge","transaction_id","transaction_type","status",DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as order_date'),"notes","status_type","order_type","transaction_type","payment_status","vendor_note","tax_name",DB::raw("CONCAT('".url(env('ASSETPATHURL').'admin-assets/images/screenshot/')."/', screenshot) AS screenshot"))->first();
        $biilinginfo = $orders->select("billing_address","billing_landmark","billing_postal_code","billing_city","billing_state","billing_country")->first();
        $shippinginfo = $orders->select("shipping_address","shipping_landmark","shipping_postal_code","shipping_city","shipping_state","shipping_country")->first();
        $order_detail = OrderDetails::select("id","order_id","product_id","product_name",DB::raw("CONCAT('".url(env('ASSETPATHURL').'admin-assets/images/product/')."/', product_image) AS product_image"),"attribute","variation_id","variation_name","product_price","product_tax","qty")->where('order_id',$order->id)->get();
        $custom_status = CustomStatus::where('vendor_id', $request->vendor_id)->where('order_type', $order->order_type)->where('type', $order->status_type)->where('id', $order->status)->first();
       
        $payment = Payment::where('vendor_id', $request->vendor_id)->where('payment_type',$order->transaction_type)->first();
       
        if ($order->transaction_type == 0) {
            $payment_name = trans('labels.offline');
        } else {
            $payment_name = $payment->payment_name;
        }
        $statuslist = CustomStatus::where('vendor_id', $request->vendor_id)->where('is_available',1)->where('is_deleted',2)->where('order_type',$order->order_type)->orderBy('reorder_id')->get();
        return response()->json(['status'=>1,'message'=>trans('messages.success'),'data'=>$order,'ordrdetail'=>$order_detail,"biilinginfo"=>$biilinginfo,"shippinginfo"=>$shippinginfo,'customstatus' => @$custom_status->name,'statuslist'=>$statuslist,'payment_name'=>$payment_name],200);
    }
    public function status_change(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],200);
        }
        if($request->status_type == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.status_type_required')],200);
        }
        if($request->status == "")
        {
            return response()->json(["status"=>0,"message"=>trans('messages.status_required')],200);
        }
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_number_required')],200);
        }
        $order = Order::where('order_number', $request->order_number)->where('vendor_id',$request->vendor_id)->first();
        
        $defaultsatus = CustomStatus::where('vendor_id', $request->vendor_id)->where('order_type',$order->order_type)->where('type', $request->status_type)->where('id',$request->status)->first();
        if (empty($defaultsatus) && $defaultsatus == null) {
            return response()->json(['status'=>0,'message'=>trans('messages.wrong')],200);
        } else {
            Order::where('order_number', $request->order_number)
            ->update([
                'status' => $defaultsatus->id,
                'status_type' => $request->status_type
            ]);
            return response()->json(['status'=>1,'message'=>trans('messages.success')],200);
        }
       
    }
    public function systemaddon(Request $request)
    {
        
        $addons = SystemAddons::select('unique_identifier', 'activated')->get();
        return response()->json(["status" => 1, "message" => trans('messages.success'), 'addons' =>  $addons], 200);
    }
}

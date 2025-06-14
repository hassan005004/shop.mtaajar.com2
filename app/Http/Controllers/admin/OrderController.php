<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\helper\whatsapp_helper;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetails;
use App\Models\CustomStatus;
use App\Models\Variation;
use App\Models\Products;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Config;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getorders = Order::where('vendor_id', $vendor_id);
        if ($request->has('status') && $request->status != "") {
            if ($request->status == "processing") {
                $getorders = $getorders->whereIn('status_type', array(1, 2));
            }
            if ($request->status == "delivered") {
                $getorders = $getorders->where('status_type', 3);
            }
            if ($request->status == "cancelled") {
                $getorders = $getorders->whereIn('status_type', array(4));
            }
            if ($request->status == "rejected") {
                $getorders = $getorders->where('status_type', 4);
            }
        }
        $totalorders = Order::where('vendor_id', $vendor_id)->count();
        $totalprocessing = Order::whereIn('status_type', [1, 2])->where('vendor_id', $vendor_id)->count();
        $totalrevenue = Order::where('vendor_id', $vendor_id)->where('status_type', 3)->where('payment_status', 2)->sum('grand_total');
        $totalcompleted = Order::where('status_type', 3)->where('vendor_id', $vendor_id)->count();
        $totalcancelled = Order::where('status_type', 4)->where('vendor_id', $vendor_id)->count();
        $totalrejected = Order::where('status_type', 4)->where('vendor_id', $vendor_id)->count();
        if (!empty($request->customer_id) && !empty($request->startdate) && !empty($request->enddate)) {
            $totalorders = Order::where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->where('user_id', $request->customer_id)->count();
            $getorders = $getorders->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->where('user_id', $request->customer_id);
            $totalprocessing = Order::whereIn('status_type', array(1, 2))->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->where('user_id', $request->customer_id)->count();
            $totalrevenue = Order::where('status_type', 3)->where('payment_status', 2)->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->where('user_id', $request->customer_id)->sum('grand_total');
            $totalcompleted = Order::where('status_type', 3)->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->where('user_id', $request->customer_id)->count();
            $totalcancelled = Order::whereIn('status_type', array(4))->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->where('user_id', $request->customer_id)->count();
        } else if (!empty($request->startdate) && !empty($request->enddate)) {
            $totalorders = Order::where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->count();
            $getorders = $getorders->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate);
            $totalprocessing = Order::whereIn('status_type', array(1, 2))->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->count();
            $totalrevenue = Order::where('status_type', 3)->where('payment_status', 2)->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->sum('grand_total');
            $totalcompleted = Order::where('status_type', 3)->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->count();
            $totalcancelled = Order::whereIn('status_type', array(4))->where('vendor_id', $vendor_id)->whereDate('created_at', '>=', $request->startdate)->whereDate('created_at', '<=', $request->enddate)->count();
        }
        $getorders = $getorders->orderByDesc('id')->get();
        $getcustomerslist = User::where('type', 3)
            ->where('vendor_id', $vendor_id)->where('is_deleted', 2)
            ->get();
        return view('admin.orders.index', compact('getorders', 'totalorders', 'totalprocessing', 'totalcompleted', 'totalcancelled', 'totalrevenue', 'totalrejected', 'getcustomerslist'));
    }
    public function update(Request $request)
    {
        try {
            $orderdata = Order::where('id', $request->id)->first();
            $orderdetail = OrderDetails::where('order_id', $orderdata->id)->get();

            if (empty($orderdata) || !in_array($request->type, [2, 3, 4])) {
                abort(404);
            }
            $title = "";
            $message_text = "";

            if ($request->type == "2") {
                $title = @helper::gettype($request->status, $request->type, $orderdata->order_type, $orderdata->vendor_id)->name;
                $message_text = 'Your Order ' . $orderdata->order_number . ' has been accepted by Admin';
            }
            if ($request->type == "3") {
                $title = @helper::gettype($request->status, $request->type, $orderdata->order_type, $orderdata->vendor_id)->name;
                $message_text = 'Your Order ' . $orderdata->order_number . ' has been successfully delivered.';
            }
            if ($request->type == "4") {
                if ($orderdata->transaction_type != 1 && $orderdata->user_id != '') {
                    $walletuser = User::where('id', $orderdata->user_id)->first();
                    $walletuser->wallet += $orderdata->grand_total;
                    $walletuser->save();

                    $transaction = new Transaction();
                    $transaction->vendor_id = $orderdata->vendor_id;
                    $transaction->user_id = $orderdata->user_id;
                    $transaction->order_id = $orderdata->id;
                    $transaction->payment_id = $orderdata->payment_id;
                    $transaction->transaction_type = 3;
                    $transaction->amount = $orderdata->grand_total;
                    $transaction->order_number = $orderdata->order_number;
                    $transaction->save();
                }
                $title = @helper::gettype($request->status, $request->type, $orderdata->order_type, $orderdata->vendor_id)->name;
                $message_text = 'Order ' . $orderdata->order_number . ' has been cancelled by Admin.';
            }
            $vendor = User::select('id', 'name')->where('id', $orderdata->vendor_id)->first();

            $defaultsatus = CustomStatus::where('id', $request->status)->where('vendor_id', $orderdata->vendor_id)->where('order_type', $orderdata->order_type)->where('type', $request->type)->where('is_available', 1)->where('is_deleted', 2)->first();

            if (helper::appdata($orderdata->vendor_id)->product_type == 1) {
                if (empty($defaultsatus) && $defaultsatus == null) {
                    return redirect()->back()->with('error', trans('messages.wrong'));
                } else {

                    $emaildata = helper::emailconfigration($vendor->id);
                    Config::set('mail', $emaildata);
                    helper::order_status_email($orderdata->user_email, $orderdata->user_name, $title, $message_text, $vendor);

                    if (@helper::checkaddons('whatsapp_message')) {
                        if (@whatsapp_helper::whatsapp_message_config($orderdata->vendor_id)->order_status_change == 1) {
                            whatsapp_helper::orderstatusupdatemessage($orderdata->order_number, $message_text, $orderdata->vendor_id);
                        }
                    }
                    if ($orderdata->transaction_type == 6 && $request->type == 3) {
                        $orderdata->payment_status = 2;
                    }

                    $orderdata->status = $defaultsatus->id;
                    $orderdata->status_type = $defaultsatus->type;
                    $orderdata->update();

                    if ($request->type == "4") {
                        foreach ($orderdetail as $order) {
                            if ($order->variation_id != null && $order->variation_id != "") {
                                $item = Variation::where('id', $order->variation_id)->where('product_id', $order->product_id)->first();
                            } else {
                                $item = Products::where('id', $order->product_id)->where('vendor_id', $orderdata->vendor_id)->first();
                            }
                            $item->qty = $item->qty + $order->qty;
                            $item->update();
                        }
                    }
                }
            }
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function invoice(Request $request)
    {
        $getorderdata = Order::where('order_number', $request->order_number)->where('vendor_id', $request->vendor_id)->first();
        if (empty($getorderdata)) {
            abort(404);
        }
        $ordersdetails = OrderDetails::where('order_id', $getorderdata->id)->get();
        return view('admin.orders.invoice', compact('getorderdata', 'ordersdetails'));
    }
    public function print(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getorderdata = Order::where('order_number', $request->order_number)->where('vendor_id', $vendor_id)->first();
        if (empty($getorderdata)) {
            abort(404);
        }
        $ordersdetails = OrderDetails::where('order_id', $getorderdata->id)->get();
        return view('admin.orders.print', compact('getorderdata', 'ordersdetails'));
    }

    public function generatepdf(Request $request)
    {
        $getorderdata = Order::where('order_number', $request->order_number)->where('vendor_id', $request->vendor_id)->first();
        $ordersdetails = OrderDetails::where('order_id', $getorderdata->id)->get();
        $pdf = Pdf::loadView('admin.orders.invoicepdf', ['getorderdata' => $getorderdata, 'ordersdetails' => $ordersdetails]);
        return $pdf->download('orderinvoice.pdf');
    }
    public function customerinfo(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $customerinfo = Order::where('order_number', $request->order_id)->where('vendor_id', $vendor_id)->first();

        if ($request->edit_type == "customer_info") {
            $customerinfo->user_name = $request->user_name;
            $customerinfo->user_mobile = $request->user_mobile;
            $customerinfo->user_email = $request->user_email;
        }
        if ($request->edit_type == "bill_info") {
            $customerinfo->billing_address = $request->bill_address;
            $customerinfo->billing_landmark = $request->bill_landmark;
            $customerinfo->billing_postal_code = $request->bill_pincode;
            $customerinfo->billing_city = $request->bill_city;
            $customerinfo->billing_state = $request->bill_state;
            $customerinfo->billing_country = $request->bill_country;
        }
        if ($request->edit_type == "shipping_info") {
            $customerinfo->shipping_address = $request->shipping_address;
            $customerinfo->shipping_landmark = $request->shipping_landmark;
            $customerinfo->shipping_postal_code = $request->shipping_pincode;
            $customerinfo->shipping_city = $request->shipping_city;
            $customerinfo->shipping_state = $request->shipping_state;
            $customerinfo->shipping_country = $request->shipping_country;
        }
        $customerinfo->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function vendor_note(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $updatenote = Order::where('order_number', $request->order_id)->where('vendor_id', $vendor_id)->first();

        $updatenote->vendor_note = $request->vendor_note;
        $updatenote->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function payment_status(Request $request)
    {
        if ($request->ramin_amount > 0) {
            return redirect()->back()->with('error', trans('messages.amount_validation_msg'));
        }

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $order = Order::where('order_number', $request->booking_number)->where('vendor_id', $vendor_id)->first();
        $order->payment_status = 2;
        $order->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}

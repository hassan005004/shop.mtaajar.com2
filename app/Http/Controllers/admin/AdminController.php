<?php

namespace App\Http\Controllers\admin;

use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PricingPlan;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Session;
use App\helper\helper;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $user = User::where('id', $vendor_id)->first();
        // Admin
        $totalplans = PricingPlan::count();
        // Vendor-Admin
        $currentplanname = PricingPlan::select('name')->where('id', $user->plan_id)->orderByDesc('id')->first();
        // ----------------------- chart -----------------------
        $doughnutyear = $request->doughnutyear != "" ? $request->doughnutyear : date('Y');
        $revenueyear = $request->revenueyear != "" ? $request->revenueyear : date('Y');


        if (Auth::user()->type == 1) {
            $totalrevenue = Transaction::where('status', 2)->sum('amount');
            $totalvendors = User::where('id', '!=', 1)->where('is_available', 1)->where('type', 2)->where('is_deleted', 2)->count();
            $totalorders = Transaction::count('id');
            // DOUGHNUT-CHART-START
            $doughnut_years = User::select(DB::raw("YEAR(created_at) as year"))->where('type', 2)->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            $vendorlist = User::select(DB::raw("YEAR(created_at) as year"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("COUNT(id) as total_user"))->whereYear('created_at', $doughnutyear)->where('type', 2)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_user', 'month_name');
            $doughnutlabels = $vendorlist->keys();
            $doughnutdata = $vendorlist->values();
            // DOUGHNUT-CHART-END
            // revenue-CHART-START
            $revenue_years = Transaction::select(DB::raw("YEAR(purchase_date) as year"))->groupBy(DB::raw("YEAR(purchase_date)"))->orderByDesc('purchase_date')->get();
            $revenue_list = Transaction::select(DB::raw("YEAR(purchase_date) as year"), DB::raw("MONTHNAME(purchase_date) as month_name"), DB::raw("SUM(amount) as total_amount"))->whereYear('purchase_date', $revenueyear)->where('status', 2)->orderby('purchase_date')->groupBy(DB::raw("MONTHNAME(purchase_date)"))->pluck('total_amount', 'month_name');
            $revenuelabels = $revenue_list->keys();
            $revenuedata = $revenue_list->values();
            $transaction = Transaction::with('vendor_info')->where('transaction_type', null)->whereDate('created_at', Carbon::today())->get();
            // revenue-CHART-END
            $getorders = array();
            $topitems = Products::with('category_info', 'product_image')->join('order_details','order_details.product_id','products.id')
            ->select('products.id','products.category_id','products.name','products.slug',DB::raw('count(order_details.product_id) as item_order_counter'))
            ->groupBy('order_details.product_id')->having('item_order_counter','>',0)
            ->where('products.vendor_id', $vendor_id)->where('products.is_deleted',2)->orderByDesc('item_order_counter')
            ->get()->take(5);
            $orders = Order::where('vendor_id', $vendor_id)->get();
            $orderIds = $orders->pluck('id');
            $getorderdetailscount = OrderDetails::whereIn('order_id', $orderIds)->count();
            
            $topusers = User::join('orders','orders.user_id','users.id')
             ->select('users.id','users.name','users.email','users.image','users.mobile',DB::raw('count(orders.user_id) as user_order_counter'))
             ->having('user_order_counter','>',0)->where('orders.vendor_id',$vendor_id)->where('users.type',2)
             ->where('users.is_available',1)->orderByDesc('user_order_counter')->get()->take(7);
        } else {
            $totalrevenue = Order::where('vendor_id', $vendor_id)->where('status_type', 3)->where('payment_status',2)->sum('grand_total');
            $totalvendors = Products::where('vendor_id', $vendor_id)->count();
            $totalorders = Order::where('vendor_id', $vendor_id)->count();
            // DOUGHNUT-CHART-START
            $doughnut_years = $revenue_years = Order::select(DB::raw("YEAR(created_at) as year"))->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            $orderlist = Order::select(DB::raw("YEAR(created_at) as year"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("COUNT(id) as total_orders"))->whereYear('created_at', $doughnutyear)->orderBy('created_at')->where('vendor_id', $vendor_id)->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_orders', 'month_name');
            $doughnutlabels = $orderlist->keys();
            $doughnutdata = $orderlist->values();
            // DOUGHNUT-CHART-END
            // revenue-CHART-START
            $revenue_list = Order::select(DB::raw("YEAR(created_at) as year"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("SUM(grand_total) as total_amount"))->whereYear('created_at', $revenueyear)->orderBy('created_at')->where('vendor_id', $vendor_id)->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_amount', 'month_name');
            $revenuelabels = $revenue_list->keys();
            $revenuedata = $revenue_list->values();
            // revenue-CHART-END
            $getorders = order::where('vendor_id', $vendor_id)->whereIn('status_type', ['1', '2'])->orderByDesc('id')->get();
            $transaction = array();
            $topitems = Products::with('category_info', 'product_image')->join('order_details','order_details.product_id','products.id')
            ->select('products.id','products.category_id','products.name','products.slug',DB::raw('count(order_details.product_id) as item_order_counter'))
            ->groupBy('order_details.product_id')->having('item_order_counter','>',0)
            ->where('products.vendor_id', $vendor_id)->where('products.is_deleted',2)->orderByDesc('item_order_counter')
            ->get()->take(5);
            $orders = Order::where('vendor_id', $vendor_id)->get();
            $orderIds = $orders->pluck('id');
            $getorderdetailscount = OrderDetails::whereIn('order_id', $orderIds)->count();

            $topusers = User::join('orders','orders.user_id','users.id')
            ->select('users.id','users.name','users.email','users.image','users.mobile',DB::raw('count(orders.user_id) as user_order_counter'))
            ->having('user_order_counter','>',0)->where('orders.vendor_id',$vendor_id)->where('users.type',3)
            ->where('users.is_available',1)->orderByDesc('user_order_counter')->get()->take(7);
        }

        if (env('Environment') == 'sendbox') {
            $revenuelabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'];
            $revenuedata = [636, 1269, 2810, 2843, 3637, 467, 902, 1296, 402, 1173, 1509, 413];
            if (Auth::user()->type == 1) {
                $doughnutlabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'];
                $doughnutdata = [16, 14, 25, 28, 45, 31, 25, 35, 49, 21, 32, 31];
            } else {
                $doughnutlabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'];
                $doughnutdata = [60, 42, 13, 83, 34, 97, 92, 62, 13, 99, 89, 94];
            }
        }

        if ($request->ajax()) {
            return response()->json(['doughnutlabels' => $doughnutlabels, 'doughnutdata' => $doughnutdata, 'revenuelabels' => $revenuelabels, 'revenuedata' => $revenuedata], 200);
        } else {
            if (Auth::user()->type == 4) {
                if (helper::check_access('role_dashboard', Auth::user()->role_id, Auth::user()->vendor_id, 'manage') == 1) {
                    return view(
                        'admin.dashboard.index',
                        compact(
                            'totalvendors',
                            'totalplans',
                            'totalorders',
                            'totalrevenue',
                            'currentplanname',
                            'doughnut_years',
                            'doughnutlabels',
                            'doughnutdata',
                            'revenue_years',
                            'revenuelabels',
                            'revenuedata',
                            'transaction',
                            'getorders',
                            'topitems',
                            'getorderdetailscount',
                            'topusers',
                        )
                    );
                } else {
                    return view('admin.dashboard.access_denied');
                }
            } else {

                return view(
                    'admin.dashboard.index',
                    compact(
                        'totalvendors',
                        'totalplans',
                        'totalorders',
                        'totalrevenue',
                        'currentplanname',
                        'doughnut_years',
                        'doughnutlabels',
                        'doughnutdata',
                        'revenue_years',
                        'revenuelabels',
                        'revenuedata',
                        'transaction',
                        'getorders',
                        'topitems',
                        'getorderdetailscount',
                        'topusers'
                    )
                );
            }
        }
    }
    public function login()
    {
        if(!file_exists(storage_path() . "/installed")) {
            return redirect('install');
            exit;
        }
        Helper::language(1);
        return view('admin.auth.login');
    }
    public function check_admin_login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' =>  trans('messages.invalid_email'),
            'password.required' => trans('messages.password_required'),
        ]);
        session()->put('admin_login', 1);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type' => [1,2,4], 'is_deleted' => 2])) {
            if (!Auth::user()) {
                return Redirect::to('/admin/verify')->with('error', Session::get('from_message'));
            }
            if (Auth::user()->type == 1) {
                return redirect('/admin/dashboard');
            } else {
                if (Auth::user()->type == 2 && Auth::user()->is_deleted == 2) {
                    if (Auth::user()->is_available == 1 && Auth::user()->is_deleted == 2) {
                        return redirect('/admin/dashboard');
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', trans('messages.block'));
                    }
                } elseif (Auth::user()->type == 4 && Auth::user()->is_deleted == 2) {
                    if (Auth::user()->is_available == 1 && Auth::user()->is_deleted == 2) {
                        return redirect('/admin/dashboard');
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', trans('messages.block'));
                    }
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', trans('messages.email_pass_invalid'));
                }
            }
        } else {
            return redirect()->back()->with('error', trans('messages.email_password_not_match'));
        }
    }
    public function logout()
    {
        session()->flush();
        Auth::logout();
        if (helper::appdata('')->landing_page == 2) {
            return redirect('/');
        } else {
            return redirect('admin');
        }
    }
    public function systemverification(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6InFZNGJTNmxHZ20xTVZrTTJkcmxqV3c9PSIsInZhbHVlIjoiMjFyVHVxa2FTNkY0b3Rhc2NmM3JsUTVOdkF4eURua1NVZ1VsYjkyNUtoYkJQb1RwbFZaQUpmWXBtTEQvaVpRWSIsIm1hYyI6ImQ1MGNiM2U0NTFmYTQwYTQ0OGVmN2NlZGU4Mjg1NmM2NDAyODFiYmQwZWZiOGY1NTNmYjY0ZjhkZmJhMGU4Y2UiLCJ0YWciOiIifQ=='), [
            'form_params' => [
                \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6IlpsL3NGWGM0dFlIQkpzbkRsQ2QxcGc9PSIsInZhbHVlIjoiY0hyZUlrU3BSNXMvMlFObTgzcUVuRlJybmdobUdoQnRsNG02a3NsVnlFMD0iLCJtYWMiOiI3Njc0MjNiMjdlZWE3Y2IyM2UwNDMwYWRkODI1YTEwNjM2MWEzODkzOTcyMTdlOGE3MmRkM2U4YzUwNGU3YmU4IiwidGFnIjoiIn0=') => $request->username,
                \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6Imp4TDErbjlVN3M4bXlpbW9YWVdET2c9PSIsInZhbHVlIjoiVWkrUEpFa05UQk5NdHBzUGpxUnd3Zz09IiwibWFjIjoiM2JhODk2ZTI0YjgwZDNkNDljNGM5NGRjYzg1NjhkZTQyZWU2MjJkODhlY2ZjNThiZWZhMzk5ZmZhNDk5ODZhYiIsInRhZyI6IiJ9') => $request->email,
                \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6IlRKbVloU3VWWEtRa2creCtlR0hvSnc9PSIsInZhbHVlIjoiVXJmVWlqd2ZCblNrakhjaFg2OE9wMmtnRy80L0R2K2VFak1ITXZFQ0dhVT0iLCJtYWMiOiI0YmMzMjVmZmE4NzNhZjM2NjM1YjIzMjNhMDNjZDVhYzBlMzNiYzdhNjU5ZWE3ZTZlYjY2N2QxODAzZDQyZjRkIiwidGFnIjoiIn0=') => $request->purchase_key,
                \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6IkRFcWJFaUJTak9IYkxrc2h2Vk1MOHc9PSIsInZhbHVlIjoiSjAvekdON2dNa1BLRWpveFc3REtSdz09IiwibWFjIjoiNjUyOTIyZTg1NGI2OGVhZDFmNWJjZDlmY2NlNDk0YTQ1YmVmNjQxMGI4OGNmNzcyMWI0ZmNhM2Q0YTM0MDhlYSIsInRhZyI6IiJ9') => $request->domain,
                \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6IjNiWXRCR2xPb3RXOCtsVVVqY21MaXc9PSIsInZhbHVlIjoiUmJ2U1pIN29ENG82bWR5ejZMV1ZWR3dqR3hQc0F0dWhqUFQ3SGV5aGxDcz0iLCJtYWMiOiI0NjM2OGRjZTY1MGY4Zjk1MmE4ZWJlOTY1ODk0M2Y2NjkxNWM3MmQxOTlmNjJiNDk3YjllMDkxOTUzNDI5MjM4IiwidGFnIjoiIn0=') => \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6IlZKenErbG4yT3NvR1dDTkZSNWpjcmc9PSIsInZhbHVlIjoiMHRCS3lYNzk1bXhTZWVkS1dqQzBuUT09IiwibWFjIjoiZTE1ZWY1NTE0NTY0NjgyNWE1YmQ2N2EyMmIwOGNkZDg5ZWY2OTYwYTdhNWE4YmE0MjViMGYyMzI3NGIwMTgxYyIsInRhZyI6IiJ9'),
                \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6InZpeDJtOTZZc3ZNSm5BRDJJNkNFdlE9PSIsInZhbHVlIjoiMTR3a2NoMHFFcHlGR0w2NGNCNTdBdz09IiwibWFjIjoiZmY3OTUzYzA3NDhkZWJjMDA4YjQ1MTRlYjUzMGI0YjYzNGE3YmMwODhkM2VlNjhlMTkwYTY0NGI3ZjUzMWIzMyIsInRhZyI6IiJ9') => \Illuminate\Support\Facades\Crypt::decrypt('eyJpdiI6Inh6aHJZaGxyWUhkbVhBc2IvdEwwWUE9PSIsInZhbHVlIjoicGN5a1B6Y0pHV3IzNXN1ZGcxYWd5QT09IiwibWFjIjoiMjY1OTRlY2Q2YmM4YzRlMjVkMDliYTRhZjMyYTliZDcyNDZiODhjNjg5NDEzNTBhNjFkZGIyZDUwZTFkOTVmNCIsInRhZyI6IiJ9'),
            ]
        ]);

        $obj = json_decode($res->getBody());
        if ($obj->status == '1') {
            User::where('id', 1)->update(['license_type' => $obj->license_type]);
            return Redirect::to('/admin')->with('success', 'You have successfully verified your License. Please try to Login now');
        } else {
            return Redirect::back()->with('error', $obj->message);
        }
    }

    public function sessionsave(Request $request)
    {
        session()->put('demo', $request->demo_type);

        return response()->json(['status' => 1,'msg' => trans('messages.success')], 200);
    }
}

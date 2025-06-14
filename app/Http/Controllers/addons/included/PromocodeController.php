<?php

namespace App\Http\Controllers\addons\included;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Promocode;
use App\Models\Transaction;
use App\helper\helper;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PromocodeController extends Controller
{
    public function index()

    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getpromocodeslist = Promocode::where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        return view('admin.included.promocode.index', compact('getpromocodeslist'));
    }

    public function add()
    {
        return view('admin.included.promocode.add');
    }

    public function save(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $request->validate([

            'offer_name' => 'required',

            'offer_type' => 'required',

            'usage_type' => 'required',

            'usage_limit' => 'required_if:usage_type,1',

            'offer_code' => 'required',

            'start_date' => 'required',

            'end_date' => 'required',

            'amount' => 'required',

            'order_amount' => 'required',

            'description' => 'required',

        ], [

            'offer_name.required' => trans('messages.offer_name_required'),

            'offer_type.required' => trans('messages.offer_type_required'),

            'usage_type.required' =>  trans('messages.usage_type_required'),

            'usage_limit.required_if' => trans('messages.usage_limit_required'),

            'offer_code.required' => trans('messages.offer_code_required'),

            'start_date.required' => trans('messages.start_date.required'),

            'end_date.required' => trans('messages.end_date_required'),

            'amount.required' => trans('messages.amount_required'),

            'order_amount.required' =>  trans('messages.min_amount_required'),

            'description.required' =>  trans('messages.description_required')

        ]);

        $promocode = new Promocode();

        $promocode->vendor_id = $vendor_id;

        $promocode->offer_name = $request->offer_name;

        $promocode->offer_type = $request->offer_type;

        $promocode->usage_type = $request->usage_type;

        if ($request->usage_type == 1) {

            $promocode->usage_limit = $request->usage_limit;
        }

        if ($request->usage_type == 2) {

            $promocode->usage_limit = 0;
        }

        $promocode->offer_code = $request->offer_code;

        $promocode->start_date = $request->start_date;

        $promocode->exp_date = $request->end_date;

        $promocode->offer_amount = $request->amount;

        $promocode->min_amount = $request->order_amount;

        $promocode->description = $request->description;

        $promocode->save();

        return redirect('admin/promocode')->with('success', trans(('messages.success')));
    }

    public function edit($id)

    {

        $promocode = Promocode::where('id', $id)->first();

        return view('admin.included.promocode.edit', compact('promocode'));
    }

    public function update(Request $request, $id)

    {

        $request->validate([

            'offer_name' => 'required',

            'offer_type' => 'required',

            'usage_type' => 'required',

            'usage_limit' => 'required_if:usage_type,1',

            'offer_code' => 'required',

            'start_date' => 'required',

            'end_date' => 'required',

            'amount' => 'required',

            'order_amount' => 'required',

            'description' => 'required',

        ], [

            'offer_name.required' => trans('messages.offer_name_required'),

            'offer_type.required' => trans('messages.offer_type_required'),

            'usage_type.required' =>  trans('messages.usage_type_required'),

            'usage_limit.required_if' => trans('messages.usage_limit_required'),

            'offer_code.required' => trans('messages.offer_code_required'),

            'start_date.required' => trans('messages.start_date.required'),

            'end_date.required' => trans('messages.end_date_required'),

            'amount.required' => trans('messages.amount_required'),

            'order_amount.required' =>  trans('messages.min_amount_required'),

            'description.required' =>  trans('messages.description_required')

        ]);

        $editpromocode = Promocode::where('id', $id)->first();

        $editpromocode->offer_name = $request->offer_name;

        $editpromocode->offer_type = $request->offer_type;

        $editpromocode->usage_type = $request->usage_type;

        $editpromocode->usage_limit = $request->usage_limit;

        $editpromocode->offer_code = $request->offer_code;

        $editpromocode->start_date = $request->start_date;

        $editpromocode->exp_date = $request->end_date;

        $editpromocode->offer_amount = $request->amount;

        $editpromocode->min_amount = $request->order_amount;

        $editpromocode->description = $request->description;

        $editpromocode->update();

        return redirect('admin/promocode')->with('success', trans(('messages.success')));
    }

    public function status($id, $status)

    {

        Promocode::where('id', $id)->update(['is_available' => $status]);

        return redirect('admin/promocode')->with('success', trans('messages.success'));
    }

    public function delete($id)
    {
        try {

            Promocode::where('id', $id)->delete();

            return redirect('admin/promocode')->with('success', trans('messages.success'));
        } catch (\Exception $th) {

            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function vendorapplypromocode(Request $request)
    {
        date_default_timezone_set(helper::appdata('')->timezone);

        $checkoffercode = Promocode::where('offer_code', $request->promocode)->where('vendor_id', 1)->where('is_available', 1)->first();
        if (!empty($checkoffercode)) {
            if ((date('Y-m-d') >= $checkoffercode->start_date) && (date('Y-m-d') <= $checkoffercode->exp_date)) {
                if ($request->sub_total >= $checkoffercode->min_amount) {
                    if ($checkoffercode->usage_type == 1) {
                        if (Auth::user() && (Auth::user()->type == 2 || Auth::user()->type == 4)) {
                            $checkcount = Transaction::select('offer_code')->where('offer_code', $request->promocode)->count();
                        }
                        if ($checkcount >= $checkoffercode->usage_limit) {
                            return response()->json(['status' => 0, 'message' => trans('messages.usage_limit_exceeded')], 200);
                        }
                    }
                    $offer_amount = $checkoffercode->offer_amount;
                    if ($checkoffercode->offer_type == 2) {
                        $offer_amount = $request->sub_total * $checkoffercode->offer_amount / 100;
                    }
                    $arr = array(
                        "offer_code" => $checkoffercode->offer_code,
                        "offer_amount" => $offer_amount,
                        'offer_type' => @$checkoffercode->usage_type,
                    );
                    session()->put('discount_data', $arr);
                    return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.order_amount_greater_then') . ' ' . helper::currency_formate($checkoffercode->min_amount, '')], 200);
                }
            } else {
                return response()->json(['status' => 0, 'message' => trans('messages.invalid_promocode')], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_promocode')], 200);
        }
    }
    public function removepromocode()
    {
        if (session()->has('discount_data')) {
            session()->forget('discount_data');
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        }
        abort(404);
    }

    // api----------------------------------
    public function promocode(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $date = date('Y-m-d');
        $promocodelist = Promocode::where("vendor_id", $request->vendor_id)->where("start_date", '<=', $date)->where("exp_date", '>=', $date)->where('is_available', '1')->get();
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'promocodes' => $promocodelist], 200);
    }
    public function applypromocode(Request $request)
    {

        $user_id = "";
        if ($request->user_id != "") {
            $user_id = $request->user_id;
        }
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 400);
        }
        if ($request->subtotal == "") {
            return response()->json(["status" => 0, "message" => trans('messages.subtotal_required')], 400);
        }
        if ($request->offer_code == "") {
            return response()->json(["status" => 0, "message" => trans('messages.promocode_required')], 400);
        }
        date_default_timezone_set(helper::appdata($request->vendor_id)->timezone);
        $checkoffercode = Promocode::where('offer_code', $request->offer_code)->where('vendor_id', $request->vendor_id)->where('is_available', 1)->first();

        if (!empty($checkoffercode)) {
            if ((date('Y-m-d') >= $checkoffercode->start_date) && (date('Y-m-d') <= $checkoffercode->exp_date)) {

                if ($request->subtotal >= $checkoffercode->min_amount) {
                    if ($checkoffercode->usage_type == 1) {
                        if ($user_id != "") {
                            $checkcount = Order::select('offer_code')->where('offer_code', $request->offer_code)->where('vendor_id', $request->vendor_id)->where('user_id', $user_id)->count();
                        } else {
                            $checkcount = Order::select('offer_code')->where('offer_code', $request->offer_code)->where('vendor_id', $request->vendor_id)->where('session_id', $request->session_id)->count();
                        }
                        if ($checkcount >= $checkoffercode->usage_limit) {
                            return response()->json(["status" => 0, "message" => trans('messages.usage_limit_exceeded')], 400);
                        }
                    }
                    $offer_amount = $checkoffercode->offer_amount;
                    if ($checkoffercode->offer_type == 2) {
                        $offer_amount = $request->subtotal * $checkoffercode->offer_amount / 100;
                    }
                    $arr = array(
                        "offer_code" => $checkoffercode->offer_code,
                        "offer_amount" => $offer_amount,
                        "vendor_id" => $request->vendor_id,
                    );
                    session()->put('discount_data', $arr);
                    return response()->json(["status" => 1, "message" => trans('messages.success'), 'data' => $arr], 200);
                } else {
                    return response()->json(["status" => 0, "message" => trans('messages.order_amount_greater_then') . ' ' . helper::currency_formate($checkoffercode->min_amount, $request->vendor_id)], 200);
                }
            } else {
                return response()->json(["status" => 0, "message" => trans('messages.invalid_promocode')], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => trans('messages.invalid_promocode')], 200);
        }
    }
    public function reorder_coupon(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getpromocodeslist = Promocode::where('vendor_id', $vendor_id)->get();
        foreach ($getpromocodeslist as $coupon) {
            foreach ($request->order as $order) {
                $coupon = Promocode::where('id', $order['id'])->first();
                $coupon->reorder_id = $order['position'];
                $coupon->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}

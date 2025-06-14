<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shippingarea;
use Illuminate\Support\Facades\Auth;
class ShippingareaController extends Controller
{
    public function index(){
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $getshippingarealist = Shippingarea::where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        return view('admin.shippingarea.index',compact('getshippingarealist'));
    }
    public function add(){
        return view('admin.shippingarea.add');
    }
    public function show(Request $request){
        $shippingareadata = Shippingarea::find($request->id);
        return view('admin.shippingarea.show',compact('shippingareadata'));
    }
    public function store(Request $request){
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $request->validate([
            'name' => 'required',
            'delivery_charge' => 'required',
        ],[
            'name.required' => trans('messages.name_required'),
            'delivery_charge.required' => trans('messages.delivery_charge_required'),
        ]);
        $shippingarea = Shippingarea::find($request->id);
        if(empty($shippingarea)){
            $shippingarea = new Shippingarea();
            $shippingarea->vendor_id =$vendor_id;
        }
        $shippingarea->name = $request->name;
        $shippingarea->delivery_charge = $request->delivery_charge;
        $shippingarea->is_available = 1;
        $shippingarea->save();
        return redirect('/admin/shipping-area')->with('success',trans('messages.success'));
    }
    public function delete(Request $request){
        try {
            $shippingareadata = Shippingarea::find($request->id);
            $shippingareadata->delete();
            return redirect('/admin/shipping-area')->with('success',trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',trans('messages.wrong'));
        }
    }
    public function status(Request $request){
        try {
            $shippingareadata = Shippingarea::find($request->id);
            $shippingareadata->is_available = $request->status;
            $shippingareadata->save();
            return redirect('/admin/shipping-area')->with('success',trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',trans('messages.wrong'));
        }
    }
    public function reorder_shipping_area(Request $request){
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $howworks = Shippingarea::where('vendor_id', $vendor_id)->get();
        foreach ($howworks as $works) {
            foreach ($request->order as $order) {
                $works = Shippingarea::where('id', $order['id'])->first();
                $works->reorder_id = $order['position'];
                $works->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}
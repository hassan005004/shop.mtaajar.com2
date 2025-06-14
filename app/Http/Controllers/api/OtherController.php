<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
class OtherController extends Controller
{
    public function getcontent()
    {
        $id = User::where('type', 1)->first();
        $privecypolicy = Settings::select('privacy_content')->where('vendor_id', $id->id)->first();
        $termscondition = Settings::select('terms_content')->where('vendor_id', $id->id)->first();
        $aboutus = Settings::select('about_content')->where('vendor_id', $id->id)->first();
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'privecypolicy' => $privecypolicy->privacy_content, 'termscondition' => $termscondition->terms_content, 'aboutus' => $aboutus->about_content], 200);
    }
    public function inquiries(Request $request)
    {
        if($request->name == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.name_required')],400);
        }
        if($request->email == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        if($request->mobile == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.email_required')],400);
        }
        if($request->message == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.message_required')],400);
        }
        $newcontact = new Contact();
        $newcontact->vendor_id = 1;
        $newcontact->name = $request->name;
        $newcontact->email = $request->email;
        $newcontact->mobile = $request->mobile;
        $newcontact->message = $request->message;
        $newcontact->save();
        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    }
    public function payment_status(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],200);
        }
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_number_required')],200);
        }
        if($request->payment_status == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.payment_status_required')],200);
        }
        $order = Order::where('order_number', $request->order_number)->where('vendor_id', $request->vendor_id)->first();
        $order->payment_status = $request->payment_status;
        $order->update();
        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    }
    public function customerinfo(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],200);
        }
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_number_required')],200);
        }
        if($request->edit_type == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.edit_type_required')],200);
        }
        $customerinfo = Order::where('order_number', $request->order_number)->where('vendor_id', $request->vendor_id)->first();
        if ($request->edit_type == "customer_info") {
            $customerinfo->user_name = $request->customer_name;
            $customerinfo->user_mobile = $request->mobile;
            $customerinfo->user_email = $request->email;
        }
        if ($request->edit_type == "delivery_info") {
            $customerinfo->shipping_address = $request->shipping_address;
            $customerinfo->shipping_landmark = $request->shipping_landmark;
            $customerinfo->shipping_postal_code = $request->shipping_postal_code;
            $customerinfo->shipping_city = $request->shipping_city;
            $customerinfo->shipping_state = $request->shipping_state;
            $customerinfo->shipping_country = $request->shipping_country;
        }
        $customerinfo->update();
        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    }
    public function vendor_note(Request $request)
    {
        if($request->vendor_id == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.vendor_id_required')],200);
        }
        if($request->order_number == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.order_number_required')],200);
        }
        if($request->note == ""){
            return response()->json(["status"=>0,"message"=>trans('messages.note_required')],200);
        }
        $updatenote = Order::where('order_number', $request->order_number)->where('vendor_id', $request->vendor_id)->first();
        $updatenote->vendor_note = $request->note;
        $updatenote->update();
        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    }
}

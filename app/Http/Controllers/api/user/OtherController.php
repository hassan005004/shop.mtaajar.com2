<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Contact;
use App\Models\Gallery;
use App\helper\helper;
class OtherController extends Controller
{
    public function cmspages(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $cmspages = Settings::select('privacy_content','terms_content','about_content')->where('vendor_id', $request->vendor_id)->first();
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'privecypolicy' => $cmspages->privacy_content, 'termscondition' => $cmspages->terms_content, 'aboutus' => $cmspages->about_content], 200);
    }
    public function contact(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => trans('messages.name_required')], 200);
        }
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => trans('messages.email_required')], 200);
        }
        if ($request->mobile == "") {
            return response()->json(["status" => 0, "message" => trans('messages.mobile_required')], 200);
        }
        if ($request->message == "") {
            return response()->json(["status" => 0, "message" => trans('messages.message_required')], 200);
        }
        $contact = new Contact();
        $contact->vendor_id = $request->vendor_id;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->message= $request->message;
        $contact->save();
        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
    }
    public function contact_detail(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $vendor_info = Settings::select('address','contact','email')->where('vendor_id',$request->vendor_id)->first();
        return response()->json(["status" => 1, "message" => trans('messages.success'),'vendor_info' =>$vendor_info], 200);
    }

    public function gallery(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.vendor_id_required')], 200);
        }
        $gallery = Gallery::where('vendor_id',$request->vendor_id)->get();

        foreach ($gallery as $img) {
            $data = array(
                "image" => helper::image_path($img->image),
            );

            $imagelist[] = $data;
        }
        return response()->json(["status" => 1, "message" => trans('messages.success'),'imagelist' =>$imagelist], 200);
    }
}

<?php

namespace App\Http\Controllers\addons\included;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class WhatsappController extends Controller
{
    public function whatsappmessage(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $request->validate([
            'whatsapp_message' => 'required',
            'whatsapp_number' => 'required',
            'item_message' => 'required',
        ], [
            'whatsapp_message.required' => trans('messages.whatsapp_message_required'),
            'whatsapp_number.required' => trans('messages.contact_required'),
            'item_message.required' => trans('messages.item_message_required'),
        ]);
        $settingsdata = Settings::where('vendor_id',  $vendor_id)->first();
        $settingsdata->whatsapp_message = $request->whatsapp_message;
        $settingsdata->whatsapp_number = $request->whatsapp_number;
        $settingsdata->item_message = $request->item_message;
        $settingsdata->whatsapp_on_off =  isset($request->whatsapp_on_off) ? 1 : 2;
        $settingsdata->whatsapp_chat_on_off =  isset($request->whatsapp_chat_on_off) ? 1 : 2;
        $settingsdata->whatsapp_chat_position = $request->whatsapp_chat_position;
        $settingsdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}

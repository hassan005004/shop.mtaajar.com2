<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $features = Features::where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        return view('admin.features.index', compact('features'));
    }
    public function add()
    {
        return view('admin.features.add');
    }
    public function save(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ], [
            'title.required' => trans('messages.title_required'),
            'description.required' => trans('messages.description_required'),
            'image.required' => trans('messages.image_required'),
        ]);
        $features = new Features();
        $features->vendor_id = $vendor_id;
        $features->title = $request->title;
        $features->description = $request->description;
        if ($request->has('image')) {
            $featureimage = 'feature-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/feature/'), $featureimage);
            $features->image = $featureimage;
        }
        $features->save();
        return redirect('admin/features')->with('success', trans('messages.success'));
    }
    public function edit(Request $request)
    {
        $editfeature = Features::where('id', $request->id)->first();
        return view('admin.features.edit', compact('editfeature'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image',
        ], [
            'title.required' => trans('messages.title_required'),
            'description.required' => trans('messages.description_required'),
        ]);
        $editfeature = Features::where('id', $request->id)->first();
        $editfeature->title = $request->title;
        $editfeature->description = $request->description;
        if ($request->has('image')) {
            if (file_exists(storage_path('app/public/admin-assets/images/feature/' . $editfeature->image))) {
                unlink(storage_path('app/public/admin-assets/images/feature/' . $editfeature->image));
            }
            $featureimage = 'feature-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/feature/'), $featureimage);
            $editfeature->image = $featureimage;
        }
        $editfeature->update();
        return redirect('admin/features')->with('success', trans('messages.success'));
    }
    public function delete(Request $request)
    {
        $feature = Features::where('id', $request->id)->first();
        if (file_exists(storage_path('app/public/admin-assets/images/feature/' . $feature->image))) {
            unlink(storage_path('app/public/admin-assets/images/feature/' . $feature->image));
        }
        $feature->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function reorder_features(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getfeatures = Features::where('vendor_id', $vendor_id)->get();
        foreach ($getfeatures as $features) {
            foreach ($request->order as $order) {
                $features = Features::where('id', $order['id'])->first();
                $features->reorder_id = $order['position'];
                $features->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}

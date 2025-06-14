<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Promotionalbanner;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getbannerlist = Banner::orderBy('reorder_id')->where('vendor_id', $vendor_id)->get();
        return view('admin.banner.banner', compact('getbannerlist'));
    }
    public function add()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getcategorylist = Category::where('is_deleted', "2")->where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        $getproductslist = Products::where('is_deleted', "2")->where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        return view('admin.banner.add', compact('getcategorylist', 'getproductslist'));
    }
    public function edit($id)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getcategorylist = Category::where('is_deleted', "2")->where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        $getproductslist = Products::where('is_deleted', "2")->where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        $getbannerdata = Banner::where('id', $id)->first();
        return view('admin.banner.edit', compact('getcategorylist', 'getproductslist', 'getbannerdata'));
    }
    public function save_banner(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $request->validate([
            'category' => 'required_if:banner_info,1',
            'product' => 'required_if:banner_info,2',
            'image' => 'required|image',
        ], [
            'category.required_if' => trans('messages.category_required'),
            'product.required_if' => trans('messages.product_required'),
            'image.required' => trans('messages.image_required'),
        ]);
        $image = 'banner-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(storage_path('app/public/admin-assets/images/banners/'), $image);
        $banner = new Banner();
        $banner->vendor_id = $vendor_id;
        $banner->category_id = $request->banner_info == 1 ? $request->category : 0;
        $banner->product_id = $request->banner_info == 2 ? $request->product : 0;
        $banner->custom_link = $request->banner_info == 3 ? $request->custom_link : "";
        $banner->type = $request->banner_info;
        $banner->section = $request->section;
        if ($request->section == 0) {
            $banner->title = $request->banner_title;
            $banner->sub_title = $request->banner_subtitle;
            $banner->description = $request->banner_description;
            $banner->link_text = $request->banner_link_text;
        }
        $banner->image = $image;
        $banner->save();
        if ($request->section == 0) {
            return redirect('admin/sliders')->with('success', trans('messages.success'));
        }
        return redirect('admin/bannersection-' . $request->section)->with('success', trans('messages.success'));
    }
    public function edit_banner(Request $request, $id)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $request->validate([
            'category' => 'required_if:banner_info,1',
            'product' => 'required_if:banner_info,2',
            'image' => 'image',
        ], [
            'category.required_if' => trans('messages.category_required'),
            'product.required_if' => trans('messages.product_required'),
        ]);
        $banner = Banner::where('id', $id)->first();
        $banner->vendor_id = $vendor_id;
        if ($request->banner_info == "1") {
            $banner->category_id = $request->category;
            $banner->product_id = 0;
            $banner->custom_link = "";
        }
        if ($request->banner_info == "2") {
            $banner->product_id = $request->product;
            $banner->category_id = 0;
            $banner->custom_link = "";
        }
        if ($request->banner_info == "3") {
            $banner->product_id = 0;
            $banner->category_id = 0;
            $banner->custom_link = $request->custom_link;
        }
        $banner->type = $request->banner_info;
        $banner->section = $request->section;
        if ($request->section == 0) {
            $banner->title = $request->banner_title;
            $banner->sub_title = $request->banner_subtitle;
            $banner->description = $request->banner_description;
            $banner->link_text = $request->banner_link_text;
        }
        if ($request->has('image')) {
            if (file_exists(storage_path('app/public/admin-assets/images/banners/' . $banner->image))) {
                unlink(storage_path('app/public/admin-assets/images/banners/' . $banner->image));
            }
            $image = 'banner-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/banners/'), $image);
            $banner->image = $image;
        }
        $banner->update();
        if ($request->section == 0) {
            return redirect('admin/sliders')->with('success', trans('messages.success'));
        }
        return redirect('admin/bannersection-' . $request->section)->with('success', trans('messages.success'));
    }
    public function status_update($id, $status)
    {
        Banner::where('id', $id)->update(['is_available' => $status]);
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete($id)
    {
        $banner = Banner::where('id', $id)->first();
        if (file_exists(storage_path('app/public/admin-assets/images/banners/' . $banner->image))) {
            unlink(storage_path('app/public/admin-assets/images/banners/' . $banner->image));
        }
        $banner->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }



    public function promotional_banner()
    {
        $getbannerlist = Promotionalbanner::with('vendor_info')->orderBy('reorder_id')->get();
        return view('admin.promotionalbanners.index', compact('getbannerlist'));
    }
    public function promotional_banneradd()
    {
        $vendors = User::where('is_available', 1)->where('is_verified', 1)->where('is_deleted', 2)->where('type', 2)->get();
        return view('admin.promotionalbanners.add', compact('vendors'));
    }
    public function promotional_bannersave_banner(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ], [
            'image.required' => trans('messages.image_required'),
        ]);
        $banner = new Promotionalbanner();
        if ($request->has('image')) {
            $image = 'promotion-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/banners/'), $image);
            $banner->image = $image;
        }
        $banner->vendor_id = $request->vendor;
        $banner->save();
        return redirect('admin/promotionalbanners')->with('success', trans('messages.success'));
    }
    public function promotional_banneredit(Request $request)
    {
        $vendors = User::where('is_available', 1)->where('is_verified', 1)->where('is_deleted', 2)->where('type', 2)->get();
        $banner = Promotionalbanner::where('id', $request->id)->first();
        return view('admin.promotionalbanners.edit', compact('vendors', 'banner'));
    }
    public function promotional_bannerupdate(Request $request)
    {
        $banner = Promotionalbanner::where('id', $request->id)->first();
        if ($request->has('image')) {
            if (file_exists(storage_path('app/public/admin-assets/images/banners/' . $banner->image))) {
                unlink(storage_path('app/public/admin-assets/images/banners/' . $banner->image));
            }
            $image = 'promotion-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/public/admin-assets/images/banners/'), $image);
            $banner->image = $image;
        }
        $banner->vendor_id = $request->vendor;
        $banner->update();
        return redirect('admin/promotionalbanners')->with('success', trans('messages.success'));
    }
    public function promotional_bannerdelete(Request $request)
    {
        $banner = Promotionalbanner::where('id', $request->id)->first();
        if (file_exists(storage_path('app/public/admin-assets/images/banners/' . $banner->image))) {
            unlink(storage_path('app/public/admin-assets/images/banners/' . $banner->image));
        }
        $banner->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function reorder_promotionalbanner(Request $request)
    {
        $getbanner = Promotionalbanner::with('vendor_info')->get();
        foreach ($getbanner as $banner) {
            foreach ($request->order as $order) {
                $banner = Promotionalbanner::where('id', $order['id'])->first();
                $banner->reorder_id = $order['position'];
                $banner->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
    public function reorder_banner(Request $request)
    {
        $getbanner = Banner::get();
        foreach ($getbanner as $banner) {
            foreach ($request->order as $order) {
                $banner = Banner::where('id', $order['id'])->first();
                $banner->reorder_id = $order['position'];
                $banner->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}

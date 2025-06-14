<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Products;

use App\Models\SubCategory;
use App\Models\Banner;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class CategoryController extends Controller

{

    public function index(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $allcategories = Category::select()->where('vendor_id', $vendor_id )->where('is_deleted',"2")->orderBy('reorder_id')->get();

        return view('admin.category.category', compact("allcategories"));

    }

    public function add_category(Request $request)

    {

        return view('admin.category.add_category');

    }

    public function save_category(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $request->validate([

            'category_name' => 'required',

            'category_image' => 'required',

        ], [

            'category_name.required' => trans('messages.name_required'),

            'category_image.required' => trans('messages.image_required'),

        ]);

        $check_slug = Category::where('slug', Str::slug($request->category_name, '-'))->first();

        if (!empty($check_slug)) {

            $last_id = Category::select('id')->orderByDesc('id')->first();

            $slug = Str::slug($request->category_name . ' ' . $last_id->id, '-');

        } else {

            $slug = Str::slug($request->category_name, '-');

        }

        $savecategory = new Category();

        $savecategory->vendor_id = $vendor_id;

        $savecategory->name = $request->category_name;

        $savecategory->slug = $slug;

        if ($request->has('category_image')) {

            $image = 'category-' . uniqid() . "." . $request->file('category_image')->getClientOriginalExtension();

            $request->file('category_image')->move(storage_path('app/public/admin-assets/images/categories/'), $image);

            $savecategory->image = $image;

        }

        $savecategory->save();

        return redirect('admin/categories/')->with('success', trans('messages.success'));

    }

    public function edit_category(Request $request)

    {

        $editcategory = category::where('slug', $request->slug)->first();

        return view('admin.category.edit_category',compact("editcategory"));

    }

    public function update_category(Request $request)

    {
        $editcategory = Category::where('slug',$request->slug)->first();

         $request->validate([

            'category_name' => 'required',

            'category_image' => 'image',

        ], [

            'category_name.required' => trans('messages.name_required'),

            'category_image.required' => trans('messages.image_required'),

        ]);

        $editcategory->name = $request->category_name;

        if ($request->has('category_image')) {

            if (file_exists(storage_path('app/public/admin-assets/images/categories/' . $editcategory->image))) {

                unlink(storage_path('app/public/admin-assets/images/categories/' .  $editcategory->image));

            }

            $edit_image = $request->file('category_image');

            $profileImage = 'category-' . uniqid() . "." . $edit_image->getClientOriginalExtension();

            $edit_image->move(storage_path('app/public/admin-assets/images/categories/'), $profileImage);

            $editcategory->image = $profileImage;

        }

        $editcategory->update();

        return redirect('admin/categories')->with('success', trans('messages.success'));

    }

    public function change_status(Request $request)

    {

      Category::where('slug',$request->slug)->update(['is_available'=>$request->status]);

      return redirect('admin/categories')->with('success',trans('messages.success'));

    }

    public function delete_category(Request $request)

    {

try {
    if(Auth::user()->type == 4)
    {
        $vendor_id = Auth::user()->vendor_id;
    }else{
        $vendor_id = Auth::user()->id;
    }
    $checkcategory = Category::where('slug', $request->slug)->where('vendor_id',$vendor_id)->first();
   
    $getsubcategory = SubCategory::where('category_id',$checkcategory->id)->where('vendor_id',$vendor_id)->get();
    $getproduct = Products::where('category_id',$checkcategory->id)->where('vendor_id',$vendor_id)->get();
   
    $getbanner = Banner::where('category_id',$checkcategory->id)->where('vendor_id',$vendor_id)->get();
    foreach($getproduct as $product)
    {
        $product->category_id = '';
        $product->update();
       
    }
    foreach($getsubcategory as $subcategory)
    {
        $subcategory->category_id = "";
        $subcategory->update();
    }
    foreach($getbanner as $banner)
    {
        $banner->type="";
        $banner->category_id="";
        $banner->update();
    }
    $checkcategory->delete();
    return redirect('admin/categories')->with('success', trans('messages.success'));
} catch (\Throwable $th) {
  
    return redirect()->back()->with('error',trans('messages.wrong'));
}
    }

    public function reorder_category(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $getcategory = Category::where('vendor_id',$vendor_id )->get();

        foreach ($getcategory as $category) {

            foreach ($request->order as $order) {

               $category = Category::where('id',$order['id'])->first();

               $category->reorder_id = $order['position'];

               $category->save();

            }

        }

        return response()->json(['status' => 1,'msg' => trans('messages.success')], 200);

    }

}
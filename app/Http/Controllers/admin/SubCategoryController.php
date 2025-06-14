<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Products;

use App\Models\SubCategory;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class SubCategoryController extends Controller

{

    public function index(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $sub_categories = SubCategory::with('category_info')->where('vendor_id', $vendor_id)->where('is_deleted', 2)->orderBy('reorder_id')->get();

        return view('admin.sub_category.sub_category', compact('sub_categories'));

    }

    public function add(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $categories = Category::where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();

        return view('admin.sub_category.add', compact('categories'));

    }

    public function store(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $request->validate([

            'category' => 'required',

            'sub_category' => 'required'

        ],[

            'category.required' => trans('messages.category_required'),

            'sub_category.required' => trans('messages.sub_category_name'),

        ]);

        $check_slug = SubCategory::where('slug', Str::slug($request->sub_category, '-'))->first();

        if (!empty($check_slug)) {

            $last_id = SubCategory::select('id')->orderByDesc('id')->first();

            $slug = Str::slug($request->sub_category . ' ' . $last_id->id, '-');

        } else {

            $slug = Str::slug($request->sub_category, '-');

        }

        $sub_category = new SubCategory;

        $sub_category->vendor_id = $vendor_id ;

        $sub_category->category_id = $request->category;

        $sub_category->slug = $slug;

        $sub_category->name = $request->sub_category;

        $sub_category->save();

        return redirect('admin/sub-categories')->with('success', trans('messages.success'));

    }

    public function edit(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $categories = Category::where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();

        $sub_category = SubCategory::where('slug', $request->slug)->first();

        return view('admin.sub_category.edit', compact('categories','sub_category'));

    }

    public function update(Request $request)

    {

        $request->validate([

            'category' => 'required',

            'sub_category' => 'required'

        ],[

            'category.required' => trans('messages.category_required'),

            'sub_category.required' => trans('messages.sub_category_name'),

        ]);

        $sub_category = SubCategory::where('slug',$request->slug)->first();

        $sub_category->category_id = $request->category;

        $sub_category->name = $request->sub_category;

        $sub_category->save();

        return redirect('admin/sub-categories')->with('success', trans('messages.success'));

    }

    public function change_status(Request $request)

    {

        SubCategory::where('slug',$request->slug)->update(['is_available'=>$request->status]);

        return redirect()->back()->with('success', trans('messages.success'));

    }

    public function delete(Request $request)

    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $sub_category = SubCategory::where('slug',$request->slug)->where('vendor_id',$vendor_id)->first();
        $products = Products::where('sub_category_id')->where('vendor_id',$vendor_id)->get();
        foreach($products as $product)
        {
            $product->sub_category_id = '';
            $product->update();
           
        }
        $sub_category->delete();
        return redirect('admin/sub-categories')->with('success', trans('messages.success'));
    }

    public function subcategory_reorder(Request $request)

    {

        if(Auth::user()->type == 4)

        {

            $vendor_id = Auth::user()->vendor_id;

        }else{

            $vendor_id = Auth::user()->id;

        }

        $getcategory = SubCategory::where('vendor_id',$vendor_id )->get();

        foreach ($getcategory as $category) {

            foreach ($request->order as $order) {

               $category = SubCategory::where('id',$order['id'])->first();

               $category->reorder_id = $order['position'];

               $category->save();

            }

        }

        return response()->json(['status' => 1,'msg' => trans('messages.success')], 200);

    }

}


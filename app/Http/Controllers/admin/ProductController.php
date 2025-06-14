<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper\helper;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Variation;
use App\Models\Testimonials;
use App\Models\Cart;
use App\Models\Extra;
use App\Models\Banner;
use App\Models\Tax;
use App\Models\GlobalExtras;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index()
    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $getproductslist = Products::with('product_image', 'multi_variation', 'category_info')->where('vendor_id', $vendor_id)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        return view('admin.product.product', compact('getproductslist'));
    }
    public function add(Request $request)
    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $checkplan = helper::checkplan($vendor_id,'');
        $v = json_decode(json_encode($checkplan));
        if (@$v->original->status == 2) {
            return redirect('admin/products')->with('error', @$v->original->message);
        }
        $globalextras = GlobalExtras::where('vendor_id', $vendor_id)->where('is_available', 1)->orderBy('reorder_id')->get();
        $gettaxlist = Tax::where('vendor_id', $vendor_id)->where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $getcategorylist = Category::where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        return view('admin.product.add_product', compact("getcategorylist",'gettaxlist','globalextras'));
    }
    public function save(Request $request)
    {
        if ($request->has('product_image')) {
            $validator = Validator::make($request->all(), [
                'product_image.*' => 'image|max:' . helper::imagesize() . '|' . helper::imageext(),
            ], [
                'product_image.max' => trans('messages.image_size_message'),
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', trans('messages.image_size_message') . ' ' . helper::appdata('')->image_size . ' ' . 'MB');
            }
        }
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $checkplan = helper::checkplan($vendor_id,'');
        $v = json_decode(json_encode($checkplan));
        if (@$v->original->status == 2) {
            return redirect('admin/products')->with('error', @$v->original->message);
        }
       
        $check_slug = Products::where('slug', Str::slug($request->product_name, '-'))->first();
        if (!empty($check_slug)) {
            $last_id = Products::select('id')->orderByDesc('id')->first()->id;
            $slug = Str::slug($request->product_name . ' ' . $last_id, '-');
        } else {
            $slug = Str::slug($request->product_name, '-');
        }
      
        if ($request->has_variants == 1) {
            $variants_json = json_decode($request->hiddenVariantOptions, true);
            $variant_options = array_column($variants_json, 'variant_options');
          
            $possibilities = Products::possibleVariants($variant_options);
        
            foreach ($possibilities as $key => $possibility) {
                $price = $request->verians[$key]['price'];
                $qty = $request->verians[$key]['qty'];
                $original_price = $request->verians[$key]['original_price'];
                break;
            }
        } else {
            $price = $request->price;
            $original_price = $request->original_price;
            $qty = $request->qty;
        }
      
        $product = new Products();
        $product->vendor_id = $vendor_id;
        $product->category_id =  $request->category;
        $product->sub_category_id = $request->sub_category != null ? implode('|',$request->sub_category) : '';
        $product->name = $request->product_name;
        $product->slug = $slug;
        $product->price = $price;
        $product->original_price = $original_price;
        $product->sku = $request->product_sku;
        $product->qty = $qty;
        $product->low_qty = $request->low_qty;
        $product->has_variation = $request->has_variants;
        $product->has_extras = $request->has_extras;
        $product->tax = $request->tax != null ? implode('|', $request->tax) : '';
        $product->description = $request->description;
        $product->additional_info = $request->additional_info;
        $product->attchment_name = $request->attachment_name;
        $product->video_url = $request->video_url;
        $product->is_imported = 2;
        if ($request->has_variants == 1) {
            $product->variants_json = $request->hiddenVariantOptions;
        } else {
            $product->variants_json = "";
        }
        $product->stock_management = $request->has_stock;
        if ($request->has_stock == 1) {
            $product->qty = $qty;
            $product->min_order = $request->min_order;
            $product->max_order = $request->max_order;
            $product->low_qty = $request->low_qty;
        } else {
            $product->qty = "";
            $product->low_qty = "";
            $product->min_order = "";
            $product->max_order = "";
        }
        if ($request->has('attachment_file')) {
            $reimage = 'attachment-' . uniqid() . "." . $request->file('attachment_file')->getClientOriginalExtension();
            $request->file('attachment_file')->move(storage_path('app/public/admin-assets/images/product/'), $reimage);
            $product->attchment_file = $reimage;
        }
        if ($request->has('downloadfile')) {
            $reimage = 'download-' . uniqid() . "." . $request->file('downloadfile')->getClientOriginalExtension();
            $request->file('downloadfile')->move(storage_path('app/public/admin-assets/images/product/'), $reimage);
            $product->download_file = $reimage;
        }
        $product->save();
        if ($request->has('product_image')) {
            foreach ($request->file('product_image') as $file) {
                $reimage = 'product-' . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move(storage_path('app/public/admin-assets/images/product/'), $reimage);
                $image = new ProductImage();
                $image->product_id = $product->id;
                $image->image = $reimage;
                $image->save();
            }
        }

        if ($request->has_variants == 1) {
            $product->variants_json = json_decode($product->variants_json, true);
            $variant_options = array_column($product->variants_json, 'variant_options');
            $possibilities = Products::possibleVariants($variant_options);
            
            foreach ($possibilities as $key => $possibility) {
                $VariantOption = new Variation();
                $VariantOption->name = $possibility;
                $VariantOption->product_id = $product->id;
                $VariantOption->price =  array_key_exists('price', $request->verians[$key]) ? $request->verians[$key]['price'] : '';
                $VariantOption->qty = array_key_exists('qty', $request->verians[$key]) ? $request->verians[$key]['qty'] : '';
                $VariantOption->original_price = array_key_exists('original_price', $request->verians[$key]) ? $request->verians[$key]['original_price'] : '';
                $VariantOption->min_order =  array_key_exists('min_order', $request->verians[$key]) ? $request->verians[$key]['min_order'] : '';
                $VariantOption->max_order =  array_key_exists('max_order', $request->verians[$key]) ?  $request->verians[$key]['max_order'] : '';
                $VariantOption->low_qty =  array_key_exists('low_qty', $request->verians[$key]) ? $request->verians[$key]['low_qty'] : '';
                $VariantOption->stock_management = array_key_exists('stock_management', $request->verians[$key]) ? $request->verians[$key]['stock_management'] : 2;
                $VariantOption->is_available = array_key_exists('is_available', $request->verians[$key]) ? 1 : 2;
                $VariantOption->save();
            }
        }
        if($request->extras_name != null && $request->extras_name !="")
        {
            foreach ($request->extras_name as $key => $no) {
                if (@$no != "" && @$request->extras_price[$key] != "") {
                    $extras = new Extra();
                    $extras->product_id = $product->id;
                    $extras->name = $no;
                    $extras->price = $request->extras_price[$key];
                    $extras->save();
                }
            }
        }
      
        return redirect('admin/products/')->with('success', trans('messages.success'));
    }
    public function edit($slug)
    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $getproductdata = Products::with('multi_image','multi_variation', 'extras')->where('slug', $slug)->first();
        $globalextras = GlobalExtras::where('vendor_id', $vendor_id)->where('is_available', 1)->orderBy('reorder_id')->get();
        $getcategorylist = Category::where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();
        $gettaxlist = Tax::where('vendor_id', $vendor_id)->where('is_deleted', 2)->where('is_available', 1)->orderBy('reorder_id')->get();
        $productVariantArrays = [];
        if (!empty($getproductdata)) {
            $getsubcategorylist = SubCategory::where('is_available', 1)->where('is_deleted', 2)->where('category_id', @$getproductdata->category_id)->orderBy('reorder_id')->get();
        $productreview = Testimonials::where('product_id',$getproductdata->id)->where('vendor_id',$vendor_id)->orderBy('reorder_id')->get();
        $product_variant_names = [];
        $variant_options = [];
        if ($getproductdata->has_variation == '1') {
            $productVariants = Variation::where('product_id', $getproductdata->id)->get();
            if (!empty(json_decode($getproductdata->variants_json, true))) {

                $variant_options = array_column(json_decode($getproductdata->variants_json), 'variant_name');
                $product_variant_names = $variant_options;
            }

            foreach ($productVariants as $key => $productVariant) {
                $productVariantArrays[$key]['product_variants'] = $productVariant->toArray();
            }
        }
        return view('admin.product.edit_product', compact('getproductdata', 'getcategorylist', 'getsubcategorylist','productreview','gettaxlist','productVariantArrays', 'product_variant_names', 'variant_options','globalextras'));
        }
        return redirect('admin/products')->with('error', trans('messages.wrong'));
    }
    public function update_product(Request $request, $slug)
    {
       
        try {
            $price = $request->price;
            $original_price = $request->original_price;
            if ($request->has_variants == 1) {
                if ($request->verians == null && $request->variants == null) {
                    return redirect('admin/products/edit-' . $request->slug)->with('error', trans('messages.variation_required'));
                }
            }
           
            if ($request->has_variants == 1) {
                $variants_json = json_decode($request->hiddenVariantOptions, true);
                $variant_options = array_column($variants_json, 'variant_options');
                $newpossibilities = Products::possibleVariants($variant_options);
                if ($request->verians == null) {
                    foreach ($request->variants as $key => $possibility) {
                        $price = $request->variants[$key]['price'];
                        $qty = $request->variants[$key]['qty'];
                        $original_price = $request->variants[$key]['original_price'];
                        break;
                    }
                } else {
                    foreach ($newpossibilities as $key => $possibility) {
                        $price = $request->verians[$key]['price'];
                        $qty = $request->verians[$key]['qty'];
                        $original_price = $request->verians[$key]['original_price'];
                        break;
                    }
                }
            } else {
           
                $price = $request->price;
                $original_price = $request->original_price;
                $qty = $request->qty;
            }
            $product = Products::where('slug', $slug)->first();
           
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category != null ? implode('|',$request->sub_category) : '';
            $product->name = $request->product_name;
            $product->price = $price;
            $product->original_price = $original_price;
            $product->sku = $request->product_sku;
            if ($request->has_variants == '1') {

                $product['has_variation'] = '1';
                $product['variants_json'] = !empty($request->hiddenVariantOptions) ? $request->hiddenVariantOptions : $product->variants_json;
                
                if (!empty($request->verians) && count($request->verians) > 0) {
                    foreach ($request->verians as $key => $possibility) {
                        $possibilities = Variation::where('id',$key)->where('product_id',$product->id)->first();
                       
                        if (is_null($possibilities)) {
                            $VariantOptionNew = new Variation();
                            $VariantOptionNew->product_id = $product->id;
                            $VariantOptionNew->name = $possibility['name'];
                            $VariantOptionNew->price = $possibility['price'];
                            $VariantOptionNew->original_price = $possibility['original_price'];
                            $VariantOptionNew->qty = $possibility['qty'] ?? $possibility['qty'];
                            $VariantOptionNew->min_order = $possibility['min_order'] ?? $possibility['min_order'];
                            $VariantOptionNew->max_order = $possibility['max_order'] ?? $possibility['max_order'];
                            $VariantOptionNew->low_qty =  $possibility['low_qty'];
                            $VariantOptionNew->stock_management = array_key_exists('stock_management', $possibility) ? $possibility['stock_management'] : 2;
                            $VariantOptionNew->is_available = array_key_exists('is_available',  $possibility) ?  $possibility['is_available'] : 2;
                            $VariantOptionNew->save();
                        } else {
                            $possibilities->price = $possibility['price'];
                            $possibilities->original_price = $possibility['original_price'];
                            $possibilities->qty = $possibility['qty'] ?? $possibility['qty'];
                            $possibilities->min_order = $possibility['min_order'] ?? $possibility['min_order'];
                            $possibilities->max_order = $possibility['max_order'] ?? $possibility['max_order'];
                            $possibilities->low_qty = $possibility['low_qty'] ?? $possibility['low_qty'];
                            $possibilities->stock_management = array_key_exists('stock_management', $possibility) ? $possibility['stock_management'] : 2;
                            $possibilities->is_available = array_key_exists('is_available',  $possibility) ?  $possibility['is_available'] : 2;
                            $possibilities->save();
                        }
                    }
                  
                } else if (!empty($request->variants) && count($request->variants) > 0) {

                    foreach ($request->variants as $key => $possibility) {
                        $possibilities = Variation::find($key);
                        $possibilities->price = $possibility['price'];
                        $possibilities->original_price = $possibility['original_price'];
                        $possibilities->qty = $possibility['qty'] ?? $possibility['qty'];
                        $possibilities->min_order = $possibility['min_order'] ?? $possibility['min_order'];
                        $possibilities->max_order = $possibility['max_order'] ?? $possibility['max_order'];
                        $possibilities->low_qty = $possibility['low_qty'] ?? $possibility['low_qty'];
                        $possibilities->stock_management = array_key_exists('stock_management', $possibility) ? $possibility['stock_management'] : 2;
                        $possibilities->is_available = array_key_exists('is_available',  $possibility) ?  $possibility['is_available'] : 2;
                        if (!array_key_exists('is_available',  $possibility)) {

                            $carts = Cart::where('variation_id', $possibilities->id)->get();
                            foreach ($carts as $cart) {
                                $cart->delete();
                            }
                        }
                        $possibilities->save();
                    }
                }
            } else {
                $product['has_variation'] = '0';
            }
            $product->has_variation = $request->has_variants;
            $product->has_extras = $request->has_extras;
            $product->tax = $request->tax != null ? implode('|', $request->tax) : '';
            $product->description = $request->description;
            $product->additional_info = $request->additional_info;
            $product->video_url = $request->video_url;
            $product->stock_management = $request->has_stock;
            if ($request->has_stock == 1) {
                $product->qty = $qty;
                $product->low_qty = $request->low_qty;
                $product->min_order = $request->min_order;
                $product->max_order = $request->max_order;
            } else {
                $product->qty = "";
                $product->low_qty = "";
                $product->min_order = "";
                $product->max_order = "";
            }
            $product->attchment_name = $request->attachment_name;
            if ($request->has('attachment_file')) {
                if ($product->attchment_file != "" && $product->attchment_file != null && file_exists(storage_path('app/public/admin-assets/images/product/' . $product->attchment_file))) {
                    unlink(storage_path('app/public/admin-assets/images/product/' . $product->attchment_file));
                }
                $reimage = 'attachment-' . uniqid() . "." . $request->file('attachment_file')->getClientOriginalExtension();
                $request->file('attachment_file')->move(storage_path('app/public/admin-assets/images/product/'), $reimage);
                $product->attchment_file = $reimage;
            }
            if ($request->has('downloadfile')) {
                if ($product->download_file != "" && $product->download_file != null && file_exists(storage_path('app/public/admin-assets/images/product/' . $product->download_file))) {
                    unlink(storage_path('app/public/admin-assets/images/product/' . $product->download_file));
                }
                $reimage = 'download-' . uniqid() . "." . $request->file('downloadfile')->getClientOriginalExtension();
                $request->file('downloadfile')->move(storage_path('app/public/admin-assets/images/product/'), $reimage);
                $product->download_file = $reimage;
            }
            if ($request->has_variants == 2) {
                Variation::where('product_id', $product->id)->delete();
                $product->variants_json = '';
            }
            $carts = Cart::where('product_id', $product->id)->delete();
           
            $product->update();
            
            if ($request->has_variants == 1) {
                if (!empty($request->variants)) {

                    foreach ($request->variants as $key => $variant) {
                        $newVal = '';

                        foreach (array_values($variant['variants']) as $k => $v) {
                            if (!empty($newVal)) {
                                $newVal .= '|' . $v[0];
                            } else {
                                $newVal .= $v[0];
                            }
                        }
                        $VariantOption = Variation::find($key);
                        $VariantOption->name = $newVal;
                        $VariantOption->price = $variant['price'];
                        $VariantOption->original_price = $variant['original_price'];
                        $VariantOption->qty = $variant['qty'] ?? $variant['qty'];
                        $VariantOption->min_order = $variant['min_order'] ?? $variant['min_order'];
                        $VariantOption->max_order = $variant['max_order'] ?? $variant['max_order'];
                        $VariantOption->low_qty = $variant['low_qty'] ?? $variant['low_qty'];
                        $VariantOption->stock_management = array_key_exists('stock_management',  $variant) ?  $variant['stock_management'] : 2;
                        $VariantOption->is_available = array_key_exists('is_available',  $variant) ?  $variant['is_available'] : 2;
                        $VariantOption->save();
                    }
                }
            }
            $extras_id = $request->extras_id;
            if ($request->has_extras == 1) {
                if($request->extras_name != null && $request->extras_name !="")
                {
                    foreach ($request->extras_name as $key => $no) {
                        if (@$no != "" && @$request->extras_price[$key] != "") {
                            if (@$extras_id[$key] == "") {
                                $extras = new Extra();
                                $extras->product_id = $product->id;
                                $extras->name = $no;
                                $extras->price = $request->extras_price[$key];
                                $extras->save();
                            } else if (@$extras_id[$key] != "") {
                                Extra::where('id', @$extras_id[$key])->update(['name' => $request->extras_name[$key], 'price' => $request->extras_price[$key]]);
                            }
                        }
                    }
                }
              
            } else {
                Extra::where('product_id', $product->id)->delete();
            }
            return redirect('admin/products')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_image' => 'required|image'
        ], [
                'product_image.required' => trans('messages.image_required'),
                'product_image.image' => trans('messages.valid_image')
            ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', trans('messages.wrong'));
        } else {
            if ($request->has('product_image')) {
                if (file_exists(storage_path('app/public/admin-assets/images/product/' . $request->image))) {
                    unlink(storage_path('app/public/admin-assets/images/product/' . $request->image));
                }
                $productimage = 'product-' . uniqid() . "." . $request->file('product_image')->getClientOriginalExtension();
                $request->file('product_image')->move(storage_path('app/public/admin-assets/images/product/'), $productimage);
                ProductImage::where('id', $request->id)->update(['image' => $productimage]);
                return redirect()->back()->with('success', trans('messages.success'));
            } else {
                return redirect()->back()->with('error', trans('messages.wrong'));
            }
        }
    }
    public function delete_extras(Request $request)
    {
        $deletedata = Extra::where('id', $request->id)->first();
        Cart::where('product_id', $deletedata->product_id)->delete();
        $deletedata->delete();
        if ($deletedata) {
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function delete_product($slug)
    {

        try {
            $checkproduct = Products::where('slug', $slug)->first();
            $checkvariation = Variation::where('product_id', $checkproduct->id)->delete();
            $productimage = ProductImage::where('product_id', $checkproduct->id)->get();
            $getbanner = Banner::where('product_id',$checkproduct->id)->where('vendor_id',$checkproduct->vendor_id)->get();
            $checkextras = Extra::where('product_id', $checkproduct->id)->delete();
            $gettestimonials = Testimonials::where('product_id',$checkproduct->id)->where('vendor_id',$checkproduct->vendor_id)->delete();
            foreach($getbanner as $banner)
            {
                $banner->type="";
                $banner->product_id="";
                $banner->update();
            }
            foreach ($productimage as $image) {
                if ($image->is_imported == 2) {
                    if ($image->image != "" && $image->image != null && file_exists(storage_path('app/public/admin-assets/images/product/' . $image->image))) {
                        unlink(storage_path('app/public/admin-assets/images/product/' . $image->image));
                    }
                }
                $image->delete();
            }
            Cart::where('product_id', $checkproduct->id)->delete();
            $checkproduct->delete();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
           
            return redirect()->back()->with('error', trans('messages.wrong'));
        }

        try {
            $checkproduct = Products::where('slug', $slug)->first();
            $checkproduct->is_deleted = 1;
            $checkproduct->save();
            Cart::where('product_id', $checkproduct->id)->delete();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function delete_image($id, $service_id)
    {
       
        $count = ProductImage::where('product_id', $service_id)->count();
        $image = ProductImage::where('id', $id)->where('product_id',$service_id)->first();
        
        if ($count == 1) {
            return redirect()->back()->with('msg', trans('messages.last_image'));
        } 
        if ($image->is_imported == 2) {
            if ($image->image != "" && $image->image != null && file_exists(storage_path('app/public/admin-assets/images/product/' . $image->image))) {
                unlink(storage_path('app/public/admin-assets/images/product/' . $image->image));
            }
         }
    $image->delete();
           return redirect()->back()->with('success', trans('messages.success'));
       
    }
    public function delete_variation(Request $request)
    {
        $checkvariationcount = Variation::where('product_id', $request->product_id)->count();
        if ($checkvariationcount > 1) {
            $UpdateDetails = Variation::where('id', $request->id)->delete();
            if ($UpdateDetails) {
                Cart::where('variation_id', $request->id)->delete();
                return redirect()->back()->with('success', trans('messages.success'));
            } else {
                return redirect()->back()->with('error', trans('messages.wrong'));
            }
        } else {
            return redirect()->back()->with('error', trans('messages.last_variation'));
        }
    }
    public function add_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image'
        ], [
                'image.required' => trans('messages.image_required'),
                'image.image' => trans('messages.valid_image')
            ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', trans('messages.wrong'));
        } else {
            $productimage = new ProductImage();
            $productimage->product_id = $request->product_id;
            if ($request->has('image')) {
                $image = 'product-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(storage_path('app/public/admin-assets/images/product/'), $image);
                $productimage->image = $image;
            }
            $productimage->save();
            return redirect()->back()->with('success', trans('messages.success'));
        }
    }
    public function status_change($slug, $status)
    {
        $checkproduct = Products::where('slug', $slug)->first();
        $checkproduct->is_available = $status;
        $checkproduct->save();
        if ($status == 2) {
            Cart::where('product_id', $checkproduct->id)->delete();
        }
        return redirect('admin/products')->with('success', trans('messages.success'));
    }
    public function subcategories(Request $request)
    {
        
        $data = helper::getsubcategories($request->id, "");
        return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $data], 200);
    }

    public function reorder_category(Request $request)
    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        $getproducts = Products::where('vendor_id',$vendor_id)->get();
        foreach ($getproducts as $product) {
            foreach ($request->order as $order) {
               $product = products::where('id',$order['id'])->first();
               $product->reorder_id = $order['position'];
               $product->save();
            }
        }
        return response()->json(['status' => 1,'success'=>trans('messages.success'),'msg' => trans('messages.success')], 200);
    }
    public function delete_review(Request $request)
    {
        $deletereview = Testimonials::where('id',$request->id)->first();
        $deletereview->delete();
        return redirect()->back()->with('success',trans('messages.success'));
    }
    public function top_deals(Request $request)
    {
        $product = Products::where('slug',$request->slug)->where('vendor_id',Auth::user()->id)->first();
        $product->top_deals = $request->status;
        $product->update();
        return redirect()->back()->with('success',trans('messages.success'));
    }
    public function getProductVariantsPossibilities(Request $request, $item_id = 0)
    {
        $variant_edit = $request->variant_edit;

        if (!empty($variant_edit) && $variant_edit == 'edit') {
            $variant_option123 = json_decode($request->hiddenVariantOptions, true);
            foreach ($variant_option123 as $key => $value) {
                $new_key = array_search($value['variant_name'], array_column($request->variant_edt, 'variant_name'));
                if (!empty($request->variant_edt[$new_key]['variant_options'])) {
                    $new_val = explode('|', $request->variant_edt[$new_key]['variant_options']);
                    $variant_option123[$key]['variant_options'] = array_merge($variant_option123[$key]['variant_options'], $new_val);
                }
            }
            $request->hiddenVariantOptions = json_encode($variant_option123);
        }

        $variant_name = $request->variant_name;
        $variant_options = $request->variant_options;
        $hiddenVariantOptions = $request->hiddenVariantOptions;
        $hiddenVariantOptions = json_decode($hiddenVariantOptions, true);
        $result = [
            'hiddenVariantOptions' => json_encode($hiddenVariantOptions),
            'message' => trans('messages.variant_attribute_exist'),
        ];
        if (!empty($hiddenVariantOptions)) {
            foreach ($hiddenVariantOptions as $key => $value) {
                if (in_array($request->variant_name, $hiddenVariantOptions[$key])) {
                    return response()->json($result);
                }
            }
        }
        $variants = [
            [
                'variant_name' => $variant_name,
                'variant_options' => explode('|', $variant_options),
            ],
        ];
        if (empty($variant_edit) && $variant_edit != 'edit') {
            $hiddenVariantOptions = array_merge($hiddenVariantOptions, $variants);
        }
        $hiddenVariantOptions = array_map("unserialize", array_unique(array_map("serialize", $hiddenVariantOptions)));
        $optionArray = $variantArray = [];
        foreach ($hiddenVariantOptions as $variant) {
            $variantArray[] = $variant['variant_name'];
            $optionArray[] = $variant['variant_options'];
        }
        $possibilities = Products::possibleVariants($optionArray);
        $variantArray = array_unique($variantArray);
        if (!empty($variant_edit) && $variant_edit == 'edit') {
            $varitantHTML = view('admin.product.variants.edit_list', compact('possibilities', 'variantArray', 'item_id'))->render();
        } else {
            $varitantHTML = view('admin.product.variants.list', compact('possibilities', 'variantArray'))->render();
        }
        $result = [
            'status' => false,
            'hiddenVariantOptions' => json_encode($hiddenVariantOptions),
            'varitantHTML' => $varitantHTML,
        ];
        return response()->json($result);
    }

    public function productVariantsEdit(Request $request, $item_id)
    {
       
        $product = Products::where('id', $item_id)->first();
        $productVariantOption = json_decode($product->variants_json, true);
        if (empty($productVariantOption)) {
            return view('admin.product.variants.create')->render();
        } else {
            return view('admin.product.variants.edit', compact('product', 'productVariantOption', 'item_id'))->render();
        }
    }
    public function reorder_image(Request $request)
    {
     
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getproducts = ProductImage::where('product_id',$request->product_id)->get();
        
        $arr = explode('|', $request->input('ids'));
            foreach ($arr as $sortOrder => $id) {
                if($id !="" && $id != null)
                {
                    $menu = ProductImage::find($id);
                    $menu->reorder_id = $sortOrder;
                    $menu->save();
                }
              
            }
        
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}
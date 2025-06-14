<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use App\Models\Gallery;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;



class GalleryController extends Controller

{

    public function index(Request $request)

    {

        if (Auth::user()->type == 4) {

            $vendor_id = Auth::user()->vendor_id;
        } else {

            $vendor_id  = Auth::user()->id;
        }

        $allgallery = Gallery::where('vendor_id', $vendor_id)->orderBy('reorder_id')->get();

        return view('admin.gallery.index', compact('allgallery'));
    }

    public function add()

    {

        return view('admin.gallery.add');
    }

    public function save(Request $request)

    {

        if (Auth::user()->type == 4) {

            $vendor_id = Auth::user()->vendor_id;
        } else {

            $vendor_id  = Auth::user()->id;
        }

        if ($request->has('image')) {

            foreach ($request->file('image') as $file) {
                $reimage = 'gallery-' . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move(storage_path('app/public/admin-assets/images/gallery/'), $reimage);
                $newgallery = new Gallery();
                $newgallery->vendor_id = $vendor_id;
                $newgallery->image = $reimage;
                $newgallery->save();
            }
        }

        return redirect('/admin/gallery/')->with('success', trans('messages.success'));
    }

    public function edit(Request $request)

    {

        if (Auth::user()->type == 4) {

            $vendor_id = Auth::user()->vendor_id;
        } else {

            $vendor_id  = Auth::user()->id;
        }

        $editgallery = Gallery::where('id', $request->id)->where('vendor_id', $vendor_id)->first();

        return view('admin.gallery.edit', compact('editgallery'));
    }

    public function update(Request $request)

    {

        if (Auth::user()->type == 4) {

            $vendor_id = Auth::user()->vendor_id;
        } else {

            $vendor_id  = Auth::user()->id;
        }

        $request->validate([

            'image' => 'image',

        ]);

        $editgallery = Gallery::where('id', $request->id)->where('vendor_id', $vendor_id)->first();

        if ($request->has('image')) {



            if (file_exists(storage_path('app/public/admin-assets/images/gallery/' . $editgallery->image))) {

                unlink(storage_path('app/public/admin-assets/images/gallery/' . $editgallery->image));
            }

            $reimage = 'gallery-' . uniqid() . "." . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('app/public/admin-assets/images/gallery/'), $reimage);

            $editgallery->image = $reimage;
        }

        $editgallery->update();

        return redirect('/admin/gallery/')->with('success', trans('messages.success'));
    }

    public function delete(Request $request)

    {

        $gallery = Gallery::where('id', $request->id)->first();



        if (file_exists(storage_path('app/public/admin-assets/images/gallery/' . $gallery->image))) {

            unlink(storage_path('app/public/admin-assets/images/gallery/' . $gallery->image));
        }



        $gallery->delete();

        return redirect('/admin/gallery/')->with('success', trans('messages.success'));
    }
    public function reorder_gallery(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getgallery = Gallery::where('vendor_id', $vendor_id)->get();
        foreach ($getgallery as $item) {
            foreach ($request->order as $order) {
                $item = Gallery::where('id', $order['id'])->first();
                $item->reorder_id = $order['position'];
                $item->save();
            }
        }
        return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
    }
}

<?php
namespace App\Http\Controllers\addons;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\helper\helper;
use Response;
class MediaController extends Controller
{
    public function index(){
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $media = Media::where('vendor_id', $vendor_id)->orderBy('id', 'DESC')->get();
        return view('admin.media.index', compact("media"));
    }

    public function add_image(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $validator = Validator::make($request->all(), [
            'image.*' => 'image|max:'.helper::imagesize().'|'.helper::imageext(),
        ], [
            'image.max' => trans('messages.image_size_message'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', trans('messages.image_size_message'). ' ' . helper::appdata('')->image_size .' ' .'MB');
        } else {
            if ($request->has('image')) {
                foreach ($request->file('image') as $file) {
                    $imgname = helper::imageresize($file,storage_path('app/public/admin-assets/images/product'));

                    $media = new Media();
                    $media->image = $imgname;
                    $media->vendor_id =  $vendor_id;
                    $media->save();
                }
            }
            return redirect()->back()->with('success', trans('messages.success'));
        }
    }

    public function delete_media(Request $request)
    {
        try {
            $checkproduct = Media::where('id', $request->id)->first();

            if (file_exists(storage_path('app/public/admin-assets/images/product/' . $checkproduct->image))) {
                unlink(storage_path('app/public/admin-assets/images/product/' . $checkproduct->image));
            }
            Media::where('id', $request->id)->delete();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }

    public function download(Request $request)
    {
        try {
            $checkproduct = Media::where('id', $request->id)->first();

            $filepath = storage_path('app/public/admin-assets/images/product/').$checkproduct->image;
            return Response::download($filepath);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
}

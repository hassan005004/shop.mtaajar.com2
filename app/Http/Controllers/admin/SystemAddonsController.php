<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemAddons;
use ZipArchive;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SystemAddonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->get('demo') == "free-addon") {
            $addons = SystemAddons::where('type','1')->orderBy('name', 'ASC')->get();
        } elseif (session()->get('demo') == "free-with-extended-addon") {
            $addons = SystemAddons::whereIn('type', ['1', '2'])->orderBy('name', 'ASC')->get();
        } else {
            $addons = SystemAddons::whereIn('type', ['1', '2', '3'])->orderBy('name', 'ASC')->get();
        }
        
        return view('admin.apps.index', compact('addons'));
    }
    public function createsystemaddons()
    {
        return view('admin.apps.add');
    }
    public function list()
    {
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $s
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (class_exists('ZipArchive')) {
            if ($request->hasFile('addon_zip')) {
                // Create update directory.
                $dir = 'addons';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);
                $path = Storage::disk('local')->put('addons', $request->addon_zip);
                $zipped_file_name = $request->addon_zip->getClientOriginalName();
                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive;
                $res = $zip->open(base_path('storage/app/' . $path));
                
                $random_dir = Str::random(10);
                $dir = trim($zip->getNameIndex(0), '/');
                if ($res === true) {
                    $res = $zip->extractTo(base_path('temp/' . $random_dir . '/addons'));
                    $zip->close();
                } else {
                    return redirect()->back()->with('error', 'could not open');
                }
                $str = file_get_contents(base_path('temp/' . $random_dir . '/addons/' . $dir . '/config.json'));
                $json = json_decode($str, true);
                    
                $ver = 3;
                if ($ver >= $json['minimum_item_version']) {
                    if (count(SystemAddons::where('unique_identifier', $json['unique_identifier'])->get()) == 0) {
                        $addon = new SystemAddons;
                        $addon->name = $json['name'];
                        $addon->unique_identifier = $json['unique_identifier'];
                        $addon->version = $json['version'];
                        $addon->activated = 1;
                        $addon->image = $json['addon_banner'];
                        $addon->save();
                        // Create new directories.
                        if (!empty($json['directory'])) {
                            foreach ($json['directory'][0]['name'] as $directory) {
                                if (is_dir(base_path($directory)) == false) {
                                    mkdir(base_path($directory), 0777, true);
                                } else {
                                    return redirect()->back()->with('error', 'error on creating directory');
                                }
                            }
                        }
                        // Create/Replace new files.
                        if (!empty($json['files'])) {
                            foreach ($json['files'] as $file) {
                                copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                            }
                        }
                        // Run sql modifications
                        $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/update.sql');

                        if (file_exists($sql_path)) {
                            DB::unprepared(file_get_contents($sql_path));
                        }
                        return redirect()->back()->with('success', 'Addon installed successfully');
                    } else {
                        // Create new directories.
                        if (!empty($json['directory'])) {
                            foreach ($json['directory'][0]['name'] as $directory) {
                                if (is_dir(base_path($directory)) == false) {
                                    mkdir(base_path($directory), 0777, true);
                                } else {
                                    return redirect()->back()->with('error', 'error on creating directory');
                                }
                            }
                        }
                        // Create/Replace new files.
                        if (!empty($json['files'])) {
                            foreach ($json['files'] as $file) {
                                copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                            }
                        }
                        $addon = SystemAddons::where('unique_identifier', $json['unique_identifier'])->first();
                        for ($i = $addon->version + 0.1; $i <= $json['version']; $i = $i + 0.1) {
                            // Run sql modifications
                            // $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/' . $i . '.sql');
                            // if (file_exists($sql_path)) {
                            //     DB::unprepared(file_get_contents($sql_path));
                            // }
                        }
                        $addon->version = $json['version'];
                        $addon->save();
                        return redirect()->back()->with('success', 'This addon is updated successfully');
                    }
                } else {
                    return redirect()->back()->with('error', 'This version is not capable of installing Addons, Please update.');
                }
            }
        }
        else {
            return redirect()->back()->with('error', 'Please enable ZipArchive extension.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request)
    {
        $addons = SystemAddons::where('id', $request->id)->update( array('activated'=>$request->status) );
        return redirect('admin/apps')->with('success', trans('messages.success'));
    }
}

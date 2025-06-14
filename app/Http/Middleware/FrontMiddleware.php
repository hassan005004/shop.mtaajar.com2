<?php



namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Settings;

use App\helper\helper;

class FrontMiddleware

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next

     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse

     */

    public function handle(Request $request, Closure $next)
    {
        if(!file_exists(storage_path() . "/installed")) {
            return redirect('install');
            exit;
        }

        // if the current host contains the website domain
        $host = $_SERVER['HTTP_HOST'];
        if ($host  ==  env('WEBSITE_HOST')) {
            $user = User::where('slug', $request->vendor_slug)->first();
            helper::language($user->id);
          
            if ($request->vendor_slug != "" || $request->vendor_slug != null) {
                if (empty($user)) {
                    abort(404);
                }
                if (helper::appdata(@$user->id)->maintenance_mode == 1) {
                    return response(view('errors.maintenance'));
                }
                $checkplan = helper::checkplan($user->id, '3');
                $v = json_decode(json_encode($checkplan));
                if (@$v->original->status == 2) {
                    return response(view('errors.accountdeleted'));
                }
                if ($user->is_available == 2) {
                    return response(view('errors.accountdeleted'));
                }
            }
        }
        // if the current host doesn't contain the website domain (meaning, custom domain)
        else {
            // if the current package doesn't have 'custom domain' feature || the custom domain is not connected
            $settingdata = Settings::where('custom_domain', $host)->first();
            helper::language(@$settingdata->id);
            if (@$settingdata->id != "" || @$settingdata->id != null) {
                $user = User::where('id', @$settingdata->vendor_id)->first();
                if (empty($user)) {
                    abort(404);
                }
                if (helper::appdata($user->id)->maintenance_mode == 1) {
                    return response(view('errors.maintenance'));
                }
                $checkplan = helper::checkplan($user->id, '3');
                $v = json_decode(json_encode($checkplan));
                if (@$v->original->status == 2) {
                    return response(view('errors.accountdeleted'));
                }
                if ($user->is_available == 2) {
                    return response(view('errors.accountdeleted'));
                }
            }
        }
        return $next($request);

    }

}


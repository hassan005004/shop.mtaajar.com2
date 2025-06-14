<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\helper\helper;
class landingMiddleware
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
        helper::language(1);
        $user = User::where('type',1)->first();
        $setting = Settings::where('id',$user->id)->first();
        date_default_timezone_set(@helper::appdata('')->timezone);
        if($setting->maintenance_mode == 1)
        {
            return response(view('errors.maintenance'));
        }
        return $next($request);
    }
}

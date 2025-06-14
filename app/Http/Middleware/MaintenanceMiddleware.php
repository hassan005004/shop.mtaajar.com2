<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use App\helper\helper;
class MaintenanceMiddleware

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle(Request $request, \Closure $next)

    {
        return $next($request);

    }

}
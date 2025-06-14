<?php
use Illuminate\Support\Facades\Route;
use App\helper\helper;
use App\Http\Controllers\addons\ToyyibpayController;
/*
|--------------------------------------------------------------------------
| Web Routes

|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'AuthMiddleware'], function () {
        Route::middleware('VendorMiddleware')->group(function () {
            Route::group(
                ['prefix' => 'plan'],
                function () {
                    Route::post('buyplan/toyyibpay', [ToyyibpayController::class, 'toyyibpayrequest']);
                }
            );
        });
    });
});

$domain = @env('WEBSITE_HOST');
$parsedUrl = parse_url(url()->current());
$host = $parsedUrl['host'];
if (array_key_exists('host', $parsedUrl)) {
    // if it is a path based URL
    if ($host == @env('WEBSITE_HOST')) {
        $domain = $domain;
        $prefix = '{vendor_slug}';
    }
    // if it is a subdomain / custom domain
    else {
        $prefix = '';
    }
}

Route::group(['namespace' => "web", 'prefix' => $prefix, 'middleware' => 'FrontMiddleware'], function () {
    Route::post('/placeorder/toyyibpayrequest', [ToyyibpayController::class, 'front_toyyibpayrequest']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addons\included\PromocodeController;
use App\Http\Controllers\web\CheckoutController;

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
        // Promocode
        Route::group(['prefix' => 'promocode'], function () {
            Route::get('', [PromocodeController::class, 'index']);
            Route::get('/add', [PromocodeController::class, 'add']);
            Route::post('/save', [PromocodeController::class, 'save']);
            Route::get('/edit-{id}', [PromocodeController::class, 'edit']);
            Route::post('/update-{id}', [PromocodeController::class, 'update']);
            Route::get('/status-{id}/{status}', [PromocodeController::class, 'status']);
            Route::get('/delete-{id}', [PromocodeController::class, 'delete']);
            Route::post('/reorder_coupon', [PromocodeController::class, 'reorder_coupon']);
        });
        Route::middleware('VendorMiddleware')->group(
            function () {
                Route::post('/applycoupon', [PromocodeController::class, 'vendorapplypromocode']);
                Route::post('/removecoupon', [PromocodeController::class, 'removepromocode']);
            }
        );
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
    Route::post('/cart/applypromocode', [CheckoutController::class, 'applypromocode']);
    Route::post('/cart/removepromocode', [CheckoutController::class, 'removepromocode']);
});

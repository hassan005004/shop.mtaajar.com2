<?php
use App\Http\Controllers\addons\ShipRocketController;
use Illuminate\Support\Facades\Route;
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
        Route::post('/settings/ship_rocket_settings', [ShipRocketController::class, 'ship_rocket_settings']);
        Route::get('/orders/create_order-{vendor_id}-{order_id}', [ShipRocketController::class, 'create_order']);
    });
});

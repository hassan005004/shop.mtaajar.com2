<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addons\ImportController;
use App\Http\Controllers\addons\MediaController;
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



//  ------------------------------- ----------- -----------------------------------------   //
//  -------------------------------  FOR ADMIN  -----------------------------------------   //
//  ------------------------------- ----------- -----------------------------------------   //	

Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::group(
        ['middleware' => 'AuthMiddleware'],
        function () {
            Route::middleware('VendorMiddleware')->group(
                function () {

                    Route::get('/generatepdf', [ImportController::class, 'generatepdf']);
                    Route::get('/generatepdf_subcategory', [ImportController::class, 'generatepdf_subcategory']);
                    Route::post('/importproduct', [ImportController::class, 'importproduct']);
                    Route::get('/generatetaxpdf', [ImportController::class, 'generatetaxpdf']);
                    Route::get('/exportproduct',[ImportController::class,'exportproduct']);
                    Route::group(
                        ['prefix' => 'products'],
                        function () {
                            Route::get('/import', [ImportController::class, 'import']);
                        }
                    );
                       // Media
                       Route::group(
                        ['prefix' => 'media'],
                        function () {
                            Route::get('/', [MediaController::class, 'index']);
                            Route::post('/add_image', [MediaController::class, 'add_image']);
                            Route::get('delete-{id}', [MediaController::class, 'delete_media']);
                            Route::get('download-{id}', [MediaController::class, 'download']);
                        }
                    );
                }
            );
        }
    );
});
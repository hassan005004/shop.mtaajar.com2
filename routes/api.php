<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController as VendorController;
use App\Http\Controllers\api\HomeController as VendorHomeController;
use App\Http\Controllers\api\OtherController;
use App\Http\Controllers\addons\GoogleLoginController;
use App\Http\Controllers\addons\FacebookLoginController;
use App\Http\Controllers\api\user\UserController;
use App\Http\Controllers\api\user\HomeController;
use App\Http\Controllers\api\user\BlogController;
use App\Http\Controllers\api\user\CartController;
use App\Http\Controllers\api\user\OrderController;
use App\Http\Controllers\addons\PromocodeController;
use App\Http\Controllers\addons\TelegramController;
use App\Http\Controllers\addons\MercadopagoController;
use App\Http\Controllers\addons\ToyyibpayController;
use App\Http\Controllers\addons\MyfatoorahController;
use App\Http\Controllers\api\user\OtherController as UserOtherController;

/*

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| is assigned the "api" middleware group. Enjoy building your API!

|

*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();

});
Route::group(['namespace'=>'Api'],function (){
    Route::post('register',[VendorController::class,'register_vendor']);
    Route::post('socialgooglelogin',[GoogleLoginController::class,'socialgooglelogin_vendor']);
    Route::post('socialfacebooklogin',[FacebookLoginController::class,'socialfacebooklogin_vendor']);
    Route::post('login',[VendorController::class,'check_admin_login']);
    Route::post('forgotpassword',[VendorController::class,'forgotpassword']);
    Route::post('changepassword', [VendorController::class, 'change_password']);
    Route::post('editprofile', [VendorController::class, 'edit_profile']);
    Route::get('getcountry', [VendorController::class, 'getcountry']);
    Route::post('getcity', [VendorController::class, 'getcity']);


    Route::post('home',[VendorHomeController::class,'index']);
    Route::post('orderdetail',[VendorHomeController::class,'order_detail']);
    Route::post('orderhistory',[VendorHomeController::class,'order_history']);
    Route::post('statuschange',[VendorHomeController::class,'status_change']);
    Route::get('systemaddon', [VendorHomeController::class, 'systemaddon']);
    Route::get('cmspages',[OtherController::class,'getcontent']);
    Route::post('inquiries',[OtherController::class,'inquiries']);
    Route::post('updatepaymentstatus',[OtherController::class,'payment_status']);
    Route::post('updatecustomerdetails',[OtherController::class,'customerinfo']);
    Route::post('updatevendornote',[OtherController::class,'vendor_note']);
    
    Route::post('user/registeruser',[UserController::class,'register_customer']);
    Route::post('user/login',[UserController::class,'login_customer']);
    Route::post('user/googlelogin',[GoogleLoginController::class,'googleloginuser']);
    Route::post('user/facebooklogin',[FacebookLoginController::class,'facebookloginuser']);
    Route::post('user/forgotpassword',[UserController::class,'forgotpassword']);
    Route::post('user/editprofile',[UserController::class,'edit_profile']);
    Route::post('user/changepassword',[UserController::class,'change_password']);
    
    Route::post('user/home',[HomeController::class,'home']);
    Route::post('user/productlist', [HomeController::class, 'productlist']);
    Route::post('user/productdetails', [HomeController::class, 'productdetails']);
    Route::post('user/allcategory', [HomeController::class, 'allcategory']);
    Route::post('user/categorywiseproducts', [HomeController::class, 'category_items']);
    Route::post('user/subcategory', [HomeController::class, 'subcategory']);
    Route::post('user/managewhishlist', [HomeController::class, 'managefavorite']);
    Route::post('user/paymentmethods', [HomeController::class, 'paymentmethods']);
    Route::post('user/search', [HomeController::class, 'search']);
    //Payment-Gateway
    Route::post('user/mercadorequest', [MercadopagoController::class,'mercadorequestapi']);
    Route::post('user/toyyibpayrequest', [ToyyibpayController::class,'toyyibpayrequestapi']);
    Route::post('user/myfattorahrequestapi', [MyfatoorahController::class,'myfattorahrequestapi']);
    

    Route::post('user/blogs', [BlogController::class, 'blogs']);
    Route::post('user/addtocart', [CartController::class, 'addtocart']);
    Route::post('user/cart', [CartController::class, 'cart']);
    Route::post('user/qtyupdate', [CartController::class, 'qtyupdate']);
    Route::post('user/deletecartitem', [CartController::class, 'deletecartitem']);
    Route::post('user/systemaddon', [HomeController::class, 'systemaddon']);
    Route::post('user/promocode', [PromocodeController::class, 'promocode']);
    Route::post('user/applypromocode', [PromocodeController::class, 'applypromocode']);
    Route::post('user/checkpromocodelimit', [PromocodeController::class, 'checkpromocodelimit']);
    Route::post('user/shippingarea', [CartController::class, 'shippingarea']);
    Route::post('user/wishlistproduct', [UserController::class, 'wishlist_product']);
    Route::post('user/cmspages', [UserOtherController::class, 'cmspages']);
    Route::post('user/contact', [UserOtherController::class, 'contact']);
    Route::post('user/contact_detail', [UserOtherController::class, 'contact_detail']);
    Route::post('user/gallery', [UserOtherController::class, 'gallery']);
    Route::post('user/orderhistory', [OrderController::class, 'orderhistory']);
    Route::post('user/orderdetails', [OrderController::class, 'orderdetails']);
    Route::post('user/cancelorder', [OrderController::class, 'cancelorder']);
    Route::post('user/placeorder', [OrderController::class, 'placeorder']);
    Route::post('user/telegram', [TelegramController::class, 'telegram_msg']);
    Route::post('user/delete_account', [UserController::class, 'deleteaccount']);
    Route::post('user/filteration', [HomeController::class, 'filteration']);
    Route::post('user/postreview', [HomeController::class, 'postreview']);
    Route::post('user/qtycheckurl', [OrderController::class, 'qtycheckurl']);
    Route::post('user/getvariationprice', [HomeController::class,'getvariationprice']);
    Route::post('user/changeqty', [CartController::class,'changeqty']);
   
});


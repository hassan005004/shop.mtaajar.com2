<?php

use Illuminate\Support\Facades\Route;
use App\helper\helper;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\PlanPricingController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\StoreCategoryController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\addons\BlogController;
use App\Http\Controllers\admin\HowItWorkController;
use App\Http\Controllers\admin\ThemeController;
use App\Http\Controllers\admin\ShippingareaController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\GlobalExtrasController;
use App\Http\Controllers\admin\SystemAddonsController;
use App\Http\Controllers\admin\OtherPagesController;
use App\Http\Controllers\admin\WhoWeAreController;
use App\Http\Controllers\admin\FeaturesController;
use App\Http\Controllers\admin\WebSettingsController;
use App\Http\Controllers\admin\TaxController;
use App\Http\Controllers\admin\TopdealsController;
use App\Http\Controllers\landing\HomeController as LandingHomeController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\UserController as WebUserController;
use App\Http\Controllers\web\CheckoutController;
use App\Http\Controllers\web\WalletController;
use App\Http\Controllers\web\ProductController as WebProductController;
use App\Http\Controllers\web\OtherPagesController as WebOtherPagesController;
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
//  -------------------------------  for Admin  -----------------------------------------   //
//  ------------------------------- ----------- -----------------------------------------   //	


$domain = env('WEBSITE_HOST');
$parsedUrl = parse_url(url()->current());
$host = $parsedUrl['host'];
if (array_key_exists('host', $parsedUrl)) {
    // if it is a path based URL
    if ($host == env('WEBSITE_HOST')) {
        $domain = $domain;
        $prefix = '{vendor_slug}';
    }
    // if it is a subdomain / custom domain
    else {
        $prefix = '';
    }
}
Route::post('add-on/session/save', [AdminController::class, 'sessionsave']);
if ($host == env('WEBSITE_HOST')) {
    Route::get('/', [AdminController::class, 'login']);
    Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {
        Route::get('/', [AdminController::class, 'login']);
        Route::post('checklogin', [AdminController::class, 'check_admin_login']);
        Route::get('register', [VendorController::class, 'register']);
        Route::post('/getcity', [VendorController::class, 'getcity']);
        Route::post('register_vendor', [VendorController::class, 'register_vendor']);
        Route::get('forgot_password', [VendorController::class, 'forgot_password']);
        Route::post('send_password', [VendorController::class, 'send_password']);
        Route::get('/verify', function () {
            return view('admin.auth.verify');
        });
        Route::post('systemverification', [AdminController::class, 'systemverification'])->name('admin.systemverification');
        Route::get('apps', [SystemAddonsController::class, 'index'])->name('systemaddons');
        Route::get('createsystem-addons', [SystemAddonsController::class, 'createsystemaddons']);
        Route::post('systemaddons/store', [SystemAddonsController::class, 'store']);
        Route::get('systemaddons/status-{id}/{status}', [SystemAddonsController::class, 'change_status']);


        Route::group(
            ['middleware' => 'AuthMiddleware'],
            function () {
                // -------- Common --------
                Route::get('admin_back', [VendorController::class, 'admin_back']);
                Route::get('logout', [AdminController::class, 'logout']);
                Route::get('dashboard', [AdminController::class, 'index']);
                // Settings
                Route::get('settings', [VendorController::class, 'settings_index']);
                Route::post('settings/update', [VendorController::class, 'settings_update']);
                Route::post('settings/safe-secure-store', [VendorController::class, 'safe_secure_store']);
                Route::get('settings/delete-feature-{id}', [VendorController::class, 'delete_feature']);
                Route::post('settings/update-profile-{id}', [VendorController::class, 'update']);
                Route::post('settings/change-password', [VendorController::class, 'change_password']);


                Route::post('other/update', [WebSettingsController::class, 'other_update']);

                // Transaction
                Route::get('transaction', [TransactionController::class, 'index']);
                // Plans
                Route::get('plan', [PlanPricingController::class, 'view_plan']);
                Route::get('transaction/plandetails-{id}', [PlanPricingController::class, 'plan_details']);
                Route::get('transaction/generatepdf-{id}', [PlanPricingController::class, 'generatepdf']);
                Route::get('/themeimages', [PlanPricingController::class, 'themeimages']);
                // Payment
                Route::group(
                    ['prefix' => 'payment'],
                    function () {
                        Route::get('/', [PaymentController::class, 'index']);
                        Route::post('update', [PaymentController::class, 'update']);
                        Route::post('/reorder_payment', [PaymentController::class, 'reorder_payment']);
                    }
                );

                // STORE CATEGORIES
                Route::group(
                    ['prefix' => 'store_categories'],
                    function () {
                        Route::get('/', [StoreCategoryController::class, 'index']);
                        Route::get('add', [StoreCategoryController::class, 'add_category']);
                        Route::post('save', [StoreCategoryController::class, 'save_category']);
                        Route::get('edit-{id}', [StoreCategoryController::class, 'edit_category']);
                        Route::post('update-{id}', [StoreCategoryController::class, 'update_category']);
                        Route::get('change_status-{id}/{status}', [StoreCategoryController::class, 'change_status']);
                        Route::get('delete-{id}', [StoreCategoryController::class, 'delete_category']);
                        Route::post('/reorder_category', [StoreCategoryController::class, 'reorder_category']);
                    }
                );

                // inquiries
                Route::get('/inquiries', [OtherPagesController::class, 'inquiries']);
                Route::get('/inquiries/delete-{id}', [OtherPagesController::class, 'inquiries_delete']);


                // Other Pages
                Route::get('/subscribers', [OtherPagesController::class, 'subscribers']);
                Route::get('/subscribers/delete-{id}', [OtherPagesController::class, 'subscribers_delete']);

                Route::get('/privacypolicy', [OtherPagesController::class, 'privacypolicy']);

                Route::post('/privacypolicy/update', [OtherPagesController::class, 'update_privacypolicy']);

                Route::get('/termscondition', [OtherPagesController::class, 'termscondition']);

                Route::post('/termscondition/update', [OtherPagesController::class, 'update_terms']);

                Route::get('/aboutus', [OtherPagesController::class, 'aboutus']);

                Route::post('/aboutus/update', [OtherPagesController::class, 'update_aboutus']);
                Route::get('/refund_policy', [OtherPagesController::class, 'refund_policy']);
                Route::post('/refund_policy/update', [OtherPagesController::class, 'refund_policy_update']);
                Route::group(
                    ['prefix' => 'orders'],
                    function () {
                        Route::get('/invoice/{order_number}', [OrderController::class, 'invoice']);
                        Route::get('/print/{order_number}', [OrderController::class, 'print']);
                        Route::get('/generatepdf/{order_number}', [OrderController::class, 'generatepdf']);
                        Route::post('/customerinfo', [OrderController::class, 'customerinfo']);
                        Route::post('/vendor_note', [OrderController::class, 'vendor_note']);
                    }
                );

                // website settings
                Route::get('/basic_settings', [WebSettingsController::class, 'basic_settings']);
                Route::post('/themeupdate', [WebSettingsController::class, 'themeupdate']);
                Route::post('/seo_update', [WebSettingsController::class, 'seo_update']);
                Route::post('/footer_features/update', [WebSettingsController::class, 'footer_features_update']);

                Route::post('/contact_settings/update', [WebSettingsController::class, 'contact_settings']);
                Route::post('/other/update', [WebSettingsController::class, 'other_update']);

                // tax
                Route::group(
                    ['prefix' => 'tax'],
                    function () {
                        Route::get('/', [TaxController::class, 'index']);
                        Route::get('add', [TaxController::class, 'add']);
                        Route::post('save', [TaxController::class, 'save']);
                        Route::get('edit-{id}', [TaxController::class, 'edit']);
                        Route::post('update-{id}', [TaxController::class, 'update']);
                        Route::get('change_status-{id}/{status}', [TaxController::class, 'change_status']);
                        Route::get('delete-{id}', [TaxController::class, 'delete']);
                        Route::post('reorder_tax', [TaxController::class, 'reorder_tax']);
                    }
                );

                //   FAQs
                Route::group(
                    ['prefix' => 'faqs'],
                    function () {
                        Route::get('/', [OtherPagesController::class, 'faq_index']);
                        Route::get('/add', [OtherPagesController::class, 'faq_add']);
                        Route::post('/save', [OtherPagesController::class, 'faq_save']);
                        Route::get('/edit-{id}', [OtherPagesController::class, 'faq_edit']);
                        Route::post('/update-{id}', [OtherPagesController::class, 'faq_update']);
                        Route::get('/delete-{id}', [OtherPagesController::class, 'faq_delete']);
                        Route::post('/reorder_faq', [OtherPagesController::class, 'reorder_faq']);
                    }
                );

                Route::post('social_links/update', [WebSettingsController::class, 'social_links_update']);
                Route::get('settings/delete-sociallinks-{id}', [WebSettingsController::class, 'delete_sociallinks']);

                Route::post('app_section/update', [WebSettingsController::class, 'app_section']);
                Route::middleware('adminmiddleware')->group(
                    function () {
                        Route::get('transaction-{id}-{status}', [TransactionController::class, 'status']);
                        // Plan
                        Route::group(
                            ['prefix' => 'plan'],
                            function () {
                                Route::get('add', [PlanPricingController::class, 'add_plan']);
                                Route::post('save_plan', [PlanPricingController::class, 'save_plan']);
                                Route::get('edit-{id}', [PlanPricingController::class, 'edit_plan']);
                                Route::post('update_plan-{id}', [PlanPricingController::class, 'update_plan']);
                                Route::get('status_change-{id}/{status}', [PlanPricingController::class, 'status_change']);
                                Route::get('/delete-{id}', [PlanPricingController::class, 'delete']);
                                Route::post('/updateimage', [PlanPricingController::class, 'updateimage']);
                                Route::post('/reorder_plan', [PlanPricingController::class, 'reorder_plan']);
                            }
                        );


                        // Users/Vendors
                        Route::group(
                            ['prefix' => 'users'],
                            function () {
                                Route::get('/', [VendorController::class, 'index']);
                                Route::get('add', [VendorController::class, 'add']);
                                Route::get('edit-{slug}', [VendorController::class, 'edit']);
                                Route::post('update-{slug}', [VendorController::class, 'update']);
                                Route::get('status-{slug}/{status}', [VendorController::class, 'status']);
                                Route::get('login-{slug}', [VendorController::class, 'vendor_login']);
                                Route::get('delete-{slug}', [VendorController::class, 'deletevendor']);
                            }
                        );




                        //features
                        Route::group(
                            ['prefix' => 'features'],
                            function () {
                                Route::get('/', [FeaturesController::class, 'index']);
                                Route::get('/add', [FeaturesController::class, 'add']);
                                Route::post('/save', [FeaturesController::class, 'save']);
                                Route::get('/edit-{id}', [FeaturesController::class, 'edit']);
                                Route::post('/update-{id}', [FeaturesController::class, 'update']);
                                Route::get('/delete-{id}', [FeaturesController::class, 'delete']);
                                Route::post('/reorder_features', [FeaturesController::class, 'reorder_features']);
                            }
                        );


                        // countries
                        Route::group(
                            ['prefix' => 'countries'],
                            function () {
                                Route::get('/', [OtherPagesController::class, 'countries']);
                                Route::get('/add', [OtherPagesController::class, 'add_country']);
                                Route::post('/save', [OtherPagesController::class, 'save_country']);
                                Route::get('/edit-{id}', [OtherPagesController::class, 'edit_country']);
                                Route::post('/update-{id}', [OtherPagesController::class, 'update_country']);
                                Route::get('/delete-{id}', [OtherPagesController::class, 'delete_country']);
                                Route::get('/change_status-{id}/{status}', [OtherPagesController::class, 'statuschange_country']);
                                Route::post('/reorder_country', [OtherPagesController::class, 'reorder_country']);
                            }
                        );

                        // city
                        Route::group(
                            ['prefix' => 'cities'],
                            function () {
                                Route::get('/', [OtherPagesController::class, 'cities']);
                                Route::get('/add', [OtherPagesController::class, 'add_city']);
                                Route::post('/save', [OtherPagesController::class, 'save_city']);
                                Route::get('/edit-{id}', [OtherPagesController::class, 'edit_city']);
                                Route::post('/update-{id}', [OtherPagesController::class, 'update_city']);
                                Route::get('/delete-{id}', [OtherPagesController::class, 'delete_city']);
                                Route::get('/change_status-{id}/{status}', [OtherPagesController::class, 'statuschange_city']);
                                Route::post('/reorder_area', [OtherPagesController::class, 'reorder_area']);
                            }
                        );

                        // promotional banner
                        Route::group(
                            ['prefix' => 'promotionalbanners'],
                            function () {
                                Route::get('/', [BannerController::class, 'promotional_banner']);
                                Route::get('add', [BannerController::class, 'promotional_banneradd']);
                                Route::get('edit-{id}', [BannerController::class, 'promotional_banneredit']);
                                Route::post('save', [BannerController::class, 'promotional_bannersave_banner']);
                                Route::post('update-{id}', [BannerController::class, 'promotional_bannerupdate']);
                                Route::get('delete-{id}', [BannerController::class, 'promotional_bannerdelete']);
                                Route::post('reorder_promotionalbanner', [BannerController::class, 'reorder_promotionalbanner']);
                            }
                        );

                        Route::post('/fun_fact/update', [WebSettingsController::class, 'fun_fact_update']);
                        Route::get('/fun_fact/delete-{id}', [WebSettingsController::class, 'fun_fact_delete']);

                        // theme
                        Route::get('/themes', [ThemeController::class, 'index']);
                        Route::get('themes/add', [ThemeController::class, 'add']);
                        Route::post('/themes/save', [ThemeController::class, 'save']);
                        Route::get('/themes/edit-{id}', [ThemeController::class, 'edit']);
                        Route::post('/themes/update-{id}', [ThemeController::class, 'update']);
                        Route::get('/themes/delete-{id}', [ThemeController::class, 'delete']);
                        Route::post('/themes/reorder_theme', [ThemeController::class, 'reorder_theme']);

                        Route::get('/how_it_works', [HowItWorkController::class, 'index']);
                        Route::get('/how_it_works/add', [HowItWorkController::class, 'add']);
                        Route::get('/how_it_works/edit-{id}', [HowItWorkController::class, 'edit']);
                        Route::post('/how_it_works/save', [HowItWorkController::class, 'save']);
                        Route::post('/how_it_works/update-{id}', [HowItWorkController::class, 'update']);
                        Route::get('/how_it_works/delete-{id}', [HowItWorkController::class, 'delete']);
                        Route::post('/how_it_works/reorder_how_work', [HowItWorkController::class, 'reorder_how_work']);
                    }
                );
                Route::middleware('VendorMiddleware')->group(
                    function () {
                        Route::get('settings/delete-banner', [VendorController::class, 'delete_viewall_page_image']);

                        Route::get('/deleteaccount-{id}', [VendorController::class, 'deleteaccount']);
                        // share
                        Route::get('share', [OtherPagesController::class, 'share']);

                        // Orders
                        Route::get('/report', [OrderController::class, 'index']);

                        Route::group(
                            ['prefix' => 'orders'],
                            function () {

                                Route::get('/', [OrderController::class, 'index']);
                                Route::get('/update-{id}-{status}-{type}', [OrderController::class, 'update']);
                                Route::post('/payment_status-{status}', [OrderController::class, 'payment_status']);
                            }
                        );
                         // Shipping-area
                        Route::group(
                            ['prefix' => 'shipping-area'],
                            function () {
                                Route::get('/', [ShippingareaController::class, 'index']);
                                Route::get('add', [ShippingareaController::class, 'add']);
                                Route::get('show-{id}', [ShippingareaController::class, 'show']);
                                Route::post('store', [ShippingareaController::class, 'store']);
                                Route::post('update-{id}', [ShippingareaController::class, 'store']);
                                Route::get('status-{id}-{status}', [ShippingareaController::class, 'status']);
                                Route::get('delete-{id}', [ShippingareaController::class, 'delete']);
                                Route::post('/reorder_shipping_area', [ShippingareaController::class, 'reorder_shipping_area']);
                            }
                        );
                        // Categories
                        Route::group(
                            ['prefix' => 'categories'],
                            function () {
                                Route::get('/', [CategoryController::class, 'index']);
                                Route::get('add', [CategoryController::class, 'add_category']);
                                Route::post('save', [CategoryController::class, 'save_category']);
                                Route::get('edit-{slug}', [CategoryController::class, 'edit_category']);
                                Route::post('update-{slug}', [CategoryController::class, 'update_category']);
                                Route::get('change_status-{slug}/{status}', [CategoryController::class, 'change_status']);
                                Route::get('delete-{slug}', [CategoryController::class, 'delete_category']);
                                Route::post('/reorder_category', [CategoryController::class, 'reorder_category']);
                            }
                        );
                        // Sub Categories
                        Route::group(
                            ['prefix' => 'sub-categories'],
                            function () {
                                Route::get('/', [SubCategoryController::class, 'index']);
                                Route::get('add', [SubCategoryController::class, 'add']);
                                Route::post('store', [SubCategoryController::class, 'store']);
                                Route::get('edit-{slug}', [SubCategoryController::class, 'edit']);
                                Route::post('update-{slug}', [SubCategoryController::class, 'update']);
                                Route::get('change_status-{slug}/{status}', [SubCategoryController::class, 'change_status']);
                                Route::get('delete-{slug}', [SubCategoryController::class, 'delete']);
                                Route::post('/reorder_category', [SubCategoryController::class, 'subcategory_reorder']);
                            }
                        );
                        // Products

                        Route::group(
                            ['prefix' => 'products'],
                            function () {
                                Route::get('/', [ProductController::class, 'index']);
                                Route::get('add', [ProductController::class, 'add']);
                                Route::post('save', [ProductController::class, 'save']);
                                Route::get('edit-{slug}', [ProductController::class, 'edit']);
                                Route::post('update-{slug}', [ProductController::class, 'update_product']);
                                Route::get('delete-{slug}', [ProductController::class, 'delete_product']);
                                Route::post('update', [ProductController::class, 'update_image']);
                                Route::get('delete_image-{id}/{service_id}', [ProductController::class, 'delete_image']);
                                Route::get('deletevariation-{id}-{product_id}', [ProductController::class, 'delete_variation']);
                                Route::post('add_image', [ProductController::class, 'add_image']);
                                Route::get('status_change-{slug}/{status}', [ProductController::class, 'status_change']);
                                Route::get('/top_deals-{slug}/{status}', [ProductController::class, 'top_deals']);
                                Route::get('subcategories', [ProductController::class, 'subcategories']);
                                Route::get('/import', [ProductController::class, 'import']);
                                Route::post('/reorder_category', [ProductController::class, 'reorder_category']);
                                Route::get('/review/delete-{id}', [ProductController::class, 'delete_review']);
                                Route::post('/product-variants-possibilities/{product_id}', [ProductController::class, 'getProductVariantsPossibilities']);
                                Route::get('/get-product-variants-possibilities', [ProductController::class, 'getProductVariantsPossibilities']);
                                Route::get('/variants/edit/{product_id}', [ProductController::class, 'productVariantsEdit']);
                                Route::post('/reorder_image-{product_id}', [ProductController::class, 'reorder_image']);
                                Route::get('delete/extras-{id}', [ProductController::class, 'delete_extras']);
                            }
                        );

                        // extras
                        Route::get('/getextras', [GlobalExtrasController::class, 'getextras']);
                        Route::get('/editgetextras-{id}', [GlobalExtrasController::class, 'editgetextras']);
                        Route::group(
                            ['prefix' => 'extras'],
                            function () {
                                Route::get('/', [GlobalExtrasController::class, 'index']);
                                Route::get('/add', [GlobalExtrasController::class, 'add']);
                                Route::post('/save', [GlobalExtrasController::class, 'save']);
                                Route::get('/edit-{id}', [GlobalExtrasController::class, 'edit']);
                                Route::post('/update-{id}', [GlobalExtrasController::class, 'update']);
                                Route::get('/change_status-{id}/{status}', [GlobalExtrasController::class, 'change_status']);
                                Route::get('delete-{id}', [GlobalExtrasController::class, 'delete']);
                                Route::post('/reorder_extras', [GlobalExtrasController::class, 'reorder_extras']);
                            }
                        );

                        // Plan
                        Route::group(
                            ['prefix' => 'plan'],
                            function () {
                                Route::get('selectplan-{id}', [PlanPricingController::class, 'select_plan']);
                                Route::post('buyplan', [PlanPricingController::class, 'buyplan']);
                                Route::any('buyplan/paymentsuccess/success', [PlanPricingController::class, 'success']);
                            }
                        );
                        // Banners
                        Route::group(
                            ['prefix' => 'bannersection-1'],
                            function () {
                                Route::get('/', [BannerController::class, 'index']);
                                Route::get('add', [BannerController::class, 'add']);
                                Route::get('edit-{id}', [BannerController::class, 'edit']);
                                Route::post('save', [BannerController::class, 'save_banner']);
                                Route::post('update-{id}', [BannerController::class, 'edit_banner']);
                                Route::get('status_change-{id}/{status}', [BannerController::class, 'status_update']);
                                Route::get('delete-{id}', [BannerController::class, 'delete']);
                                Route::post('reorder_banner', [BannerController::class, 'reorder_banner']);
                            }
                        );
                        Route::group(
                            ['prefix' => 'bannersection-2'],
                            function () {
                                Route::get('/', [BannerController::class, 'index']);
                                Route::get('add', [BannerController::class, 'add']);
                                Route::get('edit-{id}', [BannerController::class, 'edit']);
                                Route::post('save', [BannerController::class, 'save_banner']);
                                Route::post('update-{id}', [BannerController::class, 'edit_banner']);
                                Route::get('status_change-{id}/{status}', [BannerController::class, 'status_update']);
                                Route::get('delete-{id}', [BannerController::class, 'delete']);
                                Route::post('reorder_banner', [BannerController::class, 'reorder_banner']);
                            }
                        );
                        Route::group(
                            ['prefix' => 'bannersection-3'],
                            function () {
                                Route::get('/', [BannerController::class, 'index']);
                                Route::get('add', [BannerController::class, 'add']);
                                Route::get('edit-{id}', [BannerController::class, 'edit']);
                                Route::post('save', [BannerController::class, 'save_banner']);
                                Route::post('update-{id}', [BannerController::class, 'edit_banner']);
                                Route::get('status_change-{id}/{status}', [BannerController::class, 'status_update']);
                                Route::get('delete-{id}', [BannerController::class, 'delete']);
                                Route::post('reorder_banner', [BannerController::class, 'reorder_banner']);
                            }
                        );
                        Route::group(
                            ['prefix' => 'sliders'],
                            function () {
                                Route::get('/', [BannerController::class, 'index']);
                                Route::get('add', [BannerController::class, 'add']);
                                Route::get('edit-{id}', [BannerController::class, 'edit']);
                                Route::post('save', [BannerController::class, 'save_banner']);
                                Route::post('update-{id}', [BannerController::class, 'edit_banner']);
                                Route::get('status_change-{id}/{status}', [BannerController::class, 'status_update']);
                                Route::get('delete-{id}', [BannerController::class, 'delete']);
                                Route::post('reorder_banner', [BannerController::class, 'reorder_banner']);
                            }
                        );
                        Route::get('/whoweare', [WhoWeAreController::class, 'index']);
                        Route::get('/whoweare/add', [WhoWeAreController::class, 'add']);
                        Route::get('/whoweare/edit-{id}', [WhoWeAreController::class, 'edit']);
                        Route::post('/whoweare/savecontent', [WhoWeAreController::class, 'savecontent']);
                        Route::post('/whoweare/save', [WhoWeAreController::class, 'save']);
                        Route::post('/whoweare/update-{id}', [WhoWeAreController::class, 'update']);
                        Route::get('/whoweare/status_change-{id}/{status}', [WhoWeAreController::class, 'status_update']);
                        Route::get('/whoweare/delete-{id}', [WhoWeAreController::class, 'delete']);
                        Route::post('/whoweare/reorder_whoweare', [WhoWeAreController::class, 'reorder_whoweare']);

                        // Gallery
                        Route::get('/gallery', [GalleryController::class, 'index']);
                        Route::get('/gallery/add', [GalleryController::class, 'add']);
                        Route::post('/gallery/save', [GalleryController::class, 'save']);
                        Route::get('/gallery/edit-{id}', [GalleryController::class, 'edit']);
                        Route::post('/gallery/update-{id}', [GalleryController::class, 'update']);
                        Route::get('/gallery/delete-{id}', [GalleryController::class, 'delete']);
                        Route::post('/gallery/reorder_gallery', [GalleryController::class, 'reorder_gallery']);

                        Route::get('/top_deals', [TopdealsController::class, 'index']);
                        Route::post('/top_deals/update', [TopdealsController::class, 'top_deals']);
                        Route::get('/top_deals/delete-{id}', [TopdealsController::class, 'delete']);
                    }
                );
            }
        );
    });
}

//  ------------------------------- ----------- -----------------------------------------   //
//  -------------------------------  for Web/Front  -------------------------------------   //
//  ------------------------------- ----------- -----------------------------------------   //
Route::group(['namespace' => '', 'middleware' => 'landingMiddleware'], function () {
    if (@helper::appdata('')->landing_page == 1) {
        Route::get('/', [LandingHomeController::class, 'index']);
    }
    Route::post('/emailsubscribe', [LandingHomeController::class, 'emailsubscribe']);
    Route::post('/inquiry', [LandingHomeController::class, 'inquiry']);
    Route::get('/aboutus', [LandingHomeController::class, 'aboutus']);
    Route::get('/privacypolicy', [LandingHomeController::class, 'privacypolicy']);
    Route::get('/refund_policy', [LandingHomeController::class, 'refund_policy']);
    Route::get('/termscondition', [LandingHomeController::class, 'termscondition']);
    Route::get('/blogdetail-{slug}', [BlogController::class, 'pageblogdetail']);
    Route::get('/blogs', [BlogController::class, 'allblogs']);
    Route::get('/faqs', [LandingHomeController::class, 'faqs']);
    Route::get('/contact', [LandingHomeController::class, 'contact']);
    Route::get('/stores', [LandingHomeController::class, 'allstores']);
    Route::post('/getcity', [AdminController::class, 'getcity']);
    Route::get('/themeimages', [LandingHomeController::class, 'themeimages']);
});



Route::get('get-products-variant-quantity', [WebProductController::class, 'getProductsVariantQuantity']);
Route::post('changeqty', [WebProductController::class, 'changeqty']);
Route::post('cart/qtyupdate', [WebProductController::class, 'qtyupdate']);


Route::group(['namespace' => "web", 'prefix' => $prefix, 'middleware' => 'FrontMiddleware'], function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/categories', [HomeController::class, 'categories']);
    Route::get('/checkvendor', [HomeController::class, 'checkvendor']);

    Route::post('/managefavorite', [HomeController::class, 'managefavorite']);

    Route::get('/wallet', [WalletController::class, 'wallet']);
    Route::get('/addmoneywallet', [WalletController::class, 'addmoneywallet']);
    Route::post('/wallet/recharge', [WalletController::class, 'addwallet']);
    Route::any('/addwalletsuccess', [WalletController::class, 'addsuccess']);
    Route::any('/addfail', [WalletController::class, 'addfail']);
    // product-search-filter
    Route::get('/category', [WebProductController::class, 'category_wise_products']);
    Route::get('/categories-{category_slug}/subcategory-{subcategory_slug}', [WebProductController::class, 'category_wise_products']);
    Route::get('/products', [WebProductController::class, 'category_wise_products']);
    Route::get('/products-{type}', [WebProductController::class, 'category_wise_products']);
    Route::get('/products/{product_slug}', [WebProductController::class, 'productdetails']);
    Route::get('/topdeals', [WebProductController::class, 'alltopdeals']);
    // Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/clear', [CartController::class, 'clearcart']);
    Route::get('/cart/clear-{vid}', [CartController::class, 'clearcart']);

    Route::post('/cart/add', [CartController::class, 'addtocart']);
    // checkout-orders
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout/orderlimit', [CheckoutController::class, 'orderlimit']);
    Route::post('/placeorder', [CheckoutController::class, 'placeorder']);
    Route::post('/copycode', [CheckoutController::class, 'copycode']);

    // third party suucess route
    Route::any('/payment', [CheckoutController::class, 'paymentrequestsuccess']);
    // third party suucess route

    Route::get('/orders-success-{order_number}', [CheckoutController::class, 'ordersuccess']);
    Route::get('/find-order', [CheckoutController::class, 'orderdetails']);
    Route::get('/orders-cancel-{order_number}', [CheckoutController::class, 'cancelorder']);
    // other-pages

    Route::get('/contact-us', [WebOtherPagesController::class, 'contact_us']);
    Route::post('/contact-us/store', [WebOtherPagesController::class, 'contact_store']);
    Route::post('/subscribe', [WebOtherPagesController::class, 'subscribe']);

    // legal
    Route::get('/termscondition', [WebOtherPagesController::class, 'termscondition']);
    Route::get('/privacypolicy', [WebOtherPagesController::class, 'privacypolicy']);
    Route::get('/aboutus', [WebOtherPagesController::class, 'aboutus']);
    Route::get('/refund_policy', [WebOtherPagesController::class, 'refund_policy']);
    // Login Page
    Route::get('/login', [WebUserController::class, 'user_login']);
    Route::get('/register', [WebUserController::class, 'user_register']);
    Route::post('/checklogin-{logintype}', [WebUserController::class, 'check_login']);
    Route::post('/register_customer', [WebUserController::class, 'register_customer']);
    Route::get('/forgotpassword', [WebUserController::class, 'userforgotpassword']);
    Route::post('/send_userpassword', [WebUserController::class, 'send_userpassword']);
    Route::get('/logout', [WebUserController::class, 'logout']);
    Route::get('/deleteaccount', [WebUserController::class, 'deleteaccount']);
    Route::get('/deleteprofile', [WebUserController::class, 'deleteprofile']);

    //User profile
    Route::get('/profile', [WebUserController::class, 'my_profile']);
    Route::post('/editprofile', [WebUserController::class, 'edit_profile']);

    Route::get('/change-password', [WebUserController::class, 'changepassword']);
    Route::post('/updatepassword', [WebUserController::class, 'updatepassword']);
    Route::get('/orders', [WebUserController::class, 'orders']);
    Route::get('/favourite', [WebUserController::class, 'wishlist_product']);
    Route::get('/refer-earn', [WebUserController::class, 'referearn']);

    Route::get('/getproductdata', [WebProductController::class, 'getproductdata']);
    Route::get('/shop_all', [WebProductController::class, 'category_wise_products']);
    Route::get('/gallery', [WebOtherPagesController::class, 'gallery']);
    Route::post('/postreview', [WebProductController::class, 'postreview']);
    Route::get('/category', [WebProductController::class, 'category_wise_products']);
    Route::get('/faqs', [WebOtherPagesController::class, 'faqs']);
});

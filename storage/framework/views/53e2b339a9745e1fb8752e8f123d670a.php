<!doctype html>
<html lang="en" dir="<?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php if(request()->is(@$vendordata->slug . '/products/*')): ?>
        <meta property="og:title" content="<?php echo e(@$productdata->name); ?>" />
        <meta property="og:description" content="<?php echo e(strip_tags(substr($productdata->description, 0, 420))); ?>" />
        <meta property="og:image" content="<?php echo e(@helper::image_path($productdata['product_image']->image)); ?>" />
    <?php elseif(request()->is(@$vendordata->slug . '/blogs-*')): ?>
        <meta property="og:title" content="<?php echo e(@$blogdetails->title); ?>" />
        <meta property="og:description" content="<?php echo e(strip_tags(substr($blogdetails->description, 0, 420))); ?>" />
        <meta property="og:image" content="<?php echo e(@helper::image_path(@$blogdetails->image)); ?>" />
    <?php else: ?>
        <meta property="og:title" content="<?php echo e(@helper::appdata(@$vendordata->id)->meta_title); ?>" />
        <meta property="og:description" content="<?php echo e(@helper::appdata(@$vendordata->id)->meta_description); ?>" />
        <meta property="og:image" content='<?php echo e(helper::image_path(@helper::appdata(@$vendordata->id)->og_image)); ?>' />
    <?php endif; ?>
    <title><?php echo e(@helper::appdata(@$vendordata->id)->web_title); ?></title>
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/magnific_popup/magnific-popup.min.css')); ?>">
    <!-- magnific-popup -->
    <link rel="shortcut icon" href="<?php echo e(helper::image_path(helper::appdata(@$vendordata->id)->favicon)); ?>"
        type="image/x-icon"><!-- FAVICON ICON -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/bootstrap/bootstrap.min.css')); ?>" />
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/fontawesome/all.min.css')); ?>" />
    <!-- FONTAWESOME CSS -->
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/owl_carousel/owl.theme.default.min.css')); ?>" />
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/owl_carousel/owl.carousel.min.css')); ?>" />
    <!-- OWL CAROUSEL CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/jquery_ui/jquery-ui.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/sweetalert/sweetalert2.min.css')); ?>" />

    <!-- OWL CAROUSEL CSS animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- SWEETALERT CSS -->
    
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/datatables/dataTables.bootstrap5.min.css')); ?>">

    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/datatables/buttons.dataTables.min.css')); ?>">
    
    <!-- Image zoom CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/style.css')); ?>" /><!-- CUSTOM CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/responsive.css')); ?>" />
    <!-- RESPONSIVE CSS -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <!-- PWA  -->
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('pwa')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', $vendordata->id)->first();
                if ($user->allow_without_subscription == 1) {
                    $pwa = 1;
                } else {
                    $pwa = @$checkplan->pwa;
                }
            ?>
            <?php if($pwa == 1): ?>
                <?php if(helper::appdata($vendordata->id)->pwa == 1): ?>
                    <?php echo $__env->make('web.pwa.pwa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <?php if(@helper::checkaddons('pwa')): ?>
                <?php if(helper::appdata($vendordata->id)->pwa == 1): ?>
                    <?php echo $__env->make('web.pwa.pwa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('pixel')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', $vendordata->id)->first();
                if ($user->allow_without_subscription == 1) {
                    $pixel = 1;
                } else {
                    $pixel = @$checkplan->pixel;
                }
            ?>
            <?php if($pixel == 1): ?>
                <?php echo $__env->make('web.pixel.pixel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

        <?php endif; ?>
    <?php else: ?>
        <?php if(@helper::checkaddons('pixel')): ?>
            <?php echo $__env->make('web.pixel.pixel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
    <style>
        :root {
            --bs-primary: <?php echo e(@helper::appdata(@$vendordata->id)->primary_color); ?>;
            --bs-secondary: <?php echo e(@helper::appdata(@$vendordata->id)->secondary_color); ?>;
            --bs-primary-rgb: 22, 22, 46;
            --bs-secondary-rgb: <?php echo e(@helper::appdata($vendordata->id)->secondary_color . '10'); ?>;
        }

        /**/
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>

    <!-- pre-loader section -->
    <div id="loader-wrapper">
        <div id="loader">
        </div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

        <!-- Age Modal -->
        <?php if(@helper::checkaddons('age_verification')): ?>
            <?php echo $__env->make('web.age_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <!-- pre-loader section -->
    <main id="main-content" class="blur">
        <?php echo $__env->make('web.layout.common_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- NAVBAR AREA END -->
        <?php echo $__env->yieldContent('contents'); ?>


        <?php echo $__env->make('web.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <input type="hidden" name="currency" id="currency"
            value="<?php echo e(@helper::appdata(@$vendordata->id)->currency); ?>">
        <input type="hidden" name="currency_position" id="currency_position"
            value="<?php echo e(@helper::appdata(@$vendordata->id)->currency_position); ?>">
        <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </main>
    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 justify-content-between">
                    <h5 class="modal-title fs-5 text-dark fw-600">
                        <?php echo e(trans('labels.search')); ?>

                    </h5>
                    <a type="button" class="btn-close rounded-2 shadow-lg border m-0" data-bs-dismiss="modal"
                        aria-label="Close"></a>
                </div>
                <form class="" action="<?php echo e(URL::to(@$vendordata->slug . '/products')); ?>" method="GET">
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row align-items-center justify-content-between">
                                <div>
                                    <div class="search-content text-capitalize">

                                        <p class="fs-6 fw-600"><?php echo e(trans('labels.search_modal_title')); ?></p>
                                    </div>
                                    <input type="text" placeholder="Search Product..."
                                        class="py-2 w-100 px-2 my-2 border rounded-2" name="name"
                                        value="<?php echo e(isset($_GET['name']) ? $_GET['name'] : ''); ?>" required>
                                    <p class="text-truncate fs-7"><?php echo e(trans('labels.search_modal_description')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-3">
                        <div class="search-btn-group w-100 m-0">
                            <div class="row g-3 align-items-center">
                                <div class="col-6">
                                    <button type="button" class="btn fs-7 btn-danger w-100 rounded-0 m-0"
                                        data-bs-dismiss="modal"><?php echo e(trans('labels.cancel')); ?></button>
                                </div>
                                <div class="col-6">
                                    <button type="submit"
                                        class="btn btn-secondary w-100 rounded-0 fs-7 m-0"><?php echo e(trans('labels.submit')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php if(helper::appdata($vendordata->id)->subscribe_newsletter == 1): ?>
        <div class="modal fade" id="subsciptionmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-lights">
                <div class="modal-body p-md-0">
                    <div class="row align-items-center justify-content-around">
                        <div class="card rounded-4 border-0 bg-lights p-md-4">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="row align-items-center justify-content-between">
                                <div class="col-6 d-none d-lg-block">
                                    <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->subscribe_image)); ?>"
                                        alt="" class="w-100 object-fit-cover rounded-4">
                                </div>

                                <div class="col-lg-6 col-12">
                                    <h2 class="subscribe-title"><?php echo e(trans('labels.subscribe_title')); ?>

                                    </h2>
                                    <p class="text-dark fw-normal mb-4">
                                        <?php echo e(trans('labels.subscribe_subtitle')); ?>

                                    </p>
                                    <form action="<?php echo e(URL::to($vendordata->slug . '/subscribe')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="input-group mb-4">
                                            <input type="text"
                                                class="form-control border text-dark fw-500 rounded-0 bg-light"
                                                name="subscribe_email" placeholder="<?php echo e(trans('labels.email')); ?>"
                                                required="">
                                        </div>
                                        <button type="submit" class="btn btn-fashion w-100"
                                            id="basic-addon2"><?php echo e(trans('labels.subscribe')); ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- pro-view Modal -->
    <div class="modal fade" id="viewproduct-over" tabindex="-1" aria-labelledby="pro-view" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" id="viewproduct_body">

            </div>
        </div>
    </div>
    <!-- pro-view Modal -->

    <!-- Login Model Start -->
    <?php if(@helper::checkaddons('customer_login')): ?>
        <?php if(helper::appdata(@$vendordata->id)->checkout_login_required == 1): ?>
            <div class="modal fade" id="loginmodel" tabindex="-1" aria-labelledby="loginmodelLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between align-items-center">
                            <h2 class="text-start mb-0 text-dark fw-medium fs-4">Checkout as Guest</h2>
                            <button type="button" class="btn_close btn shadow m-0" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa-solid fa-xmark text-dark"></i>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            <p class="text-start mb-3 fs-7 text-dark">Don't have an account? Don't worry! You can
                                complete
                                your
                                checkout process as a guest & choose to create an account later</p>
                        </div>
                        <div class="modal-footer">
                            <div class="d-md-flex justify-content-between align-items-center w-100">

                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/login')); ?>"
                                    class="btn btn-fashion-outline w-100"><?php echo e(trans('labels.login_with_your_account')); ?></a>

                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>"
                                    class="btn btn-fashion w-100 mt-4 mt-md-0 <?php echo e(session()->get('direction') == 2 ? 'me-md-4' : 'ms-md-4'); ?>"><?php echo e(trans('labels.continue_as_guest')); ?></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Login Model End -->

    <!-- Modal Selected Addons Start-->
    <div class="modal fade" id="modal_selected_addons" tabindex="-1" aria-labelledby="selected_addons_Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title fs-5 text-dark fw-600" id="selected_addons_Label"></h5>
                    <a type="button" class="btn-close rounded-2 shadow-lg border m-0" data-bs-dismiss="modal"
                        aria-label="Close"></a>
                </div>
                <div class="modal-body extra-variation-modal">
                    <ul
                        class="list-group list-group-flush p-0 <?php echo e(session()->get('direction') == 2 ? 'text-right' : 'text-left'); ?>">
                    </ul>

                    <!-- Variants -->
                    <div class="p-12px">
                        <div id="item-variations">

                        </div>

                    </div>
                    <!-- Extras -->
                    <div id="item-extras" class="mt-3">
                        <h5 class="fw-normal m-0 d-none" id="extras_title"><?php echo e(trans('labels.extras')); ?> </h5>
                        <ul class="m-0 ps-2 fs-7">
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Selected Addons End-->

    <div class="modal fade" id="modalbankdetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalbankdetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title fw-600 text-dark" id="modalbankdetailsLabel">
                        <?php echo e(trans('labels.banktransfer')); ?></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to(@$vendordata->slug . '/placeorder')); ?>"
                    method="POST">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="modal_vendor_slug" id="modal_vendor_slug" class="form-control"
                            value="">
                        <input type="hidden" name="modal_user_name" id="modal_user_name" class="form-control"
                            value="">
                        <input type="hidden" name="modal_user_email" id="modal_user_email" class="form-control"
                            value="">
                        <input type="hidden" name="modal_user_mobile" id="modal_user_mobile" class="form-control"
                            value="">
                        <input type="hidden" name="modal_billing_address" id="modal_billing_address"
                            class="form-control" value="">
                        <input type="hidden" name="modal_billing_landmark" id="modal_billing_landmark"
                            class="form-control" value="">
                        <input type="hidden" name="modal_billing_postal_code" id="modal_billing_postal_code"
                            class="form-control" value="">
                        <input type="hidden" name="modal_billing_city" id="modal_billing_city" class="form-control"
                            value="">
                        <input type="hidden" name="modal_billing_state" id="modal_billing_state"
                            class="form-control" value="">
                        <input type="hidden" name="modal_billing_country" id="modal_billing_country"
                            class="form-control" value="">
                        <input type="hidden" name="modal_shipping_address" id="modal_shipping_address"
                            class="form-control" value="">
                        <input type="hidden" name="modal_shipping_landmark" id="modal_shipping_landmark"
                            class="form-control" value="">
                        <input type="hidden" name="modal_postal_code" id="modal_postal_code" class="form-control"
                            value="">
                        <input type="hidden" name="modal_shipping_city" id="modal_shipping_city"
                            class="form-control" value="">
                        <input type="hidden" name="modal_shipping_state" id="modal_shipping_state"
                            class="form-control" value="">
                        <input type="hidden" name="modal_shipping_country" id="modal_shipping_country"
                            class="form-control" value="">
                        <input type="hidden" name="modal_shipping_area" id="modal_shipping_area"
                            class="form-control" value="">
                        <input type="hidden" name="modal_delivery_charge" id="modal_delivery_charge"
                            class="form-control" value="">
                        <input type="hidden" name="modal_grand_total" id="modal_grand_total" class="form-control"
                            value="">
                        <input type="hidden" name="modal_sub_total" id="modal_sub_total" class="form-control"
                            value="">
                        <input type="hidden" name="modal_tax" id="modal_tax" class="form-control" value="">
                        <input type="hidden" name="modal_tax_name" id="modal_tax_name" class="form-control"
                            value="">
                        <input type="hidden" name="modal_notes" id="modal_notes" class="form-control"
                            value="">
                        <input type="hidden" name="modal_offer_code" id="modal_offer_code" class="form-control"
                            value="">
                        <input type="hidden" name="modal_offer_amount" id="modal_offer_amount" class="form-control"
                            value="">
                        <input type="hidden" name="modal_transaction_type" id="modal_transaction_type"
                            class="form-control" value="">

                        <p><?php echo e(trans('labels.payment_description')); ?></p>
                        <hr>
                        <p id="modal_payment_description"></p>
                        <hr>
                        <div class="form-group col-md-12">
                            <label for="screenshot"> <?php echo e(trans('labels.screenshot')); ?> </label>
                            <div class="controls">
                                <input type="file" name="screenshot" id="screenshot"
                                    class="form-control  <?php $__errorArgs = ['screenshot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['screenshot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"> <?php echo e($message); ?> </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer gap-2">
                        <button type="button" class="btn btn-danger fs-7 m-0"
                            data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                        <button
                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" type="submit" <?php endif; ?>
                            class="btn btn-secondary fs-7 m-0"> <?php echo e(trans('labels.save')); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/jquery/jquery.min.js')); ?>"></script><!-- JQUERY JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/jquery_ui/jquery-ui.min.js')); ?>"></script><!-- JQUERY UI JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- BOOTSTRAP JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/owl_carousel/owl.carousel.js')); ?>"></script><!-- OWL CAROUSEL JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/sweetalert/sweetalert2.min.js')); ?>"></script><!-- SWEETALERT JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/jquery.dataTables.min.js')); ?>"></script><!-- Datatables JS -->

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/dataTables.bootstrap5.min.js')); ?>"></script><!-- Datatables Bootstrap5 JS -->

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/dataTables.buttons.min.js')); ?>"></script><!-- Datatables Buttons JS -->

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/jszip.min.js')); ?>"></script><!-- Datatables Excel Buttons JS -->

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/pdfmake.min.js')); ?>"></script><!-- Datatables Make PDF Buttons JS -->

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/vfs_fonts.js')); ?>"></script><!-- Datatables Export PDF Buttons JS -->

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/datatables/buttons.html5.min.js')); ?>"></script><!-- Datatables Buttons HTML5 JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/jquery.number.min.js')); ?>"></script>
    <?php if(@helper::checkaddons('age_verification')): ?>
        <?php if(@helper::getagedetails($vendordata->id)->age_verification_on_off == 1): ?>
            <script src="<?php echo e(url('resources/js/age.js')); ?>"></script>
        <?php else: ?>
            <script>
                $('#main-content').removeClass('blur');
            </script>
        <?php endif; ?>
    <?php else: ?>
        <script>
            $('#main-content').removeClass('blur');
        </script>
    <?php endif; ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/magnific_popup/jquery.magnific-popup.min.js')); ?>"></script><!-- Magnific Popup core JS file -->
    <script>
        // Magnific-popup for ZOOM after click current image
        $(".gallery .images__link").magnificPopup({
            type: "image",
            gallery: {
                enabled: true,
                tCounter: "%curr% of %total%"
            },
            removalDelay: 300,
            mainClass: "mfp-fade"
        });

        // Modify checked preview
        $(".gallery .preview__link").on("click", function() {
            $(".gallery .preview__link").removeClass("checked");
            $(this).addClass("checked");
        });
    </script>
    <script>
        // Modify checked preview
        $("#preview__link").on("click", function() {
            $(".modal-preview .preview__link").removeClass("checked");
            $(this).addClass("checked");
        });
    </script>
    <script>
        let rtl = "<?php echo e(session()->get('direction') == 2 ? '2' : '1'); ?>";
        let are_you_sure = "<?php echo e(trans('messages.are_you_sure')); ?>";
        let yes = "<?php echo e(trans('messages.yes')); ?>";
        let no = "<?php echo e(trans('messages.no')); ?>";
        let wrong = "<?php echo e(trans('messages.wrong')); ?>";
        var formate = "<?php echo e(helper::appdata($vendordata->id)->currency_formate); ?>";

        // top deals parameter
        var start_date = "<?php echo e(@$topdeals->start_date); ?>";
        var start_time = "<?php echo e(@$topdeals->start_time); ?>";
        var end_date = "<?php echo e(@$topdeals->end_date); ?>";
        var end_time = "<?php echo e(@$topdeals->end_time); ?>";
        var topdeals = "<?php echo e(!empty($topdealsproducts) ? 1 : 0); ?>";
        var time_zone = "<?php echo e(helper::appdata($vendordata->id)->timezone); ?>";
        var current_date = "<?php echo e(\Carbon\Carbon::now()->toDateString()); ?>";
        var deal_type = "<?php echo e(@$topdeals->deal_type); ?>";
        // top deals parameter
    </script>

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/customsweetalert.js')); ?>"></script><!-- CUSTOM JS -->
    <script>
        <?php if(Session::has('success')): ?>
            showtoast('success', "<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            showtoast('error', "<?php echo e(session('error')); ?>");
        <?php endif; ?>

        var is_logedin = "<?php echo e(@Auth::user()->type == 3 ? 1 : 2); ?>";
        loginurl = "<?php echo e(URL::to($vendordata->slug . '/login')); ?>";
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/custom.js')); ?>"></script><!-- CUSTOM JS -->

    <!-- Google tag (gtag.js) -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(helper::appdata(1)->tracking_id); ?>"></script>


    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?php echo e(helper::appdata(1)->tracking_id); ?>');
    </script>
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('pwa')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', $vendordata->id)->first();
                if ($user->allow_without_subscription == 1) {
                    $pwa = 1;
                } else {
                    $pwa = @$checkplan->pwa;
                }
            ?>
            <?php if($pwa == 1): ?>
                <script src="<?php echo e(url('storage/app/public/sw.js')); ?>"></script>
                <script>
                    if (!navigator.serviceWorker.controller) {
                        navigator.serviceWorker.register("<?php echo e(url('storage/app/public/sw.js')); ?>").then(function(reg) {
                            console.log("Service worker has been registered for scope: " + reg.scope);
                        });
                    }
                </script>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if(@helper::checkaddons('pwa')): ?>
            <script src="<?php echo e(url('storage/app/public/sw.js')); ?>"></script>
            <script>
                if (!navigator.serviceWorker.controller) {
                    navigator.serviceWorker.register("<?php echo e(url('storage/app/public/sw.js')); ?>").then(function(reg) {
                        console.log("Service worker has been registered for scope: " + reg.scope);
                    });
                }
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <script>
        $('#close-btn').click(function() {
            $('.pwa').addClass('d-none');
        });

        let deferredPrompt = null;
        window.addEventListener('beforeinstallprompt', (e) => {
            $('.mobile_drop_down').show();
            deferredPrompt = e;
        });
        if (window.matchMedia('(display-mode: standalone)').matches) {
            // If the app is installed, hide the install button or popup
            $('.pwa').addClass('d-none');
        } else {
            const mobile_install_app = document.getElementById('mobile-install-app');
            if (mobile_install_app != null) {
                mobile_install_app.addEventListener('click', async () => {
                    if (deferredPrompt !== null) {
                        deferredPrompt.prompt();
                        const {
                            outcome
                        } = await deferredPrompt.userChoice;
                        if (outcome === 'accepted') {
                            deferredPrompt = null;
                        }
                    }
                });
            }
        }

        var nexturl = "<?php echo e(URL::to($vendordata->slug . '/getproductdata')); ?>";
        var ratting = "<?php echo e(number_format(0, 1)); ?>";
        var totalratting = "<?php echo e(trans('labels.ratting')); ?>";
        var carturl = "<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>";
        var fullviewurl = "<?php echo e(URL::to(@$vendordata->slug . '/products/')); ?>";
        var checkouturl = "<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>";
        var reviewshow = 0;
        if ("<?php echo e(helper::appdata($vendordata->id)->product_ratting_switch); ?>" == 1) {
            reviewshow = 1;
        }
    </script>


    <!------ whatsapp_icon ------>
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('whatsapp_message')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', $vendordata->id)->first();
                if (@$user->allow_without_subscription == 1) {
                    $whatsapp_message = 1;
                } else {
                    $whatsapp_message = @$checkplan->whatsapp_message;
                }

            ?>
            <?php if($whatsapp_message == 1 && helper::appdata($vendordata->id)->whatsapp_chat_on_off == 1): ?>
                <input type="checkbox" id="check">
                <label
                    class="chat-btn <?php echo e(helper::appdata($vendordata->id)->whatsapp_chat_position == 1 ? 'chat-btn_rtl' : 'chat-btn_ltr'); ?>"
                    for="check">
                    <i class="fa-brands fa-whatsapp comment"></i>
                    <i class="fa fa-close close"></i>
                </label>

                <div
                    class="shadow <?php echo e(helper::appdata($vendordata->id)->whatsapp_chat_position == 1 ? 'wrapper_rtl' : 'wrapper'); ?>">
                    <div class="msg_header">
                        <h6><?php echo e(helper::appdata(@$vendordata->id)->web_title); ?></h6>
                    </div>

                    <div class="text-start p-3 bg-msg">
                        <div class="card p-2 msg d-inline-block fs-7">
                            <?php echo e(trans('labels.how_can_help_you')); ?>

                        </div>
                    </div>

                    <div class="chat-form">

                        <form action="https://api.whatsapp.com/send" method="get" target="_blank"
                            class="d-flex align-items-center d-grid gap-2">
                            <textarea class="form-control m-0" name="text" placeholder="<?php echo e(trans('messages.your_text_message')); ?>"
                                cols="30" rows="10" required></textarea>
                            <input type="hidden" name="phone"
                                value="<?php echo e(helper::appdata($vendordata->id)->whatsapp_number); ?>">
                            <button type="submit" class="btn btn-whatsapp btn-block m-0">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>

                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if(@helper::checkaddons('whatsapp_message')): ?>
            <?php if(helper::appdata($vendordata->id)->whatsapp_chat_on_off == 1): ?>
                <input type="checkbox" id="check">
                <label
                    class="chat-btn <?php echo e(helper::appdata($vendordata->id)->whatsapp_chat_position == 1 ? 'chat-btn_rtl' : 'chat-btn_ltr'); ?>"
                    for="check">
                    <i class="fa-brands fa-whatsapp comment"></i>
                    <i class="fa fa-close close"></i>
                </label>

                <div
                    class="shadow <?php echo e(helper::appdata($vendordata->id)->whatsapp_chat_position == 1 ? 'wrapper_rtl' : 'wrapper'); ?>">
                    <div class="msg_header">
                        <h6><?php echo e(helper::appdata(@$vendordata->id)->web_title); ?></h6>
                    </div>

                    <div class="text-start p-3 bg-msg">
                        <div class="card p-2 msg d-inline-block fs-7">
                            <?php echo e(trans('labels.how_can_help_you')); ?>

                        </div>
                    </div>

                    <div class="chat-form">
                        <form action="https://api.whatsapp.com/send" method="get" target="_blank"
                            class="d-flex align-items-center d-grid gap-2">
                            <textarea class="form-control m-0" name="text" placeholder="<?php echo e(trans('messages.your_text_message')); ?>"
                                cols="30" rows="10" required></textarea>
                            <input type="hidden" name="phone"
                                value="<?php echo e(helper::appdata($vendordata->id)->whatsapp_number); ?>">
                            <button type="submit" class="btn btn-whatsapp btn-block m-0">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(@helper::checkaddons('tawk_addons')): ?>
        <!--Start of Tawk.to Script-->
        <?php if(helper::appdata($vendordata->id)->tawk_on_off == 1): ?>
            <?php echo helper::appdata($vendordata->id)->tawk_widget_id; ?>

        <?php endif; ?>
    <?php endif; ?>
    <!--End of Tawk.to Script-->
    <?php if(@helper::checkaddons('wizz_chat')): ?>
        <?php if(helper::appdata($vendordata->id)->wizz_chat_on_off == 1): ?>
            <!-- Wizz Chat -->
            <?php echo helper::appdata($vendordata->id)->wizz_chat_settings; ?>

        <?php endif; ?>
    <?php endif; ?>

    <!-- Quick call -->
    <?php if(@helper::checkaddons('quick_call')): ?>
        <?php if(@helper::appdata($vendordata->id)->quick_call == 1): ?>
            <?php echo $__env->make('web.quick_call', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(@helper::checkaddons('sales_notification')): ?>
        <?php echo $__env->make('web.sales_notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <script>
        function productview(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: nexturl,
                method: "get",
                data: {
                    id: id,
                },
                success: function(response) {
                    $('#viewproduct_body').html(response.output);
                    $('#viewproduct-over').modal('show');
                },
                error: function(data) {
                    return false;
                }
            });

        }

        function currency_formate(price) {

            if ("<?php echo e(@helper::appdata($vendordata->id)->currency_position); ?>" == "1") {

                if ("<?php echo e(helper::appdata($vendordata->id)->decimal_separator); ?>" == 1) {
                    var oldprice = $.number(price, formate);
                    if ("<?php echo e(@helper::appdata($vendordata->id)->currency_space); ?>" == 1) {
                        newprice = "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>" + ' ' + oldprice;
                    } else {
                        newprice = "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>" + oldprice;
                    }

                } else {
                    var oldprice = $.number(price, formate, ',', '.');
                    if ("<?php echo e(@helper::appdata($vendordata->id)->currency_space); ?>" == 1) {
                        newprice = "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>" + ' ' + oldprice;
                    } else {

                        newprice = "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>" + oldprice;
                    }
                }
                return newprice;
            } else {
                if ("<?php echo e(helper::appdata($vendordata->id)->decimal_separator); ?>" == 1) {
                    var oldprice = $.number(price, formate);
                    if ("<?php echo e(@helper::appdata($vendordata->id)->currency_space); ?>" == 1) {
                        newprice = oldprice + ' ' + "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>";
                    } else {
                        newprice = oldprice + "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>";
                    }

                } else {
                    var oldprice = $.number(price, formate, ',', '.');
                    if ("<?php echo e(@helper::appdata($vendordata->id)->currency_space); ?>" == 1) {
                        newprice = oldprice + ' ' + "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>";
                    } else {
                        newprice = oldprice + "<?php echo e(@helper::appdata($vendordata->id)->currency); ?>";
                    }
                }
                return newprice;
            }
        }
    </script>
    <?php if(@helper::checkaddons('sales_notification')): ?>
        <?php if(helper::appdata($vendordata->id)->fake_sales_notification == 1): ?>
            <script>
                if ("<?php echo e(@helper::appdata($vendordata->id)->fake_sales_notification); ?>" == "1") {
                    // Select the element with the ID 'sales-booster-popup'
                    const popup = document.getElementById('sales-booster-popup');

                    if (popup) {
                        // Define a function to add and remove the 'loaded' class
                        let isMouseOver = false;
                        const toggleLoadedClass = () => {
                            // Add the 'loaded' class
                            popup.classList.add('loaded');
                            // Remove the 'loaded' class after 5 seconds, unless the mouse is over the popup
                            setTimeout(() => {
                                    if (!isMouseOver) {
                                        popup.classList.remove('loaded');
                                    }
                                },
                                "<?php echo e(helper::appdata($vendordata->id)->notification_display_time); ?>"
                            ); // 4000 milliseconds = 4 seconds for demo purposes
                        };

                        // Function to handle mouseover event
                        const handleMouseOver = () => {
                            isMouseOver = true;
                            // You can perform actions here when mouse is over the popup
                        };

                        // Function to handle mouseout event
                        const handleMouseOut = () => {
                            isMouseOver = false;
                        };

                        // Call the function initially
                        toggleLoadedClass();

                        setInterval(function() {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: "<?php echo e(URL::to('get_notification_data')); ?>",

                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        vendor_id: "<?php echo e($vendordata->id); ?>",
                                    },
                                    success: function(response) {
                                        toggleLoadedClass();
                                        $('#sales-booster-popup').show();
                                        $('#notification_body').html(response.output);
                                    },
                                });
                            },
                            "<?php echo e(helper::appdata($vendordata->id)->notification_display_time + helper::appdata($vendordata->id)->next_time_popup); ?>"
                        ); // 8000 milliseconds = 8 seconds

                        // Add mouseover and mouseout event listeners to the popup
                        popup.addEventListener('mouseover', handleMouseOver);
                        popup.addEventListener('mouseout', handleMouseOut);

                        // Select the close button within the popup
                        const closeButton = popup.querySelector('.close'); // Close button selector

                        if (closeButton) {
                            // Add an event listener to the close button
                            closeButton.addEventListener('click', () => {
                                // Remove the 'loaded' class immediately
                                popup.classList.remove('loaded');
                            });
                        }
                    }
                }
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/layout/default.blade.php ENDPATH**/ ?>
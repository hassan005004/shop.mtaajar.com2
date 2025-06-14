<!DOCTYPE html>
<html lang="en" dir="<?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="<?php echo e(@helper::appdata(@$vendordata->id)->meta_title); ?>" />
    <meta property="og:description" content="<?php echo e(@helper::appdata(@$vendordata->id)->meta_description); ?>" />
    <meta property="og:image" content='<?php echo e(helper::image_path(@helper::appdata(@$vendordata->id)->og_image)); ?>' />
    <title><?php echo e(@helper::appdata(@$vendordata->id)->web_title); ?></title>
    <link rel="shortcut icon" href="<?php echo e(helper::image_path(helper::appdata(@$vendordata->id)->favicon)); ?>"
        type="image/x-icon"><!-- FAVICON ICON -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/bootstrap/bootstrap.min.css')); ?>" />
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/fontawesome/all.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/jquery_ui/jquery-ui.min.css')); ?>" />
    
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/datatables/dataTables.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/style.css')); ?>" /><!-- CUSTOM CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/css/responsive.css')); ?>" />
    <!-- RESPONSIVE CSS -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <style>
        :root {
            --bs-primary: <?php echo e(@helper::appdata(@$vendordata->id)->primary_color); ?>;
            --bs-secondary: <?php echo e(@helper::appdata(@$vendordata->id)->secondary_color); ?>;
            --bs-primary-rgb: 22, 22, 46;
            --bs-secondary-rgb: <?php echo e(@helper::appdata($vendordata->id)->secondary_color . '10'); ?>;
        }

        /**/
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <!-- pre-loader section -->
    <div id="loader-wrapper">
        <div id="loader">
        </div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    <!-- ORDER SUCCESS AREA START -->

    <div class="order-success">

        <div class="order-trecking-sec">

            <div class="container">

                <div class="order-success-img">
                    <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->order_success_image)); ?>"
                        alt="" class="logo-image">
                </div>

                <h3 class="order-title fw-600"><?php echo e(trans('labels.order_successfully_placed')); ?></h3>

                <div class="input-group mb-5">

                    <input type="text"
                        value="<?php echo e(URL::to(@$vendordata->slug . '/find-order?order=' . $order_number)); ?>" id="myInput"
                        class="form-control rounded-0 <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'ms-2' : 'me-2'); ?>"
                        readonly>

                    <button onclick="copyText('<?php echo e(trans('labels.copied')); ?>')" class="btn btn-fashion w-25 mb-0">

                        <span class="tooltiptext" id="myTooltip"><?php echo e(trans('labels.copy')); ?></span>

                    </button>

                </div>
                <a href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>" class="btn btn-fashion mb-3 py-3 w-100-m"><i
                        class="fa-regular fa-bag-shopping mx-1"></i> <?php echo e(trans('labels.continue_shopping')); ?> </a>

                <a class="btn btn-dark mb-3 py-3 w-100-m"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/find-order?order=' . $order_number)); ?>"><i
                        class="fa-regular fa-circle-check"></i> <?php echo e(trans('labels.track_order')); ?> </a>
                <?php if(@helper::checkaddons('subscription')): ?>
                    <?php if(@helper::checkaddons('whatsapp_message')): ?>
                        <?php
                            $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                ->orderByDesc('id')
                                ->first();
                            $user = App\Models\User::where('id', $vendordata->id)->first();
                            if ($user->allow_without_subscription == 1) {
                                $whatsapp_message = 1;
                            } else {
                                $whatsapp_message = @$checkplan->whatsapp_message;
                            }

                        ?>
                        <?php if($whatsapp_message == 1): ?>
                            <a href="https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata(@$vendordata->id)->whatsapp_number); ?>&text=<?php echo e($whmessage); ?>"
                                class="btn btn-whatsapp btn-fashion-outline mb-3 py-3 w-100-m" target="_blank"><i
                                    class="fab fa-whatsapp me-1"></i><?php echo e(trans('labels.whatsapp_message')); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(@helper::checkaddons('whatsapp_message')): ?>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata(@$vendordata->id)->whatsapp_number); ?>&text=<?php echo e($whmessage); ?>"
                            class="btn btn-whatsapp btn-fashion-outline mb-3 py-3 w-100-m" target="_blank"><i
                                class="fab fa-whatsapp me-1"></i><?php echo e(trans('labels.whatsapp_message')); ?></a>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(@helper::checkaddons('subscription')): ?>
                    <?php if(@helper::checkaddons('telegram_message')): ?>
                        <?php
                            $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                ->orderByDesc('id')
                                ->first();
                            $user = App\Models\User::where('id', $vendordata->id)->first();
                            if ($user->allow_without_subscription == 1) {
                                $telegram_message = 1;
                            } else {
                                $telegram_message = @$checkplan->telegram_message;
                            }
                        ?>
                        <?php if($telegram_message == 1): ?>
                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/telegram/' . $order_number . '')); ?>"
                                class="btn btn-telegram btn-fashion-outline mb-3 py-3 w-100-m"><i
                                    class="fab fa-telegram me-1"></i><?php echo e(trans('labels.telegram_message')); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(@helper::checkaddons('telegram_message')): ?>
                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/telegram/' . $order_number . '')); ?>"
                            class="btn btn-telegram btn-fashion-outline mb-3 py-3 w-100-m"><i
                                class="fab fa-telegram me-1"></i><?php echo e(trans('labels.telegram_message')); ?></a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>


        </div>

    </div>

    <!-- ORDER SUCCESS AREA END -->


    <!--- script --->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/jquery/jquery.min.js')); ?>"></script><!-- JQUERY JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- BOOTSTRAP JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/custom.js')); ?>"></script><!-- CUSTOM JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/orders.js')); ?>"></script><!-- orders JS -->
    <!--- script --->

</body>

</html>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/orders/success.blade.php ENDPATH**/ ?>
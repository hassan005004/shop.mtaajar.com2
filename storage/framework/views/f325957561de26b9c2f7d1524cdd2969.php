<?php $__env->startSection('contents'); ?>
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/social-sharing/css/socialsharing.css')); ?>">
    <!------ breadcrumb ------>
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                        aria-current="page"><?php echo e(trans('labels.refer_earn')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <!------ breadcrumb ------>
    <section class="product-prev-sec product-list-sec">
        <div class="container my-5">
            <div class="user-bg-color mb-4">
                <div class="row">
                    <?php echo $__env->make('web.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-lg-9 col-xxl-9 col-12">
                        <div class="card p-3">
                            <h5 class="text-dark m-0 mb-3 border-bottom pb-3 profile-title"><?php echo e(trans('labels.refer_earn')); ?>

                            </h5>
                            <div class="card-body user-content-wrapper">
                                <div class="d-flex flex-column align-items-center w-100">
                                    <img class="mb-4 refer-img w-100"
                                        src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->referral_image)); ?>">
                                    <h5 class="text-uppercase"><?php echo e(trans('labels.refer_earn')); ?></h5>
                                    <p class="fs-7 text-center text-muted"><?php echo e(trans('labels.refer_note_1')); ?>

                                        <?php echo e(helper::currency_formate(@helper::appdata($vendordata->id)->referral_amount, $vendordata->id)); ?>

                                        <?php echo e(trans('labels.refer_note_2')); ?></p>
                                    <div class="col-sm-9 col-12">
                                        <input type="url" class="form-control my-3 ref-padding bg-body-secondary"
                                            id="data"
                                            value="<?php echo e(URL::to($vendordata->slug . '/register?referral=' . Auth::user()->referral_code)); ?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="sharing-section d-flex align-items-center justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/social-sharing/js/socialsharing.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/referearn.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/user/referearn.blade.php ENDPATH**/ ?>
<?php $__env->startSection('contents'); ?>
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li
                        class="<?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                        <a class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                        aria-current="page"><?php echo e(trans('labels.orders')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <div class="row">
                <?php echo $__env->make('web.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-lg-9 col-xxl-9">
                    <div class="border p-3 rounded table-box">

                            <h5 class="text-dark m-0 mb-3 pb-3 border-bottom profile-title"><?php echo e(trans('labels.orders')); ?></h5>
                        <div class="col-12 p-3 rounded-3 mb-3 bg-section-gray">
                            <div class="row g-3 align-items-center table-top-box">
                                <a href="<?php echo e(URL::to($vendordata->slug . '/orders?type=allOrders')); ?>" class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <button type='button'
                                        class="btn border rounded m-0 p-3 w-100 <?php echo e(app('request')->input('type') == 'allOrders' ? 'bg-white text-dark' : 'text-dark bg-transparent'); ?>">
                                        <span class='all-icon  d-flex justify-content-center gap-2 align-items-center'>
                                            <p class='m-0 p-0 fw-500 fs-15'><?php echo e(trans('labels.all_orders')); ?></p>
                                            <p
                                                class='text-start-pro m-0 p-0 <?php echo e(app('request')->input('type') == 'allOrders' ? 'text-white bg-dark' : 'text-dark'); ?>'>
                                                <?php echo e($totalprocessing); ?></p>

                                        </span>
                                    </button>
                                </a>
                                <a href="<?php echo e(URL::to($vendordata->slug . '/orders?type=processing')); ?>" class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <button type='button'
                                        class="btn border m-0 rounded p-3 w-100 <?php echo e(app('request')->input('type') == 'processing' ? 'bg-white text-dark' : 'text-dark bg-transparent'); ?>">
                                        <span class='warning-icon d-flex justify-content-center gap-2 align-items-center'>
                                            <p class='m-0 p-0 fw-500 fs-15'><?php echo e(trans('labels.preparing')); ?></p>
                                            <p
                                                class='text-start-pro m-0 p-0 <?php echo e(app('request')->input('type') == 'processing' ? 'text-white bg-dark' : 'text-dark'); ?>'>
                                                <?php echo e($totalprocessing); ?>

                                            </p>

                                        </span>
                                    </button>
                                </a>
                                <a href="<?php echo e(URL::to($vendordata->slug . '/orders?type=completed')); ?>" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 delivered-box">
                                    <button type='button'
                                        class="btn border m-0 rounded p-3 w-100 <?php echo e(app('request')->input('type') == 'completed' ? 'bg-white text-dark' : 'text-dark bg-transparent'); ?>">
                                        <span class='success-icon d-flex justify-content-center gap-2 align-items-center'>

                                            <p class='m-0 p-0 fw-500 fs-15'><?php echo e(trans('labels.delivered')); ?></p>
                                            <p
                                                class='text-start-pro m-0 p-0 <?php echo e(app('request')->input('type') == 'completed' ? 'text-white bg-dark' : 'text-dark'); ?>'>
                                                <?php echo e($totalcompleted); ?></p>

                                        </span>
                                    </button>
                                </a>
                                <a href="<?php echo e(URL::to($vendordata->slug . '/orders?type=rejected')); ?>" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 rejected-box">
                                    <button type='button'
                                        class="btn border m-0 rounded p-3 w-100 <?php echo e(app('request')->input('type') == 'rejected' ? 'bg-white text-dark' : 'text-dark bg-transparent'); ?>">
                                        <span class='danger-icon d-flex justify-content-center gap-2 align-items-center'>
                                            <p class='m-0 p-0 fw-500 fs-15'><?php echo e(trans('labels.rejected')); ?></p>
                                            <p
                                                class='text-start-pro m-0 p-0 <?php echo e(app('request')->input('type') == 'rejected' ? 'text-white bg-dark' : 'text-dark'); ?>'>
                                                <?php echo e($totalrejected); ?></p>

                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="row row-cols-xl-2 row-cols-1 g-3 pb-1">
                            <?php $i = 1; ?>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col">
                                    <div class="card border-1 rounded-3 px-0">
                                        <div class="card-body p-sm-4 p-2">
                                            <div class="row g-2">
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <div class="fw-600 fs-7">#<?php echo e($orderdata->order_number); ?></div>
                                                    <div class="fs-8 fw-500">
                                                        <?php echo e(helper::date_formate($orderdata->created_at, $orderdata->vendor_id)); ?>

                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <div class="d-flex ">

                                                        <div class="fs-7 fw-500"><?php echo e(trans('labels.grand_total')); ?> :</div>
                                                        <div class="mx-1 fs-7 fw-600">
                                                            <?php echo e(helper::currency_formate($orderdata->grand_total, $orderdata->vendor_id)); ?>

                                                        </div>
                                                    </div>
                                                    <div class="fs-7 fw-500">
                                                        <?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $orderdata->vendor_id)->name); ?>


                                                    </div>
                                                </div>

                                                <div class="d-sm-flex flex-wrap justify-content-between align-items-center">
                                                    <div class="d-flex">
                                                        <div class="fs-7 fw-500"><?php echo e(trans('labels.payment_type')); ?>:</div>
                                                        <div class="fw-600 fs-7 mx-1">
                                                            <?php if($orderdata->transaction_type == 6): ?>
                                                                <?php echo e(@helper::getpayment($orderdata->transaction_type, $orderdata->vendor_id)->payment_name); ?>

                                                                : <small><a
                                                                        href="<?php echo e(helper::image_path($orderdata->screenshot)); ?>"
                                                                        target="_blank"
                                                                        class="text-danger"><?php echo e(trans('labels.click_here')); ?></a></small>
                                                            <?php else: ?>
                                                                <?php echo e(@helper::getpayment($orderdata->transaction_type, $orderdata->vendor_id)->payment_name); ?>

                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <div class="mt-sm-0 mt-2">
                                                        <a class="btn btn-sm rounded-0 btn-secondary eye-icon-box px-3"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/find-order?order=' . $orderdata->order_number)); ?>">
                                                            <p class="fs-7"><?php echo e(trans('labels.detail')); ?></p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/user/orders.blade.php ENDPATH**/ ?>
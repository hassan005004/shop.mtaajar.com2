
<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->

    <section class="py-4 mb-4 bg-light">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
    
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a class="text-dark fw-600" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a></li>
    
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active" aria-current="page"><?php echo e(trans('labels.refund_policy')); ?></li>
    
                </ol>
    
            </nav>
    
        </div>
    </section>

    <!-- BREADCRUMB AREA END -->

    <section class="privacy-policy my-5">

        <div class="container">
            <p><?php echo $policy->refund_policy; ?></p>

        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/other/refund_policy.blade.php ENDPATH**/ ?>
<?php if(request()->is($vendordata->slug . '/products*')): ?>
    <?php if(@helper::checkaddons('trusted_badges')): ?>
        <div class="col-12 p-3 border-top">
            <div class="row g-3 product-detile">
                <?php if(@helper::otherappdata($vendordata->id)->trusted_badge_image_1): ?>
                    <div class="col-xl-3 col-lg-6 col-6">
                        <div class="service-content">
                            <img src="<?php echo e(helper::image_path(@helper::otherappdata($vendordata->id)->trusted_badge_image_1)); ?>"
                                alt="">
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(@helper::otherappdata($vendordata->id)->trusted_badge_image_2): ?>
                    <div class="col-xl-3 col-lg-6 col-6">
                        <div class="service-content">
                            <img src="<?php echo e(helper::image_path(@helper::otherappdata($vendordata->id)->trusted_badge_image_2)); ?>"
                                alt="">
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(@helper::otherappdata($vendordata->id)->trusted_badge_image_3): ?>
                    <div class="col-xl-3 col-lg-6 col-6">
                        <div class="service-content">
                            <img src="<?php echo e(helper::image_path(@helper::otherappdata($vendordata->id)->trusted_badge_image_3)); ?>"
                                alt="">
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(@helper::otherappdata($vendordata->id)->trusted_badge_image_4): ?>
                    <div class="col-xl-3 col-lg-6 col-6">
                        <div class="service-content">
                            <img src="<?php echo e(helper::image_path(@helper::otherappdata($vendordata->id)->trusted_badge_image_4)); ?>"
                                alt="">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if(@helper::checkaddons('safe_secure_checkout')): ?>
    <?php if(@helper::otherappdata($vendordata->id)->safe_secure_checkout_payment_selection): ?>
        <?php if(request()->is($vendordata->slug . '/products*')): ?>
            <div class="col-12 py-4 p-3 sevirce-trued mt-3">
            <?php else: ?>
                <div class="col-12 py-4 p-3 my-3 sevirce-trued">
        <?php endif; ?>
        <div class="d-flex mb-2 pb-1 flex-wrap gap-2 justify-content-center aling-items-center">
            <?php $__currentLoopData = helper::paymentlist($vendordata->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stpayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(
                    @in_array(
                        $stpayment->payment_type,
                        explode(',', helper::otherappdata($vendordata->id)->safe_secure_checkout_payment_selection))): ?>
                    <div class="sevirce-tru">
                        <div class="img">
                            <img class="border rounded-2" src="<?php echo e(helper::image_path($stpayment->image)); ?>"
                                alt="">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h6 class="fs-15 text-center fw-normal"
            style="color: <?php echo e(@helper::otherappdata($vendordata->id)->safe_secure_checkout_text_color); ?>">
            <?php echo e(@helper::otherappdata($vendordata->id)->safe_secure_checkout_text); ?>

        </h6>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/service-trusted.blade.php ENDPATH**/ ?>
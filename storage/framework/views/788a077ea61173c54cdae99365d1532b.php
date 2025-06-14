<?php if(@helper::checkaddons('subscription')): ?>
    <?php if(@helper::checkaddons('coupon')): ?>
        <?php
            
            $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                ->orderByDesc('id')
                ->first();
            if ($vendordata->allow_without_subscription == 1) {
                $coupon = 1;
            } else {
                $coupon = @$checkplan->coupons;
            }
            
        ?>
        <?php if($coupon == 1): ?>
            <section class="top-bar-offer bg-primary d-flex align-items-center py-md-3 py-2 my-md-5 my-4 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                <marquee class="text-center" direction="<?php echo e(session()->get('direction') == 2 ? 'left' : 'right'); ?>" behavior="scroll" onmouseover="this.stop();"
                    onmouseout="this.start();">
                    <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span><?php echo e($coupon->offer_name); ?> : <?php echo e($coupon->offer_code); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </marquee>
            </section>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <?php if(@helper::checkaddons('coupon')): ?>
        <section class="top-bar-offer bg-primary d-flex align-items-center py-md-3 py-2 my-md-5 my-4">
            <marquee class="text-center" direction="right" behavior="scroll" onmouseover="this.stop();"
                onmouseout="this.start();">
                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span><?php echo e($coupon->offer_name); ?> : <?php echo e($coupon->offer_code); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </marquee>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/coupon/index.blade.php ENDPATH**/ ?>
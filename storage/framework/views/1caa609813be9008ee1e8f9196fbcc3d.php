<img src="<?php echo e(helper::image_path($productdata->image)); ?>" class="rounded-3">

<div class="card border-0">
    <h6 class="heading text-capitalize">
    <?php if(strlen($productdata->name) > 30): ?>
    <?php echo e(substr($productdata->name, 0, 30) . '...'); ?>

    <?php else: ?>
    <?php echo e($productdata->name); ?>

    <?php endif; ?>
    </h6>

    <p class="info line-2">
        <?php echo e(trans('labels.recently_purchased')); ?>

    </p>
    <div class="read-more-wrapper">
        <a href="<?php echo e(URL::to($vendordata->slug . '/products/' . $productdata->slug)); ?>">
            <span class="read-more text-primary text-decoration-underline"><?php echo e(trans('labels.view_product')); ?></span>
        </a>
    </div>
</div><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/sales_notification/index.blade.php ENDPATH**/ ?>
<?php
    if ($getproductdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
            $price = $getproductdata->price - @helper::top_deals($vendordata->id)->offer_amount;
        } else {
            $price =
                $getproductdata->price -
                $getproductdata->price * (@helper::top_deals($vendordata->id)->offer_amount / 100);
        }
        $original_price = $getproductdata->price;
    } else {
        $price = $getproductdata->price;
        $original_price = $getproductdata->original_price;
    }
    $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
?>

<div class="product-grid card rounded-0 h-100">
    <div class="product-image m-1">
        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>" class="image">
            <img class="pic-1" src="<?php echo e($getproductdata['product_image']->image_url); ?>">
            <img class="pic-2"
                src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>">
        </a>
        <?php if($off > 0): ?>
            <span class="product-new-label"><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></span>
        <?php endif; ?>
        <ul class="product-links">
            <li class="cursor-pointer">
                <a onclick="productview('<?php echo e($getproductdata->id); ?>')">
                    <i class="fa-regular fa-eye"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body p-2 product-content">
        <div class="d-flex flex-wrap justify-content-between gap-1 mb-1 align-items-center">
            <p class="card-title fs-8 line-2  m-0 text-truncate">
                <?php echo e(@$getproductdata['category_info']->name); ?>

            </p>
            <?php if(@helper::checkaddons('product_reviews')): ?>
                <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                    <p class="fs-8 m-0 text-truncate"><i class="text-warning fa-solid fa-star px-1"></i><span
                            class="text-dark fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>" class="text-secondary">
            <p class="m-0 fs-7 fw-600 line-2 text-capitalize"><?php echo e($getproductdata->name); ?></p>
        </a>
    </div>
    <div class="card-footer p-0 product-content">
        <div class="d-flex gap-2 justify-content-center align-items-center mb-2 mx-1 flex-wrap">
            <h5 class="text-primary fs-7 fw-600 m-0 text-truncate">
                <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

            </h5>
            <?php if($original_price > $price): ?>
                <del
                    class="text-muted fs-8 fw-600"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
            <?php endif; ?>
        </div>
        <ul class="product-buttons d-flex">
            <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                <li class="cursor-pointer">
                    <?php if($getproductdata->has_variation == 1): ?>
                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                <?php echo e(trans('labels.cart')); ?>

                            </div>
                        </a>
                    <?php else: ?>
                        <a
                            onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                <?php echo e(trans('labels.cart')); ?>

                            </div>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
            <?php if(@helper::checkaddons('customer_login')): ?>
                <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                    <li class="cursor-pointer">
                        <a
                            onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                    <?php
                                        $favorite = helper::ceckfavorite(
                                            $getproductdata->id,
                                            $vendordata->id,
                                            Auth::user()->id,
                                        );
                                    ?>
                                    <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                        <i class="fa-solid fa-heart"></i>
                                    <?php else: ?>
                                        <i class="fa-regular fa-heart"></i>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <i class="fa-regular fa-heart"></i>
                                <?php endif; ?>
                                <?php echo e(trans('labels.wishlist')); ?>

                            </div>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-20/productcomonview.blade.php ENDPATH**/ ?>
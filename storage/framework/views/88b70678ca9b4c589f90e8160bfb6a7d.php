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

<div class="card h-100 product-grid bg-white rounded-3 overflow-hidden">

    <div class="product-image">
        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>" class="image">
            <img class="pic-1" src="<?php echo e($getproductdata['product_image']->image_url); ?>">
            <img class="pic-2"
                src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>">
        </a>
        <?php if($off > 0): ?>
            <span class="theme-19-ribbon">
                <h3><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></h3>
            </span>
        <?php endif; ?>
        <ul class="product-links text-center">
            <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                <li class="fs-7">
                    <?php if($getproductdata->has_variation == 1): ?>
                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                            class="fs-7 fw-500">
                            <?php echo e(trans('labels.addtocart')); ?>

                        </a>
                    <?php else: ?>
                        <a class="option-btn addtocart-btn rounded-0 fs-7 fw-500 cursor-pointer w-100"
                            onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                            <?php echo e(trans('labels.addtocart')); ?>

                        </a>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
            <?php if(@helper::checkaddons('customer_login')): ?>
                <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                    <li class="cursor-pointer">
                        <a
                            onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')">
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
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="cursor-pointer">
                <a onclick="productview('<?php echo e($getproductdata->id); ?>')">
                    <i class="fa-regular fa-eye"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body border-top">
        <div class="d-flex align-items-center gap-1 mb-2 justify-content-between">
            <span class="fs-7 fw-500 text-muted m-0 line-1"><?php echo e(@$getproductdata['category_info']->name); ?></span>
            <p class="fs-8 d-flex align-items-center">
                <i class="text-warning fs-8 fa-solid fa-star"></i>
                <span class="text-dark fw-500 fs-8">
                    <?php echo e(number_format($getproductdata->ratings_average, 1)); ?>

                </span>
            </p>
        </div>
        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
            <h3 class="title line-2 m-0 border-bottom-0">
                <?php echo e($getproductdata->name); ?>

            </h3>
        </a>
    </div>
    <div class="card-footer pt-0 pb-3">
        <h5 class="fs-7 price m-0 fw-bold product-price align-items-center gap-1 d-flex flex-wrap w-100 text-truncate">
            <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

            <?php if($original_price > $price): ?>
                <del class="text-muted fs-8 fw-600 d-block">
                    <?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?>

                </del>
            <?php endif; ?>
        </h5>
    </div>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-19/productcomonview.blade.php ENDPATH**/ ?>
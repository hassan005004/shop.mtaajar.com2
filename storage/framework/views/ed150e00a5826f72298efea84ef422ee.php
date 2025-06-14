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
<div class="col theme-18">
    <a
        href="<?php echo e(request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">

        <div class="card h-100 product-grid bg-white rounded-0">

            <div class="product-image">
                <a class="image">
                    <img class="pic-1" src="<?php echo e($getproductdata['product_image']->image_url); ?>">
                </a>
                <?php if($off > 0): ?>
                    <div class="off-label-16">
                        <h3 class="text-center"><?php echo e($off); ?>% OFF</h3>
                    </div>
                <?php endif; ?>
                <ul class="product-links d-flex gap-2">
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
                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                        <li class="cursor-pointer">
                            <?php if($getproductdata->has_variation == 1): ?>
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                </a>
                            <?php else: ?>
                                <a href="javascript:void(0)"
                                    onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="card-body border-top text-center">
                <h3 class="title line-2">
                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                        <?php echo e($getproductdata->name); ?>

                    </a>
                </h3>
                <span class="category m-0 line-1"><?php echo e(@$getproductdata['category_info']->name); ?></span>
            </div>
            <div class="card-footer border-top d-flex align-items-center justify-content-between">

                <h5
                    class="fs-7 price m-0 fw-bold product-price flex-wrap align-items-center gap-1 d-flex text-truncate">
                    <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                    <?php if($original_price > $price): ?>
                        <del class="text-muted fs-8 fw-600 d-block">
                            <?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?>

                        </del>
                    <?php endif; ?>
                </h5>

                <p class="fs-8 d-flex gap-1 align-items-center">
                    <i class="text-warning fs-8 fa-solid fa-star "></i>
                    <span class="text-dark fw-500 fs-8">
                        <?php echo e(number_format($getproductdata->ratings_average, 1)); ?>

                    </span>
                </p>
            </div>

        </div>
    </a>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-18/productcomonview.blade.php ENDPATH**/ ?>
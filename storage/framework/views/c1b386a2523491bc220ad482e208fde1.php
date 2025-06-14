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
<div class="col">
    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
        <div class="card h-100 rounded-5 card-gried border-0 p-2 p-sm-3">
            <div class="product-grid">
                <div class="product-image">
                    <a class="image">
                        <img class="pic-1 card-img-top rounded-top-4"
                            src="<?php echo e($getproductdata['product_image']->image_url); ?>">
                        <img class="pic-2 card-img-top rounded-top-4"
                            src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>">
                    </a>
                    <?php if($off > 0): ?>
                        <div class="off-label-16">
                            <h3 class="text-center"><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></h3>
                        </div>
                    <?php endif; ?>
                    <ul class="social">
                        <?php if(@helper::checkaddons('customer_login')): ?>
                            <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                <li class="cursor-pointer">
                                    <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                        data-tip="Wishlist">
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
                            <a onclick="productview('<?php echo e($getproductdata->id); ?>')" data-tip="View">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </li>
                        <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                            <li class="cursor-pointer">
                                <?php if($getproductdata->has_variation == 1): ?>
                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                        data-tip="<?php echo e(trans('labels.cart')); ?>">
                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="javascript:void(0)"
                                        onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')"
                                        data-tip="<?php echo e(trans('labels.cart')); ?>">
                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="d-flex justify-content-between gap-2 mb-2">
                    <p class="item-title text-dark fs-13 text-muted cursor-auto text-truncate">
                        <?php echo e(@$getproductdata['category_info']->name); ?>

                    </p>
                    <?php if(@helper::checkaddons('product_reviews')): ?>
                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                            <p class="fs-8 d-flex"><i class="text-warning fa-solid fa-star px-1"></i>
                                <span
                                    class="text-dark fs-8 fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <a class="cursor-pointer position-relative z-1"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                    <p class="text-dark fs-15 fw-600 line-2"><?php echo e($getproductdata->name); ?></p>
                </a>
            </div>
            <div class="card-footer pt-2">
                <h6
                    class="text-dark fs-15 d-flex gap-1 flex-wrap product-price cursor-auto text-truncate align-items-center">
                    <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                    <?php if($original_price > $price): ?>
                        <del
                            class="text-muted fs-13 fw-600"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                    <?php endif; ?>
                </h6>
            </div>
        </div>
    </a>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-16/productcomonview.blade.php ENDPATH**/ ?>
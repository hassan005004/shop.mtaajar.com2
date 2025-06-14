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
<div class="product-item m-0 py-2 theme-5-best-Selling-product">
    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
        <div
            class="card h-100 w-100 rounded-0 shadow-none border border-0 overflow-hidden pro-menu <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">

            <div class="card-img position-relative">

                <img src="<?php echo e($getproductdata['product_image']->image_url); ?>" class="object-fit-cover w-100 img-1"
                    alt="product image ">

                <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                    class="w-100 img-2" alt="">
                <?php if($off > 0): ?>
                    <span
                        class="<?php echo e(session()->get('direction') == 2 ? 'theme-5-sale-label-rtl' : 'sale-label'); ?>"><?php echo e($off); ?>%
                        <?php echo e(trans('labels.off')); ?></span>
                <?php endif; ?>

                <!-- options -->
                <ul class="option-wrap <?php echo e(session()->get('direction') == 2 ? '  ltr' : 'rtl'); ?>">
                    <?php if(@helper::checkaddons('customer_login')): ?>
                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                            <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right'); ?> rounded-circle"
                                data-tooltip="Wishlist">
                                <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                    class="option-btn circle-round wishlist-btn">
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
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right'); ?> rounded-circle"
                        data-tooltip="<?php echo e(trans('labels.view')); ?>">
                        <a class="option-btn circle-round wishlist-btn"
                            onclick="productview('<?php echo e($getproductdata->id); ?>')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                        <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right'); ?> rounded-circle"
                            data-tooltip="<?php echo e(trans('labels.add_to_cart')); ?>">
                            <?php if($getproductdata->has_variation == 1): ?>
                                <a href="<?php echo e(request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                    class="option-btn circle-round addtocart-btn wishlist-btn">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            <?php else: ?>
                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                    onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- options -->

            </div>

            <div class="card-body px-0 pb-0">

                <p class="card-title fs-8 text-secondary mb-1 text-truncate">
                    <?php echo e(@$getproductdata['category_info']->name); ?></p>

                <a
                    href="<?php echo e(request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                    <p class="m-0 fs-7 fw-600 line-2 text-capitalize"><?php echo e($getproductdata->name); ?></p>
                </a>

            </div>
            <div class="card-footer px-0 price">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <h5 class="text-dark fs-7 fw-600 m-0 text-truncate">
                            <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                        </h5>
                        <?php if($original_price > $price): ?>
                            <del
                                class="text-muted fs-8 fw-600"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                        <?php endif; ?>
                    </div>
                    <?php if(@helper::checkaddons('product_reviews')): ?>
                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                            <p class="fs-8 text-truncate"><i class="text-warning fa-solid fa-star px-1"></i><span
                                    class="text-dark fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </a>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-5/productcomonview.blade.php ENDPATH**/ ?>
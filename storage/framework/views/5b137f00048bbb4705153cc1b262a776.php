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
<div class="col ">
    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">

        <div
            class="card rounded-4 h-100 overflow-hidden shadow-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">

            <div class="card-img position-relative">
                <img src="<?php echo e($getproductdata['product_image']->image_url); ?>" alt=""
                    class="w-100 object-fit-cover img-1">
                <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                    class="w-100 img-2" alt="">
                <?php if($off > 0): ?>
                    <div class="sale-label-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                        <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                <?php endif; ?>
                <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                    <div class="w-100 theme-9-cart">
                        <?php if($getproductdata->has_variation == 1): ?>
                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                class="option-btn addtocart-btn rounded-0 text-dark">
                                <div class="product-cart-button w-100">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    <p class="px-2 fs-7 fw-500 text-capitalize"><?php echo e(trans('labels.add_to_cart')); ?>

                                    </p>
                                </div>
                            </a>
                        <?php else: ?>
                            <a class="option-btn addtocart-btn rounded-0 cursor-pointer"
                                onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                <div class="product-cart-button w-100 text-dark">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    <p class="px-2 fs-7 fw-500 text-capitalize"><?php echo e(trans('labels.add_to_cart')); ?>

                                    </p>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- options -->
                <ul
                    class="option-wrap justify-content-center align-items-center d-grid product_icon2 px-2 w-auto <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                    <?php if(@helper::checkaddons('customer_login')): ?>
                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                            <li data-tooltip="Wishlist" class="m-0 tooltip-right">
                                <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                    class="option-btn circle-round wishlist-btn rounded">
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
                    <li data-tooltip="<?php echo e(trans('labels.view')); ?>" class="m-0 tooltip-right">
                        <a class="option-btn circle-round wishlist-btn rounded"
                            onclick="productview('<?php echo e($getproductdata->id); ?>')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                </ul>
                <!-- options -->
            </div>

            <div class="card-body px-sm-3 px-2 pt-3 pb-0">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <p class="item-title fs-8 cursor-auto text-truncate text-lightslategray">
                        <?php echo e(@$getproductdata['category_info']->name); ?>

                    </p>
                    <?php if(@helper::checkaddons('product_reviews')): ?>
                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                            <p class="d-flex fs-8 product-star align-items-center">
                                <i class="text-warning fa-solid fa-star px-1"></i>
                                <span
                                    class="text-lightslategray fs-8 fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                    <p class="text-dark product-name line-2"><?php echo e($getproductdata->name); ?></p>
                </a>
            </div>
            <div class="card-footer px-sm-3 px-2 pt-2 pb-3">
                <h5 class="text-dark fs-7 product-price cursor-auto text-truncate">
                    <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                    <?php if($original_price > $price): ?>
                        <del
                            class="fs-8 fw-normal d-block mt-1 text-lightslategray"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                    <?php endif; ?>
                </h5>
            </div>
        </div>
    </a>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-9/productcomonview.blade.php ENDPATH**/ ?>
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
    <div class="card h-100 border-0 rounded-0 pro-card">
        <div class="overflow-hidden position-relative">
            <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                <img src="<?php echo e($getproductdata['product_image']->image_url); ?>" class="card-img-top w-100 img-1"
                    alt="...">
                <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                    class="w-100 img-2" alt="">
            </a>
            <!-- NEW label -->
            <?php if($off > 0): ?>
                <span class="<?php echo e(session()->get('direction') == 2 ? 'arrow-label-wrap-rtl' : 'arrow-label-wrap'); ?>">
                    <span class="arrow-label bg-theme-sun"><?php echo e($off); ?>% OFF</span></span>
            <?php endif; ?>

            <!-- NEW label -->
            <!-- options -->
            <ul class="option-wrap">
                <?php if(@helper::checkaddons('customer_login')): ?>
                    <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                        <li tooltip="Wishlist" class="rounded-circle fav-list-icon">
                            <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                class="circle-round wishlist-btn">
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
                <li tooltip="View" class="rounded-circle fav-list-icon">
                    <a class="circle-round wishlist-btn" onclick="productview('<?php echo e($getproductdata->id); ?>')">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                </li>
                <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                    <li tooltip="Add To Cart" class="rounded-circle fav-list-icon">
                        <?php if($getproductdata->has_variation == 1): ?>
                            <a href="<?php echo e(request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                class="circle-round addtocart-btn wishlist-btn">
                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                            </a>
                        <?php else: ?>
                            <a class="circle-round addtocart-btn  wishlist-btn"
                                onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- options -->
        </div>

        <!-- product content -->
        <div class="card-body px-0 pb-0">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <p class="card-title fs-8 text-muted m-0 text-truncate text-capitalize">
                    <?php echo e(@$getproductdata['category_info']->name); ?></p>
                <?php if(@helper::checkaddons('product_reviews')): ?>
                    <?php if(@helper::checkaddons('customer_login')): ?>
                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                            <p class="fs-8"><i class="text-warning fa-solid fa-star px-1"></i><span
                                    class="text-dark fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <h5 class="product-name line-2">
                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                    class="card-text text-dark mb-0 line-2"
                    title="<?php echo e($getproductdata->name); ?>"><?php echo e($getproductdata->name); ?>

                </a>
            </h5>
        </div>

        <div class="card-footer px-0 mt-1">
            <h5 class="text-dark fw-semibold mb-0 product-price text-truncate">
                <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>


                <?php if($original_price > $price): ?>
                    <?php if($original_price > 0): ?>
                        <del
                            class="text-muted fw-500 fs-8 fw-normal"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                    <?php endif; ?>
                <?php endif; ?>
            </h5>
        </div>
        <!-- product content -->
    </div>

</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/productcommonview.blade.php ENDPATH**/ ?>
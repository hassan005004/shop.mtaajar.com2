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
<div class="col-xl-6 col-lg-6 col-md-12 col-12">
    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
        <!-- product item start -->
        <div class="item h-100 p-2 d-flex bg-primary-rgb rounded-2 align-items-center border-0">
            <!-- img start -->
            <div class="item-img position-relative">
                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                    <img src="<?php echo e($getproductdata['product_image']->image_url); ?>" alt="product image"
                        class="object-fit-cover img-1 rounded-2">
                    <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                        class="w-100 img-2 rounded-2" alt="">
                </a>
                <?php if($off > 0): ?>
                    <div class="off-label-two-12 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                        <div class="sale-label-12"><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="w-100 <?php echo e(session()->get('direction') == 2 ? 'pe-md-3 pe-2' : 'ps-md-3 ps-2'); ?>">
                <div class="item-content p-0">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <p class="item-title text-muted fs-8 cursor-auto text-truncate">
                            <?php echo e(@$getproductdata['category_info']->name); ?>

                        </p>
                        <?php if(@helper::checkaddons('product_reviews')): ?>
                            <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                <p class="fs-8">
                                    <i class="text-warning fa-solid fa-star px-1"></i>
                                    <span
                                        class="text-dark fs-8 fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                        <p class="text-dark product-name line-2"><?php echo e($getproductdata->name); ?></p>
                    </a>

                </div>

                <div class="p-0">
                    <h6 class="text-dark fs-7 fw-600 mt-3 mb-2 cursor-auto text-truncate d-flex align-items-center">

                        <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                        <?php if($original_price > $price): ?>
                            <del
                                class="text-muted fs-8 fw-normal d-block px-1"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                        <?php endif; ?>

                    </h6>
                    <!-- options -->
                    <ul class="option-wrap d-flex gap-2 align-items-center d-grid product_icon2 mt-2">
                        <?php if(@helper::checkaddons('customer_login')): ?>
                            <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                <li tooltip="Wishlist" class="rounded-2">
                                    <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                        class="option-btn circle-round wishlist-btn rounded-2">
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
                        <li tooltip="<?php echo e(trans('labels.view')); ?>" class="rounded-2">
                            <a class="option-btn circle-round wishlist-btn rounded-2"
                                onclick="productview('<?php echo e($getproductdata->id); ?>')">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </li>
                        <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                            <li tooltip="<?php echo e(trans('labels.addtocart')); ?>" class="rounded-2">
                                <?php if($getproductdata->has_variation == 1): ?>
                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                        class="option-btn circle-round addtocart-btn wishlist-btn rounded-2">
                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="javascript:void(0);"
                                        class="option-btn circle-round addtocart-btn wishlist-btn rounded-2"
                                        onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- options -->
                </div>
            </div>
        </div>
    </a>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-13/productcomonview.blade.php ENDPATH**/ ?>
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

        <div class="card rounded-3 h-100 p-2">
            <div class="card-img position-relative">
                <img src="<?php echo e($getproductdata['product_image']->image_url); ?>" alt=""
                    class="w-100 rounded-3 object-fit-cover img-1">
                <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                    class="w-100 rounded-3 img-2" alt="">
                <?php if($off > 0): ?>
                    <div class="off-label-14 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                        <div class="sale-label-14"><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                    </div>
                <?php endif; ?>
                <!-- options -->
                <ul
                    class="option-wrap justify-content-center d-flex align-items-center d-grid product_icon2 mt-2 px-2 w-100">
                    <?php if(@helper::checkaddons('customer_login')): ?>
                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                            <li tooltip="Wishlist" class="rounded-3 mx-2 border">
                                <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                    class="option-btn circle-round wishlist-btn rounded-0">
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
                    <li tooltip="<?php echo e(trans('labels.view')); ?>" class="rounded-3 mx-2 border">
                        <a class="option-btn circle-round wishlist-btn rounded-0"
                            onclick="productview('<?php echo e($getproductdata->id); ?>')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                        <li tooltip="<?php echo e(trans('labels.addtocart')); ?>" class="rounded-3 mx-2 border">
                            <?php if($getproductdata->has_variation == 1): ?>
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-0">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            <?php else: ?>
                                <a href="javascript:void(0);"
                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-0"
                                    onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- options -->
            </div>

            <div class="card-body px-sm-2 px-1 pt-3 pb-0">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <p class="item-title text-muted fs-8 cursor-auto text-truncate">
                        <?php echo e(@$getproductdata['category_info']->name); ?>

                    </p>
                    <?php if(@helper::checkaddons('product_reviews')): ?>
                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                            <p class="fs-8 d-flex">
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
            <div class="card-footer px-sm-2 px-1 py-2 ">
                <h6 class="text-dark fs-7 fw-500 product-price cursor-auto text-truncate">
                    <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                    <?php if($original_price > $price): ?>
                        <del
                            class="text-muted fs-8 fw-normal d-block mt-1"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                    <?php endif; ?>
                </h6>
            </div>
        </div>
    </a>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-14/productcomonview.blade.php ENDPATH**/ ?>
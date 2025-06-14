<div class="modal-body">
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn-close mb-0" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <section class="product-view p-0">
        <div class="row justify-content-between">
            <?php if(!request()->is('admin/pos/item-details')): ?>
                <div class="col-lg-6">
                    <div id="carouseltest" class="carousel slide">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $getitem['multi_image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?> "
                                    name="image<?php echo e($key); ?>">
                                    <img class="img-fluid w-100" src="<?php echo e(helper::image_path($image->image)); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <button class='carousel-control-prev' type='button' data-bs-target='#carouseltest'
                                data-bs-slide='prev'>
                                <span
                                    class='carousel-control-prev-icon d-flex justify-content-center align-items-center'
                                    aria-hidden='true'> <i class='fa-solid fa-arrow-left-long'></i>
                                </span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#carouseltest'
                                data-bs-slide='next'>
                                <span
                                    class='carousel-control-next-icon d-flex justify-content-center align-items-center'
                                    aria-hidden='true'> <i class='fa-solid fa-arrow-right-long'></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="<?php echo e(!request()->is('admin/pos/item-details') ? 'col-lg-6' : 'col-lg-12'); ?>">
                <?php
                    if (
                        $getitem->top_deals == 1 &&
                        helper::top_deals($vendordata->id) != null &&
                        !request()->is('admin/pos/item-details')
                    ) {
                        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                            $price = $getitem->price - helper::top_deals($vendordata->id)->offer_amount;
                        } else {
                            $price =
                                $getitem->price -
                                $getitem->price * (@helper::top_deals($vendordata->id)->offer_amount / 100);
                        }
                        $original_price = $getitem->price;
                    } else {
                        $price = $getitem->price;
                        $original_price = $getitem->original_price;
                    }
                    $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                ?>
                <div class="product-content px-md-0">
                    <div class="card border-0 h-600">
                        <div class="card-body modal-card-body">
                            <?php if($off > 0): ?>
                                <span class="badge text-bg-primary fs-7 mb-2 rounded-0"
                                    id="modal_price-off"><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></span>
                            <?php endif; ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="text-dark fs-4 fw-600 product-line"><?php echo e($getitem->name); ?> </h2>
                            </div>


                            <p id="laodertext" class="d-none laodertext"></p>

                            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-0">
                                <div
                                    class="d-flex flex-wrap align-items-center <?php echo e($getitem->is_available == 2 || $getitem->is_deleted == 1 ? 'd-none' : ''); ?>">
                                    <span class="product-price mb-0"
                                        id="modal_product_price"><?php echo e(helper::currency_formate($price, $vendordata->id)); ?></span>
                                    <?php if($original_price > $price): ?>
                                        <del class="text-muted px-1 fs-15 fw-500 product-original-price"
                                            id="modal_product-original-price"><?php echo e(helper::currency_formate($original_price, $vendordata->id)); ?></del>
                                    <?php endif; ?>
                                </div>
                                <?php if(!request()->is('admin/pos/item-details')): ?>
                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                        <!-- rating star section Start -->
                                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                            <div class="d-flex gap-2 rounded-0 align-items-center p-0 m-0">
                                                <p class="fs-7 d-flex gap-1 align-items-center">
                                                    <i
                                                        class="text-warning fa-solid fa-star <?php echo e(session()->get('direction') == 2 ? 'ps-1' : 'pe-1'); ?>"></i>
                                                    <span
                                                        class="text-dark fw-500 fs-7 average_rating"><?php echo e(number_format($getitem->ratings_average, 1)); ?></span>
                                                </p>
                                                <span class="fs-7 d-inline-block text-muted fw-500 total-ratting">(
                                                    <?php echo e($totalratting); ?>

                                                    <?php echo e(trans('labels.ratting')); ?>)</span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <!-- rating star section End -->
                            </div>
                            <?php if($getitem->has_variation == 2): ?>
                                <?php if($getitem->is_available == 2 || $getitem->is_deleted == 1): ?>
                                    <h3 class="text-danger"><?php echo e(trans('labels.not_available')); ?></h3>
                                <?php endif; ?>
                            <?php else: ?>
                                <h3 class="text-danger" id="detail_not_available_text"></h3>
                            <?php endif; ?>

                            <?php if($getitem->is_available != 2 || $getitem->is_deleted == 1): ?>
                                <p id="tax" class="py-1">
                                    <?php if($getitem->tax != null && $getitem->tax != ''): ?>
                                        <span class="text-danger fs-7"> <?php echo e(trans('labels.exclusive_taxes')); ?></span>
                                    <?php else: ?>
                                        <span class="text-success fs-7"> <?php echo e(trans('labels.inclusive_taxes')); ?></span>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                            <?php if(!request()->is('admin/pos/item-details')): ?>
                                <?php if(@helper::checkaddons('fake_view')): ?>
                                    <?php if(helper::appdata($vendordata->id)->product_fake_view == 1): ?>
                                        <?php

                                            $var = ['{eye}', '{count}'];
                                            $newvar = [
                                                "<i class='fa-solid fa-eye'></i>",
                                                rand(
                                                    helper::appdata($vendordata->id)->min_view_count,
                                                    helper::appdata($vendordata->id)->max_view_count,
                                                ),
                                            ];

                                            $fake_view = str_replace(
                                                $var,
                                                $newvar,
                                                helper::appdata($vendordata->id)->fake_view_message,
                                            );
                                        ?>
                                        <div class="pb-2">
                                            <div class="d-flex gap-1 align-items-center blink_me">
                                                <p class="fw-600 text-success m-0"><?php echo $fake_view; ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if(
                                $getitem->sku != '' ||
                                    ($getitem->has_variation == 2 && $getitem->stock_management == 1) ||
                                    $getitem->attchment_name != ''): ?>
                                <div class="border-bottom border-top pb-3 <?php echo e($getitem->sku != null || $getitem->stock_management == 1 || $getitem->attchment_url != null || $getitem->attchment_name != null ? 'd-block' : 'd-none'); ?>"
                                    id="sku_stock">
                                    <div class="meta-content bg-secondary-subtle p-3 mt-3 rounded-0">
                                        <?php if($getitem->sku != '' && $getitem->sku != null): ?>
                                            <div class="sku-wrapper product_meta ">
                                                <span class="fs-7" id="sku_lable"><span
                                                        class="fw-semibold text-dark"><?php echo e(trans('labels.sku')); ?></span>
                                                    <span class="text-muted fs-7" id="sku_value">:
                                                        <?php echo e($getitem->sku); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($getitem->has_variation == 2 && $getitem->stock_management == 1): ?>
                                            <div class="sku-wrapper product_meta" id="stock">
                                                <span class="fs-7"><span
                                                        class="fw-semibold text-dark"><?php echo e(trans('labels.stock')); ?>:</span>
                                                </span>
                                                <?php if($getitem->qty > 0): ?>
                                                    <span class="text-success fs-7"><?php echo e($getitem->qty); ?>

                                                        <?php echo e(trans('labels.in_stock')); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="text-danger fs-7"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php elseif($getitem->has_variation == 1): ?>
                                            <div class="sku-wrapper product_meta" id="stock">
                                                <span class="fs-7"><span
                                                        class="fw-semibold text-dark"><?php echo e(trans('labels.stock')); ?>:
                                                    </span></span>
                                                <span class="fs-7" id="detail_out_of_stock"></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($getitem->attchment_name != '' && $getitem->attchment_name != null): ?>
                                            <div>
                                                <?php if($getitem->attchment_name != '' && $getitem->attchment_name != null): ?>
                                                    <a href="<?php echo e($getitem->attchment_url); ?>" target="_blank"
                                                        class="text-dark">
                                                        <p class="fs-7 fw-semibold d-flex align-items-center gap-2">
                                                            <?php echo e($getitem->attchment_name); ?>

                                                            <i class="fa-light fa-file fs-7"></i>
                                                        </p>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e($getitem->attchment_url); ?>" target="_blank"
                                                        class="text-dark">
                                                        <p class="fs-7 fw-semibold d-flex align-items-center gap-2">
                                                            <?php echo e(trans('labels.click_here')); ?>

                                                            <i class="fa-light fa-file fs-7"></i>
                                                        </p>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($getitem->has_variation == 1): ?>
                                <div class="product-variations-wrapper">
                                    <div class="size-variation" id="variation">

                                        <?php for($i = 0; $i < count($getitem->variants_json); $i++): ?>
                                            <label class="fw-semibold mt-3"
                                                for=""><?php echo e($getitem->variants_json[$i]['variant_name']); ?></label><br>
                                            <div class="d-flex flex-wrap gap-2 border-bottom pb-3 mt-3">
                                                <?php for($t = 0; $t < count($getitem->variants_json[$i]['variant_options']); $t++): ?>
                                                    <label
                                                        class="checkbox-inline check<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?> <?php echo e($t == 0 ? 'active' : ''); ?>"
                                                        id="check_<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                                        for="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>">
                                                        <input type="checkbox" class="" name="skills"
                                                            <?php echo e($t == 0 ? 'checked' : ''); ?>

                                                            value="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>"
                                                            id="<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $getitem->variants_json[$i]['variant_options'][$t])); ?>">
                                                        <?php echo e($getitem->variants_json[$i]['variant_options'][$t]); ?>

                                                    </label>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(count($getitem['extras']) > 0): ?>
                                <div class="woo_pr_color flex_inline_center border-bottom mt-3 pb-3">
                                    <div class="woo_colors_list text-left">
                                        <span id="extras">
                                            <h6 class="extra-title fw-semibold text-dark"><?php echo e(trans('labels.extras')); ?>

                                            </h6>
                                            <ul class="list-unstyled extra-food mt-3">
                                                <div id="pricelist">
                                                    <?php $__currentLoopData = $getitem['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="mb-2">
                                                            <div
                                                                class="form-check m-0 p-0 d-flex gap-2 align-items-center">
                                                                <input type="checkbox"
                                                                    class="form-check-input p-0 m-0 Checkbox" name="addons[]"
                                                                    extras_name="<?php echo e($extras->name); ?>" value="<?php echo e($extras->id); ?>"
                                                                    price="<?php echo e($extras->price); ?>"
                                                                    id="extracheck_<?php echo e($key); ?>_<?php echo e($getitem->id); ?>">
                                                                <label class="form-check-label w-100 m-0 p-0"
                                                                    for="extracheck_<?php echo e($key); ?>_<?php echo e($getitem->id); ?>">
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span
                                                                            class="fs-7 fw-500"><?php echo e($extras->name); ?></span>
                                                                        <span class="fs-7 fw-500">
                                                                            <?php echo e(helper::currency_formate($extras->price, $getitem->vendor_id)); ?>

                                                                        </span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </ul>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-footer pt-2 pb-1">
                            <div class="row g-3 align-items-center">
                                <?php if($getitem->is_available != 2 || $getitem->is_deleted == 1): ?>
                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                        <div
                                            class="<?php echo e(!request()->is('admin/pos/item-details') ? 'col-xxl-4' : 'col-xxl-4'); ?> col-lg-6 col-md-6 col-12">
                                            <div
                                                class="input-group qty-input2 small w-100 justify-content-center responsive-margin m-0 rounded-0 hight-modal-btn align-items-center">
                                                <button
                                                    class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                                    id="minus" data-type="minus"
                                                    data-item_id="<?php echo e($getitem->id); ?>"
                                                    onclick="changeqty($(this).attr('data-item_id'),'minus')"
                                                    value="minus value"><i class="fa fa-minus"></i>
                                                </button>
                                                <input type="number"
                                                    class="border text-center item_qty_<?php echo e($getitem->id); ?>"
                                                    name="number" value="1" readonly="">
                                                <button
                                                    class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                                    id="plus" data-item_id="<?php echo e($getitem->id); ?>"
                                                    onclick="changeqty($(this).attr('data-item_id'),'plus')"
                                                    data-type="plus" value="plus value"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="<?php echo e(!request()->is('admin/pos/item-details') ? 'col-xxl-4' : 'col-xxl-8'); ?> col-lg-6 col-md-6 col-12"
                                            id="addtocart">
                                            <button
                                                class="btn btn-lg btn-fashion fs-7 w-100 text-capitalize m-0 addtocart"
                                                id="modal-addtocart"
                                                <?php if(!request()->is('admin/pos/item-details')): ?> onclick="addtocart('<?php echo e($getitem->id); ?>','<?php echo e($getitem->slug); ?>','<?php echo e($getitem->name); ?>','<?php echo e($getitem['product_image']->image); ?>','<?php echo e($getitem->tax); ?>',$('#overview_item_price').val(),'','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')" 
                                                <?php else: ?> onclick="addtocart('<?php echo e($getitem->id); ?>','<?php echo e($getitem->slug); ?>','<?php echo e($getitem->name); ?>','<?php echo e($getitem['product_image']->image); ?>','<?php echo e($getitem->tax); ?>',$('#overview_item_price').val(),'<?php echo e(URL::to('admin/pos/addtocart')); ?>')" <?php endif; ?>><?php echo e(trans('labels.add_to_cart')); ?></button>
                                        </div>
                                        <?php if(!request()->is('admin/pos/item-details')): ?>
                                            <div class="col-xxl-4 col-lg-6 col-md-6 col-12">
                                                <button
                                                    class="btn btn-lg btn-secondary bg-white rounded-0 w-100 fs-7 text-dark m-0 buynow"
                                                    id="full_view"
                                                    onclick="addtocart('<?php echo e($getitem->id); ?>','<?php echo e($getitem->slug); ?>','<?php echo e($getitem->name); ?>','<?php echo e($getitem['product_image']->image); ?>','<?php echo e($getitem->tax); ?>',$('#overview_item_price').val(),'','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','1')"><?php echo e(trans('labels.buy_now')); ?></button>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!request()->is('admin/pos/item-details')): ?>
                            <div class="px-3">
                                <div
                                    class="d-flex flex-wrap border-top pt-3 gap-sm-2 gap-3 justify-content-between align-items-center w-100 my-3">
                                    <div>
                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                            <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                <p class="fs-7 d-flex align-items-center">
                                                    <a onclick="managefavorite('<?php echo e($getitem->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                        class="btn-sm btn-Wishlist cursor-pointer bg-primary <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
                                                        <span class=" btn-sm btn-Wishlist mx-2 bg-primary">
                                                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                <?php

                                                                    $favorite = helper::ceckfavorite(
                                                                        $getitem->id,
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
                                                        </span>
                                                    </a>
                                                    <span class=" mx-2"><?php echo e(trans('labels.add_to_wishlist')); ?></span>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center gap-2">

                                        <?php if($getitem->video_url != '' && $getitem->video_url != null): ?>
                                            <a href="<?php echo e($getitem->video_url); ?>" tooltip="Video"
                                                class=" rounded-circle prod-social m-0" id="btn-video"
                                                target="_blank">
                                                <i class="fa-regular fa-video fs-7"></i></a>
                                        <?php endif; ?>

                                        <?php if(helper::appdata($vendordata->id)->google_review != '' && helper::appdata($vendordata->id)->google_review != null): ?>
                                            <a href="<?php echo e(helper::appdata($vendordata->id)->google_review); ?>"
                                                target="_blank" tooltip="Review"
                                                class=" rounded-circle prod-social m-0"><i
                                                    class="fa-regular fa-star fs-7"></i></a>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where(
                                                        'vendor_id',
                                                        $vendordata->id,
                                                    )
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    $user = App\Models\User::where('id', $vendordata->id)->first();
                                                    if (@$user->allow_without_subscription == 1) {
                                                        $whatsapp_message = 1;
                                                    } else {
                                                        $whatsapp_message = @$checkplan->whatsapp_message;
                                                    }
                                                ?>
                                                <?php if(
                                                    $whatsapp_message == 1 &&
                                                        helper::appdata($vendordata->id)->whatsapp_number != '' &&
                                                        helper::appdata($vendordata->id)->whatsapp_number != null): ?>
                                                    <a href="https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata($vendordata->id)->whatsapp_number); ?>'&text= <?php echo e($getitem->name); ?>"
                                                        tooltip="Whatsapp" class=" rounded-circle prod-social m-0"
                                                        id="enquiries" target="_blank"><i
                                                            class="fa-brands fa-whatsapp fs-7"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                <?php if(helper::appdata($vendordata->id)->whatsapp_number != '' &&
                                                        helper::appdata($vendordata->id)->whatsapp_number != null): ?>
                                                    <a href="https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata($vendordata->id)->whatsapp_number); ?>'&text= <?php echo e($getitem->name); ?>"
                                                        tooltip="Whatsapp" class=" rounded-circle whatsapp-btn"
                                                        id="enquiries" target="_blank"><i
                                                            class="fa-brands fa-whatsapp"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="woo_btn_action">
            <input type="hidden" name="vendor" id="overview_vendor" value="<?php echo e($getitem->vendor_id); ?>">
            <input type="hidden" name="item_id" id="overview_item_id" value="<?php echo e($getitem->id); ?>">
            <input type="hidden" name="item_name" id="overview_item_name" value="<?php echo e($getitem->name); ?>">
            <input type="hidden" name="item_image" id="overview_item_image"
                value="<?php echo e(@$getitem['product_image']->image); ?>">
            <input type="hidden" name="item_min_order" id="item_min_order" value="<?php echo e($getitem->min_order); ?>">
            <input type="hidden" name="item_max_order" id="item_max_order" value="<?php echo e($getitem->max_order); ?>">
            <input type="hidden" name="item_price" id="overview_item_price" value="<?php echo e($getitem->price); ?>">
            <input type="hidden" name="item_original_price" id="overview_item_original_price"
                value ="<?php echo e($getitem->original_price); ?>">
            <input type="hidden" name="tax" id="tax_val" value="<?php echo e($getitem->tax); ?>">
            <input type="hidden" name="variants_name" id="variants_name">
            <input type="hidden" name="stock_management" id="stock_management"
                value="<?php echo e($getitem->stock_management); ?>">
            <input type="hidden" name="qtyurl" id="qtyurl" value="<?php echo e(URL::to('/changeqty')); ?>">
        </div>
    </section>
</div>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/jquery.number.min.js')); ?>"></script>
<script>
    $(document).ready(function($) {
        var selected = [];
        $('.size-variation input:checked').each(function() {
            var label = $("label[for='" + $(this).attr('id') + "']").attr('id');
            $('#' + label).addClass('active');
            selected.push($(this).attr('value'));
        });
        set_variant_price(selected);
    });
    $('#variation input:checkbox').click(function() {

        var selected = [];
        var divselected = [];
        const myArray = this.id.split("-");
        var id = this.id;
        $('.check' + myArray[0] + ' input:checked').each(function() {
            divselected.push($(this).attr('value'));
        });
        if (divselected.length == 0) {
            $(this).prop('checked', true);
        }
        $('.check' + myArray[0] + ' input:checkbox').not(this).prop('checked', false);
        $('.check' + myArray[0]).removeClass('active');
        var label = $("label[for='" + $(this).attr('id') + "']").attr('id');
        $('#' + label).addClass('active');
        $('.size-variation input:checked').each(function() {
            $('.product-detail-price').addClass('d-none');
            $('#laodertext').removeClass('d-none');
            $('#laodertext').html('<span class="loader"></span>');
            selected.push($(this).attr('value'));
        });
        set_variant_price(selected);
    });

    function set_variant_price(variants) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "<?php echo e(URL::to('get-products-variant-quantity')); ?>",
            data: {
                name: variants,
                item_id: $('#overview_item_id').val(),
                vendor_id: <?php echo e($vendordata->id); ?>,
            },
            success: function(data) {
                if (data.status == 1) {
                    setTimeout(function() {
                        $('#laodertext').html('');
                    }, 4000);
                    var price = data.price;
                    var original_price = data.original_price;

                    var off = ((1 - (price / original_price)) * 100).toFixed(1);
                    $('#laodertext').addClass('d-none');
                    $('.product-detail-price').removeClass('d-none');
                    $('#variants_name').val(variants);

                    $('#modal_product_price').text(currency_formate(parseFloat(price)));
                    $('#overview_item_price').val(price);
                    $('#modal_price-off').removeClass('d-none');
                    if (parseFloat(original_price) > parseFloat(price)) {
                        $('#modal_product-original-price').text(currency_formate(parseFloat(
                            original_price)));
                        $('#modal_price-off').text($.number(off, 1) + '' + '% OFF');
                    } else {
                        $('#modal_product-original-price').text('');
                        $('#detail_original_price').text('');
                        $('#modal_price-off').text('');
                    }
                    $('#overview_item_original_price').val(original_price);
                    $('#stock_management').val(data.stock_management);
                    $('#item_min_order').val(data.min_order);
                    $('#item_max_order').val(data.max_order);
                    if (data.is_available == 2) {
                        $('.product-detail-price').addClass('d-none');
                        $('#modal_price-off').addClass('d-none');
                        $('#detail_not_available_text').html('<?php echo e(trans('labels.not_available')); ?>');
                        // $('.add-btn').attr('disabled', true);
                        $('.add-btn').addClass('d-none');
                        $('#modal_product_price').addClass('d-none');
                        $('#modal_product-original-price').addClass('d-none');
                        $('#detail_plus-minus').addClass('d-none');
                        // $('#sku_stock').addClass('d-none');
                        $('#tax').addClass('d-none');
                        $('#stock').addClass('d-none');
                    } else {
                        $('.product-detail-price').removeClass('d-none');
                        $('#detail_not_available_text').html('');
                        $('#modal_price-off').removeClass('d-none');
                        $('.add-btn').removeClass('d-none');
                        // $('#sku_stock').removeClass('d-none');
                        $('#modal_product_price').removeClass('d-none');
                        $('#modal_product-original-price').removeClass('d-none');
                        $('#detail_plus-minus').removeClass('d-none');
                        $('#tax').removeClass('d-none');
                        $('#stock').addClass('d-none');
                        if (data.stock_management == 1) {
                            $('#stock').removeClass('d-none');
                            $('#detail_out_of_stock').removeClass('d-none');
                            if (data.quantity > 0) {
                                $('#detail_out_of_stock').removeClass('text-danger');
                                $('#detail_out_of_stock').addClass('text-success');
                                $('#detail_out_of_stock').html(data.quantity +
                                    ' <?php echo e(trans('labels.in_stock')); ?>');
                            } else {
                                $('#detail_out_of_stock').removeClass('text-dark');
                                $('#detail_out_of_stock').addClass('text-danger');
                                $('#detail_out_of_stock').html('<?php echo e(trans('labels.out_of_stock')); ?>');
                            }
                        } else {
                            $('#detail_out_of_stock').addClass('d-none');
                        }

                    }
                }

            }
        });
    }

    var formate = "<?php echo e(helper::appdata($vendordata->id)->currency_formate); ?>";
    // var poscondition = "<?php echo e(request()->is('admin/pos/item-details')); ?>";
</script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/products.js')); ?>"></script>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/productmodal.blade.php ENDPATH**/ ?>
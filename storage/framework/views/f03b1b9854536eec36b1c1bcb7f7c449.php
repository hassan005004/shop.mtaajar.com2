<?php $__env->startSection('contents'); ?>

    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                        <a class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <?php if(!empty($productdata)): ?>
                        <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                            <a class="text-dark"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $productdata['category_info']->slug)); ?>"><?php echo e($productdata['category_info']->name); ?></a>
                        </li>
                        <?php if(!empty($productdata['subcategory_info'])): ?>
                            <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                                <a class="text-dark "
                                    href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $productdata['category_info']->slug . '&subcategory=' . $productdata['subcategory_info']->slug)); ?>"><?php echo e($productdata['subcategory_info']->name); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                            aria-current="page"><?php echo e($productdata->name); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <?php if(!empty($productdata)): ?>
        <?php
            if ($productdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
                if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                    $price = $productdata->price - @helper::top_deals($vendordata->id)->offer_amount;
                } else {
                    $price =
                        $productdata->price -
                        $productdata->price * (@helper::top_deals($vendordata->id)->offer_amount / 100);
                }
                $original_price = $productdata->price;
            } else {
                $price = $productdata->price;
                $original_price = $productdata->original_price;
            }
            $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
        ?>
        <!-- PRODUCTS VIEW AREA START -->
        <section class="product-view p-0 mt-5">
            <div class="container">
                <div class="row g-4 g-md-5">

                    <div class="col-md-5 mb-5">
                        <div class="card h-100 overflow-hidden rounded-0 border-0 position-relative">
                            <!-- new big-view -->
                            <div class="sp-loading"><img src="https://via.placeholder.com/1100x1220"
                                    alt=""><br>LOADING IMAGES</div>
                            <div class="sp-wrap">
                                <?php $__currentLoopData = $productdata['multi_image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($image->image_url); ?>">
                                        <img src="<?php echo e($image->image_url); ?>" alt="">
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!-- new big-view -->
                        </div>
                    </div>
                    <div class="col-md-7 mb-4">
                        <div class="product-content px-md-0">
                            <?php if($off > 0): ?>
                                <span class="badge text-bg-primary fs-7 mb-2 rounded-0" id="modal_price-off">
                                    <?php echo e($off); ?> % <?php echo e(trans('labels.off')); ?>

                                </span>
                            <?php endif; ?>
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="text-dark product-title line-2 fs-4 fw-600 my-1">
                                    <?php echo e($productdata->name); ?></h2>
                            </div>

                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-sm-0 mb-1">
                                <div
                                    class="product-detail-price <?php echo e($productdata->is_available == 2 || $productdata->is_deleted == 1 ? 'd-none' : ''); ?>">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="pro-text" id="modal_product_price">
                                            <?php echo e(helper::currency_formate($price, $productdata->vendor_id)); ?> </span>
                                        <?php if($original_price > $price): ?>
                                            <del class="text-muted px-1 fw-500 fs-15 product-original-price"
                                                id="modal_product-original-price"><?php echo e(helper::currency_formate($original_price, $productdata->vendor_id)); ?></del>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- rating star section Start -->
                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                            <div class="d-flex px-sm-2 px-0 py-1 rounded-0 align-items-center p-0 m-0">
                                                <p class="fs-7"><i
                                                        class="text-warning fa-solid fa-star <?php echo e(session()->get('direction') == 2 ? 'ps-1' : 'pe-1'); ?>"></i><span
                                                        class="text-dark fw-500"><?php echo e(number_format($averagerating, 1)); ?></span>
                                                </p>
                                                <span
                                                    class="px-2 d-inline-block text-muted fw-400 fs-15">(<?php echo e($totalreview); ?>

                                                    <?php echo e(trans('labels.reviews')); ?>)</span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="vendor" id="overview_vendor"
                                value="<?php echo e($productdata->vendor_id); ?>">
                            <input type="hidden" name="item_id" id="overview_item_id" value="<?php echo e($productdata->id); ?>">
                            <input type="hidden" name="item_name" id="overview_item_name"
                                value="<?php echo e($productdata->name); ?>">
                            <input type="hidden" name="item_image" id="overview_item_image"
                                value="<?php echo e(@$productdata['product_image']->image); ?>">
                            <input type="hidden" name="item_min_order" id="item_min_order"
                                value="<?php echo e($productdata->min_order); ?>">
                            <input type="hidden" name="item_max_order" id="item_max_order"
                                value="<?php echo e($productdata->max_order); ?>">
                            <input type="hidden" name="item_price" id="item_price" value="<?php echo e($price); ?>">
                            <input type="hidden" name="item_original_price" id="overview_item_original_price"
                                value ="<?php echo e($original_price); ?>">
                            <input type="hidden" name="tax" id="tax_val" value="<?php echo e($productdata->tax); ?>">
                            <input type="hidden" name="variants_name" id="variants_name" value="">
                            <input type="hidden" name="stock_management" id="stock_management"
                                value="<?php echo e($productdata->stock_management); ?>">
                            <input type="hidden" name="qtyurl" id="qtyurl" value="<?php echo e(URL::to('/changeqty')); ?>">
                            <p id="laodertext" class="d-none laodertext"></p>
                            <!-- rating star section End -->
                            <?php if($productdata->has_variation == 2): ?>
                                <?php if($productdata->is_available == 2 || $productdata->is_deleted == 1): ?>
                                    <h3 class="text-danger"><?php echo e(trans('labels.not_available')); ?></h3>
                                <?php endif; ?>
                            <?php else: ?>
                                <h3 class="text-danger" id="detail_not_available_text"></h3>
                            <?php endif; ?>
                            <p id="tax" class="py-1">
                                <?php if($productdata->tax != null && $productdata->tax != ''): ?>
                                    <span class="text-danger text-truncate"> <?php echo e(trans('labels.exclusive_taxes')); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-success text-truncate"> <?php echo e(trans('labels.inclusive_taxes')); ?></span>
                                <?php endif; ?>
                            </p>
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
                                    <div class="d-flex gap-1 align-items-center blink_me mb-2">
                                        <p class="fw-600 text-success m-0"><?php echo $fake_view; ?></p>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(
                                $productdata->sku != '' ||
                                    ($productdata->has_variation == 2 && $productdata->stock_management == 1) ||
                                    $productdata->attchment_name != ''): ?>
                                <div class="border-bottom pb-3 d-block ">
                                    <div class="bg-gray-light p-3 mt-3 rounded-0">
                                        <?php if($productdata->sku != '' && $productdata->sku != null): ?>
                                            <div class="row">
                                                <p class="text-dark">
                                                    <span class="fs-7 fw-semibold"><?php echo e(trans('labels.sku')); ?></span> :
                                                    <span class="text-muted fs-7"
                                                        id="sku"><?php echo e($productdata->sku); ?></span>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($productdata->has_variation == 2 && $productdata->stock_management == 1): ?>
                                            <div class="sku-wrapper product_meta" id="stock">
                                                <span class="fs-7 fw-semibold"><?php echo e(trans('labels.stock')); ?>:</span>

                                                <?php if($productdata->qty > 0): ?>
                                                    <span class="text-success fs-7"><?php echo e($productdata->qty); ?>

                                                        <?php echo e(trans('labels.in_stock')); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="text-danger fs-7"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php elseif($productdata->has_variation == 1): ?>
                                            <div class="sku-wrapper product_meta" id="stock">
                                                <span class="fs-7 fw-semibold text-dark"><?php echo e(trans('labels.stock')); ?>:
                                                </span>
                                                <span class="fs-7" id="detail_out_of_stock"></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($productdata->attchment_name != '' && $productdata->attchment_name != null): ?>
                                            <div>
                                                <?php if($productdata->attchment_name != '' && $productdata->attchment_name != null): ?>
                                                    <a href="<?php echo e($productdata->attchment_url); ?>" target="_blank"
                                                        class="text-dark">
                                                        <p class="fs-7 fw-semibold d-flex align-items-center gap-2">
                                                            <?php echo e($productdata->attchment_name); ?>

                                                            <i class="fa-light fa-file fs-7"></i>
                                                        </p>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e($productdata->attchment_url); ?>" target="_blank">
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
                            <?php if(!empty($productdata->description)): ?>
                                <div class="border-bottom pb-3 d-block">
                                    <div class="row mt-3">
                                        <p class="text-dark fw-semibold mb-1 text-truncate">
                                            <?php echo e(trans('labels.product_details')); ?>

                                        </p>
                                        <div class="col-lg-12 product-description-limit">
                                            <?php echo substr($productdata->description, 0, 420); ?> <a class="fw-bold text-decoration-underline"
                                                href="#read-more" id="readmore"
                                                onclick="$('#read-more a:first').tab('show');"><?php echo e(trans('labels.readmore')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($productdata->has_variation == 1): ?>
                                <div class="product-variations-wrapper">
                                    <div class="size-variation" id="variation">

                                        <?php for($i = 0; $i < count($productdata->variants_json); $i++): ?>
                                            <label class="fw-semibold fs-6 mt-3"
                                                for=""><?php echo e($productdata->variants_json[$i]['variant_name']); ?></label><br>
                                            <div class="d-flex flex-wrap gap-2 border-bottom pb-3 mt-3">
                                                <?php for($t = 0; $t < count($productdata->variants_json[$i]['variant_options']); $t++): ?>
                                                    <label
                                                        class="checkbox-inline check<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_name'])); ?> <?php echo e($t == 0 ? 'active' : ''); ?>"
                                                        id="check_<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t])); ?>"
                                                        for="<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t])); ?>">
                                                        <input type="checkbox" class="" name="skills"
                                                            <?php echo e($t == 0 ? 'checked' : ''); ?>

                                                            value="<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t])); ?>"
                                                            id="<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_name'])); ?>-<?php echo e(str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t])); ?>">
                                                        <?php echo e($productdata->variants_json[$i]['variant_options'][$t]); ?>

                                                    </label>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(count($productdata['extras']) > 0): ?>
                                <div class="woo_pr_color flex_inline_center my-3 border-bottom mt-3 pb-3">
                                    <div class="woo_colors_list text-left">
                                        <span id="extras">
                                            <h6 class="text-dark extra-title fw-semibold"><?php echo e(trans('labels.extras')); ?>

                                            </h6>
                                            <ul class="list-unstyled extra-food mt-3">
                                                <div id="pricelist">
                                                    <?php $__currentLoopData = $productdata['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="mb-2">
                                                            <div
                                                                class="form-check m-0 p-0 d-flex gap-2 align-items-center">
                                                                <input type="checkbox" class="form-check-input p-0 m-0 Checkbox"
                                                                    name="addons[]" extras_name="<?php echo e($extras->name); ?>" value="<?php echo e($extras->id); ?>"
                                                                    price="<?php echo e($extras->price); ?>"
                                                                    id="extracheck_<?php echo e($key); ?>_<?php echo e($productdata->id); ?>">
                                                                <label class="form-check-label w-100 m-0 p-0"
                                                                    for="extracheck_<?php echo e($key); ?>_<?php echo e($productdata->id); ?>">
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span
                                                                            class="fs-7 fw-500"><?php echo e($extras->name); ?></span>
                                                                        <span class="fs-7 fw-500">
                                                                            <?php echo e(helper::currency_formate($extras->price, $productdata->vendor_id)); ?>

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

                            <?php if($productdata->is_available != 2 || $productdata->is_deleted == 1): ?>
                                <div class="border-bottom pb-3">
                                    <div class="row mt-3 g-3" id="detail_plus-minus">
                                        <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                            <div class="col-xl-3 col-6">
                                                <div
                                                    class="input-group qty-input2 small w-100 justify-content-center responsive-margin m-0 rounded-0 hight-modal-btn align-items-center">
                                                    <button
                                                        class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                                        id="minus" data-type="minus"
                                                        data-item_id="<?php echo e($productdata->id); ?>"
                                                        onclick="changeqty($(this).attr('data-item_id'),'minus')"
                                                        value="minus value"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <input type="number"
                                                        class="border text-center item_qty_<?php echo e($productdata->id); ?>"
                                                        name="number" value="1" readonly="">
                                                    <button
                                                        class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                                        id="plus" data-item_id="<?php echo e($productdata->id); ?>"
                                                        onclick="changeqty($(this).attr('data-item_id'),'plus')"
                                                        data-type="plus" value="plus value"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-xl-3 col-6">
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
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata($vendordata->id)->whatsapp_number); ?>'&text= <?php echo e($productdata->name); ?>"
                                                            class="btn py-2 btn-danger btn-enquir rounded-0 w-100"
                                                            id="enquiries" target="_blank">
                                                            <span class="px-1 fs-7 d-flex align-items-center gap-1">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                                <?php echo e(trans('labels.enquiries')); ?>

                                                            </span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if(@helper::checkaddons('whatsapp_message')): ?>
                                                    <?php if(helper::appdata($vendordata->id)->whatsapp_number != '' &&
                                                            helper::appdata($vendordata->id)->whatsapp_number != null): ?>
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo e(helper::appdata($vendordata->id)->whatsapp_number); ?>'&text= <?php echo e($productdata->name); ?>"
                                                            class="btn py-2 btn-danger btn-enquir rounded-0 w-100"
                                                            id="enquiries" target="_blank">
                                                            <span class="px-1 fs-7 d-flex align-items-center gap-1">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                                <?php echo e(trans('labels.enquiries')); ?>

                                                            </span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>

                                        <?php if($productdata->is_available != 2 || $productdata->is_deleted == 1): ?>
                                            <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                <div class="col-xl-3 col-6">
                                                    <button
                                                        class="btn m-0 py-2 btn-secondary rounded-0 w-100 add-btn addtocart"
                                                        onclick="addtocart('<?php echo e($productdata->id); ?>','<?php echo e($productdata->slug); ?>','<?php echo e($productdata->name); ?>','<?php echo e($productdata['product_image']->image); ?>','<?php echo e($productdata->tax); ?>',$('#item_price').val(),'<?php echo e(ucfirst($productdata->attribute)); ?>','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                        <span class="px-1 fs-7"><?php echo e(trans('labels.add_to_cart')); ?></span>
                                                    </button>
                                                </div>
                                                <div class="col-xl-3 col-6">
                                                    <button
                                                        class="btn btn-lg m-0 bg-white border-dark rounded-0 w-100 fs-6 text-dark buynow"
                                                        onclick="addtocart('<?php echo e($productdata->id); ?>','<?php echo e($productdata->slug); ?>','<?php echo e($productdata->name); ?>','<?php echo e($productdata['product_image']->image); ?>','<?php echo e($productdata->tax); ?>',$('#item_price').val(),'<?php echo e(ucfirst($productdata->attribute)); ?>','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','1')">
                                                        <span class="px-1 fs-7"><?php echo e(trans('labels.buy_now')); ?></span>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div
                                class="d-flex flex-wrap gap-sm-2 gap-3 justify-content-between align-items-center w-100 my-3">
                                <div>
                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                            <p class="fs-7 d-flex align-items-center">
                                                <a onclick="managefavorite('<?php echo e($productdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                    class="btn-sm btn-Wishlist cursor-pointer bg-primary <?php echo e(session()->get('direction') == 2 ? 'me-auto' : 'ms-auto'); ?>">
                                                    <span class=" btn-sm btn-Wishlist mx-2 bg-primary">
                                                        <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                            <?php
                                                                $favorite = helper::ceckfavorite(
                                                                    $productdata->id,
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

                                    <?php if($productdata->video_url != '' && $productdata->video_url != null): ?>
                                        <a href="<?php echo e($productdata->video_url); ?>" tooltip="Video"
                                            class=" rounded-circle prod-social m-0" id="btn-video" target="_blank">
                                            <i class="fa-regular fa-video fs-7"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if(helper::appdata($vendordata->id)->google_review != '' && helper::appdata($vendordata->id)->google_review != null): ?>
                                        <a href="<?php echo e(helper::appdata($vendordata->id)->google_review); ?>" target="_blank"
                                            tooltip="Review" class=" rounded-circle prod-social m-0">
                                            <i class="fa-regular fa-star fs-7"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php echo $__env->make('web.service-trusted', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                    </div>
                </div>

                <!-- description section start-->
                <ul class="nav nav-pills pb-4 mb-4 gap-3 border-bottom border-top pt-4" id="read-more" role="tablist">

                    <li class="nav-item " role="presentation">
                        <a class="nav-link active p-3 px-4" aria-current="page" data-bs-toggle="pill"
                            data-bs-target="#pills-description"
                            href="javascript:void(0)"><?php echo e(trans('labels.description')); ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link p-3 px-4" href="javascript:void(0)" data-bs-toggle="pill"
                            data-bs-target="#pills-additional_info"><?php echo e(trans('labels.additional_info')); ?></a>
                    </li>
                    <?php if(@helper::checkaddons('product_reviews')): ?>
                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-3 px-4" href="javascript:void(0)" data-bs-toggle="pill"
                                    data-bs-target="#pills-review"><?php echo e(trans('labels.reviews')); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <div class="tab-content mb-3" id="read-moreContent">

                    <div class="tab-pane fade" id="pills-additional_info" role="tabpanel"
                        aria-labelledby="pills-additional_info-tab"><?php echo $productdata->additional_info; ?></div>
                    <div class="tab-pane fade active show" id="pills-description" role="tabpanel"
                        aria-labelledby="pills-description-tab"><?php echo $productdata->description; ?></div>
                    <?php if(@helper::checkaddons('product_reviews')): ?>
                        <?php echo $__env->make('web.product_review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
                <!-- description section end-->
            </div>
        </section>
        <!-- PRODUCTS VIEW AREA END -->
        <?php if(@helper::checkaddons('sticky_cart_bar')): ?>
            <?php echo $__env->make('web.view-cart-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php else: ?>
        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- RELATED PRODUCTS AREA START -->
    <?php if(count($getrelatedproductslist) > 0): ?>
        <section class="related my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading py-4 flex-wrap gap-2 border-top">
                            <h4 class="text-dark text-truncate fw-600"><?php echo e(trans('labels.top_related_products')); ?></h4>
                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $productdata['category_info']->slug)); ?>"
                                class="btn btn-fashion "><?php echo e(trans('labels.viewall')); ?></a>
                        </div>
                    </div>
                </div>
                <?php if(helper::appdata(@$vdata)->theme == 1): ?>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 best-product pro-hover">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.productcommonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 2): ?>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mb-4">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-2.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 3): ?>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-3.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 4): ?>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0 product-list">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-4.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 5): ?>
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3 product-list">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-5.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 6): ?>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-6.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 7): ?>
                    <div
                        class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-md-4 g-3 theme-7-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-7.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 8): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-8-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-8.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 9): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-9-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-9.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 10): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-10-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-10.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 11): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-11 theme-11-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-11.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 12): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-12 theme-12-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-12.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 13): ?>
                    <div class="row g-sm-3 g-2 theme-13-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-13.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 14): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-14-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-14.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 15): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-15-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-15.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 16): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 theme-16 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-16.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 17): ?>
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-17 theme-5-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-17.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 18): ?>
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-18 theme-4-best-Selling-product">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-18.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 19): ?>
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item p-1 theme-19 h-100">
                                <?php echo $__env->make('web.theme-19.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <?php if(helper::appdata(@$vdata)->theme == 20): ?>
                    <div class="top-deals20 owl-carousel owl-theme">
                        <?php $__currentLoopData = $getrelatedproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item p-1 theme-20 h-100">
                                <?php echo $__env->make('web.theme-20.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

        </section>
        <?php echo e($getrelatedproductslist->appends(request()->query())->links()); ?>

    <?php endif; ?>
    <!-- RELATED PRODUCTS AREA END -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
                $('#laodertext').html(
                    '<span class="loader"></span>'
                );
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

                        var off = ((1 - (data.price / data.original_price)) * 100).toFixed(1);
                        $('#laodertext').addClass('d-none');
                        $('.product-detail-price').removeClass('d-none');
                        $('#variants_name').val(variants);

                        $('#modal_product_price').text(currency_formate(parseFloat(price)));
                        $('#item_price').val(price);
                        $('#modal_price-off').removeClass('d-none');
                        if (parseFloat(original_price) > parseFloat(price)) {
                            $('#modal_product-original-price').text(currency_formate(parseFloat(
                                original_price)));
                            $('#modal_price-off').text($.number(off, 1) + ' ' + '% OFF');
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
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/smoothproducts.js')); ?>"></script>
    <script>
        // Product Preview
        $('.sp-wrap').smoothproducts();
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/products.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/productdetails.blade.php ENDPATH**/ ?>
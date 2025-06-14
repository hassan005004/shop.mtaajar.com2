<section class="view-cart-bar d-none">
    <div class="container">
        <div class="row g-2 align-items-center">
            <div class="col-xl-6 col-md-6">
                <div class="d-flex gap-3 align-items-center">
                    <div class="product-img">
                        <img src="<?php echo e(helper::image_path($productdata['product_image']->image)); ?>" class="rounded">
                    </div>
                    <div>
                        <h5 class="text-dark line-2 fw-600 my-1">
                            <?php echo e($productdata->name); ?></h5>
                        <div class="d-flex gap-1 flex-wrap align-items-center">
                            <span class="fs-6 fw-600" id="modal_product_price">
                                <?php echo e(helper::currency_formate($price, $productdata->vendor_id)); ?> </span>
                            <?php if($original_price > $price): ?>
                                <del class="text-muted fw-500 fs-8 product-original-price"
                                    id="modal_product-original-price"><?php echo e(helper::currency_formate($original_price, $productdata->vendor_id)); ?></del>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="row g-2 justify-content-end">
                    <div class="col-md-4 col-12">
                        <div
                            class="input-group qty-input2 small w-100 justify-content-center responsive-margin m-0 rounded-0 hight-modal-btn align-items-center">
                            <button class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                data-item_id="<?php echo e($productdata->id); ?>"
                                onclick="changeqty($(this).attr('data-item_id'),'minus')"><i class="fa fa-minus"></i>
                            </button>
                            <input type="number" class="border text-center item_qty_<?php echo e($productdata->id); ?>"
                                name="number" value="1" readonly>
                            <button class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                data-item_id="<?php echo e($productdata->id); ?>"
                                onclick="changeqty($(this).attr('data-item_id'),'plus')"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <button class="btn m-0 py-2 btn-secondary rounded-0 w-100 addtocart"
                            onclick="addtocart('<?php echo e($productdata->id); ?>','<?php echo e($productdata->slug); ?>','<?php echo e($productdata->name); ?>','<?php echo e($productdata['product_image']->image); ?>','<?php echo e($productdata->tax); ?>',$('#overview_item_price').val(),'<?php echo e(ucfirst($productdata->attribute)); ?>','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                            <span class="px-1 fs-7"><?php echo e(trans('labels.add_to_cart')); ?></span>
                        </button>
                    </div>
                    <div class="col-md-4 col-12">
                        <button class="btn btn-lg m-0 bg-white border-dark rounded-0 w-100 fs-6 text-dark buynow"
                            onclick="addtocart('<?php echo e($productdata->id); ?>','<?php echo e($productdata->slug); ?>','<?php echo e($productdata->name); ?>','<?php echo e($productdata['product_image']->image); ?>','<?php echo e($productdata->tax); ?>',$('#overview_item_price').val(),'<?php echo e(ucfirst($productdata->attribute)); ?>','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','1')">
                            <span class="px-1 fs-7"><?php echo e(trans('labels.buy_now')); ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/view-cart-bar.blade.php ENDPATH**/ ?>
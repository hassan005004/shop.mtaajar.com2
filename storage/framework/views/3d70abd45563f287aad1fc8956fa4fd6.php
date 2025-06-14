<?php if(helper::appdata($vendordata->id)->min_order_amount_for_free_shipping > 0): ?>
    <?php if(helper::appdata($vendordata->id)->cart_checkout_progressbar == 1): ?>
        <div class="py-3 my-3">
            <div class="col-12">
                <?php
                    $percentage = round(
                        ($subtotal / helper::appdata($vendordata->id)->min_order_amount_for_free_shipping) * 100,
                    );
                ?>

                <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width: <?php echo e($percentage); ?>%; background-color: <?php if($percentage <= 33): ?> var(--bs-danger) <?php elseif($percentage > 33 && $percentage <= 66): ?> var(--bs-warning) <?php else: ?> var(--bs-success) <?php endif; ?>">
                        <div class="w-100 d-flex justify-content-end">
                            <i
                                class="fa-solid fa-truck-fast fs-5 text-light <?php echo e(session()->get('direction') == 2 ? 'glyphicon' : ''); ?>"></i>
                        </div>
                    </div>
                </div>

                <?php
                    $updatedprice = helper::appdata($vendordata->id)->min_order_amount_for_free_shipping - $subtotal;
                    $pvar = ['{price}'];
                    $pnewvar = [helper::currency_formate($updatedprice, @$vendordata->id)];

                    $progress_message = str_replace(
                        $pvar,
                        $pnewvar,
                        helper::appdata($vendordata->id)->progress_message,
                    );
                ?>



                <?php if($updatedprice <= 0): ?>
                    <p class="fs-7 mt-3 fw-bold text-success text-capitalize">
                        <?php echo e(helper::appdata($vendordata->id)->progress_message_end); ?></p>
                <?php else: ?>
                    <p class="fs-7 mt-3 fw-bold text-capitalize"><?php echo e($progress_message); ?></p>
                <?php endif; ?>


            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/cart_checkout_progressbar.blade.php ENDPATH**/ ?>
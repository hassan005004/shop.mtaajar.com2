<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<div class="offcanvas offcanvas-end " id="cart-offCanvas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <button type="button"
        class="closing-button-1 <?php echo e(session()->get('direction') == 2 ? 'closing-button-1-right' : 'closing-button-1-left'); ?> d-none d-md-block"
        data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fa-regular fa-xmark fs-4"></i>
    </button>
    <div class="offcanvas-header py-3 gap-1 px-2 gx-3 align-items-center">
        <select id="customer" class="form-select fs-7" aria-label="Default select example">
            <option value="0"><?php echo e(trans('labels.walk_in_customers')); ?></option>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(@$customer->id); ?>"><?php echo e(@$customer->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="button" class="closing-button-2 border rounded bg-transparent d-block d-md-none"
            data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-regular fa-xmark"></i>
        </button>
    </div>
    <div class="offcanvas-body p-0">
        <table class="table mb-0 table-hover" id="myTable">
            <thead>
                <tr class="table-secondary">
                    <th scope="col"></th>
                    <th scope="col" class="product-text-size fw-500 ps-0"><?php echo e(trans('labels.items')); ?></th>
                    <th scope="col" class="product-text-size fw-500 text-center"> <?php echo e(trans('labels.qty')); ?></th>
                    <th scope="col" class="product-text-size fw-500"><?php echo e(trans('labels.price')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sub_total = 0;
                ?>
                <?php $__currentLoopData = $cartitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="align-middle">
                        <td class="pe-sm-2 py-3 md-2 pe-0">
                            <a <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="RemoveCart('<?php echo e($item->id); ?>')" <?php endif; ?>
                                tooltip="<?php echo e(trans('labels.delete')); ?>" class="btn btn-danger hov btn-sm"> <i
                                    class="fa-regular fa-trash"></i>
                            </a>
                        </td>
                        <td class="ps-1  ps-sm-0 py-3">
                            <h6 class="m-0 product-text-size fw-600"><?php echo e($item->product_name); ?></h6>
                            <p class="m-0 line-1 product-text-size text-muted"><?php echo e($item->variation_name); ?>

                                <?php if($item->variants_price != 0): ?>
                                    (<?php echo e(helper::currency_formate($item->price, $vendor_id)); ?>)
                                <?php endif; ?>
                            </p>
                            <?php
                                $extras_name = explode('|', $item->extras_name);
                                $extras_price = explode('|', $item->extras_price);
                            ?>

                            <?php $__currentLoopData = $extras_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="m-0 line-1 product-text-size text-muted">
                                    <?php echo e($name); ?>

                                    <?php if(isset($extras_price[$index]) && $extras_price[$index] != ''): ?>
                                        (<?php echo e(helper::currency_formate($extras_price[$index], $vendor_id)); ?>)
                                    <?php endif; ?>
                                </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>

                        <td class="py-3">
                            <div class="price-range pb-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="circle"
                                        onclick="qtyupdate('<?php echo e($item->id); ?>','minus','<?php echo e(URL::to('admin/pos/cart/qtyupdate')); ?>','<?php echo e($item->product_id); ?>','<?php echo e($item->variation_id); ?>','<?php echo e($item->qty); ?>')">
                                        <i class="fa-light fa-minus"></i></a>
                                    <input type="text" value="<?php echo e($item->qty); ?>" readonly>
                                    <a class="circle"
                                        onclick="qtyupdate('<?php echo e($item->id); ?>','plus','<?php echo e(URL::to('admin/pos/cart/qtyupdate')); ?>','<?php echo e($item->product_id); ?>','<?php echo e($item->variation_id); ?>','<?php echo e($item->qty); ?>')">
                                        <i class="fa-light fa-plus"></i></a>
                                </div>
                            </div>
                        </td>
                        <?php
                            $itemtotal = floatval($item->product_price) * $item->qty;
                            $sub_total += $itemtotal;
                        ?>
                        <td class="py-3 w-5">
                            <p class="fw-500 text-dark m-0 line-1 product-text-size itemtotal">
                                <?php echo e(helper::currency_formate($itemtotal, $vendor_id)); ?></p>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="offcanvas-footer p-3">
        <form class="footer-form m-0">
            <div class="col-12 d-flex gap-1 fs-7">
                <div class="input-group gap-0 fs-8">
                    <?php if(session()->get('discount') > 0): ?>
                        <input type="text" id="discount-input" class="form-control fs-7" placeholder="Add Discount"
                            aria-label="Add Discount" aria-describedby="button-addon2"
                            value="<?php echo e(session()->get('discount')); ?>" disabled>
                        <button class="btn btn-primary fw-500 border-0 text-light fs-7 rounded-end d-none"
                            type="button" id="apply-discount"> <?php echo e(trans('labels.apply')); ?> </button>
                        <button class="btn bg-danger fw-500 border-0 text-light fs-7 rounded-end " type="button"
                            id="remove-discount"> <?php echo e(trans('labels.remove')); ?> </button>
                    <?php else: ?>
                        <input type="text" id="discount-input" class="form-control fs-7" placeholder="Add Discount"
                            aria-label="Add Discount" aria-describedby="button-addon2">
                        <button class="btn btn-primary fw-500 border-0 text-light fs-7 rounded-end " type="button"
                            id="apply-discount"> <?php echo e(trans('labels.apply')); ?> </button>
                        <button class="btn bg-danger fw-500 border-0 text-light fs-7 rounded-end d-none" type="button"
                            id="remove-discount"> <?php echo e(trans('labels.remove')); ?> </button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
        <div class="col-12 py-2">
            <?php
                $taxtotal = 0;
                $total = $sub_total; // Assume $total is already defined as subtotal

                foreach ($taxArr['tax'] as $index => $name) {
                    $taxtotal += $taxArr['rate'][$index];
                }

                $grandTotal = $taxtotal + $total - session()->get('discount');
            ?>

            <div class="d-flex justify-content-between my-1 py-1">
                <span class="fw-600 fs-13"> <?php echo e(trans('labels.sub_total')); ?> </span>
                <span
                    class="fw-semibold text-dark sub_total"><?php echo e(helper::currency_formate(@$sub_total, $vendor_id)); ?></span>
                <span
                    class="fw-semibold text-dark sub_total1 d-none"><?php echo e(helper::currency_formate($total, $vendor_id)); ?></span>
            </div>

            <div class="text-muted fw-500">
                <div class="d-flex justify-content-between my-1 <?php if(session()->get('discount') == 0): ?> d-none <?php endif; ?>"
                    id="discount_sec">
                    <span class="text-sm"> <?php echo e(trans('labels.discount')); ?> </span>
                    <span class="text-sm discount"
                        id="discount_amount"><?php echo e(helper::currency_formate(session()->get('discount'), $vendor_id)); ?></span>
                </div>
                <?php $__currentLoopData = $taxArr['tax']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between my-1">
                        <span class="text-sm tax_name"><?php echo e($name); ?></span>
                        <span
                            class="text-sm tax-rate"><?php echo e(helper::currency_formate($taxArr['rate'][$index], $vendor_id)); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="d-flex justify-content-between fs-7 underline-2 py-1">
                <span class="fw-semibold text-dark"> <?php echo e(trans('labels.total')); ?> </span>
                <span
                    class="fw-semibold text-dark grand_total"><?php echo e(helper::currency_formate($grandTotal, $vendor_id)); ?></span>
            </div>

        </div>
        <div class="col-12">
            <div class="row gx-3 align-items-center justify-content-between mt-1">
                <div class="col-6">
                    <button id="deleteAllBtn"
                        class="total-pay Empty-cart fs-7 rounded fw-500 bg-danger text-light border-0"
                        onclick="RemoveCart('')"><?php echo e(trans('labels.empty_carts')); ?></button>
                </div>
                <div class="col-6">
                    <button id="order" type="submit" onclick="OrderNow('<?php echo e(URL::to('admin/pos/ordernow')); ?>')"
                        class="orderButton total-pay btn btn-primary fs-7 rounded fw-500 text-light border-0"
                        data-bs-dismiss="offcanvas" aria-label="Close"> <?php echo e(trans('labels.order_now')); ?> </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/pos_cartview.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/pos.js')); ?>" type="text/javascript"></script>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/pos/cartview.blade.php ENDPATH**/ ?>
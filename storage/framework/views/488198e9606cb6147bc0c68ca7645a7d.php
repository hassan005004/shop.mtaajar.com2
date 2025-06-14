<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->

    <section class="py-4 mb-4 bg-light">

        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>

                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                        aria-current="page"><?php echo e(trans('labels.cart')); ?></li>

                </ol>

            </nav>

        </div>

    </section>

    <!-- BREADCRUMB AREA END -->

    <!-- CART AREA START -->
    <?php

        $subtotal = 0;

    ?>
    <section class="cart">
        <div class="container">
            <?php if(count($getcartlist) > 0): ?>
            <?php if(@helper::checkaddons('cart_checkout_countdown')): ?>
            <?php echo $__env->make("web.cart_checkout_countdown", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
                <div class="table-responsive cart-table cart-view">
                    <table class="table m-0 rounded-2 overflow-hidden">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="cart-table-title <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?> text-light p-3">
                                    <?php echo e(trans('labels.product')); ?>

                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    <?php echo e(trans('labels.price')); ?>

                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    <?php echo e(trans('labels.quantity')); ?>

                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    <?php echo e(trans('labels.total')); ?>

                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    <?php echo e(trans('labels.action')); ?>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $getcartlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $subtotal += $cartdata->product_price * $cartdata->qty;
                                ?>
                                <tr class="align-middle">
                                    <td class="p-3">
                                        <div class="product-detail">
                                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $cartdata->product_slug)); ?>"
                                                target="_blank">
                                                <img class="pr-img"
                                                    src="<?php echo e(helper::image_path($cartdata->product_image)); ?>"
                                                    alt="image"></a>
                                            <div
                                                class="details <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                                <a class="cart_title">
                                                    <div class="d-flex justify-content-between">

                                                        <p class="text-dark line-2">
                                                            <?php echo e($cartdata->product_name); ?></p>
                                                    </div>
                                                    <?php if($cartdata->variation_id != '' || $cartdata->extras_id != ''): ?>
                                                        <P class="mb-2 d-flex">
                                                            <span type="button" class="text-muted fw-400 fs-7"
                                                                onclick='showaddons("<?php echo e($cartdata->id); ?>","<?php echo e($cartdata->product_name); ?>","<?php echo e($cartdata->variation_name); ?>","<?php echo e($cartdata->price); ?>","<?php echo e($cartdata->extras_name); ?>","<?php echo e($cartdata->extras_price); ?>")'>
                                                                <?php echo e(trans('labels.customize')); ?>

                                                            </span>
                                                        </P>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </a>
                                                <input type="hidden" name="vendor" id="overview_vendor"
                                                    value="<?php echo e($cartdata->vendor_id); ?>">
                                                <input type="hidden" name="variants_name" id="variants_name"
                                                    value="<?php echo e($cartdata->variation_name); ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <p class="item-price">
                                            <?php echo e(helper::currency_formate($cartdata->price, $cartdata->vendor_id)); ?>

                                        </p>
                                    </td>
                                    <td class="p-3">
                                        <div class="d-flex justify-content-center">
                                            <div
                                                class="input-group qty-input-cart justify-content-center small w-100 responsive-margin m-0 rounded-2 hight-modal-btn align-items-center">
                                                <a class="btn p-0 change-qty-2 h-100 border-0" id="minus"
                                                    data-type="minus" data-item_id="<?php echo e($cartdata->product_id); ?>"
                                                    onclick="qtyupdate('<?php echo e($cartdata->id); ?>','<?php echo e($cartdata->product_id); ?>','<?php echo e($cartdata->variation_id); ?>','<?php echo e($cartdata->product_price); ?>','decreaseValue')"
                                                    value="minus value"><i class="fa fa-minus fs-13"></i>
                                                </a>
                                                <input type="number" class="border-0 text-center bg-transparent"
                                                    id="number_<?php echo e($cartdata->id); ?>" name="number"
                                                    value="<?php echo e($cartdata->qty); ?>" min="1" max="10" readonly>
                                                <a class="btn p-0 change-qty-2 h-100 border-0" id="plus"
                                                    data-item_id="<?php echo e($cartdata->product_id); ?>"
                                                    onclick="qtyupdate('<?php echo e($cartdata->id); ?>','<?php echo e($cartdata->product_id); ?>','<?php echo e($cartdata->variation_id); ?>','<?php echo e($cartdata->product_price); ?>','increase')"
                                                    data-type="plus" value="plus value"><i class="fa fa-plus fs-13"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <p class="fs-15">
                                            <?php echo e(helper::currency_formate($cartdata->product_price * $cartdata->qty, $cartdata->vendor_id)); ?>

                                        </p>
                                    </td>

                                    <td class="p-3">
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:void(0)"
                                                onclick="clearcart('<?php echo e(URL::to(@$vendordata->slug . '/cart/clear-' . $cartdata->id)); ?>')"
                                                class="delete-icon" tooltip="Remove">
                                                <i class="fa-solid fa-trash-can text-light"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>



                <p class="muted <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?> fs-7 line-2 mt-2"> Shipping, taxes, and discounts codes calculated at checkout. (if applicable)</p>

                <!--<?php if(@helper::checkaddons('cart_checkout_progressbar')): ?>-->
                <!--<?php echo $__env->make("web.cart_checkout_progressbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>-->
                <!--<?php endif; ?>-->
                
                <div class="row g-3 justify-content-between pt-3 mb-sm-5 mb-3">
                    
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>" type="button"
                            class="btn fs-14 fw-500 btn-fashion w-100">
                            <i class="fa-light fa-arrow-left-long fw-600"></i>
                            <span class="fw-600 px-1"><?php echo e(trans('labels.back_top_shop')); ?></span>
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <?php if(@helper::checkaddons('customer_login')): ?>
                            <?php if(helper::appdata(@$vendordata->id)->checkout_login_required == 1): ?>
                                <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                    <a class="btn btn-primary rounded-0 py-2 fs-14 w-100"
                                        onclick="checkout('0','<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>')"><span><?php echo e(trans('labels.go_to_checkout')); ?></span></a>
                                <?php else: ?>
                                    <?php if(helper::appdata(@$vendordata->id)->is_checkout_login_required == 1): ?>
                                        <a type="button" class="btn btn-fashion w-100"
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/login')); ?>">
                                            <?php echo e(trans('labels.go_to_checkout')); ?>

                                        </a>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-fashion w-100" data-bs-toggle="modal"
                                            onclick="checkout('1','')" data-bs-target="#loginmodel">
                                            <?php echo e(trans('labels.go_to_checkout')); ?>

                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="btn btn-primary rounded-0 py-2 fs-14 w-100"
                                    onclick="checkout('0','<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>')"><span><?php echo e(trans('labels.go_to_checkout')); ?></span></a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="btn btn-primary rounded-0 py-2 fs-14 w-100"
                                onclick="checkout('0','<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>')"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>"><span><?php echo e(trans('labels.go_to_checkout')); ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </section>
    <input type="hidden" name="qtyurl" id="qtyurl" value="<?php echo e(URL::to('/changeqty')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function showaddons(id, item_name, variation_name, variation_price, extras_name, extras_price) {
            $('#selected_addons_Label').html(item_name);
            var variation_title = "<?php echo e(trans('labels.variants')); ?>";
            var extra_title = "<?php echo e(trans('labels.extras')); ?>";
            var variations = variation_name.split('|');
            var extras = extras_name.split("|");

            var extra_price = extras_price.split('|');


            var html = "";
            if (variations != '') {
                html += '<p class="fw-600 m-0 text-dark" id="variation_title">' + variation_title +
                    '</p><ul class="mt-1 <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>">';
                html += '<li class="px-0 fw-500 fs-7 my-1 d-flex align-items-center justify-content-between">' + variations + '<span class="text-dark fs-7">' +
                    currency_formate(parseFloat(
                        variation_price)) + '</span></li>'
                html += '</ul>';
            }
            $('#item-variations').html(html);
            var html1 = '';
            if (extras != '') {
                $('#extras_title').removeClass('d-none');
                html1 += '<p class="fw-600 m-0" id="extras_title">' + extra_title + '</p><ul class="m-0 <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>">';
                for (i in extras) {
                    html1 += '<li class="px-0 fw-500 fs-7 d-flex my-1 align-items-center justify-content-between">' + extras[i] + '<span class="text-dark fs-7">' +
                        currency_formate(parseFloat(
                            extra_price[i])) + '</span></li>'
                }
                html1 += '</ul>';
            }
            $('#item-extras').html(html1);
            $('#modal_selected_addons').modal('show');
        }

        var minorderamount = "<?php echo e(helper::appdata($vendordata->id)->min_order_amount); ?>";
        var subtotal = "<?php echo e($subtotal); ?>";
        var min_order_amount_msg = "<?php echo e(trans('messages.min_order_amount_required')); ?>";


        function checkout(type, checkouturl) {
            if (minorderamount != "" && minorderamount != null) {
                if (parseInt(minorderamount) > parseInt(subtotal)) {
                    showtoast("error", min_order_amount_msg + ' ' + minorderamount);
                } else {
                    if (type == 0) {
                        location.href = checkouturl;
                    } else {
                        $('#loginmodel').modal('show');
                    }
                }
            } else {
                if (type == 0) {
                    location.href = checkouturl;
                } else {
                    $('#loginmodel').modal('show');
                }
            }

        }

        var is_logedin = "<?php echo e(@Auth::user()->type == 3 ? 1 : 2); ?>";
        var checkouturl = "<?php echo e(URL::to(@$vendordata->slug . '/checkout')); ?>";
        var qtycheckurl = "<?php echo e(URL::to('/cart/qtyupdate')); ?>";
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/products.js')); ?>"></script>

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/cart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/cart/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?> active"
                        aria-current="page"><?php echo e(trans('labels.order_details')); ?></li>
                </ol>   
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <section class="order_detail my-5">
        <div class="container">
            <?php if($order_number == ''): ?>
                <div class="row align-items-center justify-content-between mb-5">
                    <div class="col-lg-6">
                        <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->order_detail_image)); ?>"
                            class="w-100 mb-5 mb-lg-0" alt="tracking">
                    </div>
                    <div class="col-lg-6 col-xl-5">
                        <h2 class="track-title text-truncate"><?php echo e(trans('labels.find_order_title')); ?></h2>
                        <p class="track-description mb-4 line-3"><?php echo e(trans('labels.find_order_subtitle')); ?></p>
                        <form action="<?php echo e(URL::to(@$vendordata->slug . '/find-order')); ?>" method="get">
                            <label class="form-label"><?php echo e(trans('labels.order_id')); ?></label>
                            <div class="input-group mb-4">
                                <input type="text"
                                    class="form-control rounded-0 bg-transparent input-h <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>"
                                    name="order" value="<?php echo e($order_number); ?>"
                                    placeholder="<?php echo e(trans('labels.find_order_placeholder')); ?>">
                            </div>
                            <button class="btn btn-fashion" type="submit"><?php echo e(trans('labels.track_here')); ?></button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($getorderdata)): ?>
                <div class="row gx-0 justify-content-between align-items-end">
                    <div class="card border-0 rounded-0 bg-light mb-3">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                    <div class="d-md-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center justify-contente-between py-2">
                                                <span class="text-dark fw-600 fs-15"><?php echo e(trans('labels.order_id')); ?>

                                                    :&nbsp;</span>
                                                <div class="fw-600 text-dark fs-15">#<?php echo e($getorderdata->order_number); ?>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-contente-between py-2">
                                                <span class="text-dark fw-600 fs-15"><?php echo e(trans('labels.order_date')); ?>

                                                    :&nbsp;</span>
                                                <p
                                                    class="fs-7 <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'ms-auto' : 'me-auto'); ?> ">
                                                    <?php echo e(helper::date_formate($getorderdata->created_at, $getorderdata->vendor_id)); ?>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="px-md-4">
                                            <?php if(helper::appdata($getorderdata->vendor_id)->product_type == 1): ?>
                                                <div class="d-flex align-items-center justify-contente-between py-2">
                                                    <span class="text-dark fw-600 fs-15"><?php echo e(trans('labels.order_status')); ?>

                                                        :&nbsp;</span>
                                                    <p class="fs-7">
                                                        <?php if($getorderdata->status_type == 1): ?>
                                                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                                        <?php elseif($getorderdata->status_type == 2): ?>
                                                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                                        <?php elseif($getorderdata->status_type == 4): ?>
                                                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                                        <?php elseif($getorderdata->status_type == 3): ?>
                                                            <?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?>

                                                        <?php endif; ?>

                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item d-flex align-items-center px-0 bg-light border-bottom-0">
                                                    <span class="text-dark fw-600 fs-15"><?php echo e(trans('labels.payment_type')); ?>

                                                        :&nbsp;</span>
                                                    <span class="text-dark fs-7">
                                                        <?php if($getorderdata->transaction_type == 0): ?>
                                                            <?php echo e(trans('labels.online')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(@helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name); ?>

                                                        <?php endif; ?>

                                                    </span>
                                                </li>
                                                <?php if(
                                                    $getorderdata->transaction_type != '1' &&
                                                        $getorderdata->transaction_type != '6' &&
                                                        $getorderdata->transaction_type != '16' &&
                                                        $getorderdata->transaction_type != '0'): ?>
                                                    <li class="list-group-item d-flex px-0 bg-light">
                                                        <strong><?php echo e(trans('labels.payment_id')); ?> :&nbsp;</strong>
                                                        <span><?php echo e($getorderdata->transaction_id); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                                    <?php if($getorderdata->status_type == 1): ?>
                                        <a class="btn btn-danger text-white btn-outline-danger fw-500 <?php echo e(session()->get('direction') == 2 ? 'float-start' : 'float-end'); ?>"
                                            href="javascript:void(0)"
                                            onclick="cancelorder('<?php echo e(URL::to(@$vendordata->slug . '/orders-cancel-' . $getorderdata->order_number)); ?>')"><?php echo e(trans('labels.cancel_order')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between mb-4">
                            <div
                                class="col-md-4 mb-3 mb-md-0 <?php echo e(session()->get('direction') == 2 ? 'text-end' : ' text-start'); ?>">
                                <div class="card border-0 bg-light rounded-0 h-100">
                                    <div class="card-body">
                                        <span class="text-dark fs-15 fw-600"> <?php echo e(trans('labels.sold_by')); ?> : </span>
                                        <p class="fs-7 mt-1"><?php echo e(@$vendordata->name); ?></p>
                                        <p class="fs-7 mt-1"><?php echo e(@helper::appdata(@$vendordata->id)->contact); ?></p>
                                        <p class="fs-7 mt-1"><?php echo e(@helper::appdata(@$vendordata->id)->email); ?></p>
                                        <p class="fs-7 mt-1"><?php echo e(@helper::appdata(@$vendordata->id)->address); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if(helper::appdata($vendordata->id)->product_type == 1): ?>
                                <div
                                    class="col-md-4 mb-3 mb-md-0 <?php echo e(session()->get('direction') == 2 ? 'text-end' : ' text-start'); ?>">
                                    <div class="card border-0 bg-light rounded-0 h-100">
                                        <div class="card-body">
                                            <span class="text-dark fs-15 fw-600"> <?php echo e(trans('labels.billing_address')); ?> :
                                            </span>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.address')); ?> :
                                                <?php echo e($getorderdata->billing_address); ?></p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.landmark')); ?> :
                                                <?php echo e($getorderdata->billing_landmark); ?>

                                            </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.postalcode')); ?> :
                                                <?php echo e($getorderdata->billing_postal_code); ?></p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.city')); ?> :
                                                <?php echo e($getorderdata->billing_city); ?>

                                            </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.state')); ?> :
                                                <?php echo e($getorderdata->billing_state); ?>

                                            </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.country')); ?> :
                                                <?php echo e($getorderdata->billing_country); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 <?php echo e(session()->get('direction') == 2 ? 'text-end' : ' text-start'); ?>">
                                    <div class="card border-0 bg-light rounded-0 h-100">
                                        <div class="card-body">
                                            <span class="text-dark fw-600 fs-15"> <?php echo e(trans('labels.shipping_address')); ?> :
                                            </span>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.address')); ?> :
                                                <?php echo e($getorderdata->shipping_address); ?>

                                            </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.landmark')); ?> :
                                                <?php echo e($getorderdata->shipping_landmark); ?>

                                            </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.postalcode')); ?> :
                                                <?php echo e($getorderdata->shipping_postal_code); ?> </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.city')); ?> :
                                                <?php echo e($getorderdata->shipping_city); ?>

                                            </p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.state')); ?> :
                                                <?php echo e($getorderdata->shipping_state); ?></p>
                                            <p class="fs-7 mt-1"><?php echo e(trans('labels.country')); ?> :
                                                <?php echo e($getorderdata->shipping_country); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if($getorderdata->notes != '' && $getorderdata->notes != null): ?>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-0 h-100">
                                        <div class="card-body">
                                            <span class="text-dark fw-bold"> <?php echo e(trans('labels.note')); ?> :
                                            </span>
                                            <p class="fs-7 mt-1">
                                                <?php echo e($getorderdata->notes); ?>

                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row mb-4">
                            <div class="col-md-12 col-lg-7 col-xl-8 mb-4 mb-lg-0">
                                <div class="card border-0 bg-light rounded-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-capitalize fs-15 fw-600">
                                                        <td><?php echo e(trans('labels.image')); ?></td>
                                                        <td><?php echo e(trans('labels.product')); ?></td>
                                                        <td><?php echo e(trans('labels.unit_cost')); ?></td>
                                                        <td><?php echo e(trans('labels.qty')); ?></td>
                                                        <td><?php echo e(trans('labels.sub_total')); ?></td>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $getorderitemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class="fs-7 fw-500 align-middle">
                                                            <?php if($product->extras_id != ''): ?>
                                                                <?php
                                                                
                                                                $extras_id = explode('|', $product->extras_id);
                                                                
                                                                $extras_name = explode('|', $product->extras_name);
                                                                
                                                                $extras_price = explode('|', $product->extras_price);
                                                                
                                                                $extras_total_price = 0;
                                                                
                                                                ?>
                                                                <br>
                                                                <?php $__currentLoopData = $extras_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $extras_total_price += $extras_price[$key];
                                                                    ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php
                                                                    $extras_total_price = 0;
                                                                ?>
                                                            <?php endif; ?>

                                                            <td><img src="<?php echo e(helper::image_path($product->product_image)); ?>"
                                                                    class="object-fit-cover rounded hw-70-px"> </td>
                                                            <td>
                                                                <p class="text-capitalize"> <?php echo e($product->product_name); ?>

                                                                </p>
                                                                <?php if($product->variation_id != '' || $product->extras_id != ''): ?>
                                                                    <P class="text-capitalize">
                                                                        <span type="button" class="text-muted fs-7"
                                                                            onclick='showaddons("<?php echo e($product->id); ?>","<?php echo e($product->product_name); ?>","<?php echo e($product->variation_name); ?>","<?php echo e($product->price); ?>","<?php echo e($product->extras_name); ?>","<?php echo e($product->extras_price); ?>")'>
                                                                            <?php echo e(trans('labels.customize')); ?>

                                                                        </span>
                                                                    </P>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php
                                                                $price = (float) $product->product_price;
                                                                $total = (float) $price * (float) $product->qty;
                                                            ?>
                                                            <td><?php echo e(helper::currency_formate($product->product_price, $product->vendor_id)); ?>

                                                            </td>
                                                            <td><?php echo e($product->qty); ?></td>
                                                            <td> <?php echo e(helper::currency_formate($total, $product->vendor_id)); ?>

                                                            </td>
                                                            
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-12">
                                <div class="card bg-light border-0 rounded-0">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between px-0 pt-0 border-0 bg-light">
                                                <span class="fw-500 fs-15"><?php echo e(trans('labels.sub_total')); ?></span>
                                                <span
                                                    class="fw-600 fs-15"><?php echo e(helper::currency_formate($getorderdata->sub_total, $getorderdata->vendor_id)); ?></span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between px-0 py-2 border-0 bg-light">
                                                <span class="fw-500 fs-15"><?php echo e(trans('labels.discount')); ?>

                                                    <?php echo e($getorderdata->offer_code != '' ? '(' . $getorderdata->offer_code . ')' : ''); ?>

                                                </span>
                                                <span class="fw-600 fs-15">-
                                                    <?php echo e(helper::currency_formate($getorderdata->offer_amount, $getorderdata->vendor_id)); ?></span>
                                            </li>
                                            <?php
                                                $tax = explode('|', $getorderdata->tax_amount);
                                                $tax_name = explode('|', $getorderdata->tax_name);
                                            ?>
                                            <?php if($getorderdata->tax_amount != null && $getorderdata->tax_amount != ''): ?>
                                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between px-0 py-2 border-0 bg-light">
                                                        <span class="fw-500 fs-15"><?php echo e($tax_name[$key]); ?></span>
                                                        <span
                                                            class="fw-600 fs-15"><?php echo e(helper::currency_formate(@(float) $tax[$key], $getorderdata->vendor_id)); ?></span>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <?php if($getorderdata->delivery_charge != null && $getorderdata->delivery_charge != ''): ?>
                                                <li
                                                    class="list-group-item d-flex justify-content-between px-0 py-2 border-0 bg-light">
                                                    <span
                                                        class="fw-500 fs-15"><?php echo e(trans('labels.delivery_charge')); ?>(<?php echo e($getorderdata->shipping_area); ?>)</span>
                                                    <span
                                                        class="fw-600 fs-15"><?php echo e(helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id)); ?></span>
                                                </li>
                                            <?php endif; ?>
                                            <li
                                                class="list-group-item d-flex justify-content-between px-0 pb-0 border-0 border-top-dashed text-secondary bg-light">
                                                <span class="fw-600 fs-16"><?php echo e(trans('labels.total')); ?>

                                                    <?php echo e(trans('labels.amount')); ?></span>
                                                <span
                                                    class="fw-600 fs-16"><?php echo e(helper::currency_formate($getorderdata->grand_total, $getorderdata->vendor_id)); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </section>
    <!-- ORDER DETAILS AREA END -->
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
                html += '<li class="px-0 fs-7 fw-500 my-1 d-flex align-items-center justify-content-between">' + variations + '<span class="text-dark fs-7">' +
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
                    html1 += '<li class="px-0 fs-7 my-1 fw-500 d-flex align-items-center justify-content-between">' + extras[i] + '<span class="text-dark fs-7">' +
                        currency_formate(parseFloat(
                            extra_price[i])) + '</span></li>'
                }
                html1 += '</ul>';
            }
            $('#item-extras').html(html1);
            $('#modal_selected_addons').modal('show');
        }
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/orders.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/orders/order_details.blade.php ENDPATH**/ ?>
<html>

<head>
    <title><?php echo e(helper::appdata($getorderdata->vendor_id)->web_title); ?></title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0"><?php echo e(trans('labels.invoice')); ?></h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100"><?php echo e(trans('labels.invoice_id')); ?> - <span
                    class="gray-color">#<?php echo e($getorderdata->id); ?></span></p>
            <p class="m-0 pt-5 text-bold w-100"><?php echo e(trans('labels.order_id')); ?> - <span
                    class="gray-color">#<?php echo e($getorderdata->order_number); ?></span></p>
            <p class="m-0 pt-5 text-bold w-100"><?php echo e(trans('labels.order_date')); ?> - <span
                    class="gray-color"><?php echo e(helper::date_formate($getorderdata->created_at, $getorderdata->vendor_id)); ?></span>
            </p>
        </div>

        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50"><?php echo e(trans('labels.customer_info')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.billing_address')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.shipping_address')); ?></th>
            </tr>
            <tr>
                <td>
                    <div class="box-text">
                        <p><i class="fa-regular fa-user"></i> <?php echo e($getorderdata->user_name); ?></p>
                        <p><i class="fa-regular fa-phone"></i> <?php echo e($getorderdata->user_mobile); ?> </p>
                        <p><i class="fa-regular fa-envelope"></i> <?php echo e($getorderdata->user_email); ?></p>

                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <p> <?php echo e($getorderdata->billing_address); ?>,</p>
                        <p><?php echo e($getorderdata->billing_landmark); ?>,</p>
                        <p><?php echo e($getorderdata->billing_postal_code); ?></p>
                        <p> <?php echo e($getorderdata->billing_city); ?>,</p>
                        <p> <?php echo e($getorderdata->billing_state); ?>,</p>
                        <p> <?php echo e($getorderdata->billing_country); ?>.</p>
                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <p> <?php echo e($getorderdata->shipping_address); ?>,</p>
                        <p><?php echo e($getorderdata->shipping_landmark); ?>,</p>
                        <p><?php echo e($getorderdata->shipping_postal_code); ?></p>
                        <p> <?php echo e($getorderdata->shipping_city); ?>,</p>
                        <p> <?php echo e($getorderdata->shipping_state); ?>,</p>
                        <p> <?php echo e($getorderdata->shipping_country); ?>.</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50"><?php echo e(trans('labels.payment')); ?></th>
            </tr>
            <tr>
                <td>
                    <?php if($getorderdata->transaction_type == 0): ?>
                        <?php echo e(trans('labels.online')); ?>

                    <?php elseif($getorderdata->transaction_type == 6): ?>
                        <?php echo e(@helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name); ?>

                        : <small><a href="<?php echo e(helper::image_path($getorderdata->screenshot)); ?>" target="_blank"
                                class="text-danger"><?php echo e(trans('labels.click_here')); ?></a></small>
                    <?php else: ?>
                        <?php echo e(@helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name); ?>

                        - <?php echo e($getorderdata->transaction_id); ?>

                    <?php endif; ?>

                </td>
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50"><?php echo e(trans('labels.product_name')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.unit_cost')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.qty')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.sub_total')); ?></th>
            </tr>
            <?php $__currentLoopData = $ordersdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $itemprice = $orders->price;
                    if ($orders->variants_id != '') {
                        $itemprice = $orders->variants_price;
                    }
                ?>
                <tr align="center">
                    <td><?php echo e($orders->product_name); ?>

                        <?php if($orders->variation_id != ''): ?>
                            - <small><?php echo e($orders->variation_name); ?>

                                (<?php echo e(helper::currency_formate($itemprice, $getorderdata->vendor_id)); ?>)
                            </small>
                        <?php endif; ?>
                        <?php if($orders->extras_id != ''): ?>
                            <?php
                            
                            $extras_id = explode('|', $orders->extras_id);
                            
                            $extras_name = explode('|', $orders->extras_name);
                            
                            $extras_price = explode('|', $orders->extras_price);
                            
                            $extras_total_price = 0;
                            
                            ?>
                            <br>
                            <?php $__currentLoopData = $extras_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <small>
                                    <b class="text-muted"><?php echo e($extras_name[$key]); ?></b> :
                                    <?php echo e(helper::currency_formate($extras_price[$key], $getorderdata->vendor_id)); ?><br>
                                </small>
                                <?php
                                    $extras_total_price += $extras_price[$key];
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </td>
                    <td> <?php echo e(helper::currency_formate($orders->product_price, $orders->vendor_id)); ?>

                    </td>
                    <td><?php echo e($orders->qty); ?></td>
                    <td><?php echo e(helper::currency_formate($orders->product_price * $orders->qty, $orders->vendor_id)); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="7">
                    <div class="total-part">
                        <div class="total-left w-85 float-left" align="right">
                            <p><?php echo e(trans('labels.sub_total')); ?></p>
                            <?php if($getorderdata->offer_amount > 0): ?>
                                <p><strong><?php echo e(trans('labels.discount')); ?></strong><?php echo e($getorderdata->offer_code != '' ? '(' . $getorderdata->offer_code . ')' : ''); ?>

                                </p>
                            <?php endif; ?>
                            <?php
                                $tax = explode('|', $getorderdata->tax_amount);
                                $tax_name = explode('|', $getorderdata->tax_name);
                            ?>
                            <?php if($getorderdata->tax_amount != null && $getorderdata->tax_amount != ''): ?>
                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e($tax_name[$key]); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>


                            <?php if($getorderdata->order_type == 1): ?>
                                <p> <strong><?php echo e(trans('labels.delivery_charge')); ?>(<?php echo e($getorderdata->shipping_area); ?>)</strong></p>
                            <?php endif; ?>
                            <p><?php echo e(trans('labels.grand_total')); ?></p>
                        </div>
                        <div class="total-right w-15 float-left text-bold" align="right">
                            <p> <strong><?php echo e(helper::currency_formate($getorderdata->sub_total, $getorderdata->vendor_id)); ?></strong>
                            </p>
                            <?php if($getorderdata->offer_amount > 0): ?>
                                <p> <strong><?php echo e(helper::currency_formate($getorderdata->offer_amount, $getorderdata->vendor_id)); ?></strong>
                                </p>
                            <?php endif; ?>

                            <?php if($getorderdata->tax_amount != null && $getorderdata->tax_amount != ''): ?>
                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><strong><?php echo e(helper::currency_formate((float) $tax[$key], $getorderdata->vendor_id)); ?></strong>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            </p>

                            <?php if($getorderdata->order_type == 1): ?>
                                <p> <strong><?php echo e(helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id)); ?></strong>
                                </p>
                            <?php endif; ?>
                            <p><strong><?php echo e(helper::currency_formate($getorderdata->grand_total, $getorderdata->vendor_id)); ?></strong>

                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/orders/invoicepdf.blade.php ENDPATH**/ ?>
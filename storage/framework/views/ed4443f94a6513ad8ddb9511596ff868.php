<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo e(trans('labels.print')); ?></title>

    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo e(helper::image_path(@helper::appdata($getorderdata->vendor_id)->favicon)); ?>">

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap.min.css')); ?>">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/fontawesome/all.min.css')); ?>">

    <!-- FontAwesome CSS -->

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/toastr/toastr.min.css')); ?>">

    <!-- Toastr CSS -->

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/sweetalert/sweetalert2.min.css')); ?>">

    <!-- Sweetalert CSS -->

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/style.css')); ?>"><!-- Custom CSS -->

    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/responsive.css')); ?>">

    <!-- Responsive CSS -->

    <style type="text/css">
        body {
            width: 88mm;
            height: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            --webkit-font-smoothing: antialiased;
        }

        #printDiv {
            font-weight: 600;
            margin: 0;
            padding: 0;
            background: #ffffff;
        }

        #printDiv div,
        #printDiv p,
        #printDiv a,
        #printDiv li,
        #printDiv td {
            -webkit-text-size-adjust: none;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }

            #btnPrint {
                display: none;
            }
        }

        /* =================add extra css (Dhruvil)================= */
        .resept {
            width: 80mm;
            background-color: #ececec;
        }

        .fs-10 {
            font-size: 12px !important;
        }

        .underline-3 {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .resept .table>:not(caption)>*>* {
            background-color: transparent !important;
        }

        .product-text-size {
            font-size: .75rem !important;
        }

        .line-1 {
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .line-2 {
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .txt-resept-font-size {
            font-size: 10px;
        }

        .fs-8 {
            font-size: 14px !important;
        }

        .fw-600 {
            font-weight: 600;
        }

        .fw-500 {
            font-weight: 500;
        }
    </style>

</head>

<body>
    <?php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    ?>
    <div id="printDiv">
        <div class="resept p-2">
            <div class="address">
                <h5 class="m-0 text-uppercase fs-8 text-center line-2 fw-600">
                    <?php echo e(@helper::appdata($getorderdata->vendor_id)->web_title); ?></h5>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                    <p class=" m-0 fw-500 text-uppercase fs-10 text-center  text-dark line-1">
                        <?php echo e(trans('labels.name')); ?> :</p>
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark  line-1">
                        <?php echo e(@$getorderdata->user_name); ?>

                    </small>
                </div>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                    <p class="fw-500 m-0 text-uppercase fs-10 text-center  text-dark line-1">
                        <?php echo e(trans('labels.email')); ?> :</p>
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark  line-1">
                        <?php echo e(@$getorderdata->user_email); ?>

                    </small>
                </div>
                <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                    <p class="fw-500 m-0 text-uppercase fs-10 text-center  text-dark line-1">
                        <?php echo e(trans('labels.mobile')); ?> :</p>
                    <small class="fw-500 text-uppercase fs-10 text-center text-dark  line-1">
                        <?php echo e(@$getorderdata->user_mobile); ?>

                    </small>
                </div>
                <?php if($getorderdata->order_notes): ?>
                    <div class="col-12 mt-1 d-flex gap-1 align-items-center justify-content-center">
                        <p class="fw-500 m-0 text-uppercase fs-10 text-center  text-dark line-1">
                            <?php echo e(trans('labels.order_note')); ?> : </p>
                        <small class="fw-500 text-uppercase fs-10 text-center text-dark line-1">
                            <?php echo e($getorderdata->order_notes); ?></small>
                    </div>
                <?php endif; ?>
            </div>
            <div class="total-billes-amount">
                <div class="col-12 d-flex justify-content-between align-items-end">
                    <div>
                        <div class="d-flex gap-1 m-0 mt-1 line-1">
                            <small class="fw-500 text-uppercase fs-10 text-center text-dark">
                                <?php if($getorderdata->order_type == '1'): ?>
                                    <?php echo e(trans('labels.delivery')); ?>

                                <?php endif; ?>

                                <?php if($getorderdata->order_type == '2'): ?>
                                    <?php echo e(trans('labels.pickup')); ?>

                                <?php endif; ?>

                                <?php if($getorderdata->order_type == '4'): ?>
                                    <?php echo e(trans('labels.pos')); ?>

                                <?php endif; ?>
                            </small>
                        </div>
                        <div
                            class="fw-500 d-flex gap-1 align-items-center m-0 text-uppercase fs-10 text-center text-dark">
                            <small class="fw-500 text-uppercase fs-10 text-center text-dark line-1">
                                #<?php echo e(@$getorderdata->order_number); ?>

                            </small>
                        </div>
                    </div>
                    <p
                        class="fw-500 d-flex gap-1 align-items-center justify-content-center m-0 text-uppercase fs-10 text-center text-dark mt-1 line-1">
                        <?php echo e(trans('labels.date')); ?> :
                        <small class="fw-500 text-uppercase fs-10 text-center text-dark line-1">
                            <?php echo e(@helper::date_formate($getorderdata->created_at, $getorderdata->vendor_id)); ?>

                        </small>
                    </p>
                </div>
            </div>

            <table class="table table-borderless my-2 bg-transparent">
                <thead class="underline-3">
                    <tr class="text-secondary">
                        <th scope="col" class=" product-text-size fw-bold">#</th>
                        <th scope="col" class=" product-text-size fw-bold"><?php echo e(trans('labels.item_name')); ?>

                        </th>
                        <th scope="col" class=" product-text-size fw-bold text-end">
                            Price</th>
                        <th scope="col" class=" product-text-size fw-bold text-end"><?php echo e(trans('labels.qty')); ?></th>
                        <th scope="col" class=" product-text-size fw-bold text-end pe-0"><?php echo e(trans('labels.total')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($ordersdetails)): ?>
                        <?php
                            $i = 0;
                            $subtotal = 0;
                            $totalqty = 0;
                        ?>
                        <?php $__currentLoopData = $ordersdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $i++;
                                $subtotal += $item->product_price * $item->qty;
                                $totalqty += $item->qty;
                            ?>
                            <tr class="align-middle">
                                <td class="py-2">
                                    <p class="fw-500 text-dark line-1 m-0 product-text-size"><?php echo e($i); ?></p>
                                </td>
                                <td class="py-2">
                                    <h6 class="m-0 fw-500 product-text-size">
                                        <?php echo e(@$item->product_name); ?>

                                        <?php if($item->variation_name != null): ?>
                                            (<?php echo e($item->variation_name); ?>)
                                        <?php endif; ?>
                                    </h6>
                                    <?php if($item->extras_id != ''): ?>
                                        <?php
                                            $extras_id = explode('|', $item->extras_id);
                                            $extras_name = explode('|', $item->extras_name);
                                            $extras_price = explode('|', $item->extras_price);
                                            $extras_total_price = 0;
                                        ?>
                                        <br>
                                        <?php $__currentLoopData = $extras_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <small>
                                                <b class="text-muted"><?php echo e($extras_name[$key]); ?></b> :
                                                <?php echo e($extras_price[$key]); ?><br>
                                            </small>
                                            <?php
                                                $extras_total_price += $extras_price[$key];
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php
                                            $extras_total_price = 0;
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <td class="py-2 pe-0 text-end">
                                    <p class="text-dark fw-500 line-1 m-0  product-text-size">
                                        <?php echo e($item->price); ?>

                                    </p>
                                </td>
                                <td class="py-2 text-end">
                                    <div
                                        class="fw-500 product-text-size d-flex align-items-center justify-content-center">
                                        <p class="m-0 text-dark"><?php echo e(@$item->qty); ?></p>
                                    </div>
                                </td>
                                <td class="py-2 pe-0 text-end">
                                    <p class="text-dark fw-500 line-1 m-0  product-text-size">
                                        <?php echo e($item->product_price * $item->qty); ?>

                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="underline-3">
                        <td class="py-2" colspan="3">
                            <h6 class="line-1 m-0 fw-600 product-text-size"><?php echo e(trans('labels.sub_total')); ?></h6>
                        </td>
                        <td class="py-2 text-end">
                            <div class=" product-text-size d-flex align-items-center justify-content-center">
                                <p class="m-0 text-dark"><?php echo e($totalqty); ?></p>
                            </div>
                        </td>
                        <td class="py-2 pe-0 text-end">
                            <p class="text-dark line-1 fw-500 m-0  product-text-size">
                                <?php echo e($subtotal); ?>

                            </p>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="col-12 d-flex mb-2 justify-content-end">
                <div class="col-12">
                    <div class="text-dark">
                        <?php
                            $tax = explode('|', $getorderdata->tax_amount);
                            $tax_name = explode('|', $getorderdata->tax_name);
                        ?>
                        <?php if($getorderdata->tax_amount != null && $getorderdata->tax_amount != ''): ?>
                            <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex justify-content-between text-dark my-1">
                                    <div class="">
                                        <span
                                            class="txt-resept-font-size fw-500 text-uppercase line-1"><?php echo e($tax_name[$key]); ?></span>
                                    </div>
                                    <div class="">
                                        <span
                                            class="txt-resept-font-size fw-500 text-uppercase line-1 text-end"><?php echo e(@(float) $tax[$key]); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between text-dark my-1">
                            <div class="">
                                <span class="txt-resept-font-size fw-500 text-uppercase line-1">
                                    <?php echo e(trans('labels.discount')); ?>

                                </span>
                            </div>
                            <div class="">
                                <span class="txt-resept-font-size fw-500 text-uppercase text-end line-1">
                                    <?php echo e($getorderdata->offer_amount); ?>

                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-dark my-1">
                            <div class="">
                                <span class="txt-resept-font-size fw-500 text-uppercase line-1">
                                    <?php echo e(trans('labels.delivery_charge')); ?>(<?php echo e($getorderdata->shipping_area); ?>)
                                </span>
                            </div>
                            <div class="">
                                <span class="txt-resept-font-size fw-500 text-uppercase line-1 text-end">
                                    <?php echo e($getorderdata->delivery_charge); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-between underline-3 py-2">
                <span class="fw-semibold product-text-size line-1"><?php echo e(trans('labels.grand_total')); ?></span>
                <span class="fw-semibold line-1 product-text-size">
                    <?php echo e($subtotal - $getorderdata->offer_amount + $getorderdata->delivery_charge + array_sum($tax)); ?>

                </span>
            </div>
            <h2 class="my-2 fs-8 fw-600 text-center line-1"><?php echo e(trans('labels.thank_you_note')); ?></h2>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <button type='button' id="btnPrint"
                    class="rounded border-0 bg-danger text-light text-capitalize fs-8 px-3 py-2"><?php echo e(trans('labels.print')); ?></button>
            </div>

        </div>
    </div>

    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>

</body>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/orders/print.blade.php ENDPATH**/ ?>
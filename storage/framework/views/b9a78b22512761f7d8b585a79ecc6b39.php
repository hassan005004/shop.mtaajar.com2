<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.invoice')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/orders')); ?>"><?php echo e(trans('labels.orders')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.invoice')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 my-2 d-flex justify-content-end gap-2">
            <?php if(helper::appdata($vendor_id)->product_type == 1): ?>
                <?php if(helper::appdata($vendor_id)->ship_rocket_on_off == 1): ?>
                <a href="<?php echo e(URL::to('admin/orders/create_order-' . $vendor_id. '-' . $getorderdata->id)); ?>" class="btn btn-primary"><i class="fa-solid fa-rocket"></i> <?php echo e(trans('labels.create_order_in_shiprocket')); ?> </a>
                <?php endif; ?>
                <?php if($getorderdata->status_type == 1 || $getorderdata->status_type == 2): ?>
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                        data-bs-toggle="dropdown"><?php echo e(@helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name); ?></button>
                    <div class="dropdown-menu dropdown-menu-right <?php echo e(Auth::user()->type == 1 ? 'disabled' : ''); ?>">
                        <?php $__currentLoopData = helper::customstauts($getorderdata->vendor_id, $getorderdata->order_type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item w-auto <?php if($getorderdata->status == '1'): ?> fw-600 <?php endif; ?>"
                                onclick="statusupdate('<?php echo e(URL::to('admin/orders/update-' . $getorderdata->id . '-' . $status->id . '-' . $status->type)); ?>')"><?php echo e($status->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-between g-3">
                <div
                    class="<?php echo e(helper::appdata($vendor_id)->product_type == 1 ? 'col-md-3 col-lg-3 col-xl-3' : 'col-md-4 col-lg-4 col-xl-4'); ?>">
                    <div class="card border-0 mb-3 h-100 d-flex shadow">
                        <div
                            class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-clipboard fs-5"></i>
                                <?php echo e(trans('labels.your_order_details')); ?></h6>
                        </div>
                        <div class="card-body">

                            <div class="basic-list-group">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        <p><?php echo e(trans('labels.order_number')); ?></p>
                                        <p class="text-dark fw-600"><?php echo e($getorderdata->order_number); ?></p>
                                    </li>
                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        <?php echo e(trans('labels.order_date')); ?>

                                        <p class="text-muted">
                                            <?php echo e(helper::date_formate($getorderdata->created_at, $vendor_id)); ?></p>
                                    </li>
                                    

                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        <?php echo e(trans('labels.payment_type')); ?>

                                        <span class="text-muted">
                                            <?php if($getorderdata->transaction_type == 0): ?>
                                                <?php echo e(trans('labels.online')); ?>

                                            <?php elseif($getorderdata->transaction_type == 6): ?>
                                                <?php echo e(@helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name); ?>

                                                : <small><a href="<?php echo e(helper::image_path($getorderdata->screenshot)); ?>"
                                                        target="_blank"
                                                        class="text-danger"><?php echo e(trans('labels.click_here')); ?></a></small>
                                            <?php else: ?>
                                                <?php echo e(@helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name); ?>

                                            <?php endif; ?>
                                        </span>
                                    </li>
                                    <?php if(in_array($getorderdata->transaction_type, [2, 3, 4, 5, 7, 8, 9, 10])): ?>
                                        <li class="list-group-item px-0"><?php echo e(trans('labels.payment_id')); ?>

                                            <p class="text-muted">
                                                <?php echo e($getorderdata->transaction_id); ?>

                                            </p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($getorderdata->notes != ''): ?>
                                        <li class="list-group-item px-0"><?php echo e(trans('labels.notes')); ?>

                                            <p class="text-muted">
                                                <?php echo e($getorderdata->notes); ?>

                                            </p>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="<?php echo e(helper::appdata($vendor_id)->product_type == 1 ? 'col-md-3 col-lg-3 col-xl-3' : 'col-md-4 col-lg-4 col-xl-4'); ?>">
                    <div class="card border-0 mb-3 h-100 d-flex shadow">
                        <div
                            class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-user fs-5"></i>
                                <?php echo e(trans('labels.customer_info')); ?>

                            </h6>
                            <p class="text-muted cursor-pointer"
                                onclick="editcustomerdata('<?php echo e($getorderdata->order_number); ?>','<?php echo e($getorderdata->user_name); ?>','<?php echo e($getorderdata->user_mobile); ?>','<?php echo e($getorderdata->user_email); ?>','<?php echo e($getorderdata->billing_address); ?>','<?php echo e($getorderdata->billing_landmark); ?>','<?php echo e($getorderdata->billing_postal_code); ?>','<?php echo e($getorderdata->billing_city); ?>','<?php echo e($getorderdata->billing_state); ?>','<?php echo e($getorderdata->billing_country); ?>','<?php echo e($getorderdata->shipping_address); ?>','<?php echo e($getorderdata->shipping_landmark); ?>','<?php echo e($getorderdata->shipping_postal_code); ?>','<?php echo e($getorderdata->shipping_city); ?>','<?php echo e($getorderdata->shipping_state); ?>','<?php echo e($getorderdata->shipping_country); ?>','customer_info')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="basic-list-group">
                                        <ul class="list-group list-group-flush">

                                            <li
                                                class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                <p><?php echo e(trans('labels.name')); ?></p>
                                                <p class="text-muted"> <?php echo e($getorderdata->user_name); ?></p>
                                            </li>

                                            <?php if($getorderdata->user_mobile != null): ?>
                                                <li
                                                    class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                    <p><?php echo e(trans('labels.mobile')); ?></p>
                                                    <p class="text-muted"><?php echo e($getorderdata->user_mobile); ?></p>
                                                </li>
                                            <?php endif; ?>

                                            <?php if($getorderdata->user_email != null): ?>
                                                <li
                                                    class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                    <p><?php echo e(trans('labels.email')); ?></p>
                                                    <p class="text-muted"><?php echo e($getorderdata->user_email); ?></p>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(helper::appdata($vendor_id)->product_type == 1): ?>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <div class="card border-0 mb-3 h-100 d-flex shadow">

                            <div
                                class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                                <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-file-invoice fs-5"></i>
                                    <?php echo e($getorderdata->order_from == 'pos' ? trans('labels.info') : trans('labels.bill_to')); ?>

                                </h6>
                                <?php if($getorderdata->order_from != 'pos'): ?>
                                    <p class="text-muted cursor-pointer"
                                        onclick="editcustomerdata('<?php echo e($getorderdata->order_number); ?>','<?php echo e($getorderdata->user_name); ?>','<?php echo e($getorderdata->user_mobile); ?>','<?php echo e($getorderdata->user_email); ?>','<?php echo e($getorderdata->billing_address); ?>','<?php echo e($getorderdata->billing_landmark); ?>','<?php echo e($getorderdata->billing_postal_code); ?>','<?php echo e($getorderdata->billing_city); ?>','<?php echo e($getorderdata->billing_state); ?>','<?php echo e($getorderdata->billing_country); ?>','<?php echo e($getorderdata->shipping_address); ?>','<?php echo e($getorderdata->shipping_landmark); ?>','<?php echo e($getorderdata->shipping_postal_code); ?>','<?php echo e($getorderdata->shipping_city); ?>','<?php echo e($getorderdata->shipping_state); ?>','<?php echo e($getorderdata->shipping_country); ?>','bill_info')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <div class="row">

                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <?php if($getorderdata->order_from == 'pos'): ?>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.pos')); ?></p>

                                                        </li>
                                                    <?php else: ?>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.address')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->billing_address); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.landmark')); ?></p>
                                                            <p class="text-muted"><?php echo e($getorderdata->billing_landmark); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.postal_code')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->billing_postal_code); ?>

                                                            </p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.city')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->billing_city); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.state')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->billing_state); ?></p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p><?php echo e(trans('labels.country')); ?></p>
                                                            <p class="text-muted"> <?php echo e($getorderdata->billing_country); ?>.
                                                            </p>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>

                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3 <?php echo e($getorderdata->order_type == 4 ? 'd-none' : ''); ?>">
                        <div class="card border-0 mb-3 h-100 d-flex shadow">
                            <div
                                class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                                <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-file-invoice fs-5"></i>
                                    <?php echo e(trans('labels.shipping_to')); ?>

                                </h6>
                                <p class="text-muted cursor-pointer"
                                    onclick="editcustomerdata('<?php echo e($getorderdata->order_number); ?>','<?php echo e($getorderdata->user_name); ?>','<?php echo e($getorderdata->user_mobile); ?>','<?php echo e($getorderdata->user_email); ?>','<?php echo e($getorderdata->billing_address); ?>','<?php echo e($getorderdata->billing_landmark); ?>','<?php echo e($getorderdata->billing_postal_code); ?>','<?php echo e($getorderdata->billing_city); ?>','<?php echo e($getorderdata->billing_state); ?>','<?php echo e($getorderdata->billing_country); ?>','<?php echo e($getorderdata->shipping_address); ?>','<?php echo e($getorderdata->shipping_landmark); ?>','<?php echo e($getorderdata->shipping_postal_code); ?>','<?php echo e($getorderdata->shipping_city); ?>','<?php echo e($getorderdata->shipping_state); ?>','<?php echo e($getorderdata->shipping_country); ?>','shipping_info')">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">

                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p><?php echo e(trans('labels.address')); ?></p>
                                                        <p class="text-muted"> <?php echo e($getorderdata->shipping_address); ?></p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p><?php echo e(trans('labels.landmark')); ?></p>
                                                        <p class="text-muted"><?php echo e($getorderdata->shipping_landmark); ?></p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p><?php echo e(trans('labels.postal_code')); ?></p>
                                                        <p class="text-muted"> <?php echo e($getorderdata->shipping_postal_code); ?>

                                                        </p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p><?php echo e(trans('labels.city')); ?></p>
                                                        <p class="text-muted"> <?php echo e($getorderdata->shipping_city); ?></p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p><?php echo e(trans('labels.state')); ?></p>
                                                        <p class="text-muted"> <?php echo e($getorderdata->shipping_state); ?></p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p><?php echo e(trans('labels.country')); ?></p>
                                                        <p class="text-muted"> <?php echo e($getorderdata->shipping_country); ?>.</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div
                    class="<?php echo e(helper::appdata($vendor_id)->product_type == 1 ? 'col-md-3 col-lg-3 col-xl-3' : 'col-md-4 col-lg-4 col-xl-4'); ?>">
                    <div class="card border-0 mb-3 h-100 d-flex shadow">
                        <div
                            class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-clipboard fs-5"></i>
                                <?php echo e(trans('labels.notes')); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="basic-list-group">
                                        <?php if($getorderdata->vendor_note != ''): ?>
                                            <div class="alert alert-info" role="alert">
                                                <?php echo e($getorderdata->vendor_note); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <form action="<?php echo e(URL::to('admin/orders/vendor_note')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group col-md-12">
                                    <label for="note"> <?php echo e(trans('labels.note')); ?> </label>
                                    <div class="controls">
                                        <input type="hidden" name="order_id" class="form-control"
                                            value="<?php echo e($getorderdata->order_number); ?>">
                                        <input type="text" name="vendor_note" class="form-control" required>
                                    </div>
                                </div>
                                <div
                                    class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                    <button
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" type="submit" <?php endif; ?>
                                        class="btn btn-primary"> <?php echo e(trans('labels.update')); ?> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 mt-3">
                <div class="card-header d-flex align-items-center justify-content-between bg-transparent text-dark py-3">
                    <div class="d-flex gap-2 align-items-center">
                        <i class="fa-solid fa-bag-shopping fs-5"></i>
                        <h6 class="fw-500 text-dark"><?php echo e(trans('labels.orders')); ?></h6>
                    </div>
                    <a href="<?php echo e(URL::to('admin/orders/print/' . $getorderdata->order_number)); ?>"
                        class="btn btn-secondary px-sm-4 fs-15">
                        <i class="fa fa-pdf" aria-hidden="true"></i> <?php echo e(trans('labels.print')); ?>

                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td><?php echo e(trans('labels.products')); ?></td>
                                    <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <?php echo e(trans('labels.unit_cost')); ?></td>
                                    <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <?php echo e(trans('labels.qty')); ?></td>
                                    <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <?php echo e(trans('labels.sub_total')); ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subtotal = 0;
                                ?>
                                <?php $__currentLoopData = $ordersdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $itemprice = $orders->price;
                                    ?>
                                    <tr class="fs-7 align-middle">
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
                                            <?php else: ?>
                                                <?php
                                                    $extras_total_price = 0;
                                                ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <?php echo e(helper::currency_formate((float) $orders->product_price, $getorderdata->vendor_id)); ?>

                                        </td>
                                        <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <?php echo e($orders->qty); ?></td>
                                        <?php
                                            $total = (float) $orders->product_price * (float) $orders->qty;
                                            $subtotal += $total;
                                        ?>
                                        <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <?php echo e(helper::currency_formate($total, $getorderdata->vendor_id)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr class="fs-15 align-middle">
                                    <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>"
                                        colspan="3">
                                        <p class="m-0 fw-500"><?php echo e(trans('labels.sub_total')); ?></p>
                                    </td>
                                    <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <p class="m-0 fw-500">
                                            <?php echo e(helper::currency_formate($subtotal, $getorderdata->vendor_id)); ?>

                                        </p>
                                    </td>
                                </tr>
                                <?php if($getorderdata->offer_amount > 0): ?>
                                    <tr class="fs-15 align-middle">
                                        <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>"
                                            colspan="3">
                                            <p class="m-0 fw-500"><?php echo e(trans('labels.discount')); ?></p>
                                            <?php echo e($getorderdata->offer_code != '' ? '(' . $getorderdata->offer_code . ')' : ''); ?>

                                        </td>
                                        <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <p class="m-0 fw-500">
                                                -<?php echo e(helper::currency_formate($getorderdata->offer_amount, $getorderdata->vendor_id)); ?>

                                            </p>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php
                                    $tax = explode('|', $getorderdata->tax_amount);
                                    $tax_name = explode('|', $getorderdata->tax_name);
                                ?>
                                <?php if($getorderdata->tax_amount != null && $getorderdata->tax_amount != ''): ?>
                                    <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-15 align-middle">
                                            <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>"
                                                colspan="3">
                                                <p class="m-0 fw-500"><?php echo e($tax_name[$key]); ?></p>
                                            </td>
                                            <td
                                                class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                                <p class="m-0 fw-500">
                                                    <?php echo e(helper::currency_formate((float) $tax[$key], $getorderdata->vendor_id)); ?>

                                                </p>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($getorderdata->order_type == 1): ?>
                                    <?php if($getorderdata->delivery_charge != null && $getorderdata->delivery_charge != ''): ?>
                                        <tr class="fs-15 align-middle">
                                            <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>"
                                                colspan="3">
                                                <p class="m-0 fw-500"><?php echo e(trans('labels.delivery_charge')); ?>(<?php echo e($getorderdata->shipping_area); ?>)</p>
                                            </td>
                                            <td
                                                class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                                <p class="m-0 fw-500">
                                                    <?php echo e(helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id)); ?>

                                                </p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <tr class="fs-16 align-middle">
                                    <td class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?> text-dark"
                                        colspan="3">
                                        <p class="m-0 fw-600"><?php echo e(trans('labels.grand_total')); ?> </p>
                                    </td>
                                    <td
                                        class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?> text-dark">
                                        <p class="m-0 fw-600">
                                            <?php echo e(helper::currency_formate($subtotal + $getorderdata->delivery_charge + array_sum($tax) - $getorderdata->offer_amount, $getorderdata->vendor_id)); ?>

                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="customerinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title text-dark" id="modalbankdetailsLabel"><?php echo e(trans('labels.edit')); ?></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to('admin/orders/customerinfo')); ?>" method="POST">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="order_id" id="modal_order_id" class="form-control" value="">
                        <input type="hidden" name="edit_type" id="edit_type" class="form-control" value="">
                        <div id="customer_info">
                            <div class="form-group col-md-12">
                                <label for="user_name"> <?php echo e(trans('labels.name')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="user_name" id="user_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="user_mobile"> <?php echo e(trans('labels.mobile')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="user_mobile" id="user_mobile" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="user_email"> <?php echo e(trans('labels.email')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="user_email" id="user_email" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="bill_info">
                            <div class="form-group col-md-12">
                                <label for="bill_address"> <?php echo e(trans('labels.address')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="bill_address" id="bill_address" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_landmark"> <?php echo e(trans('labels.landmark')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="bill_landmark" id="bill_landmark" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_pincode"> <?php echo e(trans('labels.pincode')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="bill_pincode" id="bill_pincode" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_city"> <?php echo e(trans('labels.city')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="bill_city" id="bill_city" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_state"> <?php echo e(trans('labels.state')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="bill_state" id="bill_state" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_country"> <?php echo e(trans('labels.country')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="bill_country" id="bill_country" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="shipping_info">
                            <div class="form-group col-md-12">
                                <label for="shipping_address"> <?php echo e(trans('labels.address')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="shipping_address" id="shipping_address"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="shipping_landmark"> <?php echo e(trans('labels.landmark')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="shipping_landmark" id="shipping_landmark"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_pincode"> <?php echo e(trans('labels.pincode')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="shipping_pincode" id="shipping_pincode"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_city"> <?php echo e(trans('labels.city')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="shipping_city" id="shipping_city" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_state"> <?php echo e(trans('labels.state')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="shipping_state" id="shipping_state" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_country"> <?php echo e(trans('labels.country')); ?> </label>
                                <div class="controls">
                                    <input type="text" name="shipping_country" id="shipping_country"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4"
                            data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                        <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" type="submit" <?php endif; ?>
                            class="btn btn-primary px-sm-4"> <?php echo e(trans('labels.save')); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function editcustomerdata(order_id, customer_name, customer_mobile, customer_email, bill_address, bill_landmark,
            bill_pincode, bill_city, bill_state, bill_country, shipping_address, shipping_landmark, shipping_pincode,
            shipping_city, shipping_state, shipping_country, type) {
            "use strict";
            $('#customerinfo').modal('show');
            $('#modal_order_id').val(order_id);
            if (type == "customer_info") {
                $('#user_name').val(customer_name);
                $('#user_mobile').val(customer_mobile);
                $('#user_email').val(customer_email);
                $('#edit_type').val(type);
                $('#customer_info').show();
                $('#bill_info').hide();
                $('#shipping_info').hide();
                $('#bill_address').removeAttr('required');
                $('#bill_landmark').removeAttr('required');
                $('#bill_pincode').removeAttr('required');
                $('#bill_city').removeAttr('required');
                $('#bill_state').removeAttr('required');
                $('#bill_country').removeAttr('required');
                $('#shipping_address').removeAttr('required');
                $('#shipping_landmark').removeAttr('required');
                $('#shipping_pincode').removeAttr('required');
                $('#shipping_city').removeAttr('required');
                $('#shipping_state').removeAttr('required');
                $('#shipping_country').removeAttr('required');
            } else if (type == "bill_info") {
                $('#bill_address').val(bill_address.replace(/[|]+/g, ","));
                $('#bill_landmark').val(bill_landmark.replace(/[|]+/g, ","));
                $('#bill_pincode').val(bill_pincode);
                $('#bill_city').val(bill_city);
                $('#bill_state').val(bill_state);
                $('#bill_country').val(bill_country);
                $('#edit_type').val(type);
                $('#bill_info').show();
                $('#customer_info').hide();
                $('#shipping_info').hide();
                $('#user_name').removeAttr('required');
                $('#user_email').removeAttr('required');
                $('#user_mobile').removeAttr('required');
                $('#shipping_address').removeAttr('required');
                $('#shipping_landmark').removeAttr('required');
                $('#shipping_pincode').removeAttr('required');
                $('#shipping_city').removeAttr('required');
                $('#shipping_state').removeAttr('required');
                $('#shipping_country').removeAttr('required');
            } else {
                $('#shipping_address').val(shipping_address.replace(/[|]+/g, ","));
                $('#shipping_landmark').val(shipping_landmark.replace(/[|]+/g, ","));
                $('#shipping_pincode').val(shipping_pincode);
                $('#shipping_city').val(shipping_city);
                $('#shipping_state').val(shipping_state);
                $('#shipping_country').val(shipping_country);
                $('#edit_type').val(type);
                $('#customer_info').hide();
                $('#bill_info').hide();
                $('#shipping_info').show();
                $('#user_name').removeAttr('required');
                $('#user_email').removeAttr('required');
                $('#user_mobile').removeAttr('required');
                $('#bill_address').removeAttr('required');
                $('#bill_landmark').removeAttr('required');
                $('#bill_pincode').removeAttr('required');
                $('#bill_city').removeAttr('required');
                $('#bill_state').removeAttr('required');
                $('#bill_country').removeAttr('required');
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/orders/invoice.blade.php ENDPATH**/ ?>
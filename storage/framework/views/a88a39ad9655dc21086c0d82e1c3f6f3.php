<div class="row g-3 pt-3 mb-3">

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card box-shadow h-100 <?php echo e(request()->get('status') == '' ? 'border border-primary' : 'border-0'); ?>">

            <?php if(request()->is('admin/report')): ?>
                <a
                    href="<?php echo e(URL::to(request()->url() . '?customer_id=' . request()->get('customer_id') . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate'))); ?>">
                <?php elseif(request()->is('admin/orders')): ?>
                    <a href="<?php echo e(URL::to('admin/orders?status=')); ?>">
                    <?php elseif(request()->is('admin/customers/orders*')): ?>
                        <a href="<?php echo e(URL::to('admin/customers/orders-' . @$userinfo->id . '?status=')); ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="dashboard-card">
                    <span class="card-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </span>
                    <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.total_orders')); ?></p>
                        <h5 class="text-primary fw-600"><?php echo e($totalorders); ?></h4>
                    </span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div
            class="card box-shadow h-100 <?php echo e(request()->get('status') == 'processing' ? 'border border-primary' : 'border-0'); ?>">
            <?php if(request()->is('admin/report')): ?>
                <a
                    href="<?php echo e(URL::to(request()->url() . '?status=processing&customer_id=' . request()->get('customer_id') . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate'))); ?>">
                <?php elseif(request()->is('admin/orders')): ?>
                    <a href="<?php echo e(URL::to('admin/orders?status=processing')); ?>">
                    <?php elseif(request()->is('admin/customers/orders*')): ?>
                        <a href="<?php echo e(URL::to('admin/customers/orders-' . @$userinfo->id . '?status=processing')); ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="dashboard-card">
                    <span class="card-icon">
                        <i class="fa fa-hourglass"></i>
                    </span>
                    <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.processing')); ?></p>
                        <h5 class="text-primary fw-600"><?php echo e($totalprocessing); ?></h4>
                    </span>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div
            class="card box-shadow h-100 <?php echo e(request()->get('status') == 'delivered' ? 'border border-primary' : 'border-0'); ?>">
            <?php if(request()->is('admin/report')): ?>
                <a
                    href="<?php echo e(URL::to(request()->url() . '?status=delivered&customer_id=' . request()->get('customer_id') . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate'))); ?>">
                <?php elseif(request()->is('admin/orders')): ?>
                    <a href="<?php echo e(URL::to('admin/orders?status=delivered')); ?>">
                    <?php elseif(request()->is('admin/customers/orders*')): ?>
                        <a href="<?php echo e(URL::to('admin/customers/orders-' . @$userinfo->id . '?status=delivered')); ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="dashboard-card">
                    <span class="card-icon">
                        <i class="fa fa-check"></i>
                    </span>
                    <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.delivered')); ?></p>
                        <h5 class="text-primary fw-600"><?php echo e($totalcompleted); ?></h4>
                    </span>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div
            class="card box-shadow h-100 <?php echo e(request()->get('status') == 'cancelled' ? 'border border-primary' : 'border-0'); ?>">
            <?php if(request()->is('admin/report')): ?>
                <a
                    href="<?php echo e(URL::to(request()->url() . '?status=cancelled&customer_id=' . request()->get('customer_id') . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate'))); ?>">
                <?php elseif(request()->is('admin/orders')): ?>
                    <a href="<?php echo e(URL::to('admin/orders?status=cancelled')); ?>">
                    <?php elseif(request()->is('admin/customers/orders*')): ?>
                        <a href="<?php echo e(URL::to('admin/customers/orders-' . @$userinfo->id . '?status=cancelled')); ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="dashboard-card">
                    <span class="card-icon">
                        <i class="fa fa-close"></i>
                    </span>
                    <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.cancelled')); ?></p>
                        <h5 class="text-primary fw-600"><?php echo e($totalcancelled); ?></h4>
                    </span>
                </div>
            </div>
            </a>
        </div>
    </div>

    <?php if(request()->is('admin/report*')): ?>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card box-shadow h-100">
                <div class="card-body">
                    <div class="dashboard-card">
                        <span class="card-icon">
                            <i class="fa-regular fa-money-bill-1-wave"></i>
                        </span>
                        <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                            <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.revenue')); ?></p>
                            <h5 class="text-primary fw-600"><?php echo e(helper::currency_formate($totalrevenue, $vendor_id)); ?>

                                </h4>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/orders/statistics.blade.php ENDPATH**/ ?>
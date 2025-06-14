<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center">
    <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e($userinfo->name); ?></h5>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/customers')); ?>"><?php echo e(trans('labels.customers')); ?></a>
            </li>
            <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                aria-current="page"><?php echo e(trans('labels.orders')); ?></li>
        </ol>
    </nav>
</div>
<?php echo $__env->make('admin.orders.statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">

    <div class="col-12">

        <div class="card border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <?php echo $__env->make('admin.orders.orderstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>

            </div>

        </div>

    </div>

</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/customers/order.blade.php ENDPATH**/ ?>
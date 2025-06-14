<?php $__env->startSection('content'); ?>
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.shipping_area')); ?></h5>

                <a href="<?php echo e(URL::to('admin/shipping-area/add')); ?>" class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">

                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>


                </a>

            </div>
            <div class="row">

                <div class="col-12">

                    <div class="card border-0 my-3">

                        <div class="card-body">

                            <div class="table-responsive">

                                <?php echo $__env->make('admin.shippingarea.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/shippingarea/index.blade.php ENDPATH**/ ?>
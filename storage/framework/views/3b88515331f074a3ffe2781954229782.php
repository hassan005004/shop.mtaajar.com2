<?php $__env->startSection('content'); ?>

    <?php

        if (request()->is('admin/sliders*')) {

            $section = 0;

            $title = trans('labels.sliders');

            $url = 'sliders';

        } elseif (request()->is('admin/bannersection-1*')) {

            $section = 1;
 
            $title = trans('labels.section-1');

            $url = 'bannersection-1';

        } elseif (request()->is('admin/bannersection-2*')) {

            $section = 2;

            $title = trans('labels.section-2');

            $url = 'bannersection-2';

        } else {

            $section = 3;

            $title = trans('labels.section-3');

            $url = 'bannersection-3';

        }

    ?>


            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e($title); ?></h5>
                <a href="<?php echo e(URL::to(request()->url() . '/add')); ?>" class="btn btn-secondary px-sm-4 d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders') ? 'role_sliders' : 'role_banners' , Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                </a>

            </div>

            <div class="row">

                <div class="col-12">

                    <div class="card border-0 my-3">

                        <div class="card-body">

                            <div class="table-responsive">

                                <?php echo $__env->make('admin.banner.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/banner/banner.blade.php ENDPATH**/ ?>
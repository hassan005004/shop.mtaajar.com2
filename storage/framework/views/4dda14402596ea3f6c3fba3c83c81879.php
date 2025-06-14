<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.edit')); ?></h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/store_categories')); ?>"><?php echo e(trans('labels.store_categories')); ?></a></li>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.edit')); ?></li>

            </ol>

        </nav>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="<?php echo e(URL::to('admin/store_categories/update-' . $editcategory->id)); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="form-group">

                                <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *

                                    </span></label>

                                <input type="text" class="form-control" name="category_name"

                                    value="<?php echo e($editcategory->name); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>

                              
                            </div>

                            <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">

                                <a href="<?php echo e(URL::to('admin/store_categories')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                <button class="btn btn-primary px-sm-4" <?php if(env('Environment') == 'sendbox'): ?> type="button"

                                    onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/store_categories/edit.blade.php ENDPATH**/ ?>
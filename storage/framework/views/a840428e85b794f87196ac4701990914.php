
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.add_new')); ?></h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/gallery')); ?>"><?php echo e(trans('labels.gallery')); ?></a></li>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>

            </ol>

        </nav>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/admin/gallery/save')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="form-group">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="image[]" multiple required>
                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                            <a href="<?php echo e(URL::to('admin/gallery')); ?>"
                                class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_gallery', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/gallery/add.blade.php ENDPATH**/ ?>
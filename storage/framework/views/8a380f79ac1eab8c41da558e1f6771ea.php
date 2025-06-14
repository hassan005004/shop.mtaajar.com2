<?php $__env->startSection('content'); ?>


        <div class="d-flex justify-content-between align-items-center">

            <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.edit')); ?></h5>

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/categories')); ?>"><?php echo e(trans('labels.categories')); ?></a></li>

                    <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.edit')); ?></li>

                </ol>

            </nav>

        </div>

        <div class="row mt-3">

            <div class="col-12">

                <div class="card border-0 box-shadow">

                    <div class="card-body">

                        <form action="<?php echo e(URL::to('admin/categories/update-'.$editcategory->slug)); ?>" method="POST" enctype="multipart/form-data">

                            <?php echo csrf_field(); ?>

                            <div class="row">

                                <div class="form-group">

                                    <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> * </span></label>

                                    <input type="text" class="form-control" name="category_name" value="<?php echo e($editcategory->name); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>

                                    <?php $__errorArgs = ['category_name'];
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

                                 <div class="form-group">

                                    <label class="form-label"><?php echo e(trans('labels.image')); ?> </label>

                                    <input type="file" class="form-control" name="category_image">

                                     <?php $__errorArgs = ['category_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                    <span class="text-danger"><?php echo e($message); ?></span> <br>

                                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <img src="<?php echo e(helper::image_path($editcategory->image)); ?>" class="img-fluid rounded hw-70 mt-1" alt="">

                                </div>

                                <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">

                                    <a href="<?php echo e(URL::to('admin/categories')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                    <button class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>" <?php if(env('Environment')=='sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/category/edit_category.blade.php ENDPATH**/ ?>
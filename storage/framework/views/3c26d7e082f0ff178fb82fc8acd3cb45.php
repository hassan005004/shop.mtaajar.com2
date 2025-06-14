<?php $__env->startSection('content'); ?>
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.add_new')); ?></h5>

                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item">

                            <a href="<?php echo e(URL::to('admin/sub-categories')); ?>"><?php echo e(trans('labels.sub_categories')); ?></a>

                        </li>

                        <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.add')); ?></li>

                    </ol>

                </nav>

            </div>

            <div class="row mt-3">

                <div class="col-12">

                    <div class="card border-0 box-shadow">

                        <div class="card-body">

                            <form action="<?php echo e(URL::to('admin/sub-categories/store')); ?>" method="POST">

                                <?php echo csrf_field(); ?>

                                <div class="col-12 form-group">

                                    <label class="form-label"><?php echo e(trans('labels.category')); ?><span class="text-danger">

                                            *</span></label>

                                    <select class="form-select" name="category" required>

                                        <option value=""><?php echo e(trans('labels.select')); ?></option>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category') == $category->id ? 'selected' : ''); ?> ><?php echo e($category->name); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>

                                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>

                                <div class="col-12 form-group">

                                    <label class="form-label"><?php echo e(trans('labels.sub_category')); ?><span class="text-danger">

                                            *</span></label>

                                    <input type="text" class="form-control" name="sub_category" value="<?php echo e(old('sub_category')); ?>"

                                    placeholder="<?php echo e(trans('labels.sub_category')); ?>" required>

                                    <?php $__errorArgs = ['sub_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>

                                <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">

                                    <a href="<?php echo e(URL::to('admin/sub-categories')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                    <button class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>" <?php if(env('Environment')=='sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/sub_category/add.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
    <?php
        if (request()->is('admin/sliders*')) {
            $section = 0;
            $title = trans('labels.sliders');
            $url = URL::to('admin/sliders');
        } elseif (request()->is('admin/bannersection-1*')) {
            $section = 1;
            $title = trans('labels.section-1');
            $url = URL::to('admin/bannersection-1');
        } elseif (request()->is('admin/bannersection-2*')) {
            $section = 2;
            $title = trans('labels.section-2');
            $url = URL::to('admin/bannersection-2');
        } else {
            $section = 3;
            $title = trans('labels.section-3');
            $url = URL::to('admin/bannersection-3');
        }
    ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?php echo e($url); ?>"><?php echo e($title); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e($url . '/save'); ?> " method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="section" value="<?php echo e($section); ?>">

                        <div class="row">
                            <?php if($section == 0): ?>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.title')); ?></label>
                                   <input type="text" class="form-control" value="<?php echo e(old('banner_title')); ?>" name="banner_title" placeholder="<?php echo e(trans('labels.title')); ?>" >
                                    <?php $__errorArgs = ['banner_title'];
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
                                <div class="col-sm-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.sub_title')); ?></label>
                                   <input type="text" class="form-control" value="<?php echo e(old('banner_subtitle')); ?>" name="banner_subtitle" placeholder="<?php echo e(trans('labels.sub_title')); ?>">
                                    <?php $__errorArgs = ['banner_subtitle'];
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
                                <div class="col-sm-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <textarea rows="5" class="form-control" value="<?php echo e(old('banner_description')); ?>" name="banner_description" placeholder="<?php echo e(trans('labels.description')); ?>" ></textarea>
                                    <?php $__errorArgs = ['banner_description'];
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
                                <div class="col-sm-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.link_text')); ?></label>
                                   <input type="text" class="form-control" value="<?php echo e(old('banner_link_text')); ?>" name="banner_link_text" placeholder="<?php echo e(trans('labels.link_text')); ?>" >
                                    <?php $__errorArgs = ['banner_link_text'];
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
                            <?php endif; ?>
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.type')); ?></label>
                                <select class="form-select type" name="banner_info">
                                    <option value="0"><?php echo e(trans('labels.select')); ?> </option>
                                    <option value="1" <?php echo e(old('banner_info') == '1' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.category')); ?></option>
                                    <option value="2" <?php echo e(old('banner_info') == '2' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.product')); ?></option>
                                        <option value="3" <?php echo e(old('banner_info') == '3' ? 'selected' : ''); ?>>
                                        <?php echo e(trans('labels.custom_link')); ?></option>
                                </select>
                                <?php $__errorArgs = ['banner_info'];
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
                        <div class="row">
                            <div class="col-sm-6 form-group 1 gravity">
                                <label class="form-label"><?php echo e(trans('labels.category')); ?><span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="category" id="category">
                                    <option value="" selected><?php echo e(trans('labels.select')); ?> </option>
                                    <?php $__currentLoopData = $getcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(old('category') == $item->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category'];
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
                            <div class="col-sm-6 form-group 2 gravity">
                                <label class="form-label"><?php echo e(trans('labels.product')); ?><span class="text-danger"> *
                                    </span></label>
                                <select class="form-select" name="product" id="product">
                                    <option value="" selected><?php echo e(trans('labels.select')); ?> </option>
                                    <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(old('product') == $item->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['product'];
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
                            <div class="col-sm-6 form-group 3 gravity">
                                <label class="form-label"><?php echo e(trans('labels.custom_link')); ?><span class="text-danger"> *
                                    </span></label>
                                <input type="text" name="custom_link" class="form-control" id="custom_link">
                                <?php $__errorArgs = ['custom_link'];
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
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?> <span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="image" required>
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
                        <div class="row">
                            <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                <a href="<?php echo e($url); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banner', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/banner.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/banner/add.blade.php ENDPATH**/ ?>
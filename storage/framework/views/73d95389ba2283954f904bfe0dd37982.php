<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.add_new')); ?></h5>

    <nav aria-label="breadcrumb">

        <ol class="breadcrumb m-0">

            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/users')); ?>"><?php echo e(trans('labels.users')); ?></a></li>

            <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.add')); ?></li>

        </ol>

    </nav>

</div>

<div class="row">

    <div class="col-12">

        <div class="card border-0 box-shadow">

            <div class="card-body">

                <?php if(isset($id)): ?>
                    <form action="<?php echo e(URL::to('admin/clonevendor')); ?>" method="POST">
                    <input type="hidden" class="form-control" name="clone_vendor_id" value="<?php echo e(@$id); ?> " required>
                <?php else: ?>
                    <form action="<?php echo e(URL::to('admin/register_vendor')); ?>" method="POST">
                <?php endif; ?> 
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <?php if(@helper::checkaddons('digital_product')): ?>
                        <div class="form-group col-md-6">
                            <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($store->id); ?>" <?php echo e(old('store') == $store->id ? 'selected' : ''); ?>><?php echo e($store->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_type" class="form-label"><?php echo e(trans('labels.product_type')); ?><span class="text-danger">
                                    * </span></label>
                            <select name="product_type" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <option value="1" <?php echo e(old('store') == 1 ? 'selected' : ''); ?>>
                                    <?php echo e(trans('labels.physical')); ?>

                                </option>
                                <option value="2" <?php echo e(old('store') == 2 ? 'selected' : ''); ?>>
                                    <?php echo e(trans('labels.digital')); ?>

                                </option>
                            </select>

                        </div>
                        <?php else: ?>
                        <div class="form-group col-md-12">
                            <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($store->id); ?>" <?php echo e(old('store') == $store->id ? 'selected' : ''); ?>><?php echo e($store->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <?php endif; ?>
                        <div class="form-group col-md-6">
                            <label for="name" class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>
                            <?php $__errorArgs = ['name'];
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
                        <div class="form-group col-md-6">
                            <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span class="text-danger"> *
                                </span></label>
                            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(trans('labels.email')); ?>" required>
                            <?php $__errorArgs = ['email'];
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
                        <div class="form-group col-md-6">
                            <label for="mobile" class="form-label"><?php echo e(trans('labels.mobile')); ?><span class="text-danger">
                                    * </span></label>
                            <input type="text" class="form-control mobile-number" name="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="<?php echo e(trans('labels.mobile')); ?>" required>
                            <?php $__errorArgs = ['mobile'];
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
                        <div class="form-group col-md-6">
                            <label for="password" class="form-label"><?php echo e(trans('labels.password')); ?><span class="text-danger"> * </span></label>
                            <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" placeholder="<?php echo e(trans('labels.password')); ?>">
                            <?php $__errorArgs = ['password'];
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
                        <div class="form-group col-md-6">
                            <label for="country" class="form-label"><?php echo e(trans('labels.country')); ?><span class="text-danger"> * </span></label>
                            <select name="country" class="form-select" id="country" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="city" class="form-label"><?php echo e(trans('labels.city')); ?><span class="text-danger"> * </span></label>
                            <select name="city" class="form-select" id="city" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                            </select>

                        </div>
                        <?php if(@helper::checkaddons('unique_slug')): ?>
                            <div class="form-group">
                                <label for="basic-url" class="form-label"><?php echo e(trans('labels.personlized_link')); ?><span
                                        class="text-danger"> * </span></label>
                                <?php if(env('Environment') == 'sendbox'): ?>
                                    <span class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                                <?php endif; ?>
                                <div class="input-group ">
                                    <span
                                        class="input-group-text col-5 col-lg-auto overflow-x-auto <?php echo e(session()->get('direction') == 2 ? 'rounded-start-0 rounded-end' : ''); ?>"><?php echo e(URL::to('/')); ?>/</span>
                                    <input type="text" class="form-control <?php echo e(session()->get('direction') == 2 ? 'rounded-end-0 rounded-start' : ''); ?>" id="slug" name="slug"
                                        value="<?php echo e(old('slug')); ?>" required>
                                </div>
                               
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                        <a href="<?php echo e(URL::to('admin/users')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                        <button <?php if(env('Environment')=='sendbox' ): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?> class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
    var select = "<?php echo e(trans('labels.select')); ?>";
    var cityid = "0";
    $('#name').on('blur', function() {
            "use strict";
            $('#slug').val($('#name').val().split(" ").join("-").toLowerCase());
        });
</script>

<script src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/user/add.blade.php ENDPATH**/ ?>
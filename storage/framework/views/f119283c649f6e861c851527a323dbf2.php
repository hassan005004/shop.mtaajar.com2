<?php $__env->startSection('contents'); ?>
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a
                            class="text-dark fw-600" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                        aria-current="page"><?php echo e(trans('labels.edit_profile')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <div class="row">
                <?php echo $__env->make('web.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-lg-8 col-xxl-9">
                    <div class="card p-3">
                        <h5 class="text-dark m-0 mb-3 border-bottom pb-3 profile-title"><?php echo e(trans('labels.edit_profile')); ?></h5>
                        <form action="<?php echo e(URL::to($vendordata->slug . '/editprofile')); ?>" method="post"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" value="<?php echo e($getprofile->id); ?>" name="id">
                                    <label for="name" class="label-style my-2"><?php echo e(trans('labels.name')); ?> : <span
                                            class="required text-danger">*</span></label>
                                    <input type="text" class="form-control input-h rounded-0" name="name"
                                        placeholder="<?php echo e(trans('labels.name')); ?>" value="<?php echo e($getprofile->name); ?>">
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
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="label-style my-2"><?php echo e(trans('labels.email')); ?> : <span
                                            class="required text-danger">*</span></label>
                                    <input type="text" class="form-control input-h rounded-0" name="email"
                                        placeholder="<?php echo e(trans('labels.email')); ?>" value="<?php echo e($getprofile->email); ?>"
                                        readonly>
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
                                <div class="col-md-4 mb-3">
                                    <label for="mobile" class="label-style my-2"><?php echo e(trans('labels.mobile')); ?> : <span
                                            class="required text-danger">*</span></label>
                                    <input type="text" class="form-control input-h rounded-0" name="mobile"
                                        placeholder="<?php echo e(trans('labels.mobile')); ?>" value="<?php echo e($getprofile->mobile); ?>">
                                    <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?> : <span
                                                class="required text-danger">*</span></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="label-style my-2"><?php echo e(trans('labels.image')); ?> : <span
                                                class="required text-danger">*</span></label>
                                        <input type="file" class="form-control rounded-0" name="image"
                                            placeholder="<?php echo e(trans('labels.image')); ?>" value="<?php echo e($getprofile->image); ?>">
                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?> : <span
                                                    class="required text-danger">*</span></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    </div>
                                    <img class="rounded-circle mb-2 object-fit-cover"
                                    src="<?php echo e(helper::image_path(Auth::user()->image)); ?>" alt="" width="70"
                                    height="70">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-fashion mt-3" type="submit"><?php echo e(trans('labels.submit')); ?></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/user/profile.blade.php ENDPATH**/ ?>
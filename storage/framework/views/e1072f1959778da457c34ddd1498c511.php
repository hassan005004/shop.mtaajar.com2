<?php $__env->startSection('contents'); ?>
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a class="text-dark fw-600" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a></li>
                    <li class="text-muted <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active" aria-current="page"><?php echo e(trans('labels.change_password')); ?></li>
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
                        <h5 class="text-dark m-0 mb-3 pb-3 border-bottom profile-title"><?php echo e(trans('labels.change_password')); ?></h5>
                        <form id="deatilsForm" action="<?php echo e(URL::to($vendordata->slug . '/updatepassword/')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" class="label-style my-4"><?php echo e(trans('labels.current_password')); ?> : <span class="required text-danger">*</span></label>
                                    <input type="password" name="current_password" class="form-control input-h form-control-md rounded-0" placeholder="<?php echo e(trans('labels.current_password')); ?>" required="">
                                    <?php $__errorArgs = ['current_password'];
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
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" class="label-style my-4"><?php echo e(trans('labels.new_password')); ?> : <span class="required text-danger">*</span></label>
                                    <input type="password" name="new_password" class="form-control input-h form-control-md rounded-0 mb-0" placeholder="<?php echo e(trans('labels.new_password')); ?>" required="">
                                    <?php $__errorArgs = ['new_password'];
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
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" class="label-style my-4"><?php echo e(trans('labels.confirm_password')); ?> : <span class="required text-danger">*</span></label>
                                    <input type="password" name="confirm_password" class="form-control input-h form-control-md rounded-0 mb-0" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" required="">
                                    <?php $__errorArgs = ['confirm_password'];
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
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-fashion mt-3"><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/user/changepassword.blade.php ENDPATH**/ ?>
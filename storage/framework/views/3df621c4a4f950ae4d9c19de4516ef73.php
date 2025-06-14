<form action="<?php echo e(URL::to('admin/settings/quick_call')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="quick_call">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="d-flex align-items-center card-header p-3 bg-secondary">
                        <h5 class="col-md-6 text-white">
                            <?php echo e(trans('labels.quick_call')); ?></h5>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <input id="quick_call-switch" type="checkbox" class="checkbox-switch" name="quick_call"
                                value="1" <?php echo e(@$settingdata->quick_call == 1 ? 'checked' : ''); ?>>
                            <label for="quick_call-switch" class="switch">
                                <span
                                    class="<?php echo e(session()->get('direction') == '2' ? 'switch__circle-rtl' : 'switch__circle'); ?> switch__circle"><span
                                        class="switch__circle-inner"></span></span>
                                <span
                                    class="switch__left <?php echo e(session()->get('direction') == '2' ? ' pe-2' : ' ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                <span
                                    class="switch__right <?php echo e(session()->get('direction') == '2' ? ' ps-2' : ' pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_name"><?php echo e(trans('labels.name')); ?></label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" name="quick_call_name"
                                    placeholder="<?php echo e(trans('labels.name')); ?>"
                                    value="<?php echo e(@$settingdata->quick_call_name); ?>" required>
                                <?php $__errorArgs = ['quick_call_name'];
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
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_description"><?php echo e(trans('labels.description')); ?></label>
                                <input type="text" class="form-control" name="quick_call_description"
                                    value="<?php echo e(@$settingdata->quick_call_description); ?>"
                                    placeholder="<?php echo e(trans('labels.description')); ?>">
                                <?php $__errorArgs = ['quick_call_description'];
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
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_mobile"><?php echo e(trans('labels.mobile')); ?></label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" name="quick_call_mobile"
                                    placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                    value="<?php echo e(@$settingdata->quick_call_mobile); ?>" required>
                                <?php $__errorArgs = ['quick_call_mobile'];
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
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_image"><?php echo e(trans('labels.image')); ?></label>
                                <input type="file" class="form-control" name="quick_call_image"
                                    placeholder="<?php echo e(trans('labels.image')); ?>">
                                <img src='<?php echo e(helper::image_path(@$settingdata->quick_call_image)); ?>'
                                    class='img-fluid rounded hw-70 mt-1'>
                                <?php $__errorArgs = ['quick_call_image'];
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
                        <div class="text-end">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4  <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_setting', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                <?php echo e(trans('labels.save')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/quick_call/index.blade.php ENDPATH**/ ?>
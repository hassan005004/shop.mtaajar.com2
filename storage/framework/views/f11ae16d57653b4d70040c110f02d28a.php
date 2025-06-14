<form action="<?php echo e(URL::to('admin/settings/ship_rocket_settings')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="ship_rocket">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="card-header p-3 bg-secondary">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="text-capitalize fw-600">
                                <?php echo e(trans('labels.ship_rocket_settings')); ?>

                            </h5>
                            <div>
                                <div class="text-center">
                                    <input id="ship_rocket_on_off" type="checkbox" class="checkbox-switch"
                                        name="ship_rocket_on_off" value="1"
                                        <?php echo e($settingdata->ship_rocket_on_off == 1 ? 'checked' : ''); ?>>
                                    <label for="ship_rocket_on_off" class="switch">
                                        <span
                                            class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                class="switch__circle-inner"></span></span>
                                        <span
                                            class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                        <span
                                            class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label fs-7 fw-500"
                                        for="api_user_email"><?php echo e(trans('labels.api_user_email')); ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="email" min="1" class="form-control" name="api_user_email"
                                        id="api_user_email" value="<?php echo e($settingdata->api_user_email); ?>" required>
                                    <?php $__errorArgs = ['api_user_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span><br>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label fs-7 fw-500"
                                        for="api_user_password"><?php echo e(trans('labels.api_user_password')); ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="password" min="1" class="form-control" name="api_user_password"
                                        id="api_user_password" value="<?php echo e($settingdata->api_user_password); ?>" required>
                                    <?php $__errorArgs = ['api_user_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span><br>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <p class="text-muted"><?php echo e(trans('labels.api_user_email_info')); ?> <a
                                    href="https://www.shiprocket.in/developers/"
                                    target="_blank"><?php echo e(trans('labels.click_here')); ?></a></p>
                        </div>
                        <div class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                            <button
                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_setting', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/ship_rocket/index.blade.php ENDPATH**/ ?>
<div id="custom_domain">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                 
                    <form action="<?php echo e(URL::to('/admin/custom_domain/save')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="form-label"><?php echo e(trans('labels.cname_title')); ?><span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="cname_title" value="<?php echo e($setting->cname_title); ?>" placeholder="<?php echo e(trans('labels.cname_title')); ?>" required>
                                <?php $__errorArgs = ['cname_title'];
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
                            <div class="form-group col-sm-12">
                                <label class="form-label"><?php echo e(trans('labels.cname_text')); ?><span class="text-danger"> * </span></label>
                                <textarea class="form-control" id="ckeditor" name="cname_text" required><?php echo e($setting->cname_text); ?></textarea>
                                <?php $__errorArgs = ['cname_text'];
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
                            <button class="btn btn-primary px-sm-4" <?php if(env('Environment')=='sendbox' ): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" name="updateseo" value="1" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/customdomain/setting_form.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

        <h5 class=" text-capitalize fw-600 fs-4 text-dark"><?php echo e(trans('labels.privacy_policy')); ?></h5>
    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0">

                <div class="card-body">

                    <div id="privacy-policy-three" class="privacy-policy">

                        <form action="<?php echo e(URL::to('admin/privacypolicy/update')); ?>" method="post">

                            <?php echo csrf_field(); ?>

                            <textarea class="form-control" id="ckeditor" name="privacypolicy"><?php echo e(@$getprivacypolicy); ?></textarea>

                            <?php $__errorArgs = ['privacypolicy'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <span class="text-danger"><?php echo e($message); ?></span><br>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?> my-2">
                              
                                <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>

                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_cms_pages', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 || helper::check_access('role_cms_pages', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><?php echo e(trans('labels.save')); ?></button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>

<script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/editor.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/other/privacypolicy.blade.php ENDPATH**/ ?>
<?php $__env->startSection('contents'); ?>
    <section class="my-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-xl-4 col-lg-6 col-12 m-auto login-form-box">
                            <div class="card border-0 rounded-0 h-100">
                                <h4 class="login-title"><?php echo e(trans('labels.forgot_password')); ?></h4>
                                <p class="my-2 text-muted login-subtitle"><?php echo e(trans('labels.forgotpassword_page_title')); ?>

                                </p>
                                <div class="card-body p-0">
                                    <form class="my-3" method="POST"
                                        action="<?php echo e(URL::to($vendordata->slug . '/send_userpassword')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span
                                                    class="text-danger"> * </span></label>
                                            <input type="email" class="form-control input-h rounded-0" name="email"
                                                placeholder="<?php echo e(trans('labels.email')); ?>" id="email" required>
                                        </div>

                                        <button class="btn btn-fashion w-100 mt-4"
                                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> 
                                                type="submit" <?php endif; ?>><?php echo e(trans('labels.submit')); ?></button>
                                    </form>
                                    <p class="fs-7 text-center mt-3"><?php echo e(trans('labels.remember_password')); ?>

                                        <a href="<?php echo e(URL::to($vendordata->slug . '/login')); ?>"
                                            class="text-primary fw-semibold"><?php echo e(trans('labels.login')); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->auth_image)); ?>"
                                class="object-fit-contente w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function AdminFill(email, password) {
            $('#email').val(email);
            $('#password').val(password);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/auth/forgotpassword.blade.php ENDPATH**/ ?>
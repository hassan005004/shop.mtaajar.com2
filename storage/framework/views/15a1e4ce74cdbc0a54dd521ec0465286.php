<?php $__env->startSection('contents'); ?>
    <section class="my-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-6 col-12 m-auto login-form-box">
                            <div class="card border-0 rounded-0 h-100">
                                <h4 class="login-title"><?php echo e(trans('labels.register')); ?></h4>
                                <p class="my-2 text-muted login-subtitle"><?php echo e(trans('labels.register_page_title')); ?></p>
                                <div class="card-body p-0">
                                    <form class="my-3" method="POST"
                                        action="<?php echo e(URL::to($vendordata->slug . '/register_customer')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name" class="form-label"><?php echo e(trans('labels.name')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control input-h rounded-0" name="name"
                                                    value="<?php echo e(old('name')); ?>" id="name"
                                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control input-h rounded-0" name="email"
                                                    value="<?php echo e(old('email')); ?>" id="email"
                                                    placeholder="<?php echo e(trans('labels.email')); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile" class="form-label"><?php echo e(trans('labels.mobile')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="number" class="form-control input-h rounded-0" name="mobile"
                                                    value="<?php echo e(old('mobile')); ?>" id="mobile"
                                                    placeholder="<?php echo e(trans('labels.mobile')); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password"
                                                    class="form-label"><?php echo e(trans('labels.password')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="password" class="form-control input-h rounded-0"
                                                    name="password" value="<?php echo e(old('password')); ?>" id="password"
                                                    placeholder="<?php echo e(trans('labels.password')); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="referral_code"
                                                    class="form-label"><?php echo e(trans('labels.referral_code')); ?></label>
                                                <input type="text" class="form-control input-h rounded-0"
                                                    name="referral_code" value="<?php echo e(@$_GET['referral']); ?>"
                                                    id="referral_code"
                                                    placeholder="<?php echo e(trans('labels.referral_code_op')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked="">
                                                <label class="form-check-label"
                                                    for="flexCheckChecked"><?php echo e(trans('labels.i_accept_the')); ?>

                                                    <a href="<?php echo e(URL::to('/termscondition')); ?>"
                                                        class="text-primary fw-semibold">Terms &amp; Conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                        <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <button class="btn btn-fashion w-100 mt-4"
                                            type="submit"><?php echo e(trans('labels.register')); ?></button>
                                        <p class="fs-7 text-center mt-3">
                                            <?php echo e(trans('labels.already_have_an_account')); ?>

                                            <a href="<?php echo e(URL::to($vendordata->slug . '/login')); ?>"
                                                class="text-primary fw-semibold"><?php echo e(trans('labels.login')); ?></a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->auth_image)); ?>"
                                class="object-fit-cover w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <!-- IF VERSION 2  -->
    <?php if(helper::appdata('')->recaptcha_version == 'v2'): ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php endif; ?>
    <!-- IF VERSION 3  -->
    <?php if(helper::appdata('')->recaptcha_version == 'v3'): ?>
        <?php echo RecaptchaV3::initJs(); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/auth/register.blade.php ENDPATH**/ ?>
<?php $__env->startSection('contents'); ?>
    <div class="">
        <section class="my-5">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-xl-4 col-lg-6 col-12 m-auto login-form-box">
                                <div class="card overflow-hidden border-0 rounded-0 h-100">
                                    <h4 class="login-title"><?php echo e(trans('labels.login')); ?></h4>
                                    <p class="my-2 text-muted login-subtitle"><?php echo e(trans('labels.login_page_title')); ?></p>
                                    <div class="card-body p-0">
                                        <form class="my-3" method="POST"
                                            action="<?php echo e(URL::to($vendordata->slug . '/checklogin-normal')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="email" class="form-label"><?php echo e(trans('labels.email')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control fs-7 input-h rounded-0" name="email"
                                                    placeholder="<?php echo e(trans('labels.email')); ?>" id="email" required>
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
                                            <div class="form-group">
                                                <label for="password" class="form-label"><?php echo e(trans('labels.password')); ?><span
                                                        class="text-danger"> * </span></label>
                                                <input type="password" class="form-control input-h rounded-0"
                                                    name="password" placeholder="<?php echo e(trans('labels.password')); ?>"
                                                    id="password" required>
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
                                            <input type="hidden" class="form-control input-h" name="type"
                                                value="user">
                                            <div class="text-end">
                                                <a href="<?php echo e(URL::to($vendordata->slug . '/forgotpassword')); ?>"
                                                    class="text-dark fs-7 fw-500">
                                                    <i
                                                        class="fa-solid fa-lock-keyhole mx-2 fs-7"></i><?php echo e(trans('labels.forgot_password')); ?>

                                                </a>
                                            </div>
                                            <button class="btn btn-fashion w-100 mt-4"
                                                type="submit"><?php echo e(trans('labels.login')); ?></button>
                                        </form>

                                        <?php if(helper::appdata($vendordata->id)->google_mode == 1 || helper::appdata($vendordata->id)->facebook_mode == 1): ?>
                                            <div class="or_section my-4">
                                                <div class="line"></div>
                                                <p class="text-center mx-3 fs-7"><?php echo e(trans('labels.or_login_with')); ?></p>
                                                <div class="line"></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('google_login')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    $user = App\Models\User::where('id', $vendordata->id)->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $social_logins = 1;
                                                    } else {
                                                        $social_logins = @$checkplan->social_logins;
                                                    }
                                                ?>
                                                <?php if($social_logins == 1): ?>
                                                    
                                                    <div class="social-share mt-0 pt-2 d-md-flex d-grid gap-2">
                                                        <?php if(helper::appdata($vendordata->id)->google_mode == 1): ?>
                                                            <a href="<?php echo e(URL::to($vendordata->slug . '/login/google-user')); ?>"
                                                                class="btn btn-border social-share-icon w-100 rounded-0 d-flex align-items-center justify-content-center">
                                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/images/other/Google__G__Logo.svg.png')); ?>"
                                                                    alt="" class="g-img">
                                                                <span class="px-2"><?php echo e(trans('labels.googletag')); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('google_login')): ?>
                                                <div class="login-form-bottom-icon d-flex">
                                                    <?php if(helper::appdata($vendordata->id)->google_mode == 1): ?>
                                                        <a href="<?php echo e(URL::to($vendordata->slug . '/login/google-user')); ?>"
                                                            class="btn btn-danger w-50"><i
                                                                class="fa-brands fa-google mx-1 my-1 rounded-1"></i>
                                                            <?php echo e(trans('labels.googletag')); ?></a>

                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(@helper::checkaddons('subscription')): ?>
                                            <?php if(@helper::checkaddons('facebook_login')): ?>
                                                <?php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    $user = App\Models\User::where('id', $vendordata->id)->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $social_logins = 1;
                                                    } else {
                                                        $social_logins = @$checkplan->social_logins;
                                                    }
                                                ?>
                                                <?php if($social_logins == 1): ?>
                                                    
                                                    <div class="social-share mt-0 pt-2 d-md-flex d-grid gap-2">
                                                        <?php if(helper::appdata($vendordata->id)->facebook_mode == 1): ?>
                                                            <a href="<?php echo e(URL::to($vendordata->slug . '/login/facebook-user')); ?>"
                                                                class="btn btn-border social-share-icon w-100 rounded-0 d-flex align-items-center justify-content-center">
                                                                <img src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/images/other/Facebook_Logo_(2019).png.webp')); ?>"
                                                                    alt="" class="g-img">
                                                                <span
                                                                    class="px-2"><?php echo e(trans('labels.facebook')); ?></span></a>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(@helper::checkaddons('facebook_login')): ?>
                                                <div class="login-form-bottom-icon d-flex">
                                                    <?php if(helper::appdata($vendordata->id)->facebook_mode == 1): ?>
                                                        <a href="<?php echo e(URL::to($vendordata->slug . '/login/facebook-user')); ?>"
                                                            class="btn btn-facebook w-50"><i
                                                                class="fa-brands fa-facebook-f mx-1 my-1 rounded-1"></i>
                                                            <?php echo e(trans('labels.facebook')); ?></a>

                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <div class="form-group mt-3 table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>User<br>user@gmail.com</td>
                                                            <td>123456</td>
                                                            <td><button class="btn btn-info btn-sm"
                                                                    onclick="AdminFill('user@gmail.com' , '123456')">Copy</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                        <p class="fs-7 text-center mt-3"><?php echo e(trans('labels.dont_have_account')); ?>

                                            <a href="<?php echo e(URL::to($vendordata->slug . '/register')); ?>"
                                                class="text-primary fw-semibold"><?php echo e(trans('labels.register')); ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                                <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->auth_image)); ?>"
                                    class="w-100 object-fit-cover h-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function AdminFill(email, password) {
            $('#email').val(email);
            $('#password').val(password);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/auth/login.blade.php ENDPATH**/ ?>
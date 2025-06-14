<?php $__env->startSection('content'); ?>
    <section>
        <div class="row align-items-center g-0 w-100 h-100vh position-relative">
            <div class="col-xl-7 col-lg-6 col-md-6 d-md-block d-none">
                <img src="<?php echo e(helper::image_path(helper::appdata('')->auth_image)); ?>" class="object h-100vh w-100"
                    alt="">
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="login-right-content register-padding">
                    <div class="pb-0 px-0  d-flex flex-column justify-content-xl-center h-100">
                        <div class="text-primary d-flex justify-content-between">
                            <div>
                                <h2 class="fw-bold title-text text-color mb-2"><?php echo e(trans('labels.register')); ?></h2>
                                <p class="text-color"><?php echo e(trans('labels.create_sub_title')); ?></p>
                            </div>
                            <!-- FOR SMALL DEVICE TOP CATEGORIES -->
                            <?php if(@helper::checkaddons('language')): ?>
                                <div class="lag-btn dropdown border-0 shadow-none login-lang">
                                    <button class="btn dropdown-toggle border-0 language-dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-globe fs-5 text-dark"></i>
                                    </button>
                                    <ul class="dropdown-menu rounded-1 p-0 rounded-3 overflow-hidden">
                                        <?php $__currentLoopData = helper::listoflanguage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languagelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a class="dropdown-item text-dark d-flex align-items-center text-left px-3 py-2"
                                                    href="<?php echo e(URL::to('/lang/change?lang=' . $languagelist->code)); ?>">
                                                    <img src="<?php echo e(helper::image_path($languagelist->image)); ?>" alt=""
                                                        class="img-fluid lag-img mx-1 w-25">
                                                    &nbsp;&nbsp;<?php echo e($languagelist->name); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>
                        <form class="mt-4" method="POST" action="<?php echo e(URL::to('admin/register_vendor')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-md-3 g-2">
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="name"
                                            class="form-label fs-7 text-color"><?php echo e(trans('labels.name')); ?><span
                                                class="text-danger"> * </span></label>
                                        <input type="text" class="form-control extra-padding text-color" name="name"
                                            value="<?php echo e(old('name')); ?>" id="name"
                                            placeholder="<?php echo e(trans('labels.name')); ?>" required>
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
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="email"
                                            class="form-label fs-7 text-color"><?php echo e(trans('labels.email')); ?><span
                                                class="text-danger"> * </span></label>
                                        <input type="email" class="form-control extra-padding text-color" name="email"
                                            value="<?php echo e(old('email')); ?>" id="email"
                                            placeholder="<?php echo e(trans('labels.email')); ?>" required>
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
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="mobile"
                                            class="form-label fs-7 text-color"><?php echo e(trans('labels.mobile')); ?><span
                                                class="text-danger"> * </span></label>
                                        <input type="text" class="form-control extra-padding text-color mobile-number"
                                            name="mobile" value="<?php echo e(old('mobile')); ?>" id="mobile"
                                            placeholder="<?php echo e(trans('labels.mobile')); ?>" required>
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
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="password"
                                            class="form-label fs-7 text-color"><?php echo e(trans('labels.password')); ?><span
                                                class="text-danger"> * </span></label>
                                        <div class="form-control extra-padding d-flex align-items-center gap-3">
                                            <input type="password" class="form-control text-color border-0 p-0"
                                                name="password" value="<?php echo e(old('password')); ?>" id="password"
                                                placeholder="<?php echo e(trans('labels.password')); ?>" required>
                                            <span>
                                                <a href="#"><i class="fa-light fa-eye-slash" id="eye"></i></a>
                                            </span>
                                        </div>
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
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="country"
                                            class="form-label fs-7 text-color"><?php echo e(trans('labels.country')); ?><span
                                                class="text-danger"> * </span></label>
                                        <select name="country" class="form-select extra-padding" id="country" required>
                                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="city"
                                            class="form-label fs-7 text-color"><?php echo e(trans('labels.city')); ?><span
                                                class="text-danger"> * </span></label>
                                        <select name="city" class="form-select extra-padding" id="city" required>
                                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                                        </select>

                                    </div>
                                </div>
                                <?php if(@helper::checkaddons('digital_product')): ?>
                                    <div class="col-sm-6">
                                        <div class="form-group m-0">
                                            <label for="store"
                                                class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                                    class="text-danger"> * </span></label>
                                            <select name="store" class="form-select extra-padding" id="store"
                                                required>
                                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group m-0">
                                            <label for="product_type"
                                                class="form-label"><?php echo e(trans('labels.product_type')); ?><span
                                                    class="text-danger">
                                                    * </span></label>
                                            <select name="product_type" class="form-select extra-padding" required>
                                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1" <?php echo e(old('store') == 1 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.physical')); ?></option>
                                                <option value="2" <?php echo e(old('store') == 2 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.digital')); ?></option>
                                            </select>

                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-12">
                                        <div class="form-group m-0">
                                            <label for="store"
                                                class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                                    class="text-danger"> * </span></label>
                                            <select name="store" class="form-select extra-padding" id="store"
                                                required>
                                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(@helper::checkaddons('unique_slug')): ?>
                                    <div class="col-12">
                                        <div class="form-group m-0">
                                            <label for="basic-url"
                                                class="form-label fs-7 text-color"><?php echo e(trans('labels.personlized_link')); ?><span
                                                    class="text-danger"> * </span></label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text text-color col-5 col-lg-auto overflow-auto"><?php echo e(URL::to('/')); ?>/</span>
                                                <input type="text" class="form-control extra-padding text-color"
                                                    id="slug" name="slug" value="<?php echo e(old('slug')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['slug'];
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
                                <?php endif; ?>
                                <div class="form-group d-flex gap-2 align-items-center ">
                                    <input class="form-check-input m-0" type="checkbox" value=""
                                        name="check_terms" id="check_terms" checked required>
                                    <label class="form-check-label text-color" for="check_terms">
                                        <?php echo e(trans('labels.i_accept_the')); ?> <span class="fw-600"><a
                                                href="<?php echo e(URL::to('/termscondition')); ?>"><?php echo e(trans('labels.terms_condition')); ?></a>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="row g-3 py-3">
                                <div class="col-lg-6">
                                    <a href ="<?php echo e(URL::to('/admin')); ?>" class="btn btn-primary padding w-100"
                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>>
                                        <?php echo e(trans('labels.login')); ?>

                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-secondary padding w-100"
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.register')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(env('Environment') == 'sendbox'): ?>
        <button class="btn btn-primary theme-label text-white" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">

            <i class="fa-solid fa-list text-white px-2"></i>
            Themes</button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header border-bottom">
                <h5 id="offcanvasRightLabel">Themes</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row px-3">
                    <a href="https://fashionhub.paponapps.co.in/theme-1" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-1.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 1</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-2" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-2.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 2</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-3" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-3.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 3</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-4" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-4.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 4</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-5" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-5.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 5</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-6" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-6.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 6</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-7" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-7.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 7</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-8" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-8.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 8</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-9" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-9.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 9</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-10" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="<?php echo e(helper::image_path('theme-10.png')); ?>" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 10</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function AdminFill(email, password) {
            $('#email').val(email);
            $('#password').val(password);
        }
        // password eye hide
        $(function() {
            $('#eye').click(function() {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#password').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('labels.select')); ?>";
        var cityid = "0";
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.auth_default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/auth/register.blade.php ENDPATH**/ ?>
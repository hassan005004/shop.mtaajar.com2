<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                        aria-current="page"><?php echo e(trans('labels.help_contact')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <!-- CONTACT US AREA START -->
    <section class="my-5">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-4">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->contact_image)); ?>" class="w-100"
                        alt="">
                </div>
                <div class="col-lg-6">
                    <div class="p-lg-4 rounded-0">
                        <h3 class="pb-3 fw-600 text-dark text-center"><?php echo e(trans('labels.contact_title')); ?></h3>
                        <form action="<?php echo e(URL::to(@$vendordata->slug . '/contact-us/store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name" class="form-label text-dark"><?php echo e(trans('labels.name')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-h rounded-0 " name="name" id="name"
                                    value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label text-dark"><?php echo e(trans('labels.email')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control input-h rounded-0 " name="email" id="email"
                                    value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(trans('labels.email')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="form-label text-dark"><?php echo e(trans('labels.mobile')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-h  rounded-0 mobile-number" name="mobile"
                                    id="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label text-dark"><?php echo e(trans('labels.message')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control rounded-0" name="message" id="message" rows="5" required
                                    placeholder="<?php echo e(trans('labels.describe_in_detail')); ?>"><?php echo e(old('message')); ?></textarea>
                            </div>
                            <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <button type="submit"
                                class="btn btn-secondary btn-shadow d-block py-3 rounded-0 w-100 mt-3"><?php echo e(trans('labels.submit')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row row-cols-xl-3 row-cols-md-2 row-cols-1 g-3">
                <div class="col">
                    <div class="card h-100 ">
                        <div class="card-body text-center">
                            <div class="icon-lg bg-primary rounded-2 mb-3 mx-auto">
                                <i class="fa-light fa-envelope text-white"></i>
                            </div>
                            <p><a class="text-dark fw-500" href="mailto:<?php echo e(helper::appdata($vendordata->id)->email); ?>">
                                    <?php echo e(trans('labels.email')); ?> : <?php echo e(helper::appdata($vendordata->id)->email); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="icon-lg bg-primary rounded-2 mb-3 mx-auto">
                                <i class="fa-light fa-phone text-white"></i>
                            </div>
                            <p><a href="tel:<?php echo e(helper::appdata($vendordata->id)->contact); ?>"
                                    class="text-dark fw-500"><?php echo e(trans('labels.mobile')); ?> :
                                    <?php echo e(helper::appdata($vendordata->id)->contact); ?></a></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="icon-lg bg-primary rounded-2 mb-3 mx-auto">
                                <i class="fa-light fa-location-dot text-white"></i>
                            </div>
                            <p class="fs-sm text-dark fw-500"><?php echo e(@helper::appdata(@$vendordata->id)->address); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT US AREA END -->
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/contact_us.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
    <!-- BREADCRUMB AREA START -->

    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 gap-2">
                    <li class="breadcrumb-item">
                        <a class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted breadcrumb-item active d-flex gap-2" aria-current="page">
                        <?php echo e(trans('landing.contact_us')); ?>

                    </li>
                </ol>
            </nav>
        </div>
    </section>

    

    <section>
        <div class="contact-bg-color py-0">
            <div class="container contact-container">
                <div class="contact-main">
                    <div class="row align-items-center g-3 mt-4 mb-5">
                        <div class="col-lg-6">
                            <form class="shadow-lg bg-white rounded-3 px-4 py-4" action="<?php echo e(URL::To('/inquiry')); ?>"
                                method="post">
                                <?php echo csrf_field(); ?>
                                <h5 class="contact-form-title text-center">
                                    <?php echo e(trans('landing.contact_us')); ?>

                                </h5>
                                <p class="contact-form-subtitle text-center text-muted">
                                    <?php echo e(trans('landing.contact_section_description')); ?></p>
                                <div class="row g-1 mt-3">
                                    <div class="col-md-6">
                                        <label for="name"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.name')); ?></label>
                                        <input type="text" class="form-control contact-input" name="name"
                                            placeholder="<?php echo e(trans('landing.name')); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.email')); ?></label>
                                        <input type="email" class="form-control contact-input" name="email"
                                            placeholder="<?php echo e(trans('landing.email')); ?>" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.mobile')); ?></label>
                                        <input type="text" class="form-control contact-input mobile-number"
                                            name="mobile" placeholder="<?php echo e(trans('landing.mobile')); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message"
                                            class="form-label contact-form-label"><?php echo e(trans('landing.message')); ?></label>
                                        <textarea class="form-control contact-input" rows="3" name="message" placeholder="<?php echo e(trans('landing.message')); ?>"
                                            required></textarea>
                                    </div>
                                    <?php echo $__env->make('landing.layout.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="col-6 mx-auto">
                                        <button type="submit"
                                            class="btn-secondary rounded-2 text-center m-auto d-block w-100"><?php echo e(trans('landing.submit')); ?></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100">
                                    <h6><span
                                            class="text-primary-color <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>"><i
                                                class="fa-solid fa-envelope fs text-primary-color"></i></span><?php echo e(trans('landing.email')); ?>

                                    </h6>

                                    <p class="mb-0"><a href="mailto:" class="text-dark fs-7">
                                            <?php echo e(helper::appdata('')->email); ?></a></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100 ">
                                    <h6><span
                                            class="text-primary-color  <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>">
                                            <i
                                                class="fa-solid fa-phone text-primary-color"></i></span><?php echo e(trans('landing.mobile')); ?>

                                    </h6>
                                    <p class="mb-0"><a href="tel:"
                                            class="text-dark fs-7"><?php echo e(helper::appdata('')->contact); ?></a></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100">
                                    <h6><span
                                            class="text-primary-color <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>">
                                            <i
                                                class="fa-solid fa-location-dot text-primary-color"></i></span><?php echo e(trans('landing.address')); ?>

                                    </h6>
                                    <p class="mb-0 fs-7">
                                    <a href="https://www.google.com/maps/place/<?php echo e(helper::appdata('')->address); ?>" target="_blank"
                                            class="text-dark fs-7">
                                         <?php echo e(helper::appdata('')->address); ?></a>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <div class="card border-0 shadow rounded p-4 h-100 ">
                                    <div class="contact-icons d-flex flex-wrap gap-2">
                                        <?php $__currentLoopData = @helper::getsociallinks(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e($links->link); ?>" target="_blank"
                                                class="rounded-2 contact-icon"><?php echo $links->icon; ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/contact.blade.php ENDPATH**/ ?>
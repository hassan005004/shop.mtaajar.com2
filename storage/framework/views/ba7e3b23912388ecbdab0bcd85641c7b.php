
<?php if(helper::subscriptionimage()->count() > 0): ?>
<section class="py-5">
    <div class="container have-project-section-bg-color rounded-2 p-lg-0 py-4 px-sm-4 px-3">
        <div class="have-project-contain row align-items-center justify-content-center">
            <div class="col-lg-5 overflow-hidden d-lg-block d-none">
                <div class="d-flex justify-content-center">
                    <img src="<?php echo e(helper::image_path(@helper::subscriptionimage()->subscribe_image)); ?>" alt=""
                        class="img-fluidn object-fit-cover project-img">
                </div>
            </div>
            <div class="col-lg-6 overflow-hidden">
                <div>
                    <div>
                        <h6 class="have-project-title">
                            <?php echo e(trans('landing.subscribe_section_title')); ?>

                        </h6>
                    </div>
                    <p class="have-project-subtitle mt-4 col-md-11 sub-title-mein">
                        <?php echo e(trans('landing.subscribe_section_description')); ?>

                    </p>
                    <form action="<?php echo e(URL::to('/emailsubscribe')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="mt-4 mb-sm-0 mb-3 d-flex gap-2 border-0 input-btn">
                            <input type="email" class="form-control fs-13 border-0" name="email"
                                placeholder="<?php echo e(trans('labels.email')); ?>" required>
                            <button type="submit"
                                class="btn-primary mx-0 fs-7 fw-500 rounded-2"><?php echo e(trans('landing.subscribe')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/newslatter.blade.php ENDPATH**/ ?>
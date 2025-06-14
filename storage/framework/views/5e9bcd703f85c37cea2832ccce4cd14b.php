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
                    <?php echo e(trans('landing.about_us')); ?>

                </li>
            </ol>
        </nav>
    </div>
</section>

<section>
    <div class="about-us-bg-color">
        <div class="container">
            <div class="about-us-main">
                <?php if(!empty($aboutus->about_content)): ?>
                    <div class="cms-section my-3">

                        <?php echo $aboutus->about_content; ?>


                    </div>
                <?php else: ?>
                    <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/aboutus.blade.php ENDPATH**/ ?>
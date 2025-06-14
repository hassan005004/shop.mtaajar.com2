<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark fw-600" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?> active"
                        aria-current="page"><?php echo e(trans('labels.gallery')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <section class="gallery my-5">
        <div class="container">
            <div class="popup-gallery grid-wrapper">
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $rdiv = ['', 'tall', 'big', 'wide'];
                    $rand_keys = array_rand($rdiv);
                    ?>
                    <a href="<?php echo e(helper::image_path($image->image)); ?>" class="<?php echo e($rdiv[$rand_keys]); ?>">
                        <img src="<?php echo e(helper::image_path($image->image)); ?>" alt=""
                            class="w-100 h-100 rounded-4 object-fit-cover" />
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>    
<script>
    $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    // return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/gallery/index.blade.php ENDPATH**/ ?>
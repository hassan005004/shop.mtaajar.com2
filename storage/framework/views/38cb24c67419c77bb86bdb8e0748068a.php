<?php $__env->startSection('contents'); ?>
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a class="text-dark fw-600" href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a></li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?> active" aria-current="page"><?php echo e(trans('labels.categories')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">            
            <div class="categorywrapper row flex-wrap align-items-baseline justify-content-sm-start justify-content-evenly">
                <?php $__empty_1 = true; $__currentLoopData = helper::getcategories(@$vendordata->id,""); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="category">
                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category='.$category->slug)); ?>">
                        <div class="text-center mb-4">
                            <img src="<?php echo e(helper::image_path($category->image)); ?>" alt="" srcset="">
                            <p class="fs-7 text-truncate mt-2"><?php echo e(ucfirst($category->name)); ?></p>
                            
                        </div>
                    </a>
                    </div>

                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/categorieslist.blade.php ENDPATH**/ ?>
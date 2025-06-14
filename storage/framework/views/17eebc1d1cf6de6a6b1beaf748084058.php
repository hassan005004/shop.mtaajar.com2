<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="item h-100">
        <div class="card h-100">
            <div class="overflow-hidden">
                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                    class="card-img-top blog-card-top-img blog-card-hover" height="300" alt="...">
            </div>
            <div class="card-body pb-0">
                <div class="d-flex align-items-baseline">
                    <i class="fa-solid fa-calendar-days card-date"></i>
                    <p class="card-date px-2"><?php echo e(helper::date_formate($blog->created_at,$blog->vendor_id)); ?>

                    </p>
                </div>
                <h5 class="card-title blog-card-title pt-2">
                    <?php echo e($blog->title); ?>

                </h5>
            </div>
            <div class="card-footer pt-0 bg-white text-end border-top-0">
                <a href="<?php echo e(URL::to('/blogdetail-'.$blog->slug)); ?>" class="text-primary-color fs-7">
                   <?php echo e(Str::contains(request()->url(), 'blog') ? trans('landing.read_more') : trans('landing.read_more')); ?> 
                   <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/blogcommonview.blade.php ENDPATH**/ ?>
<?php
$i = 1;
?>
<?php $__currentLoopData = $userdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="col" data-aos="fade-up" data-aos-delay="<?php echo e($i++); ?>00" data-aos-duration="1000">
    <a href="<?php echo e(URL::to($user->slug . '/')); ?>" target="_blank">
        <div class="card overflow-hidden rounded-0 view-all-hover h-100 rounded-2">
            <img src="<?php echo e(helper::image_path($user->cover_image)); ?>"
                class="card-img-top rounded-0 object-fit-cover img-fluid object-fit-cover"
                height="185" alt="...">
            <div class="card-body p-sm-3 p-2">
                <h6 class="card-title fs-15 fw-600 hotel-title"><?php echo e($user->web_title); ?></h6>
                <p class="hotel-subtitle text-muted fs-8">
                    <?php echo e($user->footer_description); ?>

                </p>
            </div>
        </div>
    </a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/storelist.blade.php ENDPATH**/ ?>
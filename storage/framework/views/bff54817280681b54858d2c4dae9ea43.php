<div class="row g-3 theme_image">

    <?php $__currentLoopData = $newpath; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-6">

            <div class="theme-selection border cursor-pointer"><img src='<?php echo e($path); ?>' alt="" class="w-100">

            </div>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/theme/themeimages.blade.php ENDPATH**/ ?>
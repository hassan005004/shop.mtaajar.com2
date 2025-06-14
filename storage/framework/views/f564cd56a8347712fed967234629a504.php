<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>"><?php echo e(trans('labels.blogs')); ?></a></li>
                    <?php if(!empty($blogdetails)): ?>
                        <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?> active"
                            aria-current="page"><?php echo e($blogdetails->title); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <!-- BLOG DETAILS AREA START -->
    <section class="py-4">
        <div class="container">
            <?php if(!empty($blogdetails)): ?>
                <div class="row">
                    <div class="blog-details">
                        <div class="card border-0 rounded-0">
                            <img src="<?php echo e(helper::image_path($blogdetails->image)); ?>" class="card-img-top rounded-0"
                                alt="...">
                            <div class="card-body px-0">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="text-muted fs-13">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="px-1 fs-13">
                                            <?php echo e(helper::date_formate($blogdetails->created_at, $blogdetails->vendor_id)); ?>

                                        </span>
                                    </p>
                                </div>
                                <h4 class="card-title fw-600 dark_color mb-3"><a class="text-dark"
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blogdetails->slug)); ?>"><?php echo e($blogdetails->title); ?></a>
                                </h4>
                                <p class="mb-3"><?php echo $blogdetails->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </section>
    <!-- BLOG DETAILS AREA END -->
    <!-- FEATURED BLOGS AREA START  -->
    <?php if(count(helper::getblogs(@$vendordata->id, '4', @$blogdetails->id)) > 0): ?>
        <section class="featured-blog mb-5">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="section-heading mb-3">
                        <h4 class="section-title text-capitalize"><?php echo e(trans('labels.related_blogs')); ?></h4>
                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>"
                            class="btn btn-sm btn-secondary rounded-0 px-3 py-2"><?php echo e(trans('labels.viewall')); ?> <i
                                class="fa-solid <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-left' : ' fa-arrow-right'); ?>"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div id="featured_blog" class="owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '4', @$blogdetails->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getrelatedblogdetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card rounded-0 border-0 h-100 ">
                                <img src="<?php echo e(helper::image_path($getrelatedblogdetails->image)); ?>"
                                    class="card-img-top blog-im object-fit-cover rounded-0" alt="...">
                                <div class="card-body px-0">
                                    <h6 class="card-text mt-2"><a class="text-dark blog-title fw-600"
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $getrelatedblogdetails->slug)); ?>"><?php echo e($getrelatedblogdetails->title); ?></a>
                                    </h6>
                                </div>
                                <div class="card-footer px-0 pt-0">
                                    <div class="d-flex align-items-center justify-content-between py-2 border-top">
                                        <p class="fs-8"><i class="fa-regular fa-clock"></i><span
                                                class="px-1"><?php echo e(helper::date_formate($getrelatedblogdetails->created_at, $getrelatedblogdetails->vendor_id)); ?></span>
                                        </p>
                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $getrelatedblogdetails->slug)); ?>"
                                            class="text-primary-color fs-15"><?php echo e(trans('labels.readmore')); ?> <i
                                                class="fa-solid fw-500 <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-left-long' : ' fa-arrow-right-long'); ?>"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- FEATURED BLOGS AREA END  -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/blogs.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/included/blog/blog_details.blade.php ENDPATH**/ ?>
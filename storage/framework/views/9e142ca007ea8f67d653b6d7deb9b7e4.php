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
                        aria-current="page"><?php echo e(trans('labels.blogs')); ?></li>

                </ol>

            </nav>

        </div>

    </section>

    <!-- BREADCRUMB AREA END -->

    <!-- BLOGS AREA START -->

    <section class="my-5">

        <div class="container">

            <?php if(count(helper::getblogs(@$vendordata->id, '', '')) > 0): ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 blogs-list">

                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getblogdetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col mb-3">

                            <div class="card h-100 border-0 rounded-0 mb-3">

                                <img src="<?php echo e(helper::image_path($getblogdetails->image)); ?>"
                                    class="card-img-top blog-img object-fit-cover rounded-0" alt="...">

                                <div class="card-body px-0 pb-0">
                                    <h6 class="card-text blog-title fw-600 mt-2"><a class="text-dark line-2"
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $getblogdetails->slug)); ?>"><?php echo e($getblogdetails->title); ?></a>
                                    </h6>

                                    <p class="mb-3 fs-7 text-justify"><?php echo strip_tags(Str::limit($getblogdetails->description, 200)); ?></p>
                                </div>

                                <div class="card-footer px-0 pt-0">
                                    <div class="d-flex align-items-center justify-content-between border-top py-2">
                                        
                                        <p class="text-truncate fs-8"><i class="fa-regular fa-clock"></i><span class="px-1"><?php echo e(helper::date_formate($getblogdetails->created_at,$getblogdetails->vendor_id)); ?></span></p>

                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $getblogdetails->slug)); ?>"
                                            class="text-primary-color fs-15 text-truncate"><?php echo e(trans('labels.readmore')); ?> <i
                                                class="fa-solid fw-500 <?php echo e(session()->get('direction') == 2 ? 'fa-arrow-left-long' : ' fa-arrow-right-long'); ?>"></i></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

        </div>

    </section>

    <!-- BLOGS AREA END -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/included/blog/blogs.blade.php ENDPATH**/ ?>
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
                    <li class="text-muted breadcrumb-item active d-flex gap-2" aria-current="page"><?php echo e(trans('landing.our_stors')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    
    <!-- slaider-section start -->
    <section>
        <div class="owl-carousel hotels-slaider owl-theme">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(URL::to('/' . $banner['vendor_info']->slug)); ?>" target="_blank">
                    <div class="item item-1">
                        <img src="<?php echo e(helper::image_path($banner->image)); ?>" class="mg-fluid">
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <!-- slaider-section end -->
    <!--card-section start -->
    <section>
        <div class="container">


            <form action="<?php echo e(URL::to('/stores')); ?>" method="get">
                <div class="row d-flex justify-content-center align-items-center mt-4">
                    <div class="col-12">
                        <div class="card shadow w-100 border-0 d-flex">
                            <div class="card-header p-3 bg-white">
                                <h5 class="fw-600 m-0">
                                    <?php echo e(trans('landing.find_your_shope')); ?>

                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="select-input-box">
                                            <label for="city"
                                                class="form-lables mb-1 hotel-label"><?php echo e(trans('landing.store_category')); ?></label>
                                            <select name="store" class="form-select p-2 fs-7" id="store">
                                                <option value=""><?php echo e(trans('landing.select')); ?></option>
                                                <?php $__currentLoopData = $storecategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($store->name); ?>"
                                                        <?php echo e(request()->get('store') == $store->name ? 'selected' : ''); ?>>
                                                        <?php echo e($store->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="country"
                                            class="form-lables mb-1 hotel-label"><?php echo e(trans('landing.city')); ?></label>
                                        <select name="country" class="form-select p-2 fs-7" id="country">
                                            <option value=""
                                                data-value="<?php echo e(URL::to('/stores?country=' . '&city=' . request()->get('city'))); ?>"
                                                data-id="0" selected><?php echo e(trans('landing.select')); ?></option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->name); ?>"
                                                    data-value="<?php echo e(URL::to('/stores?country=' . request()->get('country') . '&city=' . request()->get('city'))); ?>"
                                                    data-id=<?php echo e($country->id); ?>

                                                    <?php echo e(request()->get('country') == $country->name ? 'selected' : ''); ?>>
                                                    <?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="select-input-box">
                                            <label for="city"
                                                class="form-lables mb-1 hotel-label"><?php echo e(trans('landing.area')); ?></label>
                                            <select name="city" class="form-select p-2 fs-7" id="city">
                                                <option value=""><?php echo e(trans('landing.select')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 d-flex flex-column justify-content-end">
                                        <div class="d-flex align-items-center justify-content-center mt-4">
                                            <label class="form-lables mb-1 hotel-label"></label>
                                            <button type="submit"
                                                class="btn btn-primary py-2 m-0 w-100 btn-class"><?php echo e(trans('landing.submit')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php if($stores->count() > 0): ?>
                <div class="title-restaurant text-center">
                    <?php if(!empty(request()->get('city')) && request()->get('city') != null): ?>
                        <h5 class="my-5"><?php echo e(trans('landing.stores_in')); ?> <?php echo e(@$city_name); ?></h5>
                    <?php endif; ?>
                </div>
                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xll-4 g-3 pt-4">
                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <a href="<?php echo e(URL::to('/' . $store->slug)); ?>" target="_blank">
                                <div class="card rounded-2 h-100 overflow-hidden view-all-hover">
                                    <img src="<?php echo e(helper::image_path(helper::appdata($store->id)->cover_image)); ?>"
                                        class="card-img-top rounded-0 object-fit-cover img-fluid object-fit-cover"
                                        alt="...">
                                    <div class="card-body px-sm-3 px-2">
                                        <h6 class="card-title fs-15 fw-600 hotel-title">
                                            <?php echo e(helper::appdata($store->id)->web_title); ?>

                                        </h6>
                                        <p class="hotel-subtitle fs-8 text-muted">
                                            <?php echo e(helper::appdata($store->id)->footer_description); ?>

                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="d-flex justify-content-center mt-3">

                    <?php echo $stores->links(); ?>


                </div>
            <?php else: ?>
                <div class="mt-4">
                    <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!--card-section end-->

    <!-- subscription -->
    <?php echo $__env->make('landing.newslatter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('landing.select')); ?>";
        var cityname = "<?php echo e(request()->get('city')); ?>";
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/landing/js/store.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('landing.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/stores.blade.php ENDPATH**/ ?>
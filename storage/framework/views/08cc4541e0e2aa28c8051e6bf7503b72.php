<?php $__env->startSection('contents'); ?>
    <?php
        $user = App\Models\User::where('id', $vdata)->first();
    ?>
    <!------------------------------------------------ theme-9-slider-main-section ------------------------------------------------>
    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-9-home-slider">
            <div id="carousel-theme-9" class="carousel slide vertical" data-bs-ride="carousel">
                <div class="carousel-indicators <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                    <?php $__currentLoopData = $getsliderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" data-bs-target="#carousel-theme-9" data-bs-slide-to="<?php echo e($key); ?>"
                            class="<?php echo e($key == 0 ? 'active' : ''); ?>" aria-current="true"
                            aria-label="Slide <?php echo e($key); ?>"></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="carousel-inner">
                    <?php $__currentLoopData = $getsliderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                            <?php if($slider['link_text'] == '' || $slider['link_text'] == null): ?>
                                <?php if($slider['type'] == 1): ?>
                                    <a
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                    <?php elseif($slider['type'] == 2): ?>
                                        <a
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                        <?php elseif($slider['type'] == 3): ?>
                                            <a href="<?php echo e($slider['custom_link']); ?>" target="_blank">
                                            <?php else: ?>
                                                <a href="javascript:void(0)">
                                <?php endif; ?>
                                <img src="<?php echo e($slider['image']); ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                    <div class="row">
                                        <div
                                            class="col-12 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <h5
                                                class="text-white main-banner-title mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounceInRight">
                                                <?php echo e($slider['title']); ?>

                                            </h5>
                                            <h2
                                                class="text-white fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                                <?php echo e($slider['sub_title']); ?>

                                            </h2>
                                            <p
                                                class="text-white fs-18 mb-md-5 mb-2 home-description line-2 col-md-9 <?php echo e(session()->get('direction') == 2 ? ' me-auto' : ' ms-auto'); ?>">
                                                <?php echo e($slider['description']); ?>

                                            </p>

                                        </div>
                                    </div>
                                </div>
                                </a>
                            <?php else: ?>
                                <img src="<?php echo e($slider['image']); ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                    <div class="row">
                                        <div
                                            class="col-12 <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <h5
                                                class="text-white main-banner-title mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounceInRight">
                                                <?php echo e($slider['title']); ?>

                                            </h5>
                                            <h2
                                                class="text-white fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                                <?php echo e($slider['sub_title']); ?>

                                            </h2>
                                            <p
                                                class="text-white fs-18 mb-md-5 mb-2 home-description line-2 col-md-9<?php echo e(session()->get('direction') == 2 ? ' me-auto' : ' ms-auto'); ?>">
                                                <?php echo e($slider['description']); ?>

                                            </p>
                                            <div class="d-flex justify-content-end animate__animated animate__fadeInDown">
                                                <div
                                                    class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                                    <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                                        <?php if($slider['type'] == 1): ?>
                                                            <a class="btn btn-primary rounded-3 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                            <?php elseif($slider['type'] == 2): ?>
                                                                <a class="btn btn-primary rounded-3 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                                <?php elseif($slider['type'] == 3): ?>
                                                                    <a class="btn btn-primary rounded-3 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                                                        href="<?php echo e($slider['custom_link']); ?>"
                                                                        target="_blank">
                                                                    <?php else: ?>
                                                                        <a class="btn btn-primary rounded-3 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                                                            href="javascript:void(0)">
                                                        <?php endif; ?><?php echo e($slider['link_text']); ?> <i
                                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2'); ?>"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <main class="theme-9 bg-primary-rgb-main">
        <!------------------------------------------------ theme-9-category-section ------------------------------------------------>
        <?php if(count(helper::getcategories(@$vdata, '7')) > 0): ?>
            <section class="theme-9-category py-md-5 py-4">
                <div class="container">
                    <div class="d-lg-flex gap-3 align-items-center">
                        <div class="col-lg-4 row pb-lg-0 pb-md-5">
                            <div class="mb-lg-0 mb-4 col-auto">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="title-dot"></div>
                                    <p class="fs-6 text-uppercase  fw-normal specks-subtitle px-2">
                                        <?php echo e(trans('labels.homepage_category_subtitle')); ?>

                                    </p>
                                    <div class="title-dot"></div>
                                </div>
                                <span
                                    class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.choose_by_category')); ?></span>
                                <div class="d-flex mt-md-3 mt-2">
                                    <div class="col-auto">
                                        <div
                                            class="w-100 shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                            <a class="btn btn-primary w-100 btn-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>">
                                                <?php echo e(trans('labels.viewall')); ?><span
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div
                                class="theme-9-category-slider owl-carousel owl-theme <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">

                                <?php $__currentLoopData = helper::getcategories(@$vdata, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="rounded-4 shadow-theme-9 h-100 <?php echo e(session()->get('direction') == 2 ? 'rtl ms-2 ' : 'me-2 '); ?>">
                                        <div
                                            class="card d-flex justify-content-center h-100 outline-none rounded-4 overflow-hidden border-0 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                            <div class="align-items-center d-flex">
                                                <div class="col-5 cat-img-9 p-0">
                                                    <a
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                                        <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                            class="w-100 object-fit-cover" alt="category image"></a>
                                                </div>
                                                <div class="card-footer p-2 col-7">
                                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                                        class="card-title text-dark fs-15 choose-by-category-name line-2 m-0"><?php echo e($categorydata['name']); ?></a
                                                        href="#">
                                                    <p class="fs-13"><?php echo e(helper::product_count($categorydata->id)); ?>

                                                        <?php echo e(trans('labels.items')); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-primary-rgb py-md-5 py-4">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vdata)->whoweare_image)); ?>"
                                class="w-100 object-fit-cover shadow-theme-9 rounded-4 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                alt="">
                        </div>
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <div class="d-flex align-items-center mb-2">
                                <div class="title-dot"></div>
                                <span
                                    class="fs-6 text-truncate m-0 px-2"><?php echo e(helper::appdata($vdata)->whoweare_title); ?></span>
                                <div class="title-dot"></div>
                            </div>
                            <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vdata)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vdata)->whoweare_description); ?>

                            </p>
                            <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3 row">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="align-items-md-center align-items-start mb-xl-4 mb-lg-2 mb-3 col-6">
                                        <div>
                                            <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                                class="icon-lg bg-secondary bg-opacity-10 text-success rounded-circle p-1"
                                                alt="">
                                            <div class="py-md-2 px-md-3 p-1">
                                                <h5 class="mb-1 fw-600 text-truncate"><?php echo e($item->title); ?></h5>
                                                <p class="mb-0 fs-7 line-2"><?php echo e($item->sub_title); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------------- theme-9-offer-banner-1-section -------------------------------------------->
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-9-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="theme-9-offer-banner-1-carousel owl-carousel owl-theme">
                        <?php $__currentLoopData = $getbannerslist['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div
                                    class="shadow-theme-9 rounded-4 <?php echo e(session()->get('direction') == 2 ? 'rtl ms-2' : 'me-2'); ?>">
                                    <?php if($banner['type'] == 1): ?>
                                        <a
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug)); ?>">
                                        <?php elseif($banner['type'] == 2): ?>
                                            <a
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug)); ?>">
                                            <?php elseif($banner['type'] == 3): ?>
                                                <a href="<?php echo e($banner['custom_link']); ?>" target="_blank">
                                                <?php else: ?>
                                                    <a href="javascript:void(0)">
                                    <?php endif; ?>
                                    <img src="<?php echo e($banner['image']); ?>" alt=""
                                        class="w-100 h-100 rounded-4 object-fit-cover">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------------- new top-bar-offer ---------------------------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <div class="overflow-hidden offers-theme-9">
                <div class="offer-badge-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                    <?php echo e(trans('labels.best_offers')); ?>

                </div>
                <div class="text-secondary ">
                    <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
        <!---------------------------------------- theme-9-best-Selling-Products-section ------------------------------------------>
        <section class="theme-9-best-Selling-product my-md-5 my-4">
            <div class="container">
                <div class="text-center mb-md-5 mb-4">
                    <div class="d-flex align-items-center mb-2 justify-content-center">
                        <div class="title-dot"></div>
                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                            <?php echo e(trans('labels.homepage_product_subtitle')); ?>

                        </p>
                        <div class="title-dot"></div>
                    </div>
                    <span class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.best_selling_product')); ?></span>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3">
                    <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.theme-9.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="d-flex justify-content-center mt-md-5 mt-4">
                    <div class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                        <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">
                            <?php echo e(trans('labels.viewall')); ?><span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!---------------------------------------------- theme-9-offer-banner-2-section ---------------------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-9-offer-banner-3 py-5">
                <div class="container">
                    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $getbannerslist['bannersection2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>" data-bs-interval="4000">
                                    <div
                                        class="shadow-theme-9 rounded-4 mb-2 <?php echo e(session()->get('direction') == 2 ? 'rtl ms-2' : 'me-2'); ?>">
                                        <?php if($banner['type'] == 1): ?>
                                            <a
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug)); ?>">
                                            <?php elseif($banner['type'] == 2): ?>
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug)); ?>">
                                                <?php elseif($banner['type'] == 3): ?>
                                                    <a href="<?php echo e($banner['custom_link']); ?>" target="_blank">
                                                    <?php else: ?>
                                                        <a href="javascript:void(0)">
                                        <?php endif; ?>
                                        <img src="<?php echo e($banner['image']); ?>"
                                            class="d-block w-100 object-fit-cover rounded-4" alt="..."></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($getbannerslist['bannersection2']) > 1): ?>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.previous')); ?></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.next')); ?></span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!------------------------------------------------ theme-9-new-product-section ----------------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-9-new-product">
                <div class="container">
                    <div class="text-center mb-md-5 mb-4">
                        <div class="d-flex align-items-center mb-2 justify-content-center">
                            <div class="title-dot"></div>
                            <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                <?php echo e(trans('labels.new_arrival_product_subtitle')); ?>

                            </p>
                            <div class="title-dot"></div>
                        </div>
                        <span class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.new_arrival_products')); ?></span>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3">
                        <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-9.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                            <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                                <?php echo e(trans('labels.viewall')); ?><span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!------------------------------------------- theme-9-offer-banner-3-section ---------------------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-5-offer-banner-3 my-md-5 my-4">
                <div class="container-fluid">
                    <div class="theme-9-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $getbannerslist['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div
                                    class="shadow-theme-9 rounded-4 <?php echo e(session()->get('direction') == 2 ? 'rtl ms-2' : 'me-2'); ?>">
                                    <?php if($banner['type'] == 1): ?>
                                        <a
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug)); ?>">
                                        <?php elseif($banner['type'] == 2): ?>
                                            <a
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug)); ?>">
                                            <?php elseif($banner['type'] == 3): ?>
                                                <a href="<?php echo e($banner['custom_link']); ?>" target="_blanks">
                                                <?php else: ?>
                                                    <a href="javascript:void(0)">
                                    <?php endif; ?>
                                    <img src="<?php echo e($banner['image']); ?>" alt="banner-3"
                                        class="object-fit-cover rounded-4 ">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!------------------------------------------------------ DEALS START ---------------------------------------------------->
        <?php if(@helper::checkaddons('top_deals')): ?>
            <?php if(!empty(helper::top_deals($vdata))): ?>
                <?php if(count($topdealsproducts) > 0): ?>
                    <section class="theme-9-deals bg-primary-rgb py-sm-5 py-4 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="row">
                                <div class="card col-auto mx-auto mb-md-5 mb-4 p-0 rounded-4 margin-sm p-1">
                                    <div id="countdown" class="countdown-border"> </div>
                                </div>
                            </div>

                            <div class="my-md-5 my-4 theme-3-title text-center">
                                <div class="d-flex align-items-center mb-2 justify-content-center">
                                    <div class="title-dot"></div>
                                    <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                        <?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                    </p>
                                    <div class="title-dot"></div>
                                </div>
                                <h3 class="text-dark wdt-heading-title line-1">
                                    <?php echo e(trans('labels.home_page_top_deals_subtitle')); ?></h3>
                            </div>
                            <div id="top-deals9" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = $topdealsproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if (@$topdeals->offer_type == 1) {
                                            $price = $products->price - @$topdeals->offer_amount;
                                        } else {
                                            $price =
                                                $products->price - $products->price * (@$topdeals->offer_amount / 100);
                                        }
                                        $original_price = $products->price;
                                        $off =
                                            $original_price > 0
                                                ? number_format(100 - ($price * 100) / $original_price, 1)
                                                : 0;
                                    ?>
                                    <div
                                        class="item h-100 bg-white rounded-4 <?php echo e(session()->get('direction') == 2 ? ' ms-2' : ' me-2'); ?>">
                                        <div
                                            class="card product-card-side p-0 h-100 border-0 bg-white rounded-4 shadow-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                            <div class="h-100 position-relative">
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                    <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                        class="w-100 h-100 img-fluid object-fit-cover" alt="">
                                                    <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                        class="w-100 img-2" alt="">
                                                </a>
                                                <?php if($off > 0): ?>
                                                    <span
                                                        class="sale-label-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>"><?php echo e($off); ?>%
                                                        <?php echo e(trans('labels.off')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body content-box w-100 p-lg-3 p-2">
                                                <div class="d-flex align-items-center justify-content-between mb-md-2">
                                                    <p class="card-title fs-7 m-0 text-truncate text-lightslategray">
                                                        <?php echo e(@$products['category_info']->name); ?>

                                                    </p>
                                                    <?php if(helper::appdata($vdata)->product_ratting_switch == 1): ?>
                                                        <p class="fs-8 d-flex"><i
                                                                class="text-warning fs-8 fa-solid fa-star px-1"></i><span
                                                                class="text-dark fs-8 fw-500"><?php echo e(number_format($products->ratings_average, 1)); ?></span>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                    <h5 class="truncate-2 mb-3 text-dark product-name line-2 h-42">
                                                        <?php echo e($products->name); ?>

                                                    </h5>
                                                </a>
                                                <h6 class="product-price fs-7 text-dark d-inline-block m-0 text-truncate">
                                                    <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <del
                                                            class=" fs-8 fw-normal text-lightslategray <?php echo e(session()->get('direction') == 2 ? 'pe-1' : 'ps-1'); ?>"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                    <?php endif; ?>
                                                </h6>
                                                <!-- options -->
                                                <ul
                                                    class="option-wrap d-flex align-items-center d-grid gap-3 product_icon2 mt-2">
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vdata)->checkout_login_required == 1): ?>
                                                            <li tooltip="Wishlist" class="rounded shadow-lg">
                                                                <a onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vdata); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                    class="option-btn circle-round rounded wishlist-btn">
                                                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                        <?php

                                                                            $favorite = helper::ceckfavorite(
                                                                                $products->id,
                                                                                $vdata,
                                                                                Auth::user()->id,
                                                                            );

                                                                        ?>
                                                                        <?php if(!empty($favorite) && $favorite->count() > 0): ?>
                                                                            <i class="fa-solid fa-heart"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-heart"></i>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <li tooltip="<?php echo e(trans('labels.view')); ?>" class="rounded shadow-lg">
                                                        <a class="option-btn circle-round rounded wishlist-btn"
                                                            onclick="productview('<?php echo e($products->id); ?>')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(helper::appdata($vdata)->online_order == 1): ?>
                                                        <li tooltip="<?php echo e(trans('labels.add_to_cart')); ?>"
                                                            class="rounded shadow-lg">
                                                            <?php if($products->has_variation == 1): ?>
                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                    class="option-btn circle-round rounded addtocart-btn wishlist-btn">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="option-btn circle-round rounded addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('<?php echo e($products->id); ?>','<?php echo e($products->slug); ?>','<?php echo e($products->name); ?>','<?php echo e($products['product_image'] == null ? 'product.png' : $products['product_image']->image); ?>','<?php echo e($products->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                                <!-- options -->
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="d-flex justify-content-center mt-md-4 mt-3">
                                <div
                                    class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                        class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"><?php echo e(trans('labels.viewall')); ?>

                                        <span
                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <!--------------------------------------------------- TESTIMONIAL START -------------------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial  bg-primary-rgb py-5">
                    <div class="container position-relative">
                        <div class="d-flex align-items-center mb-2 justify-content-center">
                            <div class="title-dot"></div>
                            <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                <?php echo e(trans('labels.testimonials')); ?></p>
                            <div class="title-dot"></div>
                        </div>
                        <h4 class="text-dark wdt-heading-title line-1 text-center text-truncate">
                            <?php echo e(trans('labels.testimonial_subtitle')); ?>

                        </h4>
                        <div class="row justify-content-center mt-sm-5 mt-3">
                            <div class="">
                                <div id="testimonial9" class="owl-carousel owl-theme">
                                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item h-100">
                                            <div
                                                class="shadow-theme-9 rounded-4 h-100 <?php echo e(session()->get('direction') == 2 ? 'rtl ms-2' : 'me-2'); ?>">
                                                <div
                                                    class="bg-primary d-flex justify-content-center p-3 mb-3 rounded-4 h-100">
                                                    <div class="client-profile">

                                                        <div class="">
                                                            <ul class="fs-7 mb-2">
                                                                <?php
                                                                    $count = (int) $testimonial->star;
                                                                ?>
                                                                <li>
                                                                    <?php for($i = 0; $i < 5; $i++): ?>
                                                                        <?php if($i < $count): ?>
                                                                            <i class="fa-solid fa-star text-warning"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-star text-warning"></i>
                                                                        <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                </li>
                                                            </ul>
                                                            <p class="fs-7 text-capitalize text-white mb-2">“
                                                                <?php echo e($testimonial->description); ?>”</p>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <img src="<?php echo e(helper::image_path($testimonial->image)); ?>"
                                                                class="w-100 theme-9-client-img" alt="">
                                                            <p class="fs-16 fw-600 text-white text-capitalize">
                                                                <?php echo e($testimonial->name); ?>

                                                                <span class="fs-7 text-secondary d-block">
                                                                    <?php echo e($testimonial->position); ?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="my-5">
                <div class="container rounded-0">
                    <div
                        class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5 bg-border border-primary-color rounded-4">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-dark"><?php echo e(@$appsection->title); ?></h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-lightslategray line-2"><?php echo e(@$appsection->subtitle); ?></p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <div
                                    class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(@$appsection->android_link); ?>"> <img
                                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg')); ?>"
                                            class="g-play rounded-3 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                            alt=""> </a>
                                </div>
                                <!-- App store button -->
                                <div
                                    class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(@$appsection->ios_link); ?>"> <img
                                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg')); ?>"
                                            class="g-play rounded-3 btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                            alt=""> </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="<?php echo e(helper::image_path(@$appsection->image)); ?>"
                                    class="h-500px object-fit-cover w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!--------------------------------------------------- theme-9-blog-section --------------------------------------------------->
        <?php if(@helper::checkaddons('subscription')): ?>
            <?php if(@helper::checkaddons('blog')): ?>

                <?php
                    $checkplan = App\Models\Transaction::where('vendor_id', $vdata)->orderByDesc('id')->first();
                    if ($user->allow_without_subscription == 1) {
                        $blogs = 1;
                    } else {
                        $blogs = @$checkplan->blogs;
                    }
                ?>
                <?php if($blogs == 1): ?>
                    <?php if(count(helper::getblogs(@$vdata, '6', '')) > 0): ?>
                        <section class="theme-9-blog pb-md-5 pb-4">
                            <div class="container">
                                <div class="text-center mb-md-5 mb-4">
                                    <div class="d-flex align-items-center mb-2 justify-content-center">
                                        <div class="title-dot"></div>
                                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                            <?php echo e(trans('labels.blog_title')); ?>

                                        </p>
                                        <div class="title-dot"></div>
                                    </div>
                                    <span
                                        class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.featured_blogs')); ?></span>
                                </div>
                                <?php $__currentLoopData = helper::getblogs(@$vdata, '5', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key == 0): ?>
                                        <div class="row g-3 g-xl-4 justify-content-between pb-3">
                                        <?php else: ?>
                                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                                <div
                                                    class="card h-100 border-0 rounded-4 shadow-theme-9 overflow-hidden <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                                    <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                        class="products-img w-100 object-fit-cover" height="230"
                                                        alt="blog-image">
                                                    <div class="card-body pb-1">
                                                        <div
                                                            class="mb-2 <?php echo e(@helper::appdata(@$vdata)->web_layout == 1 ? 'text-start' : 'text-end'); ?>">
                                                        </div>
                                                        <h6 class="card-title fw-600 mb-1 line-2"><a class="text-dark"
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                                        </h6>
                                                        <div class="line-2 fs-7 pt-1 text-lightslategray">
                                                            <?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                                    </div>
                                                    <div
                                                        class="card-footer d-flex align-items-center justify-content-between">
                                                        <div class="d-flex fs-8">
                                                            <i class="fa-regular fa-clock"></i>
                                                            <p class="text-lightslategray px-1">
                                                                <?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?>

                                                            </p>
                                                        </div>
                                                        <a class="text-primary fs-15 rounded-2"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>">
                                                            <?php echo e(trans('labels.readmore')); ?><span
                                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="d-flex justify-content-center mt-md-5 mt-4">
                                <div
                                    class="shadow-theme-9 rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button btn-theme-9 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">
                                        <?php echo e(trans('labels.viewall')); ?><span
                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                    </a>
                                </div>
                            </div>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-9/index.blade.php ENDPATH**/ ?>
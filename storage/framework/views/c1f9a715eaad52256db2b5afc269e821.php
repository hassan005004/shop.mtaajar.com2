<?php $__env->startSection('contents'); ?>
    <!------------------------------------------------ theme-6-slider-main-section ------------------------------------------------>

    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-6-slider">
            <div class="theme-6-main-banner owl-carousel owl-theme h-100">

                <?php $__currentLoopData = $getsliderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
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
                            <img src="<?php echo e($slider['image']); ?>" class="w-100 h-100 object-fit-cover img-fluid" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <h2 class="text-primary fw-bold mb-md-3 mb-1 home-subtitle">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-primary fs-18 mb-md-5 mb-2 home-description">
                                            <?php echo e($slider['description']); ?>

                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slider['image']); ?>" class="w-100 h-100 object-fit-cover img-fluid" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <h2 class="text-primary fw-bold mb-md-3 mb-1 home-subtitle">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-primary fs-18 mb-md-5 mb-2 home-description">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                        <div class="d-flex justify-content-start">
                                            <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                                <?php if($slider['type'] == 1): ?>
                                                    <a class="btn btn-fashion"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                    <?php elseif($slider['type'] == 2): ?>
                                                        <a class="btn btn-fashion"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                        <?php elseif($slider['type'] == 3): ?>
                                                            <a class="btn btn-fashion" href="<?php echo e($slider['custom_link']); ?>"
                                                                target="_blank">
                                                            <?php else: ?>
                                                                <a class="btn btn-fashion" href="javascript:void(0)">
                                                <?php endif; ?><?php echo e($slider['link_text']); ?> <i
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endif; ?>
    <main class="bg-primary-rgb-main">

        <!---------------------------------------------------- new top-bar-offer ---------------------------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <div class="overflow-hidden offers-theme">
                <div class="offer-badge top-bar-offer    <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> ">
                    <?php echo e(trans('labels.best_offers')); ?>

                </div>
                <div class="offers text-secondary ">
                    <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>


        <!------------------------------------------------ theme-6-category-section ------------------------------------------------>
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-6-category my-md-5 my-4">
                <div class="container">
                    <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                        <div class=" mb-md-0 mb-2 col-auto">
                            <p class="fs-6 text-uppercase text-dark fw-500 specks-subtitle mb-1">
                                <?php echo e(trans('labels.homepage_category_subtitle')); ?>

                            </p>
                            <div class="title-line-2 mb-2"></div>
                            <span
                                class="text-dark wdt-heading-title line-1 text-capitalize"><?php echo e(trans('labels.choose_by_category')); ?></span>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-secondary rounded-0 fs-6 category-button px-3 py-2"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>">
                                <?php echo e(trans('labels.viewall')); ?><span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                            </a>
                        </div>
                    </div>
                    <div class="theme-6-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100">
                                <div
                                    class="card h-100 shadow-none outline-none rounded-0 border-primary bg-transparent border-1 p-sm-2 p-1">
                                    <div class="d-flex align-items-center">
                                        <div class="cat-img col-md-4 col-6">
                                            <a
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                                <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                    class="w-100 object-fit-cover rounded-0" alt="category image"></a>
                                        </div>
                                        <div
                                            class="card-body py-0 px-1 col-4 <?php echo e(session()->get('direction') == 2 ? 'pe-2 ps-0' : 'ps-2 pe-0'); ?>">
                                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                                class="card-title text-dark fs-15 choose-by-category-name line-2 m-0"><?php echo e($categorydata['name']); ?></a
                                                href="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>


        <!---------------------------------------------- theme-6-offer-banner-1-section -------------------------------------------->
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-6-offer-banner-1 py-md-5 py-4  bg-primary-rgb-dark">
                <div class="container">
                    <div class="theme-6-offer-banner-1-carousel owl-carousel owl-theme">
                        <?php $__currentLoopData = $getbannerslist['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <?php if($banner['type'] == 1): ?>
                                    <a
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug)); ?>">
                                    <?php elseif($banner['type'] == 2): ?>
                                        <a
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug)); ?>">
                                        <?php elseif($banner['type'] == 3): ?>
                                            <a href="<?php echo e($banner['product_info']); ?>" target="_blank">
                                            <?php else: ?>
                                                <a href="javascript:void(0)">
                                <?php endif; ?>
                                <img src="<?php echo e($banner['image']); ?>" alt=""
                                    class="w-100 h-100 rounded object-fit-cover">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------ theme-6-best-Selling-Products-section ------------------------------------------>
        <section class="theme-6-best-Selling-product py-md-5 py-4">
            <div class="container">
                <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                    <div class="mb-md-0 mb-2 col-auto">
                        <p class="fs-6 text-uppercase text-dark fw-500 specks-subtitle mb-1">
                            <?php echo e(trans('labels.homepage_product_subtitle')); ?>

                        </p>
                        <div class="title-line-2 mb-2"></div>
                        <span
                            class="text-dark wdt-heading-title text-truncate text-capitalize"><?php echo e(trans('labels.best_selling_product')); ?></span>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-secondary rounded-0 category-button fs-6 px-3 py-2"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">
                            <?php echo e(trans('labels.viewall')); ?><span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                        </a>
                    </div>
                </div>
                <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-sm-3 g-2">
                    <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.theme-6.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-------------------------------------------------------- WHO WE ARE -------------------------------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-primary-rgb-dark py-5">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                class="w-100 object-fit-cover" alt="">
                        </div>
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                            <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?>

                            </p>
                            <div class="pb-0 row">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="d-flex gap-2 col-sm-6 align-items-md-center align-items-start mb-xl-4 mb-lg-2 mb-3">
                                        <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                            class="icon-lg bg-success col-2 bg-opacity-10 text-success rounded-circle"
                                            alt="">
                                        <div class="py-md-2 px-md-3 p-1 col-md-10 col-sm-9 col-10">
                                            <h5 class="mb-1 fw-600"><?php echo e($item->title); ?></h5>
                                            <p class="mb-0 fs-7 line-2"><?php echo e($item->sub_title); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------------- theme-6-offer-banner-2-section ---------------------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-6-offer-banner-3 py-5">
                <div class="container">
                    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $getbannerslist['bannersection2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>" data-bs-interval="4000">
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
                                    <img src="<?php echo e($banner['image']); ?>" class="d-block w-100 object-fit-cover"
                                        alt="..."></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($getbannerslist['bannersection2']) > 1): ?>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i class="fa-solid fa-arrow-left arrow-btn"></i></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.previous')); ?></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i class="fa-solid fa-arrow-right arrow-btn"></i></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.next')); ?></span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!------------------------------------------------ theme-6-new-product-section ----------------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-6-new-product py-md-5 py-3 bg-gradient-primary">
                <div class="container">
                    <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                        <div class="mb-md-0 mb-2 col-auto">
                            <p class="fs-6 text-uppercase text-dark fw-500 specks-subtitle mb-1">
                                <?php echo e(trans('labels.new_arrival_product_subtitle')); ?>

                            </p>
                            <div class="title-line-2 mb-2"></div>
                            <span
                                class="text-dark wdt-heading-title text-truncate text-capitalize"><?php echo e(trans('labels.new_arrival_products')); ?></span>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-secondary rounded-0 fs-6 px-3 py-2"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                                <?php echo e(trans('labels.viewall')); ?><span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                            </a>
                        </div>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-2 g-sm-3 g-2 p-0">
                        <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-6.newproductcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------------- theme-6-offer-banner-3-section ---------------------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-6-offer-banner-3 py-md-5 py-4">
                <div class="container-fluid">
                    <div class="theme-6-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $getbannerslist['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
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
                                <img src="<?php echo e($banner['image']); ?>" alt="banner-3" class="object-fit-cover rounded-0">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-------------------------------------------------------- DEALS START ------------------------------------------------------->
        <?php if(@helper::checkaddons('top_deals')): ?>
            <?php if(!empty(helper::top_deals($vendordata->id))): ?>
                <?php if(helper::top_deals($vendordata->id)->top_deals_switch == 1): ?>
                    <?php if(!empty($topdealsproducts)): ?>
                        <section class="deals bg-primary-rgb-dark py-100" id="topdeals">
                            <div class="container">
                                <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                                    <div class="text-uppercase mb-md-0 mb-2 col-auto">
                                        <p class="text-dark fw-500 text-truncate mb-2">
                                            <?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                        </p>
                                        <div class="title-line-2 mb-2"></div>
                                        <span
                                            class="text-dark wdt-heading-title text-truncate text-capitalize"><?php echo e(trans('labels.home_page_top_deals_subtitle')); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                            class="btn btn-sm btn-secondary rounded-0 fs-6 px-3 py-2"><?php echo e(trans('labels.viewall')); ?>

                                            <i
                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2'); ?>"></i></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="countdown" class="mb-md-5 mb-4 countdown-border"> </div>

                                    <div id="top-deals6" class="owl-carousel owl-theme">
                                        <?php $__currentLoopData = $topdealsproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                if (@$topdeals->offer_type == 1) {
                                                    $price = $products->price - @$topdeals->offer_amount;
                                                } else {
                                                    $price =
                                                        $products->price -
                                                        $products->price * (@$topdeals->offer_amount / 100);
                                                }
                                                $original_price = $products->price;
                                                $off =
                                                    $original_price > 0
                                                        ? number_format(100 - ($price * 100) / $original_price, 1)
                                                        : 0;
                                            ?>
                                            <div class="item h-100 bg-white mx-sm-1">
                                                <div
                                                    class="card product-card-side-6 p-0 h-100 border-1 p-2 rounded-0 bg-white">
                                                    <div class="img-wrap w-100 h-100 position-relative">
                                                        <a
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                            <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                                class="w-100 h-100 img-fluid object-fit-cover img-1"
                                                                alt="">
                                                            <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                                class="w-100 img-2 h-100 object-fit-cover" alt="">
                                                        </a>
                                                        <?php if($off > 0): ?>
                                                            <span
                                                                class="<?php echo e(session()->get('direction') == 2 ? 'theme-sale-label-rtl' : 'sale-label'); ?>"><?php echo e($off); ?>%
                                                                <?php echo e(trans('labels.off')); ?></span>
                                                        <?php endif; ?>
                                                        <!-- options -->
                                                        <ul
                                                            class="option-wrap d-flex align-items-center d-grid gap-4 product_icon2 mt-2">
                                                            <?php if(@helper::checkaddons('customer_login')): ?>
                                                                <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                                    <li tooltip="Wishlist" class="rounded-circle">
                                                                        <a onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                            class="option-btn circle-round wishlist-btn rounded-0">
                                                                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                                <?php

                                                                                    $favorite = helper::ceckfavorite(
                                                                                        $products->id,
                                                                                        $vendordata->id,
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
                                                            <li tooltip="View" class="rounded-circle">
                                                                <a class="option-btn circle-round wishlist-btn rounded-0"
                                                                    onclick="productview('<?php echo e($products->id); ?>')">
                                                                    <i class="fa-regular fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                                <li tooltip="Add To Cart" class="rounded-circle">
                                                                    <?php if($products->has_variation == 1): ?>
                                                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                            class="option-btn circle-round addtocart-btn wishlist-btn rounded-0">
                                                                            <i
                                                                                class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a class="option-btn circle-round addtocart-btn wishlist-btn rounded-0"
                                                                            onclick="calladdtocart('<?php echo e($products->id); ?>','<?php echo e($products->slug); ?>','<?php echo e($products->name); ?>','<?php echo e($products['product_image'] == null ? 'product.png' : $products['product_image']->image); ?>','<?php echo e($products->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                                            <i
                                                                                class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                        <!-- options -->
                                                    </div>
                                                    <div class="card-body content-box w-100 px-0 pt-3 pb-2">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-md-2">
                                                            <p class="card-title fs-8 text-muted m-0 text-truncate">
                                                                <?php echo e(@$products['category_info']->name); ?>

                                                            </p>

                                                            <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                                <p class="fs-8">
                                                                    <i class="text-warning fs-8 fa-solid fa-star px-1"></i>
                                                                    <span
                                                                        class="text-dark fw-500"><?php echo e(number_format($products->ratings_average, 1)); ?></span>
                                                                </p>
                                                            <?php endif; ?>

                                                        </div>
                                                        <a
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                            <h5 class="truncate-2 mb-3 text-dark product-name line-2 h-42">
                                                                <?php echo e($products->name); ?>

                                                            </h5>
                                                        </a>
                                                        <h5
                                                            class="text-dark fs-7 fw-semibold product-price-size cursor-auto text-truncate">
                                                            <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                            <?php if($original_price > $price): ?>
                                                                <del
                                                                    class="text-muted mt-1 fs-8 fw-500 d-block"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                            <?php endif; ?>
                                                        </h5>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <!----------------------------------------------------- TESTIMONIAL START ---------------------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial py-5">
                    <div class="container position-relative">
                        <span
                            class="wdt-heading-subtitle text-center text-truncate"><?php echo e(trans('labels.testimonials')); ?></span>
                        <h4 class="wdt-heading-title text-center text-truncate mb-md-5 mb-4">
                            <?php echo e(trans('labels.testimonial_subtitle')); ?>

                        </h4>
                        <div>
                            <div id="testimonial6" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <div class="description-box p-3 mb-3">
                                            <p class="fs-7 text-capitalize description position-relative">“
                                                <?php echo e($testimonial->description); ?>”</p>
                                            <div
                                                class=" <?php echo e(session()->get('direction') == 2 ? 'description-arrow-rtl' : 'description-arrow'); ?>">
                                            </div>
                                        </div>

                                        <div class="client-profile d-flex align-items-center px-3">
                                            <img src="<?php echo e(helper::image_path($testimonial->image)); ?>"
                                                class="w-100 mx-2 client-img-small" alt="">
                                            <div>
                                                <p class="client-name"> <?php echo e($testimonial->name); ?> - <span
                                                        class="profession">
                                                        <?php echo e($testimonial->position); ?></span></p>
                                                <ul class="fs-7">
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
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <!------------------------------------------ app downlode end -------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="py-md-5 py-4 bg-gradient-primary">
                <div class="container rounded-0">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                            <!-- Title -->
                            <h3 class="fs-2 m-0 fw-bold text-dark"><?php echo e(@$appsection->title); ?></h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-dark line-2"><?php echo e(@$appsection->subtitle); ?></p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <a href="<?php echo e(@$appsection->android_link); ?>"> <img
                                        src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg')); ?>"
                                        class="g-play" alt=""> </a>
                                <!-- App store button -->
                                <a href="<?php echo e(@$appsection->ios_link); ?>"> <img
                                        src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg')); ?>"
                                        class="g-play" alt=""> </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="<?php echo e(helper::image_path(@$appsection->image)); ?>"
                                    class="h-500px w-100 object-fit-cover " alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!------------------------------------------ theme-6-blog-section ------------------------------------------>
        <?php if(@helper::checkaddons('subscription')): ?>
            <?php if(@helper::checkaddons('blog')): ?>
                <?php
                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                        ->orderByDesc('id')
                        ->first();
                    if ($vendordata->allow_without_subscription == 1) {
                        $blogs = 1;
                    } else {
                        $blogs = @$checkplan->blogs;
                    }
                ?>
                <?php if($blogs == 1): ?>
                    <?php if(count(helper::getblogs(@$vendordata->id, '6', '')) > 0): ?>
                        <section class="theme-6-blog py-md-5 py-4">
                            <div class="container">
                                <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                                    <div class="text-uppercase mb-md-0 mb-2 col-auto">
                                        <p class="text-dark fw-500 text-truncate mb-2"><?php echo e(trans('labels.blog_title')); ?>

                                        </p>
                                        <div class="title-line-2 mb-2"></div>
                                        <span
                                            class="text-dark wdt-heading-title text-truncate text-capitalize"><?php echo e(trans('labels.featured_blogs')); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-sm btn-secondary rounded-0 fs-6 px-3 py-2"
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">
                                            <?php echo e(trans('labels.viewall')); ?><span
                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row g-3 g-xl-4 justify-content-between">

                                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '5', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key == 0): ?>
                                            <div class="col-lg-6">
                                                <div>
                                                    <div class="card border-0 bg-transparent h-100">

                                                        <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                            class="card-img-top w-100 object-fit-cover rounded-0 blog-img-height position-relative"
                                                            alt="blog-image">
                                                        <div class="card-body px-0">
                                                            <h6 class="card-title line-2 mb-1 fw-bold"> <a
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                                    class="text-dark"><?php echo e($blog->title); ?></a>
                                                            </h6>
                                                            <div class="pt-1 fs-7 line-2">
                                                                <?php echo strip_tags(Str::limit($blog->description, 200)); ?>

                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center pt-3 pb-2">

                                                                <div class="text-dark fs-8"><i
                                                                        class="fa-solid fa-calendar-days"></i><span
                                                                        class="px-1 fw-500 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                                </div>

                                                                <a class="fw-semibold text-secondary fs-15 fw-500"
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e(trans('labels.readmore')); ?><span
                                                                        class="mx-1"><i
                                                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long'); ?>"></i></span></a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <?php else: ?>
                                                <div class="card border-0 bg-transparent mb-4">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-4 mb-4 mb-sm-0">
                                                            <div class="img-overlay rounded-4">
                                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                                    class="card-img-top w-100 object-fit-cover rounded-0 sub-blog-height"
                                                                    alt="blog-image">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <h6 class="fw-bold mb-1 line-2"><a
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                                    class="text-dark"><?php echo e($blog->title); ?></a></h6>
                                                            <div class="pt-1 fs-7 line-2"><?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-3">
                                                                <div class="text-dark fs-8"><i
                                                                        class="fa-solid fa-calendar-days"></i><span
                                                                        class="px-1 fw-500 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                                </div>
                                                                <a class="fw-semibold fs-15 text-secondary"
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e(trans('labels.readmore')); ?><span
                                                                        class="mx-1"><i
                                                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long'); ?>"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-6/index.blade.php ENDPATH**/ ?>
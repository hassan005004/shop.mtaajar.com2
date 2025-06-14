<?php $__env->startSection('contents'); ?>
    <div class="theme-1">

        <!-- BANNER AREA START -->
        <?php if(count($getsliderlist) > 0): ?>
            <section class="banner-area">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 d-none d-xl-block mb-3">
                            <div class="d-none d-xl-block">
                                <a class="top-category">
                                    <h5 class="mx-2 fw-600"><?php echo e(trans('labels.top_categories')); ?></h5>
                                </a>
                            </div>
                            <!-- FOR LARGE DEVICE TOP CATEGORIES -->
                            <div class="myCategories">
                                <div class="cats_menu">
                                    <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
                                        <ul class="fs-7">
                                            <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(count(helper::getsubcategories($categorydata->id, '7')) > 0): ?>
                                                    <li
                                                        class="active <?php echo e(session()->get('direction') == 2 ? 'has-sub-rtl' : 'has-sub'); ?>">
                                                        <a class="py-2 d-flex align-items-center text-dark"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                                            <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                                alt="" class="img-fluid rounded categories-sm-img">
                                                            <span class="mx-2"><?php echo e($categorydata['name']); ?></span>
                                                        </a>
                                                        <ul
                                                            class="<?php echo e(session()->get('direction') == 2 ? 'rtl-position' : 'has-sub'); ?>">
                                                            <?php $__currentLoopData = helper::getsubcategories($categorydata->id, ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcatdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a class="has-sub text-dark"
                                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'] . '&subcategory=' . $subcatdata->slug)); ?>"><span><?php echo e($subcatdata->name); ?></span></a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="py-2 text-dark"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                                            <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                                alt="" class="img-fluid rounded categories-sm-img">
                                                            <span class="mx-2"><?php echo e($categorydata['name']); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <li class="text-center"><a class="text-dark"
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>">
                                                    <?php echo e(trans('labels.viewall')); ?> <i
                                                        class="fa-regular fa-arrow-<?php echo e(session()->get('direction') == 2 ? 'left' : 'right'); ?> mx-2"></i></a>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-12">
                            <div class="banner-slider">
                                <div id="banner_slider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php $__currentLoopData = $getsliderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>"
                                                data-bs-interval="2500">
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
                                                    <img src="<?php echo e($slider['image']); ?>"
                                                        class="d-block w-100 h-fit-content object-fit-cover h-100"
                                                        alt="banner">
                                                    <div
                                                        class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-12">
                                                                <h5
                                                                    class="text-dark mb-md-2 mb-1 text-uppercase ls-3 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                                                    <?php echo e($slider['title']); ?>

                                                                </h5>
                                                                <h2
                                                                    class="text-dark fw-bold mb-md-3 mb-1 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                                                    <?php echo e($slider['sub_title']); ?>

                                                                </h2>
                                                                <p
                                                                    class="text-dark mb-md-3 mb-2 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                                                    <?php echo e($slider['description']); ?>

                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div></a>
                                                <?php else: ?>
                                                    <img src="<?php echo e($slider['image']); ?>"
                                                        class="d-block w-100 h-fit-content object-fit-cover h-100"
                                                        alt="banner"></a>
                                                    <div
                                                        class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-12">
                                                                <h5
                                                                    class="text-dark mb-md-2 mb-1 text-uppercase ls-3 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                                                    <?php echo e($slider['title']); ?>

                                                                </h5>
                                                                <h2
                                                                    class="text-dark fw-bold mb-md-3 mb-1 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                                                    <?php echo e($slider['sub_title']); ?>

                                                                </h2>
                                                                <p
                                                                    class="text-dark mb-md-3 mb-2 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
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
                                                                                    <a class="btn btn-fashion"
                                                                                        href="<?php echo e($slider['custom_link']); ?>"
                                                                                        target="_blank">
                                                                                    <?php else: ?>
                                                                                        <a class="btn btn-fashion"
                                                                                            href="javascript:void(0)">
                                                                        <?php endif; ?>
                                                                        <?php echo e($slider['link_text']); ?> <i
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
                                    <?php if(count($getsliderlist) > 1): ?>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#banner_slider"
                                            data-bs-slide="prev">
                                            <span aria-hidden="true">
                                                <i class="fa-solid fa-arrow-left slider-arrows rounded-5"></i>
                                            </span><span class="visually-hidden"><?php echo e(trans('pagination.previous')); ?></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#banner_slider"
                                            data-bs-slide="next"> <span aria-hidden="true"><i
                                                    class="fa-solid fa-arrow-right slider-arrows rounded-5"></i></span><span
                                                class="visually-hidden"><?php echo e(trans('pagination.next')); ?></span> </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- BANNER AREA END -->

        <!------------------------------------------- theme-1-offer-banner-1-section ----------------------------------------->
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="offer-banner-carousel-1 owl-carousel owl-theme">
                        <?php $__currentLoopData = $getbannerslist['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <img src="<?php echo e($banner['image']); ?>" alt=""
                                    class="w-100 h-100 rounded object-fit-cover">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- OFFERS BANNER 1 AREA END -->

        <!-- BEST SELLING PRODUCTS START -->
        <?php if(count($getbestsellingproducts) > 0): ?>
            <section class="best-product pro-hover">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading flex-wrap pb-4">
                                <div>
                                    <p class="subtitle text-truncate"><?php echo e(trans('labels.homepage_product_title')); ?></p>
                                    <h4 class="section-title text-truncate"><?php echo e(trans('labels.best_selling_products')); ?>

                                    </h4>
                                </div>
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>"
                                    class="btn btn-sm btn-fashion"><?php echo e(trans('labels.viewall')); ?> <i
                                        class=" <?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right'); ?>"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                        <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.productcommonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- BEST SELLING PRODUCTS END -->

        <!------- new top-bar-offer ------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!------- new top-bar-offer ------->

        <!---------- WHO WE ARE ---------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-light py-md-5 py-4">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-5 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                            <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?>

                            </p>
                            <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex align-items-center mb-xl-4 mb-lg-2">
                                        <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                            class="icon-lg bg-success bg-opacity-10 text-success rounded-circle"
                                            alt="">
                                        <div class="p-3">
                                            <h5 class="mb-1 line-1 fw-600"><?php echo e($item->title); ?></h5>
                                            <p class="mb-0 line-2 fs-7"><?php echo e($item->sub_title); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                class="w-100 object-fit-cover" alt="">
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!---------- WHO WE ARE ---------->

        <!-- OFFERS BANNER 2 START -->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="offers-banner-area_2 my-md-5 my-4">
                <div class="container">
                    <div id="banner_slider_2" class="carousel slide carousel-fade rounded-2" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $getbannerslist['bannersection2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>" data-bs-interval="2500">
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
                                    <img src="<?php echo e($banner['image']); ?>" class="object-fit-contain"></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($getbannerslist['bannersection2']) > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#banner_slider_2"
                                data-bs-slide="prev"> <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left arrow-btn"></i></span><span
                                    class="visually-hidden"><?php echo e(trans('pagination.previous')); ?></span> </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#banner_slider_2"
                                data-bs-slide="next"> <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right arrow-btn"></i></span><span
                                    class="visually-hidden"><?php echo e(trans('pagination.next')); ?></span> </button>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- OFFERS BANNER 2 END -->

        <!-- NEW ARRIVAL PRODUCTS START -->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="new-product bg-light py-md-5 py-4">
                <div class="container">
                    <div class="row pb-4">
                        <div class="col-lg-12">
                            <div class="section-heading flex-wrap">
                                <div>
                                    <p class="subtitle  text-truncate">
                                        <?php echo e(trans('labels.homepage_newarrivalprodect_title')); ?>

                                    </p>
                                    <h4 class="section-title  text-truncate"><?php echo e(trans('labels.new_arrival_products')); ?>

                                    </h4>
                                </div>
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>"
                                    class="btn btn-fashion"><?php echo e(trans('labels.viewall')); ?> <i
                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right'); ?>"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1 g-3 g-sm-4">

                                <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col">
                                        <?php
                                            if (
                                                $getproductdata->top_deals == 1 &&
                                                helper::top_deals($vendordata->id) != null
                                            ) {
                                                if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                                    $price =
                                                        $getproductdata->price -
                                                        @helper::top_deals($vendordata->id)->offer_amount;
                                                } else {
                                                    $price =
                                                        $getproductdata->price -
                                                        $getproductdata->price *
                                                            (@helper::top_deals($vendordata->id)->offer_amount / 100);
                                                }
                                                $original_price = $getproductdata->price;
                                            } else {
                                                $price = $getproductdata->price;
                                                $original_price = $getproductdata->original_price;
                                            }
                                            $off =
                                                $original_price > 0
                                                    ? number_format(100 - ($price * 100) / $original_price, 1)
                                                    : 0;
                                        ?>
                                        <div class="card product-card-side h-100 p-0">
                                            <div class="img-wrap overflow-hidden position-relative">
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                                                    <img src="<?php echo e($getproductdata['product_image']->image_url); ?>"
                                                        class="w-100 img-fluid object-fit-cover h-190 img-1"
                                                        alt="">
                                                    <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                                                        class="w-100 img-2 h-190" alt="">
                                                </a>
                                                <?php if($off > 0): ?>
                                                    <span
                                                        class="<?php echo e(session()->get('direction') == 2 ? 'arrow-label-wrap-rtl' : 'arrow-label-wrap'); ?>">
                                                        <span class="arrow-label bg-theme-sun"><?php echo e($off); ?>%
                                                            OFF</span></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body p-xl-3 p-2 content-box w-100">
                                                <div class="d-flex align-items-center justify-content-between mb-md-2">
                                                    <p
                                                        class="card-title fs-8 text-muted m-0 text-truncate text-capitalize">
                                                        <?php echo e(@$getproductdata['category_info']->name); ?>

                                                    </p>
                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                            <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                                <p class="fs-8"><i
                                                                        class="text-warning fa-solid fa-star px-1"></i>
                                                                    <span
                                                                        class="text-dark fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                                                                </p>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                                                    <h5 class="truncate-2 mb-1 text-dark product-name line-2 h-40">
                                                        <?php echo e($getproductdata->name); ?>

                                                    </h5>
                                                </a>
                                                <h5
                                                    class="text-secondary fs-7 fw-semibold mb-0 product-price text-truncate">
                                                    <?php echo e(helper::currency_formate($price, $vendordata->id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <?php if($original_price > 0): ?>
                                                            <del
                                                                class="text-muted fw-500 fs-8 fw-normal"><?php echo e(helper::currency_formate($original_price, $vendordata->id)); ?></del>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </h5>

                                                <!-- options -->
                                                <ul
                                                    class="option-wrap d-flex align-items-center d-grid gap-3 product_icon2 mt-2">
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li tooltip="Wishlist" class="rounded-circle">
                                                                <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                    class="circle-round wishlist-btn">
                                                                    <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                                                        <?php

                                                                            $favorite = helper::ceckfavorite(
                                                                                $getproductdata->id,
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
                                                        <a class="circle-round wishlist-btn"
                                                            onclick="productview('<?php echo e($getproductdata->id); ?>')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li tooltip="Add To Cart" class="rounded-circle">
                                                            <?php if($getproductdata->has_variation == 1): ?>
                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                                                    class="circle-round addtocart-btn wishlist-btn">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="circle-round addtocart-btn  wishlist-btn"
                                                                    onclick="calladdtocart('<?php echo e($getproductdata->id); ?>','<?php echo e($getproductdata->slug); ?>','<?php echo e($getproductdata->name); ?>','<?php echo e($getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image); ?>','<?php echo e($getproductdata->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
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
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- NEW ARRIVAL PRODUCTS END -->

        <!-- TESTIMONIAL START -->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial my-5">
                    <div class="container position-relative">
                        <div class="text-center mb-4">
                            <p class="subtitle text-truncate"><?php echo e(trans('labels.testimonials')); ?></p>
                            <h4 class="section-title text-truncate"><?php echo e(trans('labels.testimonial_subtitle')); ?></h4>
                        </div>
                        <div class="col-lg-9 col-12 mx-auto">
                            <div id="testimonial" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item text-center">
                                        <ul class="mb-md-4 mb-2 fs-7">
                                            <?php
                                                $count = (int) $testimonial->star;
                                            ?>
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                <?php if($i < $count): ?>
                                                    <li class="list-inline-item me-0 small"><i
                                                            class="fa-solid fa-star text-warning"></i>
                                                    </li>
                                                <?php else: ?>
                                                    <li class="list-inline-item me-0 small"><i
                                                            class="fa-regular fa-star text-warning"></i>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </ul>
                                        <p class="fs-7">“<?php echo e($testimonial->description); ?>”</p>
                                        <div class="client-profile">
                                            <p class="client-name py-4"><?php echo e($testimonial->name); ?> - <span
                                                    class="profession"><?php echo e($testimonial->position); ?></span></p>
                                            <img src="<?php echo e(helper::image_path($testimonial->image)); ?>"
                                                class="w-100 client-img" alt="">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <!-- TESTIMONIAL END -->

        <!-- DEALS START -->
        <?php if(@helper::checkaddons('top_deals')): ?>
            <?php if(!empty(helper::top_deals($vendordata->id))): ?>
                <?php if(count($topdealsproducts) > 0): ?>
                    <section class="deals bg-dark mb-5 pro-hover theme-1" id="topdeals">
                        <div class="container py-5">
                            <div id="countdown" class="mb-4"></div>
                            <div class="d-md-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <p class="subtitle text-white text-truncate">
                                        <?php echo e(trans('labels.home_page_top_deals_title')); ?></p>
                                    <h4 class="section-title text-white text-truncate">
                                        <?php echo e(trans('labels.home_page_top_deals_subtitle')); ?>

                                    </h4>
                                </div>
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                    class="btn btn-primary rounded-0 mt-2 mt-md-0"><?php echo e(trans('labels.viewall')); ?> <i
                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right'); ?>"></i>
                                </a>
                            </div>

                            <div id="top-deals" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = $topdealsproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                            $price =
                                                $products->price - @helper::top_deals($vendordata->id)->offer_amount;
                                        } else {
                                            $price =
                                                $products->price -
                                                $products->price *
                                                    (@helper::top_deals($vendordata->id)->offer_amount / 100);
                                        }
                                        $original_price = $products->price;
                                        $off =
                                            $original_price > 0
                                                ? number_format(100 - ($price * 100) / $original_price, 1)
                                                : 0;
                                    ?>
                                    <div class="item h-100">
                                        <div class="card h-100 border-0 rounded-0 overflow-hidden">
                                            <div class="overflow-hidden position-relative">
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1')); ?>">
                                                    <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                        class="card-img-top w-100 img-1" alt="...">
                                                    <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                        class="w-100 img-2" alt="">
                                                </a>
                                                <!-- NEW label -->
                                                <?php if($off > 0): ?>
                                                    <span
                                                        class="<?php echo e(session()->get('direction') == 2 ? 'arrow-label-wrap-rtl' : 'arrow-label-wrap'); ?>">
                                                        <span class="arrow-label bg-theme-sun"><?php echo e($off); ?>%
                                                            OFF</span></span>
                                                <?php endif; ?>

                                                <!-- NEW label -->

                                                <!-- options -->
                                                <ul class="option-wrap">
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li class="" tooltip="Wishlist" class="rounded-circle">
                                                                <a href="javscript:void(0)"
                                                                    onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                    class="circle-round wishlist-btn">
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
                                                        <a class="circle-round wishlist-btn"
                                                            onclick="productview('<?php echo e($products->id); ?>')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li tooltip="<?php echo e(trans('labels.addtocart')); ?>"
                                                            class="rounded-circle">
                                                            <?php if($products->has_variation == 1): ?>
                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1')); ?>"
                                                                    class="circle-round addtocart-btn wishlist-btn">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="circle-round addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('<?php echo e($products->id); ?>','<?php echo e($products->slug); ?>','<?php echo e($products->name); ?>','<?php echo e($products['product_image'] == null ? 'product.png' : $products['product_image']->image); ?>','<?php echo e($products->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                                <!-- options -->
                                            </div>

                                            <!-- product content -->
                                            <div class="card-body pb-0">
                                                <div class="d-flex gap-1 align-items-center justify-content-between mb-1">
                                                    <p
                                                        class="card-title fs-8 text-muted m-0 text-truncate text-capitalize">
                                                        <?php echo e(@$products['category_info']->name); ?>

                                                    </p>
                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                            <p class="fs-8"><i
                                                                    class="text-warning fa-solid fa-star px-1"></i><span
                                                                    class="text-dark fw-500"><?php echo e(number_format($products->ratings_average, 1)); ?></span>
                                                            </p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <h5 class="product-name">
                                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1')); ?>"
                                                        class="card-text text-dark mb-0 line-2"
                                                        title="<?php echo e($products->name); ?>"><?php echo e($products->name); ?>

                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="card-footer">
                                                <h5 class="text-dark fs-7 fw-semibold mb-0 product-price text-truncate">
                                                    <?php echo e(helper::currency_formate($price, $vendordata->id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <?php if($original_price > 0): ?>
                                                            <del
                                                                class="text-muted  fw-500 fs-8 fw-normal"><?php echo e(helper::currency_formate($original_price, $vendordata->id)); ?></del>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </h5>
                                            </div>
                                            <!-- product content -->
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <!-- DEALS END -->

        <!-- OFFERS BANNER 3 START -->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="offers-banner-area_3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="bannersection3" class="owl-carousel owl-loaded owl-drag overflow-hidden">
                                <?php $__currentLoopData = $getbannerslist['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                    <img class="rounded-0 object-fit-cover w-webkit" src="<?php echo e($banner['image']); ?>"
                                        alt=""></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- OFFERS BANNER 3 END -->

        <!-- app-downlode section start -->
        <?php if(!empty($appsection)): ?>
            <section class="bg-light">
                <div class="container">
                    <div class="row g-xl-5 g-lg-3 g-2 align-items-center justify-content-center py-5">
                        <div class="col-xl-5 col-lg-6 p-0 d-none d-lg-block position-relative">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="<?php echo e(helper::image_path(@$appsection->image)); ?>"
                                    class="h-500px w-100 object-fit-cover " alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center  <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                            <!-- Title -->
                            <h2 class="m-0 fw-bold text-dark"><?php echo e(@$appsection->title); ?></h2>
                            <p class="mb-lg-5 mb-4 mt-3 text-dark"><?php echo e(@$appsection->subtitle); ?></p>
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
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- app-downlode section start -->

        <!-- FEATURED BLOGS AREA START  -->
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
                        <section class="featured-blog py-md-5 py-4">
                            <div class="container">
                                <div class="row align-items-center justify-content-between mb-4">
                                    <div class="col-lg-12">
                                        <div class="section-heading flex-wrap">
                                            <div>
                                                <p class="subtitle text-truncate"><?php echo e(trans('labels.blog_title')); ?></p>
                                                <h4 class="section-title text-truncate">
                                                    <?php echo e(trans('labels.featured_blogs')); ?>

                                                </h4>
                                            </div>
                                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>"
                                                class="btn btn-sm btn-fashion"><?php echo e(trans('labels.viewall')); ?> <i
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right'); ?>"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="featured_blog" class="owl-carousel owl-theme overflow-hidden">
                                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '6', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card border-0 rounded-0 h-100">
                                            <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                class="card-img-top rounded-0 object-fit-cover" alt="...">
                                            <div class="card-body px-0 pb-0">
                                                <h6 class="card-text mt-2 fw-600 line-2"><a class="text-dark"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                                </h6>
                                                <div class="line-2 pt-1 fs-7"><?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                            </div>
                                            <div class="card-footer px-0">
                                                <div
                                                    class="d-flex align-items-center justify-content-between py-2 border-top">
                                                    <p class="fs-8"><i class="fa-regular fa-clock"></i><span
                                                            class="px-1 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                    </p>
                                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                        class="text-primary-color fs-15"><?php echo e(trans('labels.readmore')); ?><i
                                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long'); ?> fw-500 px-1 "></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <!-- FEATURED BLOGS AREA END  -->
    <div class="newdev owl-carousel owl-theme">
        <div class="item">
            <h4>1</h4>
        </div>
        <div class="item">
            <h4>2</h4>
        </div>
        <div class="item">
            <h4>3</h4>
        </div>
        <div class="item">
            <h4>4</h4>
        </div>
        <div class="item">
            <h4>5</h4>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/products.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-1/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('contents'); ?>

    <!---------------------------------------------- theme-4-slider-main-section ---------------------------------------------->
    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-4-slider">

            <div class="theme-4-main-banner owl-carousel owl-theme">
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
                            <img src="<?php echo e($slider['image']); ?>"
                                class="w-100 object-fit-cover img-fluid theme-4-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            <?php echo e($slider['title']); ?></h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle"><?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                            <?php echo e($slider['description']); ?>

                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slider['image']); ?>"
                                class="w-100 object-fit-cover img-fluid theme-4-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            <?php echo e($slider['title']); ?></h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                        <div class="d-flex justify-content-start">
                                            <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                                <?php if($slider['type'] == 1): ?>
                                                    <a class="btn btn-fashion rounded-5"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                    <?php elseif($slider['type'] == 2): ?>
                                                        <a class="btn btn-fashion rounded-5"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                        <?php elseif($slider['type'] == 3): ?>
                                                            <a class="btn btn-fashion rounded-5"
                                                                href="<?php echo e($slider['custom_link']); ?>" target="_blank">
                                                            <?php else: ?>
                                                                <a class="btn btn-fashion rounded-5"
                                                                    href="javascript:void(0)">
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
    <main>

        <!---------------------------------------------- theme-4-category-section ---------------------------------------------->
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-4-category py-5 pro-hover">

                <div class="container">

                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">

                        <div
                            class="border-secondary-color border-5 text-uppercase <?php echo e(session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3'); ?>">
                            <h2 class="fw-semibold fs-4 specks-title">

                                <?php echo e(trans('labels.top_categories')); ?></h2>

                            <p class="fs-6 text-muted fw-normal specks-subtitle">
                                <?php echo e(trans('labels.homepage_category_subtitle')); ?></p>

                        </div>

                        <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>">
                            <?php echo e(trans('labels.viewall')); ?><i
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2'); ?>"></i>
                        </a>
                    </div>
                    <div class="theme-4-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="theme-4-item h-100">

                                <div class="content-box border d-flex align-items-center justify-content-between p-1 h-100">

                                    <div class="cat-img p-2 w-50">

                                        <img src="<?php echo e(helper::image_path($categorydata->image)); ?>" alt=""
                                            class="w-100">

                                    </div>

                                    <div class="cat-concent w-50 mx-1">

                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                            class="fw-600 fs-15 text-capitalize"><?php echo e($categorydata['name']); ?></a>
                                        <p class="fs-13"><?php echo e(helper::product_count($categorydata->id)); ?>

                                            <?php echo e(trans('labels.items')); ?></p>

                                    </div>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>

            </section>
        <?php endif; ?>

        <!-------------------------------------------- theme-4-offer-banner-1-section ------------------------------------------>
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-4-offer-banner-1 mb-5">
                <div class="container">
                    <div class="theme-4-offer-banner-1-carousel owl-carousel owl-theme">
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
                                    class="w-100 h-100 rounded-0 object-fit-cover">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------------- new top-bar-offer ------------------------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!------------------------------------------------- best Selling product ------------------------------------------------->
        <section class="theme-4-best-Selling-product pro-hover my-5">

            <div class="container">

                <div
                    class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">

                    <div
                        class="border-secondary-color border-5 text-uppercase <?php echo e(session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3'); ?>">

                        <span class="fw-semibold fs-4 specks-title"><?php echo e(trans('labels.best_selling_product')); ?></span>

                        <p class="fs-6 text-muted fw-normal specks-subtitle">
                            <?php echo e(trans('labels.homepage_product_subtitle')); ?></p>

                    </div>

                    <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                        href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">

                        <?php echo e(trans('labels.viewall')); ?><p
                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2'); ?>">
                        </p>

                    </a>
                </div>

                <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0">
                    <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.theme-4.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        </section>

        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-light py-md-5 py-3 mb-5">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                class="w-100 object-fit-cover" alt="">
                        </div>
                        <div class="col-xl-5 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                            <h4 class="wdt-heading-title line-2"> <?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?></p>
                            <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex gap-2 align-items-md-center align-items-start mb-xl-4 mb-3">
                                        <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                            class="icon-lg bg-success bg-opacity-10 text-success rounded-circle"
                                            alt="">
                                        <div class="py-md-2 px-md-3 p-1">
                                            <h5 class="mb-1 fw-600 line-1"><?php echo e($item->title); ?></h5>
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

        <!------------------------------------------- theme-4-offer-banner-2-section ------------------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-4-offer-banner-3 mb-5">
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
                                        alt="...">
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

        <!---------------------------------------- theme-4-new-product-section ---------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-4-new-product mb-5">

                <div class="container">

                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">

                        <div
                            class="border-secondary-color border-5 text-uppercase <?php echo e(session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3'); ?>">

                            <span class="fw-semibold fs-4 specks-title"><?php echo e(trans('labels.new_arrival_products')); ?></span>

                            <p class="fs-6 text-muted fw-normal specks-subtitle">
                                <?php echo e(trans('labels.new_arrival_product_subtitle')); ?></p>

                        </div>

                        <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                            <?php echo e(trans('labels.viewall')); ?> <i
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2'); ?>">
                            </i>
                        </a>

                    </div>

                    <div class="new-arrival-products">
                        <div class="row mb-4 g-0">
                            <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    if ($getproductdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
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
                                <div class="col-md-6 col-lg-4">
                                    <div class="card product-card-side p-0 h-100  bg-white">
                                        <div class="img-wrap h-100 position-relative">
                                            <a
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?> ">
                                                <img src="<?php echo e($getproductdata['product_image']->image_url); ?>"
                                                    class="w-100 h-100 img-fluid object-fit-cover img-1" alt="">
                                                <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                                                    class="w-100 img-2" alt="">
                                            </a>
                                            <?php if($off > 0): ?>
                                                <div
                                                    class="<?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 1 ? 'sale-label-off' : 'sale-label-on'); ?>">
                                                    <?php echo e($off); ?>% OFF
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="card-body content-box w-100">
                                            <div class="d-flex align-items-center justify-content-between mb-md-2">
                                                <p class="card-title fs-8 text-secondary m-0 text-truncate">
                                                    <?php echo e(@$getproductdata['category_info']->name); ?></p>

                                                <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                    <p class="fs-8"><i
                                                            class="text-warning fs-8 fa-solid fa-star px-1"></i><span
                                                            class="text-dark fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                                                    </p>
                                                <?php endif; ?>

                                            </div>
                                            <a
                                                href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?> ">
                                                <h5 class="truncate-2 mb-3 text-dark product-name line-2 h-42">
                                                    <?php echo e($getproductdata->name); ?></h5>
                                            </a>
                                            <h6 class="product-price text-dark d-inline-block m-0 text-truncate">
                                                <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                                                <?php if($original_price > $price): ?>
                                                    <del
                                                        class="text-muted fs-8 fw-600 mt-1"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                                                <?php endif; ?>
                                            </h6>

                                            <!-- options -->
                                            <ul
                                                class="option-wrap d-flex align-items-center d-grid gap-4 product_icon2 mt-2">
                                                <?php if(@helper::checkaddons('customer_login')): ?>
                                                    <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                        <li tooltip="Wishlist" class="rounded-circle">
                                                            <a onclick="managefavorite('<?php echo e($getproductdata->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                class="option-btn circle-round wishlist-btn">
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
                                                    <a class="option-btn circle-round wishlist-btn"
                                                        onclick="productview('<?php echo e($getproductdata->id); ?>')">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                    <li tooltip="Add To Cart" class="rounded-circle">
                                                        <?php if($getproductdata->has_variation == 1): ?>
                                                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>"
                                                                class="option-btn circle-round addtocart-btn wishlist-btn">
                                                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <a class="option-btn circle-round addtocart-btn wishlist-btn"
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
            </section>
        <?php endif; ?>

        <!---------------------------------------------------- testimonial start ---------------------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial">
                    <div class="container">

                        <div class="text-uppercase text-center mb-4">

                            <h4 class="fw-semibold fs-4 specks-title text-dark"><?php echo e(trans('labels.testimonial_subtitle')); ?>

                            </h4>

                            <span
                                class="fs-6 text-muted fw-normal specks-subtitle"><?php echo e(trans('labels.testimonials')); ?></span>

                        </div>

                        <div id="testimonial4" class="owl-carousel owl-theme">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item p-1">
                                    <div class="card p-4">
                                        <div class="review_images m-auto mb-3">
                                            <img src="<?php echo e(helper::image_path($testimonial->image)); ?>" alt="">
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="avatar-content">
                                                <div class="name-box text-center border-bottom">
                                                    <div
                                                        class="d-flex justify-content-center align-items-center w-100 pt-3 pb-1">
                                                        <p class="d-flex d-grid gap-1 align-items-center">
                                                            <span
                                                                class="px-1 fw-500 text-center text-truncate text-capitalize"><?php echo e($testimonial->name); ?></span>
                                                        </p>
                                                    </div>
                                                    <h5 class="text-primary fs-15 pb-3 text-truncate">
                                                        <?php echo e($testimonial->position); ?>

                                                    </h5>
                                                </div>
                                                <p class="text-muted fs-7 pt-3 mb-2">
                                                    <?php echo e($testimonial->description); ?>

                                                </p>
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <?php
                                                            $count = (int) $testimonial->star;
                                                        ?>
                                                        <p class="d-flex d-grid gap-1 align-items-center star_rating fs-7">
                                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                                <?php if($i < $count): ?>
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                <?php else: ?>
                                                                    <i class="fa-regular fa-star text-warning"></i>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                        </p>
                                                    </div>
                                                    <div class="fs-8">
                                                        <i class="fa-regular fa-clock text-muted"></i>
                                                        <span
                                                            class="px-1 text-muted fw-400"><?php echo e(helper::date_formate($testimonial->created_at, $testimonial->vendor_id)); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <!------------------------------------------- theme-4-offer-banner-3-section ------------------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-4-offer-banner-3 my-5">
                <div class="container-fluid">
                    <div class="theme-4-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
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

        <!----------------------------------------------------- DEALS START ----------------------------------------------------->
        <?php if(@helper::checkaddons('top_deals')): ?>
            <?php if(!empty(helper::top_deals($vendordata->id))): ?>
                <?php if(count($topdealsproducts) > 0): ?>
                    <section class="deals3 bg-primary-rgb py-5" id="topdeals">
                        <div class="container">
                            <div class="text-uppercase text-center mb-4">
                                <h3 class="fw-semibold fs-4 specks-title text-dark">
                                    <?php echo e(trans('labels.home_page_top_deals_subtitle')); ?></h3>
                                <p class="fs-6 text-muted fw-normal specks-subtitle">
                                    <?php echo e(trans('labels.home_page_top_deals_title')); ?></p>
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                    class="btn btn-fashion rounded-5 mt-3"><?php echo e(trans('labels.viewall')); ?>

                                    <i
                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i>
                                </a>
                            </div>

                            <div class="mx-auto mb-5">
                                <div class=" offer-counter d-flex justify-content-around" id="countdown">
                                </div>
                            </div>

                            <div id="top-deals4" class="owl-carousel owl-theme">
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
                                    <div class="item h-100 bg-white mx-sm-2">

                                        <div
                                            class="card border rounded-0 bg-transparent h-100 overflow-hidden pro-menu <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">

                                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">

                                                <div class="item-img position-relative">

                                                    <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                        alt="" class="rounded-4 img-1">

                                                    <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                        class="w-100 img-2" alt="">
                                                    <?php if($off > 0): ?>
                                                        <div
                                                            class="<?php echo e(session()->get('direction') == 2 ? 'sale-label-on' : 'sale-label-off'); ?>">
                                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                    <!-- options -->
                                                    <ul
                                                        class="option-wrap <?php echo e(session()->get('direction') == 2 ? 'ltr' : 'rtl'); ?>">
                                                        <?php if(@helper::checkaddons('customer_login')): ?>
                                                            <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                                <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right'); ?> rounded-circle"
                                                                    data-tooltip="Wishlist">
                                                                    <a onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                        class="option-btn circle-round wishlist-btn">
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
                                                        <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right'); ?>"
                                                            class="rounded-circle" data-tooltip="View">
                                                            <a class="option-btn circle-round wishlist-btn"
                                                                onclick="productview('<?php echo e($products->id); ?>')">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                            <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right'); ?>"
                                                                class="rounded-circle" data-tooltip="Add To Cart">
                                                                <?php if($products->has_variation == 1): ?>
                                                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                        class="option-btn circle-round addtocart-btn wishlist-btn">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                                                        onclick="calladdtocart('<?php echo e($products->id); ?>','<?php echo e($products->slug); ?>','<?php echo e($products->name); ?>','<?php echo e($products['product_image'] == null ? 'product.png' : $products['product_image']->image); ?>','<?php echo e($products->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <!-- options -->

                                                </div>
                                            </a>

                                            <div class="card-body pb-0">

                                                <p
                                                    class="item-title text-secondary fs-8 cursor-auto text-truncate text-capitalize">
                                                    <?php echo e(@$products['category_info']->name); ?></p>

                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                    <p class="m-0 text-dark product-name line-2">
                                                        <?php echo e($products->name); ?></p>
                                                </a>

                                            </div>

                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="text-dark fw-bold product-price text-truncate">

                                                        <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                        <?php if($original_price > $price): ?>
                                                            <del
                                                                class="text-muted fs-8 fw-600 d-block mt-1"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                        <?php endif; ?>
                                                    </h5>
                                                </div>

                                                <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                    <p class="fs-8"><i
                                                            class="text-warning fs-8 fa-solid fa-star px-1"></i><span
                                                            class="text-dark fw-500"><?php echo e(number_format($products->ratings_average, 1)); ?></span>
                                                    </p>
                                                <?php endif; ?>

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
        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="my-5">
                <div class="container bg-light rounded-0">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-dark"><?php echo e(@$appsection->title); ?></h3>
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


        <!------------------------------------------------ thetem-4-blog-section ------------------------------------------------>
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
                        <section class="theme-4-blog mb-5">
                            <div class="container">
                                <div
                                    class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-4">
                                    <div
                                        class="border-secondary-color border-5 text-uppercase <?php echo e(session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3'); ?>">

                                        <span
                                            class="fw-semibold fs-4 specks-title"><?php echo e(trans('labels.featured_blogs')); ?></span>

                                        <p class="fs-6 text-muted fw-normal specks-subtitle">
                                            <?php echo e(trans('labels.blog_title')); ?></p>

                                    </div>

                                    <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">

                                        <?php echo e(trans('labels.viewall')); ?><p
                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>">
                                        </p>

                                    </a>

                                </div>

                                <div class="theme-4-blogs-carousel owl-carousel owl-theme">
                                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '6', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card h-100 rounded-0">

                                            <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                class="products-img w-100 object-fit-cover" height="230"
                                                alt="blog-image">

                                            <div class="card-body">

                                                <h6 class="card-title product-line fw-600 "><a
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                                </h6>
                                                <div class="pt-1 line-2 fs-7">
                                                    <?php echo strip_tags(Str::limit($blog->description, 200)); ?>

                                                </div>


                                            </div>
                                            <div
                                                class="card-footer blog-footer border-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex fs-8">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <div
                                                        class="px-1 fs- <?php echo e(session()->get('direction') == 2 ? 'theme-4-blog-date' : 'blog-date'); ?>">
                                                        <?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?>

                                                    </div>
                                                </div>


                                                <a class="btn btn-sm btn-outline-primary fs-15 rounded-5 px-3 py-1"
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>">

                                                    <?php echo e(trans('labels.readmore')); ?><p
                                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>">
                                                    </p>

                                                </a>

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
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-4/index.blade.php ENDPATH**/ ?>
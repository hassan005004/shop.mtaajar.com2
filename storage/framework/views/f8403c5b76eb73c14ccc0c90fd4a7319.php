<?php $__env->startSection('contents'); ?>
    <!---------------------------------------------- theme-3-slider-main-section ---------------------------------------------->
    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-3-slider">
            <div class="owl-carousel theme3-main-slaider owl-theme bg-light">
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
                            <img src="<?php echo e($slider['image']); ?>" alt="home banner" class="w-100 object-fit-cover">
                            <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <h5
                                        class="text-white mb-md-2 mb-1 text-uppercase ls-3 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <?php echo e($slider['title']); ?></h5>
                                    <h2
                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle line-2 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <?php echo e($slider['sub_title']); ?></h2>
                                    <p
                                        class="text-white fs-18 mb-md-4 mb-2 line-3 home-description <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <?php echo e($slider['description']); ?></p>

                                </div>
                            </div>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slider['image']); ?>" alt="home banner" class="w-100 object-fit-cover">
                            <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <h5
                                        class="text-white mb-md-2 mb-1 text-uppercase ls-3 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <?php echo e($slider['title']); ?></h5>
                                    <h2
                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle line-2 <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <?php echo e($slider['sub_title']); ?></h2>
                                    <p
                                        class="text-white fs-18 mb-md-4 mb-2 line-3 home-description <?php echo e(session()->get('direction') == 2 ? 'text-end' : 'text-start'); ?>">
                                        <?php echo e($slider['description']); ?></p>
                                    <div class="d-flex ">
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
                                                            <a class="btn btn-fashion rounded-5" href="javascript:void(0)">
                                            <?php endif; ?><?php echo e($slider['link_text']); ?><i
                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2'); ?>"></i></a>
                                        <?php endif; ?>
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

        <!-------------------------------------------- theme-3-offer-banner-1-section ------------------------------------------>
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-3-offer-banner-1 my-5">
                <div class="container">
                    <div class="theme-3-offer-banner-1-carousel owl-carousel owl-theme">
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

        <!---------------------------------------------- theme-3-category-section ---------------------------------------------->
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-3-category my-5">

                <div class="container">

                    <div class="theme-3-title">

                        <h2 class="fw-bold"><?php echo e(trans('labels.choose_by_category')); ?></h2>

                        <p class="text-muted fw-500"><?php echo e(trans('labels.homepage_category_subtitle')); ?></p>

                    </div>

                    <div class="theme-3-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                <div class="item">

                                    <div class="category-img">

                                        <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                            class="w-100 rounded-circle h-100 object-fit-cover" alt="category-image">

                                    </div>

                                    <div class="category-content">

                                        <span
                                            class="py-2 d-block fs-15 fw-medium text-truncate"><?php echo e($categorydata['name']); ?></span>

                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                    <div class="text-center mt-4">

                        <a class="btn btn-sm btn-primary rounded-5 px-4 py-2"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>">

                            <?php echo e(trans('labels.viewall')); ?><i
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i>

                        </a>

                    </div>

                </div>

            </section>
        <?php endif; ?>

        <!---------------------------------------- theme-3-best-Selling-Products-section ---------------------------------------->

        <?php if(count($getbestsellingproducts) > 0): ?>
            <section class="theme-3-best-Selling-product my-5 card-img-2">
                <div class="container">
                    <div class="theme-3-title">
                        <h2 class="fw-bold"><?php echo e(trans('labels.best_selling_products')); ?></h2>
                        <p class="text-muted fw-500"><?php echo e(trans('labels.homepage_product_subtitle')); ?></p>
                    </div>

                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-md-4 g-3">
                        <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-3.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-center mt-4">

                        <a class="btn btn-sm btn-primary rounded-5 px-4 py-2"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">

                            <?php echo e(trans('labels.viewall')); ?><i
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i>

                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-------------------------------------------------- new top-bar-offer -------------------------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        <section class="who-we-are bg-light py-md-5 py-3 mb-md-5 mb-3">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-6 order-2 order-lg-0">
                        <span
                            class="wdt-heading-subtitle text-truncate mb-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                        <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?></h4>
                        <p class="wdt-heading-content-wrapper line-2">
                            <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?></p>
                        <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3">
                            <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex gap-2 align-items-md-center align-items-start mb-xl-4 mb-lg-2 mb-2">
                                    <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                        class="icon-lg bg-success bg-opacity-10 text-success rounded-circle" alt="">
                                    <div class="py-md-2 px-md-3 p-1">
                                        <h5 class="mb-1 fw-600 line-1"><?php echo e($item->title); ?></h5>
                                        <p class="mb-0 fs-7 line-2"><?php echo e($item->sub_title); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 mb-4">
                        <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                            class="w-100" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!--------------------------------------------- theme-3-new-product-section --------------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-3-new-product my-5">

                <div class="container">

                    <div class="theme-3-title">

                        <h2 class="fw-bold"><?php echo e(trans('labels.new_arrival_products')); ?></h2>

                        <p class="text-muted fw-500"><?php echo e(trans('labels.homepage_newarrivalprodect_title')); ?></p>

                    </div>

                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">

                        <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if ($getproductdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
                                    if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                        $price =
                                            $getproductdata->price - @helper::top_deals($vendordata->id)->offer_amount;
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
                                    $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                            ?>
                            <div class="col">
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">

                                    <div class="item h-100">
                                        <div
                                            class="card border-0 overflow-hidden pro-menu <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                            <div class="item-img position-relative">
                                                <img src="<?php echo e($getproductdata['product_image']->image_url); ?>"
                                                    alt="" class="img-1">

                                                <img src="<?php echo e($getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url); ?>"
                                                    class="w-100 img-2" alt="">

                                                <!-- options -->
                                                <ul
                                                    class="option-wrap <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left'); ?> rounded-circle mb-2"
                                                                data-tooltip="Wishlist">
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
                                                    <li data-tooltip="View"
                                                        class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left'); ?> rounded-circle mb-2">
                                                        <a class="option-btn circle-round wishlist-btn"
                                                            onclick="productview('<?php echo e($getproductdata->id); ?>')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left'); ?> rounded-circle mb-2"
                                                            data-tooltip="Add To Cart">
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

                                            <div class="card-body item-content px-0 pt-3 pb-0">

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="item-title text-secondary fs-8 text-truncate cursor-auto">
                                                        <?php echo e(@$getproductdata['category_info']->name); ?></p>
                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                            <p class="fs-8 d-flex">
                                                                <i class="text-warning fa-solid fa-star px-1"></i>
                                                                <span
                                                                    class="text-dark fs-8 fw-500"><?php echo e(number_format($getproductdata->ratings_average, 1)); ?></span>
                                                            </p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if($off > 0): ?>
                                                        <div
                                                            class="offer-3 cursor-auto <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                            <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug)); ?>">
                                                    <p class="item-brand fw-600 fs-7 line-2"><?php echo e($getproductdata->name); ?>

                                                    </p>
                                                </a>
                                                <h6
                                                    class="text-dark fw-semibold fs-7 product-price-size my-2 cursor-auto text-truncate">

                                                    <?php echo e(helper::currency_formate($price, $getproductdata->vendor_id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <del
                                                            class="text-muted fs-8 fw-500 d-block mt-1"><?php echo e(helper::currency_formate($original_price, $getproductdata->vendor_id)); ?></del>
                                                    <?php endif; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                    <div class="text-center mt-4">
                        <a class="btn btn-sm btn-primary rounded-5 px-4 py-2"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">

                            <?php echo e(trans('labels.viewall')); ?>

                            <i
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------- theme-3-offer-banner-2-section ------------------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-3-offer-banner-3">

                <div class="container">

                    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade rounded-5"
                        data-bs-ride="carousel">

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
                                    <img src="<?php echo e($banner['image']); ?>" class="d-block w-100 object-fil-cover rounded-5"
                                        alt="...">
                                    </a>
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

        <!-------------------------------------------------- TESTIMONIAL START -------------------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial mt-5">
                    <div class="container position-relative">
                        <div class="theme-3-title">
                            <h2 class="fw-bold"><?php echo e(trans('labels.testimonial_subtitle')); ?></h2>
                            <p class="text-muted fw-500"><?php echo e(trans('labels.testimonials')); ?></p>
                        </div>
                        <div id="testimonial3" class="owl-carousel owl-theme">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="card h-100 rounded-4 shadow border-0 text-center my-4 mx-lg-3 mx-2">
                                        <div class="card-body">
                                            <div class="client-profile">
                                                <img src="<?php echo e(helper::image_path($testimonial->image)); ?>"
                                                    class="w-100 client-img mb-3" alt="">
                                                <p class="client-name pb-3  text-capitalize fs-7 text-truncate">
                                                    <?php echo e($testimonial->name); ?> -
                                                    <span class="profession"> <?php echo e($testimonial->position); ?></span>
                                                </p>

                                            </div>
                                            <p class="fs-7 description mb-3">“ <?php echo e($testimonial->description); ?>”</p>
                                            <ul>
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
                </section>
            <?php endif; ?>
        <?php endif; ?>


        <!------------------------------------------- theme-3-offer-banner-3-section ------------------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-3-offer-banner-3 my-5">

                <div class="container-fluid">

                    <div class="theme-3-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
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

                                <img src="<?php echo e($banner['image']); ?>" alt="banner-3" class="object-fit-cover rounded-5">

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
                    <section class="deals3 bg-primary-rgb mb-5 card-img-2" id="topdeals">
                        <div class="container py-100">
                            <div class="row align-items-center">
                                <div class="col-xl-4 col-12 mb-xl-0 mb-3">
                                    <div class="mb-4 theme-3-title">
                                        <h3 class="fw-bold"><?php echo e(trans('labels.home_page_top_deals_subtitle')); ?></h3>
                                        <p class="text-muted fw-500"><?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                        </p>
                                    </div>
                                    <div id="countdown" class="my-md-5 my-3"></div>
                                    <div class="text-center">
                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                            class="btn btn-sm btn-primary rounded-5 px-4 py-2 mt-2"><?php echo e(trans('labels.viewall')); ?>

                                            <i
                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2'); ?>"></i></a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-12">
                                    <div id="top-deals3" class="owl-carousel owl-theme">
                                        <?php $__currentLoopData = $topdealsproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                                    $price =
                                                        $products->price -
                                                        @helper::top_deals($vendordata->id)->offer_amount;
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
                                                <div class="item bg-white mx-sm-2 rounded-4 h-100">
                                                    <div
                                                        class="card border rounded-4 bg-transparent h-100 overflow-hidden pro-menu <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">

                                                        <a
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">

                                                            <div class="item-img position-relative">

                                                                <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                                    alt="" class="rounded-4 img-1">

                                                                <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                                    class="w-100 img-2" alt="">


                                                                <!-- options -->
                                                                <ul
                                                                    class="option-wrap <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                                            <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left'); ?> rounded-circle"
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
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        <?php else: ?>
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <i class="fa-regular fa-heart"></i>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left'); ?> rounded-circle"
                                                                        data-tooltip="View">
                                                                        <a class="option-btn circle-round wishlist-btn"
                                                                            onclick="productview('<?php echo e($products->id); ?>')">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                                        <li class="<?php echo e(session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left'); ?> rounded-circle"
                                                                            data-tooltip="Add To Cart">
                                                                            <?php if($products->has_variation == 1): ?>
                                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                                    class="option-btn circle-round addtocart-btn wishlist-btn">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
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
                                                        </a>

                                                        <div class="card-body pb-0">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-1">
                                                                <p
                                                                    class="item-title text-secondary fs-7 cursor-auto text-truncate">
                                                                    <?php echo e(@$products['category_info']->name); ?></p>
                                                                <?php if(@helper::checkaddons('product_reviews')): ?>
                                                                    <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                                        <p class="fs-7">
                                                                            <i
                                                                                class="text-warning fa-solid fa-star px-1"></i>
                                                                            <span
                                                                                class="text-dark fs-7 fw-500"><?php echo e(number_format($products->ratings_average, 1)); ?></span>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if($off > 0): ?>
                                                                    <div
                                                                        class="offer-3 cursor-auto <?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">
                                                                        <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>

                                                            <a
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                                <p class="item-brand fw-600 line-2">
                                                                    <?php echo e($products->name); ?></p>
                                                            </a>
                                                        </div>

                                                        <div class="card-footer">
                                                            <h6
                                                                class="text-dark fw-semibold product-price-size py-2 cursor-auto text-truncate">

                                                                <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                                <?php if($original_price > $price): ?>
                                                                    <del
                                                                        class="text-muted fs-8 fw-normal mt-1"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                                <?php endif; ?>
                                                            </h6>
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
        <?php endif; ?>
        <!--------------------------------------------- app-downlode section start --------------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="mb-5">
                <div class="container bg-light rounded-5 shdaow">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div class="col-xl-5 col-lg-6 m-sm-0 p-0 d-none d-lg-block position-relative">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="<?php echo e(helper::image_path(@$appsection->image)); ?>"
                                    class="h-500px w-100 object-fit-cover " alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                            <!-- Title -->
                            <h3 class="fs-2 m-0 fw-bold text-dark line-2"><?php echo e(@$appsection->title); ?></h3>
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
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------------ thetem-2-blog-section ------------------------------------------------>
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
                    <section class="theme-3-blog mb-5">
                        <div class="container">
                            <div class="theme-3-title">
                                <h2 class="fw-bold"><?php echo e(trans('labels.featured_blogs')); ?></h2>
                                <p class="text-muted fw-500"><?php echo e(trans('labels.blog_title')); ?></p>
                            </div>
                            <div class="row g-4 g-xl-5 justify-content-between">
                                <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '5', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key == 0): ?>
                                        <div class="col-lg-6">
                                            <div class="theme-3-blog-item">
                                                <div class="card border-0 bg-transparent h-100">
                                                    <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                        class="card-img-top w-100 object-fit-cover rounded-4"
                                                        alt="blog-image">

                                                    <div class="card-body px-0">
                                                        <h6 class="card-title line-2 mb-1"> <a class="text-dark"
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                                        </h6>
                                                        <div class="line-2 fs-7">
                                                            <?php echo strip_tags(Str::limit($blog->description, 200)); ?>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card-footer px-0 blog-footer d-flex justify-content-between align-items-center py-4">
                                                        <div class="text-primary fs-8"><i
                                                                class="fa-solid fa-calendar-days"></i><span
                                                                class="px-1 fw-500 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                        </div>
                                                        <a class="fw-semibold fs-15 text-primary-color fw-500"
                                                            href="{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"><?php echo e(trans('labels.readmore')); ?>

                                                            <span class="mx-1">
                                                                <i
                                                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long'); ?>"></i>
                                                            </span>
                                                        </a>
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
                                                                class="card-img-top w-100 object-fit-cover rounded-4"
                                                                alt="blog-image">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h6 class="fw-600 mb-1 line-2"><a
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                                class="text-dark"><?php echo e($blog->title); ?></a></h6>
                                                        <div class="line-2 fs-7"><?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mt-2">
                                                            <div class="text-primary fs-8"><i
                                                                    class="fa-solid fa-calendar-days"></i><span
                                                                    class="px-1 fw-500 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                            </div>
                                                            <a class="fw-semibold fs-15 text-primary-color"
                                                                href="{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"><?php echo e(trans('labels.readmore')); ?><span
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
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-3/index.blade.php ENDPATH**/ ?>
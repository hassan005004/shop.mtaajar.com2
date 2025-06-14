<?php $__env->startSection('contents'); ?>
    <!---------------------------------- theme-11-slider-main-section ---------------------------------->
    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-11-slider">
            <div
                class="theme-11-main-banner slider-layer slider-bots text-animation owl-carousel owl-theme <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
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
                                class="w-100 object-fit-cover img-fluid theme-11-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-end mb-5 flex-column">
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-12 text-center">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-1">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-2">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-3 home-description animation-3">
                                            <?php echo e($slider['description']); ?>

                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slider['image']); ?>"
                                class="w-100 object-fit-cover img-fluid theme-11-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-end mb-5 flex-column">
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-12 text-center">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-1">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-2">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-3 home-description animation-3">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                                <?php if($slider['type'] == 1): ?>
                                                    <a class="btn btn-primary rounded-3"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                    <?php elseif($slider['type'] == 2): ?>
                                                        <a class="btn btn-primary rounded-3"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                        <?php elseif($slider['type'] == 3): ?>
                                                            <a class="btn btn-primary rounded-3"
                                                                href="<?php echo e($slider['custom_link']); ?>" target="_blank">
                                                            <?php else: ?>
                                                                <a class="btn btn-primary rounded-3"
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
    <main class="theme-11 bg-primary-rgb-main">
        <!---------------------------------- theme-11-category-section ---------------------------------->
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-11-category py-sm-5 py-4">
                <div class="container">
                    <div class="mb-md-5 mb-4 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="title-line"></div>
                            <p class="fs-6 text-uppercase text-muted fw-normal specks-subtitle mx-2">
                                <?php echo e(trans('labels.homepage_category_subtitle')); ?>

                            </p>
                            <div class="title-line"></div>
                        </div>
                        <span
                            class="fw-semibold wdt-heading-title text-dark text-truncate"><?php echo e(trans('labels.choose_by_category')); ?></span>
                    </div>
                    <div class="theme-11-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="theme-11-item">
                                <div class="card h-100 shadow-none outline-none rounded-3 overflow-hidden border-0">
                                    <div class="cat-img">
                                        <a
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                            <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                class="w-100 object-fit-cover" alt="category image"></a>
                                    </div>
                                    <div class="card-body text-center p-sm-2 p-1">
                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                            class="card-title text-dark fs-15 choose-by-category-name"><?php echo e($categorydata['name']); ?></a
                                            href="#">
                                        <p class="fs-13"><?php echo e(helper::product_count($categorydata->id)); ?>

                                            <?php echo e(trans('labels.items')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>"> <?php echo e(trans('labels.viewall')); ?><span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------- WHO WE ARE ---------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-primary-rgb py-md-5 py-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <div class="d-flex align-items-center mb-2">
                                <div class="title-line"></div>
                                <span
                                    class="fs-6 text-truncate m-0 px-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                                <div class="title-line"></div>
                            </div>
                            <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?>

                            </p>
                            <div class="row g-sm-3 g-2">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6">
                                        <div class="card border-secondary-color">
                                            <div class="card-body">
                                                <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                                    class="icon-lg bg-opacity-10 text-success rounded-circle border border-2 border-primary-color"
                                                    alt="">
                                                <div class="pt-2">
                                                    <h5 class="mb-1 fw-600 text-truncate"><?php echo e($item->title); ?></h5>
                                                    <p class="mb-0 fs-7 line-2"><?php echo e($item->sub_title); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                class="w-100 object-fit-cover rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------- theme-11-offer-banner-1-section ---------------------------------->
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-11-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="offer-banner-1-carousel owl-carousel owl-theme">
                        <?php $__currentLoopData = $getbannerslist['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="rounded-3 ">
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
                                        class="w-100 h-100 rounded-3 object-fit-cover">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!---------------------------------- new top-bar-offer ---------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <div class="overflow-hidden offers-theme-11">
                <div class="offer-badge-11 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                    <?php echo e(trans('labels.best_offers')); ?>

                </div>
                <div class="text-secondary ">
                    <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
        <!---------------------------------- theme-11-best-Selling-Products-section ---------------------------------->
        <section class="theme-11-best-Selling-product my-md-5 my-4">
            <div class="container">
                <div class="text-center mb-md-5 mb-4">
                    <div class="d-flex align-items-center mb-2 justify-content-center">
                        <div class="title-line"></div>
                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                            <?php echo e(trans('labels.homepage_product_subtitle')); ?>

                        </p>
                        <div class="title-line"></div>
                    </div>
                    <span class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.best_selling_product')); ?></span>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                    <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.theme-11.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="d-flex justify-content-center mt-md-5 mt-4">
                    <div class="rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                        <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">
                            <?php echo e(trans('labels.viewall')); ?><span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!----------------------------------- theme-11-offer-banner-2-section ----------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-11-offer-banner-3 py-5">
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
                                    <img src="<?php echo e($banner['image']); ?>" class="d-block w-100 object-fit-cover rounded-3"
                                        alt="..."></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($getbannerslist['bannersection2']) > 1): ?>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left slider-arrows rounded-3"></i></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.previous')); ?></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows rounded-3"></i></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.next')); ?></span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!----------------------------------------- theme-11-new-product-section ----------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-11-new-product">
                <div class="container">
                    <div class="text-center mb-md-5 mb-4">
                        <div class="d-flex align-items-center mb-2 justify-content-center">
                            <div class="title-line"></div>
                            <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                <?php echo e(trans('labels.new_arrival_product_subtitle')); ?>

                            </p>
                            <div class="title-line"></div>
                        </div>
                        <span class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.new_arrival_products')); ?></span>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                        <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-11.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                            <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                                <?php echo e(trans('labels.viewall')); ?><span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!----------------------------------- theme-11-offer-banner-3-section ----------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-11-offer-banner my-md-5 my-4">
                <div class="container-fluid">
                    <div class="offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $getbannerslist['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="rounded-3">
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
        <!---------------------------------------- DEALS START ---------------------------------------->
        <?php if(@helper::checkaddons('top_deals')): ?>
            <?php if(!empty(helper::top_deals($vendordata->id))): ?>
                <?php if(count($topdealsproducts) > 0): ?>
                    <section class="theme-11-deals bg-primary-rgb py-sm-5 py-4 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="mb-md-5 mb-4 theme-3-title text-center">
                                <div class="d-flex align-items-center mb-2 justify-content-center">
                                    <div class="title-line"></div>
                                    <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                        <?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                    </p>
                                    <div class="title-line"></div>
                                </div>
                                <span
                                    class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.home_page_top_deals_subtitle')); ?></span>
                            </div>
                            <div class="row">
                                <div class="card col-auto mx-auto mb-md-5 mb-4 p-0 rounded-3 margin-sm p-1">
                                    <div id="countdown" class="countdown-border"> </div>
                                </div>
                            </div>
                            <div id="top-deals11" class="owl-carousel owl-theme carousel-items-2">
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
                                    <div class="item h-100 bg-white rounded-3 mx-1">
                                        <div
                                            class="card product-card-side p-0 h-100 border border-secondary-color bg-white rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                            <div class="deal-11 h-100 position-relative">
                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                    <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                        class="object-fit-cover img-1 rounded-2" alt="">
                                                    <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                        class="w-100 img-2 rounded-2" alt="">
                                                </a>
                                                <?php if($off > 0): ?>
                                                    <div
                                                        class="off-label-11 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                                        <div class="position-relative">
                                                            <div
                                                                class="sale-label-11 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                                                <?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body content-box w-100 p-lg-3 p-2">
                                                <div
                                                    class="d-sm-flex align-items-center justify-content-between mb-md-2 mb-1">
                                                    <p class="card-title fs-8 text-lightslategray m-0 text-truncate">
                                                        <?php echo e(@$products['category_info']->name); ?>

                                                    </p>
                                                    <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                        <p class="fs-8 d-flex">
                                                            <i
                                                                class="text-warning fs-8 fa-solid fa-star <?php echo e(session()->get('direction') == 2 ? 'ps-1' : 'pe-1'); ?>"></i>
                                                            <span
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
                                                <h6 class="product-price text-dark d-inline-block m-0 text-truncate">
                                                    <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <del
                                                            class="
                                                                fs-8 fw-normal text-lightslategray"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                    <?php endif; ?>
                                                </h6>
                                                <!-- options -->
                                                <ul
                                                    class="option-wrap d-flex align-items-center d-grid gap-3 product_icon2 mt-2">
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li tooltip="Wishlist" class="rounded-3 shadow-lg">
                                                                <a onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                    class="option-btn circle-round rounded-3 wishlist-btn">
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
                                                    <li tooltip="<?php echo e(trans('labels.view')); ?>" class="rounded-3 shadow-lg">
                                                        <a class="option-btn circle-round rounded-3 wishlist-btn"
                                                            onclick="productview('<?php echo e($products->id); ?>')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li tooltip="<?php echo e(trans('labels.add_to_cart')); ?>"
                                                            class="rounded-3 shadow-lg">
                                                            <?php if($products->has_variation == 1): ?>
                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                    class="option-btn circle-round rounded-3 addtocart-btn wishlist-btn">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="option-btn circle-round rounded-3 addtocart-btn wishlist-btn"
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
                                <div class="rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                        class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"><?php echo e(trans('labels.viewall')); ?>

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
        <!--------------------------------------- TESTIMONIAL START --------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial my-sm-5 my-4">
                    <div class="container position-relative py-3">
                        <div class="d-flex align-items-center mb-2 justify-content-center">
                            <div class="title-line"></div>
                            <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                <?php echo e(trans('labels.testimonials')); ?></p>
                            <div class="title-line"></div>
                        </div>
                        <span
                            class="text-dark wdt-heading-title line-1 text-center text-truncate mb-sm-5 mb-4"><?php echo e(trans('labels.testimonial_subtitle')); ?>

                        </span>
                        <!-- testimonial slider start -->
                        <div id="testimonial11" class="owl-carousel owl-theme carousel-items-3">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100">
                                    <div class="rounded-4 h-100 p-1">
                                        <div class="d-flex justify-content-center mb-3 rounded-3 h-100">
                                            <div class="client-profile align-items-center">
                                                <div class="border border-primary-color px-3 py-4 rounded-3">
                                                    <p class="fs-7 description mb-2">“<?php echo e($testimonial->description); ?>”
                                                    </p>
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
                                                <div class="d-flex align-items-center mx-4 mt-3">
                                                    <img src="<?php echo e(helper::image_path($testimonial->image)); ?>"
                                                        class="w-100 theme-11-client-img rounded-circle" alt="">
                                                    <div class="mx-3">
                                                        <p class="client-name"> <?php echo e($testimonial->name); ?> <span
                                                                class="profession fs-7 d-block">
                                                                <?php echo e($testimonial->position); ?></span></p>

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

        <!---------------------------------------- app download end ---------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="py-md-5 py-3">
                <div class="container rounded-0">
                    <div
                        class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5 bg-border bg-primary-rgb border-primary-color rounded-3">
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="<?php echo e(helper::image_path(@$appsection->image)); ?>"
                                    class="h-500px object-fit-cover w-100" alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center <?php echo e(session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start'); ?>">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-dark"><?php echo e(@$appsection->title); ?></h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-lightslategray line-2"><?php echo e(@$appsection->subtitle); ?></p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <div class="rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(@$appsection->android_link); ?>"> <img
                                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg')); ?>"
                                            class="g-play rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                            alt=""> </a>
                                </div>
                                <!-- App store button -->
                                <div class="rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(@$appsection->ios_link); ?>"> <img
                                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg')); ?>"
                                            class="g-play rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                            alt=""> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!--------------------------------------------------- theme-11-blog-section --------------------------------------------------->
        <?php if(@helper::checkaddons('customer_login')): ?>
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
                        <section class="theme-11-blog py-md-5 py-4">
                            <div class="container">
                                <div class="text-center mb-md-5 mb-4">
                                    <div class="d-flex align-items-center mb-2 justify-content-center">
                                        <div class="title-line"></div>
                                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                            <?php echo e(trans('labels.blog_title')); ?>

                                        </p>
                                        <div class="title-line"></div>
                                    </div>
                                    <span
                                        class="text-dark wdt-heading-title line-1"><?php echo e(trans('labels.featured_blogs')); ?></span>
                                </div>
                                <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '5', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key == 0): ?>
                                        <div class="row g-xl-3 g-2 justify-content-between">
                                        <?php else: ?>
                                            <div class="col-sm-6">
                                                <div class="card border border-primary-color p-2 bg-primary-rgb rounded-3">
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-lg-4 col-5">
                                                            <div class="img-overlay rounded-4">
                                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                                    class="card-img-top w-100 object-fit-cover rounded-3 blog-height-11"
                                                                    alt="blog-image">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-7 p-2">
                                                            <h6 class="fw-bold mb-1 line-2"><a
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                                    class="text-dark"><?php echo e($blog->title); ?></a></h6>
                                                            <div class="pt-1 fs-7 line-2"><?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                                            <div class="d-flex flex-wrap justify-content-between mt-3">
                                                                <div class="text-dark fs-7"><i
                                                                        class="fa-solid fa-calendar-days"></i><span
                                                                        class="px-1 fw-500 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                                </div>
                                                                <a class="fw-semibold text-secondary fs-15 d-flex align-items-center"
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e(trans('labels.readmore')); ?><span
                                                                        class="mx-1"><i
                                                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long'); ?>"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="d-flex justify-content-center mt-md-5 mt-4">
                                <div class="rounded-3 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-11/index.blade.php ENDPATH**/ ?>
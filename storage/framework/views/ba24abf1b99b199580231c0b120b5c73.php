<?php $__env->startSection('contents'); ?>

    <!---------------------------------- theme-14-slider-main-section ---------------------------------->
    <?php if(count($getsliderlist) > 0): ?>
        <section class=" my-5">
            <div class="container">
                <div class="theme-19-main-banner slider-bots text-animation owl-carousel owl-theme rounded-3">
                    <?php $__currentLoopData = $getsliderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item h-100 px-1">
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
                                <img src="<?php echo e($slider['image']); ?>" class="w-100 object-fit-cover rounded-3" alt="">
                                <div class="carousel-caption px-1 py-sm-4 py-3 d-flex flex-column justify-content-center">
                                    <div class="col-xl-12 theme-19-line bg-secondary p-3 p-sm-4 p-md-5">
                                        <h6 class="text-white mb-md-2 line-2 mb-1 text-uppercase ls-3 animation-down">
                                            <?php echo e($slider['title']); ?>

                                        </h6>
                                        <h2 class="text-white fw-bold line-3 mb-md-3 mb-1 home-subtitle animation-down">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 line-2 mb-3 home-description animation-fade">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                    </div>
                                </div>
                                </a>
                            <?php else: ?>
                                <img src="<?php echo e($slider['image']); ?>" class="w-100 object-fit-cover rounded-3" alt="">
                                <div class="carousel-caption px-1 py-sm-4 py-3 d-flex flex-column justify-content-center">
                                    <div class="col-xl-12 theme-19-line bg-secondary p-3 p-sm-4 p-md-5">
                                        <h6 class="mb-md-2 mb-1 line-2 text-uppercase ls-3 animation-down">
                                            <?php echo e($slider['title']); ?>

                                        </h6>
                                        <h2 class="text-white fw-bold line-3 mb-md-3 mb-1 home-subtitle animation-down">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="fs-6 mb-3 line-2 home-description animation-fade">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                        <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                            <?php if($slider['type'] == 1): ?>
                                                <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                <?php elseif($slider['type'] == 2): ?>
                                                    <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                    <?php elseif($slider['type'] == 3): ?>
                                                        <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                            href="<?php echo e($slider['custom_link']); ?>" target="_blank">
                                                        <?php else: ?>
                                                            <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                                href="javascript:void(0)">
                                            <?php endif; ?>
                                            <?php echo e($slider['link_text']); ?>

                                            <i
                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <main>

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
                                    class="w-100 h-100 rounded-3 object-fit-cover">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-secondary-rgb py-5 my-5">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <div class="img-whow">
                                <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                    class="w-100 h-100 object-fit-cover rounded-3" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <h4 class="wdt-heading-title line-2"> <?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?></p>
                            <div class="row g-3">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 who-we-19">
                                        <div
                                            class="serviceBox rounded-3 bg-white p-3 d-flex flex-column justify-content-center align-items-center">
                                            <div class="service-icon my-4 d-flex justify-content-center align-items-center">
                                                <img src="<?php echo e(helper::image_path($item->image)); ?>" class="rounded-circle">
                                            </div>
                                            <div class="border-bottom pb-2 mb-2">
                                                <h6 class="fw-600 text-white line-1">
                                                    <?php echo e($item->title); ?>

                                                </h6>
                                            </div>
                                            <p class="description text-white line-2"><?php echo e($item->sub_title); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------------- theme-4-category-section ---------------------------------------------->
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-4-category mb-5">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class="text-capitalize">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <h2 class="fw-600 fs-4 line-1">
                                <?php echo e(trans('labels.top_categories')); ?>

                            </h2>
                            <p class="fs-6 mt-2 text-muted fw-normal line-1">
                                <?php echo e(trans('labels.homepage_category_subtitle')); ?>

                            </p>
                        </div>
                    </div>
                    <div class="theme-19-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100 px-1">
                                <div class="serviceBox <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?> rounded-3">
                                    <div class="service-icon">
                                        <img src="<?php echo e(helper::image_path($categorydata->image)); ?>" alt=""
                                            class="w-100">
                                    </div>
                                    <a
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                        <h3 class="fw-500 text-dark fs-15 px-1 line-2 text-capitalize">
                                            <?php echo e($categorydata['name']); ?>

                                        </h3>
                                    </a>
                                    <p class="description fs-8 fw-500 text-muted">
                                        <?php echo e(helper::product_count($categorydata->id)); ?>

                                        <?php echo e(trans('labels.items')); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"
                        href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>">
                        <?php echo e(trans('labels.viewall')); ?>

                        <i
                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2'); ?>">
                        </i>
                    </a>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------------- new top-bar-offer ------------------------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!------------------------------------------------- best Selling product ------------------------------------------------->
        <?php if(count($getbestsellingproducts) > 0): ?>
            <section class="theme-4-best-Selling-product pro-hover my-5">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class="text-capitalize">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <span class="fw-600 fs-4 line-1"><?php echo e(trans('labels.best_selling_product')); ?></span>
                            <p class="fs-6 mt-2 text-muted fw-normal line-1">
                                <?php echo e(trans('labels.homepage_product_subtitle')); ?>

                            </p>
                        </div>
                    </div>
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item p-1 theme-19 h-100">
                                <?php echo $__env->make('web.theme-19.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"
                        href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">
                        <?php echo e(trans('labels.viewall')); ?>

                        <p
                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2'); ?>">
                        </p>
                    </a>
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
                                    <img src="<?php echo e($banner['image']); ?>" class="d-block w-100 object-fit-cover rounded-3"
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

        <!---------------------------------------- theme-4-new-product-section ---------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-4-best-Selling-product mb-5">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class="text-capitalize">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <span class="fw-600 fs-4 line-1">
                                <?php echo e(trans('labels.new_arrival_products')); ?>

                            </span>
                            <p class="fs-6 text-muted fw-normal mt-2 line-1">
                                <?php echo e(trans('labels.new_arrival_product_subtitle')); ?>

                            </p>
                        </div>
                    </div>
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item p-1 theme-19 h-100">
                                <?php echo $__env->make('web.theme-19.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"
                        href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                        <?php echo e(trans('labels.viewall')); ?> <i
                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2'); ?>">
                        </i>
                    </a>
                </div>
            </section>
        <?php endif; ?>

        <!---------------------------------------------------- testimonial start ---------------------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial my-5 py-5 bg-primary-rgb">
                    <div class="container">
                        <div class=" text-capitalize mb-5">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <h4 class="fw-semibold fs-4 line-1 text-dark">
                                <?php echo e(trans('labels.testimonial_subtitle')); ?>

                            </h4>
                            <span class="fs-6 text-muted fw-normal mt-2 line-1">
                                <?php echo e(trans('labels.testimonials')); ?>

                            </span>
                        </div>
                        <div id="testimonial-slider-19" class="owl-carousel owl-theme">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100 p-1">
                                    <div class="card rounded-3 p-2">
                                        <div class="card-body p-2 border-primary border">
                                            <img src="<?php echo e(helper::image_path($testimonial->image)); ?>" class="mx-auto">
                                            <p class="description my-2 fs-7 text-muted text-center">
                                                “<?php echo e($testimonial->description); ?>”
                                            </p>
                                            <ul
                                                class="rating fs-8 mb-2 d-flex gap-1 align-items-center justify-content-center">
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
                                            <h6 class="mb-0 text-center fw-600 text-capitalize text-primary">
                                                <?php echo e($testimonial->name); ?>

                                            </h6>
                                            <p class="fs-7 text-center text-muted m-0 mt-1 text-capitalize">
                                                <?php echo e($testimonial->position); ?>

                                            </p>

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
                                <img src="<?php echo e($banner['image']); ?>" alt="banner-3" class="object-fit-cover rounded-3">
                                </a>
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
                    <section class="theme-4-best-Selling-product bg-primary-rgb py-5 my-5" id="topdeals">
                        <div class="container">
                            <div
                                class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                                <div class="text-capitalize">
                                    <div class="d-flex gap-3 align-items-center mb-1">
                                        <div class="heading-line m-0"></div>
                                        <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                        <div class="heading-line m-0"></div>
                                    </div>
                                    <span class="fw-600 fs-4 line-1">
                                        <?php echo e(trans('labels.home_page_top_deals_subtitle')); ?>

                                    </span>
                                    <p class="fs-6 text-muted mt-2 fw-normal line-1">
                                        <?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                    </p>
                                </div>
                                <div id="countdown"> </div>
                            </div>
                            <div class="theme-19-product-slider owl-carousel owl-theme">
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
                                    <div class="item h-100 p-1 theme-19">
                                        <div class="card h-100 product-grid rounded-3 overflow-hidden">
                                            <div class="product-image">
                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                    class="image">
                                                    <img class="pic-1"
                                                        src="<?php echo e($products['product_image']->image_url); ?>">
                                                    <img class="pic-2"
                                                        src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>">
                                                </a>
                                                <?php if($off > 0): ?>
                                                    <span class="theme-19-ribbon">
                                                        <h3><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></h3>
                                                    </span>
                                                <?php endif; ?>
                                                <ul class="product-links text-center">
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li class="fs-7">
                                                            <?php if($products->has_variation == 1): ?>
                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                    class="fs-7 fw-500">
                                                                    <?php echo e(trans('labels.addtocart')); ?>

                                                                </a>
                                                            <?php else: ?>
                                                                <a class="fs-7 fw-500"
                                                                    onclick="calladdtocart('<?php echo e($products->id); ?>','<?php echo e($products->slug); ?>','<?php echo e($products->name); ?>','<?php echo e($products['product_image'] == null ? 'product.png' : $products['product_image']->image); ?>','<?php echo e($products->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                                    <?php echo e(trans('labels.addtocart')); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li class="cursor-pointer">
                                                                <a onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                    data-tip="Wishlist">
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
                                                    <li class="cursor-pointer">
                                                        <a onclick="productview('<?php echo e($products->id); ?>')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body border-top">
                                                <div class="d-flex align-items-center gap-1 mb-2 justify-content-between">
                                                    <span class="fs-7 fw-500 text-muted m-0 line-1">
                                                        <?php echo e(@$getproductdata['category_info']->name); ?>

                                                    </span>
                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                            <p class="fs-8 d-flex align-items-center">
                                                                <i class="text-warning fs-8 fa-solid fa-star"></i>
                                                                <span class="text-dark fw-500 fs-8">
                                                                    <?php echo e(number_format($products->ratings_average, 1)); ?>

                                                                </span>
                                                            </p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                    class="text-dark">
                                                    <h3 class="fs-15 text-capitalize fw-600 line-2 m-0 border-bottom-0">
                                                        <?php echo e($products->name); ?>

                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="card-footer pt-0 pb-3">
                                                <h5
                                                    class="fs-7 text-secondary m-0 fw-bold product-price align-items-center gap-1 d-flex flex-wrap w-100 text-truncate">
                                                    <?php echo e(helper::currency_formate($price, $vendordata->id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <?php if($original_price > 0): ?>
                                                            <del class="text-muted fs-8 fw-600 d-block">
                                                                <?php echo e(helper::currency_formate($original_price, $vendordata->id)); ?>

                                                            </del>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"><?php echo e(trans('labels.viewall')); ?>

                                <i
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>">
                                </i>
                            </a>

                        </div>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
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
                        <section class="theme-4-blog my-5">
                            <div class="container">
                                <div
                                    class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-4">
                                    <div class="text-capitalize">
                                        <div class="d-flex gap-3 align-items-center mb-1">
                                            <div class="heading-line m-0"></div>
                                            <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                            <div class="heading-line m-0"></div>
                                        </div>
                                        <span class="fw-600 fs-4 line-1">
                                            <?php echo e(trans('labels.featured_blogs')); ?>

                                        </span>
                                        <p class="fs-6 text-muted mt-2 fw-normal line-1">
                                            <?php echo e(trans('labels.blog_title')); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="theme-18-blogs-carousel owl-carousel owl-theme">
                                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '6', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item p-1 h-100">
                                            <div class="card h-100 rounded-3">
                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                    class="products-img w-100 object-fit-cover p-3 pb-0" height="230"
                                                    alt="blog-image">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center product-line fw-600 ">
                                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                            class="text-dark">
                                                            <?php echo e($blog->title); ?>

                                                        </a>
                                                    </h6>
                                                    <div class="pt-1 text-center line-2 fs-7">
                                                        <?php echo strip_tags(Str::limit($blog->description, 200)); ?>

                                                    </div>
                                                </div>
                                                <div
                                                    class="card-footer pb-3 blog-footer d-flex justify-content-between align-items-center">
                                                    <div class="d-flex fs-8">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <div
                                                            class="px-1 fs- <?php echo e(session()->get('direction') == 2 ? 'theme-4-blog-date' : 'blog-date'); ?>">
                                                            <?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?>

                                                        </div>
                                                    </div>
                                                    <a class="text-primary fw-600 border-bottom border-primary fs-15 "
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>">
                                                        <?php echo e(trans('labels.readmore')); ?>

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <a class="btn btn-sm btn-primary rounded-5 mt-4 px-3 py-2 category-button"
                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">
                                    <?php echo e(trans('labels.viewall')); ?><p
                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>">
                                    </p>
                                </a>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="my-5">
                <div class="container bg-secondary-rgb rounded-3">
                    <div class="row align-items-center justify-content-lg-between justify-content-center p-5">
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

    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-19/index.blade.php ENDPATH**/ ?>
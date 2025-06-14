<?php $__env->startSection('contents'); ?>
    <!------------------------------------------------ theme-5-slider-main-section ------------------------------------------------>
    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-8-slider">
            <div class="theme-8-main-banner-17 slider-bots text-animation owl-carousel owl-theme">
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
                                <div class="row justify-content-center">
                                    <div
                                        class="col-xl-7 col-lg-9 col-12 bg-primary shadow-lg p-3 p-md-4 p-lg-5 text-center">
                                        <h5 class="text-secondary fw-500 mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <div class="d-flex justify-content-center align-items-center my-1 animation-down">
                                            <div class="heading-line"></div>
                                            <i class="fa-solid fa-feather-pointed fs-3 text-white text-shadow"></i>
                                            <div class="heading-line"></div>
                                        </div>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-2 line-2 home-description animation-up">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slider['image']); ?>" class="w-100 h-100 object-fit-cover img-fluid" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center">
                                    <div
                                        class="col-xl-7 col-lg-9 col-12 shadow-lg bg-primary p-3 p-md-4 p-lg-5 text-center">
                                        <h5 class="text-secondary fw-500 mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <div class="d-flex justify-content-center align-items-center my-1 animation-down">
                                            <div class="heading-line"></div>
                                            <i class="fa-solid fa-feather-pointed fs-3 text-white text-shadow"></i>
                                            <div class="heading-line"></div>
                                        </div>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                            <?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 line-2 mb-2 home-description animation-up">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                        <div class="d-flex justify-content-center animation-up">
                                            <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                                <?php if($slider['type'] == 1): ?>
                                                    <a class="btn btn-fashion rounded-3"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                    <?php elseif($slider['type'] == 2): ?>
                                                        <a class="btn btn-fashion rounded-3"
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                        <?php elseif($slider['type'] == 3): ?>
                                                            <a class="btn btn-fashion rounded-3"
                                                                href="<?php echo e($slider['custom_link']); ?>" target="_blank">
                                                            <?php else: ?>
                                                                <a class="btn btn-fashion rounded-3"
                                                                    href="javascript:void(0)">
                                                <?php endif; ?><?php echo e($slider['link_text']); ?> <i
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2'); ?>"></i></a>
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
        <!---------------------------------------------- theme-5-offer-banner-1-section -------------------------------------------->
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-5-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="theme-5-offer-banner-1-carousel owl-carousel owl-theme">
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
        <!---------------------------------------------- WHO WE ARE ------------------------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are bg-secondary-rgb py-5 mb-md-5 mb-4">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 ">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                            <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <div class="d-flex  align-items-center my-1">
                                <div class="heading-line"></div>
                                <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                                <div class="heading-line"></div>
                            </div>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?>

                            </p>
                            <div class="row g-3">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 theme-17">
                                        <div class="card rounded-0 shadow border-0 p-3">
                                            <div class="serviceBox <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                                <div
                                                    class="service-icon <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                                    <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                                        class="rounded-circle">
                                                </div>
                                                <div
                                                    class="service-content <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                                    <h6 class="fw-600 mb-2 line-1"><?php echo e($item->title); ?></h6>
                                                    <p class="description line-2">
                                                        <?php echo e($item->sub_title); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                class="w-100 h-100 object-fit-cover" alt="">
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!------------------------------------------------ theme-17-category-section ------------------------------------------------>
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-5-category">
                <div class="container">
                    <div class="text-center text-uppercase mb-md-5 mb-4">
                        <span class="fw-600 fs-4 category-title text-dark text-truncate">
                            <?php echo e(trans('labels.choose_by_category')); ?>

                        </span>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <p class="fs-6 text-muted fw-normal specks-subtitle mb-2">
                            <?php echo e(trans('labels.homepage_category_subtitle')); ?>

                        </p>
                    </div>
                    <div class="theme-17-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item h-100">
                                <div class="card bg-primary-rgb rounded-0 text-center border-0 h-100">
                                    <div class="card-body">
                                        <div class="theme-17-cat">
                                            <img src="<?php echo e(helper::image_path($categorydata->image)); ?>" alt=""
                                                class="mx-auto">
                                        </div>
                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                            class="fw-600 fs-7 line-2  my-2 text-capitalize text-secondary"><?php echo e($categorydata['name']); ?></a>
                                        <p class="description fs-13 m-0 fw-500">
                                            <?php echo e(helper::product_count($categorydata->id)); ?>

                                            <?php echo e(trans('labels.items')); ?></p>
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
        <!---------------------------------------------------- new top-bar-offer ---------------------------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!------------------------------------------ theme-17-best-Selling-Products-section ------------------------------------------>
        <?php if(count($getbestsellingproducts) > 0): ?>
            <section class="theme-5-best-Selling-product my-md-5 my-4">
                <div class="container">
                    <div class="text-center text-uppercase mb-md-5 mb-4">
                        <span class="fw-600 text-dark fs-4 category-title text-truncate">
                            <?php echo e(trans('labels.best_selling_product')); ?>

                        </span>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <p class="fs-6 text-muted fw-normal specks-subtitle mb-2 text-truncate">
                            <?php echo e(trans('labels.homepage_product_subtitle')); ?>

                        </p>

                    </div>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                        <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-17.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">
                            <?php echo e(trans('labels.viewall')); ?><span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!---------------------------------------------- theme-17-offer-banner-2-section ---------------------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-5-offer-banner-3 py-5">
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
        <!------------------------------------------------ theme-17-new-product-section ----------------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-5-new-product">
                <div class="container">
                    <div class="text-center text-uppercase mb-5">
                        <span class="fw-600 text-dark fs-4 category-title text-truncate">
                            <?php echo e(trans('labels.new_arrival_products')); ?>

                        </span>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <p class="fs-6 text-muted fw-normal specks-subtitle mb-2 text-truncate">
                            <?php echo e(trans('labels.new_arrival_product_subtitle')); ?>

                        </p>
                    </div>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 p-0  g-md-4 g-3">
                        <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-17.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                            <?php echo e(trans('labels.viewall')); ?>

                            <span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>">
                            </span>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------------- theme-17-offer-banner-3-section ---------------------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-5-offer-banner-3 my-md-5 my-4">
                <div class="container-fluid">
                    <div class="theme-5-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
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
                <?php if(count($topdealsproducts) > 0): ?>
                    <section class="theme-5-new-product bg-primary-rgb py-100 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="mb-4 text-uppercase theme-3-title text-center">
                                <h3 class="fw-600  text-truncate">
                                    <?php echo e(trans('labels.home_page_top_deals_subtitle')); ?>

                                </h3>
                                <div class="d-flex justify-content-center align-items-center my-1">
                                    <div class="heading-line"></div>
                                    <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                                    <div class="heading-line"></div>
                                </div>
                                <p class="text-muted fw-normal text-truncate mb-2">
                                    <?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                </p>
                            </div>
                            <div id="countdown" class="mt-4 mb-5"> </div>
                            <div id="top-deals17" class="owl-carousel owl-theme">
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
                                    <div class="item h-100 bg-white mx-sm-2 theme-17">
                                        <div class="card rounded-0 border-0 h-100 product-grid">
                                            <div class="product-image">
                                                <a class="image">
                                                    <img class="pic-1"
                                                        src="<?php echo e($products['product_image']->image_url); ?>">
                                                    <img class="pic-2"
                                                        src="<?php echo e($products['multi_image']->count() > 0 ? $products['multi_image'][0]->image_url : $products['multi_image'][1]->image_url); ?>">
                                                </a>
                                                <?php if($off > 0): ?>
                                                    <span class="theme-17-ribbon">
                                                        <h3><?php echo e($off); ?>% <?php echo e(trans('labels.off')); ?></h3>
                                                    </span>
                                                <?php endif; ?>
                                                <ul class="social">
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li>
                                                            <?php if($getproductdata->has_variation == 1): ?>
                                                                <a
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                                    <div class="fs-8 d-flex align-items-center gap-1">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        <?php echo e(trans('labels.cart')); ?>

                                                                    </div>
                                                                </a>
                                                            <?php else: ?>
                                                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('<?php echo e($products->id); ?>','<?php echo e($products->slug); ?>','<?php echo e($products->name); ?>','<?php echo e($products['product_image'] == null ? 'product.png' : $products['product_image']->image); ?>','<?php echo e($products->tax); ?>','<?php echo e($price); ?>','','<?php echo e(URL::to(@$vendordata->slug . '/cart/add')); ?>','0')">
                                                                    <div class="fs-8 d-flex align-items-center gap-1">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        <?php echo e(trans('labels.cart')); ?>

                                                                    </div>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a onclick="productview('<?php echo e($products->id); ?>')">
                                                            <div class="fs-8 d-flex align-items-center gap-1">
                                                                <i class="fa-regular fa-eye"></i>
                                                                <?php echo e(trans('labels.view')); ?>

                                                            </div>
                                                        </a>
                                                    </li>
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li>
                                                                <a
                                                                    onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')">
                                                                    <div class="fs-8 d-flex align-items-center gap-1">
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
                                                                        <?php echo e(trans('labels.wishlist')); ?>

                                                                    </div>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <div class="card-body pb-0 product-content">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between gap-1 mb-1 align-items-center">
                                                    <p class="card-title fs-8 line-2 m-0 text-truncate">
                                                        <?php echo e(@$getproductdata['category_info']->name); ?>

                                                    </p>
                                                    <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                        <p class="fs-8 m-0 text-truncate">
                                                            <i class="text-warning fa-solid fa-star px-1"></i>
                                                            <span class="text-dark fw-500">
                                                                <?php echo e(number_format($products->ratings_average, 1)); ?>

                                                            </span>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                    class="text-secondary">
                                                    <p class="m-0 fs-7 fw-600 line-2 text-capitalize">
                                                        <?php echo e($products->name); ?>

                                                    </p>
                                                </a>
                                            </div>
                                            <div class="card-footer product-content">
                                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                                    <h5 class="text-dark fs-7 fw-600 m-0 text-truncate">
                                                        <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                    </h5>
                                                    <?php if($original_price > $price): ?>
                                                        <del
                                                            class="text-muted fs-8 fw-600"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="text-center my-4">
                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                    class="btn btn-sm btn-primary rounded-2 px-2 py-2 mt-3"><?php echo e(trans('labels.viewall')); ?>

                                    <i
                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <!----------------------------------------------------- TESTIMONIAL START ---------------------------------------------------->
        <?php if(@helper::checkaddons('store_reviews')): ?>
            <?php if($testimonials->count() > 0): ?>
                <section class="Testimonial my-5">
                    <div class="container position-relative">
                        <h4 class="wdt-heading-title text-center text-truncate ">
                            <?php echo e(trans('labels.testimonial_subtitle')); ?>

                        </h4>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <span class="wdt-heading-subtitle fw-normal mb-sm-5 mb-4 text-center text-truncate">
                            <?php echo e(trans('labels.testimonials')); ?>

                        </span>
                        <div class="col-12">
                            <div id="testimonial-slider-17" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <div class="testimonial-17">
                                            <p class="description <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                                "<?php echo e($testimonial->description); ?>"
                                            </p>
                                            <div class="pic p-1">
                                                <img src="<?php echo e(helper::image_path($testimonial->image)); ?>" alt="avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="testimonial-prof">
                                                <h4><?php echo e($testimonial->name); ?></h4>
                                                <small class="text-muted"><?php echo e($testimonial->position); ?></small>
                                                <ul class="list-inline small mb-3">
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

        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="my-md-5 my-4">
                <div class="container bg-light rounded-0">
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
        <!--------------------------------------------------- thetem-5-blog-section --------------------------------------------------->
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
                        <section class="theme-5-blog mb-md-5 mb-4">
                            <div class="container">
                                <div class="text-center text-uppercase mb-md-5 mb-4">
                                    <span
                                        class="fw-600 text-dark fs-4 category-title"><?php echo e(trans('labels.featured_blogs')); ?></span>
                                    <div class="d-flex justify-content-center align-items-center my-1">
                                        <div class="heading-line"></div>
                                        <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                                        <div class="heading-line"></div>
                                    </div>
                                    <p class="fs-6 text-muted fw-normal specks-subtitle mb-2 text-truncate">
                                        <?php echo e(trans('labels.blog_title')); ?>

                                    </p>
                                </div>
                                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
                                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '6', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col">
                                            <div class="card rounded-0 h-100 border-0 p-3 shadow">
                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                    class="products-img w-100 object-fit-cover" height="230"
                                                    alt="blog-image">
                                                <div class="card-body px-0 pb-0">
                                                    <h6 class="card-title text-dark fw-medium mb-1 line-2">
                                                        <a
                                                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>">
                                                            <?php echo e($blog->title); ?>

                                                        </a>
                                                    </h6>
                                                    <div class="line-2 fs-7 pt-1"><?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                                </div>
                                                <div
                                                    class="card-footer px-0 d-flex align-items-center justify-content-between">
                                                    <div class="d-flex fs-8">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p class="text-dark px-1">
                                                            <?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?>

                                                        </p>
                                                    </div>
                                                    <a class="fs-7 fw-600 text-secondary rounded-2"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>">
                                                        <?php echo e(trans('labels.readmore')); ?><span
                                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="d-flex justify-content-center mt-md-5 mt-4">
                                    <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
                                        href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">
                                        <?php echo e(trans('labels.viewall')); ?><span
                                            class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                                    </a>
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-17/index.blade.php ENDPATH**/ ?>
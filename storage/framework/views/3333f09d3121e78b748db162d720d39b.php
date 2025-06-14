<?php $__env->startSection('contents'); ?>
    <!---------------------------------- theme-13-slider-main-section ---------------------------------->
    <?php if(count($getsliderlist) > 0): ?>
        <section class="theme-13-slider">
            <div class="theme-13-main-banner slider-layer slider-bots text-animation owl-carousel owl-theme">
                <?php $__currentLoopData = $getsliderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item" data-merge="2">

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
                                class="w-100 object-fit-cover img-fluid theme-13-main-banner-slider" alt="">
                            <div class="carousel-caption px-md-5 py-sm-4 py-3 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center z-5">
                                    <div class="col-xl-12">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle"><?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-3 home-description">
                                            <?php echo e($slider['description']); ?>

                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        <?php else: ?>
                            <img src="<?php echo e($slider['image']); ?>"
                                class="w-100 object-fit-cover img-fluid theme-13-main-banner-slider" alt="">
                            <div class="carousel-caption px-md-5 py-sm-4 py-3 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center z-5">
                                    <div class="col-xl-12">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            <?php echo e($slider['title']); ?>

                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle"><?php echo e($slider['sub_title']); ?>

                                        </h2>
                                        <p class="text-white fs-18 mb-3 home-description">
                                            <?php echo e($slider['description']); ?>

                                        </p>
                                        <?php if($slider['link_text'] != '' || $slider['link_text'] != null): ?>
                                            <?php if($slider['type'] == 1): ?>
                                                <a class="btn btn-primary rounded-2"
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug)); ?>">
                                                <?php elseif($slider['type'] == 2): ?>
                                                    <a class="btn btn-primary rounded-2"
                                                        href="<?php echo e(URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug)); ?>">
                                                    <?php elseif($slider['type'] == 3): ?>
                                                        <a class="btn btn-primary rounded-2"
                                                            href="<?php echo e($slider['custom_link']); ?>" target="_blank">
                                                        <?php else: ?>
                                                            <a class="btn btn-primary rounded-2" href="javascript:void(0)">
                                            <?php endif; ?>
                                            <?php echo e($slider['link_text']); ?> <i
                                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2'); ?>"></i></a>
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
    <main class="theme-13">
        <!---------------------------------- WHO WE ARE ---------------------------------->
        <?php if($whoweare->count() > 0): ?>
            <section class="who-we-are my-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <div class="d-flex align-items-center mb-2">
                                <span
                                    class="fs-6 text-secondary text-truncate m-0 px-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_title); ?></span>
                            </div>
                            <h4 class="wdt-heading-title line-2"><?php echo e(helper::appdata($vendordata->id)->whoweare_subtitle); ?>

                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                <?php echo e(helper::appdata($vendordata->id)->whoweare_description); ?>

                            </p>
                            <div class="row g-sm-3 g-2">
                                <?php $__currentLoopData = $whoweare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6">
                                        <div class="card border-0 bg-primary-light">
                                            <div class="card-body">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="<?php echo e(helper::image_path($item->image)); ?>"
                                                        class="icon-lg bg-opacity-10 text-success rounded-2 border"
                                                        alt="">
                                                    <h5 class="line-2 fw-600"><?php echo e($item->title); ?></h5>
                                                </div>
                                                <p class="mb-0 line-2 fs-7 mt-2"><?php echo e($item->sub_title); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="<?php echo e(helper::image_path(helper::appdata($vendordata->id)->whoweare_image)); ?>"
                                class="who-we-are-12 w-100 object-fit-cover rounded-2 border border-secondary-color <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------- theme-13-category-section ---------------------------------->
        <?php if(count(helper::getcategories(@$vendordata->id, '7')) > 0): ?>
            <section class="theme-13-category py-5 bg-primary-light">
                <div class="container">
                    <div class="mb-md-5 mb-4 text-center">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-1">
                            <?php echo e(trans('labels.homepage_category_subtitle')); ?>

                        </p>
                        <span
                            class="fw-semibold fs-2 category-title text-truncate my-2"><?php echo e(trans('labels.choose_by_category')); ?></span>
                        <div class="title-line-2 bg-secondary mx-auto mt-1"></div>
                    </div>
                    <div class="theme-13-category-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, '7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="theme-13-item h-100">
                                <div
                                    class="d-flex align-items-center justify-content-between p-2 bg-white h-100 rounded-2 overflow-hidden">
                                    <div class="d-grid h-100">
                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                            class="card-title text-dark fw-600"><?php echo e($categorydata['name']); ?></a
                                            href="#">

                                        <p class="d-flex align-items-center fs-13">
                                            <?php echo e(helper::product_count($categorydata->id)); ?>

                                            <?php echo e(trans('labels.items')); ?>

                                        </p>

                                        <a href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>"
                                            class="align-items-end d-md-flex d-none">
                                            <i class="fas fa-arrow-right cat-arrow"></i>
                                        </a>
                                    </div>
                                    <div class="cat-img-13 col-md-5 col-6">
                                        <a
                                            href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                            <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                class="object-fit-cover rounded-2 h-100 w-100" alt="category image"></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-secondary rounded-2 fs-7 px-4 py-2 category-button"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>"> <?php echo e(trans('labels.viewall')); ?><span
                                class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------- new top-bar-offer ---------------------------------->
        <?php if(!empty($coupons) && $coupons->count() > 0): ?>
            <div class="overflow-hidden offers-theme-12">
                <div class="offer-badge-12 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                    <?php echo e(trans('labels.best_offers')); ?>

                </div>
                <div class="text-secondary">
                    <?php echo $__env->make('web.coupon.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
        <!---------------------------------- theme-13-offer-banner-1-section ---------------------------------->
        <?php if(count($getbannerslist['bannersection1']) > 0): ?>
            <section class="theme-13-offer-banner-1 my-5">
                <div class="container">
                    <div class="offer-banner-1-carousel owl-carousel owl-theme">
                        <?php $__currentLoopData = $getbannerslist['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="rounded-2 ">
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
                                        class="w-100 h-100 rounded-2 object-fit-cover">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------- theme-13-best-Selling-Products-section ---------------------------------->
        <?php if(count($getbestsellingproducts) > 0): ?>
            <section class="theme-13-best-Selling-product my-5">
                <div class="container">
                    <div class="mb-md-5 mb-4 text-center">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-1">
                            <?php echo e(trans('labels.homepage_product_subtitle')); ?>

                        </p>
                        <span
                            class="fw-semibold fs-2 text-truncate my-2"><?php echo e(trans('labels.best_selling_product')); ?></span>
                        <div class="title-line-2 bg-secondary mx-auto mt-1"></div>
                    </div>
                    <div class="row g-sm-3 g-2">
                        <?php $__currentLoopData = $getbestsellingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-13.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                            <a class="btn btn-sm btn-secondary rounded-2 fs-7 px-4 py-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products')); ?>">
                                <?php echo e(trans('labels.viewall')); ?><span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!----------------------------------- theme-13-offer-banner-2-section ----------------------------------->
        <?php if(count($getbannerslist['bannersection2']) > 0): ?>
            <section class="theme-13-offer-banner-3 my-5">
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
                                    <img src="<?php echo e($banner['image']); ?>" class="d-block w-100 object-fit-cover rounded-2"
                                        alt="..."></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if(count($getbannerslist['bannersection2']) > 1): ?>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left slider-arrows rounded-5"></i></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.previous')); ?></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows rounded-5"></i></span>
                                <span class="visually-hidden"><?php echo e(trans('pagination.next')); ?></span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------- DEALS START ---------------------------------------->
        <?php if(@helper::checkaddons('top_deals')): ?>
            <?php if(!empty(helper::top_deals($vendordata->id))): ?>
                <?php if(count($topdealsproducts) > 0): ?>
                    <section class="theme-13-deals bg-primary-light py-5 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="mb-md-5 mb-4 text-center">
                                <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-1">
                                    <?php echo e(trans('labels.home_page_top_deals_title')); ?>

                                </p>
                                <span
                                    class="fw-semibold fs-2 text-truncate my-2"><?php echo e(trans('labels.home_page_top_deals_subtitle')); ?>

                                </span>
                                <div class="title-line-2 bg-secondary mx-auto mt-1"></div>
                            </div>

                            <div id="top-deals13" class="owl-carousel owl-theme carousel-items-3">
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
                                        class="item mx-1 h-100 p-2 d-flex bg-primary-rgb rounded-2 align-items-center border-0">
                                        <!-- img start -->
                                        <div class="item-img position-relative">
                                            <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                <img src="<?php echo e($products['product_image']->image_url); ?>"
                                                    class="object-fit-cover img-1 rounded-2" alt="">
                                                <img src="<?php echo e($products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url); ?>"
                                                    class="w-100 img-2 rounded-2" alt="">
                                            </a>
                                            <?php if($off > 0): ?>
                                                <div
                                                    class="off-label-two-12 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                                    <div class="sale-label-12"><?php echo e($off); ?>%
                                                        <?php echo e(trans('labels.off')); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="w-100 <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>">
                                            <div class="item-content p-0">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <p class="item-title text-muted fs-8 cursor-auto text-truncate">
                                                        <?php echo e(@$products['category_info']->name); ?>

                                                    </p>
                                                    <?php if(@helper::checkaddons('product_reviews')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->product_ratting_switch == 1): ?>
                                                            <p class="fs-8">
                                                                <i class="text-warning fa-solid fa-star px-1"></i>
                                                                <span
                                                                    class="text-dark fs-8 fw-500"><?php echo e(number_format($products->ratings_average, 1)); ?></span>
                                                            </p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <a
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>">
                                                    <p class="text-dark product-name line-2">
                                                        <?php echo e($products->name); ?></p>
                                                </a>

                                            </div>

                                            <div class="p-0">
                                                <h6
                                                    class="text-dark fs-7 fw-600 mt-3 mb-2 cursor-auto text-truncate d-sm-flex align-items-center">

                                                    <?php echo e(helper::currency_formate($price, $products->vendor_id)); ?>

                                                    <?php if($original_price > $price): ?>
                                                        <del
                                                            class="text-muted fs-8 fw-normal d-block px-sm-1"><?php echo e(helper::currency_formate($original_price, $products->vendor_id)); ?></del>
                                                    <?php endif; ?>

                                                </h6>
                                                <!-- options -->
                                                <ul
                                                    class="option-wrap d-flex gap-2 align-items-center d-grid product_icon2 mt-2">
                                                    <?php if(@helper::checkaddons('customer_login')): ?>
                                                        <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                                            <li tooltip="Wishlist" class="rounded-2">
                                                                <a onclick="managefavorite('<?php echo e($products->id); ?>',<?php echo e($vendordata->id); ?>,'<?php echo e(URL::to(@$vendordata->slug . '/managefavorite')); ?>')"
                                                                    class="option-btn circle-round wishlist-btn rounded-2">
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
                                                    <li tooltip="View" class="rounded-2">
                                                        <a class="option-btn circle-round wishlist-btn rounded-2"
                                                            onclick="productview('<?php echo e($products->id); ?>','1')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                                        <li tooltip="Add To Cart" class="rounded-2">
                                                            <?php if($products->has_variation == 1): ?>
                                                                <a href="<?php echo e(URL::to(@$vendordata->slug . '/products/' . $products->slug)); ?>"
                                                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-2">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="javascript:void(0);"
                                                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-2"
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
                            <div class="d-flex justify-content-center mt-lg-4 mt-4">
                                <div class="card col-auto my-auto p-0 rounded-2 margin-sm p-1">
                                    <div id="countdown" class="countdown-border"> </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-md-4 mt-3">
                                <div class="rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/topdeals?type=1')); ?>"
                                        class="btn btn-sm btn-secondary rounded-2 fs-7 px-4 py-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"><?php echo e(trans('labels.viewall')); ?>

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
                <section class="Testimonial py-5 bg-primary-light">
                    <div class="container position-relative">
                        <div class="mb-md-5 mb-4 text-center">
                            <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-1">
                                <?php echo e(trans('labels.testimonials')); ?>

                            </p>
                            <span class="fw-semibold fs-2 text-truncate my-2"><?php echo e(trans('labels.testimonial_subtitle')); ?>

                            </span>
                            <div class="title-line-2 bg-secondary mt-1 mx-auto"></div>
                        </div>
                        <!-- testimonial slider start -->
                        <div id="testimonial13" class="owl-carousel owl-theme carousel-testimonial">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item h-100 mx-1">
                                    <div class="client-profile h-100 rounded-2 bg-transparent overflow-hidden">
                                        <img src="<?php echo e(helper::image_path($testimonial->image)); ?>"
                                            class="h-100 theme-13-client-img rounded-2" alt="">
                                        <div>
                                            <div class="px-sm-4 px-2 py-2">
                                                <p class="client-name text-capitalize mb-md-4 mb-3">
                                                    <?php echo e($testimonial->name); ?>

                                                    <span
                                                        class="profession fs-7 d-block"><?php echo e($testimonial->position); ?></span>
                                                </p>
                                                <p class="fs-7 text-capitalize mb-md-3 mb-2">
                                                    “<?php echo e($testimonial->description); ?>”</p>
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
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>
        <!----------------------------------- theme-13-offer-banner-3-section ----------------------------------->
        <?php if(count($getbannerslist['bannersection3']) > 0): ?>
            <section class="theme-13-offer-banner my-5">
                <div class="container-fluid">
                    <div class="offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        <?php $__currentLoopData = $getbannerslist['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="rounded-2">
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
                                        class="object-fit-cover rounded-2 ">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!----------------------------------------- theme-13-new-product-section ----------------------------------------->
        <?php if(count($getnewarrivalproducts) > 0): ?>
            <section class="theme-13-new-product my-5">
                <div class="container">
                    <div class="mb-md-5 mb-4 text-center">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-1">
                            <?php echo e(trans('labels.new_arrival_product_subtitle')); ?>

                        </p>
                        <span
                            class="fw-semibold fs-2 text-truncate my-2"><?php echo e(trans('labels.new_arrival_products')); ?></span>
                        <div class="title-line-2 bg-secondary mx-auto mt-1"></div>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                        <?php $__currentLoopData = $getnewarrivalproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-13.newproductcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                            <a class="btn btn-sm btn-secondary rounded-2 fs-7 px-4 py-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/products-newest')); ?>">
                                <?php echo e(trans('labels.viewall')); ?><span
                                    class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2'); ?>"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------- app download end ---------------------------------------->
        <?php if(!empty($appsection)): ?>
            <section class="py-md-5 py-3">
                <div class="container">
                    <div
                        class="bg-primary-light rounded-2 row align-items-center justify-content-lg-between justify-content-center g-5 p-5">
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
                            <h3 class="fs-1 m-0 fw-bold"><?php echo e(@$appsection->title); ?></h3>
                            <p class="mb-lg-5 mb-4 mt-3 line-2"><?php echo e(@$appsection->subtitle); ?></p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <div class="rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(@$appsection->android_link); ?>"> <img
                                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg')); ?>"
                                            class="g-play rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                            alt=""> </a>
                                </div>
                                <!-- App store button -->
                                <div class="rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                    <a href="<?php echo e(@$appsection->ios_link); ?>"> <img
                                            src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg')); ?>"
                                            class="g-play rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
                                            alt=""> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!---------------------------------------- theme-13-blog-section ---------------------------------------->
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
                        <section class="theme-13-blog my-5">
                            <div class="container">
                                <div class="mb-md-5 mb-4 text-center">
                                    <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-1">
                                        <?php echo e(trans('labels.blog_title')); ?>

                                    </p>
                                    <span
                                        class="fw-semibold fs-2 text-truncate my-2"><?php echo e(trans('labels.featured_blogs')); ?>

                                    </span>
                                    <div class="title-line-2 bg-secondary mx-auto mt-1"></div>
                                </div>
                                <div class="row g-3 g-xl-4 justify-content-between">
                                    <?php $__currentLoopData = helper::getblogs(@$vendordata->id, '4', ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key == 0 || $key == 1): ?>
                                            <div class="col-lg-6">
                                                <div class="card border-0 bg-primary-light h-100">
                                                    <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                        class="card-img-top w-100 object-fit-cover rounded-0 blog-img-height position-relative"
                                                        alt="blog-image">
                                                    <div class="card-body">
                                                        <h6 class="card-title line-2 mb-1 fw-bold"> <a
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                                class="text-dark"><?php echo e($blog->title); ?></a>
                                                        </h6>
                                                        <div class="pt-1 fs-7 line-2">
                                                            <?php echo strip_tags(Str::limit($blog->description, 200)); ?>

                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center pt-3 pb-2">

                                                            <div class="text-dark fs-7"><i
                                                                    class="fa-solid fa-calendar-days"></i><span
                                                                    class="px-1 fw-500 text-truncate"><?php echo e(helper::date_formate($blog->created_at, $blog->vendor_id)); ?></span>
                                                            </div>

                                                            <a class="fw-semibold fs-15 text-secondary fw-500"
                                                                href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"><?php echo e(trans('labels.readmore')); ?><span
                                                                    class="mx-1"><i
                                                                        class="<?php echo e(session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long'); ?>"></i></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div>
                                                <div class="card border-0 bg-primary-light rounded-2 overflow-hidden">
                                                    <div class="d-flex align-items-center">
                                                        <div class="col-sm-3 col-4 ">
                                                            <div class="img-overlay rounded-4">
                                                                <img src="<?php echo e(helper::image_path($blog->image)); ?>"
                                                                    class="card-img-top w-100 object-fit-cover rounded-0 sub-blog-height"
                                                                    alt="blog-image">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9 p-3">
                                                            <h6 class="fw-bold mb-1 line-2"><a
                                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/blogs-' . $blog->slug)); ?>"
                                                                    class="text-dark"><?php echo e($blog->title); ?></a></h6>
                                                            <div class="pt-1 fs-7 line-2"><?php echo strip_tags(Str::limit($blog->description, 200)); ?></div>
                                                            <div class="d-flex flex-wrap justify-content-between mt-3">
                                                                <div class="text-dark fs-7"><i
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
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="d-flex justify-content-center mt-md-5 mt-4">
                                    <div class="rounded-2 <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>">
                                        <a class="btn btn-sm btn-secondary rounded-2 fs-7 px-4 py-2 category-button <?php echo e(session()->get('direction') == 2 ? 'rtl' : ' '); ?>"
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/theme-13/index.blade.php ENDPATH**/ ?>
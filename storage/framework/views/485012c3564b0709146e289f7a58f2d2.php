<!-- top bar section start -->
<section class="top-bar bg-dark py-2 d-md-block d-none">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="top-bar-call-email d-none d-md-block text-white">
                <a href="tel:<?php echo e(helper::appdata($vendordata->id)->contact); ?>" class="text-white">
                    <i class="fa-light fa-phone mx-1"></i><?php echo e(helper::appdata(@$vendordata->id)->contact); ?></a> |
                <a href="mailto:<?php echo e(helper::appdata($vendordata->id)->email); ?>" class="text-white">
                    <i class="fa-regular fa-envelope mx-1"></i><?php echo e(helper::appdata(@$vendordata->id)->email); ?></a>
            </div>

            <!-- lag btn for deckstop start-->
            <div class="d-flex align-items-center">
                <ul class="topbar-social-media mx-2 d-none d-md-block">

                    <li class="d-flex gap-3">
                        <?php $__currentLoopData = @helper::getsociallinks($vendordata->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="social-rounded fb p-0" href="<?php echo e($links->link); ?>" target="_blank"
                                class="social-rounded fb p-0"><?php echo $links->icon; ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </li>
                </ul>
                <?php
                    $languages = explode('|', helper::appdata(@$vendordata->id)->languages);
                ?>
                <?php if(@helper::checkaddons('language')): ?>
                    <?php if(count($languages) > 1): ?>
                        <div class="d-lg-block d-none">
                            <div class="lag-btn dropdown border-0 shadow-none">
                                <button
                                    class="btn dropdown-toggle language-dropdown d-flex justify-content-between align-items-center mb-0"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo e(helper::image_path(session()->get('flag'))); ?>"
                                        class="lag-img img-fluid mx-1" alt="">
                                </button>
                                <ul class="dropdown-menu rounded-1 p-0 rounded-3 overflow-hidden">
                                    <?php $__currentLoopData = helper::available_language(@$vendordata->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languagelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($languagelist->code, explode('|', helper::appdata(@$vendordata->id)->languages))): ?>
                                            <li><a class="dropdown-item text-dark d-flex align-items-center text-left px-3 py-2"
                                                    href="<?php echo e(URL::to('/lang/change?lang=' . $languagelist->code)); ?>">
                                                    <img src="<?php echo e(helper::image_path($languagelist->image)); ?>"
                                                        alt="" class="img-fluid lag-img mx-1 w-25">
                                                    &nbsp;&nbsp;<?php echo e($languagelist->name); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <!-- lag btn for deckstop end-->

            <div class="search-box d-block d-md-none">
                <div class="search d-flex align-items-center">
                    <a type="button" class="btn btn-primary bg-transparent border-0 px-0 nav-icon-m-1 mx-1"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa-light fa-magnifying-glass text-white fs-25-px"></i>
                    </a>
                    <!-- mobile-login section -->
                    <div class="mobile-login d-block d-md-none">
                        <ul
                            class="right-btn-wrapper d-flex align-items-center <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'right-btn-wrapper-rtl' : ''); ?>">
                            <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                                <li class="shopping-cart d-block d-md-none">
                                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/cart')); ?>" class="cart-dropdown-btn">
                                        <span
                                            class="cart-count text-white"><?php echo e(helper::getcartcount(@$vendordata->id, session()->getId(), Auth::user() && Auth::user()->type == 3 ? Auth::user()->id : '')); ?></span>
                                        <i class="fa-light fa-bag-shopping text-white mx-1 fs-25-px"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user() && Auth::user()->type == 3): ?>
                                <li class="m-1 d-block d-md-none">
                                    <div class="dropdown p-0">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <a href="<?php echo e(URL::to($vendordata->slug . '/profile')); ?>"
                                                    class="border-0 dropdown-toggle text-dark d-flex align-items-center"
                                                    type="button">
                                                    <i class="fa-light fa-user text-white mx-2 fs-25-px"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php else: ?>
                                <?php if(@helper::checkaddons('customer_login')): ?>
                                    <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                        <li class="m-1">
                                            <a href="<?php echo e(URL::to($vendordata->slug . '/login')); ?>"
                                                class="text-white d-flex align-items-center">
                                                <i class="fa-light fa-user text-white mx-2 fs-25-px"></i>
                                                <span class="d-none d-md-block mx-1"><?php echo e(trans('labels.login')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- mobile-login section -->
                </div>
            </div>
        </div>
</section>

<!-- top bar section end -->

<!-- NAVBAR AREA START -->

<!-- FOR LARGE DEVICES -->

<section class="navbar-area border-bottom sticky-top">

    <div class="container">

        <div class="row g-0 align-items-center justify-content-between">

            <div class="col-xl-2 col-lg-2 col-md-4 col-7">

                <div class="logo-wrapper navbar-brand py-2">

                    <a href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>">

                        <img src="<?php echo e(helper::image_path(@helper::appdata(@$vendordata->id)->logo)); ?>"
                            class="my-2 logo-h-45-px header-logo <?php echo e(session()->get('direction') == 2 ? 'logo-rtl' : 'logo-ltr'); ?>"
                            alt="logo">

                    </a>

                </div>

            </div>

            <div class="col-xl-8 col-lg-8 col-md-4 d-none d-xl-block">

                <?php echo $__env->make('web.layout.common_menulist', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>

            <div class="col-auto">

                <div
                    class="d-flex align-items-center <?php echo e(session()->get('direction') == 2 ? 'float-start' : 'float-end'); ?>">
                    <div class="search-box d-none d-lg-block">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn px-0 border-0 nav-icon-m-1 mx-1" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            <i class="fa-light fa-magnifying-glass text-dark mx-1 fs-25-px"></i>
                        </a>
                    </div>



                    <ul
                        class="right-btn-wrapper <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'right-btn-wrapper-rtl' : ''); ?>">
                        <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                            <li class="shopping-cart d-none d-lg-block"><a
                                    href="<?php echo e(URL::to(@$vendordata->slug . '/cart')); ?>" class="cart-dropdown-btn"><span
                                        class="cart-count text-white"><?php echo e(helper::getcartcount(@$vendordata->id, session()->getId(), Auth::user() && Auth::user()->type == 3 ? Auth::user()->id : '')); ?></span><i
                                        class="fa-light fa-bag-shopping mx-1 text-dark fs-25-px"></i></a>
                            </li>
                        <?php endif; ?>


                        <?php if(Auth::user() && Auth::user()->type == 3): ?>
                            <li class="m-1 d-none d-lg-block">
                                <div class="dropdown p-0">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a href="<?php echo e(URL::to($vendordata->slug . '/profile')); ?>"
                                                class="border-0 dropdown-toggle text-dark d-flex align-items-center"
                                                type="button">
                                                <i class="fa-light fa-user text-dark mx-2 fs-25-px"></i>
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </li>
                        <?php else: ?>
                            <?php if(@helper::checkaddons('customer_login')): ?>
                                <?php if(helper::appdata($vendordata->id)->checkout_login_required == 1): ?>
                                    <li class="m-1 d-none d-lg-block">
                                        <a href="<?php echo e(URL::to($vendordata->slug . '/login')); ?>"
                                            class="text-white d-flex align-items-center">
                                            <i class="fa-light fa-user text-dark mx-2 fs-25-px"></i></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- FOR SMALL DEVICE TOP CATEGORIES -->
                        <?php
                            $languages = explode('|', helper::appdata(@$vendordata->id)->languages);
                        ?>
                        <?php if(@helper::checkaddons('language')): ?>
                            <?php if(count($languages) > 1): ?>
                                <div class="d-lg-none mx-sm-0">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="lag-btn dropdown border-0 shadow-none">
                                            <button
                                                class="btn dropdown-toggle language-dropdown d-flex justify-content-between align-items-center mb-0"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?php echo e(helper::image_path(session()->get('flag'))); ?>"
                                                    class="lag-img-mobile img-fluid" alt="">
                                            </button>
                                            <ul class="dropdown-menu rounded-1 p-0 rounded-3 overflow-hidden">
                                                <?php $__currentLoopData = helper::available_language(@$vendordata->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languagelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(in_array($languagelist->code, explode('|', helper::appdata(@$vendordata->id)->languages))): ?>
                                                        <li><a class="dropdown-item text-dark d-flex align-items-center text-left px-0 py-2"
                                                                href="<?php echo e(URL::to('/lang/change?lang=' . $languagelist->code)); ?>">
                                                                <img src="<?php echo e(helper::image_path($languagelist->image)); ?>"
                                                                    alt=""
                                                                    class="img-fluid lag-img-mobile mx-1 w-25">
                                                                &nbsp;&nbsp;<?php echo e($languagelist->name); ?>

                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>

                                        <button class="btn bg-transparent btn-group border text-dark m-0"
                                            type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#footersiderbar" aria-controls="footersiderbar">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>



                        <div class="offcanvas offcanvas-width  <?php echo e(session()->get('direction') == 2 ? 'offcanvas-end' : 'offcanvas-start'); ?>"
                            data-bs-scroll="false" tabindex="-1" id="top-categories"
                            aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header">
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <?php if(count(helper::getcategories(@$vendordata->id, '')) > 0): ?>
                                    <ul class="list-group list-group-flush">
                                        <?php $__currentLoopData = helper::getcategories(@$vendordata->id, ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item px-0">
                                                <a class="d-flex align-items-center"
                                                    href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'])); ?>">
                                                    <img src="<?php echo e(helper::image_path($categorydata->image)); ?>"
                                                        alt="" class="img-fluid rounded categories-sm-img">
                                                    <span
                                                        class="mx-2 text-dark text-truncate"><?php echo e($categorydata['name']); ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- FOR SMALL DEVICE TOP CATEGORIES -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-footer  d-lg-none">
        <ul class="d-flex align-items-center mobile-menu-active p-0 m-0">
            <li class="position-relative">
                <a class="<?php echo e(request()->is($vendordata->slug) ? 'active' : ''); ?>"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>">
                    <i class="fa-light fa-house"></i>
                    <span class="tab-bar-text"><?php echo e(trans('labels.home')); ?></span>
                </a>
            </li>
            <li class="position-relative">
                <a href="javascript:void(0)"
                    class="<?php echo e(request()->is($vendordata->slug . '/products') ? 'active' : ''); ?>"
                    data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fa-light fa-search"></i>
                    <span class="tab-bar-text"><?php echo e(trans('labels.search')); ?></span>
                </a>
            </li>
            <li class="position-relative">
                <a class="<?php echo e(request()->is($vendordata->slug . '/categories') ? 'active' : ''); ?>"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>" type="button">
                    <i class="fa-light fa-box-archive"></i>
                    <span class="tab-bar-text"><?php echo e(trans('labels.categories')); ?></span>
                </a>
            </li>
            <?php if(helper::appdata($vendordata->id)->online_order == 1): ?>
                <li class="position-relative">
                    <a class="<?php echo e(request()->is($vendordata->slug . '/cart') ? 'active' : ''); ?>"
                        href="<?php echo e(URL::to(@$vendordata->slug . '/cart')); ?>" class="">
                        <i class="fa-light fa-bag-shopping position-relative">
                            <span
                                class="cart-count cart-mobile text-white p-0"><?php echo e(helper::getcartcount(@$vendordata->id, session()->getId(), Auth::user() && Auth::user()->type == 3 ? Auth::user()->id : '')); ?></span>
                        </i>
                        <span class="tab-bar-text"><?php echo e(trans('labels.cart')); ?></span>
                    </a>
                </li>
            <?php endif; ?>


            <li class="position-relative">
                <a class="<?php echo e(request()->is($vendordata->slug . '/profile') ? 'active' : ''); ?>"
                    href="<?php echo e(Auth::user() && Auth::user()->type == 3 ? URL::to($vendordata->slug . '/profile') : URL::to($vendordata->slug . '/login')); ?>"
                    class="togl-btn text-dark toggle_button">
                    <i class="fa-light fa-user fs-6"></i>
                    <span class="tab-bar-text"><?php echo e(trans('labels.account')); ?></span>
                </a>
            </li>
        </ul>
    </div>
</section>



<div class="offcanvas <?php echo e(session()->get('direction') == 2 ? 'offcanvas-end' : 'offcanvas-start'); ?>" tabindex="-1"
    id="footersiderbar" aria-labelledby="footersiderbar">
    <div class="offcanvas-header justify-content-between border-bottom">
        <img src="<?php echo e(helper::image_path(@helper::appdata(@$vendordata->id)->logo)); ?>"
            class="object-fit-contain logo-h-50-px" alt="footer_logo">
        <button type="button" class="btn-close m-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h5 class="text-dark text-capitalize border-bottom pb-3 m-0 fw-600">
            <?php echo e(trans('labels.information')); ?>

        </h5>
        <ul class="list-group list-add list-group-flush border-bottom">
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/shop_all')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.shop_all')); ?>

                </a>
            </li>
            <?php if(@helper::checkaddons('subscription')): ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <?php
                        $checkplan = App\Models\Transaction::where('vendor_id', @$vdata)
                            ->orderByDesc('id')
                            ->first();
                        $user = App\Models\User::where('id', @$vdata)->first();
                        if (@$user->allow_without_subscription == 1) {
                            $blogs = 1;
                        } else {
                            $blogs = @$checkplan->blogs;
                        }
                    ?>
                    <?php if($blogs == 1): ?>
                        <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                            <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">
                                <i class="fa-solid fa-circle-dot fs-7"></i>
                                <?php echo e(trans('labels.blog')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if(@helper::checkaddons('blog')): ?>
                    <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                        <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>">
                            <i class="fa-solid fa-circle-dot fs-7"></i>
                            <?php echo e(trans('labels.blog')); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/gallery')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.gallery')); ?>

                </a>
            </li>
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/find-order')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.Track_Order')); ?>

                </a>
            </li>
        </ul>
        <h5 class="text-dark text-capitalize border-bottom py-3 m-0 fw-600">
            <?php echo e(trans('labels.get_help')); ?>

        </h5>
        <ul class="list-group list-add list-group-flush border-bottom">
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/aboutus')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.about_us')); ?>

                </a>
            </li>
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/faqs')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.faqs')); ?>

                </a>
            </li>
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/contact-us')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.help_contact')); ?>

                </a>
            </li>
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/termscondition')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.terms_condition')); ?>

                </a>
            </li>
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/privacypolicy')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.privacy_policy')); ?>

                </a>
            </li>
            <li class="list-group-item px-0 py-3 <?php echo e(session()->get('direction') == 2 ? 'pe-3' : 'ps-3'); ?>">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="<?php echo e(URL::to(@$vendordata->slug . '/refund_policy')); ?>">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    <?php echo e(trans('labels.refund_policy')); ?>

                </a>
            </li>
        </ul>
        <h5 class="text-dark text-capitalize py-3 m-0 fw-600">Get in Touch with Us</h5>
        
        <ul class="list-add">
            <li class="py-2">
                <p class="fs-7 fw-500 d-flex gap-2 align-items-center">
                    <i class="fa-regular fa-house fs-7"></i>
                    <?php echo e(@helper::appdata(@$vendordata->id)->address); ?>

                </p>
            </li>
            <li class="py-2">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="tel:<?php echo e(helper::appdata($vendordata->id)->contact); ?>">
                    <i class="fa-solid fa-phone fs-7"></i>
                    <?php echo e(@helper::appdata(@$vendordata->id)->contact); ?>

                </a>
            </li>
            <li class="py-2">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center"
                    href="mailto:<?php echo e(helper::appdata($vendordata->id)->email); ?>">
                    <i class="fa-solid fa-envelope fs-7"></i>
                    <?php echo e(@helper::appdata(@$vendordata->id)->email); ?>

                </a>
            </li>
        </ul>
        <!-- Social media icon -->
        <div class="social-media">
            <h5 class="text-dark text-capitalize pt-3 border-top mt-2 m-0 fw-600"><?php echo e(trans('labels.follow_us')); ?></h5>
            <ul class="follow d-flex flex-wrap gap-3 mt-3">
                <?php $__currentLoopData = @helper::getsociallinks($vendordata->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $links): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mb-1"><a class="social-rounded fb p-0" href="<?php echo e($links->link); ?>" target="_blank"
                            class="social-rounded fb p-0"><?php echo $links->icon; ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="subscribe-box">
            <h5 class="text-dark text-capitalize pt-3 border-top mt-3 m-0 fw-600">
                <?php echo e(trans('labels.subscribe')); ?>

            </h5>
            <p class="text-dark fs-7 my-3"><?php echo e(trans('labels.footer_subscribe_subtitle')); ?></p>
        </div>
        <form action="<?php echo e(URL::to($vendordata->slug . '/subscribe')); ?>" method="POST" class="mt-3">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <input type="text"
                    class="form-control fs-7 border text-dark fw-500 rounded-0 bg-light <?php echo e(session()->get('direction') == 2 ? 'ms-2' : 'me-2'); ?>"
                    name="subscribe_email" placeholder="example@yormailer.com" required>
                <button class="btn btn-primary fs-7 fw-600 rounded-0 mb-0"
                    type="submit"><?php echo e(trans('labels.subscribe')); ?> </button>
            </div>
        </form>

        <hr class="mt-4 text-white mb-0">
    </div>
    <div class="offcanvas-footer bg-dark border-top">
        <p class="m-0 fs-7 text-center text-light fw-500 px-2 py-2">
            <?php echo e(@helper::appdata(@$vendordata->id)->copyright); ?></p>
    </div>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/layout/common_header.blade.php ENDPATH**/ ?>
@extends('web.layout.default')
@section('contents')
    <!---------------------------------- theme-15-slider-main-section ---------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-15-slider my-3">
            <div class="container-fluid">
                <div class="row">
                    <div id="carousel-theme-15" class="carousel theme-15-slider slide vertical" data-bs-ride="carousel">
                        <div class="carousel-indicators {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            @foreach ($getsliderlist as $key => $slider)
                                <button type="button" data-bs-target="#carousel-theme-15"
                                    data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                    aria-current="true" aria-label="Slide {{ $key }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            <div class="layer"></div>
                            @foreach ($getsliderlist as $key => $slider)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @if ($slider['link_text'] == '' || $slider['link_text'] == null)
                                        @if ($slider['type'] == 1)
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                            @elseif($slider['type'] == 2)
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                @elseif($slider['type'] == 3)
                                                    <a href="{{ $slider['custom_link'] }}" target="_blank">
                                                    @else
                                                        <a href="javascript:void(0)">
                                        @endif
                                        <img src="{{ $slider['image'] }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                            <div class="row">
                                                <div
                                                    class="col-12 {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                    <h5
                                                        class="text-white main-banner-title mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounceInRight">
                                                        {{ $slider['title'] }}
                                                    </h5>
                                                    <h2
                                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                                        {{ $slider['sub_title'] }}
                                                    </h2>
                                                    <p
                                                        class="text-white fs-18 mb-md-5 mb-2 home-description line-2 col-md-9{{ session()->get('direction') == 2 ? ' me-auto' : ' ms-auto' }}">
                                                        {{ $slider['description'] }}
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    @else
                                        <img src="{{ $slider['image'] }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                            <div class="row">
                                                <div
                                                    class="col-12 {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                    <h5
                                                        class="text-white main-banner-title mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounceInRight">
                                                        {{ $slider['title'] }}
                                                    </h5>
                                                    <h2
                                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                                        {{ $slider['sub_title'] }}
                                                    </h2>
                                                    <p
                                                        class="text-white fs-18 mb-md-5 mb-2 home-description line-2 col-md-9{{ session()->get('direction') == 2 ? ' me-auto' : ' ms-auto' }}">
                                                        {{ $slider['description'] }}
                                                    </p>
                                                    <div
                                                        class="d-flex justify-content-end animate__animated animate__fadeInDown">
                                                        <div
                                                            class="rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                            @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                                @if ($slider['type'] == 1)
                                                                    <a class="btn btn-primary rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                                    @elseif($slider['type'] == 2)
                                                                        <a class="btn btn-primary rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                            href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                                        @elseif($slider['type'] == 3)
                                                                            <a class="btn btn-primary rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                                href="{{ $slider['custom_link'] }}"
                                                                                target="_blank">
                                                                            @else
                                                                                <a class="btn btn-primary rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                                    href="javascript:void(0)">
                                                                @endif{{ $slider['link_text'] }} <i
                                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2' }}"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <main class="theme-15">
        <!---------------------------------- top-bar-offer ---------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            <div class="overflow-hidden offers-theme-14">
                <div class="container">
                    <div class="offer-badge-14 rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                        {{ trans('labels.best_offers') }}
                    </div>
                </div>
                <div class="text-secondary">
                    @include('web.coupon.index')
                </div>
            </div>
        @endif
        <!---------------------------------- theme-15-category-section ---------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-15-category py-sm-5 py-4 bg-primary-light">
                <div class="container">
                    <div class="card rounded-0 bg-primary h-100 text-center d-flex justify-content-center py-5 mb-4">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                            {{ trans('labels.homepage_category_subtitle') }}
                        </p>
                        <span
                            class="fw-semibold text-white fs-2 text-truncate">{{ trans('labels.choose_by_category') }}</span>
                        <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                        <div class="d-flex justify-content-center mt-4">
                            <a class="btn btn-secondary rounded-0 fs-7 px-4 py-2 category-button"
                                href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                    <div class="theme-15-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="theme-15-item h-100">
                                <div class="card border-0 text-center p-1 rounded-0 overflow-hidden h-100">
                                    <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                        class="card-title fw-600 text-dark fs-15 choose-by-category-name my-2">{{ $categorydata['name'] }}</a
                                        href="#">
                                    <div class="cat-img h-100 w-100">
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                            <img src="{{ helper::image_path($categorydata->image) }}"
                                                class="object-fit-cover rounded-0 cat-15" alt="category image"></a>
                                    </div>

                                    <p class="my-2 fs-13">{{ helper::product_count($categorydata->id) }}
                                        {{ trans('labels.items') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- theme-15-best-Selling-Products-section ---------------------------------->
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-15-best-Selling-product my-md-5 my-4">
                <div class="container">
                    <div class="card rounded-0 bg-primary h-100 text-center d-flex justify-content-center py-5 mb-4">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                            {{ trans('labels.homepage_product_subtitle') }}
                        </p>
                        <span class="fw-semibold text-white fs-2 text-truncate"> {{ trans('labels.best_selling_product') }}
                        </span>
                        <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                        <div class="d-flex justify-content-center mt-4">
                            <div class="rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                <a class="btn btn-secondary rounded-0 fs-7 px-4 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                    href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                                    {{ trans('labels.viewall') }}<span
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-15.productcomonview')
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- theme-15-offer-banner-1-section ---------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-15-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="row g-md-4 g-3">
                        @foreach ($getbannerslist['bannersection1'] as $key => $banner)
                            @if ($key == 0)
                                <div class="col-sm-6">
                                    <div class="rounded-0">
                                        @if ($banner['type'] == 1)
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug) }}">
                                            @elseif($banner['type'] == 2)
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug) }}">
                                                @elseif($banner['type'] == 3)
                                                    <a href="{{ $banner['custom_link'] }}" target="_blank">
                                                    @else
                                                        <a href="javascript:void(0)">
                                        @endif
                                        <img src="{{ $banner['image'] }}" alt=""
                                            class="offer-banner-1-img w-100 rounded-0 object-fit-cover">
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-sm-6">
                            <div class="theme-15-offer-banner-1-carousel owl-carousel owl-theme">
                                @if ($key != 0)
                                    @foreach ($getbannerslist['bannersection1'] as $key => $banner)
                                        @if ($key != 0)
                                            <div class="item">
                                                <div class="rounded-0">
                                                    @if ($banner['type'] == 1)
                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug) }}">
                                                        @elseif($banner['type'] == 2)
                                                            <a
                                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug) }}">
                                                            @elseif($banner['type'] == 3)
                                                                <a href="{{ $banner['custom_link'] }}" target="_blank">
                                                                @else
                                                                    <a href="javascript:void(0)">
                                                    @endif
                                                    <img src="{{ $banner['image'] }}" alt=""
                                                        class="offer-banner-1-img w-100 rounded-0 object-fit-cover">
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- WHO WE ARE ---------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are my-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="who-we-are-12 w-100 object-fit-cover rounded-0 border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                alt="">
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bg-primary p-sm-4 p-3 mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-6 text-secondary text-truncate m-0">
                                        {{ helper::appdata($vendordata->id)->whoweare_title }}
                                    </span>
                                </div>
                                <h4 class="wdt-heading-title text-white line-2">
                                    {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                                </h4>
                                <p class="wdt-heading-content-wrapper text-white line-2 mb-0">
                                    {{ helper::appdata($vendordata->id)->whoweare_description }}
                                </p>
                            </div>
                            @foreach ($whoweare as $item)
                                <div class="rounded-0 py-3 mb-1">
                                    <div class="d-flex gap-2">
                                        <img src="{{ helper::image_path($item->image) }}"
                                            class="icon-lg bg-opacity-10 text-success rounded-0" alt="">
                                        <div>
                                            <h5 class="line-2 fw-600">{{ $item->title }}</h5>
                                            <p class="mb-0 fs-7 line-2 mt-1">{{ $item->sub_title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------- theme-15-offer-banner-2-section ----------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-15-offer-banner-3 my-5">
                <div class="container">
                    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($getbannerslist['bannersection2'] as $key => $banner)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="4000">
                                    @if ($banner['type'] == 1)
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug) }}">
                                        @elseif($banner['type'] == 2)
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug) }}">
                                            @elseif($banner['type'] == 3)
                                                <a href="{{ $banner['custom_link'] }}" target="_blank">
                                                @else
                                                    <a href="javascript:void(0)">
                                    @endif
                                    <img src="{{ $banner['image'] }}" class="d-block w-100 object-fit-cover rounded-0"
                                        alt="..."></a>
                                </div>
                            @endforeach
                        </div>
                        @if (count($getbannerslist['bannersection2']) > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left slider-arrows rounded-0"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows rounded-0"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.next') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------------- theme-15-new-product-section ----------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-15-new-product my-5">
                <div class="container">
                    <div class="card rounded-0 bg-primary h-100 text-center d-flex justify-content-center py-5 mb-4">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                            {{ trans('labels.new_arrival_product_subtitle') }}
                        </p>
                        <span
                            class="fw-semibold text-white fs-2 text-truncate">{{ trans('labels.new_arrival_products') }}</span>
                        <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                        <div class="d-flex justify-content-center mt-4">
                            <a class="btn btn-secondary fs-7 rounded-0 px-4 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                    <div class="row g-sm-4 g-3 mt-4">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @include('web.theme-15.newproductcomonview')
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!--------------------------------------- TESTIMONIAL START --------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial py-5 bg-primary-light">
                    <div class="container position-relative">
                        <div class="card rounded-0 bg-primary h-100 text-center d-flex justify-content-center py-5 mb-4">
                            <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                                {{ trans('labels.testimonials') }}
                            </p>
                            <span
                                class="fw-semibold text-white fs-2 text-truncate">{{ trans('labels.testimonial_subtitle') }}</span>
                            <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                        </div>
                        <!-- testimonial slider start -->
                        <div id="testimonial15" class="owl-carousel owl-theme theme-15-testimonial carousel-items-4">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100 {{ session()->get('direction') == 2 ? 'me-1' : 'ms-1' }}">
                                    <div class="client-profile bg-white p-2 h-100 rounded-0 overflow-hidden">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ helper::image_path($testimonial->image) }}"
                                                class="theme-15-client-img rounded-0" alt="">
                                        </div>
                                        <div class="py-3 px-2 text-center">
                                            <p class="mb-2 fs-7 text-capitalize">“{{ $testimonial->description }}”</p>
                                            <p class="client-name mb-2"> {{ $testimonial->name }}
                                                <span class="profession fs-7 d-block">{{ $testimonial->position }}</span>
                                            </p>
                                            <ul class="fs-7">
                                                @php
                                                    $count = (int) $testimonial->star;
                                                @endphp
                                                <li>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $count)
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                        @else
                                                            <i class="fa-regular fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @endif
        <!---------------------------------------- app download end ---------------------------------------->
        @if (!empty($appsection))
            <section class="my-5">
                <div class="container">
                    <div
                        class="row bg-primary rounded-0 align-items-center justify-content-lg-between justify-content-center p-5">
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="{{ helper::image_path(@$appsection->image) }}"
                                    class="h-500px object-fit-cover " alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-white">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 line-2 text-white">{{ @$appsection->subtitle }}</p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <div class="rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ @$appsection->android_link }}"> <img
                                            src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg') }}"
                                            class="g-play rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            alt=""> </a>
                                </div>
                                <!-- App store button -->
                                <div class="rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ @$appsection->ios_link }}"> <img
                                            src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg') }}"
                                            class="g-play rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            alt=""> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------- theme-15-offer-banner-3-section ----------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-15-offer-banner my-5">
                <div class="container-fluid">
                    <div class="offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        @foreach ($getbannerslist['bannersection3'] as $banner)
                            <div class="item">
                                <div class="rounded-0">
                                    @if ($banner['type'] == 1)
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$banner['category_info']->slug) }}">
                                        @elseif($banner['type'] == 2)
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $banner['product_info']->slug) }}">
                                            @elseif($banner['type'] == 3)
                                                <a href="{{ $banner['custom_link'] }}" target="_blank">
                                                @else
                                                    <a href="javascript:void(0)">
                                    @endif
                                    <img src="{{ $banner['image'] }}" alt="banner-3"
                                        class="object-fit-cover rounded-0 ">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------------- DEALS START ---------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="theme-15-deals bg-primary-light py-5 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="card h-100 bg-primary justify-content-center rounded-0 py-5 mb-4">
                                <div class="mb-4 text-center">
                                    <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                                        {{ trans('labels.home_page_top_deals_title') }}
                                    </p>
                                    <span
                                        class="fw-semibold text-white fs-3 text-truncate my-2">{{ trans('labels.home_page_top_deals_subtitle') }}
                                    </span>
                                    <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="card col-auto my-auto p-0 rounded-0 margin-sm">
                                        <div id="countdown" class="countdown-border"> </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-md-4 mt-3">
                                    <div class="rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                        <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                            class="btn btn-secondary rounded-0 fs-7 px-4 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">{{ trans('labels.viewall') }}
                                            <span
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="top-deals15" class="owl-carousel owl-theme theme-15-deal carousel-items-4">
                                @foreach ($topdealsproducts as $products)
                                    @php
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
                                    @endphp

                                    <div class="card border-0 rounded-0 h-100 p-2">
                                        <div class="card-img position-relative">
                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                <img src="{{ $products['product_image']->image_url }}"
                                                    class="object-fit-cover img-1 rounded-0" alt="">
                                                <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                    class="w-100 img-2 rounded-0" alt="">
                                            </a>
                                            @if ($off > 0)
                                                <div
                                                    class="off-label-14 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                    <div class="sale-label-14 rounded-0">
                                                        {{ $off }}% {{ trans('labels.off') }}
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- options -->
                                            <ul class="option-wrap gap-2 align-items-center d-grid product_icon2">
                                                @if (@helper::checkaddons('customer_login'))
                                                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                        <li data-tooltip="Wishlist"
                                                            class="rounded-0 tooltip-{{ session()->get('direction') == 2 ? 'left' : 'right' }}">
                                                            <a onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                class="option-btn circle-round wishlist-btn rounded-0">
                                                                @if (Auth::user() && Auth::user()->type == 3)
                                                                    @php
                                                                        $favorite = helper::ceckfavorite(
                                                                            $products->id,
                                                                            $vendordata->id,
                                                                            Auth::user()->id,
                                                                        );
                                                                    @endphp
                                                                    @if (!empty($favorite) && $favorite->count() > 0)
                                                                        <i class="fa-solid fa-heart"></i>
                                                                    @else
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    @endif
                                                                @else
                                                                    <i class="fa-regular fa-heart"></i>
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                                <li data-tooltip="{{ trans('labels.view') }}"
                                                    class="rounded-0 tooltip-{{ session()->get('direction') == 2 ? 'left' : 'right' }}">
                                                    <a class="option-btn circle-round wishlist-btn rounded-0"
                                                        onclick="productview('{{ $products->id }}')">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                @if (helper::appdata($vendordata->id)->online_order == 1)
                                                    <li data-tooltip="{{ trans('labels.addtocart') }}"
                                                        class="rounded-0 tooltip-{{ session()->get('direction') == 2 ? 'left' : 'right' }}">
                                                        @if ($products->has_variation == 1)
                                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                class="option-btn circle-round addtocart-btn wishlist-btn rounded-0">
                                                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                            </a>
                                                        @else
                                                            <a class="option-btn circle-round addtocart-btn wishlist-btn rounded-0"
                                                                onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endif
                                            </ul>
                                            <!-- options -->
                                            <!-- category and reting -->
                                            <div class="category-label">
                                                <p
                                                    class="item-title text-dark fs-8 cursor-auto text-truncate bg-primary-rgb px-2">
                                                    {{ @$products['category_info']->name }}
                                                </p>
                                                @if (@helper::checkaddons('product_reviews'))
                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                        <p class="fs-8 d-flex">
                                                            <i class="text-warning fa-solid fa-star px-1"></i>
                                                            <span
                                                                class="text-dark fs-8 fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                        </p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card-body px-2 pt-3 pb-0">
                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                <p class="text-dark product-name line-2">{{ $products->name }}</p>
                                            </a>

                                        </div>
                                        <div class="card-footer px-2 py-2">
                                            <h6
                                                class="text-dark fs-7 d-flex fw-500 product-price cursor-auto text-truncate">

                                                {{ helper::currency_formate($price, $products->vendor_id) }}
                                                @if ($original_price > $price)
                                                    <del
                                                        class="text-muted fs-8 fw-normal d-block mx-1">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif

        <!-------------------------------------------- theme-15-blog-section -------------------------------------------->
        @if (@helper::checkaddons('customer_login'))
            @if (@helper::checkaddons('blog'))
                @php
                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                        ->orderByDesc('id')
                        ->first();
                    if ($vendordata->allow_without_subscription == 1) {
                        $blogs = 1;
                    } else {
                        $blogs = @$checkplan->blogs;
                    }
                @endphp
                @if ($blogs == 1)
                    @if (count(helper::getblogs(@$vendordata->id, '6', '')) > 0)
                        <section class="theme-15-blog my-5">
                            <div class="container">
                                <div
                                    class="card rounded-0 bg-primary h-100 text-center d-flex justify-content-center py-5 mb-4">
                                    <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                                        {{ trans('labels.blog_title') }}
                                    </p>
                                    <span
                                        class="fw-semibold text-white fs-3 text-truncate">{{ trans('labels.featured_blogs') }}</span>
                                    <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                                    <div class="d-flex justify-content-center mt-4">
                                        <a class="btn btn-sm btn-secondary rounded-0 fs-7 px-4 py-2 category-button {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            href="{{ URL::to(@$vendordata->slug . '/blogs') }}">
                                            {{ trans('labels.viewall') }}<span
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                        </a>
                                    </div>
                                </div>
                                <!-- blog cards start -->
                                <div class="row g-3 g-xl-4 justify-content-between">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $key => $blog)
                                        @if ($key == 0)
                                            <div class="col-lg-6">
                                                <div class="position-relative h-100">
                                                    <img src="{{ helper::image_path($blog->image) }}"
                                                        class="theme-15-blog-img object-fit-cover" height="230"
                                                        alt="blog-image">
                                                    <div class="theme-15-blog-description p-3 w-100">
                                                        <h6 class="card-title text-white fw-600 mb-1 line-2">
                                                            {{ $blog->title }}</h6>
                                                        <div class="line-2 fs-7 pt-1 text-white">{!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mt-3">
                                                            <div class="text-white fs-8"><i
                                                                    class="fa-solid fa-calendar-days"></i><span
                                                                    class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                            </div>
                                                            <a class="btn btn-sm fs-15 btn-secondary rounded-0"
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                                {{ trans('labels.readmore') }}
                                                                <span
                                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="col-lg-6">
                                        <div class="theme-15-blogs-carousel owl-carousel owl-theme">
                                            @foreach (helper::getblogs(@$vendordata->id, '6', '') as $key => $blog)
                                                @if ($key != 0)
                                                    <div class="card h-100 border-0">
                                                        <img src="{{ helper::image_path($blog->image) }}"
                                                            class="products-img w-100 object-fit-cover" height="230"
                                                            alt="blog-image">
                                                        <div class="card-body px-2 pb-0">
                                                            <div
                                                                class="mb-2 {{ @helper::appdata(@$vendordata->id)->web_layout == 1 ? 'text-start' : 'text-end' }}">
                                                            </div>
                                                            <h6 class="card-title text-dark fw-600 mb-1 line-2"><a
                                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                            </h6>
                                                            <div class="line-2 fs-7 pt-1">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                        </div>
                                                        <div
                                                            class="card-footer px-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                            <div class="text-dark fs-8"><i
                                                                    class="fa-solid fa-calendar-days"></i><span
                                                                    class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                            </div>
                                                            <a class="btn fs-15 btn-sm btn-secondary rounded-0"
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                                {{ trans('labels.readmore') }}<span
                                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endif
            @endif
        @endif
    </main>
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/index.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

@extends('web.layout.default')
@section('contents')
    <!--------------------------------------------- theme-2-slider-main-banner --------------------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-2-slider">
            <div class="theme-2-main-banner owl-carousel owl-theme h-100">
                @foreach ($getsliderlist as $key => $slider)
                    <div class="item">
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
                            <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle">{{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-start">
                                            @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                @if ($slider['type'] == 1)
                                                    <a class="btn btn-fashion rounded-1"
                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                    @elseif($slider['type'] == 2)
                                                        <a class="btn btn-fashion rounded-1"
                                                            href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                        @elseif($slider['type'] == 3)
                                                            <a class="btn btn-fashion rounded-1"
                                                                href="{{ $slider['custom_link'] }}" target="_blank">
                                                            @else
                                                                <a class="btn btn-fashion rounded-1"
                                                                    href="javascript:void(0)">
                                                @endif{{ $slider['link_text'] }} <i
                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid"
                                alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-start">
                                            @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                @if ($slider['type'] == 1)
                                                    <a class="btn btn-fashion rounded-1"
                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                    @elseif($slider['type'] == 2)
                                                        <a class="btn btn-fashion rounded-1"
                                                            href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                        @elseif($slider['type'] == 3)
                                                            <a class="btn btn-fashion rounded-1"
                                                                href="{{ $slider['custom_link'] }}" target="_blank">
                                                            @else
                                                                <a class="btn btn-fashion rounded-1"
                                                                    href="javascript:void(0)">
                                                @endif
                                                {{ $slider['link_text'] }} <i
                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <main>
        <!--------------------------------------------- theme-2-category-section --------------------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-2-category my-5">
                <div class="container">
                    <div class="title d-flex align-items-center justify-content-between pb-3">
                        <div>
                            <span class="category-title p-0">{{ trans('labels.top_categories') }}</span>
                            <p class="fs-7 text-muted fw-normal">{{ trans('labels.homepage_category_subtitle') }}</p>
                        </div>
                        <a href="{{ URL::to(@$vendordata->slug . '/categories') }}"
                            class="btn btn-sm btn-outline-secondary category-button">{{ trans('labels.viewall') }}
                            <i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                        </a>
                    </div>
                    <div class="category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                <div class="item">
                                    <div class="content-box">
                                        <div class="cat-img">
                                            <img src="{{ helper::image_path($categorydata->image) }}"
                                                class="w-100 object-fit-cover" alt="">
                                            <div class="cat-title fs-15">
                                                <span class="text-truncate fw-normal">
                                                    {{ $categorydata['name'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!------------------------------------------- theme-2-offer-banner-1-section ----------------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="offer-banner-1 mb-md-5 mb-3">
                <div class="container">
                    <div class="offer-banner-carousel-1 owl-carousel owl-theme">
                        @foreach ($getbannerslist['bannersection1'] as $banner)
                            <div class="item">
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
                                    class="w-100 h-100 rounded object-fit-cover">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!------------------------------------------------- new top-bar-offer ------------------------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            @include('web.coupon.index')
        @endif
        <!------------------------------------------------- new top-bar-offer ------------------------------------------------->

        <!-------------------------------------------- theme-2-new-products-section ------------------------------------------>
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-2-new-products">
                <div class="container">
                    <div class="title d-flex align-items-center justify-content-between pb-3">
                        <div>
                            <span class="category-title p-0">{{ trans('labels.trending_products') }}</span>
                            <p class="fs-7 text-muted fw-normal">{{ trans('labels.homepage_product_subtitle') }}</p>
                        </div>
                        <a href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}"
                            class="btn btn-sm btn-outline-secondary category-button">{{ trans('labels.viewall') }}
                            <i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                        </a>
                    </div>
                    <div class="tranding-products">

                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-sm-4 g-3 mb-4">
                            @foreach ($getbestsellingproducts as $getproductdata)
                                @include('web.theme-2.productcomonview')
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-light py-md-5 py-3 mb-md-5 mb-3">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-5 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3">
                                @foreach ($whoweare as $item)
                                    <div class="d-flex gap-2 align-items-md-center align-items-start mb-xl-4 mb-lg-2 mb-2">
                                        <img src="{{ helper::image_path($item->image) }}"
                                            class="icon-lg bg-success bg-opacity-10 text-success rounded-circle"
                                            alt="">
                                        <div class="py-md-2 px-md-3 p-1">
                                            <h5 class="mb-1 fw-600 line-1">{{ $item->title }}</h5>
                                            <p class="mb-0 fs-7 line-2">{{ $item->sub_title }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="w-100" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->

        <!-------------------------------------------- theme-2-offer-banner-2-section ------------------------------------------>
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-2-offer-banner-2 mb-md-5 mb-3">
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
                                    <img src="{{ $banner['image'] }}" class="d-block w-100" alt="..."></a>
                                </div>
                            @endforeach
                        </div>
                        @if (count($getbannerslist['bannersection2']) > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i class="fa-solid fa-arrow-left arrow-btn"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i class="fa-solid fa-arrow-right arrow-btn"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.next') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <!--------------------------------------------- theme-2-new-Arrival-section ------------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-2-new-arrival bg-primary-rgb py-5 mb-md-5 mb-3">
                <div class="container">
                    <div class="title d-flex align-items-center justify-content-between pb-3">
                        <div>
                            <span class="category-title p-0">{{ trans('labels.new_arrival_products') }}</span>
                            <p class="fs-7 text-muted fw-normal">{{ trans('labels.new_arrival_product_subtitle') }}</p>
                        </div>
                        <a href="{{ URL::to(@$vendordata->slug . '/products-newest') }}"
                            class="btn btn-sm btn-outline-secondary category-button">{{ trans('labels.viewall') }}
                            <i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                        </a>
                    </div>
                    <div class="new-arrival-products">
                        <div class="row g-3 mb-4">
                            @foreach ($getnewarrivalproducts as $productdata)
                                @php
                                    if ($productdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
                                        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                            $price =
                                                $productdata->price - @helper::top_deals($vendordata->id)->offer_amount;
                                        } else {
                                            $price =
                                                $productdata->price -
                                                $productdata->price *
                                                    (@helper::top_deals($vendordata->id)->offer_amount / 100);
                                        }
                                        $original_price = $productdata->price;
                                    } else {
                                        $price = $productdata->price;
                                        $original_price = $productdata->original_price;
                                    }
                                    $off =
                                        $original_price > 0
                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                            : 0;
                                @endphp
                                <div class="col-md-6 col-lg-4">
                                    <div class="card product-card-side p-0 h-100 border-0 bg-white shadow">
                                        <div class="img-wrap h-100 position-relative">
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $productdata->slug) }}">
                                                <img src="{{ $productdata['product_image']->image_url }}"
                                                    class="w-100 h-100 img-fluid object-fit-cover img-1" alt="">
                                                <img src="{{ $productdata['multi_image']->count() > 1 ? $productdata['multi_image'][1]->image_url : $productdata['multi_image'][0]->image_url }}"
                                                    class="w-100 img-2" alt="">
                                            </a>

                                            @if ($off > 0)
                                                <div
                                                    class="{{ session()->get('direction') == 2 ? 'offer-rtl' : 'offer' }}">
                                                    {{ $off }}% OFF</div>
                                            @endif
                                        </div>
                                        <div class="card-body content-box w-100 p-xl-3 p-2">
                                            <div class="d-flex align-items-center justify-content-between mb-md-2">
                                                <p class="card-title fs-8 text-secondary m-0 text-truncate">
                                                    {{ @$productdata['category_info']->name }}
                                                </p>
                                                @if (@helper::checkaddons('product_reviews'))
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <p class="fs-8">
                                                                <i class="text-warning fa-solid fa-star px-1"></i>
                                                                <span
                                                                    class="text-dark fw-500">{{ number_format($productdata->ratings_average, 1) }}</span>
                                                            </p>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $productdata->slug) }}">
                                                <h5 class="truncate-2 mb-3 text-dark product-name line-2 h-40">
                                                    {{ $productdata->name }}
                                                </h5>
                                            </a>
                                            <h6 class="text-dark fs-7 fw-semibold m-0 product-price text-truncate">
                                                {{ helper::currency_formate($price, $productdata->vendor_id) }}
                                                @if ($original_price > $price)
                                                    <del
                                                        class="text-muted fs-8 fw-500 fw-normal">{{ helper::currency_formate($original_price, $productdata->vendor_id) }}</del>
                                                @endif
                                            </h6>

                                            <!-- options -->
                                            <ul
                                                class="option-wrap d-flex align-items-center d-grid gap-3 product_icon2 mt-2">
                                                @if (@helper::checkaddons('customer_login'))
                                                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                        <li tooltip="Wishlist" class="rounded-circle">
                                                            <a onclick="managefavorite('{{ $productdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                class="option-btn circle-round wishlist-btn">
                                                                @if (Auth::user() && Auth::user()->type == 3)
                                                                    @php

                                                                        $favorite = helper::ceckfavorite(
                                                                            $productdata->id,
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
                                                <li tooltip="View" class="rounded-circle">
                                                    <a class="circle-round wishlist-btn"
                                                        onclick="productview('{{ $productdata->id }}')">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                @if (helper::appdata($vendordata->id)->online_order == 1)
                                                    <li tooltip="Add To Cart" class="rounded-circle">
                                                        @if ($productdata->has_variation == 1)
                                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $productdata->slug) }}"
                                                                class="circle-round addtocart-btn wishlist-btn">
                                                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                            </a>
                                                        @else
                                                            <a class="circle-round addtocart-btn  wishlist-btn"
                                                                onclick="calladdtocart('{{ $productdata->id }}','{{ $productdata->slug }}','{{ $productdata->name }}','{{ $productdata['product_image'] == null ? 'product.png' : $productdata['product_image']->image }}','{{ $productdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endif
                                            </ul>
                                            <!-- options -->

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!---------------------------------------------------- testimonial start ---------------------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial title mb-md-5 mb-3 border-0">
                    <div class="container">
                        <div class="mb-5 text-center">
                            <span class="category-title p-0">{{ trans('labels.testimonials') }}
                            </span>
                            <p class="fs-7 text-muted fw-normal">{{ trans('labels.testimonial_subtitle') }}</p>
                        </div>

                        <div id="testimonial2" class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item p-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-2">
                                                    <div class="review_images m-auto">
                                                        <img src="{{ helper::image_path($testimonial->image) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <div class="avatar-content px-2">
                                                        <div class="name-box d-flex pb-2 border-bottom">
                                                            <div
                                                                class="d-flex justify-content-center justify-content-md-start align-items-center w-100 py-2">
                                                                <div>
                                                                    <p class="pb-0 text-truncate fw-500 text-capitalize">
                                                                        {{ $testimonial->name }}</p>
                                                                    <h5
                                                                        class="text-primary fs-15 pb-2 text-capitalize text-truncate">
                                                                        {{ $testimonial->position }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p
                                                            class="fw-normal fs-7 pt-2 mb-2 text-center text-md-start text-capitalize">
                                                            {{ $testimonial->description }}
                                                        </p>
                                                        <div class="row justify-content-between align-items-center">
                                                            <div
                                                                class="col-12 col-md-6 d-flex justify-content-md-start justify-content-center">
                                                                <div>

                                                                    @php
                                                                        $count = (int) $testimonial->star;
                                                                    @endphp
                                                                    <p
                                                                        class="d-flex d-grid gap-1 align-items-center star_rating">
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            @if ($i < $count)
                                                                                <i
                                                                                    class="fa-solid fa-star text-warning"></i>
                                                                            @else
                                                                                <i
                                                                                    class="fa-regular fa-star text-warning"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-12 col-lg-6 d-flex align-items-end justify-content-lg-end justify-content-sm-start pt-1 pt-lg-0">
                                                                <div class="mx-md-0 mx-auto">
                                                                    <i class="fa-regular fa-clock text-muted fs-7"></i>
                                                                    <span
                                                                        class="pb-0 text-muted fs-7 fw-400 text-capitalize">{{ helper::date_formate($testimonial->created_at, $testimonial->vendor_id) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </div>
                </section>
            @endif
        @endif

        <!---------------------------------------------------- testimonial end ---------------------------------------------------->

        <!-------------------------------------------- theme-2-offer-banner-3-section start ------------------------------------------>
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-2-offer-banner-3 mb-5">
                <div class="container-fluid">
                    <div class="offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        @foreach ($getbannerslist['bannersection3'] as $banner)
                            <div class="item">
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
                                <img src="{{ $banner['image'] }}" alt="banner-3" class="object-fit-cover rounded">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!-------------------------------------------- theme-2-offer-banner-3-section end ------------------------------------------>

        <!----------------------------------------------------- top deals start ----------------------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="deals2 bg-secondary-rgb mb-5" id="topdeals">
                        <div class="container py-5">
                            <div class="title d-lg-flex align-items-center justify-content-between pb-3">
                                <div class="text-center text-md-start mb-3 mb-md-0">
                                    <span
                                        class="category-title text-dark p-0">{{ trans('labels.home_page_top_deals_subtitle') }}</span>
                                    <p class="fs-7 text-muted fw-normal">
                                        {{ trans('labels.home_page_top_deals_title') }}</p>
                                    <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                        class="btn btn-sm btn-outline-secondary mt-2">{{ trans('labels.viewall') }}
                                        <i
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                                    </a>
                                </div>
                                <div id="countdown"></div>
                            </div>

                            <div id="top-deals2" class="owl-carousel owl-theme owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage">
                                        @foreach ($topdealsproducts as $products)
                                            <div class="owl-item overflow-hidden">
                                                @php
                                                    if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                                        $price =
                                                            $products->price -
                                                            @helper::top_deals($vendordata->id)->offer_amount;
                                                    } else {
                                                        $price =
                                                            $products->price -
                                                            $products->price *
                                                                (@helper::top_deals($vendordata->id)->offer_amount /
                                                                    100);
                                                    }
                                                    $original_price = $products->price;
                                                    $off =
                                                        $original_price > 0
                                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                                            : 0;
                                                @endphp
                                                <div class="item h-100">
                                                    <a
                                                        href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1') }}">
                                                        <div
                                                            class="card bg-white border-0 bg-transparent h-100 theme-2-card pro-menu {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                                            <div class="card-img position-relative">
                                                                <img src="{{ $products['product_image']->image_url }}"
                                                                    class="card-img-top img-fluid object-fit-cover img-1"
                                                                    alt="product-1">
                                                                <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                                    class="w-100 img-2" alt="">
                                                                @if ($off > 0)
                                                                    <div
                                                                        class="{{ session()->get('direction') == 2 ? 'offer-rtl' : 'offer' }}">
                                                                        {{ $off }}%
                                                                        {{ trans('labels.off') }}</div>
                                                                @endif
                                                                <!-- options -->
                                                                <ul
                                                                    class="option-wrap {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                                                    @if (@helper::checkaddons('customer_login'))
                                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                            <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }}  rounded-circle"
                                                                                data-tooltip="Wishlist">
                                                                                <a onclick="managefavorite('{{ $productdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                                    class="circle-round wishlist-btn">
                                                                                    @if (Auth::user() && Auth::user()->type == 3)
                                                                                        @php

                                                                                            $favorite = helper::ceckfavorite(
                                                                                                $productdata->id,
                                                                                                $vendordata->id,
                                                                                                Auth::user()->id,
                                                                                            );

                                                                                        @endphp
                                                                                        @if (!empty($favorite) && $favorite->count() > 0)
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        @else
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        @endif
                                                                                    @else
                                                                                        <i class="fa-regular fa-heart"></i>
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                    <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle"
                                                                        data-tooltip="View">
                                                                        <a class="circle-round wishlist-btn"
                                                                            onclick="productview('{{ $products->id }}')">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                                        <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle"
                                                                            data-tooltip="Add To Cart">
                                                                            @if ($products->has_variation == 1)
                                                                                <a href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                                    class="circle-round addtocart-btn wishlist-btn">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            @else
                                                                                <a class="circle-round addtocart-btn  wishlist-btn"
                                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            @endif
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                                <!-- options -->

                                                            </div>
                                                            <div class="card-body px-0">
                                                                <h5
                                                                    class="card-title text-secondary fs-7 mb-1 text-truncate  text-capitalize">
                                                                    {{ @$products['category_info']->name }}
                                                                </h5>
                                                                <a
                                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1') }}">
                                                                    <p class="card-text text-dark fw-600 line-2 fs-7">
                                                                        {{ $products->name }}
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <div class="card-footer px-0">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <h5
                                                                        class="text-dark fs-7 fw-semibold m-0 product-price text-truncate">
                                                                        {{ helper::currency_formate($price, $products->vendor_id) }}
                                                                        @if ($original_price > $price)
                                                                            <del
                                                                                class="text-muted fs-8 fw-500 fw-normal">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                                        @endif
                                                                    </h5>
                                                                    @if (@helper::checkaddons('product_reviews'))
                                                                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                                            <p class="fs-8"><i
                                                                                    class="text-warning fa-solid fa-star px-1"></i><span
                                                                                    class="text-dark fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                                            </p>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif
        <!----------------------------------------------------- top deals end ----------------------------------------------------->

        <!----------------------------------------------------- app downlode start ----------------------------------------------------->
        @if (!empty($appsection))
            <section class="mb-5">
                <div class="container">
                    <div class="row g-xl-5 g-lg-3 g-2 align-items-center justify-content-center py-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-2 m-0 fw-bold text-dark">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-dark">{{ @$appsection->subtitle }}</p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <a href="{{ @$appsection->android_link }}"> <img
                                        src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg') }}"
                                        class="g-play" alt=""> </a>
                                <!-- App store button -->
                                <a href="{{ @$appsection->ios_link }}"> <img
                                        src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg') }}"
                                        class="g-play" alt=""> </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 p-0 d-none d-lg-block position-relative">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="{{ helper::image_path(@$appsection->image) }}"
                                    class="h-500px w-100 object-fit-cover " alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------------------------- app downlode end ----------------------------------------------------->

        <!------------------------------------------------ thetem-2-blog-section ------------------------------------------------>
        @if (@helper::checkaddons('subscription'))
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
                        <section class="theme-2-blog mb-5">
                            <div class="container">
                                <div class="title d-flex align-items-center justify-content-between pb-3">
                                    <div>
                                        <span class="category-title p-0">{{ trans('labels.featured_blogs') }}</span>
                                        <p class="fs-7 text-muted fw-normal">{{ trans('labels.blog_title') }}</p>
                                    </div>
                                    <a href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                                        class="btn btn-sm btn-outline-secondary category-button">{{ trans('labels.viewall') }}<i
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i>
                                    </a>
                                </div>
                                <div class="blogs-carousel owl-carousel owl-theme">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="item py-3 px-sm-2">
                                            <div class="card rounded h-100 border-0">
                                                <img src="{{ helper::image_path($blog->image) }}" height="230"
                                                    class="card-img-top object-fit-cover" alt="blog-img">
                                                <div class="card-body px-0 pb-2">
                                                    <h5 class="card-title m-0 product-line">
                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                    </h5>
                                                    <div class="pt-2 fs-7 line-2">
                                                        {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                    </div>
                                                </div>
                                                <div class="card-footer px-0">
                                                    <p class="fs-8"> <i class="fa-regular fa-clock"></i>
                                                        <span>{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                    </p>

                                                    <a href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                        class="fs-15 text-center category-button">{{ trans('labels.readmore') }}
                                                        <i
                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long me-2' : 'fa-solid fa-arrow-right-long me-2' }}"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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

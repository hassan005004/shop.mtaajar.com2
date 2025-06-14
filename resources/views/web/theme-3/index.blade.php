@extends('web.layout.default')
@section('contents')
    <!---------------------------------------------- theme-3-slider-main-section ---------------------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-3-slider">
            <div class="owl-carousel theme3-main-slaider owl-theme bg-light">
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
                            <img src="{{ $slider['image'] }}" alt="home banner" class="w-100 object-fit-cover">
                            <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <h5
                                        class="text-white mb-md-2 mb-1 text-uppercase ls-3 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        {{ $slider['title'] }}</h5>
                                    <h2
                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle line-2 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        {{ $slider['sub_title'] }}</h2>
                                    <p
                                        class="text-white fs-18 mb-md-4 mb-2 line-3 home-description {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        {{ $slider['description'] }}</p>

                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}" alt="home banner" class="w-100 object-fit-cover">
                            <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <h5
                                        class="text-white mb-md-2 mb-1 text-uppercase ls-3 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        {{ $slider['title'] }}</h5>
                                    <h2
                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle line-2 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        {{ $slider['sub_title'] }}</h2>
                                    <p
                                        class="text-white fs-18 mb-md-4 mb-2 line-3 home-description {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        {{ $slider['description'] }}</p>
                                    <div class="d-flex ">
                                        @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                            @if ($slider['type'] == 1)
                                                <a class="btn btn-fashion rounded-5"
                                                    href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                @elseif($slider['type'] == 2)
                                                    <a class="btn btn-fashion rounded-5"
                                                        href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                    @elseif($slider['type'] == 3)
                                                        <a class="btn btn-fashion rounded-5"
                                                            href="{{ $slider['custom_link'] }}" target="_blank">
                                                        @else
                                                            <a class="btn btn-fashion rounded-5" href="javascript:void(0)">
                                            @endif{{ $slider['link_text'] }}<i
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2' }}"></i></a>
                                        @endif
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

        <!-------------------------------------------- theme-3-offer-banner-1-section ------------------------------------------>
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-3-offer-banner-1 my-5">
                <div class="container">
                    <div class="theme-3-offer-banner-1-carousel owl-carousel owl-theme">
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

        <!---------------------------------------------- theme-3-category-section ---------------------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-3-category my-5">

                <div class="container">

                    <div class="theme-3-title">

                        <h2 class="fw-bold">{{ trans('labels.choose_by_category') }}</h2>

                        <p class="text-muted fw-500">{{ trans('labels.homepage_category_subtitle') }}</p>

                    </div>

                    <div class="theme-3-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                <div class="item">

                                    <div class="category-img">

                                        <img src="{{ helper::image_path($categorydata->image) }}"
                                            class="w-100 rounded-circle h-100 object-fit-cover" alt="category-image">

                                    </div>

                                    <div class="category-content">

                                        <span
                                            class="py-2 d-block fs-15 fw-medium text-truncate">{{ $categorydata['name'] }}</span>

                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>

                    <div class="text-center mt-4">

                        <a class="btn btn-sm btn-primary rounded-5 px-4 py-2"
                            href="{{ URL::to(@$vendordata->slug . '/categories') }}">

                            {{ trans('labels.viewall') }}<i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i>

                        </a>

                    </div>

                </div>

            </section>
        @endif

        <!---------------------------------------- theme-3-best-Selling-Products-section ---------------------------------------->

        @if (count($getbestsellingproducts) > 0)
            <section class="theme-3-best-Selling-product my-5 card-img-2">
                <div class="container">
                    <div class="theme-3-title">
                        <h2 class="fw-bold">{{ trans('labels.best_selling_products') }}</h2>
                        <p class="text-muted fw-500">{{ trans('labels.homepage_product_subtitle') }}</p>
                    </div>

                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-md-4 g-3">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-3.productcomonview')
                        @endforeach
                    </div>
                    <div class="text-center mt-4">

                        <a class="btn btn-sm btn-primary rounded-5 px-4 py-2"
                            href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">

                            {{ trans('labels.viewall') }}<i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i>

                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-------------------------------------------------- new top-bar-offer -------------------------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            @include('web.coupon.index')
        @endif

        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        <section class="who-we-are bg-light py-md-5 py-3 mb-md-5 mb-3">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-6 order-2 order-lg-0">
                        <span
                            class="wdt-heading-subtitle text-truncate mb-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                        <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}</h4>
                        <p class="wdt-heading-content-wrapper line-2">
                            {{ helper::appdata($vendordata->id)->whoweare_description }}</p>
                        <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3">
                            @foreach ($whoweare as $item)
                                <div class="d-flex gap-2 align-items-md-center align-items-start mb-xl-4 mb-lg-2 mb-2">
                                    <img src="{{ helper::image_path($item->image) }}"
                                        class="icon-lg bg-success bg-opacity-10 text-success rounded-circle" alt="">
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

        <!--------------------------------------------- theme-3-new-product-section --------------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-3-new-product my-5">

                <div class="container">

                    <div class="theme-3-title">

                        <h2 class="fw-bold">{{ trans('labels.new_arrival_products') }}</h2>

                        <p class="text-muted fw-500">{{ trans('labels.homepage_newarrivalprodect_title') }}</p>

                    </div>

                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">

                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @php
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
                            @endphp
                            <div class="col">
                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">

                                    <div class="item h-100">
                                        <div
                                            class="card border-0 overflow-hidden pro-menu {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                            <div class="item-img position-relative">
                                                <img src="{{ $getproductdata['product_image']->image_url }}"
                                                    alt="" class="img-1">

                                                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                                                    class="w-100 img-2" alt="">

                                                <!-- options -->
                                                <ul
                                                    class="option-wrap {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle mb-2"
                                                                data-tooltip="Wishlist">
                                                                <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                    class="option-btn circle-round wishlist-btn">
                                                                    @if (Auth::user() && Auth::user()->type == 3)
                                                                        @php

                                                                            $favorite = helper::ceckfavorite(
                                                                                $getproductdata->id,
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
                                                    <li data-tooltip="View"
                                                        class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle mb-2">
                                                        <a class="option-btn circle-round wishlist-btn"
                                                            onclick="productview('{{ $getproductdata->id }}')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle mb-2"
                                                            data-tooltip="Add To Cart">
                                                            @if ($getproductdata->has_variation == 1)
                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                                                    class="option-btn circle-round addtocart-btn wishlist-btn">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            @else
                                                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                </ul>
                                                <!-- options -->
                                            </div>

                                            <div class="card-body item-content px-0 pt-3 pb-0">

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="item-title text-secondary fs-8 text-truncate cursor-auto">
                                                        {{ @$getproductdata['category_info']->name }}</p>
                                                    @if (@helper::checkaddons('product_reviews'))
                                                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                            <p class="fs-8 d-flex">
                                                                <i class="text-warning fa-solid fa-star px-1"></i>
                                                                <span
                                                                    class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                                                            </p>
                                                        @endif
                                                    @endif

                                                    @if ($off > 0)
                                                        <div
                                                            class="offer-3 cursor-auto {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                                            {{ $off }}% {{ trans('labels.off') }}</div>
                                                    @endif
                                                </div>
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                                                    <p class="item-brand fw-600 fs-7 line-2">{{ $getproductdata->name }}
                                                    </p>
                                                </a>
                                                <h6
                                                    class="text-dark fw-semibold fs-7 product-price-size my-2 cursor-auto text-truncate">

                                                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                                                    @if ($original_price > $price)
                                                        <del
                                                            class="text-muted fs-8 fw-500 d-block mt-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    <div class="text-center mt-4">
                        <a class="btn btn-sm btn-primary rounded-5 px-4 py-2"
                            href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">

                            {{ trans('labels.viewall') }}
                            <i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!------------------------------------------- theme-3-offer-banner-2-section ------------------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-3-offer-banner-3">

                <div class="container">

                    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade rounded-5"
                        data-bs-ride="carousel">

                        <div class="carousel-inner">
                            @foreach ($getbannerslist['bannersection2'] as $key => $banner)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="2500">
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
                                    <img src="{{ $banner['image'] }}" class="d-block w-100 object-fil-cover rounded-5"
                                        alt="...">
                                    </a>
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

        <!-------------------------------------------------- TESTIMONIAL START -------------------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial mt-5">
                    <div class="container position-relative">
                        <div class="theme-3-title">
                            <h2 class="fw-bold">{{ trans('labels.testimonial_subtitle') }}</h2>
                            <p class="text-muted fw-500">{{ trans('labels.testimonials') }}</p>
                        </div>
                        <div id="testimonial3" class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="card h-100 rounded-4 shadow border-0 text-center my-4 mx-lg-3 mx-2">
                                        <div class="card-body">
                                            <div class="client-profile">
                                                <img src="{{ helper::image_path($testimonial->image) }}"
                                                    class="w-100 client-img mb-3" alt="">
                                                <p class="client-name pb-3  text-capitalize fs-7 text-truncate">
                                                    {{ $testimonial->name }} -
                                                    <span class="profession"> {{ $testimonial->position }}</span>
                                                </p>

                                            </div>
                                            <p class="fs-7 description mb-3">“ {{ $testimonial->description }}”</p>
                                            <ul>
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


        <!------------------------------------------- theme-3-offer-banner-3-section ------------------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-3-offer-banner-3 my-5">

                <div class="container-fluid">

                    <div class="theme-3-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
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

                                <img src="{{ $banner['image'] }}" alt="banner-3" class="object-fit-cover rounded-5">

                                </a>

                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!----------------------------------------------------- DEALS START ----------------------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="deals3 bg-primary-rgb mb-5 card-img-2" id="topdeals">
                        <div class="container py-100">
                            <div class="row align-items-center">
                                <div class="col-xl-4 col-12 mb-xl-0 mb-3">
                                    <div class="mb-4 theme-3-title">
                                        <h3 class="fw-bold">{{ trans('labels.home_page_top_deals_subtitle') }}</h3>
                                        <p class="text-muted fw-500">{{ trans('labels.home_page_top_deals_title') }}
                                        </p>
                                    </div>
                                    <div id="countdown" class="my-md-5 my-3"></div>
                                    <div class="text-center">
                                        <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                            class="btn btn-sm btn-primary rounded-5 px-4 py-2 mt-2">{{ trans('labels.viewall') }}
                                            <i
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2' }}"></i></a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-12">
                                    <div id="top-deals3" class="owl-carousel owl-theme">
                                        @foreach ($topdealsproducts as $products)
                                            @php
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
                                            @endphp

                                            <div class="item h-100">
                                                <div class="item bg-white mx-sm-2 rounded-4 h-100">
                                                    <div
                                                        class="card border rounded-4 bg-transparent h-100 overflow-hidden pro-menu {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">

                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">

                                                            <div class="item-img position-relative">

                                                                <img src="{{ $products['product_image']->image_url }}"
                                                                    alt="" class="rounded-4 img-1">

                                                                <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                                    class="w-100 img-2" alt="">


                                                                <!-- options -->
                                                                <ul
                                                                    class="option-wrap {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                                                    @if (@helper::checkaddons('customer_login'))
                                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                            <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle"
                                                                                data-tooltip="Wishlist">
                                                                                <a onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                                    class="option-btn circle-round wishlist-btn">
                                                                                    @if (Auth::user() && Auth::user()->type == 3)
                                                                                        @php

                                                                                            $favorite = helper::ceckfavorite(
                                                                                                $products->id,
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
                                                                        <a class="option-btn circle-round wishlist-btn"
                                                                            onclick="productview('{{ $products->id }}')">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                                        <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle"
                                                                            data-tooltip="Add To Cart">
                                                                            @if ($products->has_variation == 1)
                                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                                    class="option-btn circle-round addtocart-btn wishlist-btn">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            @else
                                                                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
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
                                                        </a>

                                                        <div class="card-body pb-0">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-1">
                                                                <p
                                                                    class="item-title text-secondary fs-7 cursor-auto text-truncate">
                                                                    {{ @$products['category_info']->name }}</p>
                                                                @if (@helper::checkaddons('product_reviews'))
                                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                                        <p class="fs-7">
                                                                            <i
                                                                                class="text-warning fa-solid fa-star px-1"></i>
                                                                            <span
                                                                                class="text-dark fs-7 fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                                        </p>
                                                                    @endif
                                                                @endif

                                                                @if ($off > 0)
                                                                    <div
                                                                        class="offer-3 cursor-auto {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                                                                        {{ $off }}% {{ trans('labels.off') }}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <a
                                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                <p class="item-brand fw-600 line-2">
                                                                    {{ $products->name }}</p>
                                                            </a>
                                                        </div>

                                                        <div class="card-footer">
                                                            <h6
                                                                class="text-dark fw-semibold product-price-size py-2 cursor-auto text-truncate">

                                                                {{ helper::currency_formate($price, $products->vendor_id) }}
                                                                @if ($original_price > $price)
                                                                    <del
                                                                        class="text-muted fs-8 fw-normal mt-1">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                                @endif
                                                            </h6>
                                                        </div>
                                                    </div>
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
        <!--------------------------------------------- app-downlode section start --------------------------------------------->
        @if (!empty($appsection))
            <section class="mb-5">
                <div class="container bg-light rounded-5 shdaow">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div class="col-xl-5 col-lg-6 m-sm-0 p-0 d-none d-lg-block position-relative">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="{{ helper::image_path(@$appsection->image) }}"
                                    class="h-500px w-100 object-fit-cover " alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-2 m-0 fw-bold text-dark line-2">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-dark line-2">{{ @$appsection->subtitle }}</p>
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
                    </div>
                </div>
            </section>
        @endif

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
                    <section class="theme-3-blog mb-5">
                        <div class="container">
                            <div class="theme-3-title">
                                <h2 class="fw-bold">{{ trans('labels.featured_blogs') }}</h2>
                                <p class="text-muted fw-500">{{ trans('labels.blog_title') }}</p>
                            </div>
                            <div class="row g-4 g-xl-5 justify-content-between">
                                @foreach (helper::getblogs(@$vendordata->id, '5', '') as $key => $blog)
                                    @if ($key == 0)
                                        <div class="col-lg-6">
                                            <div class="theme-3-blog-item">
                                                <div class="card border-0 bg-transparent h-100">
                                                    <img src="{{ helper::image_path($blog->image) }}"
                                                        class="card-img-top w-100 object-fit-cover rounded-4"
                                                        alt="blog-image">

                                                    <div class="card-body px-0">
                                                        <h6 class="card-title line-2 mb-1"> <a class="text-dark"
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                        </h6>
                                                        <div class="line-2 fs-7">
                                                            {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card-footer px-0 blog-footer d-flex justify-content-between align-items-center py-4">
                                                        <div class="text-primary fs-8"><i
                                                                class="fa-solid fa-calendar-days"></i><span
                                                                class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                        </div>
                                                        <a class="fw-semibold fs-15 text-primary-color fw-500"
                                                            href="{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}
                                                            <span class="mx-1">
                                                                <i
                                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long' }}"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        @else
                                            <div class="card border-0 bg-transparent mb-4">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-4 mb-4 mb-sm-0">
                                                        <div class="img-overlay rounded-4">
                                                            <img src="{{ helper::image_path($blog->image) }}"
                                                                class="card-img-top w-100 object-fit-cover rounded-4"
                                                                alt="blog-image">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h6 class="fw-600 mb-1 line-2"><a
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                                class="text-dark">{{ $blog->title }}</a></h6>
                                                        <div class="line-2 fs-7">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mt-2">
                                                            <div class="text-primary fs-8"><i
                                                                    class="fa-solid fa-calendar-days"></i><span
                                                                    class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                            </div>
                                                            <a class="fw-semibold fs-15 text-primary-color"
                                                                href="{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}<span
                                                                    class="mx-1"><i
                                                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long' }}"></i></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif
    </main>
@endsection

@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/index.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

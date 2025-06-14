@extends('web.layout.default')
@section('contents')
    <!------------------------------------------------ theme-8-slider-main-section ------------------------------------------------>
    @if (count($getsliderlist) > 0)
        <section class="theme-8-slider bg-primary-rgb-main-8 py-3">
            <div class="container">
                <div class="theme-8-main-banner owl-carousel owl-theme h-100">

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
                                <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid rounded-3"
                                    alt="">
                                <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-12 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3">
                                                {{ $slider['title'] }}
                                            </h5>
                                            <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle">
                                                {{ $slider['sub_title'] }}
                                            </h2>
                                            <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                                {{ $slider['description'] }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                </a>
                            @else
                                <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid rounded-3"
                                    alt="">
                                <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-12 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3">
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
                                                        <a class="btn btn-fashion rounded-3"
                                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                        @elseif($slider['type'] == 2)
                                                            <a class="btn btn-fashion rounded-3"
                                                                href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                            @elseif($slider['type'] == 3)
                                                                <a class="btn btn-fashion rounded-3"
                                                                    href="{{ $slider['custom_link'] }}" target="_blank">
                                                                @else
                                                                    <a class="btn btn-fashion rounded-3"
                                                                        href="javascript:void(0)">
                                                    @endif{{ $slider['link_text'] }} <i
                                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2' }}"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <main class="bg-primary-rgb-main-8 theme-8">

        <!---------------------------------------------- theme-8-offer-banner-1-section -------------------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-8-offer-banner-1 py-md-5 py-4  bg-primary-rgb-dark">
                <div class="container">
                    <div class="theme-8-offer-banner-1-carousel owl-carousel owl-theme">
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

        <!------------------------------------------------ theme-8-category-section ------------------------------------------------>
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-8-category mb-4 m-md-5 mt-4">
                <div class="container">
                    <div class="row justify-content-between align-items-center mb-md-5 mb-3">
                        <div class="col-auto  mb-md-0 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="col-auto">
                                    <div class="title-line-3"></div>
                                </div>
                                <p class="fs-6 text-uppercase text-white fw-500 px-2">
                                    {{ trans('labels.homepage_category_subtitle') }}
                                </p>
                            </div>
                            <div class="col-auto">
                                <span
                                    class="wdt-heading-title line-1 text-truncate text-capitalize m-0">{{ trans('labels.choose_by_category') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-secondary rounded-3 fs-7 category-button px-3 py-2"
                                href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                    <div
                        class="theme-8-category-slider {{ session()->get('direction') == 2 ? 'rtl' : '' }} owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item h-100">
                                <div
                                    class="card h-100 shadow-none outline-none rounded-3 bg-primary-rgb-card color-background-2  border-0 overflow-hidden">
                                    <div class="cat-img-8">
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                            <img src="{{ helper::image_path($categorydata->image) }}"
                                                class="w-100 object-fit-cover rounded-0 cat-img-8" alt="category image"></a>
                                    </div>
                                    <div class="card-body px-sm-3 px-1 text-center">
                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="card-title text-white fs-15 choose-by-category-name line-2 m-0">{{ $categorydata['name'] }}</a
                                            href="#">
                                        <p class="text-lightslategray fs-13">{{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-------------------------------------------------- new top-bar-offer -------------------------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            <div class="overflow-hidden offers-theme-8">
                <div class="offer-badge-8 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                    {{ trans('labels.best_offers') }}
                </div>
                <div class="text-secondary ">
                    @include('web.coupon.index')
                </div>
            </div>
        @endif

        <!---------------------------------------- theme-8-best-Selling-Products-section ---------------------------------------->
        <section class="theme-8-best-Selling-product py-md-5 py-4">
            <div class="container">
                <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                    <div class="mb-md-0 mb-2 col-auto">
                        <div class="d-flex align-items-center ">
                            <div class="title-line-3"></div>
                            <p class="fs-6 text-uppercase fw-500 text-white px-2 ">
                                {{ trans('labels.homepage_product_subtitle') }}
                            </p>
                        </div>
                        <span
                            class="wdt-heading-title text-truncate text-capitalize">{{ trans('labels.best_selling_product') }}</span>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2"
                            href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                            {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                    @foreach ($getbestsellingproducts as $getproductdata)
                        @include('web.theme-8.productcomonview')
                    @endforeach
                </div>
            </div>
        </section>
        <!------------------------------------------- WHO WE ARE ------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-primary-rgb-dark py-md-5 py-3">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2 text-white">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2 text-lightslategray">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="pb-0">
                                @foreach ($whoweare as $item)
                                    <div class="align-items-start mb-xl-4 mb-lg-2 mb-3">
                                        <div class="d-flex align-items-center py-2 col-12 ">
                                            <div class="">
                                                <img src="{{ helper::image_path($item->image) }}"
                                                    class="icon-lg bg-success col-3 bg-opacity-10 text-success rounded-circle p-1"
                                                    alt="">
                                            </div>

                                            <h4 class="px-2 col-xl-9 col-lg-12 col-md-9 text-white">{{ $item->title }}
                                            </h4>
                                        </div>
                                        <p class="mb-0 line-2 fs-7 text-lightslategray">{{ $item->sub_title }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="w-100 object-fit-cover rounded-3" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------------------- theme-8-offer-banner-2-section ---------------------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-8-offer-banner-3 py-5">
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
                                    <img src="{{ $banner['image'] }}" class="d-block w-100 object-fit-cover rounded-3"
                                        alt="..."></a>
                                </div>
                            @endforeach
                        </div>
                        @if (count($getbannerslist['bannersection2']) > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left slider-arrows rounded-circle"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows rounded-circle"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.next') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------------- theme-8-new-product-section ---------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-8-new-product py-md-5 py-3 bg-gradient-primary">
                <div class="container">
                    <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                        <div class="mb-md-0 mb-2 col-auto">
                            <div class="d-flex align-items-center">
                                <div class="title-line-3"></div>
                                <p class="fs-6 text-uppercase text-white fw-500 specks-subtitle px-2">
                                    {{ trans('labels.new_arrival_product_subtitle') }}
                                </p>
                            </div>
                            <span
                                class="wdt-heading-title text-truncate text-capitalize">{{ trans('labels.new_arrival_products') }}</span>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2"
                                href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 p-0 g-sm-3 g-2">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-8.productcomonview')
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!--------------------------------- theme-8-offer-banner-3-section ------------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-8-offer-banner-3 py-md-5 py-4">
                <div class="container">
                    <div
                        class="theme-8-offer-banner-3-carousel {{ session()->get('direction') == 2 ? 'rtl' : '' }} owl-carousel owl-theme">
                        @foreach ($getbannerslist['bannersection3'] as $banner)
                            <div class="item ">
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
                                <img src="{{ $banner['image'] }}" alt="banner-3" class="object-fit-cover rounded-3">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!--------------------------------------------- DEALS START --------------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="theme-8-deals py-sm-100 py-4" id="topdeals">
                        <div class="container bg-secondary-rgb rounded-5 bg-border border-secondary-color">
                            <div class="row justify-content-between align-items-center mb-md-5 mb-4 px-sm-2 pt-sm-5 pt-4">
                                <div class="text-uppercase mb-md-0 mb-2 col-auto">
                                    <div class="d-flex align-items-center">
                                        <div class="title-line-3"></div>
                                        <p class="text-white fw-500 text-truncate px-2">
                                            {{ trans('labels.home_page_top_deals_title') }}
                                    </div>
                                    </p>
                                    <span
                                        class="wdt-heading-title text-truncate text-capitalize">{{ trans('labels.home_page_top_deals_subtitle') }}</span>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                        class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2">{{ trans('labels.viewall') }}
                                        <i
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div id="countdown"
                                    class="card col-auto mx-auto mb-md-5 mb-4 p-0 countdown-border rounded-3"> </div>

                                <div id="top-deals8"
                                    class="owl-carousel owl-theme pb-sm-4 pb-3 top-deals8 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                    @foreach ($topdealsproducts as $products)
                                        @php
                                            if (@$topdeals->offer_type == 1) {
                                                $price = $products->price - @$topdeals->offer_amount;
                                            } else {
                                                $price =
                                                    $products->price -
                                                    $products->price * (@$topdeals->offer_amount / 100);
                                            }
                                            $original_price = $products->price;
                                            $off =
                                                $original_price > 0
                                                    ? number_format(100 - ($price * 100) / $original_price, 1)
                                                    : 0;
                                        @endphp
                                        <div class="item h-100 bg-white rounded-4">
                                            <div class="card bg-primary-rgb-card rounded-3 h-100 overflow-hidden border-0">
                                                <div class="card-img position-relative">
                                                    <a
                                                        href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                        <img src="{{ $products['product_image']->image_url }}"
                                                            class="w-100 h-100 img-fluid object-fit-cover img-1"
                                                            alt="">
                                                        <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                            class="w-100 img-2 object-fit-cover" alt="">
                                                    </a>
                                                    @if ($off > 0)
                                                        <div
                                                            class="sale-label-8 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                            {{ $off }}% {{ trans('labels.off') }}</div>
                                                    @endif
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <div class="w-100 theme-8-cart">
                                                            @if ($products->has_variation == 1)
                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                    class="option-btn addtocart-btn rounded-0 text-dark">
                                                                    <div class="product-cart-button w-100">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        <p class="px-2 fw-500 fs-7 text-capitalize">
                                                                            {{ trans('labels.add_to_cart') }}</p>
                                                                    </div>
                                                                </a>
                                                            @else
                                                                <a class="option-btn addtocart-btn rounded-0 cursor-pointer"
                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                    <div class="product-cart-button w-100 text-dark">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        <p class="px-2 fw-500 fs-7 text-capitalize">
                                                                            {{ trans('labels.add_to_cart') }}</p>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    <!-- options -->
                                                    <ul
                                                        class="option-wrap justify-content-center align-items-center d-grid product_icon2 px-2 w-auto {{ session()->get('direction') == 2 ? 'rtl-8' : 'ltr-8' }}">
                                                        @if (@helper::checkaddons('customer_login'))
                                                            @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                <li data-tooltip="Wishlist"
                                                                    class="m-2 {{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }}">
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
                                                            class="m-2 {{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }}">
                                                            <a class="option-btn circle-round wishlist-btn rounded-0"
                                                                onclick="productview('{{ $products->id }}')">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!-- options -->
                                                </div>

                                                <div class="card-body px-3 pt-3 pb-0">

                                                    <div class="d-flex align-items-center justify-content-between mb-md-2">
                                                        <p class="card-title fs-8 text-lightslategray m-0 text-truncate">
                                                            {{ @$products['category_info']->name }}
                                                        </p>

                                                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                            <p class="fs-8">
                                                                <i class="text-warning fs-8 fa-solid fa-star px-1"></i>
                                                                <span
                                                                    class="text-lightslategray fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                            </p>
                                                        @endif

                                                    </div>

                                                    <a
                                                        href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                        <h5 class="text-white product-name line-2 h-42">
                                                            {{ $products->name }}
                                                        </h5>
                                                    </a>

                                                </div>
                                                <div class="card-footer px-3 py-2 ">

                                                    <h5
                                                        class="text-white fs-7 fw-semibold product-price-size cursor-auto text-truncate">

                                                        {{ helper::currency_formate($price, $products->vendor_id) }}
                                                        @if ($original_price > $price)
                                                            <del
                                                                class="fs-8 fw-500 d-block mt-1 text-lightslategray">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                        @endif
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif
        <!----------------------------------------- TESTIMONIAL START ----------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial py-sm-5">
                    <div class="container position-relative">
                        <span
                            class="wdt-heading-subtitle fs-6 text-white text-center text-truncate">{{ trans('labels.testimonials') }}</span>
                        <h4 class="wdt-heading-title text-center text-truncate">
                            {{ trans('labels.testimonial_subtitle') }}
                        </h4>
                        <div>
                            <div id="testimonial8"
                                class="owl-carousel owl-theme testimonial8 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                @foreach ($testimonials as $testimonial)
                                    <div class="item">
                                        <div
                                            class="bg-primary-rgb-card d-flex justify-content-center text-center p-4 mb-3 rounded-3">
                                            <div class="client-profile align-items-center ">
                                                <img src="{{ helper::image_path($testimonial->image) }}"
                                                    class="w-100 mx-auto theme-8-client-img mb-3" alt="">
                                                <div>
                                                    <p class="client-name text-white "> {{ $testimonial->name }} <span
                                                            class="profession fs-15 d-block">
                                                            {{ $testimonial->position }}</span></p>

                                                </div>
                                                <p class="fs-7 text-capitalize text-white my-3">“
                                                    {{ $testimonial->description }}”</p>
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
                    </div>
                </section>
            @endif
        @endif

        <!-------------------------------------------------- app downlode end ------------------------------------------------->
        @if (!empty($appsection))
            <section class="py-md-5 py-3">
                <div class="container rounded-0">
                    <div
                        class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5 bg-border border-white rounded-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-white">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-lightslategray line-2">{{ @$appsection->subtitle }}</p>
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
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
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
        <!--------------------------------------------------- theme-8-blog-section --------------------------------------------------->
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
                        <section class="theme-8-blog py-md-5 py-4">
                            <div class="container">
                                <div class="row justify-content-between align-items-center mb-md-4 mb-3">
                                    <div class="text-uppercase mb-md-0 mb-2 col-auto">
                                        <div class="d-flex align-items-center">

                                            <div class="title-line-3"></div>
                                            <p class="text-white fw-500 text-truncate px-2">
                                                {{ trans('labels.blog_title') }}
                                        </div>
                                        </p>
                                        <span
                                            class="wdt-heading-title text-truncate text-capitalize">{{ trans('labels.featured_blogs') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2"
                                            href="{{ URL::to(@$vendordata->slug . '/blogs') }}">
                                            {{ trans('labels.viewall') }}<span
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                        </a>
                                    </div>
                                </div>
                                @foreach (helper::getblogs(@$vendordata->id, '5', '') as $key => $blog)
                                    @if ($key == 0)
                                        <div class="row g-3 g-xl-4 justify-content-between pb-3">
                                        @else
                                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                                <div
                                                    class="card h-100 border-0 bg-primary-rgb-card rounded-3 overflow-hidden">
                                                    <img src="{{ helper::image_path($blog->image) }}"
                                                        class="products-img w-100 object-fit-cover" height="230"
                                                        alt="blog-image">
                                                    <div class="card-body pb-1">
                                                        <div
                                                            class="mb-2 {{ @helper::appdata(@$vendordata->id)->web_layout == 1 ? 'text-start' : 'text-end' }}">
                                                        </div>
                                                        <h6 class="card-title fw-600 mb-1 line-2"><a class=" text-white"
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                        </h6>
                                                        <div class="line-2 pt-1 fs-7 text-lightslategray">
                                                            {!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                    </div>
                                                    <div
                                                        class="card-footer d-flex align-items-center justify-content-between">
                                                        <div class="d-flex fs-8 text-lightslategray">
                                                            <i class="fa-regular fa-clock"></i>
                                                            <p class="text-lightslategray px-1">
                                                                {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                                            </p>
                                                        </div>
                                                        <a class="text-white fs-15 rounded-2"
                                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                            {{ trans('labels.readmore') }}<span
                                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                                        </a>
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
        @endif

    </main>
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/index.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

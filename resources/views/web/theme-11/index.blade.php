@extends('web.layout.default')
@section('contents')
    <!---------------------------------- theme-11-slider-main-section ---------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-11-slider">
            <div
                class="theme-11-main-banner slider-layer slider-bots text-animation owl-carousel owl-theme {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
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
                            <img src="{{ $slider['image'] }}"
                                class="w-100 object-fit-cover img-fluid theme-11-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-end mb-5 flex-column">
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-12 text-center">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-1">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-2">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-3 home-description animation-3">
                                            {{ $slider['description'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}"
                                class="w-100 object-fit-cover img-fluid theme-11-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-end mb-5 flex-column">
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-12 text-center">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-1">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-2">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-3 home-description animation-3">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                @if ($slider['type'] == 1)
                                                    <a class="btn btn-primary rounded-3"
                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                    @elseif($slider['type'] == 2)
                                                        <a class="btn btn-primary rounded-3"
                                                            href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                        @elseif($slider['type'] == 3)
                                                            <a class="btn btn-primary rounded-3"
                                                                href="{{ $slider['custom_link'] }}" target="_blank">
                                                            @else
                                                                <a class="btn btn-primary rounded-3"
                                                                    href="javascript:void(0)">
                                                @endif{{ $slider['link_text'] }} <i
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
    <main class="theme-11 bg-primary-rgb-main">
        <!---------------------------------- theme-11-category-section ---------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-11-category py-sm-5 py-4">
                <div class="container">
                    <div class="mb-md-5 mb-4 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="title-line"></div>
                            <p class="fs-6 text-uppercase text-muted fw-normal specks-subtitle mx-2">
                                {{ trans('labels.homepage_category_subtitle') }}
                            </p>
                            <div class="title-line"></div>
                        </div>
                        <span
                            class="fw-semibold wdt-heading-title text-dark text-truncate">{{ trans('labels.choose_by_category') }}</span>
                    </div>
                    <div class="theme-11-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="theme-11-item">
                                <div class="card h-100 shadow-none outline-none rounded-3 overflow-hidden border-0">
                                    <div class="cat-img">
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                            <img src="{{ helper::image_path($categorydata->image) }}"
                                                class="w-100 object-fit-cover" alt="category image"></a>
                                    </div>
                                    <div class="card-body text-center p-sm-2 p-1">
                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="card-title text-dark fs-15 choose-by-category-name">{{ $categorydata['name'] }}</a
                                            href="#">
                                        <p class="fs-13">{{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/categories') }}"> {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- WHO WE ARE ---------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-primary-rgb py-md-5 py-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <div class="d-flex align-items-center mb-2">
                                <div class="title-line"></div>
                                <span
                                    class="fs-6 text-truncate m-0 px-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                                <div class="title-line"></div>
                            </div>
                            <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="row g-sm-3 g-2">
                                @foreach ($whoweare as $item)
                                    <div class="col-sm-6">
                                        <div class="card border-secondary-color">
                                            <div class="card-body">
                                                <img src="{{ helper::image_path($item->image) }}"
                                                    class="icon-lg bg-opacity-10 text-success rounded-circle border border-2 border-primary-color"
                                                    alt="">
                                                <div class="pt-2">
                                                    <h5 class="mb-1 fw-600 text-truncate">{{ $item->title }}</h5>
                                                    <p class="mb-0 fs-7 line-2">{{ $item->sub_title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="w-100 object-fit-cover rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- theme-11-offer-banner-1-section ---------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-11-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="offer-banner-1-carousel owl-carousel owl-theme">
                        @foreach ($getbannerslist['bannersection1'] as $banner)
                            <div class="item">
                                <div class="rounded-3 ">
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
                                        class="w-100 h-100 rounded-3 object-fit-cover">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!---------------------------------- new top-bar-offer ---------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            <div class="overflow-hidden offers-theme-11">
                <div class="offer-badge-11 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                    {{ trans('labels.best_offers') }}
                </div>
                <div class="text-secondary ">
                    @include('web.coupon.index')
                </div>
            </div>
        @endif
        <!---------------------------------- theme-11-best-Selling-Products-section ---------------------------------->
        <section class="theme-11-best-Selling-product my-md-5 my-4">
            <div class="container">
                <div class="text-center mb-md-5 mb-4">
                    <div class="d-flex align-items-center mb-2 justify-content-center">
                        <div class="title-line"></div>
                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                            {{ trans('labels.homepage_product_subtitle') }}
                        </p>
                        <div class="title-line"></div>
                    </div>
                    <span class="text-dark wdt-heading-title line-1">{{ trans('labels.best_selling_product') }}</span>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                    @foreach ($getbestsellingproducts as $getproductdata)
                        @include('web.theme-11.productcomonview')
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-md-5 mt-4">
                    <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                        <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                            href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                            {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!----------------------------------- theme-11-offer-banner-2-section ----------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-11-offer-banner-3 py-5">
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
                                        class="fa-solid fa-arrow-left slider-arrows rounded-3"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows rounded-3"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.next') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------------- theme-11-new-product-section ----------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-11-new-product">
                <div class="container">
                    <div class="text-center mb-md-5 mb-4">
                        <div class="d-flex align-items-center mb-2 justify-content-center">
                            <div class="title-line"></div>
                            <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                            <div class="title-line"></div>
                        </div>
                        <span class="text-dark wdt-heading-title line-1">{{ trans('labels.new_arrival_products') }}</span>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @include('web.theme-11.productcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------- theme-11-offer-banner-3-section ----------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-11-offer-banner my-md-5 my-4">
                <div class="container-fluid">
                    <div class="offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        @foreach ($getbannerslist['bannersection3'] as $banner)
                            <div class="item">
                                <div class="rounded-3">
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
                                        class="object-fit-cover rounded-4 ">
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
                    <section class="theme-11-deals bg-primary-rgb py-sm-5 py-4 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="mb-md-5 mb-4 theme-3-title text-center">
                                <div class="d-flex align-items-center mb-2 justify-content-center">
                                    <div class="title-line"></div>
                                    <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                        {{ trans('labels.home_page_top_deals_title') }}
                                    </p>
                                    <div class="title-line"></div>
                                </div>
                                <span
                                    class="text-dark wdt-heading-title line-1">{{ trans('labels.home_page_top_deals_subtitle') }}</span>
                            </div>
                            <div class="row">
                                <div class="card col-auto mx-auto mb-md-5 mb-4 p-0 rounded-3 margin-sm p-1">
                                    <div id="countdown" class="countdown-border"> </div>
                                </div>
                            </div>
                            <div id="top-deals11" class="owl-carousel owl-theme carousel-items-2">
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
                                    <div class="item h-100 bg-white rounded-3 mx-1">
                                        <div
                                            class="card product-card-side p-0 h-100 border border-secondary-color bg-white rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                            <div class="deal-11 h-100 position-relative">
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                    <img src="{{ $products['product_image']->image_url }}"
                                                        class="object-fit-cover img-1 rounded-2" alt="">
                                                    <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                        class="w-100 img-2 rounded-2" alt="">
                                                </a>
                                                @if ($off > 0)
                                                    <div
                                                        class="off-label-11 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                        <div class="position-relative">
                                                            <div
                                                                class="sale-label-11 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                                {{ $off }}% {{ trans('labels.off') }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body content-box w-100 p-lg-3 p-2">
                                                <div
                                                    class="d-sm-flex align-items-center justify-content-between mb-md-2 mb-1">
                                                    <p class="card-title fs-8 text-lightslategray m-0 text-truncate">
                                                        {{ @$products['category_info']->name }}
                                                    </p>
                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                        <p class="fs-8 d-flex">
                                                            <i
                                                                class="text-warning fs-8 fa-solid fa-star {{ session()->get('direction') == 2 ? 'ps-1' : 'pe-1' }}"></i>
                                                            <span
                                                                class="text-dark fs-8 fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                        </p>
                                                    @endif
                                                </div>
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                    <h5 class="truncate-2 mb-3 text-dark product-name line-2 h-42">
                                                        {{ $products->name }}
                                                    </h5>
                                                </a>
                                                <h6 class="product-price text-dark d-inline-block m-0 text-truncate">
                                                    {{ helper::currency_formate($price, $products->vendor_id) }}
                                                    @if ($original_price > $price)
                                                        <del
                                                            class="
                                                                fs-8 fw-normal text-lightslategray">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                    @endif
                                                </h6>
                                                <!-- options -->
                                                <ul
                                                    class="option-wrap d-flex align-items-center d-grid gap-3 product_icon2 mt-2">
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li tooltip="Wishlist" class="rounded-3 shadow-lg">
                                                                <a onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                    class="option-btn circle-round rounded-3 wishlist-btn">
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
                                                    <li tooltip="{{ trans('labels.view') }}" class="rounded-3 shadow-lg">
                                                        <a class="option-btn circle-round rounded-3 wishlist-btn"
                                                            onclick="productview('{{ $products->id }}')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li tooltip="{{ trans('labels.add_to_cart') }}"
                                                            class="rounded-3 shadow-lg">
                                                            @if ($products->has_variation == 1)
                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                    class="option-btn circle-round rounded-3 addtocart-btn wishlist-btn">
                                                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                </a>
                                                            @else
                                                                <a class="option-btn circle-round rounded-3 addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
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
                            <div class="d-flex justify-content-center mt-md-4 mt-3">
                                <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                        class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">{{ trans('labels.viewall') }}
                                        <span
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif
        <!--------------------------------------- TESTIMONIAL START --------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial my-sm-5 my-4">
                    <div class="container position-relative py-3">
                        <div class="d-flex align-items-center mb-2 justify-content-center">
                            <div class="title-line"></div>
                            <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                {{ trans('labels.testimonials') }}</p>
                            <div class="title-line"></div>
                        </div>
                        <span
                            class="text-dark wdt-heading-title line-1 text-center text-truncate mb-sm-5 mb-4">{{ trans('labels.testimonial_subtitle') }}
                        </span>
                        <!-- testimonial slider start -->
                        <div id="testimonial11" class="owl-carousel owl-theme carousel-items-3">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100">
                                    <div class="rounded-4 h-100 p-1">
                                        <div class="d-flex justify-content-center mb-3 rounded-3 h-100">
                                            <div class="client-profile align-items-center">
                                                <div class="border border-primary-color px-3 py-4 rounded-3">
                                                    <p class="fs-7 description mb-2">“{{ $testimonial->description }}”
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
                                                <div class="d-flex align-items-center mx-4 mt-3">
                                                    <img src="{{ helper::image_path($testimonial->image) }}"
                                                        class="w-100 theme-11-client-img rounded-circle" alt="">
                                                    <div class="mx-3">
                                                        <p class="client-name"> {{ $testimonial->name }} <span
                                                                class="profession fs-7 d-block">
                                                                {{ $testimonial->position }}</span></p>

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

        <!---------------------------------------- app download end ---------------------------------------->
        @if (!empty($appsection))
            <section class="py-md-5 py-3">
                <div class="container rounded-0">
                    <div
                        class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5 bg-border bg-primary-rgb border-primary-color rounded-3">
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="{{ helper::image_path(@$appsection->image) }}"
                                    class="h-500px object-fit-cover w-100" alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-dark">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-lightslategray line-2">{{ @$appsection->subtitle }}</p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ @$appsection->android_link }}"> <img
                                            src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg') }}"
                                            class="g-play rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            alt=""> </a>
                                </div>
                                <!-- App store button -->
                                <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ @$appsection->ios_link }}"> <img
                                            src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg') }}"
                                            class="g-play rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            alt=""> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!--------------------------------------------------- theme-11-blog-section --------------------------------------------------->
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
                        <section class="theme-11-blog py-md-5 py-4">
                            <div class="container">
                                <div class="text-center mb-md-5 mb-4">
                                    <div class="d-flex align-items-center mb-2 justify-content-center">
                                        <div class="title-line"></div>
                                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                            {{ trans('labels.blog_title') }}
                                        </p>
                                        <div class="title-line"></div>
                                    </div>
                                    <span
                                        class="text-dark wdt-heading-title line-1">{{ trans('labels.featured_blogs') }}</span>
                                </div>
                                @foreach (helper::getblogs(@$vendordata->id, '5', '') as $key => $blog)
                                    @if ($key == 0)
                                        <div class="row g-xl-3 g-2 justify-content-between">
                                        @else
                                            <div class="col-sm-6">
                                                <div class="card border border-primary-color p-2 bg-primary-rgb rounded-3">
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-lg-4 col-5">
                                                            <div class="img-overlay rounded-4">
                                                                <img src="{{ helper::image_path($blog->image) }}"
                                                                    class="card-img-top w-100 object-fit-cover rounded-3 blog-height-11"
                                                                    alt="blog-image">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-7 p-2">
                                                            <h6 class="fw-bold mb-1 line-2"><a
                                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                                    class="text-dark">{{ $blog->title }}</a></h6>
                                                            <div class="pt-1 fs-7 line-2">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                            <div class="d-flex flex-wrap justify-content-between mt-3">
                                                                <div class="text-dark fs-7"><i
                                                                        class="fa-solid fa-calendar-days"></i><span
                                                                        class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                                </div>
                                                                <a class="fw-semibold text-secondary fs-15 d-flex align-items-center"
                                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}<span
                                                                        class="mx-1"><i
                                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long' }}"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-md-5 mt-4">
                                <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a class="btn btn-sm btn-primary rounded-3 px-2 py-2 category-button {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                        href="{{ URL::to(@$vendordata->slug . '/blogs') }}">
                                        {{ trans('labels.viewall') }}<span
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                    </a>
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

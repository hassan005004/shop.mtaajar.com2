@extends('web.layout.default')
@section('contents')
    <!---------------------------------- theme-12-slider-main-section ---------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-12-slider bg-primary-rgb">
            <div class="theme-12-main-banner slider-bots text-animation owl-carousel owl-theme">
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
                                class="w-100 object-fit-cover img-fluid theme-12-main-banner-slider" alt="">
                            <div class="carousel-caption-12 px-md-5 py-sm-4 py-3 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center z-5">
                                    <div class="col-xl-11">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <div class="col-md-5">
                                                <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                                    {{ $slider['sub_title'] }}
                                                </h2>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-white fs-18 mb-3 home-description animation-fade">
                                                    {{ $slider['description'] }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}"
                                class="w-100 object-fit-cover img-fluid theme-12-main-banner-slider" alt="">
                            <div class="carousel-caption-12 px-md-5 py-sm-4 py-3 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center z-5">
                                    <div class="col-xl-11">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <div class="col-md-5">
                                                <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                                    {{ $slider['sub_title'] }}
                                                </h2>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-white fs-18 mb-3 home-description animation-fade">
                                                    {{ $slider['description'] }}
                                                </p>
                                                <div class="d-flex animation-down">
                                                    @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                        @if ($slider['type'] == 1)
                                                            <a class="btn btn-primary rounded-4"
                                                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                            @elseif($slider['type'] == 2)
                                                                <a class="btn btn-primary rounded-4"
                                                                    href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                                @elseif($slider['type'] == 3)
                                                                    <a class="btn btn-primary rounded-4"
                                                                        href="{{ $slider['custom_link'] }}"
                                                                        target="_blank">
                                                                    @else
                                                                        <a class="btn btn-primary rounded-4"
                                                                            href="javascript:void(0)">
                                                        @endif
                                                        {{ $slider['link_text'] }} <i
                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i></a>
                                                    @endif
                                                </div>
                                            </div>
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
    <main class="theme-12 bg-primary-rgb-main">
        <!---------------------------------- new top-bar-offer ---------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            <div class="overflow-hidden offers-theme">
                <div class="offer-badge {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                    {{ trans('labels.best_offers') }}
                </div>
                <div class="offers text-secondary">
                    @include('web.coupon.index')
                </div>
            </div>
        @endif
        <!---------------------------------- theme-12-offer-banner-1-section ---------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-12-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="offer-banner-1-carousel owl-carousel owl-theme">
                        @foreach ($getbannerslist['bannersection1'] as $banner)
                            <div class="item">
                                <div class="rounded-4 ">
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
                                        class="w-100 h-100 rounded-4 object-fit-cover">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- theme-12-category-section ---------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-12-category bg-primary py-sm-5 py-4">
                <div class="container">
                    <div class="mb-md-5 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="title-line bg-secondary"></div>
                            <p class="fs-6 text-secondary text-uppercase  fw-normal specks-subtitle mx-2">
                                {{ trans('labels.homepage_category_subtitle') }}
                            </p>
                        </div>
                        <span
                            class="fw-semibold wdt-heading-title text-white text-truncate">{{ trans('labels.choose_by_category') }}</span>
                    </div>
                    <div class="theme-12-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="theme-12-item h-100">
                                <div
                                    class="d-flex border border-secondary-color align-items-center justify-content-between p-sm-2 p-1 bg-white h-100 rounded-4 overflow-hidden">
                                    <div class="p-sm-2 p-1">
                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="card-title text-dark fs-15 choose-by-category-name">{{ $categorydata['name'] }}</a
                                            href="#">
                                        <p class="fs-13">{{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}
                                        </p>
                                    </div>
                                    <div class="cat-img col-5 h-100">
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                            <img src="{{ helper::image_path($categorydata->image) }}"
                                                class="object-fit-cover rounded-4 h-100 w-100" alt="category image"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn border border-secondary fs-7 rounded-4 px-3 fw-600 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/categories') }}"> {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- theme-12-best-Selling-Products-section ---------------------------------->
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-12-best-Selling-product my-md-5 my-4">
                <div class="container">
                    <div class="mb-md-5 mb-4">
                        <div class="d-flex align-items-center mb-1">
                            <div class="title-line bg-secondary"></div>
                            <p class="fs-6 text-secondary specks-subtitle text-truncate px-2 text-uppercase">
                                {{ trans('labels.homepage_product_subtitle') }}
                            </p>
                        </div>
                        <span class="text-dark wdt-heading-title line-1">{{ trans('labels.best_selling_product') }}</span>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-12.productcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            <a class="btn border border-secondary fs-7 rounded-4 px-3 fw-600 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- WHO WE ARE ---------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are py-md-5 py-3 bg-primary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <div class="d-flex align-items-center mb-1">
                                <div class="title-line bg-secondary"></div>
                                <span
                                    class="fs-6 text-secondary text-truncate m-0 px-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            </div>
                            <h4 class="wdt-heading-title line-2 text-white">
                                {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2 text-white">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="row g-sm-3 g-2">
                                @foreach ($whoweare as $item)
                                    <div class="col-sm-6">
                                        <div class="card border-secondary-color bg-white">
                                            <div class="card-body text-center">
                                                <img src="{{ helper::image_path($item->image) }}"
                                                    class="icon-lg bg-opacity-10 text-success rounded-circle border border-1 border-secondary-color"
                                                    alt="">
                                                <div class="py-md-2 ">
                                                    <h5 class="my-1 fw-600 text-truncate">{{ $item->title }}</h5>
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
                                class="who-we-are-12 w-100 object-fit-cover rounded-4 border border-secondary-color {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------- theme-12-offer-banner-2-section ----------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-12-offer-banner-3 py-5">
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
                                    <img src="{{ $banner['image'] }}" class="d-block w-100 object-fit-cover rounded-4"
                                        alt="..."></a>
                                </div>
                            @endforeach
                        </div>
                        @if (count($getbannerslist['bannersection2']) > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left slider-arrows rounded-5"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows rounded-5"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.next') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------------- theme-12-new-product-section ----------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-12-new-product">
                <div class="container">
                    <div class="mb-md-5 mb-4">
                        <div class="d-flex align-items-center mb-1">
                            <div class="title-line bg-secondary"></div>
                            <p class="fs-6 text-secondary specks-subtitle text-truncate px-2 text-uppercase">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                        </div>
                        <span class="text-dark wdt-heading-title line-1">{{ trans('labels.new_arrival_products') }}</span>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @include('web.theme-12.newproductcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            <a class="btn border border-secondary fs-7 rounded-4 px-3 fw-600 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------- theme-12-offer-banner-3-section ----------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-12-offer-banner my-md-5 my-4">
                <div class="container-fluid">
                    <div class="offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        @foreach ($getbannerslist['bannersection3'] as $banner)
                            <div class="item">
                                <div class="rounded-4">
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
                    <section class="theme-12-deals bg-primary-rgb py-sm-5 py-4 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="mb-md-5 mb-4">
                                <div class="d-lg-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="title-line bg-secondary"></div>
                                            <p
                                                class="fs-6 text-secondary specks-subtitle text-truncate px-2 text-uppercase">
                                                {{ trans('labels.home_page_top_deals_title') }}
                                            </p>
                                        </div>
                                        <span
                                            class="text-dark wdt-heading-title line-1 m-0">{{ trans('labels.home_page_top_deals_subtitle') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-center mt-lg-0 mt-4">
                                        <div class="card col-auto my-auto p-0 rounded-4 margin-sm p-1">
                                            <div id="countdown" class="countdown-border"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="top-deals12" class="owl-carousel owl-theme carousel-items-4">
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
                                    <div class="item h-100 bg-white rounded-4 mx-1">
                                        <div
                                            class="card rounded-4 h-100 overflow-hidden bg-primary-rgb border border-dark {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
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
                                                        class="off-label-12 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                        <div class="sale-label-12">{{ $off }}% OFF</div>
                                                    </div>
                                                @endif

                                                <!-- options -->
                                                <ul class="option-wrap d-flex gap-3 justify-content-center w-100">
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li tooltip="Wishlist" class="m-0 rounded-3">
                                                                <a onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                    class="option-btn circle-round wishlist-btn rounded-3">
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
                                                    <li tooltip="{{ trans('labels.view') }}" class="m-0 rounded-3">
                                                        <a class="option-btn circle-round wishlist-btn rounded-3"
                                                            onclick="productview('{{ $products->id }}')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- options end -->
                                            </div>

                                            <div class="card-body px-sm-3 px-2 pt-3 pb-0">

                                                <div class="d-flex align-items-center justify-content-between mb-1">

                                                    <p
                                                        class="item-title fs-8 cursor-auto text-truncate text-lightslategray">
                                                        {{ @$products['category_info']->name }}
                                                    </p>
                                                    @if (@helper::checkaddons('product_reviews'))
                                                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                            <p class="d-flex fs-8 product-star align-items-center"><i
                                                                    class="text-warning fa-solid fa-star px-1 {{ session()->get('direction') == 2 ? 'ps-1' : 'pe-1' }}"></i><span
                                                                    class="text-dark fs-8 fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                            </p>
                                                        @endif
                                                    @endif
                                                </div>

                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                    <p class="text-dark product-name line-2">
                                                        {{ $products->name }}</p>
                                                </a>
                                            </div>
                                            <div class="card-footer px-sm-3 p-2">

                                                <h6
                                                    class="text-dark fs-7 fw-semibold product-price cursor-auto text-truncate">

                                                    {{ helper::currency_formate($price, $products->vendor_id) }}
                                                    @if ($original_price > $price)
                                                        <del
                                                            class="fs-8 fw-normal d-block mt-1 text-lightslategray">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                    @endif
                                                </h6>
                                            </div>
                                            <!-- add to cart start -->
                                            @if (helper::appdata($vendordata->id)->online_order == 1)
                                                <div class="theme-12-cart d-flex justify-content-center w-100">
                                                    @if ($products->has_variation == 1)
                                                        <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                            class="option-btn addtocart-btn rounded-0 text-dark w-100">
                                                            <div class="btn btn-primary w-100 rounded-0">
                                                                <p
                                                                    class="fw-500 fs-7 text-capitalize d-flex justify-content-center">
                                                                    <i
                                                                        class="fa-sharp fa-regular fa-cart-plus px-2 d-lg-block d-none"></i>
                                                                    {{ trans('labels.addtocart') }}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <a class="option-btn addtocart-btn rounded-0 cursor-pointer w-100"
                                                            onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                            <div class="btn btn-primary w-100 rounded-0">
                                                                <p
                                                                    class="fw-500 fs-7 text-capitalize d-flex justify-content-center">
                                                                    <i
                                                                        class="fa-sharp fa-regular fa-cart-plus px-2 d-md-block d-none"></i>{{ trans('labels.addtocart') }}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-md-4 mt-3">
                                <div class="rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                        class="btn border border-secondary rounded-4 fs-7 px-3 fw-600 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">{{ trans('labels.viewall') }}
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
                <section class="Testimonial my-5">
                    <div class="container position-relative">
                        <div class="d-flex align-items-center mb-1">
                            <div class="title-line bg-secondary"></div>
                            <p class="fs-6 text-secondary specks-subtitle text-truncate px-2 text-uppercase">
                                {{ trans('labels.testimonials') }}</p>
                        </div>
                        <span
                            class="text-dark wdt-heading-title line-1 text-truncate mb-sm-5 mb-4">{{ trans('labels.testimonial_subtitle') }}
                        </span>
                        <!-- testimonial slider start -->
                        <div id="testimonial12" class="owl-carousel owl-theme testimonial-12">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100">
                                    <div class="client-profile h-100 rounded-4 overflow-hidden">
                                        <div class="h-100">
                                            <img src="{{ helper::image_path($testimonial->image) }}"
                                                class="h-100 theme-12-client-img" alt="">
                                        </div>
                                        <div>
                                            <div class="px-2 py-2">
                                                <p class="client-name"> {{ $testimonial->name }}
                                                    <span
                                                        class="profession fs-7 d-block">{{ $testimonial->position }}</span>
                                                </p>
                                            </div>
                                            <div class="bg-primary py-3 px-2">
                                                <p class="fs-7 text-white description mb-3 px-1">
                                                    “{{ $testimonial->description }}”</p>
                                                <ul class="fs-7 px-1">
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @endif

        <!---------------------------------------- app download end ---------------------------------------->
        @if (!empty($appsection))
            <section class="py-md-5 py-3 bg-primary">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-white">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-white line-2">{{ @$appsection->subtitle }}</p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3">
                                <!-- Google play store button -->
                                <div class="rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ @$appsection->android_link }}"> <img
                                            src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg') }}"
                                            class="g-play rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            alt=""> </a>
                                </div>
                                <!-- App store button -->
                                <div class="rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    <a href="{{ @$appsection->ios_link }}"> <img
                                            src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg') }}"
                                            class="g-play rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            alt=""> </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="{{ helper::image_path(@$appsection->image) }}"
                                    class="h-500px object-fit-cover w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!--------------------------------------------------- theme-12-blog-section --------------------------------------------------->
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
                        <section class="theme-12-blog py-md-5 py-4">
                            <div class="container">
                                <div class="mb-md-5 mb-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="title-line bg-secondary"></div>
                                        <p class="fs-6 fw-normal specks-subtitle text-truncate px-2 text-uppercase">
                                            {{ trans('labels.blog_title') }}
                                        </p>
                                    </div>
                                    <span
                                        class="text-dark wdt-heading-title line-1">{{ trans('labels.featured_blogs') }}</span>
                                </div>
                                <div class="carousel-items-4 owl-carousel owl-theme">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="item h-100 bg-white rounded-4 mx-1">
                                            <div
                                                class="card rounded-4 h-100 overflow-hidden bg-primary-rgb border border-dark ">
                                                <div class="position-relative">
                                                    <img src="{{ helper::image_path($blog->image) }}" height="230"
                                                        class="card-img-top object-fit-cover" alt="blog-img">
                                                    <div class="off-label-12  ">
                                                        <p class="fs-8 sale-label-12"> <i
                                                                class="fa-regular fa-clock px-1"></i>
                                                            <span>{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-body pb-2">
                                                    <h6 class="card-title m-0 product-line fw-600">
                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                    </h6>
                                                    <div class="pt-2 line-2 fs-7">
                                                        {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                    </div>
                                                </div>

                                                <div class="card-footer p-0 d-flex flex-wrap justify-content-center">
                                                    <div class="btn btn-primary fs-15 w-100 rounded-0">
                                                        <a href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                            class="fs-15 text-center text-white">{{ trans('labels.readmore') }}
                                                            <i
                                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long me-2' : 'fa-solid fa-arrow-right-long me-2' }}"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center mt-md-5 mt-4">
                                    <div class="rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                        <a class="btn border border-dark rounded-4 fs-7 px-3 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                            href="{{ URL::to(@$vendordata->slug . '/blogs') }}">
                                            {{ trans('labels.viewall') }}<span
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                        </a>
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

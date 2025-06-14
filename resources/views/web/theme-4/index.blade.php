@extends('web.layout.default')

@section('contents')

    <!---------------------------------------------- theme-4-slider-main-section ---------------------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-4-slider">

            <div class="theme-4-main-banner owl-carousel owl-theme">
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
                                class="w-100 object-fit-cover img-fluid theme-4-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            {{ $slider['title'] }}</h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle">{{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                            {{ $slider['description'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}"
                                class="w-100 object-fit-cover img-fluid theme-4-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3">
                                            {{ $slider['title'] }}</h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 home-description">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-start">
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
                                                                <a class="btn btn-fashion rounded-5"
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
    <main>

        <!---------------------------------------------- theme-4-category-section ---------------------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-4-category py-5 pro-hover">

                <div class="container">

                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">

                        <div
                            class="border-secondary-color border-5 text-uppercase {{ session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3' }}">
                            <h2 class="fw-semibold fs-4 specks-title">

                                {{ trans('labels.top_categories') }}</h2>

                            <p class="fs-6 text-muted fw-normal specks-subtitle">
                                {{ trans('labels.homepage_category_subtitle') }}</p>

                        </div>

                        <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                            {{ trans('labels.viewall') }}<i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}"></i>
                        </a>
                    </div>
                    <div class="theme-4-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="theme-4-item h-100">

                                <div class="content-box border d-flex align-items-center justify-content-between p-1 h-100">

                                    <div class="cat-img p-2 w-50">

                                        <img src="{{ helper::image_path($categorydata->image) }}" alt=""
                                            class="w-100">

                                    </div>

                                    <div class="cat-concent w-50 mx-1">

                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="fw-600 fs-15 text-capitalize">{{ $categorydata['name'] }}</a>
                                        <p class="fs-13">{{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}</p>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </section>
        @endif

        <!-------------------------------------------- theme-4-offer-banner-1-section ------------------------------------------>
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-4-offer-banner-1 mb-5">
                <div class="container">
                    <div class="theme-4-offer-banner-1-carousel owl-carousel owl-theme">
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
                                    class="w-100 h-100 rounded-0 object-fit-cover">
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

        <!------------------------------------------------- best Selling product ------------------------------------------------->
        <section class="theme-4-best-Selling-product pro-hover my-5">

            <div class="container">

                <div
                    class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">

                    <div
                        class="border-secondary-color border-5 text-uppercase {{ session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3' }}">

                        <span class="fw-semibold fs-4 specks-title">{{ trans('labels.best_selling_product') }}</span>

                        <p class="fs-6 text-muted fw-normal specks-subtitle">
                            {{ trans('labels.homepage_product_subtitle') }}</p>

                    </div>

                    <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                        href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">

                        {{ trans('labels.viewall') }}<p
                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}">
                        </p>

                    </a>
                </div>

                <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0">
                    @foreach ($getbestsellingproducts as $getproductdata)
                        @include('web.theme-4.productcomonview')
                    @endforeach

                </div>

            </div>

        </section>

        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-light py-md-5 py-3 mb-5">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="w-100 object-fit-cover" alt="">
                        </div>
                        <div class="col-xl-5 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2"> {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}</p>
                            <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3">
                                @foreach ($whoweare as $item)
                                    <div class="d-flex gap-2 align-items-md-center align-items-start mb-xl-4 mb-3">
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
                    </div>
                </div>
            </section>
        @endif

        <!------------------------------------------- theme-4-offer-banner-2-section ------------------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-4-offer-banner-3 mb-5">
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
                                    <img src="{{ $banner['image'] }}" class="d-block w-100 object-fit-cover"
                                        alt="...">
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

        <!---------------------------------------- theme-4-new-product-section ---------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-4-new-product mb-5">

                <div class="container">

                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">

                        <div
                            class="border-secondary-color border-5 text-uppercase {{ session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3' }}">

                            <span class="fw-semibold fs-4 specks-title">{{ trans('labels.new_arrival_products') }}</span>

                            <p class="fs-6 text-muted fw-normal specks-subtitle">
                                {{ trans('labels.new_arrival_product_subtitle') }}</p>

                        </div>

                        <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                            {{ trans('labels.viewall') }} <i
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}">
                            </i>
                        </a>

                    </div>

                    <div class="new-arrival-products">
                        <div class="row mb-4 g-0">
                            @foreach ($getnewarrivalproducts as $getproductdata)
                                @php
                                    if ($getproductdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
                                        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                            $price =
                                                $getproductdata->price -
                                                @helper::top_deals($vendordata->id)->offer_amount;
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
                                        $original_price > 0
                                            ? number_format(100 - ($price * 100) / $original_price, 1)
                                            : 0;
                                @endphp
                                <div class="col-md-6 col-lg-4">
                                    <div class="card product-card-side p-0 h-100  bg-white">
                                        <div class="img-wrap h-100 position-relative">
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }} ">
                                                <img src="{{ $getproductdata['product_image']->image_url }}"
                                                    class="w-100 h-100 img-fluid object-fit-cover img-1" alt="">
                                                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                                                    class="w-100 img-2" alt="">
                                            </a>
                                            @if ($off > 0)
                                                <div
                                                    class="{{ @helper::appdata(@$vendordata->id)->web_layout == 1 ? 'sale-label-off' : 'sale-label-on' }}">
                                                    {{ $off }}% OFF
                                                </div>
                                            @endif

                                        </div>
                                        <div class="card-body content-box w-100">
                                            <div class="d-flex align-items-center justify-content-between mb-md-2">
                                                <p class="card-title fs-8 text-secondary m-0 text-truncate">
                                                    {{ @$getproductdata['category_info']->name }}</p>

                                                @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                    <p class="fs-8"><i
                                                            class="text-warning fs-8 fa-solid fa-star px-1"></i><span
                                                            class="text-dark fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                                                    </p>
                                                @endif

                                            </div>
                                            <a
                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }} ">
                                                <h5 class="truncate-2 mb-3 text-dark product-name line-2 h-42">
                                                    {{ $getproductdata->name }}</h5>
                                            </a>
                                            <h6 class="product-price text-dark d-inline-block m-0 text-truncate">
                                                {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                                                @if ($original_price > $price)
                                                    <del
                                                        class="text-muted fs-8 fw-600 mt-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                                                @endif
                                            </h6>

                                            <!-- options -->
                                            <ul
                                                class="option-wrap d-flex align-items-center d-grid gap-4 product_icon2 mt-2">
                                                @if (@helper::checkaddons('customer_login'))
                                                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                        <li tooltip="Wishlist" class="rounded-circle">
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
                                                <li tooltip="View" class="rounded-circle">
                                                    <a class="option-btn circle-round wishlist-btn"
                                                        onclick="productview('{{ $getproductdata->id }}')">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                @if (helper::appdata($vendordata->id)->online_order == 1)
                                                    <li tooltip="Add To Cart" class="rounded-circle">
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
                <section class="Testimonial">
                    <div class="container">

                        <div class="text-uppercase text-center mb-4">

                            <h4 class="fw-semibold fs-4 specks-title text-dark">{{ trans('labels.testimonial_subtitle') }}
                            </h4>

                            <span
                                class="fs-6 text-muted fw-normal specks-subtitle">{{ trans('labels.testimonials') }}</span>

                        </div>

                        <div id="testimonial4" class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item p-1">
                                    <div class="card p-4">
                                        <div class="review_images m-auto mb-3">
                                            <img src="{{ helper::image_path($testimonial->image) }}" alt="">
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="avatar-content">
                                                <div class="name-box text-center border-bottom">
                                                    <div
                                                        class="d-flex justify-content-center align-items-center w-100 pt-3 pb-1">
                                                        <p class="d-flex d-grid gap-1 align-items-center">
                                                            <span
                                                                class="px-1 fw-500 text-center text-truncate text-capitalize">{{ $testimonial->name }}</span>
                                                        </p>
                                                    </div>
                                                    <h5 class="text-primary fs-15 pb-3 text-truncate">
                                                        {{ $testimonial->position }}
                                                    </h5>
                                                </div>
                                                <p class="text-muted fs-7 pt-3 mb-2">
                                                    {{ $testimonial->description }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        @php
                                                            $count = (int) $testimonial->star;
                                                        @endphp
                                                        <p class="d-flex d-grid gap-1 align-items-center star_rating fs-7">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $count)
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                @else
                                                                    <i class="fa-regular fa-star text-warning"></i>
                                                                @endif
                                                            @endfor
                                                        </p>
                                                    </div>
                                                    <div class="fs-8">
                                                        <i class="fa-regular fa-clock text-muted"></i>
                                                        <span
                                                            class="px-1 text-muted fw-400">{{ helper::date_formate($testimonial->created_at, $testimonial->vendor_id) }}</span>
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

        <!------------------------------------------- theme-4-offer-banner-3-section ------------------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-4-offer-banner-3 my-5">
                <div class="container-fluid">
                    <div class="theme-4-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
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
                                <img src="{{ $banner['image'] }}" alt="banner-3" class="object-fit-cover rounded-0">
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
                    <section class="deals3 bg-primary-rgb py-5" id="topdeals">
                        <div class="container">
                            <div class="text-uppercase text-center mb-4">
                                <h3 class="fw-semibold fs-4 specks-title text-dark">
                                    {{ trans('labels.home_page_top_deals_subtitle') }}</h3>
                                <p class="fs-6 text-muted fw-normal specks-subtitle">
                                    {{ trans('labels.home_page_top_deals_title') }}</p>
                                <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                    class="btn btn-fashion rounded-5 mt-3">{{ trans('labels.viewall') }}
                                    <i
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i>
                                </a>
                            </div>

                            <div class="mx-auto mb-5">
                                <div class=" offer-counter d-flex justify-content-around" id="countdown">
                                </div>
                            </div>

                            <div id="top-deals4" class="owl-carousel owl-theme">
                                @foreach ($topdealsproducts as $products)
                                    @php
                                        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                                            $price =
                                                $products->price - @helper::top_deals($vendordata->id)->offer_amount;
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
                                    <div class="item h-100 bg-white mx-sm-2">

                                        <div
                                            class="card border rounded-0 bg-transparent h-100 overflow-hidden pro-menu {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">

                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">

                                                <div class="item-img position-relative">

                                                    <img src="{{ $products['product_image']->image_url }}"
                                                        alt="" class="rounded-4 img-1">

                                                    <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                        class="w-100 img-2" alt="">
                                                    @if ($off > 0)
                                                        <div
                                                            class="{{ session()->get('direction') == 2 ? 'sale-label-on' : 'sale-label-off' }}">
                                                            {{ $off }}% {{ trans('labels.off') }}
                                                        </div>
                                                    @endif
                                                    <!-- options -->
                                                    <ul
                                                        class="option-wrap {{ session()->get('direction') == 2 ? 'ltr' : 'rtl' }}">
                                                        @if (@helper::checkaddons('customer_login'))
                                                            @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                <li class="{{ session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right' }} rounded-circle"
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
                                                        <li class="{{ session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right' }}"
                                                            class="rounded-circle" data-tooltip="View">
                                                            <a class="option-btn circle-round wishlist-btn"
                                                                onclick="productview('{{ $products->id }}')">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        @if (helper::appdata($vendordata->id)->online_order == 1)
                                                            <li class="{{ session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right' }}"
                                                                class="rounded-circle" data-tooltip="Add To Cart">
                                                                @if ($products->has_variation == 1)
                                                                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                        class="option-btn circle-round addtocart-btn wishlist-btn">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                                                        onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    </ul>
                                                    <!-- options -->

                                                </div>
                                            </a>

                                            <div class="card-body pb-0">

                                                <p
                                                    class="item-title text-secondary fs-8 cursor-auto text-truncate text-capitalize">
                                                    {{ @$products['category_info']->name }}</p>

                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                    <p class="m-0 text-dark product-name line-2">
                                                        {{ $products->name }}</p>
                                                </a>

                                            </div>

                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="text-dark fw-bold product-price text-truncate">

                                                        {{ helper::currency_formate($price, $products->vendor_id) }}
                                                        @if ($original_price > $price)
                                                            <del
                                                                class="text-muted fs-8 fw-600 d-block mt-1">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                        @endif
                                                    </h5>
                                                </div>

                                                @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                    <p class="fs-8"><i
                                                            class="text-warning fs-8 fa-solid fa-star px-1"></i><span
                                                            class="text-dark fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                    </p>
                                                @endif

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
        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        @if (!empty($appsection))
            <section class="my-5">
                <div class="container bg-light rounded-0">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-dark">{{ @$appsection->title }}</h3>
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


        <!------------------------------------------------ thetem-4-blog-section ------------------------------------------------>
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
                        <section class="theme-4-blog mb-5">
                            <div class="container">
                                <div
                                    class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-4">
                                    <div
                                        class="border-secondary-color border-5 text-uppercase {{ session()->get('direction') == 2 ? 'border-end pe-3' : 'border-start ps-3' }}">

                                        <span
                                            class="fw-semibold fs-4 specks-title">{{ trans('labels.featured_blogs') }}</span>

                                        <p class="fs-6 text-muted fw-normal specks-subtitle">
                                            {{ trans('labels.blog_title') }}</p>

                                    </div>

                                    <a class="btn btn-sm btn-primary rounded-5 px-3 py-2 category-button"
                                        href="{{ URL::to(@$vendordata->slug . '/blogs') }}">

                                        {{ trans('labels.viewall') }}<p
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}">
                                        </p>

                                    </a>

                                </div>

                                <div class="theme-4-blogs-carousel owl-carousel owl-theme">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="card h-100 rounded-0">

                                            <img src="{{ helper::image_path($blog->image) }}"
                                                class="products-img w-100 object-fit-cover" height="230"
                                                alt="blog-image">

                                            <div class="card-body">

                                                <h6 class="card-title product-line fw-600 "><a
                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                </h6>
                                                <div class="pt-1 line-2 fs-7">
                                                    {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                </div>


                                            </div>
                                            <div
                                                class="card-footer blog-footer border-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex fs-8">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <div
                                                        class="px-1 fs- {{ session()->get('direction') == 2 ? 'theme-4-blog-date' : 'blog-date' }}">
                                                        {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                                    </div>
                                                </div>


                                                <a class="btn btn-sm btn-outline-primary fs-15 rounded-5 px-3 py-1"
                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">

                                                    {{ trans('labels.readmore') }}<p
                                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}">
                                                    </p>

                                                </a>

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

@extends('web.layout.default')
@section('contents')
    <div class="theme-1">
        <!-- BANNER AREA START -->
        @if (count($getsliderlist) > 0)
            <section>
                <div class="theme-16-main-banner slider-bots text-animation owl-carousel owl-theme">
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
                                <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid"
                                    alt="">
                                <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-12 bg-primary p-3 p-md-4 p-lg-5 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                                {{ $slider['title'] }}
                                            </h5>
                                            <h2
                                                class="text-white text-capitalize fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                                {{ $slider['sub_title'] }}
                                            </h2>
                                            <p class="text-white fs-18 mb-2 line-2 home-description animation-up">
                                                {{ $slider['description'] }}
                                            </p>

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
                                            class="col-lg-6 col-12 bg-primary p-3 p-md-4 p-lg-5 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                                {{ $slider['title'] }}
                                            </h5>
                                            <h2
                                                class="text-white fw-bold text-capitalize mb-md-3 mb-1 home-subtitle animation-down">
                                                {{ $slider['sub_title'] }}
                                            </h2>
                                            <p class="text-white fs-18 mb-md-5 line-2 mb-2 home-description animation-up">
                                                {{ $slider['description'] }}
                                            </p>
                                            <div class="d-flex justify-content-start animation-up">
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
            </section>
        @endif
        <!-- BANNER AREA END -->
        <!---------- WHO WE ARE ---------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-secondary-rgb mb-5 py-5">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="pb-xl-4 pb-lg-0 pb-md-4 pb-3 who-we-16">
                                <div class="row g-3">
                                    @foreach ($whoweare as $item)
                                        <div class="col-sm-6">
                                            <div class="card shadow rounded-4">
                                                <div class="card-body">
                                                    <div class="serviceBox">
                                                        <div class="service-icon pt-sm-3 pt-2">
                                                            <span
                                                                class="d-flex justify-content-center shadow align-items-center {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                                <img src="{{ helper::image_path($item->image) }}"
                                                                    class="rounded-circle shadow-lg" alt="">
                                                            </span>
                                                        </div>
                                                        <div class="service-content">
                                                            <h6 class="my-2 line-1 fw-600">{{ $item->title }}</h6>
                                                            <p class="line-2 m-0 text-muted fs-7">
                                                                {{ $item->sub_title }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="w-100 object-fit-cover" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------- WHO WE ARE ---------->
        <!---------------------------------------------- theme-16-category-section ---------------------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="my-5 category pro-hover">
                <div class="container">
                    <div class="col-lg-12">
                        <div class="section-heading flex-wrap gap-2 pb-4">
                            <div>
                                <p class="subtitle text-truncate">{{ trans('labels.top_categories') }}</p>
                                <h4 class="section-title text-truncate">{{ trans('labels.homepage_category_subtitle') }}
                                </h4>
                            </div>
                            <a href="{{ URL::to(@$vendordata->slug . '/categories') }}"
                                class="btn btn-sm btn-fashion">{{ trans('labels.viewall') }} <i
                                    class=" {{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                            </a>
                        </div>
                    </div>
                    <div class="theme-16-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item h-100">
                                <div class="card rounded-5 border-0 h-100">
                                    <div class="serviceBox">
                                        <div class="service-icon">
                                            <span><img src="{{ helper::image_path($categorydata->image) }}" alt=""
                                                    class="w-100"></span>
                                        </div>
                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="fw-600 fs-7 line-2 z-1 position-relative my-2 text-capitalize text-secondary">{{ $categorydata['name'] }}</a>

                                        <p class="description text-dark fs-13 m-0 fw-500">
                                            {{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!------- new top-bar-offer ------->
        @if (!empty($coupons) && $coupons->count() > 0)
            @include('web.coupon.index')
        @endif
        <!------- new top-bar-offer ------->

        <!------------------------------------------- theme-16-offer-banner-1-section ----------------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="offer-banner-1 my-5">
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
                                    class="w-100 h-100 rounded-4 object-fit-cover">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!-- OFFERS BANNER 1 AREA END -->

        <!-- BEST SELLING PRODUCTS START -->
        @if (count($getbestsellingproducts) > 0)
            <section class="best-product pro-hover">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading flex-wrap gap-2 pb-4">
                                <div>
                                    <p class="subtitle text-truncate">{{ trans('labels.homepage_product_title') }}</p>
                                    <h4 class="section-title text-truncate">{{ trans('labels.best_selling_products') }}
                                    </h4>
                                </div>
                                <a href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}"
                                    class="btn btn-sm btn-fashion">{{ trans('labels.viewall') }} <i
                                        class=" {{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 g-sm-3 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 theme-16">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-16.productcomonview')
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!-- BEST SELLING PRODUCTS END -->

        <!-- OFFERS BANNER 2 START -->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="offers-banner-area_2 my-5">
                <div class="container">
                    <div id="banner_slider_2" class="carousel slide carousel-fade rounded-2" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-4">
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
                                    <img src="{{ $banner['image'] }}" class="object-fit-contain rounded-4"></a>
                                </div>
                            @endforeach
                        </div>
                        @if (count($getbannerslist['bannersection2']) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#banner_slider_2"
                                data-bs-slide="prev"> <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left arrow-btn"></i></span><span
                                    class="visually-hidden">{{ trans('pagination.previous') }}</span> </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#banner_slider_2"
                                data-bs-slide="next"> <span aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right arrow-btn"></i></span><span
                                    class="visually-hidden">{{ trans('pagination.next') }}</span> </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!-- OFFERS BANNER 2 END -->

        <!-- NEW ARRIVAL PRODUCTS START -->
        @if (count($getnewarrivalproducts) > 0)
            <section class="new-product bg-primary-rgb py-5 my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading flex-wrap gap-2 pb-4">
                                <div>
                                    <p class="subtitle  text-truncate">
                                        {{ trans('labels.homepage_newarrivalprodect_title') }}
                                    </p>
                                    <h4 class="section-title  text-truncate">{{ trans('labels.new_arrival_products') }}
                                    </h4>
                                </div>
                                <a href="{{ URL::to(@$vendordata->slug . '/products-newest') }}"
                                    class="btn btn-fashion">{{ trans('labels.viewall') }} <i
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row g-sm-3 g-2 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 theme-16">
                            @foreach ($getnewarrivalproducts as $getproductdata)
                                <div class="col">
                                    @php
                                        if (
                                            $getproductdata->top_deals == 1 &&
                                            helper::top_deals($vendordata->id) != null
                                        ) {
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
                                    <div class="card h-100 rounded-5 card-gried border-0 p-2 p-sm-3">
                                        <div class="product-grid">
                                            <div class="product-image">
                                                <a class="image">
                                                    <img class="pic-1 card-img-top rounded-top-4"
                                                        src="{{ $getproductdata['product_image']->image_url }}">
                                                    <img class="pic-2 card-img-top rounded-top-4"
                                                        src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}">
                                                </a>
                                                @if ($off > 0)
                                                    <div class="off-label-16">
                                                        <h3 class="text-center">{{ $off }}%
                                                            {{ trans('labels.off') }}</h3>
                                                    </div>
                                                @endif
                                                <ul class="social">
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li class="cursor-pointer">
                                                                <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                    data-tip="Wishlist">
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
                                                    <li class="cursor-pointer">
                                                        <a onclick="productview('{{ $getproductdata->id }}')"
                                                            data-tip="{{ trans('labels.view') }}">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li class="cursor-pointer">
                                                            @if ($getproductdata->has_variation == 1)
                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                                                    data-tip="{{ trans('labels.cart') }}">
                                                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')"
                                                                    data-tip="{{ trans('labels.cart') }}">
                                                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body border-top">
                                            <div class="d-flex justify-content-between gap-2 mb-2">
                                                <p class="item-title text-dark fs-13 text-muted cursor-auto text-truncate">
                                                    {{ @$getproductdata['category_info']->name }}
                                                </p>
                                                @if (@helper::checkaddons('product_reviews'))
                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                        <p class="fs-8 d-flex">
                                                            <i class="text-warning fa-solid fa-star px-1"></i>
                                                            <span
                                                                class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                                                        </p>
                                                    @endif
                                                @endif
                                            </div>
                                            <a href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                                class="cursor-pointer position-relative z-1">
                                                <p class="text-dark fs-15 fw-600 line-2">{{ $getproductdata->name }}</p>
                                            </a>
                                        </div>
                                        <div class="card-footer pt-2 ">
                                            <h6
                                                class="text-dark fs-15 d-flex gap-1 flex-wrap product-price cursor-auto text-truncate align-items-center">
                                                {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                                                @if ($original_price > $price)
                                                    <del
                                                        class="text-muted fs-13 fw-600">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- NEW ARRIVAL PRODUCTS END -->

        <!-- TESTIMONIAL START -->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial my-5">
                    <div class="container position-relative">
                        <div class="mb-4">
                            <p class="subtitle text-truncate">{{ trans('labels.testimonials') }}</p>
                            <h4 class="section-title text-truncate">{{ trans('labels.testimonial_subtitle') }}</h4>
                        </div>
                        <div id="testimonial-slider-16" class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100 p-1">
                                    <div class="card h-100 border-0">
                                        <div
                                            class="testimonial rounded-4 h-100 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                            <p class="description">
                                                “{{ $testimonial->description }}”
                                            </p>
                                            <div
                                                class="pic rounded-4 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                <img src="{{ helper::image_path($testimonial->image) }}" alt=""
                                                    class="rounded-4">
                                            </div>
                                            <h3
                                                class="testimonial-title {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                {{ $testimonial->name }}
                                                <small
                                                    class="text-secondary mt-2 fw-500">{{ $testimonial->position }}</small>
                                            </h3>
                                            <ul class="my-2 fs-7">
                                                @php
                                                    $count = (int) $testimonial->star;
                                                @endphp
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $count)
                                                        <li class="list-inline-item me-0 small"><i
                                                                class="fa-solid fa-star text-warning"></i>
                                                        </li>
                                                    @else
                                                        <li class="list-inline-item me-0 small"><i
                                                                class="fa-regular fa-star text-warning"></i>
                                                        </li>
                                                    @endif
                                                @endfor
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

        <!-- TESTIMONIAL END -->

        <!-- DEALS START -->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="deals my-5 bg-secondary-rgb py-5 pro-hover" id="topdeals">
                        <div class="container">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-12">
                                    <div class="section-heading flex-wrap gap-2 pb-4">
                                        <div>
                                            <p class="subtitle text-truncate">
                                                {{ trans('labels.home_page_top_deals_title') }}</p>
                                            <h4 class="section-title text-truncate">
                                                {{ trans('labels.home_page_top_deals_subtitle') }}
                                            </h4>
                                        </div>
                                        <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                            class="btn btn-sm btn-fashion">{{ trans('labels.viewall') }} <i
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="countdown" class="mb-4"></div>
                            <div id="top-deals-16" class="owl-carousel owl-theme theme-16">
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
                                    <div class="item h-100 p-1">
                                        <div class="card h-100 rounded-5 card-gried border-0 p-2 p-sm-3">
                                            <div class="product-grid">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <img class="pic-1 card-img-top rounded-top-4"
                                                            src="{{ $products['product_image']->image_url }}">
                                                        <img class="pic-2 card-img-top rounded-top-4"
                                                            src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}">
                                                    </div>
                                                    @if ($off > 0)
                                                        <div class="off-label-16">
                                                            <h3 class="text-center">{{ $off }}%
                                                                {{ trans('labels.off') }}</h3>
                                                        </div>
                                                    @endif
                                                    <ul class="social">
                                                        @if (@helper::checkaddons('customer_login'))
                                                            @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                <li class="cursor-pointer">
                                                                    <a onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                                        data-tip="Wishlist">
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
                                                        <li class="cursor-pointer">
                                                            <a onclick="productview('{{ $products->id }}','1')"
                                                                data-tip="{{ trans('labels.view') }}">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        @if (helper::appdata($vendordata->id)->online_order == 1)
                                                            <li class="cursor-pointer">
                                                                @if ($products->has_variation == 1)
                                                                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1') }}"
                                                                        data-tip="{{ trans('labels.cart') }}">
                                                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0)"
                                                                        onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')"
                                                                        data-tip="{{ trans('labels.cart') }}">
                                                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body border-top">
                                                <div class="d-flex justify-content-between gap-2 mb-2">
                                                    <p
                                                        class="item-title text-dark fs-13 text-muted cursor-auto text-truncate">
                                                        {{ @$getproductdata['category_info']->name }}
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
                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                    class="cursor-pointer position-relative z-1">
                                                    <p class="text-dark fs-15 fw-600 line-2">
                                                        {{ $products->name }}</p>
                                                </a>
                                            </div>
                                            <div class="card-footer pt-2">
                                                <h6
                                                    class="text-dark fs-15 d-flex gap-1 flex-wrap product-price cursor-auto text-truncate align-items-center">
                                                    {{ helper::currency_formate($price, $vendordata->id) }}
                                                    @if ($original_price > $price)
                                                        @if ($original_price > 0)
                                                            <del
                                                                class="text-muted fs-13 fw-600">{{ helper::currency_formate($original_price, $vendordata->id) }}</del>
                                                        @endif
                                                    @endif
                                                </h6>
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
        <!-- DEALS END -->

        <!-- OFFERS BANNER 3 START -->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="offers-banner-area_3 my-5 p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="bannersection3" class="owl-carousel owl-loaded owl-drag overflow-hidden">
                                @foreach ($getbannerslist['bannersection3'] as $banner)
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
                                    <img class="rounded-4 object-fit-cover w-webkit" src="{{ $banner['image'] }}"
                                        alt=""></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- OFFERS BANNER 3 END -->

        <!-- app-downlode section start -->
        @if (!empty($appsection))
            <section class="my-5">
                <div class="container">
                    <div class="col-12 rounded-4 bg-primary-rgb">
                        <div class="d-flex p-3 p-sm-5 align-items-center justify-content-center">
                            <div class="col-xl-5 col-lg-6 p-0 d-none d-lg-block position-relative">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                    <img src="{{ helper::image_path(@$appsection->image) }}"
                                        class="h-500px w-100 object-fit-cover " alt="">
                                </div>
                            </div>
                            <div
                                class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center  {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                                <!-- Title -->
                                <h2 class="m-0 fw-bold text-dark">{{ @$appsection->title }}</h2>
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
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- app-downlode section start -->

        <!-- FEATURED BLOGS AREA START  -->
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
                        <section class="featured-blog py-5 bg-secondary-rgb">
                            <div class="container py-5">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-lg-12">
                                        <div class="section-heading flex-wrap gap-2 pb-4">
                                            <div>
                                                <p class="subtitle text-truncate">{{ trans('labels.blog_title') }}</p>
                                                <h4 class="section-title text-truncate">
                                                    {{ trans('labels.featured_blogs') }}
                                                </h4>
                                            </div>
                                            <a href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                                                class="btn btn-sm btn-fashion">{{ trans('labels.viewall') }} <i
                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left' : 'fa-solid fa-arrow-right' }}"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="featured_blog" class="owl-carousel owl-theme overflow-hidden">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="item h-100 p-1">
                                            <div class="post-slide h-100 p-0 card border-0 rounded-4">
                                                <div class="post-img">
                                                    <img src="{{ helper::image_path($blog->image) }}" alt=""
                                                        class="rounded-top-4">
                                                    <span
                                                        class="post-date  {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                        {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                                    </span>
                                                </div>
                                                <div class="card-body pb-0">
                                                    <h5 class="post-title fw-600 line-2">
                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                    </h5>
                                                    <p class="line-2 pt-1 fs-7">
                                                        {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                    </p>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <a href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                        class="readmore">{{ trans('labels.readmore') }}</a>
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
    </div>
    <!-- FEATURED BLOGS AREA END  -->
    <div class="newdev owl-carousel owl-theme">
        <div class="item">
            <h4>1</h4>
        </div>
        <div class="item">
            <h4>2</h4>
        </div>
        <div class="item">
            <h4>3</h4>
        </div>
        <div class="item">
            <h4>4</h4>
        </div>
        <div class="item">
            <h4>5</h4>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/products.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/index.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

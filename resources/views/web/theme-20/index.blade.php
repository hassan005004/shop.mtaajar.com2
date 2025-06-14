@extends('web.layout.default')
@section('contents')
    <!------------------------------------------------ theme-5-slider-main-section ------------------------------------------------>
    @if (count($getsliderlist) > 0)
        <section class="theme-20-slider my-4">
            <div class="container">
                <div class="row">
                    <div id="carousel-theme-15" class="carousel theme-20-slider slide vertical" data-bs-ride="carousel">
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
                                        <div
                                            class="carousel-caption {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }} h-100 d-flex justify-content-center flex-column">

                                            <div class="col-xl-10 p-3 p-sm-5 theme-20-line">
                                                <h5
                                                    class="text-white main-banner-title mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounceInRight">
                                                    {{ $slider['title'] }}
                                                </h5>
                                                <h2
                                                    class="text-primary fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                                    {{ $slider['sub_title'] }}
                                                </h2>
                                                <p class="text-white fs-18 mb-md-5 mb-2 home-description line-2">
                                                    {{ $slider['description'] }}
                                                </p>

                                            </div>

                                        </div>
                                        </a>
                                    @else
                                        <img src="{{ $slider['image'] }}" class="d-block w-100" alt="...">
                                        <div
                                            class="carousel-caption {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}  h-100 d-flex justify-content-center flex-column">

                                            <div class="col-xl-10 p-3 p-sm-5 theme-20-line">
                                                <h5
                                                    class="text-white main-banner-title mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounceInRight">
                                                    {{ $slider['title'] }}
                                                </h5>
                                                <h2
                                                    class="text-primary fw-bold mb-md-3 mb-1 text-capitalize home-subtitle animate__animated animate__bounceInLeft">
                                                    {{ $slider['sub_title'] }}
                                                </h2>
                                                <p class="text-white fs-18 mb-md-5 mb-2 home-description line-2">
                                                    {{ $slider['description'] }}
                                                </p>
                                                <div class="d-flex animate__animated animate__fadeInDown">
                                                    <div
                                                        class="rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                        @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                            @if ($slider['type'] == 1)
                                                                <a class="btn btn-secondary fs-7 text-capitalize rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                    href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                                @elseif($slider['type'] == 2)
                                                                    <a class="btn btn-secondary fs-7 text-capitalize rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                        href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                                    @elseif($slider['type'] == 3)
                                                                        <a class="btn btn-secondary fs-7 text-capitalize rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                            href="{{ $slider['custom_link'] }}"
                                                                            target="_blank">
                                                                        @else
                                                                            <a class="btn btn-secondary fs-7 text-capitalize rounded-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
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
                </div>
            </div>
        </section>
    @endif
    <main>
        <!---------------------------------------------- WHO WE ARE ------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are my-5">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-xl-6 col-lg-6 ">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <div class="d-flex  align-items-center my-1">
                                <div class="heading-line"></div>
                                <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                                <div class="heading-line"></div>
                            </div>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="row g-3">
                                @foreach ($whoweare as $item)
                                    <div class="col-md-6 theme-20">
                                        <div class="serviceBox">
                                            <div class="service-icon mb-3">
                                                <img src="{{ helper::image_path($item->image) }}" class="rounded-circle">
                                            </div>
                                            <div class="service-content">
                                                <h6 class="fw-600 mb-2 line-1">{{ $item->title }}</h6>
                                                <p class="fs-7 text-muted line-2">
                                                    {{ $item->sub_title }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="w-100 h-100 object-fit-cover" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!---------------------------------------------------- new top-bar-offer ---------------------------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            @include('web.coupon.index')
        @endif

        <!------------------------------------------------ theme-17-category-section ------------------------------------------------>
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-5-category my-5">
                <div class="container">
                    <div class="mb-md-5 text-center mb-4">
                        <span class="fw-600 fs-4 category-title  text-dark text-truncate">
                            {{ trans('labels.choose_by_category') }}
                        </span>
                        <div class="d-flex justify-content-center align-items-center mt-2">
                            <div class="title-dot"></div>
                            <p class="fs-6 text-capitalize fw-normal specks-subtitle px-2">
                                {{ trans('labels.homepage_category_subtitle') }}
                            </p>
                            <div class="title-dot"></div>
                        </div>

                    </div>
                    <div class="theme-20-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item p-1 h-100">
                                <div class="card rounded-0 text-center h-100">
                                    <div class="card-body">
                                        <div class="theme-20-cat">
                                            <img src="{{ helper::image_path($categorydata->image) }}" alt=""
                                                class="mx-auto">
                                        </div>
                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="fw-600 fs-7 line-2  my-2 text-capitalize text-secondary">{{ $categorydata['name'] }}</a>
                                        <p class="description fs-13 m-0 fw-500">
                                            {{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-0 px-2 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/categories') }}"> {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!---------------------------------------------- theme-5-offer-banner-1-section -------------------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-5-offer-banner-1 my-md-5 my-4">
                <div class="container">
                    <div class="theme-5-offer-banner-1-carousel owl-carousel owl-theme">
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

        <!------------------------------------------ theme-17-best-Selling-Products-section ------------------------------------------>
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-5-best-Selling-product py-5 bg-primary-rgb my-5">
                <div class="container">
                    <div class="mb-md-5 text-center mb-4">
                        <span class="fw-600 fs-4 category-title  text-dark text-truncate">
                            {{ trans('labels.best_selling_product') }}
                        </span>
                        <div class="d-flex justify-content-center align-items-center mt-2">
                            <div class="title-dot"></div>
                            <p class="fs-6 text-capitalize fw-normal specks-subtitle px-2">
                                {{ trans('labels.homepage_product_subtitle') }}
                            </p>
                            <div class="title-dot"></div>
                        </div>
                    </div>
                    <div class="top-deals20 owl-carousel owl-theme">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            <div class="item p-1 theme-20 h-100">
                                @include('web.theme-20.productcomonview')
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-0 px-2 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                            {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!---------------------------------------------- theme-17-offer-banner-2-section ---------------------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-5-offer-banner-3 my-5">
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
                                        alt="..."></a>
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
        <!------------------------------------------------ theme-17-new-product-section ----------------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-5-new-product my-5">
                <div class="container">
                    <div class="mb-md-5 text-center mb-4">
                        <span class="fw-600 fs-4 category-title  text-dark text-truncate">
                            {{ trans('labels.new_arrival_products') }}
                        </span>
                        <div class="d-flex justify-content-center align-items-center mt-2">
                            <div class="title-dot"></div>
                            <p class="fs-6 text-capitalize fw-normal specks-subtitle px-2">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                            <div class="title-dot"></div>
                        </div>
                    </div>
                    <div class="top-deals20 owl-carousel owl-theme">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            <div class="item p-1 theme-20 h-100">
                                @include('web.theme-20.productcomonview')
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-0 px-2 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                            {{ trans('labels.viewall') }}
                            <span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}">
                            </span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------------------- theme-17-offer-banner-3-section ---------------------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-5-offer-banner-3 my-5">
                <div class="container">
                    <div class="theme-5-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
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
        <!-------------------------------------------------------- DEALS START ------------------------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="deals theme-5-new-product bg-primary-rgb py-5 my-5" id="topdeals">
                        <div class="container">
                            <div class="mb-md-5 text-center mb-4">
                                <span class="fw-600 fs-4 category-title  text-dark text-truncate">
                                    {{ trans('labels.home_page_top_deals_subtitle') }}
                                </span>
                                <div class="d-flex justify-content-center align-items-center mt-2">
                                    <div class="title-dot"></div>
                                    <p class="fs-6 text-capitalize fw-normal specks-subtitle px-2">
                                        {{ trans('labels.home_page_top_deals_title') }}
                                    </p>
                                    <div class="title-dot"></div>
                                </div>
                            </div>
                            <div id="countdown" class="mt-4 mb-5"> </div>
                            <div id="top-deals20" class="owl-carousel owl-theme">
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
                                    <div class="item h-100 p-1 theme-20">
                                        <div class="product-grid card rounded-0 h-100">
                                            <div class="product-image m-1">
                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                    class="image">
                                                    <img class="pic-1"
                                                        src="{{ $products['product_image']->image_url }}">
                                                    <img class="pic-2"
                                                        src="{{ $products['multi_image']->count() > 0 ? $products['multi_image'][0]->image_url : $products['multi_image'][1]->image_url }}">
                                                </a>
                                                @if ($off > 0)
                                                    <span class="product-new-label">{{ $off }}%
                                                        {{ trans('labels.off') }}</span>
                                                @endif
                                                <ul class="product-links">
                                                    <li class="cursor-pointer">
                                                        <a onclick="productview('{{ $products->id }}')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body p-2 product-content">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between gap-1 mb-1 align-items-center">
                                                    <p class="card-title fs-8 line-2  m-0 text-truncate">
                                                        {{ @$getproductdata['category_info']->name }}
                                                    </p>
                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                        <p class="fs-8 m-0 text-truncate">
                                                            <i class="text-warning fa-solid fa-star px-1"></i>
                                                            <span class="text-dark fw-500">
                                                                {{ number_format($products->ratings_average, 1) }}
                                                            </span>
                                                        </p>
                                                    @endif
                                                </div>
                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                    class="text-secondary">
                                                    <p class="m-0 fs-7 fw-600 line-2 text-capitalize">
                                                        {{ $products->name }}
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="card-footer p-0 product-content">
                                                <div
                                                    class="d-flex gap-2 justify-content-center align-items-center mb-2 mx-1 flex-wrap">
                                                    <h5 class="text-primary fs-7 fw-600 m-0 text-truncate">
                                                        {{ helper::currency_formate($price, $products->vendor_id) }}
                                                    </h5>
                                                    @if ($original_price > $price)
                                                        <del class="text-muted fs-8 fw-600">
                                                            {{ helper::currency_formate($original_price, $products->vendor_id) }}
                                                        </del>
                                                    @endif
                                                </div>
                                                <ul class="product-buttons d-flex">
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li class="cursor-pointer">
                                                            @if ($getproductdata->has_variation == 1)
                                                                <a
                                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center gap-1">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        {{ trans('labels.cart') }}
                                                                    </div>
                                                                </a>
                                                            @else
                                                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center gap-1">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        {{ trans('labels.cart') }}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li class="cursor-pointer">
                                                                <a
                                                                    onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')">
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center gap-1">
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
                                                                        {{ trans('labels.wishlist') }}
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-md-5 mt-4">
                                <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                    class="btn btn-sm btn-primary rounded-0 px-2 py-2 mt-3">{{ trans('labels.viewall') }}
                                    <i
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif
        <!----------------------------------------------------- TESTIMONIAL START ---------------------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial my-5">
                    <div class="container position-relative">
                        <div class="mb-md-5 text-center mb-4">
                            <span class="fw-600 fs-4 category-title  text-dark text-truncate">
                                {{ trans('labels.testimonial_subtitle') }}
                            </span>
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <div class="title-dot"></div>
                                <p class="fs-6 text-capitalize fw-normal specks-subtitle px-2">
                                    {{ trans('labels.testimonials') }}
                                </p>
                                <div class="title-dot"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="testimonial-slider-17" class="owl-carousel owl-theme">
                                @foreach ($testimonials as $testimonial)
                                    <div class="item">
                                        <div class="testimonial-17 d-flex flex-column align-items-center">
                                            <p class="description {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                "{{ $testimonial->description }}"
                                            </p>
                                            <div class="pic p-1">
                                                <img src="{{ helper::image_path($testimonial->image) }}" alt="avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="testimonial-prof">
                                                <h4 class="text-center">{{ $testimonial->name }}</h4>
                                                <small
                                                    class="text-muted text-center">{{ $testimonial->position }}</small>
                                                <ul class="list-inline justify-content-center d-flex gap-2 small mb-3">
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
                    </div>
                </section>
            @endif
        @endif

        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        @if (!empty($appsection))
            <section class="my-5">
                <div class="container bg-primary-rgb rounded-0">
                    <div class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-2 m-0 fw-bold text-dark">{{ @$appsection->title }}</h3>
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
        <!--------------------------------------------------- thetem-5-blog-section --------------------------------------------------->
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
                        <section class="theme-5-blog mb-5">
                            <div class="container">
                                <div class="mb-md-5 text-center mb-4">
                                    <span class="fw-600 fs-4 category-title  text-dark text-truncate">
                                        {{ trans('labels.featured_blogs') }}
                                    </span>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <div class="title-dot"></div>
                                        <p class="fs-6 text-capitalize fw-normal specks-subtitle px-2">
                                            {{ trans('labels.blog_title') }}
                                        </p>
                                        <div class="title-dot"></div>
                                    </div>
                                </div>
                                <div class="row g-3 justify-content-between">
                                    @foreach (helper::getblogs(@$vendordata->id, '', '') as $key => $blog)
                                        @if ($key == 0)
                                            <div
                                                class="{{ count(helper::getblogs(@$vendordata->id, '6', '')) > 1 ? 'col-lg-6' : 'col-lg-12' }}">
                                                <div class="card border-0 rounded-0 bg-primary-light h-100">
                                                    <img src="{{ helper::image_path($blog->image) }}"
                                                        class="card-img-top w-100 object-fit-cover rounded-0 blog-img-height position-relative"
                                                        alt="blog-image">
                                                    <div class="card-body">
                                                        <h6 class="card-title line-2 mb-1 fw-bold"> <a
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                                class="text-dark">{{ $blog->title }}</a>
                                                        </h6>
                                                        <div class="pt-1 fs-7 line-2">
                                                            {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center pt-3 pb-2">

                                                            <div class="text-dark fs-7"><i
                                                                    class="fa-solid fa-calendar-days"></i><span
                                                                    class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                            </div>

                                                            <a class="fw-semibold fs-15 text-secondary fw-500"
                                                                href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}<span
                                                                    class="mx-1"><i
                                                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long' }}"></i></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="col-lg-6">
                                        <div class="row g-3 justify-content-between">
                                            @foreach (helper::getblogs(@$vendordata->id, '5', '') as $key => $blog)
                                                @if ($key != 0)
                                                    <div class="col-sm-6">
                                                        <div
                                                            class="card  border-0 bg-primary-light rounded-0 overflow-hidden">
                                                            <div class="img-overlay rounded-0">
                                                                <img src="{{ helper::image_path($blog->image) }}"
                                                                    class="card-img-top w-100 object-fit-cover rounded-0"
                                                                    height="180px" alt="blog-image">
                                                            </div>
                                                            <div class="card-body">
                                                                <h6 class="fw-bold mb-1 line-2"><a
                                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                                        class="text-dark">{{ $blog->title }}</a></h6>
                                                                <div class="pt-1 fs-7 line-2">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                                <div class="d-flex flex-wrap justify-content-between mt-3">
                                                                    <div class="text-dark fs-7"><i
                                                                            class="fa-solid fa-calendar-days"></i><span
                                                                            class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                                    </div>
                                                                    <a class="fw-semibold fs-15 text-secondary"
                                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}<span
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
                                </div>
                                <div class="d-flex justify-content-center mt-md-5 mt-4">
                                    <a class="btn btn-sm btn-primary rounded-0 px-2 py-2 category-button"
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

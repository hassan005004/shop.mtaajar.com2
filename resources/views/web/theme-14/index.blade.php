@extends('web.layout.default')
@section('contents')
    <!---------------------------------- theme-14-slider-main-section ---------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-14-slider my-3">
            <div class="container">
                <div class="row g-md-4 g-sm-3 g-2">
                    <div class="col-lg-7">
                        <div
                            class="theme-14-main-banner slider-layer slider-bots text-animation owl-carousel owl-theme rounded-3">
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
                                            class="w-100 object-fit-cover img-fluid theme-14-main-banner-slider"
                                            alt="">
                                        <div
                                            class="carousel-caption px-1 py-sm-4 py-3 d-flex flex-column justify-content-center">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <h6 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                                        {{ $slider['title'] }}
                                                    </h6>
                                                    <h2
                                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                                        {{ $slider['sub_title'] }}
                                                    </h2>
                                                    <p class="text-white fs-18 mb-3 home-description animation-fade">
                                                        {{ $slider['description'] }}
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    @else
                                        <img src="{{ $slider['image'] }}"
                                            class="w-100 object-fit-cover img-fluid theme-14-main-banner-slider"
                                            alt="">
                                        <div
                                            class="carousel-caption px-1 py-sm-4 py-3 d-flex flex-column justify-content-center">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <h6 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                                        {{ $slider['title'] }}
                                                    </h6>
                                                    <h2
                                                        class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                                        {{ $slider['sub_title'] }}
                                                    </h2>
                                                    <p class="text-white fs-5 mb-3 home-description animation-fade">
                                                        {{ $slider['description'] }}
                                                    </p>
                                                    @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                        @if ($slider['type'] == 1)
                                                            <a class="btn btn-primary rounded-3"
                                                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                            @elseif($slider['type'] == 2)
                                                                <a class="btn btn-primary rounded-3"
                                                                    href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                                @elseif($slider['type'] == 3)
                                                                    <a class="btn btn-primary rounded-3"
                                                                        href="{{ $slider['custom_link'] }}"
                                                                        target="_blank">
                                                                    @else
                                                                        <a class="btn btn-primary rounded-3"
                                                                            href="javascript:void(0)">
                                                        @endif
                                                        {{ $slider['link_text'] }} <i
                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row gap-md-4 gap-sm-3 gap-2">
                            @if (count($getbannerslist['bannersection1']) > 0)
                                @foreach ($getbannerslist['bannersection1'] as $key => $banner)
                                    @if ($key == 0)
                                        <div class="img-3">
                                            <img src="{{ $banner['image'] }}" alt=""
                                                class="w-100 rounded-3 object-fit-cover">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="">
                                @if (count($getbannerslist['bannersection1']) > 0)
                                    <div class="theme-14-offer-banner-1-carousel owl-carousel owl-theme">
                                        @foreach ($getbannerslist['bannersection1'] as $key => $banner)
                                            @if ($key != 0)
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
                                                            class="w-100 rounded-3 object-fit-cover">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <main class="theme-14">
        <!---------------------------------- new top-bar-offer ---------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            <div class="overflow-hidden offers-theme-14">
                <div class="container">
                    <div class="offer-badge-14 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                        {{ trans('labels.best_offers') }}
                    </div>
                </div>
                <div class="text-secondary">
                    @include('web.coupon.index')
                </div>
            </div>
        @endif
        <!---------------------------------- theme-14-best-Selling-Products-section ---------------------------------->
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-14-best-Selling-product my-md-5 my-4">
                <div class="container">
                    <div class="mb-md-5 mb-4">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                            {{ trans('labels.homepage_product_subtitle') }}
                        </p>
                        <span class="fw-semibold fs-2 text-truncate my-2">{{ trans('labels.best_selling_product') }}</span>
                        <div class="title-line-4 bg-secondary mt-1"></div>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-14.productcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            <a class="btn btn-secondary rounded-3 fs-7 px-4 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------- theme-14-category-section ---------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-14-category py-sm-5 py-4 bg-primary-light">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-12 mb-md-0 mb-3">
                            <div class="card bg-primary h-100 text-center d-flex justify-content-center py-5">
                                <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle">
                                    {{ trans('labels.homepage_category_subtitle') }}
                                </p>
                                <span
                                    class="fw-semibold text-white fs-4 category-title text-truncate my-1">{{ trans('labels.choose_by_category') }}</span>
                                <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                                <div class="d-flex justify-content-center mt-4">
                                    <a class="btn btn-secondary rounded-3 fs-7 px-4 py-2 category-button"
                                        href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                                        {{ trans('labels.viewall') }}<span
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-7 col-12">
                            <div class="theme-14-category-slider owl-carousel owl-theme">
                                @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                                    <div class="theme-14-item h-100">
                                        <div class="card text-center p-1 rounded-3 overflow-hidden h-100">
                                            <div class="cat-img h-100 w-100">
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                                    <img src="{{ helper::image_path($categorydata->image) }}"
                                                        class="object-fit-cover rounded-3 h-100 w-100"
                                                        alt="category image"></a>
                                            </div>
                                            <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                                class="card-title fw-600 text-dark fs-15 choose-by-category-name mt-2">{{ $categorydata['name'] }}</a
                                                href="#">
                                            <p class="fs-13">{{ helper::product_count($categorydata->id) }}
                                                {{ trans('labels.items') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
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
                            <div class="d-flex align-items-center mb-2">
                                <span
                                    class="fs-6 fw-600 text-secondary text-truncate m-0">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            </div>
                            <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            @foreach ($whoweare as $item)
                                <div class="border rounded-3 p-3 mb-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <img src="{{ helper::image_path($item->image) }}"
                                            class="icon-lg bg-opacity-10 text-success rounded-3" alt="">
                                        <div>
                                            <h5 class="line-2 fw-600">{{ $item->title }}</h5>
                                            <p class="mb-0 fs-7 line-2 mt-1">{{ $item->sub_title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="who-we-are-12 w-100 object-fit-cover rounded-3 border border-secondary-color {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------- theme-14-offer-banner-2-section ----------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-14-offer-banner-3 my-5">
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
        <!----------------------------------------- theme-14-new-product-section ----------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-14-new-product my-5">
                <div class="container">
                    <div class="mb-md-5 mb-4">
                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                            {{ trans('labels.new_arrival_product_subtitle') }}
                        </p>
                        <span
                            class="fw-semibold fs-2 text-truncate my-2">{{ trans('labels.new_arrival_products') }}</span>
                        <div class="title-line-4 bg-secondary mt-1"></div>
                    </div>
                    <div class="row g-sm-3 g-2">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @include('web.theme-14.newproductcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            <a class="btn btn-secondary rounded-3 fs-7 px-4 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!--------------------------------------- TESTIMONIAL START --------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial py-5 bg-primary-light">
                    <div class="container position-relative">
                        <div class="mb-md-5 mb-4">
                            <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                                {{ trans('labels.testimonials') }}
                            </p>
                            <span class="fw-semibold fs-2 text-truncate my-2">{{ trans('labels.testimonial_subtitle') }}
                            </span>
                            <div class="title-line-4 bg-secondary mt-1"></div>
                        </div>
                        <!-- testimonial slider start -->
                        <div id="testimonial14" class="owl-carousel owl-theme theme-14-testimonial carousel-items-3">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100 {{ session()->get('direction') == 2 ? 'me-1' : 'ms-1' }}">
                                    <div class="client-profile border rounded-3 overflow-hidden">
                                        <div class="d-flex justify-content-center mt-3">
                                            <img src="{{ helper::image_path($testimonial->image) }}"
                                                class="theme-14-client-img rounded-3" alt="">
                                        </div>
                                        <div class="px-sm-4 px-2 py-3">
                                            <p class="fs-7">“{{ $testimonial->description }}”</p>
                                        </div>
                                        <div class="bg-primary p-3">
                                            <p class="client-name text-white mb-2"> {{ $testimonial->name }}
                                                <span class="profession d-block fs-7">{{ $testimonial->position }}</span>
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
        <!----------------------------------- theme-14-offer-banner-3-section ----------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-14-offer-banner my-md-5 my-4">
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
                                        class="object-fit-cover rounded-3 ">
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
                    <section class="theme-14-deals bg-primary-light py-sm-5 py-4 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="row">
                                <div class="col-xxl-5 col-xl-5 col-lg-6 mb-lg-0 mb-3">
                                    <div class="card py-4 h-100 bg-primary justify-content-center rounded-3">
                                        <div class="mb-4 text-center">
                                            <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                                                {{ trans('labels.home_page_top_deals_title') }}
                                            </p>
                                            <span
                                                class="fw-semibold text-white fs-2 text-truncate my-2">{{ trans('labels.home_page_top_deals_subtitle') }}
                                            </span>
                                            <div class="title-line-4 bg-secondary mt-1 mx-auto"></div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="card col-auto my-auto p-0 rounded-3 margin-sm">
                                                <div id="countdown" class="countdown-border"> </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-md-4 mt-3">
                                            <div class="rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                                    class="btn btn-secondary rounded-3 fs-7 px-4 py-2 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">{{ trans('labels.viewall') }}
                                                    <span
                                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-7 col-xl-7 col-lg-6">
                                    <div id="top-deals14" class="owl-carousel owl-theme theme-14-deal-carousel">
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

                                            <div class="card rounded-3 h-100 p-2 mx-1">
                                                <div>
                                                    <div class="card-img position-relative">
                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                            <img src="{{ $products['product_image']->image_url }}"
                                                                class="object-fit-cover img-1 rounded-3" alt="">
                                                            <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                                class="w-100 img-2 rounded-3" alt="">
                                                        </a>
                                                        @if ($off > 0)
                                                            <div
                                                                class="off-label-14 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                                <div class="sale-label-14">{{ $off }}%
                                                                    {{ trans('labels.off') }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <!-- options -->
                                                        <ul
                                                            class="option-wrap justify-content-center d-flex align-items-center d-grid product_icon2 mt-2 px-2 w-100">
                                                            @if (@helper::checkaddons('customer_login'))
                                                                @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                    <li tooltip="Wishlist" class="rounded-3 mx-2 border">
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
                                                            <li tooltip="{{ trans('labels.view') }}"
                                                                class="rounded-3 mx-2 border">
                                                                <a class="option-btn circle-round wishlist-btn rounded-0"
                                                                    onclick="productview('{{ $products->id }}')">
                                                                    <i class="fa-regular fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            @if (helper::appdata($vendordata->id)->online_order == 1)
                                                                <li tooltip="Add To Cart" class="rounded-3 mx-2 border">
                                                                    @if ($products->has_variation == 1)
                                                                        <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                            class="option-btn circle-round addtocart-btn wishlist-btn rounded-0">
                                                                            <i
                                                                                class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="option-btn circle-round addtocart-btn wishlist-btn rounded-0"
                                                                            onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                            <i
                                                                                class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            @endif
                                                        </ul>
                                                        <!-- options -->
                                                    </div>
                                                </div>

                                                <div class="card-body px-sm-2 px-1 pt-3 pb-0">
                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <p class="item-title text-muted fs-8 cursor-auto text-truncate">
                                                            {{ @$products['category_info']->name }}
                                                        </p>
                                                        @if (@helper::checkaddons('product_reviews'))
                                                            @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                                <p class="fs-8 d-flex"><i
                                                                        class="text-warning fa-solid fa-star px-1"></i><span
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
                                                <div class="card-footer px-sm-2 px-1 py-2 ">

                                                    <h6 class="text-dark fw-500 product-price cursor-auto text-truncate">

                                                        {{ helper::currency_formate($price, $products->vendor_id) }}
                                                        @if ($original_price > $price)
                                                            <del
                                                                class="text-muted fs-8 fw-normal d-block mt-1">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                        @endif
                                                    </h6>
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
        <!---------------------------------------- app download end ---------------------------------------->
        @if (!empty($appsection))
            <section class="my-md-5 my-3">
                <div class="container">
                    <div class="row bg-primary-light rounded-3 align-items-center justify-content-center p-5">
                        <div class="col-xl-5 col-lg-6 p-0 m-sm-0 d-none d-lg-block">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="u-shape-1 position-absolute top-50 start-50 translate-middle"></div>
                                <img src="{{ helper::image_path(@$appsection->image) }}"
                                    class="h-500px object-fit-cover w-100" alt="">
                            </div>
                        </div>
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 z-1 m-sm-0 m-auto text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <div class="card p-5 bg-primary h-100 rounded-3">
                                <!-- Title -->
                                <h3 class="fs-1 m-0 fw-bold text-white">{{ @$appsection->title }}</h3>
                                <p class="mb-lg-5 mb-4 mt-3 line-2 text-white">{{ @$appsection->subtitle }}</p>
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
                </div>
            </section>
        @endif
        <!-------------------------------------------- theme-14-blog-section -------------------------------------------->
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
                        <section class="theme-14-blog my-md-5 my-4">
                            <div class="container">
                                <div class="mb-md-5 mb-4">
                                    <div class="mb-4">
                                        <p class="fs-6 text-secondary text-uppercase fw-600 specks-subtitle mb-2">
                                            {{ trans('labels.blog_title') }}
                                        </p>
                                        <span
                                            class="fw-semibold fs-2 text-truncate my-2">{{ trans('labels.featured_blogs') }}
                                        </span>
                                        <div class="title-line-4 bg-secondary mt-1"></div>
                                    </div>
                                </div>
                                @foreach (helper::getblogs(@$vendordata->id, '6', '') as $key => $blog)
                                    @if ($key == 0)
                                        <div class="row g-xl-3 g-2">
                                        @else
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="card border p-2 rounded-3">
                                                    <div class="row g-3 align-items-center">

                                                        <div class="col-lg-8 col-7">
                                                            <h6 class="fw-600 mb-1 line-2"><a
                                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                                    class="text-dark">{{ $blog->title }}</a></h6>
                                                            <div class="pt-1 fs-7 line-2">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                            <div class="d-flex flex-wrap justify-content-between mt-3">
                                                                <div class="text-dark fs-8"><i
                                                                        class="fa-solid fa-calendar-days"></i><span
                                                                        class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                                </div>
                                                                <a class="fw-semibold fs-15 text-secondary"
                                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}<span
                                                                        class="mx-1"><i
                                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long' }}"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-5">
                                                            <div class="img-overlay rounded-4">
                                                                <img src="{{ helper::image_path($blog->image) }}"
                                                                    class="card-img-top w-100 object-fit-cover rounded-3 blog-height-14"
                                                                    alt="blog-image">
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
                                    <a class="btn btn-sm btn-primary rounded-3 fs-7 px-4 py-2 category-button {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
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

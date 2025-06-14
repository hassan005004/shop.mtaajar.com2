@extends('web.layout.default')

@section('contents')

    <!---------------------------------------------- theme-4-slider-main-section ---------------------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-18-slider">
            <div class="theme-18-main-banner text-animation owl-carousel owl-theme">
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
                                class="w-100 object-fit-cover img-fluid theme-18-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-end flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 p-sm-5 p-3 theme-18-line bg-secondary {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}</h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 line-2 mb-2 home-description animation-down">
                                            {{ $slider['description'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}"
                                class="w-100 object-fit-cover img-fluid theme-18-main-banner-slider" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-end flex-column">
                                <div class="row">
                                    <div
                                        class="col-xl-8 col-12 p-sm-5 p-3 theme-18-line bg-secondary {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                        <h5 class="text-white mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}</h5>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 mb-2 line-2 home-description animation-up">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-start animation-up">
                                            @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                @if ($slider['type'] == 1)
                                                    <a class="btn btn-primary rounded-5"
                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                    @elseif($slider['type'] == 2)
                                                        <a class="btn btn-primary rounded-5"
                                                            href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                        @elseif($slider['type'] == 3)
                                                            <a class="btn btn-primary rounded-5"
                                                                href="{{ $slider['custom_link'] }}" target="_blank">
                                                            @else
                                                                <a class="btn btn-primary rounded-5"
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
        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are  py-md-5 py-3">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <div class="img-whow">
                                <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                    class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2"> {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <div class="d-flex gap-3 align-items-center my-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}</p>
                            <div class="row g-3">
                                @foreach ($whoweare as $item)
                                    <div class="col-sm-6 who-we-18">
                                        <div
                                            class="serviceBox d-flex flex-column justify-content-center align-items-center">
                                            <div class="service-icon my-3 d-flex justify-content-center align-items-center">
                                                <img src="{{ helper::image_path($item->image) }}">
                                            </div>
                                            <div class="border-bottom pb-2 mb-2">
                                                <h6 class="fw-600 text-white line-1">
                                                    {{ $item->title }}
                                                </h6>
                                            </div>
                                            <p class="description text-white line-2">{{ $item->sub_title }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------------------- theme-4-category-section ---------------------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-4-category bg-primary-rgb mb-5 py-5 pro-hover">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class="text-capitalize">
                            <h2 class="fw-600 fs-4 line-1">
                                {{ trans('labels.top_categories') }}
                            </h2>
                            <div class="d-flex gap-3 align-items-center my-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <p class="fs-6 text-muted fw-normal line-1">
                                {{ trans('labels.homepage_category_subtitle') }}
                            </p>
                        </div>
                    </div>
                    <div class="theme-18-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item h-100 px-1">
                                <div class="serviceBox card h-100 rounded-0">
                                    <div class="service-icon">
                                        <img src="{{ helper::image_path($categorydata->image) }}" alt=""
                                            class="w-100">
                                    </div>
                                    <a
                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                        <h3 class="fw-600 text-secondary fs-15 line-2 text-capitalize">
                                            {{ $categorydata['name'] }}</h3>
                                    </a>
                                    <p class="description fs-7 fw-500 text-muted">
                                        {{ helper::product_count($categorydata->id) }}
                                        {{ trans('labels.items') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-sm btn-secondary rounded-5 mt-5 px-3 py-2 category-button"
                        href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                        {{ trans('labels.viewall') }}
                        <i
                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}">
                        </i>
                    </a>
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
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-4-best-Selling-product pro-hover my-5">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class=" text-uppercase">
                            <span class="fw-600 fs-4 line-1">{{ trans('labels.best_selling_product') }}</span>
                            <div class="d-flex gap-3 align-items-center my-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <p class="fs-6 text-muted fw-normal line-1">
                                {{ trans('labels.homepage_product_subtitle') }}
                            </p>
                        </div>
                    </div>
                    <div class="row row-cols-sm-2 row-cols-md-3 g-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-18.productcomonview')
                        @endforeach
                    </div>
                    <a class="btn btn-sm btn-secondary rounded-5 mt-5 px-3 py-2 category-button"
                        href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                        {{ trans('labels.viewall') }}<p
                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}">
                        </p>
                    </a>
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
        <!---------------------------------------- theme-4-new-product-section ---------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-4-best-Selling-product mb-5">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class="text-capitalize">
                            <span class="fw-600 fs-4 line-1">
                                {{ trans('labels.new_arrival_products') }}
                            </span>
                            <div class="d-flex gap-3 align-items-center my-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <p class="fs-6 text-muted fw-normal line-1">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                        </div>
                    </div>
                    <div class="new-arrival-products">
                        <div class="row row-cols-sm-2 row-cols-md-3 g-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0">
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
                                <div class="col theme-18">
                                    <div class="card h-100 product-grid bg-white rounded-0">

                                        <div class="product-image">
                                            <a class="image">
                                                <img class="pic-1"
                                                    src="{{ $getproductdata['product_image']->image_url }}">
                                            </a>
                                            @if ($off > 0)
                                                <div class="off-label-16">
                                                    <h3 class="text-center">{{ $off }}%
                                                        {{ trans('labels.off') }}</h3>
                                                </div>
                                            @endif
                                            <ul class="product-links d-flex gap-2">
                                                @if (@helper::checkaddons('customer_login'))
                                                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                        <li class="cursor-pointer">
                                                            <a
                                                                onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')">
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
                                                    <a onclick="productview('{{ $getproductdata->id }}')">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                @if (helper::appdata($vendordata->id)->online_order == 1)
                                                    <li class="cursor-pointer">
                                                        @if ($getproductdata->has_variation == 1)
                                                            <a
                                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                                                                <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="card-body border-top text-center">
                                            <h3 class="title line-2">
                                                <a
                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                                                    {{ $getproductdata->name }}
                                                </a>
                                            </h3>
                                            <span
                                                class="category m-0 line-1">{{ @$getproductdata['category_info']->name }}</span>
                                        </div>
                                        <div
                                            class="card-footer border-top d-flex align-items-center justify-content-between">
                                            <h5
                                                class="fs-7 price fw-bold product-price m-0 flex-wrap align-items-center gap-1 d-flex text-truncate">
                                                {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                                                @if ($original_price > $price)
                                                    <del class="text-muted fs-8 fw-600 d-block">
                                                        {{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}
                                                    </del>
                                                @endif
                                            </h5>
                                            <p class="fs-8 d-flex gap-1 align-items-center">
                                                <i class="text-warning fs-8 fa-solid fa-star"></i>
                                                <span class="text-dark fw-500 fs-8">
                                                    {{ number_format($getproductdata->ratings_average, 1) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a class="btn btn-sm btn-secondary rounded-5 mt-4 px-3 py-2 category-button"
                        href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                        {{ trans('labels.viewall') }} <i
                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}">
                        </i>
                    </a>
                </div>
            </section>
        @endif

        <!---------------------------------------------------- testimonial start ---------------------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial py-5 bg-secondary-rgb">
                    <div class="container">
                        <div class=" text-capitalize mb-5">
                            <h4 class="fw-semibold fs-4 line-1 text-dark">
                                {{ trans('labels.testimonial_subtitle') }}
                            </h4>
                            <div class="d-flex gap-3 align-items-center my-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <span class="fs-6 text-muted fw-normal line-1">
                                {{ trans('labels.testimonials') }}
                            </span>
                        </div>
                        <div id="testimonial-slider-18" class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100 p-1">
                                    <div
                                        class="testimonial h-100 bg-white {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                        <div class="pic">
                                            <img src="{{ helper::image_path($testimonial->image) }}">
                                        </div>
                                        <p
                                            class="description text-muted {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            "{{ $testimonial->description }}"
                                        </p>
                                        <h3
                                            class="title {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            {{ $testimonial->name }}</h3>
                                        <p
                                            class="post text-muted m-0 mt-1 {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                            {{ $testimonial->position }}</p>
                                        <ul class="rating mt-2 d-flex gap-1 align-items-center justify-content-start">
                                            @php
                                                $count = (int) $testimonial->star;
                                            @endphp
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $count)
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                @else
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fa-regular fa-star text-wring"></i>
                                                    </li>
                                                @endif
                                            @endfor
                                        </ul>
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

        <!---------------------------------------- DEALS START ---------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="theme-4-best-Selling-product bg-primary-rgb py-5 my-5" id="topdeals">
                        <div class="container">
                            <div
                                class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                                <div class="text-capitalize">
                                    <span class="fw-600 fs-4 line-1">
                                        {{ trans('labels.home_page_top_deals_subtitle') }}
                                    </span>
                                    <div class="d-flex gap-3 align-items-center my-1">
                                        <div class="heading-line m-0"></div>
                                        <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                        <div class="heading-line m-0"></div>
                                    </div>
                                    <p class="fs-6 text-muted fw-normal line-1">
                                        {{ trans('labels.home_page_top_deals_title') }}
                                    </p>
                                </div>
                                <div id="countdown"> </div>
                            </div>
                            <div id="top-deals18" class="owl-carousel owl-theme theme-18">
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
                                        <div class="card h-100 product-grid bg-white rounded-0">
                                            <div class="product-image">
                                                <a {{ URL::to(@$vendordata->slug . '/products/' . $products->slug . '?type=1') }}
                                                    class="image">
                                                    <img class="pic-1"
                                                        src="{{ $products['product_image']->image_url }}">
                                                </a>
                                                @if ($off > 0)
                                                    <div class="off-label-16">
                                                        <h3 class="text-center">{{ $off }}%
                                                            {{ trans('labels.off') }}</h3>
                                                    </div>
                                                @endif
                                                <ul class="product-links d-flex gap-2">
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li class="cursor-pointer">
                                                                <a
                                                                    onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')">
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
                                                        <a onclick="productview('{{ $products->id }}','1')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li class="cursor-pointer">
                                                            @if ($products->has_variation == 1)
                                                                <a
                                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="card-body border-top text-center">
                                                <h3 class="title">
                                                    <a
                                                        href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                        {{ $products->name }}
                                                    </a>
                                                </h3>
                                                <span class="category m-0">
                                                    {{ @$getproductdata['category_info']->name }}</span>
                                            </div>
                                            <div
                                                class="card-footer  border-top flex-wrap d-flex align-items-center justify-content-between">
                                                <h5
                                                    class="fs-7 price m-0 fw-bold product-price flex-wrap gap-1 d-flex align-items-center text-truncate">
                                                    {{ helper::currency_formate($price, $vendordata->id) }}
                                                    @if ($original_price > $price)
                                                        @if ($original_price > 0)
                                                            <del class="text-muted fs-8 fw-600 d-block">
                                                                {{ helper::currency_formate($original_price, $vendordata->id) }}
                                                            </del>
                                                        @endif
                                                    @endif
                                                </h5>

                                                @if (@helper::checkaddons('product_reviews'))
                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                        <p class="fs-8">
                                                            <i class="text-warning fs-8 fa-solid fa-star px-1"></i>
                                                            <span class="text-dark fw-500 fs-8">
                                                                {{ number_format($products->ratings_average, 1) }}
                                                            </span>
                                                        </p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                class="btn btn-sm btn-secondary rounded-5 mt-5 px-3 py-2 category-button">{{ trans('labels.viewall') }}
                                <i
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}">
                                </i>
                            </a>

                        </div>
                    </section>
                @endif
            @endif
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
                        <section class="theme-4-blog my-5">
                            <div class="container">
                                <div
                                    class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-4">
                                    <div class="text-capitalize">
                                        <span class="fw-semibold fs-4 line-1">
                                            {{ trans('labels.featured_blogs') }}
                                        </span>
                                        <div class="d-flex gap-3 align-items-center my-1">
                                            <div class="heading-line m-0"></div>
                                            <i class="fa-brands fa-pagelines fs-3 text-primary"></i>
                                            <div class="heading-line m-0"></div>
                                        </div>
                                        <p class="fs-6 text-muted fw-normal line-1">
                                            {{ trans('labels.blog_title') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="theme-18-blogs-carousel owl-carousel owl-theme">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="item p-1 h-100">
                                            <div class="card h-100 rounded-0">
                                                <img src="{{ helper::image_path($blog->image) }}"
                                                    class="products-img w-100 object-fit-cover" height="230"
                                                    alt="blog-image">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center product-line fw-600 "><a
                                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                            class="text-dark">{{ $blog->title }}</a>
                                                    </h6>
                                                    <div class="pt-1 text-center line-2 fs-7">
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


                                                    <a class="text-primary fs-15 rounded-5 px-3 py-1"
                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">

                                                        {{ trans('labels.readmore') }}<p
                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}">
                                                        </p>

                                                    </a>

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="btn btn-sm btn-secondary rounded-5 mt-4 px-3 py-2 category-button"
                                    href="{{ URL::to(@$vendordata->slug . '/blogs') }}">
                                    {{ trans('labels.viewall') }}<p
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}">
                                    </p>
                                </a>
                            </div>
                        </section>
                    @endif
                @endif
            @endif
        @endif

        <!----------------------------------------------------- app downlode end ----------------------------------------------------->
        @if (!empty($appsection))
            <section class="my-5">
                <div class="container bg-secondary-rgb rounded-0">
                    <div class="row align-items-center justify-content-lg-between justify-content-center p-5">
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

    </main>

@endsection

@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/index.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

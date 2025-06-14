@extends('web.layout.default')

@section('contents')

    <!---------------------------------- theme-14-slider-main-section ---------------------------------->
    @if (count($getsliderlist) > 0)
        <section class=" my-5">
            <div class="container">
                <div class="theme-19-main-banner slider-bots text-animation owl-carousel owl-theme rounded-3">
                    @foreach ($getsliderlist as $key => $slider)
                        <div class="item h-100 px-1">
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
                                <img src="{{ $slider['image'] }}" class="w-100 object-fit-cover rounded-3" alt="">
                                <div class="carousel-caption px-1 py-sm-4 py-3 d-flex flex-column justify-content-center">
                                    <div class="col-xl-12 theme-19-line bg-secondary p-3 p-sm-4 p-md-5">
                                        <h6 class="text-white mb-md-2 line-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}
                                        </h6>
                                        <h2 class="text-white fw-bold line-3 mb-md-3 mb-1 home-subtitle animation-down">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 line-2 mb-3 home-description animation-fade">
                                            {{ $slider['description'] }}
                                        </p>
                                    </div>
                                </div>
                                </a>
                            @else
                                <img src="{{ $slider['image'] }}" class="w-100 object-fit-cover rounded-3" alt="">
                                <div class="carousel-caption px-1 py-sm-4 py-3 d-flex flex-column justify-content-center">
                                    <div class="col-xl-12 theme-19-line bg-secondary p-3 p-sm-4 p-md-5">
                                        <h6 class="mb-md-2 mb-1 line-2 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}
                                        </h6>
                                        <h2 class="text-white fw-bold line-3 mb-md-3 mb-1 home-subtitle animation-down">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="fs-6 mb-3 line-2 home-description animation-fade">
                                            {{ $slider['description'] }}
                                        </p>
                                        @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                            @if ($slider['type'] == 1)
                                                <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                    href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                @elseif($slider['type'] == 2)
                                                    <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                        href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                    @elseif($slider['type'] == 3)
                                                        <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                            href="{{ $slider['custom_link'] }}" target="_blank">
                                                        @else
                                                            <a class="btn btn-primary bg-gradient rounded-3 animation-up"
                                                                href="javascript:void(0)">
                                            @endif
                                            {{ $slider['link_text'] }}
                                            <i
                                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right ps-2' }}"></i></a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <main>

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
                                    class="w-100 h-100 rounded-3 object-fit-cover">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!----------------------------------------------------- WHO WE ARE ----------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-secondary-rgb py-5 my-5">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-6 col-lg-6 mb-4 mb-lg-0">
                            <div class="img-whow">
                                <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                    class="w-100 h-100 object-fit-cover rounded-3" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <h4 class="wdt-heading-title line-2"> {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}</p>
                            <div class="row g-3">
                                @foreach ($whoweare as $item)
                                    <div class="col-sm-6 who-we-19">
                                        <div
                                            class="serviceBox rounded-3 bg-white p-3 d-flex flex-column justify-content-center align-items-center">
                                            <div class="service-icon my-4 d-flex justify-content-center align-items-center">
                                                <img src="{{ helper::image_path($item->image) }}" class="rounded-circle">
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
            <section class="theme-4-category mb-5">
                <div class="container">
                    <div
                        class="theme-4-title d-flex  flex-wrap gap-3 align-items-center justify-content-between text-dark mb-5">
                        <div class="text-capitalize">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <h2 class="fw-600 fs-4 line-1">
                                {{ trans('labels.top_categories') }}
                            </h2>
                            <p class="fs-6 mt-2 text-muted fw-normal line-1">
                                {{ trans('labels.homepage_category_subtitle') }}
                            </p>
                        </div>
                    </div>
                    <div class="theme-19-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item h-100 px-1">
                                <div class="serviceBox {{ session()->get('direction') == 2 ? 'rtl' : '' }} rounded-3">
                                    <div class="service-icon">
                                        <img src="{{ helper::image_path($categorydata->image) }}" alt=""
                                            class="w-100">
                                    </div>
                                    <a
                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                        <h3 class="fw-500 text-dark fs-15 px-1 line-2 text-capitalize">
                                            {{ $categorydata['name'] }}
                                        </h3>
                                    </a>
                                    <p class="description fs-8 fw-500 text-muted">
                                        {{ helper::product_count($categorydata->id) }}
                                        {{ trans('labels.items') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"
                        href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                        {{ trans('labels.viewall') }}
                        <i
                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long pe-2' : 'fa-solid fa-arrow-right-long ps-2' }}">
                        </i>
                    </a>
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
                        <div class="text-capitalize">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <span class="fw-600 fs-4 line-1">{{ trans('labels.best_selling_product') }}</span>
                            <p class="fs-6 mt-2 text-muted fw-normal line-1">
                                {{ trans('labels.homepage_product_subtitle') }}
                            </p>
                        </div>
                    </div>
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            <div class="item p-1 theme-19 h-100">
                                @include('web.theme-19.productcomonview')
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"
                        href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                        {{ trans('labels.viewall') }}
                        <p
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
                                    <img src="{{ $banner['image'] }}" class="d-block w-100 object-fit-cover rounded-3"
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
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <span class="fw-600 fs-4 line-1">
                                {{ trans('labels.new_arrival_products') }}
                            </span>
                            <p class="fs-6 text-muted fw-normal mt-2 line-1">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                        </div>
                    </div>
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            <div class="item p-1 theme-19 h-100">
                                @include('web.theme-19.productcomonview')
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button"
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
                <section class="Testimonial my-5 py-5 bg-primary-rgb">
                    <div class="container">
                        <div class=" text-capitalize mb-5">
                            <div class="d-flex gap-3 align-items-center mb-1">
                                <div class="heading-line m-0"></div>
                                <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                <div class="heading-line m-0"></div>
                            </div>
                            <h4 class="fw-semibold fs-4 line-1 text-dark">
                                {{ trans('labels.testimonial_subtitle') }}
                            </h4>
                            <span class="fs-6 text-muted fw-normal mt-2 line-1">
                                {{ trans('labels.testimonials') }}
                            </span>
                        </div>
                        <div id="testimonial-slider-19" class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                                <div class="item h-100 p-1">
                                    <div class="card rounded-3 p-2">
                                        <div class="card-body p-2 border-primary border">
                                            <img src="{{ helper::image_path($testimonial->image) }}" class="mx-auto">
                                            <p class="description my-2 fs-7 text-muted text-center">
                                                “{{ $testimonial->description }}”
                                            </p>
                                            <ul
                                                class="rating fs-8 mb-2 d-flex gap-1 align-items-center justify-content-center">
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
                                            <h6 class="mb-0 text-center fw-600 text-capitalize text-primary">
                                                {{ $testimonial->name }}
                                            </h6>
                                            <p class="fs-7 text-center text-muted m-0 mt-1 text-capitalize">
                                                {{ $testimonial->position }}
                                            </p>

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
                                <img src="{{ $banner['image'] }}" alt="banner-3" class="object-fit-cover rounded-3">
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
                                    <div class="d-flex gap-3 align-items-center mb-1">
                                        <div class="heading-line m-0"></div>
                                        <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                        <div class="heading-line m-0"></div>
                                    </div>
                                    <span class="fw-600 fs-4 line-1">
                                        {{ trans('labels.home_page_top_deals_subtitle') }}
                                    </span>
                                    <p class="fs-6 text-muted mt-2 fw-normal line-1">
                                        {{ trans('labels.home_page_top_deals_title') }}
                                    </p>
                                </div>
                                <div id="countdown"> </div>
                            </div>
                            <div class="theme-19-product-slider owl-carousel owl-theme">
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
                                    <div class="item h-100 p-1 theme-19">
                                        <div class="card h-100 product-grid rounded-3 overflow-hidden">
                                            <div class="product-image">
                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                    class="image">
                                                    <img class="pic-1"
                                                        src="{{ $products['product_image']->image_url }}">
                                                    <img class="pic-2"
                                                        src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}">
                                                </a>
                                                @if ($off > 0)
                                                    <span class="theme-19-ribbon">
                                                        <h3>{{ $off }}% {{ trans('labels.off') }}</h3>
                                                    </span>
                                                @endif
                                                <ul class="product-links text-center">
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li class="fs-7">
                                                            @if ($products->has_variation == 1)
                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                    class="fs-7 fw-500">
                                                                    {{ trans('labels.addtocart') }}
                                                                </a>
                                                            @else
                                                                <a class="fs-7 fw-500"
                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                    {{ trans('labels.addtocart') }}
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
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
                                                        <a onclick="productview('{{ $products->id }}')">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body border-top">
                                                <div class="d-flex align-items-center gap-1 mb-2 justify-content-between">
                                                    <span class="fs-7 fw-500 text-muted m-0 line-1">
                                                        {{ @$getproductdata['category_info']->name }}
                                                    </span>
                                                    @if (@helper::checkaddons('product_reviews'))
                                                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                            <p class="fs-8 d-flex align-items-center">
                                                                <i class="text-warning fs-8 fa-solid fa-star"></i>
                                                                <span class="text-dark fw-500 fs-8">
                                                                    {{ number_format($products->ratings_average, 1) }}
                                                                </span>
                                                            </p>
                                                        @endif
                                                    @endif
                                                </div>
                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                    class="text-dark">
                                                    <h3 class="fs-15 text-capitalize fw-600 line-2 m-0 border-bottom-0">
                                                        {{ $products->name }}
                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="card-footer pt-0 pb-3">
                                                <h5
                                                    class="fs-7 text-secondary m-0 fw-bold product-price align-items-center gap-1 d-flex flex-wrap w-100 text-truncate">
                                                    {{ helper::currency_formate($price, $vendordata->id) }}
                                                    @if ($original_price > $price)
                                                        @if ($original_price > 0)
                                                            <del class="text-muted fs-8 fw-600 d-block">
                                                                {{ helper::currency_formate($original_price, $vendordata->id) }}
                                                            </del>
                                                        @endif
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                class="btn btn-sm btn-primary rounded-5 mt-5 px-3 py-2 category-button">{{ trans('labels.viewall') }}
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
                                        <div class="d-flex gap-3 align-items-center mb-1">
                                            <div class="heading-line m-0"></div>
                                            <i class="fa-solid fa-tree fs-3 text-primary"></i>
                                            <div class="heading-line m-0"></div>
                                        </div>
                                        <span class="fw-600 fs-4 line-1">
                                            {{ trans('labels.featured_blogs') }}
                                        </span>
                                        <p class="fs-6 text-muted mt-2 fw-normal line-1">
                                            {{ trans('labels.blog_title') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="theme-18-blogs-carousel owl-carousel owl-theme">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="item p-1 h-100">
                                            <div class="card h-100 rounded-3">
                                                <img src="{{ helper::image_path($blog->image) }}"
                                                    class="products-img w-100 object-fit-cover p-3 pb-0" height="230"
                                                    alt="blog-image">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center product-line fw-600 ">
                                                        <a href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                            class="text-dark">
                                                            {{ $blog->title }}
                                                        </a>
                                                    </h6>
                                                    <div class="pt-1 text-center line-2 fs-7">
                                                        {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                    </div>
                                                </div>
                                                <div
                                                    class="card-footer pb-3 blog-footer d-flex justify-content-between align-items-center">
                                                    <div class="d-flex fs-8">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <div
                                                            class="px-1 fs- {{ session()->get('direction') == 2 ? 'theme-4-blog-date' : 'blog-date' }}">
                                                            {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                                        </div>
                                                    </div>
                                                    <a class="text-primary fw-600 border-bottom border-primary fs-15 "
                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                        {{ trans('labels.readmore') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="btn btn-sm btn-primary rounded-5 mt-4 px-3 py-2 category-button"
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
                <div class="container bg-secondary-rgb rounded-3">
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

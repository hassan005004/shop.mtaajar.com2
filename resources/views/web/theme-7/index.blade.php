@extends('web.layout.default')
@section('contents')
    <!------------------------------------------------ theme-7-slider-main-section ------------------------------------------------>
    @if (count($getsliderlist) > 0)
        <section class="theme-7-slider bg-primary-rgb-main">
            <div class="theme-7-main-banner owl-carousel owl-theme h-100">
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
                            <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div class="text-center">
                                        <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2 class="text-primary fw-bold mb-md-3 mb-1 home-subtitle">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-primary fs-18 mb-md-5 mb-4 home-description">
                                            {{ $slider['description'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div class="text-center">
                                        <h5 class="text-secondary mb-md-2 mb-1 text-uppercase ls-3">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2 class="text-primary fw-bold mb-md-3 mb-1 home-subtitle">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-primary fs-18 mb-md-5 mb-4 home-description">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-auto btn_block">
                                                @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                    @if ($slider['type'] == 1)
                                                        <a class="btn btn__secondary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                        @elseif($slider['type'] == 2)
                                                            <a class="btn btn__secondary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                            @elseif($slider['type'] == 3)
                                                                <a class="btn btn__secondary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                    href="{{ $slider['custom_link'] }}" target="_blank">
                                                                @else
                                                                    <a class="btn btn__secondary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                                        href="javascript:void(0)">
                                                    @endif{{ $slider['link_text'] }} <i
                                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2' }}"></i></a>
                                                @endif
                                                <div
                                                    class="btn_bottom-sec {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
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
    <main class="bg-primary-rgb-main theme-7">

        <!-------------------------------------------------------- WHO WE ARE -------------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-primary-rgb py-md-5 py-3">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-5 col-lg-6 mb-4 mb-lg-0">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->whoweare_image) }}"
                                class="theme-7-border w-100 object-fit-cover" alt="">
                        </div>
                        <div class="col-xl-7 col-lg-6 order-2 order-lg-0">
                            <span
                                class="wdt-heading-subtitle text-truncate mb-2">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                            <h4 class="wdt-heading-title line-2">{{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                            </h4>
                            <p class="wdt-heading-content-wrapper line-2">
                                {{ helper::appdata($vendordata->id)->whoweare_description }}
                            </p>
                            <div class="pb-0 row">
                                @foreach ($whoweare as $item)
                                    <div class="col-lg-6 col-12 align-items-start mb-xl-4 mb-lg-2 mb-3">
                                        <div class="d-flex gap-2 align-items-center py-2 col-12 ">
                                            <div class="position-relative">
                                                <img src="{{ helper::image_path($item->image) }}"
                                                    class="icon-lg bg-success col-3 bg-opacity-10 text-success rounded-circle p-1"
                                                    alt="">
                                                <div class="card-drop-border rounded-5"></div>
                                            </div>

                                            <h5 class="fw-600 line-2">{{ $item->title }}</h5>
                                        </div>
                                        <p class="mb-0 fs-7 line-2">{{ $item->sub_title }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!------------------------------------------------ theme-7-category-section ------------------------------------------------>
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-7-category my-md-5 my-4">
                <div class="container">
                    <div class="d-lg-flex gap-3 align-items-center">
                        <div class="col-lg-4 row justify-content-center pb-lg-0 pb-5">
                            <div class="mb-lg-0 mb-4 col-auto">
                                <p class="fs-6 text-uppercase text-center  fw-normal specks-subtitle mb-1">
                                    {{ trans('labels.homepage_category_subtitle') }}
                                </p>
                                <div class="title-line-2 mb-2 mx-auto"></div>
                                <span
                                    class="text-dark wdt-heading-title line-1 text-capitalize">{{ trans('labels.choose_by_category') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div
                                class="theme-7-category-slider owl-carousel owl-theme {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                                    <div class="item p-md-0 p-1 h-100 card-border-main">
                                        <div
                                            class="card position-relative h-100 shadow-none outline-none theme-7-border overflow-hidden border-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                            <div class="align-items-center">
                                                <div class="cat-img-7">
                                                    <a
                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                                        <img src="{{ helper::image_path($categorydata->image) }}"
                                                            class="w-100 object-fit-cover" alt="category image"></a>
                                                </div>
                                                <div class="card-footer p-3">
                                                    <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                                        class="card-title text-dark fs-15 choose-by-category-name line-2 m-0">{{ $categorydata['name'] }}</a
                                                        href="javascript:void(0)">
                                                    <p class="fs-13">{{ helper::product_count($categorydata->id) }}
                                                        {{ trans('labels.items') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-drop-border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <div class="col-auto">
                            <div class="btn_block w-100">
                                <a class="btn btn__primary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                    href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                                    {{ trans('labels.viewall') }}<span
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                </a>
                                <div class="btn_bottom {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


        <!---------------------------------------------------- new top-bar-offer ---------------------------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            <div class="overflow-hidden offers-theme">
                <div class="offer-badge-7 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                    {{ trans('labels.best_offers') }}
                </div>
                <div class="offers-7 text-secondary">
                    @include('web.coupon.index')
                </div>
            </div>
        @endif
        <!---------------------------------------------- theme-7-offer-banner-1-section -------------------------------------------->
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-7-offer-banner-1 py-md-5 py-4">
                <div class="container">
                    <div class="theme-7-offer-banner-1-carousel owl-carousel owl-theme">
                        @foreach ($getbannerslist['bannersection1'] as $banner)
                            <div class="item p-md-0 p-1 card-border-main">
                                <div
                                    class="card theme-7-border border-0 overflow-hidden {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
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
                                <div class="card-drop-border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif


        <!------------------------------------------ theme-7-best-Selling-Products-section ------------------------------------------>
        <section class="theme-7-best-Selling-product py-md-5 py-4">
            <div class="container">
                <div class="row justify-content-center text-center align-items-center mb-md-5 mb-4">
                    <div class="mb-md-0 mb-2 col-auto text-center">
                        <p class="fs-6 text-uppercase  fw-normal specks-subtitle mb-1">
                            {{ trans('labels.homepage_product_subtitle') }}
                        </p>
                        <div class="title-line-2 mb-2 mx-auto"></div>
                        <span
                            class="text-dark wdt-heading-title text-truncate text-capitalize">{{ trans('labels.best_selling_product') }}</span>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-md-4 g-3">
                    @foreach ($getbestsellingproducts as $getproductdata)
                        @include('web.theme-7.productcomonview')
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-md-4 mt-3">
                    <div class="col-auto">
                        <div class="btn_block w-100">
                            <a class="btn btn__primary {{ session()->get('direction') == 2 ? 'rtl' : ' ' }} w-100"
                                href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                            <div class="btn_bottom {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!---------------------------------------------- theme-7-offer-banner-2-section ---------------------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-7-offer-banner-3 py-5">
                <div class="container">
                    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner card-border-main">
                            @foreach ($getbannerslist['bannersection2'] as $key => $banner)
                                <div class="carousel-item theme-7-border border-0 card {{ $key == 0 ? 'active' : '' }} {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                    data-bs-interval="4000">
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
                                    </a>
                                </div>
                                <div class="card-drop-border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"></div>
                            @endforeach
                        </div>
                        @if (count($getbannerslist['bannersection2']) > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left slider-arrows"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"><i
                                        class="fa-solid fa-arrow-right slider-arrows"></i></span>
                                <span class="visually-hidden">{{ trans('pagination.next') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!------------------------------------------------ theme-7-new-product-section ----------------------------------------------->
        @if ($getnewarrivalproducts->count() > 0)
            <section class="theme-7-new-product py-md-5 py-3">
                <div class="container">
                    <div class="row justify-content-center text-center align-items-center mb-md-5 mb-4">
                        <div class="mb-md-0 mb-2 col-auto text-center">
                            <p class="fs-6 text-uppercase  fw-normal specks-subtitle mb-1">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                            <div class="title-line-2 mb-2 mx-auto"></div>
                            <span
                                class="text-dark wdt-heading-title text-truncate text-capitalize">{{ trans('labels.new_arrival_products') }}</span>
                        </div>

                    </div>
                    <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1 p-0 g-3">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @include('web.theme-7.newproductcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-4 mt-3">
                        <div class="col-auto">
                            <div class="btn_block w-100">
                                <a class="btn btn__primary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                    href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                    {{ trans('labels.viewall') }}<span
                                        class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                </a>
                                <div class="btn_bottom {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------------------- theme-7-offer-banner-3-section ---------------------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-7-offer-banner-3 py-md-5 py-4">
                <div class="container">
                    <div class="theme-7-offer-banner-3-carousel owl-carousel owl-theme overflow-hidden">
                        @foreach ($getbannerslist['bannersection3'] as $banner)
                            <div class="item p-md-0 p-1 card-border-main">
                                <div
                                    class="card border-0 theme-7-border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
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
                                        class="object-fit-cover theme-7-border">
                                    </a>
                                </div>
                                <div class="card-drop-border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"></div>
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
                    <section class="theme-7-deals py-sm-100 py-4" id="topdeals">
                        <div class="container">
                            <div class="py-4 theme-7-border bg-secondary">
                                <div class="row justify-content-center text-center align-items-center mb-md-5 mb-4">
                                    <div class="mb-md-0 mb-2 col-auto text-center">
                                        <p class="text-white text-uppercase text-truncate mb-2">
                                            {{ trans('labels.home_page_top_deals_title') }}
                                        </p>
                                        <div class="title-line-2 mb-2 mx-auto"></div>
                                        <span
                                            class="text-white wdt-heading-title text-truncate text-capitalize">{{ trans('labels.home_page_top_deals_subtitle') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card col-auto mx-auto mb-md-5 mb-4 p-0 theme-7-border margin-sm">
                                        <div id="countdown" class=" countdown-border"> </div>
                                    </div>
                                    <div class="col-11 mx-auto">
                                        <div id="top-deals-slider" class="owl-carousel owl-theme card-border-main">
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
                                                <div class="position-relative h-100 mx-1">
                                                    <div class="item h-100 product-item-side-7 p-2 d-flex">
                                                        <div class="col-lg-5 col-6">
                                                            <div
                                                                class="item-img position-relative overflow-hidden theme-7-border">
                                                                <a
                                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                    <img src="{{ $products['product_image']->image_url }}"
                                                                        class="w-100 h-100 img-fluid object-fit-cover pic-1"
                                                                        alt="">
                                                                    <img src="{{ $products['multi_image']->count() > 0 ? $products['multi_image'][0]->image_url : $products['multi_image'][1]->image_url }}"
                                                                        class="w-100 pic-2 object-fit-cover"
                                                                        alt="">
                                                                </a>
                                                                @if ($off > 0)
                                                                    <span
                                                                        class="{{ session()->get('direction') == 2 ? 'sale-label-7-rtl' : 'sale-label-7' }}">{{ $off }}%
                                                                        {{ trans('labels.off') }}</span>
                                                                @endif
                                                            </div>
                                                            <a></a>
                                                        </div>
                                                        <div class="col-lg-7 col-6 px-1">
                                                            <div class="card-body item-content p-2 pb-0 h-150">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between mb-md-2">
                                                                    <p
                                                                        class="card-title fs-8 text-muted m-0 text-truncate">
                                                                        {{ @$products['category_info']->name }}</p>

                                                                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                                        <p class="fs-8 d-flex"><i
                                                                                class="text-warning fs-8 fa-solid fa-star px-1"></i><span
                                                                                class="text-white fs-8 fw-500">{{ number_format($products->ratings_average, 1) }}</span>
                                                                        </p>
                                                                    @endif

                                                                </div>

                                                                <a
                                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                    <h5 class="text-white product-name line-2 h-42">
                                                                        {{ $products->name }}
                                                                    </h5>
                                                                </a>
                                                                <h5
                                                                    class="text-white fs-7 fw-semibold product-price-size mt-3 mb-2 cursor-auto text-truncate">

                                                                    {{ helper::currency_formate($price, $products->vendor_id) }}
                                                                    @if ($original_price > $price)
                                                                        <del
                                                                            class="text-primary fs-8 fw-500 d-block mt-1">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                                    @endif
                                                                </h5>
                                                            </div>

                                                            <div class="card-footer d-md-block d-none">
                                                                <!-- options -->
                                                                <ul
                                                                    class="option-wrap d-flex align-items-center mt-2 w-100">
                                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                                        <li tooltip="{{ trans('labels.add_to_cart') }}"
                                                                            class="rounded-circle mx-sm-2 mx-1">
                                                                            @if ($products->has_variation == 1)
                                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-3">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            @else
                                                                                <a href="javascript:void(0)"
                                                                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-3"
                                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            @endif
                                                                        </li>
                                                                    @endif
                                                                    <li tooltip="{{ trans('labels.view') }}"
                                                                        class="rounded-circle mx-sm-2 mx-1">
                                                                        <a class="option-btn circle-round wishlist-btn rounded-3"
                                                                            onclick="productview('{{ $products->id }}')">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                        <li tooltip="Wishlist"
                                                                            class="rounded-circle mx-sm-2 mx-1">
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
                                                                </ul>
                                                                <!-- options -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-drop-border-primary"></div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-md-4 mt-3">
                                    <div class="col-auto">
                                        <div class="btn_block w-100 ">
                                            <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                                class="btn btn__primary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">{{ trans('labels.viewall') }}<i
                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left pe-2' : 'fa-solid fa-arrow-right  ps-2' }}"></i></a>
                                            <div class="btn_bottom {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        @endif
        <!----------------------------------------------------- TESTIMONIAL START ---------------------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial mb-5">
                    <div class="container position-relative">
                        <span
                            class="wdt-heading-subtitle fw-normal text-center text-truncate">{{ trans('labels.testimonials') }}</span>
                        <h4 class="wdt-heading-title text-center text-truncate mb-5">
                            {{ trans('labels.testimonial_subtitle') }}
                        </h4>
                        <div class="col-11 mx-auto">
                            <div id="testimonial7" class="owl-carousel owl-theme ">
                                @foreach ($testimonials as $testimonial)
                                    <div class="item p-md-0 p-1">

                                        <div class="card-border-main">
                                            <div
                                                class="card theme-7-border overflow-hidden {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                <div class="client-profile d-flex align-items-center p-3">
                                                    <img src="{{ helper::image_path($testimonial->image) }}"
                                                        class="w-100 mx-2 theme-7-client-img" alt="">
                                                    <div>
                                                        <p class="client-name"> {{ $testimonial->name }} - <span
                                                                class="profession">
                                                                {{ $testimonial->position }}</span></p>
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
                                                <div class="p-3 description-box ">
                                                    <p class="fs-7 description position-relative">“
                                                        {{ $testimonial->description }}”</p>
                                                </div>
                                            </div>
                                            <div
                                                class="card-drop-border {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
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

        <!-------------------------------------------------- app downlode end -------------------------------------------------->
        @if (!empty($appsection))
            <section class="py-md-5 py-4 ">
                <div class="container rounded-0">
                    <div
                        class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5 theme-7-border bg-gradient-primary section-border-secondary">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold text-dark">{{ @$appsection->title }}</h3>
                            <p class="mb-lg-5 mb-4 mt-3 text-dark line-2">{{ @$appsection->subtitle }}</p>
                            <!-- Button -->
                            <div class="hstack justify-content-center justify-content-lg-start gap-3 ">
                                <!-- Google play store button -->
                                <div class="card-border-main position-relative">

                                    <a href="{{ @$appsection->android_link }}"
                                        class="card rounded-3 border-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                        <img src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/google-play.svg') }}"
                                            class="g-play rounded-3" alt=""> </a>
                                    <div
                                        class="card-drop-border rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    </div>

                                </div>
                                <!-- App store button -->
                                <div class="card-border-main position-relative">

                                    <a href="{{ @$appsection->ios_link }}"
                                        class="card rounded-3 border-0 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                        <img src="{{ url(env('ASSETPATHURL') . 'admin-assets/images/other/app-store.svg') }}"
                                            class="g-play rounded-3" alt=""> </a>
                                    <div
                                        class="card-drop-border rounded-3 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                    </div>
                                </div>

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
        <!--------------------------------------------------- theme-7-blog-section --------------------------------------------------->
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
                        <section class="theme-7-blog py-md-5 py-4">
                            <div class="container">
                                <div class="row justify-content-center text-center align-items-center mb-md-5 mb-4">
                                    <div class="mb-md-0 mb-2 col-auto text-center">
                                        <p class="text-uppercase text-truncate mb-2">{{ trans('labels.blog_title') }}
                                        </p>
                                        <div class="title-line-2 mb-2 mx-auto"></div>
                                        <span
                                            class="text-dark wdt-heading-title text-truncate text-capitalize">{{ trans('labels.featured_blogs') }}</span>
                                    </div>

                                </div>
                                <div class="row g-3 g-xl-4 justify-content-between">
                                    @foreach (helper::getblogs(@$vendordata->id, '4', '') as $key => $blog)
                                        <div class="col-md-6">
                                            <div class="card-border-main position-relative">

                                                <div
                                                    class="card border-0 theme-7-border p-2 {{ session()->get('direction') == 2 ? 'rtl-card' : ' ' }}">
                                                    <div class="row align-items-center">
                                                        <div class="col-xl-4 col-lg-5 col-6 mb-0">
                                                            <div class="img-overlay rounded-4">
                                                                <img src="{{ helper::image_path($blog->image) }}"
                                                                    class="card-img-top w-100 object-fit-cover theme-7-border sub-blog-height-7"
                                                                    alt="blog-image">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-8 col-lg-7 col-6">
                                                            <div class="h-135">
                                                                <div class="text-secondary fs-8 mb-2"><i
                                                                        class="fa-solid fa-calendar-days"></i><span
                                                                        class="px-1 fw-500 text-truncate">{{ helper::date_formate($blog->created_at, $blog->vendor_id) }}</span>
                                                                </div>
                                                                <h6 class="fw-bold mb-1 line-2"><a
                                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}"
                                                                        class="text-dark">{{ $blog->title }}</a></h6>
                                                                <div class="pt-1 fs-7 line-2">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                            </div>
                                                            <div class="mt-3">
                                                                <a class="fw-semibold text-primary-color fs-15 btn-border px-2 py-1"
                                                                    href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ trans('labels.readmore') }}<span
                                                                        class="mx-1"><i
                                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left-long' : 'fa-solid fa-arrow-right-long' }}"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="card-drop-border {{ session()->get('direction') == 2 ? 'rtl-card' : ' ' }}">
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center mt-md-4 mt-3">
                                    <div class="col-auto">
                                        <div class="btn_block w-100">
                                            <a class="btn btn__primary w-100 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}"
                                                href="{{ URL::to(@$vendordata->slug . '/blogs') }}">
                                                {{ trans('labels.viewall') }}<span
                                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                            </a>
                                            <div class="btn_bottom {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                            </div>
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

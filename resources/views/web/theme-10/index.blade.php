@extends('web.layout.default')
@section('contents')
    <!------------------------------------------ theme-10-slider-main-section --------------------------------------->
    @if (count($getsliderlist) > 0)
        <section class="theme-10-home-slider bg-primary-rgb">
            <div id="theme-10-home-slider" class=" owl-carousel owl-theme">
                @foreach ($getsliderlist as $key => $slider)
                    <div class="item position-relative">
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
                            <img src="{{ $slider['image'] }}" class="img-fluid object-fit-cover" alt="">
                            <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h5
                                            class="text-white mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounce">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2
                                            class="text-white fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-4 mb-2 home-description line-2 ">
                                            {{ $slider['description'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            </a>
                        @else
                            <img src="{{ $slider['image'] }}" class="img-fluid object-fit-cover" alt="">
                            <div class="carousel-caption pb-0 h-100 d-flex justify-content-center flex-column">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h5
                                            class="text-white mb-md-2 mb-1 text-uppercase ls-3 animate__animated animate__bounce">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <h2
                                            class="text-white fw-bold mb-md-3 mb-1 home-subtitle animate__animated animate__bounceInLeft">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-4 mb-2 home-description line-2 ">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-center animate__animated animate__fadeInDown">
                                            @if ($slider['link_text'] != '' || $slider['link_text'] != null)
                                                @if ($slider['type'] == 1)
                                                    <a class="btn btn-fashion rounded-3"
                                                        href="{{ URL::to(@$vendordata->slug . '/category?category=' . @$slider['category_info']->slug) }}">
                                                    @elseif($slider['type'] == 2)
                                                        <a class="btn btn-fashion rounded-3"
                                                            href="{{ URL::to(@$vendordata->slug . '/products-' . $slider['product_info']->slug) }}">
                                                        @elseif($slider['type'] == 3)
                                                            <a class="btn btn-fashion rounded-3"
                                                                href="{{ slider['custom_link'] }}" target="_blank">
                                                            @else
                                                                <a class="btn btn-fashion rounded-3"
                                                                    href="javascript:void(0)">
                                                @endif{{ $slider['link_text'] }}</a>
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
    <main class="bg-primary-rgb theme-10">

        <!-------------------------------------------- theme-10-offer-banner-1-section ------------------------------------------>
        @if (count($getbannerslist['bannersection1']) > 0)
            <section class="theme-10-offer-banner-1 py-md-5 py-4  bg-primary-rgb-dark">
                <div class="container">
                    <div class="offer-banner-1-carousel owl-carousel owl-theme">
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

        <!---------------------------------------------- theme-10-category-section ---------------------------------------------->
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-10-category mb-4 m-md-5 mt-4">
                <div class="container">
                    <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                        <div class="col-auto  mb-md-0 mb-2">
                            <div class="col-auto">
                                <span class="fs-6 text-uppercase fw-500 specks-subtitle pb-1">
                                    {{ trans('labels.homepage_category_subtitle') }}
                                </span>
                                <div class="title-line-2 mb-2"></div>
                                <span
                                    class="wdt-heading-title line-1 text-truncate text-capitaliz">{{ trans('labels.choose_by_category') }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-secondary rounded-3 fs-7 theme-10-button px-3 py-2"
                                href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                    <div class="theme-10-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item h-100">
                                <div
                                    class="card p-2 h-100 shadow-none outline-none rounded-3 bg-primary  border-0 overflow-hidden">
                                    <div class="card-body px-sm-3 px-1 text-center">
                                        <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}"
                                            class="card-title text-dark categories-name-10 line-2 m-0">{{ $categorydata['name'] }}</a
                                            href="#">
                                        <p class="text-dark fs-13">{{ helper::product_count($categorydata->id) }}
                                            {{ trans('labels.items') }}</p>
                                    </div>
                                    <div class="cat-img-10">
                                        <a
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                            <img src="{{ helper::image_path($categorydata->image) }}"
                                                class="w-100 object-fit-cover rounded-3 cat-img-8" alt="category image"></a>
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

        <!---------------------------------------- theme-10-best-Selling-Products-section --------------------------------------->
        <section class="theme-10-best-Selling-product py-md-5 py-4">
            <div class="container">
                <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                    <div class="col-auto">
                        <p class="fs-6 text-uppercase fw-500 specks-subtitle pb-1">
                            {{ trans('labels.homepage_product_subtitle') }}
                        </p>
                        <div class="title-line-2"></div>
                        <span
                            class="wdt-heading-title text-truncate text-capitalize">{{ trans('labels.best_selling_product') }}</span>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2 theme-10-button"
                            href="{{ URL::to(@$vendordata->slug . '/products-best-selling-products') }}">
                            {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
                <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3">
                    @foreach ($getbestsellingproducts as $getproductdata)
                        @include('web.theme-10.productcomonview')
                    @endforeach
                </div>
            </div>
        </section>
        <!------------------------------------------------------ WHO WE ARE ----------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are py-md-5 py-3">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 order-2 order-lg-0">
                            <div class="col-auto">
                                <span
                                    class="fs-6 text-uppercase fw-500 specks-subtitle pb-1">{{ helper::appdata($vendordata->id)->whoweare_title }}</span>
                                <div class="title-line-2"></div>
                                <h4 class="wdt-heading-title line-2 mt-2">
                                    {{ helper::appdata($vendordata->id)->whoweare_subtitle }}
                                </h4>
                            </div>
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
                                            <div class="col-xl-10 col-lg-12 col-md-9">
                                                <h5 class="px-2 fw-600">{{ $item->title }}</h5>
                                                <p class="mb-0 fs-7 line-2 text-lightslategray px-2">
                                                    {{ $item->sub_title }}</p>
                                            </div>
                                        </div>
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
        <!------------------------------------------- theme-10-offer-banner-2-section ---------------------------------------------->
        @if (count($getbannerslist['bannersection2']) > 0)
            <section class="theme-10-offer-banner-3 py-5">
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
        <!---------------------------------------------- theme-10-new-product-section --------------------------------------------->
        @if (count($getnewarrivalproducts) > 0)
            <section class="theme-10-new-product py-5 bg-gradient-primary">
                <div class="container">
                    <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                        <div class="col-auto">
                            <p class="fs-6 text-uppercase fw-500 specks-subtitle pb-1">
                                {{ trans('labels.new_arrival_product_subtitle') }}
                            </p>
                            <div class="title-line-2"></div>
                            <span
                                class="wdt-heading-title text-truncate text-capitalize mt-2">{{ trans('labels.new_arrival_products') }}</span>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2 theme-10-button"
                                href="{{ URL::to(@$vendordata->slug . '/products-newest') }}">
                                {{ trans('labels.viewall') }}<span
                                    class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                            </a>
                        </div>
                    </div>
                    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 p-0 g-sm-4 g-3">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-10.productcomonview')
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!------------------------------------------ theme-10-offer-banner-3-section ------------------------------------------->
        @if (count($getbannerslist['bannersection3']) > 0)
            <section class="theme-10-offer-banner-3 py-md-5 py-4">
                <div class="container">
                    <div class="theme-10-offer-banner-3-carousel owl-carousel owl-theme">
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
        <!--------------------------------------------------- DEALS START -------------------------------------------------->
        @if (@helper::checkaddons('top_deals'))
            @if (!empty(helper::top_deals($vendordata->id)))
                @if (count($topdealsproducts) > 0)
                    <section class="theme-10-deals py-5 bg-secondary-rgb rounded-4" id="topdeals">
                        <div class="container">
                            <div class="row justify-content-between align-items-center mb-md-5 mb-4 px-sm-2">
                                <div class="col-auto">
                                    <p class="fs-6 text-uppercase fw-500 specks-subtitle pb-1">
                                        {{ trans('labels.home_page_top_deals_title') }}
                                    </p>
                                    <div class="title-line-2"></div>
                                    <span
                                        class="wdt-heading-title text-truncate text-capitalize mt-2">{{ trans('labels.home_page_top_deals_subtitle') }}</span>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                        class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2 theme-10-button">{{ trans('labels.viewall') }}
                                        <i
                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div id="countdown"
                                    class="card col-auto mx-auto mb-md-5 mb-4 p-1 countdown-border rounded-3"> </div>

                                <div id="top-deals10" class="owl-carousel owl-theme pb-sm-4 pb-3">
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
                                            <div
                                                class="card border-0 rounded-3 position-relative h-100 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                <div class="card-border overflow-hidden rounded-3">
                                                    <div class="">
                                                        <div class="card-body p-sm-3 p-2 h-139 h-157">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-md-2">
                                                                <p class="card-title fs-8  m-0 text-truncate">
                                                                    {{ @$products['category_info']->name }}
                                                                </p>
                                                                @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                                                                    <p class="fs-8">
                                                                        <i
                                                                            class="text-warning fs-8 fa-solid fa-star px-1"></i>
                                                                        <span class="text-dark fw-500 fs-8">
                                                                            {{ number_format($products->ratings_average, 1) }}
                                                                        </span>
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <a
                                                                href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                <h5 class="truncate-2 text-dark product-name line-2">
                                                                    {{ $products->name }}
                                                                </h5>
                                                            </a>
                                                            <div
                                                                class="d-flex flex-wrap gap-2 justify-content-between align-items-center mt-2">
                                                                <h5
                                                                    class="text-dark fs-7 fw-semibold product-price-size cursor-auto text-truncate col-sm-auto col-12 order-sm-0 order-2">
                                                                    @if ($original_price > $price)
                                                                        <del
                                                                            class="fs-8 fw-normal d-block mt-1 text-lightslategray">
                                                                            {{ helper::currency_formate($original_price, $products->vendor_id) }}
                                                                        </del>
                                                                    @endif
                                                                    {{ helper::currency_formate($price, $products->vendor_id) }}
                                                                </h5>
                                                                @if ($off > 0)
                                                                    <div class="sale-label-10 col-auto rounded-2">
                                                                        {{ $off }}% {{ trans('labels.off') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="card-img position-relative">
                                                                <div class="card-layer">
                                                                    <img src="{{ $products['product_image']->image_url }}"
                                                                        class="w-100 h-100 img-fluid object-fit-cover"
                                                                        alt="">
                                                                    <img src="{{ $products['multi_image']->count() > 1 ? $products['multi_image'][1]->image_url : $products['multi_image'][0]->image_url }}"
                                                                        class="w-100 img-2" alt="">
                                                                </div>

                                                                <!-- options -->
                                                                <ul
                                                                    class="option-wrap d-flex justify-content-center align-items-center d-grid product_icon2 px-2 w-auto {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                                                    @if (@helper::checkaddons('customer_login'))
                                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                                            <li tooltip="Wishlist" class="m-0">
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
                                                                                            <i
                                                                                                class="fa-solid fa-heart"></i>
                                                                                        @else
                                                                                            <i
                                                                                                class="fa-regular fa-heart"></i>
                                                                                        @endif
                                                                                    @else
                                                                                        <i class="fa-regular fa-heart"></i>
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                    <li tooltip="{{ trans('labels.view') }}"
                                                                        class="m-0">
                                                                        <a class="option-btn circle-round wishlist-btn"
                                                                            onclick="productview('{{ $products->id }}')">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                                        <li tooltip="{{ trans('labels.add_to_cart') }}"
                                                                            class="rounded-circle m-0">
                                                                            @if ($products->has_variation == 1)
                                                                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}"
                                                                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-3">
                                                                                    <i
                                                                                        class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                                </a>
                                                                            @else
                                                                                <a href="javascript:void(0);"
                                                                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-3"
                                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','','','{{ URL::to(@$vendordata->slug . '/cart/add') }}')">
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
                                                    </div>
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
        <!--------------------------------------------------- TESTIMONIAL START ---------------------------------------------------->
        @if (@helper::checkaddons('store_reviews'))
            @if ($testimonials->count() > 0)
                <section class="Testimonial py-sm-5">
                    <div class="container position-relative">
                        <div class="col-auto mb-md-5 mb-4">
                            <span
                                class="fs-6 fw-500 text-uppercase d-block pb-1">{{ trans('labels.testimonials') }}</span>
                            <div class="title-line-2"></div>
                            <h4 class="wdt-heading-title text-truncate mt-2">{{ trans('labels.testimonial_subtitle') }}
                            </h4>
                        </div>
                        <div id="testimonial10" class="owl-carousel owl-theme mt-md-5 mt-4">
                            @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="p-4 mb-3 rounded-3">
                                        <div class="client-profile">
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
                                            <p class="fs-7 text-capitalize my-4">“ {{ $testimonial->description }}”</p>

                                            <div class="d-flex">
                                                <img src="{{ helper::image_path($testimonial->image) }}"
                                                    class="w-100 theme-10-client-img m-0" alt="">
                                                <div class="px-3">
                                                    <p class="client-name"> {{ $testimonial->name }} <span
                                                            class="profession fs-7 d-block">
                                                            {{ $testimonial->position }}</span></p>

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

        <!-------------------------------------------------- app downlode end ------------------------------------------------->
        @if (!empty($appsection))
            <section class="py-md-5 py-3">
                <div class="container rounded-0">
                    <div
                        class="row align-items-center justify-content-lg-between justify-content-center g-3 p-5 bg-border border-dark rounded-5">
                        <div
                            class="col-xl-7 col-lg-6 col-12 col-md-9 m-sm-0 m-auto z-1 text-center {{ session()->get('direction') == 2 ? 'text-lg-end' : 'text-lg-start' }}">
                            <!-- Title -->
                            <h3 class="fs-1 m-0 fw-bold">{{ @$appsection->title }}</h3>
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
                                    class="h-500px object-fit-cover w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!------------------------------------------------ theme-10-blog-section ------------------------------------------------->
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
                        <section class="theme-10-blog py-md-5 py-4">
                            <div class="container">
                                <div class="row justify-content-between align-items-center mb-md-5 mb-4">
                                    <div class="col-auto">
                                        <span
                                            class="fs-6 fw-500 text-uppercase pb-1">{{ trans('labels.blog_title') }}</span>
                                        <div class="title-line-2"></div>
                                        <span
                                            class="wdt-heading-title text-truncate text-capitalize mt-2">{{ trans('labels.featured_blogs') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-sm btn-secondary rounded-3 fs-7 px-3 py-2 theme-10-button"
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
                                            <div class="col-sm-6">
                                                <div class="card h-100 border-0 rounded-3 overflow-hidden">
                                                    <div class="d-flex align-items-center ">
                                                        <div class="col-xl-4 col-5 mb-0">
                                                            <img src="{{ helper::image_path($blog->image) }}"
                                                                class="blog-img-10 w-100 object-fit-cover" height="230"
                                                                alt="blog-image">
                                                        </div>
                                                        <div class="col-xl-8 col-7">
                                                            <div class="card-body py-2">
                                                                <div
                                                                    class="mb-2 {{ @helper::appdata(@$vendordata->id)->web_layout == 1 ? 'text-start' : 'text-end' }}">
                                                                </div>
                                                                <h6 class="card-title fw-600 mb-1 line-2"><a
                                                                        class=" text-dark"
                                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">{{ $blog->title }}</a>
                                                                </h6>
                                                                <div class="line-2 pt-1 fs-7 text-dark">
                                                                    {!! strip_tags(Str::limit($blog->description, 200)) !!}
                                                                </div>
                                                                <div
                                                                    class="d-lg-flex align-items-center justify-content-between mt-3">
                                                                    <div class="d-flex fs-8">
                                                                        <i class="fa-regular fa-clock"></i>
                                                                        <p class="text-dark px-1">
                                                                            {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                                                        </p>
                                                                    </div>
                                                                    <a class="text-secondary fs-15 rounded-2"
                                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                                        {{ trans('labels.readmore') }}<span
                                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
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

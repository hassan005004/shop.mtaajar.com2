@extends('web.layout.default')
@section('contents')
    <!------------------------------------------------ theme-5-slider-main-section ------------------------------------------------>
    @if (count($getsliderlist) > 0)
        <section class="theme-8-slider">
            <div class="theme-8-main-banner-17 slider-bots text-animation owl-carousel owl-theme">
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
                            <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center">
                                    <div
                                        class="col-xl-7 col-lg-9 col-12 bg-primary shadow-lg p-3 p-md-4 p-lg-5 text-center">
                                        <h5 class="text-secondary fw-500 mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <div class="d-flex justify-content-center align-items-center my-1 animation-down">
                                            <div class="heading-line"></div>
                                            <i class="fa-solid fa-feather-pointed fs-3 text-white text-shadow"></i>
                                            <div class="heading-line"></div>
                                        </div>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
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
                            <img src="{{ $slider['image'] }}" class="w-100 h-100 object-fit-cover img-fluid" alt="">
                            <div class="carousel-caption pb-0 d-flex justify-content-center flex-column">
                                <div class="row justify-content-center">
                                    <div
                                        class="col-xl-7 col-lg-9 col-12 shadow-lg bg-primary p-3 p-md-4 p-lg-5 text-center">
                                        <h5 class="text-secondary fw-500 mb-md-2 mb-1 text-uppercase ls-3 animation-down">
                                            {{ $slider['title'] }}
                                        </h5>
                                        <div class="d-flex justify-content-center align-items-center my-1 animation-down">
                                            <div class="heading-line"></div>
                                            <i class="fa-solid fa-feather-pointed fs-3 text-white text-shadow"></i>
                                            <div class="heading-line"></div>
                                        </div>
                                        <h2 class="text-white fw-bold mb-md-3 mb-1 home-subtitle animation-down">
                                            {{ $slider['sub_title'] }}
                                        </h2>
                                        <p class="text-white fs-18 mb-md-5 line-2 mb-2 home-description animation-up">
                                            {{ $slider['description'] }}
                                        </p>
                                        <div class="d-flex justify-content-center animation-up">
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
    <main>
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
        <!---------------------------------------------- WHO WE ARE ------------------------------------------------->
        @if ($whoweare->count() > 0)
            <section class="who-we-are bg-secondary-rgb py-5 mb-md-5 mb-4">
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
                                    <div class="col-md-6 theme-17">
                                        <div class="card rounded-0 shadow border-0 p-3">
                                            <div class="serviceBox {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                <div
                                                    class="service-icon {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                    <img src="{{ helper::image_path($item->image) }}"
                                                        class="rounded-circle">
                                                </div>
                                                <div
                                                    class="service-content {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                    <h6 class="fw-600 mb-2 line-1">{{ $item->title }}</h6>
                                                    <p class="description line-2">
                                                        {{ $item->sub_title }}
                                                    </p>
                                                </div>
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

        <!------------------------------------------------ theme-17-category-section ------------------------------------------------>
        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
            <section class="theme-5-category">
                <div class="container">
                    <div class="text-center text-uppercase mb-md-5 mb-4">
                        <span class="fw-600 fs-4 category-title text-dark text-truncate">
                            {{ trans('labels.choose_by_category') }}
                        </span>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <p class="fs-6 text-muted fw-normal specks-subtitle mb-2">
                            {{ trans('labels.homepage_category_subtitle') }}
                        </p>
                    </div>
                    <div class="theme-17-category-slider owl-carousel owl-theme">
                        @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                            <div class="item h-100">
                                <div class="card bg-primary-rgb rounded-0 text-center border-0 h-100">
                                    <div class="card-body">
                                        <div class="theme-17-cat">
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
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
                            href="{{ URL::to(@$vendordata->slug . '/categories') }}"> {{ trans('labels.viewall') }}<span
                                class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
        <!---------------------------------------------------- new top-bar-offer ---------------------------------------------------->
        @if (!empty($coupons) && $coupons->count() > 0)
            @include('web.coupon.index')
        @endif
        <!------------------------------------------ theme-17-best-Selling-Products-section ------------------------------------------>
        @if (count($getbestsellingproducts) > 0)
            <section class="theme-5-best-Selling-product my-md-5 my-4">
                <div class="container">
                    <div class="text-center text-uppercase mb-md-5 mb-4">
                        <span class="fw-600 text-dark fs-4 category-title text-truncate">
                            {{ trans('labels.best_selling_product') }}
                        </span>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <p class="fs-6 text-muted fw-normal specks-subtitle mb-2 text-truncate">
                            {{ trans('labels.homepage_product_subtitle') }}
                        </p>

                    </div>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                        @foreach ($getbestsellingproducts as $getproductdata)
                            @include('web.theme-17.productcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
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
            <section class="theme-5-offer-banner-3 py-5">
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
            <section class="theme-5-new-product">
                <div class="container">
                    <div class="text-center text-uppercase mb-5">
                        <span class="fw-600 text-dark fs-4 category-title text-truncate">
                            {{ trans('labels.new_arrival_products') }}
                        </span>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <p class="fs-6 text-muted fw-normal specks-subtitle mb-2 text-truncate">
                            {{ trans('labels.new_arrival_product_subtitle') }}
                        </p>
                    </div>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 p-0  g-md-4 g-3">
                        @foreach ($getnewarrivalproducts as $getproductdata)
                            @include('web.theme-17.productcomonview')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-md-5 mt-4">
                        <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
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
            <section class="theme-5-offer-banner-3 my-md-5 my-4">
                <div class="container-fluid">
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
                    <section class="theme-5-new-product bg-primary-rgb py-100 card-img-2" id="topdeals">
                        <div class="container">
                            <div class="mb-4 text-uppercase theme-3-title text-center">
                                <h3 class="fw-600  text-truncate">
                                    {{ trans('labels.home_page_top_deals_subtitle') }}
                                </h3>
                                <div class="d-flex justify-content-center align-items-center my-1">
                                    <div class="heading-line"></div>
                                    <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                                    <div class="heading-line"></div>
                                </div>
                                <p class="text-muted fw-normal text-truncate mb-2">
                                    {{ trans('labels.home_page_top_deals_title') }}
                                </p>
                            </div>
                            <div id="countdown" class="mt-4 mb-5"> </div>
                            <div id="top-deals17" class="owl-carousel owl-theme">
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
                                    <div class="item h-100 bg-white mx-sm-2 theme-17">
                                        <div class="card rounded-0 border-0 h-100 product-grid">
                                            <div class="product-image">
                                                <a class="image">
                                                    <img class="pic-1"
                                                        src="{{ $products['product_image']->image_url }}">
                                                    <img class="pic-2"
                                                        src="{{ $products['multi_image']->count() > 0 ? $products['multi_image'][0]->image_url : $products['multi_image'][1]->image_url }}">
                                                </a>
                                                @if ($off > 0)
                                                    <span class="theme-17-ribbon">
                                                        <h3>{{ $off }}% {{ trans('labels.off') }}</h3>
                                                    </span>
                                                @endif
                                                <ul class="social">
                                                    @if (helper::appdata($vendordata->id)->online_order == 1)
                                                        <li>
                                                            @if ($getproductdata->has_variation == 1)
                                                                <a
                                                                    href="{{ URL::to(@$vendordata->slug . '/products/' . $products->slug) }}">
                                                                    <div class="fs-8 d-flex align-items-center gap-1">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        {{ trans('labels.cart') }}
                                                                    </div>
                                                                </a>
                                                            @else
                                                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                                                    onclick="calladdtocart('{{ $products->id }}','{{ $products->slug }}','{{ $products->name }}','{{ $products['product_image'] == null ? 'product.png' : $products['product_image']->image }}','{{ $products->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                                    <div class="fs-8 d-flex align-items-center gap-1">
                                                                        <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                                                        {{ trans('labels.cart') }}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a onclick="productview('{{ $products->id }}')">
                                                            <div class="fs-8 d-flex align-items-center gap-1">
                                                                <i class="fa-regular fa-eye"></i>
                                                                {{ trans('labels.view') }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @if (@helper::checkaddons('customer_login'))
                                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                                            <li>
                                                                <a
                                                                    onclick="managefavorite('{{ $products->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')">
                                                                    <div class="fs-8 d-flex align-items-center gap-1">
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
                                            <div class="card-body pb-0 product-content">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between gap-1 mb-1 align-items-center">
                                                    <p class="card-title fs-8 line-2 m-0 text-truncate">
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
                                            <div class="card-footer product-content">
                                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                                    <h5 class="text-dark fs-7 fw-600 m-0 text-truncate">
                                                        {{ helper::currency_formate($price, $products->vendor_id) }}
                                                    </h5>
                                                    @if ($original_price > $price)
                                                        <del
                                                            class="text-muted fs-8 fw-600">{{ helper::currency_formate($original_price, $products->vendor_id) }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center my-4">
                                <a href="{{ URL::to(@$vendordata->slug . '/topdeals?type=1') }}"
                                    class="btn btn-sm btn-primary rounded-2 px-2 py-2 mt-3">{{ trans('labels.viewall') }}
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
                        <h4 class="wdt-heading-title text-center text-truncate ">
                            {{ trans('labels.testimonial_subtitle') }}
                        </h4>
                        <div class="d-flex justify-content-center align-items-center my-1">
                            <div class="heading-line"></div>
                            <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                            <div class="heading-line"></div>
                        </div>
                        <span class="wdt-heading-subtitle fw-normal mb-sm-5 mb-4 text-center text-truncate">
                            {{ trans('labels.testimonials') }}
                        </span>
                        <div class="col-12">
                            <div id="testimonial-slider-17" class="owl-carousel owl-theme">
                                @foreach ($testimonials as $testimonial)
                                    <div class="item">
                                        <div class="testimonial-17">
                                            <p class="description {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                                                "{{ $testimonial->description }}"
                                            </p>
                                            <div class="pic p-1">
                                                <img src="{{ helper::image_path($testimonial->image) }}" alt="avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="testimonial-prof">
                                                <h4>{{ $testimonial->name }}</h4>
                                                <small class="text-muted">{{ $testimonial->position }}</small>
                                                <ul class="list-inline small mb-3">
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
            <section class="my-md-5 my-4">
                <div class="container bg-light rounded-0">
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
                        <section class="theme-5-blog mb-md-5 mb-4">
                            <div class="container">
                                <div class="text-center text-uppercase mb-md-5 mb-4">
                                    <span
                                        class="fw-600 text-dark fs-4 category-title">{{ trans('labels.featured_blogs') }}</span>
                                    <div class="d-flex justify-content-center align-items-center my-1">
                                        <div class="heading-line"></div>
                                        <i class="fa-solid fa-feather-pointed fs-3 text-primary"></i>
                                        <div class="heading-line"></div>
                                    </div>
                                    <p class="fs-6 text-muted fw-normal specks-subtitle mb-2 text-truncate">
                                        {{ trans('labels.blog_title') }}
                                    </p>
                                </div>
                                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
                                    @foreach (helper::getblogs(@$vendordata->id, '6', '') as $blog)
                                        <div class="col">
                                            <div class="card rounded-0 h-100 border-0 p-3 shadow">
                                                <img src="{{ helper::image_path($blog->image) }}"
                                                    class="products-img w-100 object-fit-cover" height="230"
                                                    alt="blog-image">
                                                <div class="card-body px-0 pb-0">
                                                    <h6 class="card-title text-dark fw-medium mb-1 line-2">
                                                        <a
                                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                            {{ $blog->title }}
                                                        </a>
                                                    </h6>
                                                    <div class="line-2 fs-7 pt-1">{!! strip_tags(Str::limit($blog->description, 200)) !!}</div>
                                                </div>
                                                <div
                                                    class="card-footer px-0 d-flex align-items-center justify-content-between">
                                                    <div class="d-flex fs-8">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p class="text-dark px-1">
                                                            {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                                        </p>
                                                    </div>
                                                    <a class="fs-7 fw-600 text-secondary rounded-2"
                                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blog->slug) }}">
                                                        {{ trans('labels.readmore') }}<span
                                                            class="{{ session()->get('direction') == 2 ? 'fa-solid fa-arrow-left px-2' : 'fa-solid fa-arrow-right px-2' }}"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center mt-md-5 mt-4">
                                    <a class="btn btn-sm btn-primary rounded-2 px-2 py-2 category-button"
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

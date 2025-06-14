@extends('web.layout.default')

@section('contents')

    <!-- BREADCRUMB AREA START -->

    <section class="py-5 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <h2 class="breadcrumb-title">{{ trans('labels.top_deals') }}</h2>
                <ol class="breadcrumb justify-content-center">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('labels.top_deals') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->

    <!-- PRODUCTS LIST AREA START -->
    <div id="countdown" class="mt-5 mb-4"></div>
    <section class="mt-3 mb-4">
        <div class="container">
            <div class="d-flex bg-primary-rgb p-3 rounded-3 justify-content-between align-items-center">
                <span class="fs-15 fw-600">
                    {{ trans('labels.showing') }}
                    {{ $topdealsproducts->firstItem() ? $topdealsproducts->firstItem() : 0 }}–{{ $topdealsproducts->lastItem() ? $topdealsproducts->lastItem() : 0 }}
                    {{ trans('labels.of') }}
                    {{ $topdealsproducts->total() }} {{ trans('labels.result') }}
                </span>
                <ul class="d-flex flex-nowrap justify-content-end gap-2 nav nav-pills nav-pills-dark" id="tour-pills-tab"
                    role="tablist">
                    <!-- Tab item -->
                    <li class="nav-item">
                        <a class="nav-link view-list-grid cursor-pointer text-dark border border-dark service-active"
                            id="column" tooltip="Grid view">
                            <i class="fa-solid fa-grid-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link view-list-grid cursor-pointer text-dark border border-dark" id="grid"
                            tooltip="List view">
                            <i class="fa-solid fa-list-ul"></i>
                        </a>
                    </li>
                    <!-- Tab item -->
                </ul>
            </div>
        </div>
    </section>
    <section class="">
        <div class="container pb-5">
            @if (count($topdealsproducts) > 0)
                <div class="listing-view">
                    @if (helper::appdata(@$vdata)->theme == 1)
                        <div
                            class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-md-4 g-3 best-product pro-hover">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.productcommonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 2)
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-md-4 g-3 mb-4">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-2.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 3)
                        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-md-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-3.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 4)
                        <div
                            class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0 product-list">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-4.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 5)
                        <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-5.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 6)
                        <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-6.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 7)
                        <div
                            class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-md-4 g-3 theme-7-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-7.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 8)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-8-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-8.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 9)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-9-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-9.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 10)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-10">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-10.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 11)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-11 theme-11-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-11.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 12)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-12 theme-12-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-12.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 13)
                        <div class="row g-sm-3 g-2 theme-13-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-13.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 14)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-14-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-14.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 15)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-15-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-15.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 16)
                        <div
                            class="row row-cols-xl-4 row-cols-lg-3 theme-16 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-16.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 17)
                        <div
                            class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-17 theme-5-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-17.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 18)
                        <div
                            class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-18 theme-4-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-18.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 19)
                        <div
                            class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-19 theme-4-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                <div class="col">
                                    @include('web.theme-19.productcomonview')
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 20)
                        <div
                            class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-20 theme-15-best-Selling-product">
                            @foreach ($topdealsproducts as $getproductdata)
                                <div class="col">
                                    @include('web.theme-20.productcomonview')
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div id="column-view" class="d-none">
                    @if (helper::appdata(@$vdata)->theme == 1)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3 g-sm-4">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-1.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 2)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3 g-sm-4">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-2.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 3)
                        <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1 g-3 g-sm-4">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-3.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 4)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-0">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-4.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 5)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-md-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-5.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 6)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-md-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-6.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 7)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-md-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-7.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 8)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1 g-sm-3 g-2">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-8.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 9)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-sm-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-9.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 10)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-sm-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-10.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 11)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-sm-3 g-2">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-11.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 12)
                        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-1 g-sm-3 g-2">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-12.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 13)
                        <div class="row g-sm-3 g-2">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-13.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 14)
                        <div class="row g-sm-3 g-2">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-14.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 15)
                        <div class="row g-sm-4 g-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-15.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 16)
                        <div class="row g-2 g-sm-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 theme-16">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-16.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 17)
                        <div class="row g-2 g-sm-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-17.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 18)
                        <div class="row g-2 g-sm-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-18.newproductcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 19)
                        <div class="theme-19-product-slider2 owl-carousel owl-theme">
                            @foreach ($topdealsproducts as $getproductdata)
                                <div class="item p-1 theme-19 h-100">
                                    @include('web.theme-19.newproductcomonview')
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 20)
                        <div class="top-deals20-2 owl-carousel owl-theme">
                            @foreach ($topdealsproducts as $getproductdata)
                                <div class="item p-1 theme-20 h-100">
                                    @include('web.theme-20.newproductcomonview')
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                @include('web.nodata')
            @endif

            {{ $topdealsproducts->appends(request()->query())->links() }}
        </div>

    </section>

    <!-- PRODUCTS LIST AREA END -->

@endsection

@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/products.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

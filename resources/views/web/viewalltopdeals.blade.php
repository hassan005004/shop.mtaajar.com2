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
    <section class="">
        <div class="container py-5">
            <div id="topdeals">
                @if (count($topdealsproducts) > 0)
                    <div id="countdown" class="mb-5"></div>
                    @if (helper::appdata(@$vdata)->theme == 1)
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 best-product pro-hover">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.productcommonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 2)
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mb-4">
                            @foreach ($topdealsproducts as $getproductdata)
                                @include('web.theme-2.productcomonview')
                            @endforeach
                        </div>
                    @endif
                    @if (helper::appdata(@$vdata)->theme == 3)
                        <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">
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
                @else
                    @include('web.nodata')
                @endif

                {{ $topdealsproducts->appends(request()->query())->links() }}
            </div>
            <div id="nodata" class="d-none">
                @include('web.nodata')
            </div>
        </div>

    </section>

    <!-- PRODUCTS LIST AREA END -->

@endsection

@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/products.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/top_deals.js') }}"></script>
@endsection

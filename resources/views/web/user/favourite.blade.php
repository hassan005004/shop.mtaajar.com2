@extends('web.layout.default')
@section('contents')
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.favorite') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section>
        <div class="container my-5">
            <div class="row">
                @include('web.user.sidebar')
                <div class="col-lg-9 col-xxl-9">
                    <div class="border rounded-2 p-3 h-100">
                        <div class="mb-3 pb-3 border-bottom d-flex justify-content-between gap-1">
                            <h5 class="text-dark m-0 profile-title">
                                {{ trans('labels.my_favorite_list') }}</h5>
                            <ul class="d-flex flex-nowrap justify-content-end gap-2 nav nav-pills nav-pills-dark"
                                id="tour-pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link view-list-grid text-dark border border-dark service-active"
                                        id="column" tooltip="Grid view">
                                        <i class="fa-solid fa-grid-2"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link view-list-grid text-dark border border-dark" id="grid"
                                        tooltip="List view">
                                        <i class="fa-solid fa-list-ul"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @if ($getfavourite->count() > 0)
                            <div class="listing-view">
                                @if (helper::appdata(@$vdata)->theme == 1)
                                    <div
                                        class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-3 best-product pro-hover product-list">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.productcommonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 2)
                                    <div
                                        class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-3 theme-2-new-products">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-2.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 3)
                                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-3.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 4)
                                    <div
                                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-2 g-3 theme-4-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-4.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 5)
                                    <div
                                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-2 g-3 theme-5-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-5.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 6)
                                    <div
                                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-2 g-3 ">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-6.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 7)
                                    <div
                                        class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-3 theme-7-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-7.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 8)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-8-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-8.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 9)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-9-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-9.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 10)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-10">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-10.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 11)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-11 theme-11-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-11.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 12)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-12 theme-12-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-12.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 13)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-13-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-13.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 14)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-14-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-14.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 15)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-15.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 16)
                                    <div
                                        class="row row-cols-xl-4 row-cols-lg-3 theme-16 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-16.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 17)
                                    <div
                                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-2 g-3 theme-17 theme-5-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-17.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 18)
                                    <div
                                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-2 g-3 theme-18 theme-4-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-18.productcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 19)
                                    <div class="theme-19-product-slider owl-carousel owl-theme">
                                        @foreach ($getfavourite as $getproductdata)
                                            <div class="item p-1 theme-19 h-100">
                                                @include('web.theme-19.productcomonview')
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 20)
                                    <div class="top-deals20 owl-carousel owl-theme">
                                        @foreach ($getfavourite as $getproductdata)
                                            <div class="item p-1 theme-20 h-100">
                                                @include('web.theme-20.productcomonview')
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div id="column-view" class="d-none">
                                @if (helper::appdata(@$vdata)->theme == 1)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-1.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 2)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-2.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 3)
                                    <div
                                        class="row row-cols-xl-2 row-cols-lg-3 row-cols-md-2 row-cols-1 g-3 theme-3-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-3.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 4)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-4.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 5)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-5.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 6)
                                    <div
                                        class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3 theme-6-best-Selling-product">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-6.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 7)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-7.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 8)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-8.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 9)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-9.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 10)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-10.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 11)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-11.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 12)
                                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-12.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 13)
                                    <div class="row g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-13.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 14)
                                    <div class="row g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-14.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 15)
                                    <div class="row g-3">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-15.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 16)
                                    <div class="row g-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 theme-16">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-16.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 17)
                                    <div class="row g-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-17.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 18)
                                    <div class="row g-3 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2">
                                        @foreach ($getfavourite as $getproductdata)
                                            @include('web.theme-18.newproductcomonview')
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 19)
                                    <div class="theme-19-product-slider2 owl-carousel owl-theme">
                                        @foreach ($getfavourite as $getproductdata)
                                            <div class="item p-1 theme-19 h-100">
                                                @include('web.theme-19.newproductcomonview')
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if (helper::appdata(@$vdata)->theme == 20)
                                    <div class="top-deals20-2 owl-carousel owl-theme">
                                        @foreach ($getfavourite as $getproductdata)
                                            <div class="item p-1 theme-20 h-100">
                                                @include('web.theme-20.newproductcomonview')
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            {{-- <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 fav-sec product-list">
                                @foreach ($getfavourite as $getproductdata)
                                    @include('web.productcommonview')
                                @endforeach
                            </div> --}}
                            <div class="d-flex justify-content-center mt-3">
                                {!! $getfavourite->links() !!}
                            </div>
                        @else
                            @include('web.nodata')
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

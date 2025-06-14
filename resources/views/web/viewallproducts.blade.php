@extends('web.layout.default')
@section('contents')
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li
                        class="{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    @if (request()->category_slug == null || request()->category_slug == '')
                        <li class="text-muted {{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                            aria-current="page">{{ trans('labels.shop_all') }}</li>
                    @else
                        <li
                            class="{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                            <a class="text-dark"
                                href="{{ URL::to(@$vendordata->slug . '/categories') }}">{{ trans('labels.categories') }}</a>
                        </li>
                    @endif
                    @if (!empty($getcategorydata))
                        @if (empty($getsubcategorydata))
                            <li class="text-muted {{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                                aria-current="page">{{ $getcategorydata->name }}</li>
                        @else
                            <li
                                class="{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                                <a class="text-dark"
                                    href="{{ URL::to(@$vendordata->slug . '/category?category=' . $getcategorydata->slug) }}">{{ $getcategorydata->name }}</a>
                            </li>
                        @endif
                    @endif
                    @if (!empty($getsubcategorydata))
                        <li class="text-muted {{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                            aria-current="page">{{ $getsubcategorydata->name }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <!-- PRODUCTS LIST AREA START -->
    <section class="product-list">
        <div class="container my-5">

            @if (!empty(@helper::appdata(@$vendordata->id)->viewallpage_banner))
                <img class="w-100 mb-4 object-fit-cover rounded h-250-px"
                    src="{{ helper::image_path(@helper::appdata(@$vendordata->id)->viewallpage_banner) }}">
            @endif
            <div class="filter bg-light px-2 rounded-3 py-4 row mt-4 mb-4 gap-2">
                <div class="col-12 col-md-auto">
                    <div class="row mb-3 gx-3 mb-md-0">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="category" class="form-label">{{ trans('labels.categories') }}</label>
                            <select class="form-select form-select-sm select-auto-expand form-select-p"
                                aria-label="Default select example"
                                onchange="location =  $('option:selected',this).data('value');" name="category"
                                id="category">
                                <option class="select-auto-expand__select"
                                    data-value="{{ URL::to($vendordata->slug . '/products?category=' . '&subcategory=' . request()->get('subcategory')) }}"
                                    selected>
                                    {{ trans('labels.select') }}</option>
                                @foreach (helper::getcategories(@$vendordata->id, '') as $category)
                                    <option class="select-auto-expand__select"
                                        {{ request()->category_slug == $category->slug || request()->get('category') == $category->slug ? 'selected' : '' }}
                                        value="{{ $category->slug }}"
                                        data-value="{{ URL::to($vendordata->slug . '/products?category=' . $category->slug) }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @php
                            if (request()->has('category')) {
                                $category = request()->get('category');
                            } else {
                                $category = request()->category_slug;
                            }
                        @endphp
                        <div class="col-12 col-md-6">
                            <label for="subcategory" class="form-label">{{ trans('labels.sub_categories') }}</label>
                            <select class="form-select form-select-sm select-auto-expand form-select-p"
                                aria-label="Default select example"
                                onchange="location =  $('option:selected',this).data('value');" name="subcategory"
                                id="subcategory">
                                <option class="select-auto-expand__select"
                                    data-value="{{ URL::to(@$vendordata->slug . '/products?category=' . $category . '&subcategory=') }}"
                                    selected>{{ trans('labels.select') }}
                                </option>
                                @foreach ($subcategories as $subcategory)
                                    <option class="select-auto-expand__select" value="{{ $subcategory->slug }}"
                                        data-value="{{ URL::to(@$vendordata->slug . '/products?category=' . $category . '&subcategory=' . $subcategory->slug) }}"
                                        {{ request()->get('subcategory') == $subcategory->slug ? 'selected' : '' }}>
                                        {{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <label for="filter_by" class="form-label">{{ trans('labels.filter_by') }}</label>
                    <select class="form-select form-select-sm form-select-p w-100 select-auto-expand"
                        onchange="location = $(this).find(':selected').attr('data-url');" name="filter_by">
                        <option class="select-auto-expand__select"
                            data-url="{{ URL::to(@$vendordata->slug . '/products-all?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory')) }}"
                            selected>
                            {{ trans('labels.select') }}</option>
                        <option class="select-auto-expand__select"
                            data-url="{{ URL::to(@$vendordata->slug . '/products-newest?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory')) }}"
                            {{ strpos(request()->url(), 'newest') ? 'selected' : '' }}>
                            {{ trans('labels.newest') }}</option>
                        <option class="select-auto-expand__select"
                            data-url="{{ URL::to(@$vendordata->slug . '/products-oldest?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory')) }}"
                            {{ strpos(request()->url(), 'oldest') ? 'selected' : '' }}>
                            {{ trans('labels.oldest') }}</option>
                        <option class="select-auto-expand__select"
                            data-url="{{ URL::to(@$vendordata->slug . '/products-best-selling-products?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory')) }}"
                            {{ strpos(request()->url(), 'best-selling-products') ? 'selected' : '' }}>
                            {{ trans('labels.best_selling_products') }}</option>
                        <option class="select-auto-expand__select"
                            data-url="{{ URL::to(@$vendordata->slug . '/products-price-low-high?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory')) }}"
                            {{ strpos(request()->url(), 'price-low-high') ? 'selected' : '' }}>
                            {{ trans('labels.price_low_high') }}</option>
                        <option class="select-auto-expand__select"
                            data-url="{{ URL::to(@$vendordata->slug . '/products-price-high-low?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory')) }}"
                            {{ strpos(request()->url(), 'price-high-low') ? 'selected' : '' }}>
                            {{ trans('labels.price_high_low') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            @if (count($getproductslist) > 0)
                @if (helper::appdata(@$vdata)->theme == 1)
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 best-product pro-hover">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.productcommonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 2)
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mb-4">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-2.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 3)
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-3.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 4)
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0 product-list">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-4.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 5)
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-5.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 6)
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-6.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 7)
                    <div
                        class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-md-4 g-3 theme-7-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-7.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 8)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-8-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-8.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 9)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-9-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-9.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 10)
                    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-10">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-10.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 11)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-11 theme-11-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-11.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 12)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-12 theme-12-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-12.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 13)
                    <div class="row g-sm-3 g-2 theme-13-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-13.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 14)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-14-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-14.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 15)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-15-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-15.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 16)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 theme-16 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-16.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 17)
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-17 theme-5-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-17.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 18)
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-18 theme-4-best-Selling-product">
                        @foreach ($getproductslist as $getproductdata)
                            @include('web.theme-18.productcomonview')
                        @endforeach
                    </div>
                @endif

                @if (helper::appdata(@$vdata)->theme == 19)
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        @foreach ($getproductslist as $getproductdata)
                            <div class="item p-1 theme-19 h-100">
                                @include('web.theme-19.productcomonview')
                            </div>
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 20)
                    <div class="top-deals20 owl-carousel owl-theme">
                        @foreach ($getproductslist as $getproductdata)
                            <div class="item p-1 theme-20 h-100">
                                @include('web.theme-20.productcomonview')
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                @include('web.nodata')
            @endif
            {{ $getproductslist->appends(request()->query())->links() }}
            <!-- PRODUCTS LIST AREA END -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/products.js') }}"></script>
@endsection

@extends('landing.layout.default')
@section('content')
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 gap-2">
                    <li class="breadcrumb-item">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted breadcrumb-item active d-flex gap-2" aria-current="page">{{ trans('landing.our_stors') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    {{-- <section class="py-5 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <h3 class="breadcrumb-title fw-semibold mb-2 text-center">{{ trans('landing.our_stors') }}</h3>
                <ol class="breadcrumb justify-content-center">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('landing.our_stors') }}</li>
                </ol>
            </nav>
        </div>
    </section> --}}
    <!-- slaider-section start -->
    <section>
        <div class="owl-carousel hotels-slaider owl-theme">
            @foreach ($banners as $banner)
                <a href="{{ URL::to('/' . $banner['vendor_info']->slug) }}" target="_blank">
                    <div class="item item-1">
                        <img src="{{ helper::image_path($banner->image) }}" class="mg-fluid">
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    <!-- slaider-section end -->
    <!--card-section start -->
    <section>
        <div class="container">


            <form action="{{ URL::to('/stores') }}" method="get">
                <div class="row d-flex justify-content-center align-items-center mt-4">
                    <div class="col-12">
                        <div class="card shadow w-100 border-0 d-flex">
                            <div class="card-header p-3 bg-white">
                                <h5 class="fw-600 m-0">
                                    {{ trans('landing.find_your_shope') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="select-input-box">
                                            <label for="city"
                                                class="form-lables mb-1 hotel-label">{{ trans('landing.store_category') }}</label>
                                            <select name="store" class="form-select p-2 fs-7" id="store">
                                                <option value="">{{ trans('landing.select') }}</option>
                                                @foreach ($storecategory as $store)
                                                    <option value="{{ $store->name }}"
                                                        {{ request()->get('store') == $store->name ? 'selected' : '' }}>
                                                        {{ $store->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="country"
                                            class="form-lables mb-1 hotel-label">{{ trans('landing.city') }}</label>
                                        <select name="country" class="form-select p-2 fs-7" id="country">
                                            <option value=""
                                                data-value="{{ URL::to('/stores?country=' . '&city=' . request()->get('city')) }}"
                                                data-id="0" selected>{{ trans('landing.select') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->name }}"
                                                    data-value="{{ URL::to('/stores?country=' . request()->get('country') . '&city=' . request()->get('city')) }}"
                                                    data-id={{ $country->id }}
                                                    {{ request()->get('country') == $country->name ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="select-input-box">
                                            <label for="city"
                                                class="form-lables mb-1 hotel-label">{{ trans('landing.area') }}</label>
                                            <select name="city" class="form-select p-2 fs-7" id="city">
                                                <option value="">{{ trans('landing.select') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 d-flex flex-column justify-content-end">
                                        <div class="d-flex align-items-center justify-content-center mt-4">
                                            <label class="form-lables mb-1 hotel-label"></label>
                                            <button type="submit"
                                                class="btn btn-primary py-2 m-0 w-100 btn-class">{{ trans('landing.submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if ($stores->count() > 0)
                <div class="title-restaurant text-center">
                    @if (!empty(request()->get('city')) && request()->get('city') != null)
                        <h5 class="my-5">{{ trans('landing.stores_in') }} {{ @$city_name }}</h5>
                    @endif
                </div>
                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xll-4 g-3 pt-4">
                    @foreach ($stores as $store)
                        <div class="col">
                            <a href="{{ URL::to('/' . $store->slug) }}" target="_blank">
                                <div class="card rounded-2 h-100 overflow-hidden view-all-hover">
                                    <img src="{{ helper::image_path(helper::appdata($store->id)->cover_image) }}"
                                        class="card-img-top rounded-0 object-fit-cover img-fluid object-fit-cover"
                                        alt="...">
                                    <div class="card-body px-sm-3 px-2">
                                        <h6 class="card-title fs-15 fw-600 hotel-title">
                                            {{ helper::appdata($store->id)->web_title }}
                                        </h6>
                                        <p class="hotel-subtitle fs-8 text-muted">
                                            {{ helper::appdata($store->id)->footer_description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">

                    {!! $stores->links() !!}

                </div>
            @else
                <div class="mt-4">
                    @include('admin.layout.no_data')
                </div>
            @endif
        </div>
    </section>
    <!--card-section end-->

    <!-- subscription -->
    @include('landing.newslatter')
@endsection
@section('scripts')
    <script>
        var cityurl = "{{ URL::to('admin/getcity') }}";
        var select = "{{ trans('landing.select') }}";
        var cityname = "{{ request()->get('city') }}";
    </script>
    <script src="{{ url(env('ASSETPATHURL') . '/landing/js/store.js') }}"></script>
@endsection

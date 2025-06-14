@extends('web.layout.default')
@section('contents')
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark"
                            href="{{ URL::to(@$vendordata->slug . '/blogs') }}">{{ trans('labels.blogs') }}</a></li>
                    @if (!empty($blogdetails))
                        <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                            aria-current="page">{{ $blogdetails->title }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <!-- BLOG DETAILS AREA START -->
    <section class="py-4">
        <div class="container">
            @if (!empty($blogdetails))
                <div class="row">
                    <div class="blog-details">
                        <div class="card border-0 rounded-0">
                            <img src="{{ helper::image_path($blogdetails->image) }}" class="card-img-top rounded-0"
                                alt="...">
                            <div class="card-body px-0">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="text-muted fs-13">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="px-1 fs-13">
                                            {{ helper::date_formate($blogdetails->created_at, $blogdetails->vendor_id) }}
                                        </span>
                                    </p>
                                </div>
                                <h4 class="card-title fw-600 dark_color mb-3"><a class="text-dark"
                                        href="{{ URL::to(@$vendordata->slug . '/blogs-' . $blogdetails->slug) }}">{{ $blogdetails->title }}</a>
                                </h4>
                                <p class="mb-3">{!! $blogdetails->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
    <!-- BLOG DETAILS AREA END -->
    <!-- FEATURED BLOGS AREA START  -->
    @if (count(helper::getblogs(@$vendordata->id, '4', @$blogdetails->id)) > 0)
        <section class="featured-blog mb-5">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="section-heading mb-3">
                        <h4 class="section-title text-capitalize">{{ trans('labels.related_blogs') }}</h4>
                        <a href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                            class="btn btn-sm btn-secondary rounded-0 px-3 py-2">{{ trans('labels.viewall') }} <i
                                class="fa-solid {{ session()->get('direction') == 2 ? 'fa-arrow-left' : ' fa-arrow-right' }}"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div id="featured_blog" class="owl-carousel owl-theme overflow-hidden">
                        @foreach (helper::getblogs(@$vendordata->id, '4', @$blogdetails->id) as $getrelatedblogdetails)
                            <div class="card rounded-0 border-0 h-100 ">
                                <img src="{{ helper::image_path($getrelatedblogdetails->image) }}"
                                    class="card-img-top blog-im object-fit-cover rounded-0" alt="...">
                                <div class="card-body px-0">
                                    <h6 class="card-text mt-2"><a class="text-dark blog-title fw-600"
                                            href="{{ URL::to(@$vendordata->slug . '/blogs-' . $getrelatedblogdetails->slug) }}">{{ $getrelatedblogdetails->title }}</a>
                                    </h6>
                                </div>
                                <div class="card-footer px-0 pt-0">
                                    <div class="d-flex align-items-center justify-content-between py-2 border-top">
                                        <p class="fs-8"><i class="fa-regular fa-clock"></i><span
                                                class="px-1">{{ helper::date_formate($getrelatedblogdetails->created_at, $getrelatedblogdetails->vendor_id) }}</span>
                                        </p>
                                        <a href="{{ URL::to(@$vendordata->slug . '/blogs-' . $getrelatedblogdetails->slug) }}"
                                            class="text-primary-color fs-15">{{ trans('labels.readmore') }} <i
                                                class="fa-solid fw-500 {{ session()->get('direction') == 2 ? 'fa-arrow-left-long' : ' fa-arrow-right-long' }}"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- FEATURED BLOGS AREA END  -->
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/index.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/blogs.js') }}"></script>
@endsection

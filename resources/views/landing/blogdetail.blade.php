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
                <li class="text-muted breadcrumb-item active d-flex gap-2" aria-current="page">
                    {{ trans('landing.blog_detail') }}
                </li>
            </ol>
        </nav>
    </div>
</section>
{{-- <section class="py-5 mb-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <h3 class="breadcrumb-title fw-semibold mb-2 text-center">{{ trans('landing.blog_detail') }}</h3>
            <ol class="breadcrumb justify-content-center">
                <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                        class="text-dark" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                </li>
                <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                    aria-current="page">{{ trans('landing.blog_detail') }}</li>
            </ol>
        </nav>
    </div>
</section> --}}
    <section>
        <div class="container my-3">
            <div class="details-text">
                
                <img src="{{ helper::image_path($getblog->image) }}" class="img-fluid blog-details-img " alt="...">
                <div class="d-flex align-items-baseline pt-3">
                    <i class="fa-solid fa-calendar-days card-date"></i>
                    <p class="card-date px-2">{{ helper::date_formate($getblog->created_at,$getblog->vendor_id) }}</p>
                </div>
                <h5 class="blog-details-title fw-semibold pb-3 pt-2">
                    {{ $getblog->title }}</h5>
                <p class="details-footer m-0" data-aos="fade-up" data-aos-darution="1000" data-aos-delay="100">
                    {!! $getblog->description !!}
                </p>

                <h5 class="recent-blogs-titel pt-5 pb-4">{{ trans('landing.related_blogs') }}</h5>
            </div>
            <div class="owl-carousel blogs-slaider owl-theme pb-5">
                @include('landing.blogcommonview')

            </div>
            <div class="d-flex justify-content-center view-all-btn">
                <a href="{{URL::to('/blogs')}}" class="btn-secondary m-0 rounded-2">{{ trans('landing.view_all') }}
                </a>
            </div>
        </div>
    </section>
        <!-- subscription -->
        @include('landing.newslatter')
@endsection

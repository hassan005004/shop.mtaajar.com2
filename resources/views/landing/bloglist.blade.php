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
                        {{ trans('landing.blog_section_title') }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    {{-- <section class="py-5 mb-5 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <h3 class="breadcrumb-title fw-semibold mb-2 text-center">{{ trans('landing.blog_section_title') }}</h3>
                <ol class="breadcrumb justify-content-center">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('landing.blog_section_title') }}</li>
                </ol>
            </nav>
        </div>
    </section> --}}
    <div class="container blog-container">
        <div class="blog-card my-3">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                {{-- @include('landing.blogcommonview') --}}
                @foreach ($blogs as $blog)
                    <div class="col">
                        <div class="card rounded-3 h-100 p-3">
                            <div class="overflow-hidden rounded-3">
                                <img src="{{ helper::image_path($blog->image) }}"
                                    class="card-img-top blog-card-top-img rounded-3 blog-card-hover" height="260"
                                    alt="...">
                            </div>
                            <div class="card-body p-0 pt-3">
                                <a href="{{ URL::to('/blogdetail-' . $blog->slug) }}">
                                    <h6 class="fw-500 pt-2 text-secondary-color">
                                        {{ $blog->title }}
                                    </h6>
                                </a>
                                <p class="fs-7 text_truncation2">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit. Ducimus, nesciunt debitis. Asperiores perferendis, sed iure aut maxime
                                    repellat sunt debitis placeat numquam quam non aliquid commodi animi excepturi ab
                                    perspiciatis.</p>
                            </div>
                            <div class="card-footer pt-3 mt-3 p-0 bg-transparent text-end border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2 align-items-center">
                                        <i class="fa-solid fa-calendar-days fs-7"></i>
                                        <p class="fs-7 text-muted">
                                            {{ helper::date_formate($blog->created_at, $blog->vendor_id) }}
                                        </p>
                                    </div>
                                    <a href="{{ URL::to('/blogdetail-' . $blog->slug) }}">
                                        <div class="text-primary-color fs-7">
                                            {{ Str::contains(request()->url(), 'blog') ? trans('landing.read_more') : trans('landing.read_more') }}
                                            <i
                                                class="fa-solid {{ session()->get('direction') == 2 ? 'fa-arrow-left' : 'fa-arrow-right' }} "></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                {!! $blogs->links() !!}
            </div>
        </div>
    </div>
    <!-- subscription -->
    @include('landing.newslatter')
@endsection

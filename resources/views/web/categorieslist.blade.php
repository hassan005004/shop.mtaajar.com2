@extends('web.layout.default')
@section('contents')
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a class="text-dark fw-600" href="{{ URL::to(@$vendordata->slug . '/')}}">{{ trans('labels.home') }}</a></li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active" aria-current="page">{{ trans('labels.categories') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">            
            <div class="categorywrapper row flex-wrap align-items-baseline justify-content-sm-start justify-content-evenly">
                @forelse (helper::getcategories(@$vendordata->id,"") as $category)

                <div class="category">
                        <a href="{{ URL::to(@$vendordata->slug . '/category?category='.$category->slug)}}">
                        <div class="text-center mb-4">
                            <img src="{{helper::image_path($category->image)}}" alt="" srcset="">
                            <p class="fs-7 text-truncate mt-2">{{ ucfirst($category->name) }}</p>
                            
                        </div>
                    </a>
                    </div>

                    
                @empty
                    @include('web.nodata')
                @endforelse
            </div>
        </div>
    </section>
@endsection
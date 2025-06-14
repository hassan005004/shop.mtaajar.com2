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
                <div class="col-lg-9 col-xxl-9 product-list">
                    <div class="border rounded-2 p-3 h-100">
                        <h5 class="text-dark m-0 mb-3 pb-3 border-bottom profile-title">
                            {{ trans('labels.my_favorite_list') }}</h5>
                        @if ($getfavourite->count() > 0)
                            <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 fav-sec">
                                @foreach ($getfavourite as $getproductdata)
                                    @include('web.productcommonview')
                                @endforeach
                            </div>
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

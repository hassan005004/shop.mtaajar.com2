@extends('web.layout.default')
@section('contents')
    <!-- BREADCRUMB AREA START -->

    <section class="py-4 mb-4 bg-light">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
    
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}"><a class="text-dark fw-600" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a></li>
    
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active" aria-current="page">{{ trans('labels.refund_policy') }}</li>
    
                </ol>
    
            </nav>
    
        </div>
    </section>

    <!-- BREADCRUMB AREA END -->

    <section class="privacy-policy my-5">

        <div class="container">
            <p>{!! $policy->refund_policy !!}</p>

        </div>

    </section>
@endsection

@extends('web.layout.default')
@section('contents')
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li
                        class="{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.orders') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <div class="row">
                @include('web.user.sidebar')
                <div class="col-lg-9 col-xxl-9">
                    <div class="border p-3 rounded table-box">

                            <h5 class="text-dark m-0 mb-3 pb-3 border-bottom profile-title">{{ trans('labels.orders') }}</h5>
                        <div class="col-12 p-3 rounded-3 mb-3 bg-section-gray">
                            <div class="row g-3 align-items-center table-top-box">
                                <a href="{{ URL::to($vendordata->slug . '/orders?type=allOrders') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <button type='button'
                                        class="btn border rounded m-0 p-3 w-100 {{ app('request')->input('type') == 'allOrders' ? 'bg-white text-dark' : 'text-dark bg-transparent' }}">
                                        <span class='all-icon  d-flex justify-content-center gap-2 align-items-center'>
                                            <p class='m-0 p-0 fw-500 fs-15'>{{ trans('labels.all_orders') }}</p>
                                            <p
                                                class='text-start-pro m-0 p-0 {{ app('request')->input('type') == 'allOrders' ? 'text-white bg-dark' : 'text-dark' }}'>
                                                {{ $totalprocessing }}</p>

                                        </span>
                                    </button>
                                </a>
                                <a href="{{ URL::to($vendordata->slug . '/orders?type=processing') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <button type='button'
                                        class="btn border m-0 rounded p-3 w-100 {{ app('request')->input('type') == 'processing' ? 'bg-white text-dark' : 'text-dark bg-transparent' }}">
                                        <span class='warning-icon d-flex justify-content-center gap-2 align-items-center'>
                                            <p class='m-0 p-0 fw-500 fs-15'>{{ trans('labels.preparing') }}</p>
                                            <p
                                                class='text-start-pro m-0 p-0 {{ app('request')->input('type') == 'processing' ? 'text-white bg-dark' : 'text-dark' }}'>
                                                {{ $totalprocessing }}
                                            </p>

                                        </span>
                                    </button>
                                </a>
                                <a href="{{ URL::to($vendordata->slug . '/orders?type=completed') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 delivered-box">
                                    <button type='button'
                                        class="btn border m-0 rounded p-3 w-100 {{ app('request')->input('type') == 'completed' ? 'bg-white text-dark' : 'text-dark bg-transparent' }}">
                                        <span class='success-icon d-flex justify-content-center gap-2 align-items-center'>

                                            <p class='m-0 p-0 fw-500 fs-15'>{{ trans('labels.delivered') }}</p>
                                            <p
                                                class='text-start-pro m-0 p-0 {{ app('request')->input('type') == 'completed' ? 'text-white bg-dark' : 'text-dark' }}'>
                                                {{ $totalcompleted }}</p>

                                        </span>
                                    </button>
                                </a>
                                <a href="{{ URL::to($vendordata->slug . '/orders?type=rejected') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 rejected-box">
                                    <button type='button'
                                        class="btn border m-0 rounded p-3 w-100 {{ app('request')->input('type') == 'rejected' ? 'bg-white text-dark' : 'text-dark bg-transparent' }}">
                                        <span class='danger-icon d-flex justify-content-center gap-2 align-items-center'>
                                            <p class='m-0 p-0 fw-500 fs-15'>{{ trans('labels.rejected') }}</p>
                                            <p
                                                class='text-start-pro m-0 p-0 {{ app('request')->input('type') == 'rejected' ? 'text-white bg-dark' : 'text-dark' }}'>
                                                {{ $totalrejected }}</p>

                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="row row-cols-xl-2 row-cols-1 g-3 pb-1">
                            @php $i = 1; @endphp
                            @foreach ($orders as $orderdata)
                                <div class="col">
                                    <div class="card border-1 rounded-3 px-0">
                                        <div class="card-body p-sm-4 p-2">
                                            <div class="row g-2">
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <div class="fw-600 fs-7">#{{ $orderdata->order_number }}</div>
                                                    <div class="fs-8 fw-500">
                                                        {{ helper::date_formate($orderdata->created_at, $orderdata->vendor_id) }}
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <div class="d-flex ">

                                                        <div class="fs-7 fw-500">{{ trans('labels.grand_total') }} :</div>
                                                        <div class="mx-1 fs-7 fw-600">
                                                            {{ helper::currency_formate($orderdata->grand_total, $orderdata->vendor_id) }}
                                                        </div>
                                                    </div>
                                                    <div class="fs-7 fw-500">
                                                        {{ @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $orderdata->vendor_id)->name }}

                                                    </div>
                                                </div>

                                                <div class="d-sm-flex flex-wrap justify-content-between align-items-center">
                                                    <div class="d-flex">
                                                        <div class="fs-7 fw-500">{{ trans('labels.payment_type') }}:</div>
                                                        <div class="fw-600 fs-7 mx-1">
                                                            @if ($orderdata->transaction_type == 6)
                                                                {{ @helper::getpayment($orderdata->transaction_type, $orderdata->vendor_id)->payment_name }}
                                                                : <small><a
                                                                        href="{{ helper::image_path($orderdata->screenshot) }}"
                                                                        target="_blank"
                                                                        class="text-danger">{{ trans('labels.click_here') }}</a></small>
                                                            @else
                                                                {{ @helper::getpayment($orderdata->transaction_type, $orderdata->vendor_id)->payment_name }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="mt-sm-0 mt-2">
                                                        <a class="btn btn-sm rounded-0 btn-secondary eye-icon-box px-3"
                                                            href="{{ URL::to(@$vendordata->slug . '/find-order?order=' . $orderdata->order_number) }}">
                                                            <p class="fs-7">{{ trans('labels.detail') }}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

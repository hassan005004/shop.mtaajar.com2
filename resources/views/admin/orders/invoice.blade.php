@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.invoice') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/orders') }}">{{ trans('labels.orders') }}</a>
                </li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.invoice') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 my-2 d-flex justify-content-end gap-2">
            @if (helper::appdata($vendor_id)->product_type == 1)
                @if (helper::appdata($vendor_id)->ship_rocket_on_off == 1)
                <a href="{{ URL::to('admin/orders/create_order-' . $vendor_id. '-' . $getorderdata->id) }}" class="btn btn-primary"><i class="fa-solid fa-rocket"></i> {{ trans('labels.create_order_in_shiprocket') }} </a>
                @endif
                @if ($getorderdata->status_type == 1 || $getorderdata->status_type == 2)
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                        data-bs-toggle="dropdown">{{ @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name }}</button>
                    <div class="dropdown-menu dropdown-menu-right {{ Auth::user()->type == 1 ? 'disabled' : '' }}">
                        @foreach (helper::customstauts($getorderdata->vendor_id, $getorderdata->order_type) as $status)
                            <a class="dropdown-item w-auto @if ($getorderdata->status == '1') fw-600 @endif"
                                onclick="statusupdate('{{ URL::to('admin/orders/update-' . $getorderdata->id . '-' . $status->id . '-' . $status->type) }}')">{{ $status->name }}</a>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-between g-3">
                <div
                    class="{{ helper::appdata($vendor_id)->product_type == 1 ? 'col-md-3 col-lg-3 col-xl-3' : 'col-md-4 col-lg-4 col-xl-4' }}">
                    <div class="card border-0 mb-3 h-100 d-flex shadow">
                        <div
                            class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-clipboard fs-5"></i>
                                {{ trans('labels.your_order_details') }}</h6>
                        </div>
                        <div class="card-body">

                            <div class="basic-list-group">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        <p>{{ trans('labels.order_number') }}</p>
                                        <p class="text-dark fw-600">{{ $getorderdata->order_number }}</p>
                                    </li>
                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        {{ trans('labels.order_date') }}
                                        <p class="text-muted">
                                            {{ helper::date_formate($getorderdata->created_at, $vendor_id) }}</p>
                                    </li>
                                    {{-- payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10 --}}

                                    <li
                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                        {{ trans('labels.payment_type') }}
                                        <span class="text-muted">
                                            @if ($getorderdata->transaction_type == 0)
                                                {{ trans('labels.online') }}
                                            @elseif ($getorderdata->transaction_type == 6)
                                                {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                                                : <small><a href="{{ helper::image_path($getorderdata->screenshot) }}"
                                                        target="_blank"
                                                        class="text-danger">{{ trans('labels.click_here') }}</a></small>
                                            @else
                                                {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                                            @endif
                                        </span>
                                    </li>
                                    @if (in_array($getorderdata->transaction_type, [2, 3, 4, 5, 7, 8, 9, 10]))
                                        <li class="list-group-item px-0">{{ trans('labels.payment_id') }}
                                            <p class="text-muted">
                                                {{ $getorderdata->transaction_id }}
                                            </p>
                                        </li>
                                    @endif
                                    @if ($getorderdata->notes != '')
                                        <li class="list-group-item px-0">{{ trans('labels.notes') }}
                                            <p class="text-muted">
                                                {{ $getorderdata->notes }}
                                            </p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="{{ helper::appdata($vendor_id)->product_type == 1 ? 'col-md-3 col-lg-3 col-xl-3' : 'col-md-4 col-lg-4 col-xl-4' }}">
                    <div class="card border-0 mb-3 h-100 d-flex shadow">
                        <div
                            class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-user fs-5"></i>
                                {{ trans('labels.customer_info') }}
                            </h6>
                            <p class="text-muted cursor-pointer"
                                onclick="editcustomerdata('{{ $getorderdata->order_number }}','{{ $getorderdata->user_name }}','{{ $getorderdata->user_mobile }}','{{ $getorderdata->user_email }}','{{ $getorderdata->billing_address }}','{{ $getorderdata->billing_landmark }}','{{ $getorderdata->billing_postal_code }}','{{ $getorderdata->billing_city }}','{{ $getorderdata->billing_state }}','{{ $getorderdata->billing_country }}','{{ $getorderdata->shipping_address }}','{{ $getorderdata->shipping_landmark }}','{{ $getorderdata->shipping_postal_code }}','{{ $getorderdata->shipping_city }}','{{ $getorderdata->shipping_state }}','{{ $getorderdata->shipping_country }}','customer_info')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="basic-list-group">
                                        <ul class="list-group list-group-flush">

                                            <li
                                                class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                <p>{{ trans('labels.name') }}</p>
                                                <p class="text-muted"> {{ $getorderdata->user_name }}</p>
                                            </li>

                                            @if ($getorderdata->user_mobile != null)
                                                <li
                                                    class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                    <p>{{ trans('labels.mobile') }}</p>
                                                    <p class="text-muted">{{ $getorderdata->user_mobile }}</p>
                                                </li>
                                            @endif

                                            @if ($getorderdata->user_email != null)
                                                <li
                                                    class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                    <p>{{ trans('labels.email') }}</p>
                                                    <p class="text-muted">{{ $getorderdata->user_email }}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (helper::appdata($vendor_id)->product_type == 1)
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <div class="card border-0 mb-3 h-100 d-flex shadow">

                            <div
                                class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                                <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-file-invoice fs-5"></i>
                                    {{ $getorderdata->order_from == 'pos' ? trans('labels.info') : trans('labels.bill_to') }}
                                </h6>
                                @if ($getorderdata->order_from != 'pos')
                                    <p class="text-muted cursor-pointer"
                                        onclick="editcustomerdata('{{ $getorderdata->order_number }}','{{ $getorderdata->user_name }}','{{ $getorderdata->user_mobile }}','{{ $getorderdata->user_email }}','{{ $getorderdata->billing_address }}','{{ $getorderdata->billing_landmark }}','{{ $getorderdata->billing_postal_code }}','{{ $getorderdata->billing_city }}','{{ $getorderdata->billing_state }}','{{ $getorderdata->billing_country }}','{{ $getorderdata->shipping_address }}','{{ $getorderdata->shipping_landmark }}','{{ $getorderdata->shipping_postal_code }}','{{ $getorderdata->shipping_city }}','{{ $getorderdata->shipping_state }}','{{ $getorderdata->shipping_country }}','bill_info')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </p>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <div class="row">

                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    @if ($getorderdata->order_from == 'pos')
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.pos') }}</p>

                                                        </li>
                                                    @else
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.address') }}</p>
                                                            <p class="text-muted"> {{ $getorderdata->billing_address }}</p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.landmark') }}</p>
                                                            <p class="text-muted">{{ $getorderdata->billing_landmark }}</p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.postal_code') }}</p>
                                                            <p class="text-muted"> {{ $getorderdata->billing_postal_code }}
                                                            </p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.city') }}</p>
                                                            <p class="text-muted"> {{ $getorderdata->billing_city }}</p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.state') }}</p>
                                                            <p class="text-muted"> {{ $getorderdata->billing_state }}</p>
                                                        </li>
                                                        <li
                                                            class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                            <p>{{ trans('labels.country') }}</p>
                                                            <p class="text-muted"> {{ $getorderdata->billing_country }}.
                                                            </p>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center align-items-center">
                                                        <p>{{ trans('labels.pos') }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center align-items-center">
                                                        <p>{{ trans('labels.digital') }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3 {{ $getorderdata->order_type == 4 ? 'd-none' : '' }}">
                        <div class="card border-0 mb-3 h-100 d-flex shadow">
                            <div
                                class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                                <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-file-invoice fs-5"></i>
                                    {{ trans('labels.shipping_to') }}
                                </h6>
                                <p class="text-muted cursor-pointer"
                                    onclick="editcustomerdata('{{ $getorderdata->order_number }}','{{ $getorderdata->user_name }}','{{ $getorderdata->user_mobile }}','{{ $getorderdata->user_email }}','{{ $getorderdata->billing_address }}','{{ $getorderdata->billing_landmark }}','{{ $getorderdata->billing_postal_code }}','{{ $getorderdata->billing_city }}','{{ $getorderdata->billing_state }}','{{ $getorderdata->billing_country }}','{{ $getorderdata->shipping_address }}','{{ $getorderdata->shipping_landmark }}','{{ $getorderdata->shipping_postal_code }}','{{ $getorderdata->shipping_city }}','{{ $getorderdata->shipping_state }}','{{ $getorderdata->shipping_country }}','shipping_info')">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="basic-list-group">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="basic-list-group">
                                                <ul class="list-group list-group-flush">

                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p>{{ trans('labels.address') }}</p>
                                                        <p class="text-muted"> {{ $getorderdata->shipping_address }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p>{{ trans('labels.landmark') }}</p>
                                                        <p class="text-muted">{{ $getorderdata->shipping_landmark }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p>{{ trans('labels.postal_code') }}</p>
                                                        <p class="text-muted"> {{ $getorderdata->shipping_postal_code }}
                                                        </p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p>{{ trans('labels.city') }}</p>
                                                        <p class="text-muted"> {{ $getorderdata->shipping_city }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p>{{ trans('labels.state') }}</p>
                                                        <p class="text-muted"> {{ $getorderdata->shipping_state }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item px-0 fs-7 fw-500 d-flex justify-content-between align-items-center">
                                                        <p>{{ trans('labels.country') }}</p>
                                                        <p class="text-muted"> {{ $getorderdata->shipping_country }}.</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div
                    class="{{ helper::appdata($vendor_id)->product_type == 1 ? 'col-md-3 col-lg-3 col-xl-3' : 'col-md-4 col-lg-4 col-xl-4' }}">
                    <div class="card border-0 mb-3 h-100 d-flex shadow">
                        <div
                            class="card-header d-flex align-items-center bg-transparent text-dark py-3 justify-content-between">
                            <h6 class="px-2 fw-500 text-dark"><i class="fa-solid fa-clipboard fs-5"></i>
                                {{ trans('labels.notes') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="basic-list-group">
                                        @if ($getorderdata->vendor_note != '')
                                            <div class="alert alert-info" role="alert">
                                                {{ $getorderdata->vendor_note }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <form action="{{ URL::to('admin/orders/vendor_note') }}" method="POST">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="note"> {{ trans('labels.note') }} </label>
                                    <div class="controls">
                                        <input type="hidden" name="order_id" class="form-control"
                                            value="{{ $getorderdata->order_number }}">
                                        <input type="text" name="vendor_note" class="form-control" required>
                                    </div>
                                </div>
                                <div
                                    class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                    <button
                                        @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" type="submit" @endif
                                        class="btn btn-primary"> {{ trans('labels.update') }} </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 mt-3">
                <div class="card-header d-flex align-items-center justify-content-between bg-transparent text-dark py-3">
                    <div class="d-flex gap-2 align-items-center">
                        <i class="fa-solid fa-bag-shopping fs-5"></i>
                        <h6 class="fw-500 text-dark">{{ trans('labels.orders') }}</h6>
                    </div>
                    <a href="{{ URL::to('admin/orders/print/' . $getorderdata->order_number) }}"
                        class="btn btn-secondary px-sm-4 fs-15">
                        <i class="fa fa-pdf" aria-hidden="true"></i> {{ trans('labels.print') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td>{{ trans('labels.products') }}</td>
                                    <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                        {{ trans('labels.unit_cost') }}</td>
                                    <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                        {{ trans('labels.qty') }}</td>
                                    <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                        {{ trans('labels.sub_total') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($ordersdetails as $orders)
                                    @php
                                        $itemprice = $orders->price;
                                    @endphp
                                    <tr class="fs-7 align-middle">
                                        <td>{{ $orders->product_name }}
                                            @if ($orders->variation_id != '')
                                                - <small>{{ $orders->variation_name }}
                                                    ({{ helper::currency_formate($itemprice, $getorderdata->vendor_id) }})
                                                </small>
                                            @endif
                                            @if ($orders->extras_id != '')
                                                <?php
                                                $extras_id = explode('|', $orders->extras_id);
                                                $extras_name = explode('|', $orders->extras_name);
                                                $extras_price = explode('|', $orders->extras_price);
                                                $extras_total_price = 0;
                                                ?>
                                                <br>
                                                @foreach ($extras_id as $key => $addons)
                                                    <small>
                                                        <b class="text-muted">{{ $extras_name[$key] }}</b> :
                                                        {{ helper::currency_formate($extras_price[$key], $getorderdata->vendor_id) }}<br>
                                                    </small>
                                                    @php
                                                        $extras_total_price += $extras_price[$key];
                                                    @endphp
                                                @endforeach
                                            @else
                                                @php
                                                    $extras_total_price = 0;
                                                @endphp
                                            @endif
                                        </td>
                                        <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                            {{ helper::currency_formate((float) $orders->product_price, $getorderdata->vendor_id) }}
                                        </td>
                                        <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                            {{ $orders->qty }}</td>
                                        @php
                                            $total = (float) $orders->product_price * (float) $orders->qty;
                                            $subtotal += $total;
                                        @endphp
                                        <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                            {{ helper::currency_formate($total, $getorderdata->vendor_id) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="fs-15 align-middle">
                                    <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}"
                                        colspan="3">
                                        <p class="m-0 fw-500">{{ trans('labels.sub_total') }}</p>
                                    </td>
                                    <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                        <p class="m-0 fw-500">
                                            {{ helper::currency_formate($subtotal, $getorderdata->vendor_id) }}
                                        </p>
                                    </td>
                                </tr>
                                @if ($getorderdata->offer_amount > 0)
                                    <tr class="fs-15 align-middle">
                                        <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}"
                                            colspan="3">
                                            <p class="m-0 fw-500">{{ trans('labels.discount') }}</p>
                                            {{ $getorderdata->offer_code != '' ? '(' . $getorderdata->offer_code . ')' : '' }}
                                        </td>
                                        <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                            <p class="m-0 fw-500">
                                                -{{ helper::currency_formate($getorderdata->offer_amount, $getorderdata->vendor_id) }}
                                            </p>
                                        </td>
                                    </tr>
                                @endif

                                @php
                                    $tax = explode('|', $getorderdata->tax_amount);
                                    $tax_name = explode('|', $getorderdata->tax_name);
                                @endphp
                                @if ($getorderdata->tax_amount != null && $getorderdata->tax_amount != '')
                                    @foreach ($tax as $key => $tax_value)
                                        <tr class="fs-15 align-middle">
                                            <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}"
                                                colspan="3">
                                                <p class="m-0 fw-500">{{ $tax_name[$key] }}</p>
                                            </td>
                                            <td
                                                class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                <p class="m-0 fw-500">
                                                    {{ helper::currency_formate((float) $tax[$key], $getorderdata->vendor_id) }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($getorderdata->order_type == 1)
                                    @if ($getorderdata->delivery_charge != null && $getorderdata->delivery_charge != '')
                                        <tr class="fs-15 align-middle">
                                            <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}"
                                                colspan="3">
                                                <p class="m-0 fw-500">{{ trans('labels.delivery_charge') }}({{ $getorderdata->shipping_area }})</p>
                                            </td>
                                            <td
                                                class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                <p class="m-0 fw-500">
                                                    {{ helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id) }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                <tr class="fs-16 align-middle">
                                    <td class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }} text-dark"
                                        colspan="3">
                                        <p class="m-0 fw-600">{{ trans('labels.grand_total') }} </p>
                                    </td>
                                    <td
                                        class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }} text-dark">
                                        <p class="m-0 fw-600">
                                            {{ helper::currency_formate($subtotal + $getorderdata->delivery_charge + array_sum($tax) - $getorderdata->offer_amount, $getorderdata->vendor_id) }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="customerinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title text-dark" id="modalbankdetailsLabel">{{ trans('labels.edit') }}</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="{{ URL::to('admin/orders/customerinfo') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="order_id" id="modal_order_id" class="form-control" value="">
                        <input type="hidden" name="edit_type" id="edit_type" class="form-control" value="">
                        <div id="customer_info">
                            <div class="form-group col-md-12">
                                <label for="user_name"> {{ trans('labels.name') }} </label>
                                <div class="controls">
                                    <input type="text" name="user_name" id="user_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="user_mobile"> {{ trans('labels.mobile') }} </label>
                                <div class="controls">
                                    <input type="text" name="user_mobile" id="user_mobile" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="user_email"> {{ trans('labels.email') }} </label>
                                <div class="controls">
                                    <input type="text" name="user_email" id="user_email" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="bill_info">
                            <div class="form-group col-md-12">
                                <label for="bill_address"> {{ trans('labels.address') }} </label>
                                <div class="controls">
                                    <input type="text" name="bill_address" id="bill_address" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_landmark"> {{ trans('labels.landmark') }} </label>
                                <div class="controls">
                                    <input type="text" name="bill_landmark" id="bill_landmark" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_pincode"> {{ trans('labels.pincode') }} </label>
                                <div class="controls">
                                    <input type="text" name="bill_pincode" id="bill_pincode" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_city"> {{ trans('labels.city') }} </label>
                                <div class="controls">
                                    <input type="text" name="bill_city" id="bill_city" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_state"> {{ trans('labels.state') }} </label>
                                <div class="controls">
                                    <input type="text" name="bill_state" id="bill_state" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bill_country"> {{ trans('labels.country') }} </label>
                                <div class="controls">
                                    <input type="text" name="bill_country" id="bill_country" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="shipping_info">
                            <div class="form-group col-md-12">
                                <label for="shipping_address"> {{ trans('labels.address') }} </label>
                                <div class="controls">
                                    <input type="text" name="shipping_address" id="shipping_address"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="shipping_landmark"> {{ trans('labels.landmark') }} </label>
                                <div class="controls">
                                    <input type="text" name="shipping_landmark" id="shipping_landmark"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_pincode"> {{ trans('labels.pincode') }} </label>
                                <div class="controls">
                                    <input type="text" name="shipping_pincode" id="shipping_pincode"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_city"> {{ trans('labels.city') }} </label>
                                <div class="controls">
                                    <input type="text" name="shipping_city" id="shipping_city" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_state"> {{ trans('labels.state') }} </label>
                                <div class="controls">
                                    <input type="text" name="shipping_state" id="shipping_state" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="shipping_country"> {{ trans('labels.country') }} </label>
                                <div class="controls">
                                    <input type="text" name="shipping_country" id="shipping_country"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4"
                            data-bs-dismiss="modal">{{ trans('labels.close') }}</button>
                        <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" type="submit" @endif
                            class="btn btn-primary px-sm-4"> {{ trans('labels.save') }} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function editcustomerdata(order_id, customer_name, customer_mobile, customer_email, bill_address, bill_landmark,
            bill_pincode, bill_city, bill_state, bill_country, shipping_address, shipping_landmark, shipping_pincode,
            shipping_city, shipping_state, shipping_country, type) {
            "use strict";
            $('#customerinfo').modal('show');
            $('#modal_order_id').val(order_id);
            if (type == "customer_info") {
                $('#user_name').val(customer_name);
                $('#user_mobile').val(customer_mobile);
                $('#user_email').val(customer_email);
                $('#edit_type').val(type);
                $('#customer_info').show();
                $('#bill_info').hide();
                $('#shipping_info').hide();
                $('#bill_address').removeAttr('required');
                $('#bill_landmark').removeAttr('required');
                $('#bill_pincode').removeAttr('required');
                $('#bill_city').removeAttr('required');
                $('#bill_state').removeAttr('required');
                $('#bill_country').removeAttr('required');
                $('#shipping_address').removeAttr('required');
                $('#shipping_landmark').removeAttr('required');
                $('#shipping_pincode').removeAttr('required');
                $('#shipping_city').removeAttr('required');
                $('#shipping_state').removeAttr('required');
                $('#shipping_country').removeAttr('required');
            } else if (type == "bill_info") {
                $('#bill_address').val(bill_address.replace(/[|]+/g, ","));
                $('#bill_landmark').val(bill_landmark.replace(/[|]+/g, ","));
                $('#bill_pincode').val(bill_pincode);
                $('#bill_city').val(bill_city);
                $('#bill_state').val(bill_state);
                $('#bill_country').val(bill_country);
                $('#edit_type').val(type);
                $('#bill_info').show();
                $('#customer_info').hide();
                $('#shipping_info').hide();
                $('#user_name').removeAttr('required');
                $('#user_email').removeAttr('required');
                $('#user_mobile').removeAttr('required');
                $('#shipping_address').removeAttr('required');
                $('#shipping_landmark').removeAttr('required');
                $('#shipping_pincode').removeAttr('required');
                $('#shipping_city').removeAttr('required');
                $('#shipping_state').removeAttr('required');
                $('#shipping_country').removeAttr('required');
            } else {
                $('#shipping_address').val(shipping_address.replace(/[|]+/g, ","));
                $('#shipping_landmark').val(shipping_landmark.replace(/[|]+/g, ","));
                $('#shipping_pincode').val(shipping_pincode);
                $('#shipping_city').val(shipping_city);
                $('#shipping_state').val(shipping_state);
                $('#shipping_country').val(shipping_country);
                $('#edit_type').val(type);
                $('#customer_info').hide();
                $('#bill_info').hide();
                $('#shipping_info').show();
                $('#user_name').removeAttr('required');
                $('#user_email').removeAttr('required');
                $('#user_mobile').removeAttr('required');
                $('#bill_address').removeAttr('required');
                $('#bill_landmark').removeAttr('required');
                $('#bill_pincode').removeAttr('required');
                $('#bill_city').removeAttr('required');
                $('#bill_state').removeAttr('required');
                $('#bill_country').removeAttr('required');
            }
        }
    </script>
@endsection

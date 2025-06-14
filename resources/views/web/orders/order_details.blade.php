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
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('labels.order_details') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <section class="order_detail my-5">
        <div class="container">
            @if ($order_number == '')
                <div class="row align-items-center justify-content-between mb-5">
                    <div class="col-lg-6">
                        <img src="{{ helper::image_path(helper::appdata($vendordata->id)->order_detail_image) }}"
                            class="w-100 mb-5 mb-lg-0" alt="tracking">
                    </div>
                    <div class="col-lg-6 col-xl-5">
                        <h2 class="track-title text-truncate">{{ trans('labels.find_order_title') }}</h2>
                        <p class="track-description mb-4 line-3">{{ trans('labels.find_order_subtitle') }}</p>
                        <form action="{{ URL::to(@$vendordata->slug . '/find-order') }}" method="get">
                            <label class="form-label">{{ trans('labels.order_id') }}</label>
                            <div class="input-group mb-4">
                                <input type="text"
                                    class="form-control rounded-0 bg-transparent input-h {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}"
                                    name="order" value="{{ $order_number }}"
                                    placeholder="{{ trans('labels.find_order_placeholder') }}">
                            </div>
                            <button class="btn btn-fashion" type="submit">{{ trans('labels.track_here') }}</button>
                        </form>
                    </div>
                </div>
            @endif
            @if (!empty($getorderdata))
                <div class="row gx-0 justify-content-between align-items-end">
                    <div class="card border-0 rounded-0 bg-light mb-3">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-12 col-md-9 col-lg-9 col-xl-6">
                                    <div class="d-md-flex">
                                        <div>
                                            <div class="d-flex align-items-center justify-contente-between py-2">
                                                <span class="text-dark fw-600 fs-15">{{ trans('labels.order_id') }}
                                                    :&nbsp;</span>
                                                <div class="fw-600 text-dark fs-15">#{{ $getorderdata->order_number }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-contente-between py-2">
                                                <span class="text-dark fw-600 fs-15">{{ trans('labels.order_date') }}
                                                    :&nbsp;</span>
                                                <p
                                                    class="fs-7 {{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'ms-auto' : 'me-auto' }} ">
                                                    {{ helper::date_formate($getorderdata->created_at, $getorderdata->vendor_id) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="px-md-4">
                                            @if (helper::appdata($getorderdata->vendor_id)->product_type == 1)
                                                <div class="d-flex align-items-center justify-contente-between py-2">
                                                    <span class="text-dark fw-600 fs-15">{{ trans('labels.order_status') }}
                                                        :&nbsp;</span>
                                                    <p class="fs-7">
                                                        @if ($getorderdata->status_type == 1)
                                                            {{ @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name }}
                                                        @elseif($getorderdata->status_type == 2)
                                                            {{ @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name }}
                                                        @elseif($getorderdata->status_type == 4)
                                                            {{ @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name }}
                                                        @elseif($getorderdata->status_type == 3)
                                                            {{ @helper::gettype($getorderdata->status, $getorderdata->status_type, $getorderdata->order_type, $getorderdata->vendor_id)->name }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif
                                            @if ($getorderdata->tips > 0)
                                                <div class="d-flex align-items-center justify-contente-between py-2">
                                                    <span class="text-dark fw-600 fs-15">{{ trans('labels.tips_pro') }}
                                                        :&nbsp;</span>
                                                    <p class="fs-7">
                                                        {{ helper::currency_formate($getorderdata->tips, $getorderdata->vendor_id) }}
                                                    </p>
                                                </div>
                                            @endif
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item d-flex align-items-center px-0 bg-light border-bottom-0">
                                                    <span class="text-dark fw-600 fs-15">{{ trans('labels.payment_type') }}
                                                        :&nbsp;</span>
                                                    <span class="text-dark fs-7">
                                                        @if ($getorderdata->transaction_type == 0)
                                                            {{ trans('labels.online') }}
                                                        @else
                                                            {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                                                            @if ($getorderdata->transaction_type == 6)
                                                                : <small>
                                                                    <a href="{{ helper::image_path($getorderdata->screenshot) }}"
                                                                        target="_blank"
                                                                        class="text-danger">{{ trans('labels.click_here') }}</a>
                                                                </small>
                                                            @endif
                                                        @endif
                                                    </span>
                                                </li>
                                                @if (
                                                    $getorderdata->transaction_type != '1' &&
                                                        $getorderdata->transaction_type != '6' &&
                                                        $getorderdata->transaction_type != '16' &&
                                                        $getorderdata->transaction_type != '0')
                                                    <li class="list-group-item d-flex px-0 bg-light fs-7">
                                                        <strong>{{ trans('labels.payment_id') }} :&nbsp;</strong>
                                                        <span>{{ $getorderdata->transaction_id }}</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3 col-xl-2">
                                    @if ($getorderdata->status_type == 1)
                                        <a class="btn btn-danger text-white btn-outline-danger fw-500 {{ session()->get('direction') == 2 ? 'float-start' : 'float-end' }}"
                                            href="javascript:void(0)"
                                            onclick="cancelorder('{{ URL::to(@$vendordata->slug . '/orders-cancel-' . $getorderdata->order_number) }}')">{{ trans('labels.cancel_order') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between mb-4">
                            <div
                                class="col-md-4 mb-3 mb-md-0 {{ session()->get('direction') == 2 ? 'text-end' : ' text-start' }}">
                                <div class="card border-0 bg-light rounded-0 h-100">
                                    <div class="card-body">
                                        <span class="text-dark fs-15 fw-600"> {{ trans('labels.sold_by') }} : </span>
                                        <p class="fs-7 mt-1">{{ @$vendordata->name }}</p>
                                        <p class="fs-7 mt-1">{{ @helper::appdata(@$vendordata->id)->contact }}</p>
                                        <p class="fs-7 mt-1">{{ @helper::appdata(@$vendordata->id)->email }}</p>
                                        <p class="fs-7 mt-1">{{ @helper::appdata(@$vendordata->id)->address }}</p>
                                    </div>
                                </div>
                            </div>
                            @if ($getorderdata->order_type == 1)
                                <div
                                    class="col-md-4 mb-3 mb-md-0 {{ session()->get('direction') == 2 ? 'text-end' : ' text-start' }}">
                                    <div class="card border-0 bg-light rounded-0 h-100">
                                        <div class="card-body">
                                            <span class="text-dark fs-15 fw-600"> {{ trans('labels.billing_address') }} :
                                            </span>
                                            <p class="fs-7 mt-1">{{ trans('labels.address') }} :
                                                {{ $getorderdata->billing_address }}</p>
                                            <p class="fs-7 mt-1">{{ trans('labels.landmark') }} :
                                                {{ $getorderdata->billing_landmark }}
                                            </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.postalcode') }} :
                                                {{ $getorderdata->billing_postal_code }}</p>
                                            <p class="fs-7 mt-1">{{ trans('labels.city') }} :
                                                {{ $getorderdata->billing_city }}
                                            </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.state') }} :
                                                {{ $getorderdata->billing_state }}
                                            </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.country') }} :
                                                {{ $getorderdata->billing_country }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 {{ session()->get('direction') == 2 ? 'text-end' : ' text-start' }}">
                                    <div class="card border-0 bg-light rounded-0 h-100">
                                        <div class="card-body">
                                            <span class="text-dark fw-600 fs-15"> {{ trans('labels.shipping_address') }} :
                                            </span>
                                            <p class="fs-7 mt-1">{{ trans('labels.address') }} :
                                                {{ $getorderdata->shipping_address }}
                                            </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.landmark') }} :
                                                {{ $getorderdata->shipping_landmark }}
                                            </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.postalcode') }} :
                                                {{ $getorderdata->shipping_postal_code }} </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.city') }} :
                                                {{ $getorderdata->shipping_city }}
                                            </p>
                                            <p class="fs-7 mt-1">{{ trans('labels.state') }} :
                                                {{ $getorderdata->shipping_state }}</p>
                                            <p class="fs-7 mt-1">{{ trans('labels.country') }} :
                                                {{ $getorderdata->shipping_country }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($getorderdata->notes != '' && $getorderdata->notes != null)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-0 h-100">
                                        <div class="card-body">
                                            <span class="text-dark fw-bold"> {{ trans('labels.note') }}
                                            </span>
                                            <p class="fs-7 mt-1">
                                                {{ $getorderdata->notes }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-12 col-lg-7 col-xl-8 mb-4 mb-lg-0">
                                <div class="card border-0 bg-light rounded-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr class="text-capitalize fs-15 fw-600">
                                                        <td>{{ trans('labels.image') }}</td>
                                                        <td>{{ trans('labels.product') }}</td>
                                                        <td>{{ trans('labels.unit_cost') }}</td>
                                                        <td>{{ trans('labels.qty') }}</td>
                                                        <td>{{ trans('labels.sub_total') }}</td>
                                                        {{-- <td></td> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($getorderitemlist as $product)
                                                        <tr class="fs-7 fw-500 align-middle">
                                                            @if ($product->extras_id != '')
                                                                @php

                                                                    $extras_id = explode('|', $product->extras_id);

                                                                    $extras_name = explode('|', $product->extras_name);

                                                                    $extras_price = explode(
                                                                        '|',
                                                                        $product->extras_price,
                                                                    );

                                                                    $extras_total_price = 0;

                                                                @endphp
                                                                <br>
                                                                @foreach ($extras_id as $key => $addons)
                                                                    @php
                                                                        $extras_total_price += $extras_price[$key];
                                                                    @endphp
                                                                @endforeach
                                                            @else
                                                                @php
                                                                    $extras_total_price = 0;
                                                                @endphp
                                                            @endif

                                                            <td><img src="{{ helper::image_path($product->product_image) }}"
                                                                    class="object-fit-cover rounded hw-70-px"> </td>
                                                            <td>
                                                                <p class="text-capitalize"> {{ $product->product_name }}
                                                                </p>
                                                                @if ($product->variation_id != '' || $product->extras_id != '')
                                                                    <P class="text-capitalize">
                                                                        <span type="button" class="text-muted fs-7"
                                                                            onclick='showaddons("{{ $product->id }}","{{ $product->product_name }}","{{ $product->variation_name }}","{{ $product->price }}","{{ $product->extras_name }}","{{ $product->extras_price }}")'>
                                                                            {{ trans('labels.customize') }}
                                                                        </span>
                                                                    </P>
                                                                @endif
                                                            </td>
                                                            @php
                                                                $price = (float) $product->product_price;
                                                                $total = (float) $price * (float) $product->qty;
                                                            @endphp
                                                            <td>{{ helper::currency_formate($product->product_price, $product->vendor_id) }}
                                                            </td>
                                                            <td>{{ $product->qty }}</td>
                                                            <td> {{ helper::currency_formate($total, $product->vendor_id) }}
                                                            </td>
                                                            {{-- @if (@helper::checkaddons('digital_product'))
                                                                <td>
                                                                    @php
                                                                        $items = helper::getmin_maxorder(
                                                                            $product->product_id,
                                                                            $getorderdata->vendor_id,
                                                                        );
                                                                    @endphp

                                                                    @if (helper::appdata($getorderdata->vendor_id)->product_type == 2 && $getorderdata->payment_status == 2)
                                                                        @if (@$items->download_file != '' && @$items->download_file != null)
                                                                            <a href="{{ url(env('ASSETPATHURL') . 'admin-assets/images/product/' . @$items->download_file) }}"
                                                                                tooltip="{{ trans('labels.download') }}"
                                                                                target="_blank"><i
                                                                                    class="fa-solid fa-download"></i></a>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            @endif --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-12">
                                <div class="card bg-light border-0 rounded-0">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between px-0 pt-0 border-0 bg-light">
                                                <span class="fw-500 fs-15">{{ trans('labels.sub_total') }}</span>
                                                <span
                                                    class="fw-600 fs-15">{{ helper::currency_formate($getorderdata->sub_total, $getorderdata->vendor_id) }}</span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between px-0 py-2 border-0 bg-light">
                                                <span class="fw-500 fs-15">{{ trans('labels.discount') }}
                                                    {{ $getorderdata->offer_code != '' ? '(' . $getorderdata->offer_code . ')' : '' }}
                                                </span>
                                                <span class="fw-600 fs-15">-
                                                    {{ helper::currency_formate($getorderdata->offer_amount, $getorderdata->vendor_id) }}</span>
                                            </li>
                                            @php
                                                $tax = explode('|', $getorderdata->tax_amount);
                                                $tax_name = explode('|', $getorderdata->tax_name);
                                            @endphp
                                            @if ($getorderdata->tax_amount != null && $getorderdata->tax_amount != '')
                                                @foreach ($tax as $key => $tax_value)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between px-0 py-2 border-0 bg-light">
                                                        <span class="fw-500 fs-15">{{ $tax_name[$key] }}</span>
                                                        <span
                                                            class="fw-600 fs-15">{{ helper::currency_formate(@(float) $tax[$key], $getorderdata->vendor_id) }}</span>
                                                    </li>
                                                @endforeach
                                            @endif
                                            @if ($getorderdata->order_type == 1)
                                                <li
                                                    class="list-group-item d-flex justify-content-between px-0 py-2 border-0 bg-light">
                                                    <span class="fw-500 fs-15">{{ trans('labels.delivery') }}
                                                        @if ($getorderdata->shipping_area != '')
                                                            ({{ $getorderdata->shipping_area }})
                                                        @endif
                                                    </span>
                                                    <span class="fw-600 fs-15">
                                                        @if ($getorderdata->delivery_charge > 0)
                                                            {{ helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id) }}
                                                        @else
                                                            {{ trans('labels.free') }}
                                                        @endif
                                                    </span>
                                                </li>
                                            @endif
                                            <li
                                                class="list-group-item d-flex justify-content-between px-0 pb-0 border-0 border-top-dashed text-secondary bg-light">
                                                <span class="fw-600 fs-16">{{ trans('labels.total') }}
                                                    {{ trans('labels.amount') }}</span>
                                                <span
                                                    class="fw-600 fs-16">{{ helper::currency_formate($getorderdata->grand_total, $getorderdata->vendor_id) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
        </div>
    </section>
    <!-- ORDER DETAILS AREA END -->
@endsection
@section('scripts')
    <script>
        function showaddons(id, item_name, variation_name, variation_price, extras_name, extras_price) {
            $('#selected_addons_Label').html(item_name);
            var variation_title = "{{ trans('labels.variants') }}";
            var extra_title = "{{ trans('labels.extras') }}";
            var variations = variation_name.split('|');
            var extras = extras_name.split("|");

            var extra_price = extras_price.split('|');
            var html = "";
            if (variations != '') {
                html += '<p class="fw-600 m-0 text-dark" id="variation_title">' + variation_title +
                    '</p><ul class="mt-1 {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">';
                html += '<li class="px-0 fs-7 fw-500 my-1 d-flex align-items-center justify-content-between">' +
                    variations + '<span class="text-dark fs-7">' +
                    currency_formate(parseFloat(
                        variation_price)) + '</span></li>'
                html += '</ul>';
            }
            $('#item-variations').html(html);
            var html1 = '';
            if (extras != '') {
                $('#extras_title').removeClass('d-none');
                html1 += '<p class="fw-600 m-0" id="extras_title">' + extra_title +
                    '</p><ul class="m-0 {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">';
                for (i in extras) {
                    html1 += '<li class="px-0 fs-7 my-1 fw-500 d-flex align-items-center justify-content-between">' +
                        extras[i] + '<span class="text-dark fs-7">' +
                        currency_formate(parseFloat(
                            extra_price[i])) + '</span></li>'
                }
                html1 += '</ul>';
            }
            $('#item-extras').html(html1);
            $('#modal_selected_addons').modal('show');
        }
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/orders.js') }}"></script>
@endsection

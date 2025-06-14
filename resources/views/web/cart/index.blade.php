@extends('web.layout.default')

@section('contents')
    <!-- BREADCRUMB AREA START -->

    <section class="py-4 mb-4 bg-light">

        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}"><a
                            class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>

                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.cart') }}</li>

                </ol>

            </nav>

        </div>

    </section>

    <!-- BREADCRUMB AREA END -->

    <!-- CART AREA START -->
    @php

        $subtotal = 0;

    @endphp
    <section class="cart">
        <div class="container">
            @if (count($getcartlist) > 0)
            @if (@helper::checkaddons('cart_checkout_countdown'))
            @include("web.cart_checkout_countdown")
            @endif
                <div class="table-responsive cart-table cart-view">
                    <table class="table m-0 rounded-2 overflow-hidden">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="cart-table-title {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }} text-light p-3">
                                    {{ trans('labels.product') }}
                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    {{ trans('labels.price') }}
                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    {{ trans('labels.quantity') }}
                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    {{ trans('labels.total') }}
                                </th>
                                <th scope="col" class="cart-table-title text-light p-3">
                                    {{ trans('labels.action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getcartlist as $cartdata)
                                @php
                                    $subtotal += $cartdata->product_price * $cartdata->qty;
                                @endphp
                                <tr class="align-middle">
                                    <td class="p-3">
                                        <div class="product-detail">
                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $cartdata->product_slug) }}"
                                                target="_blank">
                                                <img class="pr-img"
                                                    src="{{ helper::image_path($cartdata->product_image) }}"
                                                    alt="image"></a>
                                            <div
                                                class="details {{ session()->get('direction') == 2 ? 'text-end' : 'text-start' }}">
                                                <a class="cart_title">
                                                    <div class="d-flex justify-content-between">

                                                        <p class="text-dark line-2">
                                                            {{ $cartdata->product_name }}</p>
                                                    </div>
                                                    @if ($cartdata->variation_id != '' || $cartdata->extras_id != '')
                                                        <P class="mb-2 d-flex">
                                                            <span type="button" class="text-muted fw-400 fs-7"
                                                                onclick='showaddons("{{ $cartdata->id }}","{{ $cartdata->product_name }}","{{ $cartdata->variation_name }}","{{ $cartdata->price }}","{{ $cartdata->extras_name }}","{{ $cartdata->extras_price }}")'>
                                                                {{ trans('labels.customize') }}
                                                            </span>
                                                        </P>
                                                    @else
                                                        -
                                                    @endif
                                                </a>
                                                <input type="hidden" name="vendor" id="overview_vendor"
                                                    value="{{ $cartdata->vendor_id }}">
                                                <input type="hidden" name="variants_name" id="variants_name"
                                                    value="{{ $cartdata->variation_name }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <p class="item-price">
                                            {{ helper::currency_formate($cartdata->price, $cartdata->vendor_id) }}
                                        </p>
                                    </td>
                                    <td class="p-3">
                                        <div class="d-flex justify-content-center">
                                            <div
                                                class="input-group qty-input-cart justify-content-center small w-100 responsive-margin m-0 rounded-2 hight-modal-btn align-items-center">
                                                <a class="btn p-0 change-qty-2 h-100 border-0" id="minus"
                                                    data-type="minus" data-item_id="{{ $cartdata->product_id }}"
                                                    onclick="qtyupdate('{{ $cartdata->id }}','{{ $cartdata->product_id }}','{{ $cartdata->variation_id }}','{{ $cartdata->product_price }}','decreaseValue')"
                                                    value="minus value"><i class="fa fa-minus fs-13"></i>
                                                </a>
                                                <input type="number" class="border-0 text-center bg-transparent"
                                                    id="number_{{ $cartdata->id }}" name="number"
                                                    value="{{ $cartdata->qty }}" min="1" max="10" readonly>
                                                <a class="btn p-0 change-qty-2 h-100 border-0" id="plus"
                                                    data-item_id="{{ $cartdata->product_id }}"
                                                    onclick="qtyupdate('{{ $cartdata->id }}','{{ $cartdata->product_id }}','{{ $cartdata->variation_id }}','{{ $cartdata->product_price }}','increase')"
                                                    data-type="plus" value="plus value"><i class="fa fa-plus fs-13"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <p class="fs-15">
                                            {{ helper::currency_formate($cartdata->product_price * $cartdata->qty, $cartdata->vendor_id) }}
                                        </p>
                                    </td>

                                    <td class="p-3">
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:void(0)"
                                                onclick="clearcart('{{ URL::to(@$vendordata->slug . '/cart/clear-' . $cartdata->id) }}')"
                                                class="delete-icon" tooltip="Remove">
                                                <i class="fa-solid fa-trash-can text-light"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



                <p class="muted {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }} fs-7 line-2 mt-2"> Shipping, taxes, and discounts codes calculated at checkout. (if applicable)</p>

                <!--@if (@helper::checkaddons('cart_checkout_progressbar'))-->
                <!--@include("web.cart_checkout_progressbar")-->
                <!--@endif-->
                
                <div class="row g-3 justify-content-between pt-3 mb-sm-5 mb-3">
                    
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ URL::to(@$vendordata->slug . '/') }}" type="button"
                            class="btn fs-14 fw-500 btn-fashion w-100">
                            <i class="fa-light fa-arrow-left-long fw-600"></i>
                            <span class="fw-600 px-1">{{ trans('labels.back_top_shop') }}</span>
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        @if (@helper::checkaddons('customer_login'))
                            @if (helper::appdata(@$vendordata->id)->checkout_login_required == 1)
                                @if (Auth::user() && Auth::user()->type == 3)
                                    <a class="btn btn-primary rounded-0 py-2 fs-14 w-100"
                                        onclick="checkout('0','{{ URL::to(@$vendordata->slug . '/checkout') }}')"><span>{{ trans('labels.go_to_checkout') }}</span></a>
                                @else
                                    @if (helper::appdata(@$vendordata->id)->is_checkout_login_required == 1)
                                        <a type="button" class="btn btn-fashion w-100"
                                            href="{{ URL::to(@$vendordata->slug . '/login') }}">
                                            {{ trans('labels.go_to_checkout') }}
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-fashion w-100" data-bs-toggle="modal"
                                            onclick="checkout('1','')" data-bs-target="#loginmodel">
                                            {{ trans('labels.go_to_checkout') }}
                                        </button>
                                    @endif
                                @endif
                            @else
                                <a class="btn btn-primary rounded-0 py-2 fs-14 w-100"
                                    onclick="checkout('0','{{ URL::to(@$vendordata->slug . '/checkout') }}')"><span>{{ trans('labels.go_to_checkout') }}</span></a>
                            @endif
                        @else
                            <a class="btn btn-primary rounded-0 py-2 fs-14 w-100"
                                onclick="checkout('0','{{ URL::to(@$vendordata->slug . '/checkout') }}')"
                                href="{{ URL::to(@$vendordata->slug . '/checkout') }}"><span>{{ trans('labels.go_to_checkout') }}</span></a>
                        @endif
                    </div>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
    <input type="hidden" name="qtyurl" id="qtyurl" value="{{ URL::to('/changeqty') }}">
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
                html += '<li class="px-0 fw-500 fs-7 my-1 d-flex align-items-center justify-content-between">' + variations + '<span class="text-dark fs-7">' +
                    currency_formate(parseFloat(
                        variation_price)) + '</span></li>'
                html += '</ul>';
            }
            $('#item-variations').html(html);
            var html1 = '';
            if (extras != '') {
                $('#extras_title').removeClass('d-none');
                html1 += '<p class="fw-600 m-0" id="extras_title">' + extra_title + '</p><ul class="m-0 {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">';
                for (i in extras) {
                    html1 += '<li class="px-0 fw-500 fs-7 d-flex my-1 align-items-center justify-content-between">' + extras[i] + '<span class="text-dark fs-7">' +
                        currency_formate(parseFloat(
                            extra_price[i])) + '</span></li>'
                }
                html1 += '</ul>';
            }
            $('#item-extras').html(html1);
            $('#modal_selected_addons').modal('show');
        }

        var minorderamount = "{{ helper::appdata($vendordata->id)->min_order_amount }}";
        var subtotal = "{{ $subtotal }}";
        var min_order_amount_msg = "{{ trans('messages.min_order_amount_required') }}";


        function checkout(type, checkouturl) {
            if (minorderamount != "" && minorderamount != null) {
                if (parseInt(minorderamount) > parseInt(subtotal)) {
                    showtoast("error", min_order_amount_msg + ' ' + minorderamount);
                } else {
                    if (type == 0) {
                        location.href = checkouturl;
                    } else {
                        $('#loginmodel').modal('show');
                    }
                }
            } else {
                if (type == 0) {
                    location.href = checkouturl;
                } else {
                    $('#loginmodel').modal('show');
                }
            }

        }

        var is_logedin = "{{ @Auth::user()->type == 3 ? 1 : 2 }}";
        var checkouturl = "{{ URL::to(@$vendordata->slug . '/checkout') }}";
        var qtycheckurl = "{{ URL::to('/cart/qtyupdate') }}";
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/products.js') }}"></script>

    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/cart.js') }}"></script>
@endsection

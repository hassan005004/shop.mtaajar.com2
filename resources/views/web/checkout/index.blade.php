@extends('web.layout.default')
@section('contents')
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark" href="{{ URL::to(@$vendordata->slug . '/cart') }}">{{ trans('labels.cart') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.checkout') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <!-- CHECKOUT AREA START -->
    <section class="checkout">
        <div class="container">
            @php
                $subtotal = 0;

            @endphp
            @foreach ($getcartlist as $cartdata)
                @php

                    $subtotal += $cartdata->product_price * $cartdata->qty;
                    $productprice = $cartdata->price;
                @endphp
            @endforeach

            @if (count($getcartlist) > 0)
                @if (@helper::checkaddons('cart_checkout_countdown'))
                    @include('web.cart_checkout_countdown')
                @endif
                <div class="row">
                    <div class="col-lg-8 col-auto">
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <div class="personal-info bg-light p-2 mb-3">
                                    <h5 class="text-dark fw-600 border-bottom pb-2 mb-3"> <i class="fa-regular fa-user"></i>
                                        <span class="mx-2">{{ trans('labels.personal_info') }}</span>
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="user_name" class="form-label">{{ trans('labels.name') }}</label>
                                                <input type="text" class="form-control input-h rounded-0" id="user_name"
                                                    name="user_name" placeholder="{{ trans('labels.name') }}"
                                                    value="{{ Auth::user() && Auth::user()->type == 3 ? Auth::user()->name : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="user_email"
                                                    class="form-label">{{ trans('labels.email') }}</label>
                                                <input type="email" class="form-control input-h rounded-0" id="user_email"
                                                    name="user_email" placeholder="{{ trans('labels.email') }}"
                                                    value="{{ Auth::user() && Auth::user()->type == 3 ? Auth::user()->email : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="user_mobile"
                                                    class="form-label">{{ trans('labels.mobile') }}</label>
                                                <input type="text" class="form-control input-h rounded-0 numbers_only"
                                                    id="user_mobile" name="user_mobile"
                                                    placeholder="{{ trans('labels.mobile') }}"
                                                    value="{{ Auth::user() && Auth::user()->type == 3 ? Auth::user()->mobile : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (helper::appdata($vendordata->id)->product_type == 1)
                                    <div class="billing-info bg-light p-2 mb-3">
                                        <h5 class="text-dark fw-600 border-bottom py-2 mb-3"> <i
                                                class="fa-regular fa-file-lines"></i>
                                            <span class="mx-2">{{ trans('labels.billing_address') }}</span>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="billing_address"
                                                        class="form-label">{{ trans('labels.address') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="billing_address" name="billing_address"
                                                        placeholder="{{ trans('labels.address') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing_landmark"
                                                        class="form-label">{{ trans('labels.landmark') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="billing_landmark" name="billing_landmark"
                                                        placeholder="{{ trans('labels.landmark') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing_postal_code"
                                                        class="form-label">{{ trans('labels.postalcode') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="billing_postal_code" name="billing_postal_code"
                                                        placeholder="{{ trans('labels.postalcode') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing_city"
                                                        class="form-label">{{ trans('labels.city') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="billing_city" name="billing_city"
                                                        placeholder="{{ trans('labels.city') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing_state"
                                                        class="form-label">{{ trans('labels.state') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="billing_state" name="billing_state"
                                                        placeholder="{{ trans('labels.state') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing_country"
                                                        class="form-label">{{ trans('labels.country') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="billing_country" name="billing_country"
                                                        placeholder="{{ trans('labels.country') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shipping-info bg-light p-2 mb-3">
                                        <div class="row justify-content-between border-bottom gx-0 pb-2 mb-2">
                                            <h5 class="text-dark fw-600 col-auto mb-2 mb-sm-0"> <i
                                                    class="fa-regular fa-truck-fast"></i>
                                                <span class="mx-2">{{ trans('labels.shipping_address') }}</span>
                                            </h5>
                                            <div class="sam_address d-flex align-items-center col-auto">
                                                <input type="checkbox" name="" id="same" class="mx-1"
                                                    onclick="copy_billing_data()">
                                                <label for="same"
                                                    class="fs-7 text-secondary">{{ trans('labels.same_As_billing_address') }}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shipping_address"
                                                        class="form-label">{{ trans('labels.address') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="shipping_address" name="shipping_address"
                                                        placeholder="{{ trans('labels.address') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shipping_landmark"
                                                        class="form-label">{{ trans('labels.landmark') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="shipping_landmark" name="shipping_landmark"
                                                        placeholder="{{ trans('labels.landmark') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shipping_postal_code"
                                                        class="form-label">{{ trans('labels.postalcode') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="shipping_postal_code" name="shipping_postal_code"
                                                        placeholder="{{ trans('labels.postalcode') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shipping_city"
                                                        class="form-label">{{ trans('labels.city') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="shipping_city" name="shipping_city"
                                                        placeholder="{{ trans('labels.city') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shipping_state"
                                                        class="form-label">{{ trans('labels.state') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="shipping_state" name="shipping_state"
                                                        placeholder="{{ trans('labels.state') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shipping_country"
                                                        class="form-label">{{ trans('labels.country') }}</label>
                                                    <input type="text" class="form-control input-h rounded-0"
                                                        id="shipping_country" name="shipping_country"
                                                        placeholder="{{ trans('labels.country') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-auto">
                        @if (@helper::checkaddons('subscription'))
                            @if (@helper::checkaddons('coupon'))
                                @php
                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                        ->orderByDesc('id')
                                        ->first();
                                    $user = App\Models\User::where('id', $vendordata->id)->first();
                                    if ($user->allow_without_subscription == 1) {
                                        $coupon = 1;
                                    } else {
                                        $coupon = @$checkplan->coupons;
                                    }
                                @endphp
                                @if ($coupon == 1)
                                    <div class="card bg-light bg-light border-0 rounded-0 mb-3 p-2">
                                        <div class="card-body">
                                            <h5
                                                class="text-dark fw-600 pb-2 mb-3 border-bottom {{ session()->get('direction') == '2' ? 'text-right' : '' }}">
                                                <i class="fa-light fa-badge-percent"></i><span
                                                    class="px-2 checkoutform-title">{{ trans('labels.apply_offer') }}</span>
                                            </h5>

                                            <div class="d-flex gap-3 align-items-center">
                                                <input type="text" class="form-control rounded-2 input-h"
                                                    value="{{ Session::has('offer_code') ? Session::get('offer_code') : '' }}"
                                                    name="promocode" id="couponcode"
                                                    placeholder="{{ trans('labels.enter_coupon_code') }}" readonly>

                                                <button class="btn btn-md mb-0 d-none bg-black text-white" id="btnremove"
                                                    onclick="RemoveCopon()">{{ trans('labels.remove') }}</button>

                                                <button class="btn btn-md mb-0 d-block bg-black text-white" id="btnapply"
                                                    onclick="ApplyCopon()">{{ trans('labels.apply') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @else
                            @if (@helper::checkaddons('coupon'))
                                <div class="card bg-light bg-light border-0 rounded-0 mb-3 p-2">
                                    <div class="card-body">
                                        <h5
                                            class="text-dark fw-600 pb-2 mb-3 border-bottom {{ session()->get('direction') == '2' ? 'text-right' : '' }}">
                                            <i class="fa-light fa-badge-percent"></i><span
                                                class="px-2 checkoutform-title">{{ trans('labels.apply_offer') }}</span>
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control rounded-2 input-h"
                                                value="{{ Session::has('offer_code') ? Session::get('offer_code') : '' }}"
                                                name="promocode" id="couponcode"
                                                placeholder="{{ trans('labels.coupon_code') }}" readonly>

                                            <button class="btn btn-md btnapply mx-2 mb-0 bg-black text-white d-none"
                                                onclick="RemoveCopon()">{{ trans('labels.remove') }}</button>

                                            <button class="btn btn-md btnapply mx-2 mb-0 bg-black text-white d-block"
                                                onclick="ApplyCopon()">{{ trans('labels.apply') }}</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if (helper::appdata($vendordata->id)->product_type == 1)
                            <div class="shipping-area-info bg-light card border-0 rounded-0 mb-3 p-2">
                                <div class="card-body">
                                    <p class="fs-5 text-dark fw-600 pb-2 mb-3 border-bottom">
                                        {{ trans('labels.shipping_area') }}</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-0">
                                                <select class="form-select rounded-0" name="shipping_area"
                                                    id="shipping_area">
                                                    <option value="" selected disabled> {{ trans('labels.select') }}
                                                    </option>
                                                    @forelse ($getshippingarealist as $shippingarea)
                                                        <option value="{{ $shippingarea->id }}"
                                                            data-delivery-charge="{{ $shippingarea->delivery_charge }}"
                                                            data-area-name="{{ $shippingarea->name }}">
                                                            {{ $shippingarea->name }}
                                                            @if ($shippingarea->delivery_charge > 0)
                                                                {{ trans('labels.delivery_charge') }} :
                                                                {{ helper::currency_formate($shippingarea->delivery_charge, @$vendordata->id) }}
                                                            @else
                                                                {{ trans('labels.free_delivery') }}
                                                            @endif
                                                        </option>
                                                    @empty
                                                        <option value="" selected disabled>
                                                            {{ trans('labels.nodata_found') }} </option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card bg-light bg-light border-0 rounded-0 mb-3 p-2">
                            <div class="card-body">
                                <h5 class="text-dark fw-600 pb-2 mb-3 border-bottom">
                                    <i class="fa-regular fa-clipboard-list"></i>
                                    <span class="mx-2">
                                        {{ trans('labels.summary') }}
                                    </span>
                                </h5>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex align-items-center border-0 px-0 justify-content-between bg-light">
                                        <span>{{ trans('labels.sub_total') }}</span>
                                        <span>{{ helper::currency_formate($subtotal, @$vendordata->id) }}</span>
                                    </li>
                                    @if (Session::get('offer_type') == 1)
                                        @php
                                            $discount = Session::get('offer_amount');
                                        @endphp
                                    @else
                                        @php
                                            $discount = $subtotal * (Session::get('offer_amount') / 100);
                                        @endphp
                                    @endif
                                    <li
                                        class="list-group-item d-flex align-items-center border-0 px-0 justify-content-between bg-light">
                                        <span>{{ trans('labels.discount') }}</span>
                                        <span class="text-muted" id="offer_amount">-
                                            {{ helper::currency_formate($discount, @$vendordata->id) }}</span>
                                    </li>

                                    @php
                                        $totalcarttax = 0;
                                    @endphp
                                    @foreach ($taxArr['tax'] as $k => $tax)
                                        @php
                                            $rate = $taxArr['rate'][$k];
                                            $totalcarttax += (float) $taxArr['rate'][$k];
                                        @endphp
                                        <li
                                            class="list-group-item d-flex align-items-center border-0 px-0 justify-content-between bg-light">
                                            <span>{{ $tax }}</span>
                                            <span>{{ helper::currency_formate($rate, @$vendordata->id) }}</span>
                                        </li>
                                    @endforeach
                                    @php
                                        $grand_total = $subtotal - $discount + $totalcarttax;
                                    @endphp


                                    <li
                                        class="list-group-item d-flex align-items-center border-0 px-0 justify-content-between bg-light delivery-charge-section d-none">
                                        <span>{{ trans('labels.delivery_charge') }}</span>
                                        <span class="delivery_charge"></span>
                                    </li>


                                    <li
                                        class="list-group-item d-flex bg-light px-0 border-0 border-top-dashed align-items-center justify-content-between">
                                        <strong class="text-dark fw-600">{{ trans('labels.grand_total') }}</strong>
                                        <strong class="grand_total text-dark fw-600"
                                            id="total_amount">{{ helper::currency_formate($grand_total, @$vendordata->id) }}</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shipping-area-info bg-light card border-0 rounded-0 mb-3 p-2">
                            <div class="card-body">
                                <h5 class="text-dark fw-600 pb-2 mb-3 border-bottom">
                                    <i class="fa-regular fa-note-sticky"></i>
                                    <span class="mx-2">
                                        {{ trans('labels.order_notes') }}
                                    </span>
                                </h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control rounded-0" name="order_notes" id="order_notes" rows="3"
                                                placeholder="{{ trans('labels.order_notes') }} {{ trans('labels.optional') }} "></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('web.service-trusted')
                        <div class="card bg-light border-0 rounded-0 mb-3 p-2">
                            <div class="card-body">
                                <h5 class="text-dark fw-600 border-bottom fw-600 pb-2 mb-3">
                                    <i class="fa-regular fa-money-bill"></i>
                                    <span class="mx-2">
                                        {{ trans('labels.choose_payment_method') }}
                                    </span>
                                </h5>
                                <div class="payment-option">
                                    <div class="row g-sm-3 g-2 justify-content-between">
                                        @php $key =0; @endphp
                                        @forelse ($getpaymentmethodslist as $pmdata)
                                            @php
                                                // Check if the current $pmdata is a system addon and activated
                                                if ($pmdata->payment_type == '1' || $pmdata->payment_type == '16') {
                                                    $systemAddonActivated = true;
                                                } else {
                                                    $systemAddonActivated = false;
                                                }
                                                $addon = App\Models\SystemAddons::where(
                                                    'unique_identifier',
                                                    $pmdata->unique_identifier,
                                                )->first();
                                                if ($addon != null && $addon->activated == 1) {
                                                    $systemAddonActivated = true;
                                                }
                                                $transaction_type = $pmdata->payment_type;
                                            @endphp
                                            @if ($systemAddonActivated)
                                                <label class="form-check-label col-md-6 col-6"
                                                    for="payment{{ $transaction_type }}">
                                                    <input class="form-check-input" type="radio"
                                                        name="transaction_type" id="payment{{ $transaction_type }}"
                                                        data-payment-type="{{ $transaction_type }}"
                                                        value="{{ $transaction_type }}"
                                                        data-currency="{{ $pmdata->currency }}"
                                                        @if ($transaction_type == '6') data-bank-name="{{ $pmdata->bank_name }}"  data-account-holder-name="{{ $pmdata->account_holder_name }}"  data-account-number="{{ $pmdata->account_number }}" data-bank-ifsc-code="{{ $pmdata->bank_ifsc_code }}" @endif
                                                        {{ $key++ == 0 ? 'checked' : '' }}>
                                                    <div
                                                        class="{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'payment-gateway-rtl' : 'payment-gateway' }} mb-0 rounded-0 w-100">
                                                        <span
                                                            class="text-center d-flex gap-2 justify-content-center align-items-center"><img
                                                                src="{{ helper::image_path($pmdata->image) }}"
                                                                alt=""
                                                                class="m-0">{{ ucfirst($pmdata->payment_name) }}</span>

                                                        @if (in_array($transaction_type, ['2', '3', '4', '5', '8', '9', '10']))
                                                            @if ($transaction_type == '2')
                                                                <input type="hidden" name="razorpaykey" id="razorpaykey"
                                                                    value="{{ $pmdata->public_key }}">
                                                            @endif
                                                            @if ($transaction_type == '3')
                                                                <input type="hidden" name="stripekey" id="stripekey"
                                                                    value="{{ $pmdata->public_key }}">
                                                            @endif
                                                            @if ($transaction_type == '4')
                                                                <input type="hidden" name="flutterwavekey"
                                                                    id="flutterwavekey"
                                                                    value="{{ $pmdata->public_key }}">
                                                            @endif
                                                            @if ($transaction_type == '5')
                                                                <input type="hidden" name="paystackkey" id="paystackkey"
                                                                    value="{{ $pmdata->public_key }}">
                                                            @endif
                                                        @endif
                                                        @if (Auth::user())
                                                            @if ($transaction_type == 16)
                                                                <span
                                                                    class="text-end text-muted">{{ helper::currency_formate(Auth::user()->wallet, $vendordata->id) }}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    @if ($transaction_type == '6')
                                                        <input type="hidden" name="payment_description"
                                                            id="payment_description"
                                                            value="{{ $pmdata->payment_description }}">
                                                    @endif
                                                </label>
                                                @if ($transaction_type == '3')
                                                    <div class="my-3 d-none" id="card-element"></div>
                                                @endif
                                            @endif
                                        @empty
                                            @include('web.nodata')
                                        @endforelse
                                        @if (!in_array('3', array_column($getpaymentmethodslist->toArray(), 'payment_type')))
                                            <input type="hidden" name="stripekey" id="stripekey" value="">
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-fashion w-100 mt-4 text-capitalize fs-7 placeorder"
                                            onclick="placeorder()">{{ trans('labels.proceed_pay') }}</button>
                                        @if (env('Environment') == 'sendbox')
                                            <button type="button" class="btn btn-fashion w-100  mt-4"
                                                onclick="randomdata()">{{ trans('labels.data') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="grand_total" id="grand_total" value="{{ $grand_total }}">
                <input type="hidden" name="product_price" id="product_price" value="{{ $productprice }}">
                <input type="hidden" name="sub_total" id="sub_total" value="{{ $subtotal }}">
                <input type="hidden" name="couponcode" id="couponcode" value="{{ @$offer_code }}">
                <input type="hidden" name="discount_amount" id="discount_amount" value="{{ $discount }}">
                <input type="hidden" name="totaltax" id="totaltax" value="{{ $totalcarttax }}">
                <input type="hidden" name="tax_amount" id="tax_amount" value="{{ implode('|', $taxArr['rate']) }}">
                <input type="hidden" name="tax_name" id="tax_name" value="{{ implode('|', $taxArr['tax']) }}">
                <input type="hidden" name="delivery_charge" id="delivery_charge" value="0">

                <input type="hidden" name="vendor_id" id="vendor_id" value="{{ $vendordata->id }}">
                <form action="{{ url($vendordata->slug . '/placeorder/paypalrequest') }}" method="post"
                    class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="return" value="2">
                    <input type="submit" class="callpaypal" name="submit">
                </form>
                <input type="hidden" name="copycodeurl" id="copycodeurl"
                    value="{{ URL::to($vendordata->slug . '/copycode') }}">
            @else
                @include('web.nodata')
            @endif
        </div>
        <!-- offers-label -->
        @if (@helper::checkaddons('subscription'))
            @if (@helper::checkaddons('coupon'))
                @php
                    $checkplan = App\Models\Transaction::where('vendor_id', @$vendordata->id)
                        ->orderByDesc('id')
                        ->first();
                    $user = App\Models\User::where('id', @$vendordata->id)->first();
                    if ($user->allow_without_subscription == 1) {
                        $coupon = 1;
                    } else {
                        $coupon = @$checkplan->coupons;
                    }
                @endphp
                @if ($coupon == 1)
                    <div data-bs-toggle="offcanvas" data-bs-target="#offerslabel" aria-controls="offcanvasExample">
                        <div
                            class="offers-label {{ session()->get('direction') == 2 ? 'offers-label-rtl rtl' : 'offers-label-ltr' }}">
                            <i class="fa-light fa-badge-percent text-white"></i>
                            <div class="offers-label-name">{{ trans('labels.offers') }}</div>
                        </div>
                    </div>
                @endif
            @endif
        @else
            @if (@helper::checkaddons('coupon'))
                <div data-bs-toggle="offcanvas" data-bs-target="#offerslabel" aria-controls="offcanvasExample">
                    <div
                        class="offers-label {{ session()->get('direction') == 2 ? 'offers-label-rtl' : 'offers-label-ltr' }}">
                        <i class="fa-light fa-badge-percent text-white"></i>
                        <div class="offers-label-name">{{ trans('labels.offers') }}</div>
                    </div>
                </div>
            @endif
        @endif


        <!-- offers-label sidebar -->
        <div class="offcanvas {{ session()->get('direction') == 2 ? 'offcanvas-start' : 'offcanvas-end' }} offers-w w-75"
            tabindex="-1" id="offerslabel" aria-labelledby="offerslabelLabel">
            <div class="offcanvas-header border-bottom bg-light">
                <h5 class="offcanvas-title offers-title" id="offerslabelLabel"><i class="fa-light fa-badge-percent"></i>
                    {{ trans('labels.coupons_offers') }}
                </h5>
                <button type="button" class="btn-close rounded-2 shadow-lg border" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row g-3">
                    @if (count(helper::getcoupons(@$vendordata->id)) > 0)
                        @foreach (helper::getcoupons(@$vendordata->id) as $key => $coupon)
                            <div class="card border p-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="coupons_card"
                                            id="span{{ $key }}">{{ $coupon->offer_code }}</span>
                                        @if (str_contains(Request()->url(), 'checkout'))
                                            <p class="cp copy-code" id="{{ $coupon->offer_code }}"
                                                onclick="copyToClipboard(this.id)">
                                                {{ trans('labels.copy_code') }}
                                            </p>
                                        @endif
                                    </div>

                                    <h5 class="m-0 coupon-label line-2">{{ $coupon->offer_name }}</h5>
                                    <p class="text-muted fw-400 fs-7 pt-2 line-3">
                                        {{ $coupon->description }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!--<h5 class="pt-3 m-0 coupon-label line-2">{{ trans('labels.no_offer_found') }}</h5>-->
                        @include('web.nodata')
                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection
<!-- CHECKOUT AREA END -->
@section('scripts')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        let title = {{ Js::from(helper::appdata(@$vendordata->id)->web_title) }}
        let description = "Order Payment";
        let env = {{ Js::from(env('Environment')) }};
        let successurl = "{{ URL::to($vendordata->slug) }}/payment/";
        let orderlimit_url = "{{ URL::to($vendordata->slug) . '/checkout/orderlimit' }}";
        let failure = "{{ url()->current() }}";
        var vendorslug = "{{ $vendordata->slug }}";
        var ordersuccess = "{{ URL::to($vendordata->slug . '/orders-success-') }}";
        var checkouturl = "{{ URL::to($vendordata->slug . '/placeorder') }}";
        var min_order_amount = "{{ helper::appdata($vendordata->id)->min_order_amount }}";
        var min_order_amount_msg = "{{ trans('messages.min_order_amount_required') }}";

        $(document).ready(function() {
            if ("{{ Session::has('offer_code') }}") {
                $('#btnremove').removeClass('d-none');
                $('#btnapply').addClass('d-none');
            } else {
                $('#btnremove').addClass('d-none');
                $('#btnapply').removeClass('d-none');
            }
        });

        function ApplyCopon() {
            $('#btnapply').prop("disabled", true);
            $('#btnapply').html(
                '<span class="loader"></span>');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ URL::to($vendordata->slug . '/cart/applypromocode') }}",
                method: 'post',
                data: {
                    promocode: $('#couponcode').val(),
                    sub_total: $('#sub_total').val(),
                    vendor_id: "{{ $vendordata->id }}",
                },
                success: function(response) {
                    $('#btnapply').html("{{ trans('labels.apply') }}");
                    $('#btnapply').prop("disabled", false);
                    if (response.status == 1) {
                        var total = parseFloat($('#sub_total').val());
                        var tax = "{{ @$totalcarttax }}";
                        var discount = "";
                        if (response.data.offer_type == 1) {
                            discount = response.data.offer_amount;
                        }
                        if (response.data.offer_type == 2) {
                            discount = total * parseFloat(response.data.offer_amount) / 100;
                        }
                        var delivery_charge = parseFloat($('#delivery_charge').val());
                        var grandtotal = parseFloat(total) + parseFloat(tax) + parseFloat(delivery_charge) -
                            parseFloat(discount);
                        $('#offer_amount').text('-' + currency_formate(parseFloat(discount)));
                        $('#total_amount').text(currency_formate(parseFloat(grandtotal)));
                        $('#grand_total').val(grandtotal);
                        $('#discount_amount').val(discount);
                        $('#couponcode').val(response.data.offer_code);
                        $('#btnremove').removeClass('d-none');
                        $('#btnapply').addClass('d-none');
                    } else {
                        showtoast("error", response.message);
                    }
                }
            });
        }

        function RemoveCopon() {
            $('#btnremove').prop("disabled", true);
            $('#btnremove').html(
                '<span class="loader"></span>');
            setTimeout(function() {
                $('#btnremove').html("{{ trans('labels.remove') }}");
                $('#btnremove').prop("disabled", false);
            }, 3000);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ URL::to($vendordata->slug . '/cart/removepromocode') }}",
                method: 'post',
                data: {
                    promocode: $('#couponcode').val()
                },
                success: function(response) {
                    if (response.status == 1) {
                        var total = $('#sub_total').val();
                        var tax = "{{ @$totalcarttax }}";
                        var delivery_charge = $('#delivery_charge').val();
                        var discount = 0;
                        var grandtotal = parseFloat(total) + parseFloat(tax) + parseFloat(delivery_charge) -
                            parseFloat(discount);
                        $('#offer_amount').text('-' + currency_formate(parseFloat(0)));
                        $('#total_amount').text(currency_formate(parseFloat(grandtotal)));
                        $('#couponcode').val('');
                        $('#grand_total').val(grandtotal);
                        $('#discount_amount').val(discount);
                        $('#couponcode').val('');
                        $('#btnremove').addClass('d-none');
                        $('#btnapply').removeClass('d-none');
                    } else {
                        showtoast("error", response.message);
                    }
                }
            });
        }
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/checkout.js') }}"></script>
@endsection

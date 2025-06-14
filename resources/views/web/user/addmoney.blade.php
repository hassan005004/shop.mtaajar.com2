@extends('web.layout.default')
@section('contents')
    <!------ breadcrumb ------>

    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}"><a
                            class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.add_money') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="product-prev-sec product-list-sec">
        <div class="container my-5">
            <div class="user-bg-color mb-4">
                <div class="row g-3">
                    @include('web.user.sidebar')
                    <div class="col-lg-8 col-xxl-9">
                        <div class="card p-3 border rounded user-form">
                            <div class="settings-box">
                                <h5 class="text-dark mb-3 border-bottom pb-3 profile-title">
                                    {{ trans('labels.add_money') }}
                                </h5>
                                <div class="settings-box-body dashboard-section">
                                    <p class="mb-2 fw-500">{{ trans('labels.add_amount') }}</p>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span
                                                class="input-group-text fw-500 fs-15">{{ helper::appdata($vendordata->id)->currency }}</span>
                                            <input type="number" name="amount" id="amount" class="form-control fs-15"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                    <div class="row justify-content-between border-bottom">
                                        <div class="col-xl-6 col-12">
                                            <p class="mb-0 fw-500">{{ trans('labels.notes') }} :</p>
                                            <ul class="p-0 pb-3 mt-1">
                                                <li class="text-muted fs-7 d-flex gap-2 align-items-center">
                                                    <i class="fa-regular fa-circle-check text-success"></i>
                                                    {{ trans('labels.wallet_note_1') }}
                                                </li>
                                                <li class="text-muted fs-7 d-flex gap-2 align-items-center">
                                                    <i class="fa-regular fa-circle-check text-success"></i>
                                                    {{ trans('labels.wallet_note_2') }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            @include('web.service-trusted')
                                        </div>
                                    </div>
                                    <p class="mb-2 fw-500">{{ trans('labels.payment_option') }}</p>
                                    <div class="recharge_payment_option row g-3">
                                        @php $key =0; @endphp
                                        @foreach ($getpaymentmethods as $payment)
                                            @php
                                                // Check if the current $payment is a system addon and activated
                                                $systemAddonActivated = false;

                                                $addon = App\Models\SystemAddons::where(
                                                    'unique_identifier',
                                                    $payment->unique_identifier,
                                                )->first();
                                                if ($addon != null && $addon->activated == 1) {
                                                    $systemAddonActivated = true;
                                                }
                                            @endphp
                                            @if ($systemAddonActivated)
                                                <label class="form-check-label col-md-6 cp"
                                                    for="{{ $payment->payment_type }}">
                                                    <div class="payment-check w-100">
                                                        <img src="{{ helper::image_path($payment->image) }}"
                                                            class="img-fluid" alt="" width="40px" />
                                                        @if (strtolower($payment->payment_type) == '2')
                                                            <input type="hidden" name="razorpay" id="razorpay"
                                                                value="{{ $payment->public_key }}">
                                                        @endif
                                                        @if (strtolower($payment->payment_type) == '3')
                                                            <input type="hidden" name="stripe" id="stripe"
                                                                value="{{ $payment->public_key }}">
                                                        @endif
                                                        @if (strtolower($payment->payment_type) == '4')
                                                            <input type="hidden" name="flutterwavekey" id="flutterwavekey"
                                                                value="{{ $payment->public_key }}">
                                                        @endif
                                                        @if (strtolower($payment->payment_type) == '5')
                                                            <input type="hidden" name="paystackkey" id="paystackkey"
                                                                value="{{ $payment->public_key }}">
                                                        @endif

                                                        <p class="m-0">{{ $payment->payment_name }}</p>
                                                        <input
                                                            class="form-check-input payment_radio payment-input {{ session()->get('direction') == '2' ? 'me-auto' : 'ms-auto' }}"
                                                            type="radio" name="transaction_type"
                                                            value="{{ $payment->payment_type }}"
                                                            data-currency="{{ $payment->currency }}"
                                                            {{ $key++ == 0 ? 'checked' : '' }}
                                                            id="{{ $payment->payment_type }}"
                                                            data-payment_type="{{ strtolower($payment->payment_type) }}"
                                                            style="">

                                                        @if (strtolower($payment->payment_type) == '6')
                                                            <input type="hidden"
                                                                value="{{ $payment->payment_description }}"
                                                                id="bank_payment">
                                                        @endif
                                                    </div>
                                                </label>
                                                @if ($payment->payment_type == 3)
                                                    <div class="my-3 d-none" id="card-element"></div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-12 d-flex gap-2 mt-3 justify-content-end">
                                        <button class="btn btn-secondary btn-submit rounded-0 wallet_recharge"
                                            onclick="addmoney()">{{ trans('labels.proceed_pay') }}</button>
                                    </div>

                                    <input type="hidden" name="walleturl" id="walleturl"
                                        value="{{ URL::to($vendordata->slug . '/wallet/recharge') }}">
                                    <input type="hidden" name="successurl" id="successurl"
                                        value="{{ URL::to($vendordata->slug . '/wallet') }}">
                                    <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="user_email" id="user_email"
                                        value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="user_mobile" id="user_mobile"
                                        value="{{ Auth::user()->mobile }}">
                                    <input type="hidden" name="vendor_id" id="vendor_id" value="{{ $vendordata->id }}">
                                    <input type="hidden" name="title" id="title"
                                        value="{{ helper::appdata($vendordata->id)->website_title }}">
                                    <input type="hidden" name="logo" id="logo"
                                        value="{{ helper::appdata(@$vendordata->id)->image }}">

                                    <input type="hidden" name="addsuccessurl" id="addsuccessurl"
                                        value="{{ URL::to($vendordata->slug . '/addwalletsuccess') }}">
                                    <input type="hidden" name="addfailurl" id="addfailurl"
                                        value="{{ URL::to($vendordata->slug . '/addfail') }}">

                                    <input type="hidden" name="myfatoorahurl" id="myfatoorahurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/myfatoorahrequest') }}">
                                    <input type="hidden" name="mercadopagourl" id="mercadopagourl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/mercadopagorequest') }}">
                                    <input type="hidden" name="paypalurl" id="paypalurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/paypalrequest') }}">
                                    <input type="hidden" name="toyyibpayurl" id="toyyibpayurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/toyyibpayrequest') }}">
                                    <input type="hidden" name="paytaburl" id="paytaburl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/paytabrequest') }}">
                                    <input type="hidden" name="phonepeurl" id="phonepeurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/phoneperequest') }}">
                                    <input type="hidden" name="mollieurl" id="mollieurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/mollierequest') }}">
                                    <input type="hidden" name="khaltiurl" id="khaltiurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/khaltirequest') }}">
                                    <input type="hidden" name="xenditurl" id="xenditurl"
                                        value="{{ URL::to($vendordata->slug . '/placeorder/xenditrequest') }}">

                                    <input type="hidden" name="slug" id="slug"
                                        value="{{ $vendordata->slug }}">

                                    <input type="hidden" value="{{ trans('messages.payment_selection_required') }}"
                                        name="payment_type_message" id="payment_type_message">

                                    <input type="hidden" value="{{ trans('messages.amount_required') }}"
                                        name="amount_message" id="amount_message">

                                    <form action="{{ url($vendordata->slug . '/placeorder/paypalrequest') }}"
                                        method="post" class="d-none">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="return" value="2">
                                        <input type="submit" class="callpaypal" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/wallet.js') }}"></script>
@endsection

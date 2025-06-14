@extends('web.layout.default')

@section('contents')
    <section class="my-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-6 col-12 m-auto login-form-box">
                            <div class="card border-0 rounded-0 h-100">
                                <h4 class="login-title">{{ trans('labels.register') }}</h4>
                                <p class="my-2 text-muted login-subtitle">{{ trans('labels.register_page_title') }}</p>
                                <div class="card-body p-0">
                                    <form class="my-3" method="POST"
                                        action="{{ URL::to($vendordata->slug . '/register_customer') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ trans('labels.name') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control input-h rounded-0" name="name"
                                                    value="{{ old('name') }}" id="name"
                                                    placeholder="{{ trans('labels.name') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="form-label">{{ trans('labels.email') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control input-h rounded-0" name="email"
                                                    value="{{ old('email') }}" id="email"
                                                    placeholder="{{ trans('labels.email') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile" class="form-label">{{ trans('labels.mobile') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="number" class="form-control input-h rounded-0" name="mobile"
                                                    value="{{ old('mobile') }}" id="mobile"
                                                    placeholder="{{ trans('labels.mobile') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password"
                                                    class="form-label">{{ trans('labels.password') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="password" class="form-control input-h rounded-0"
                                                    name="password" value="{{ old('password') }}" id="password"
                                                    placeholder="{{ trans('labels.password') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="referral_code"
                                                    class="form-label">{{ trans('labels.referral_code') }}</label>
                                                <input type="text" class="form-control input-h rounded-0"
                                                    name="referral_code" value="{{ @$_GET['referral'] }}"
                                                    id="referral_code"
                                                    placeholder="{{ trans('labels.referral_code_op') }}">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked="">
                                                <label class="form-check-label"
                                                    for="flexCheckChecked">{{ trans('labels.i_accept_the') }}
                                                    <a href="{{ URL::to('/termscondition') }}"
                                                        class="text-primary fw-semibold">Terms &amp; Conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                        @include('landing.layout.recaptcha')
                                        <button class="btn btn-fashion w-100 mt-4"
                                            type="submit">{{ trans('labels.register') }}</button>
                                        <p class="fs-7 text-center mt-3">
                                            {{ trans('labels.already_have_an_account') }}
                                            <a href="{{ URL::to($vendordata->slug . '/login') }}"
                                                class="text-primary fw-semibold">{{ trans('labels.login') }}</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->auth_image) }}"
                                class="object-fit-cover w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- IF VERSION 2  -->
    @if (helper::appdata('')->recaptcha_version == 'v2')
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
    <!-- IF VERSION 3  -->
    @if (helper::appdata('')->recaptcha_version == 'v3')
        {!! RecaptchaV3::initJs() !!}
    @endif
@endsection

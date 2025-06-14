@extends('landing.layout.default')
@section('content')
    <!-- BREADCRUMB AREA START -->

    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 gap-2">
                    <li class="breadcrumb-item">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted breadcrumb-item active d-flex gap-2" aria-current="page">
                        {{ trans('landing.contact_us') }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- <section class="py-5 mb-5 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <h3 class="breadcrumb-title fw-semibold mb-2 text-center">{{ trans('landing.contact_us') }}</h3>
                <ol class="breadcrumb justify-content-center">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('landing.contact_us') }}</li>
                </ol>
            </nav>
        </div>
    </section> --}}

    <section>
        <div class="contact-bg-color py-0">
            <div class="container contact-container">
                <div class="contact-main">
                    <div class="row align-items-center g-3 mt-4 mb-5">
                        <div class="col-lg-6">
                            <form class="shadow-lg bg-white rounded-3 px-4 py-4" action="{{ URL::To('/inquiry') }}"
                                method="post">
                                @csrf
                                <h5 class="contact-form-title text-center">
                                    {{ trans('landing.contact_us') }}
                                </h5>
                                <p class="contact-form-subtitle text-center text-muted">
                                    {{ trans('landing.contact_section_description') }}</p>
                                <div class="row g-1 mt-3">
                                    <div class="col-md-6">
                                        <label for="name"
                                            class="form-label contact-form-label">{{ trans('landing.name') }}</label>
                                        <input type="text" class="form-control contact-input" name="name"
                                            placeholder="{{ trans('landing.name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email"
                                            class="form-label contact-form-label">{{ trans('landing.email') }}</label>
                                        <input type="email" class="form-control contact-input" name="email"
                                            placeholder="{{ trans('landing.email') }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress"
                                            class="form-label contact-form-label">{{ trans('landing.mobile') }}</label>
                                        <input type="text" class="form-control contact-input mobile-number"
                                            name="mobile" placeholder="{{ trans('landing.mobile') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message"
                                            class="form-label contact-form-label">{{ trans('landing.message') }}</label>
                                        <textarea class="form-control contact-input" rows="3" name="message" placeholder="{{ trans('landing.message') }}"
                                            required></textarea>
                                    </div>
                                    @include('landing.layout.recaptcha')
                                    <div class="col-6 mx-auto">
                                        <button type="submit"
                                            class="btn-secondary rounded-2 text-center m-auto d-block w-100">{{ trans('landing.submit') }}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100">
                                    <h6><span
                                            class="text-primary-color {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}"><i
                                                class="fa-solid fa-envelope fs text-primary-color"></i></span>{{ trans('landing.email') }}
                                    </h6>

                                    <p class="mb-0"><a href="mailto:" class="text-dark fs-7">
                                            {{ helper::appdata('')->email }}</a></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100 ">
                                    <h6><span
                                            class="text-primary-color  {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}">
                                            <i
                                                class="fa-solid fa-phone text-primary-color"></i></span>{{ trans('landing.mobile') }}
                                    </h6>
                                    <p class="mb-0"><a href="tel:"
                                            class="text-dark fs-7">{{ helper::appdata('')->contact }}</a></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card border-0 shadow rounded p-4 h-100">
                                    <h6><span
                                            class="text-primary-color {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}">
                                            <i
                                                class="fa-solid fa-location-dot text-primary-color"></i></span>{{ trans('landing.address') }}
                                    </h6>
                                    <p class="mb-0 fs-7">
                                    <a href="https://www.google.com/maps/place/{{ helper::appdata('')->address }}" target="_blank"
                                            class="text-dark fs-7">
                                         {{ helper::appdata('')->address }}</a>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <div class="card border-0 shadow rounded p-4 h-100 ">
                                    <div class="contact-icons d-flex flex-wrap gap-2">
                                        @foreach (@helper::getsociallinks(1) as $links)
                                            <a href="{{ $links->link }}" target="_blank"
                                                class="rounded-2 contact-icon">{!! $links->icon !!}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- subscription -->
    @include('landing.newslatter')
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

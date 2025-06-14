<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="{{ helper::appdata('')->meta_title }}" />

    <meta property="og:description" content="{{ helper::appdata('')->meta_description }}" />

    <meta property="og:image" content='{{ helper::image_path(helper::appdata('')->og_image) }}' />

    <link rel="icon" href="{{ helper::image_path(helper::appdata('')->favicon) }}" type="image" sizes="16x16">

    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/fontawesome/all.min.css') }}" />

    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'web-assets/landing/css/aos.css') }}" />

    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'web-assets/landing/css/app.css') }}" />

    <title> {{ helper::appdata('')->web_title }} </title>

</head>

<body>

    <div class="header sticky-top">

        <div class="container">

            <div class="d-flex align-items-center justify-content-between">

                <nav class="navbar logo_images">

                    <img src="{{ helper::image_path(helper::appdata('')->logo) }}" alt="">

                </nav>

                <div class="navbarnav">

                    <ul class="d-flex">

                        <li class="nav-item p-4">

                            <a class="nav-link active" href="#home"> Home </a>

                        </li>

                        <li class="nav-item p-4">

                            <a class="nav-link" href="#aboutus">About Us</a>

                        </li>

                        <li class="nav-item p-4">

                            <a class="nav-link" href="#features">Features</a>

                        </li>

                        <li class="nav-item p-4">

                            <a class="nav-link" href="#pricing">Pricing Plan</a>

                        </li>

                    </ul>

                </div>

                <div class="login-btn">

                    <a href="{{ url('admin/') }}" class="btn btn-outline-primary btn-hover-1">Login</a>

                    <a href="{{ url('admin/register') }}" class="btn btn-primary btn-hover-1">Register</a>

                </div>

            </div>

        </div>

    </div>

    <div class="toggle-btn">

        <div class="container">

            <div class="d-flex align-items-center justify-content-between">

                <nav class="navbar logo_images">

                    <img src="{{ helper::image_path(helper::appdata('')->logo) }}" alt="">

                </nav>

                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                        class="fa-solid fa-bars"></i></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">

                    <div class="offcanvas-header">

                        <nav class="navbar canvase_images">

                            <img src="{{ helper::image_path(helper::appdata('')->logo) }}" alt="">

                        </nav>

                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>

                    </div>

                    <div class="offcanvas-body">

                        <div class="navbarnav">

                            <ul class="list-group">

                                <li class="nav-item p-3">

                                    <a class="nav-link active" href="#home">Home</a>

                                </li>

                                <li class="nav-item p-3">

                                    <a class="nav-link" href="#aboutus">About Us</a>

                                </li>

                                <li class="nav-item p-3">

                                    <a class="nav-link" href="#features">Features</a>

                                </li>

                                <li class="nav-item p-3">

                                    <a class="nav-link" href="#pricing">Pricing Plan</a>

                                </li>

                                <a href="{{ url('admin/') }}"
                                    class="btn btn-outline-primary btn-hover-1 col-6 mb-4">Login</a>

                                <a href="{{ url('admin/register') }}"
                                    class="btn btn-primary btn-hover-1 col-6">Register</a>

                            </ul>

                        </div>

                        <div class="login-btn">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="banner-main-sec" id="home">

        <div class="container">

            <img src="{{ url(env('ASSETPATHURL') . 'web-assets/landing/images/shape-2.png') }}" class="banner-img-2"
                alt="">

            <div class="banner-content row">

                <div class="col-lg-6 banner-text" data-aos="zoom-in" data-aos-duration="1500">

                    <h1 class="text-heding-1">Smart shopping tool to grow your online business</h1>

                    <p class="banner-dec text-color">Simplified online orders, helping you to manage business in

                        a smart way.</p>

                    <a href="{{ url('admin/register') }}" class="btn btn-primary btn-hover-1">Register</a>

                </div>

                <div class="col-lg-6 banner-image" data-aos="flip-right" data-aos-duration="1500">

                    <img src="{{ url(env('ASSETPATHURL') . 'web-assets/landing/images/bannar-bg.png') }}"
                        alt="">

                </div>

            </div>

        </div>

    </div>

    <div class="about-main-sec" id="aboutus">

        <div class="container">

            <div class="row">

                <div class="col-lg-6 about-image">

                    <img src="{{ url(env('ASSETPATHURL') . 'web-assets/landing/images/about.png') }}" alt=""
                        data-aos="fade-down" data-aos-duration="1000">

                </div>

                <div class="col-lg-6 about-content">

                    <div data-aos="fade-up" data-aos-duration="1200">

                        <h3 class="about-title">About Us</h3>

                        <h3 class="about-text">SaaS Solutions for

                            your Business<br> Grow

                            on time</h3>

                        <p class="text-color">Business solution company sit our any how site used the our company any

                            site us it-solve theme is very professional theme business & corporate, finance, advisor,

                            solution, company and all project used, there are all kinds of websites here.

                        </p>

                        <p class="text-color">

                            Business solution company sit our any how site used the our company any site us it-solve

                            theme is very professional theme business & corporate, finance, advisor, solution, company

                            and all project used, there are all kinds of websites here.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="service-sec" id="features">

        <div class="container">

            <div class="service-heading mb-3">

                <h3 class="text-center mb-2">Features</h3>

                <h5 class="text-center service-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit.

                    Molestias, iure!</h5>

            </div>

            <div class="row">

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="iner-box h-100">

                        <i class="fa-regular fa-object-ungroup"></i>

                        <h4 class="inner-box-heading">Shopping Website</h4>

                        <p>You will get a ready to use ecommerce site after signup.</p>

                    </div>

                </div>

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1200">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-calendar"></i>

                        <h4 class="inner-box-heading">Accept online orders</h4>

                        <p>Accept orders from your clients using your own ecommerce site</p>

                    </div>

                </div>

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-rocket"></i>

                        <h4 class="inner-box-heading">Process your orders</h4>

                        <p>After order request start processing with your orders</p>

                    </div>

                </div>

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-credit-card"></i>

                        <h4 class="inner-box-heading">Accept Payments</h4>

                        <p>Accept Online / Offline payments from your clients.</p>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-bars-staggered"></i>

                        <h4 class="inner-box-heading">Fully Responsive</h4>

                        <p>Clean UI and Compatible with all devices.</p>

                    </div>

                </div>

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1400">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-link"></i>

                        <h4 class="inner-box-heading">Unique Link</h4>

                        <p>Get your personal Unique Link for all your Business.</p>

                    </div>

                </div>

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-phone"></i>

                        <h4 class="inner-box-heading">Click to call</h4>

                        <p>Your customers will reach you by just tapping on mobile number on Business.</p>

                    </div>

                </div>

                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">

                    <div class="iner-box h-100">

                        <i class="fa-solid fa-truck"></i>

                        <h4 class="inner-box-heading">Status Tracking</h4>

                        <p>Your customers will track order status.</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="work-flow-main">

        <div class="container">

            <div class="service-heading">

                <h3 class="text-center pb-4">Work flow</h3>

            </div>

            <div class="row">

                <div class="work-flow col-xl-4 col-md-6 text-center" data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom" data-aos-duration="1000">

                    <div class="work-iner-box">

                        <div class="work-check">

                            <div class="icon-circle">

                                <i class="fa-solid fa-qrcode"></i>

                                <div class="work-iner-check">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <h4 class="work-inner-heading">Create your business</h4>

                    <p class="flow-text">Easily create business make a great first

                        impression. Fill your profile, it is simple!</p>

                </div>

                <div class="work-flow col-xl-4 col-md-6 text-center" data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom" data-aos-duration="1200">

                    <div class="work-iner-box">

                        <div class="work-check">

                            <div class="icon-circle">

                                <i class="fa-regular fa-share-nodes"></i>

                                <div class="work-iner-check">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <h4 class="work-inner-heading">Share your link with anyone</h4>

                    <p class="flow-text">Easily share your digital business link with anyone and send it

                        through email, a link, and more.</p>

                </div>

                <div class="work-flow col-xl-4 col-md-6 text-center" data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom" data-aos-duration="1400">

                    <div class="work-iner-box">

                        <div class="work-check">

                            <div class="icon-circle">

                                <i class="fa-regular fa-trophy"></i>

                                <div class="work-iner-check">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <h4 class="work-inner-heading">Get More Customers</h4>

                    <p class="flow-text">Your customers will find a way to reach you. Your customers & prospects book

                        an available time with you</p>

                </div>

            </div>

        </div>

    </div>

    <div class="pricing-main-sec" id="pricing">

        <div class="container">

            <div class="pricing-heading text-center pb-4">

                <span class="pricing-heading-2"> Choose Package</span>

                <h3 class="pricing-heading-1">Pricing</h3>

            </div>

            <div class="pricing-card">

                <div class="row">

                    @foreach ($getplanlist as $plan)
                        <div class="col-xl-4 col-md-6 mb-5" data-aos="zoom-in-down" data-aos-duration="1000">

                            <div class="card pricing-card-main h-100">

                                <div class="card-body pricing-card-body">

                                    <h5 class=" card-subtitle mb-4">{{ $plan->name }}</h5>

                                    <h6 class="card-title mb-2">{{ helper::currency_formate($plan->price, 1) }} /
                                        @if ($plan->plan_type == 1)
                                            @if ($plan->duration == 1)
                                                {{ trans('labels.one_month') }}
                                            @elseif($plan->duration == 2)
                                                {{ trans('labels.three_month') }}
                                            @elseif($plan->duration == 3)
                                                {{ trans('labels.six_month') }}
                                            @elseif($plan->duration == 4)
                                                {{ trans('labels.one_year') }}
                                            @elseif($plan->duration == 5)
                                                {{ trans('labels.lifetime') }}
                                            @endif
                                        @endif
                                        @if ($plan->plan_type == 2)
                                        {{ $plan->days }} {{$plan->days > 1 ?  trans('labels.days') :trans('labels.day') }}
                                        @endif

                                    </h6>

                                    <h3 class="pricing-card-heading text-center">For growing business that needs more
                                    </h3>

                                    <div class="pricing-group">

                                        <ul class="list-group">

                                            @php $features = explode('|', $plan->features); @endphp

                                            <li class="list-item d-flex"> <i class="fa-regular fa-circle-check"></i>
                                                <p class="ms-2">
                                                    {{ $plan->order_limit == -1 ? 'Unlimited' : $plan->order_limit }}
                                                    {{ $plan->order_limit > 1 || $plan->order_limit == -1 ? trans('labels.products') : trans('labels.product') }}</p>
                                            </li>

                                            <li class="list-item d-flex"> <i class="fa-regular fa-circle-check"></i>
                                                <p class="ms-2">
                                                    {{ $plan->appointment_limit == -1 ? 'Unlimited' : $plan->appointment_limit }}
                                                    {{ $plan->appointment_limit > 1 || $plan->appointment_limit == -1  ? trans('labels.orders') : trans('labels.order') }}
                                            </li>
                                            @php
                                                $themes = [];
                                                if ($plan->themes_id != '' && $plan->themes_id != null) {
                                                    $themes = explode(',', $plan->themes_id);
                                            } @endphp
                                            <li class="mb-2 d-flex"> <i
                                                    class="fa-regular fa-circle-check text-secondary "></i>
                                                <span class="mx-2">{{ count($themes) }}
                                                    {{ count($themes) > 1 ? trans('labels.themes') : trans('labels.theme') }}</span>
                                            </li>
                                            @if ($plan->custom_domain == 1)
                                                <li class="list-item d-flex">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                    <p class="ms-2">
                                                        {{ trans('labels.custom_domain') }}</p>
                                                </li>
                                            @endif
                                            @foreach ($features as $features)
                                                <li class="list-item d-flex"> <i
                                                        class="fa-regular fa-circle-check"></i>
                                                    <p class="ms-2">{{ $features }}</p>
                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                                <div class="card-footer border-0 bg-white">

                                    <a href="{{ url('admin/register') }}" type="button"
                                        class="btn btn-primary col-12 card-btn">Start Free Trial</a>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <div class="footer">

        <div class="container">

            <div class="d-md-flex justify-content-between align-items-end">

                <div class="footer-logo">

                    <img src="{{ helper::image_path(helper::appdata('')->logo) }}" alt="">

                </div>

                <div class="copy-right">

                    <p>{{ helper::appdata('')->copyright }}</p>

                </div>

            </div>

        </div>

    </div>

    {{-- <div id="back-to-top" class="show">

        <a class="btn text-primary">

            <i class="fa-solid fa-angle-up"></i>

        </a>

    </div> --}}

    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js') }}"></script>

    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/landing/js/aos.js') }}"></script>

    <script>
        AOS.init();
    </script>
{{-- 
    <script>
        $(window).on('scroll', function() {

            "use strict";

            if ($(window).scrollTop() > 300) {

                $('#back-to-top').addClass('show');

            } else {

                $('#back-to-top').removeClass('show');

            }

        });

        $('#back-to-top').on('click', function(e) {

            "use strict";

            e.preventDefault();

            $('html, body').animate({

                scrollTop: 0

            }, '300');

        });
    </script> --}}

</body>

</html>

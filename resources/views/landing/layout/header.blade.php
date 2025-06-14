{{-- <div class="header sticky-top">
    <div class="container">
        <div class="Navbar py-3">
            <div class="logo">
                <a href="{{ URL::to('/') }}">
                    <img src="{{ helper::image_path(helper::appdata('')->logo) }}" height="50" alt="">
                </a>
            </div>
            <div class="d-flex align-items-center gap-3">
                @if (helper::available_language('')->count() > 1)
                    @if (@helper::checkaddons('language'))
                        <div class="language-button-icon d-xl-none d-block">
                            <div class="p-0 lag-btn dropdown">
                                <a class="border-0 rounded-1 text-white" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-globe fs-4"></i>
                                </a>
                                <div class="dropdown-menu rounded-1 p-0 border-0 overflow-hidden bg-body-secondary shadow {{ session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdowns-ltr' }}"
                                    aria-labelledby="dropdownMenuLink">
                                    @foreach (helper::available_language('') as $languagelist)
                                        <li>
                                            <a class="dropdown-item text-dark d-flex align-items-center p-2 gap-2"
                                                href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                                <img src="{{ helper::image_path($languagelist->image) }}" alt=""
                                                    class="lag-img"> {{ $languagelist->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="togl-btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>

            <nav class="{{ session()->get('direction') == 2 ? 'menu-2' : 'menu' }}">
                <div
                    class="{{ session()->get('direction') == 2 ? 'deletebtn-button-header-rtl' : 'deletebtn-button-header' }}">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="menu-list-1152px-none mx-xxl-5 mx-2">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link text-white fw-500 active" href="{{ URL::to('/') }}" role="button">
                                {{ trans('landing.home') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link text-white fw-500" href="{{ URL::to('/#features') }}" role="button">
                                {{ trans('landing.features') }}
                            </a>
                        </li>
                        @if (@helper::checkaddons('subscription'))
                            <li class="nav-item dropdown px-3">
                                <a class="nav-link text-white fw-500" href="{{ URL::to('/#our-stores') }}"
                                    role="button">
                                    {{ trans('landing.our_stores') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown px-3">
                                <a class="nav-link text-white fw-500" href="{{ URL::to('/#pricing-plans') }}"
                                    role="button">
                                    {{ trans('landing.pricing_plan') }}
                                </a>
                            </li>
                        @endif
                        @if (@helper::checkaddons('blog'))
                            <li class="nav-item dropdown px-3">
                                <a class="nav-link text-white fw-500" href="{{ URL::to('/#blogs') }}" role="button">
                                    {{ trans('landing.blogs') }}
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link text-white fw-500" href="{{ URL::to('/#contact-us') }}" role="button">
                                {{ trans('landing.contact_us') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="header-btn d-flex align-items-center">
                    @if (helper::available_language('')->count() > 1)
                        @if (@helper::checkaddons('language'))
                            <div class="px-3 lag-btn  dropdown rounded-2">
                                <a class="p-0 border-0 rounded-1 language-drop" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-globe fs-5"></i>
                                </a>
                                <ul
                                    class="dropdown-menu mt-2 rounded-1 p-0 border-0 overflow-hidden bg-body-secondary shadow {{ session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdown-ltr' }}">
                                    @foreach (helper::available_language('') as $languagelist)
                                        <li>
                                            <a class="dropdown-item text-dark p-2 d-flex align-items-center gap-2"
                                                href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                                <img src="{{ helper::image_path($languagelist->image) }}"
                                                    alt="" class="lag-img">
                                                {{ $languagelist->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif
                    <a href="@if (env('Environment') == 'sendbox') {{ URL::to('/admin') }} @else {{ helper::appdata('')->vendor_register == 1 ? URL::to('/admin/register') : URL::to('/admin') }} @endif"
                        target="_blank" class="btn-secondary text-center w-100 fs-7 m-0 btn-class rounded-2">
                        {{ trans('landing.get_started') }}</a>
                </div>
            </nav>
        </div>
    </div>
</div> --}}
<nav class="navbar navbar-expand-lg header sticky-top">
    <div class="container">
        <div class="d-flex w-100 justify-content-between">
            <div class="d-flex gap-2 align-items-center">
                <div class="d-xl-none">
                    <button class="bg-transparent border-0 text-white p-1 m-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvaslanding" aria-controls="footersiderbar">
                        <i class="fa-solid fa-bars fs-3"></i>
                    </button>
                </div>
                <a class="navbar-brand" href="#">
                    <img src="{{ helper::image_path(helper::appdata('')->logo) }}" height="46" alt="">
                </a>
            </div>
            <div class="d-flex align-items-center gap-3">
                @if (helper::available_language('')->count() > 1)
                    @if (@helper::checkaddons('language'))
                        <div class="language-button-icon d-xl-none d-block">
                            <div class="p-0 lag-btn dropdown">
                                <a class="border-0 rounded-1 text-white" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ helper::image_path(session()->get('flag')) }}" alt=""
                                        class="rounded-circle" width="25px" height="25px">
                                </a>
                                <div class="dropdown-menu rounded-1 mt-2 p-0 border-0 overflow-hidden bg-body-secondary shadow {{ session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdown-ltr' }}"
                                    aria-labelledby="dropdownMenuLink">
                                    @foreach (helper::available_language('') as $languagelist)
                                        <li>
                                            <a class="dropdown-item text-dark d-flex align-items-center p-2 gap-2"
                                                href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                                <img src="{{ helper::image_path($languagelist->image) }}" alt=""
                                                    class="lag-img"> {{ $languagelist->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="d-none d-xl-flex">
                <div class="collapse w-100 justify-content-xl-between justify-content-end navbar-collapse">
                    <div class="d-none w-100 d-xl-block mx-auto">
                        <ul class="navbar-nav justify-content-center mb-2 mb-lg-0">
                            <li class="nav-item dropdown px-2">
                                <a class="nav-link text-white fs-15 fw-500 active" href="{{ URL::to('/') }}"
                                    role="button">
                                    {{ trans('landing.home') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown px-2">
                                <a class="nav-link text-white fs-15 fw-500" href="{{ URL::to('/#features') }}"
                                    role="button">
                                    {{ trans('landing.features') }}
                                </a>
                            </li>
                            @if (@helper::checkaddons('subscription'))
                                <li class="nav-item dropdown px-2">
                                    <a class="nav-link text-white fs-15 fw-500" href="{{ URL::to('/#our-stores') }}"
                                        role="button">
                                        {{ trans('landing.our_stores') }}
                                    </a>
                                </li>
                                <li class="nav-item dropdown px-2">
                                    <a class="nav-link text-white fs-15 fw-500" href="{{ URL::to('/#pricing-plans') }}"
                                        role="button">
                                        {{ trans('landing.pricing_plan') }}
                                    </a>
                                </li>
                            @endif
                            @if (@helper::checkaddons('blog'))
                                <li class="nav-item dropdown px-2">
                                    <a class="nav-link text-white fs-15 fw-500" href="{{ URL::to('/#blogs') }}"
                                        role="button">
                                        {{ trans('landing.blogs') }}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown px-2">
                                <a class="nav-link text-white fs-15 fw-500" href="{{ URL::to('/#contact-us') }}"
                                    role="button">
                                    {{ trans('landing.contact_us') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-none d-xl-flex col-auto align-items-center">
                        @if (helper::available_language('')->count() > 1)
                            @if (@helper::checkaddons('language'))
                                <div class="px-3 lag-btn  dropdown rounded-2">
                                    <a class="p-0 border-0 rounded-1 language-drop" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-globe fs-5"></i>
                                    </a>
                                    <ul
                                        class="dropdown-menu mt-2 rounded-1 p-0 border-0 overflow-hidden bg-body-secondary shadow {{ session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdown-ltr' }}">
                                        @foreach (helper::available_language('') as $languagelist)
                                            <li>
                                                <a class="dropdown-item text-dark p-2 d-flex align-items-center gap-2"
                                                    href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                                    <img src="{{ helper::image_path($languagelist->image) }}"
                                                        alt="" class="lag-img">
                                                    {{ $languagelist->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endif
                        <a href="@if (env('Environment') == 'sendbox') {{ URL::to('/admin') }} @else {{ helper::appdata('')->vendor_register == 1 ? URL::to('/admin/register') : URL::to('/admin') }} @endif"
                            target="_blank" class="btn-secondary text-center w-100 fs-7 m-0 btn-class rounded-2">
                            {{ trans('landing.get_started') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas {{ session()->get('direction') == 2 ? 'offcanvas-end' : 'offcanvas-start' }}" tabindex="-1" id="offcanvaslanding" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header d-flex justify-content-between align-items-center bg-black">
        <img src="{{ helper::image_path(helper::appdata('')->logo) }}" height="35px" alt="">
        <button type="button"
            class="text-white border-0 bg-transparent d-flex justify-content-center align-items-center m-0"
            data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fs-4 fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group list-add list-group-flush border-bottom">
            <li class="list-group-item px-0 py-3 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center text-dark" href="{{ URL::to('/') }}">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    {{ trans('landing.home') }}
                </a>
            </li>
            <li class="list-group-item px-0 py-3 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center text-dark" href="{{ URL::to('/#features') }}">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    {{ trans('landing.features') }}
                </a>
            </li>
            <li class="list-group-item px-0 py-3 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center text-dark" href="{{ URL::to('/#our-stores') }}">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    {{ trans('landing.our_stores') }}
                </a>
            </li>
            <li class="list-group-item px-0 py-3 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center text-dark" href="{{ URL::to('/#pricing-plans') }}">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    {{ trans('landing.pricing_plan') }}
                </a>
            </li>
            <li class="list-group-item px-0 py-3 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center text-dark" href="{{ URL::to('/#blogs') }}">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    {{ trans('landing.blogs') }}
                </a>
            </li>
            <li class="list-group-item px-0 py-3 {{ session()->get('direction') == 2 ? 'pe-3' : 'ps-3' }}">
                <a class="fs-7 fw-500 d-flex gap-2 align-items-center text-dark" href="{{ URL::to('/#contact-us') }}">
                    <i class="fa-solid fa-circle-dot fs-7"></i>
                    {{ trans('landing.contact_us') }}
                </a>
            </li>
        </ul>
    </div>
    <div class="offcanvas-footer bg-black p-2">
        <h5 class="fs-8 text-center text-white m-0">{{ helper::appdata('')->copyright }}</h5>
    </div>
</div>
@include('cookie-consent::index')

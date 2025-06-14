@extends('admin.layout.auth_default')
@section('content')
    <section>
        <div class="row align-items-center g-0 w-100 h-100vh position-relative">
            <div class="col-xl-7 col-lg-6 col-md-6 d-md-block d-none">
                <img src="{{ helper::image_path(helper::appdata('')->auth_image) }}" class="object h-100vh w-100"
                    alt="">
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="col-xl-8">
                        <div class="login-right-content h-100">
                            <div class="p-3">
                                <div class="text-primary d-flex justify-content-between">
                                    <div>
                                        <h2 class="fw-600 title-text text-color mb-2">{{ trans('labels.forgotpassword') }}
                                        </h2>
                                        <p class="text-color">{{ trans('labels.forgot_sub_title') }}</p>
                                    </div>
                                    <!-- FOR SMALL DEVICE TOP CATEGORIES -->
                                    @if (@helper::checkaddons('language'))
                                        <div class="lag-btn dropdown border-0 shadow-none login-lang">
                                            <button class="btn dropdown-toggle border-0 language-dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-globe fs-5 text-dark"></i>
                                            </button>
                                            <ul class="dropdown-menu rounded-1 p-0 rounded-3 overflow-hidden">
                                                @foreach (helper::listoflanguage() as $languagelist)
                                                    <li><a class="dropdown-item text-dark d-flex align-items-center text-left px-3 py-2"
                                                            href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                                            <img src="{{ helper::image_path($languagelist->image) }}"
                                                                alt="" class="img-fluid lag-img mx-1 w-25">
                                                            &nbsp;&nbsp;{{ $languagelist->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <form class="mt-4" method="POST" action="{{ URL::to('/admin/send_password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="form-label fs-7 text-color">{{ trans('labels.email') }}
                                            <span class="text-danger"> * </span></label>
                                        <input type="email" class="form-control extra-padding text-color" name="email"
                                            value="" id="email" placeholder="{{ trans('labels.email') }}"
                                            required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary padding w-100 my-3"
                                        @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.submit') }}</button>
                                    <p class="fs-6 text-center mt-1 text-color">{{ trans('labels.remember_password') }}
                                        <a href="{{ URL::to('/admin') }}"
                                            class="text-secondary text-decoration fw-semibold">{{ trans('labels.login') }}</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (env('Environment') == 'sendbox')
        <button class="btn btn-primary theme-label text-white" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">

            <i class="fa-solid fa-list text-white px-2"></i>
            Themes</button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header border-bottom">
                <h5 id="offcanvasRightLabel">Themes</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row px-3">
                    <a href="https://fashionhub.paponapps.co.in/theme-1" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-1.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 1</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-2" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-2.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 2</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-3" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-3.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 3</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-4" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-4.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 4</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-5" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-5.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 5</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-6" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-6.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 6</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-7" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-7.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 7</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-8" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-8.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 8</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-9" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-9.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 9</h5>
                        </div>
                    </a>

                    <a href="https://fashionhub.paponapps.co.in/theme-10" target="_blank"
                        class="card h-100 them-card-box overflow-hidden mb-3 rounded-5 border-0 p-0">
                        <img src="{{ helper::image_path('theme-10.png') }}" class="card-img-top them-name-images">
                        <div class="card-body">
                            <h5 class="card-title text-center">Theme - 10</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection

@extends('web.layout.default')

@section('contents')
    <div class="">
        <section class="my-5">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-xl-4 col-lg-6 col-12 m-auto login-form-box">
                                <div class="card overflow-hidden border-0 rounded-0 h-100">
                                    <h4 class="login-title">{{ trans('labels.login') }}</h4>
                                    <p class="my-2 text-muted login-subtitle">{{ trans('labels.login_page_title') }}</p>
                                    <div class="card-body p-0">
                                        <form class="my-3" method="POST"
                                            action="{{ URL::to($vendordata->slug . '/checklogin-normal') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email" class="form-label">{{ trans('labels.email') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control fs-7 input-h rounded-0" name="email"
                                                    placeholder="{{ trans('labels.email') }}" id="email" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="form-label">{{ trans('labels.password') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="password" class="form-control input-h rounded-0"
                                                    name="password" placeholder="{{ trans('labels.password') }}"
                                                    id="password" required>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <input type="hidden" class="form-control input-h" name="type"
                                                value="user">
                                            <div class="text-end">
                                                <a href="{{ URL::to($vendordata->slug . '/forgotpassword') }}"
                                                    class="text-dark fs-7 fw-500">
                                                    <i
                                                        class="fa-solid fa-lock-keyhole mx-2 fs-7"></i>{{ trans('labels.forgot_password') }}
                                                </a>
                                            </div>
                                            <button class="btn btn-fashion w-100 mt-4"
                                                type="submit">{{ trans('labels.login') }}</button>
                                        </form>

                                        @if (helper::appdata($vendordata->id)->google_mode == 1 || helper::appdata($vendordata->id)->facebook_mode == 1)
                                            <div class="or_section my-4">
                                                <div class="line"></div>
                                                <p class="text-center mx-3 fs-7">{{ trans('labels.or_login_with') }}</p>
                                                <div class="line"></div>
                                            </div>
                                        @endif
                                        @if (@helper::checkaddons('subscription'))
                                            @if (@helper::checkaddons('google_login'))
                                                @php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    $user = App\Models\User::where('id', $vendordata->id)->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $social_logins = 1;
                                                    } else {
                                                        $social_logins = @$checkplan->social_logins;
                                                    }
                                                @endphp
                                                @if ($social_logins == 1)
                                                    
                                                    <div class="social-share mt-0 pt-2 d-md-flex d-grid gap-2">
                                                        @if (helper::appdata($vendordata->id)->google_mode == 1)
                                                            <a href="{{ URL::to($vendordata->slug . '/login/google-user') }}"
                                                                class="btn btn-border social-share-icon w-100 rounded-0 d-flex align-items-center justify-content-center">
                                                                <img src="{{ url(env('ASSETPATHURL') . 'web-assets/images/other/Google__G__Logo.svg.png') }}"
                                                                    alt="" class="g-img">
                                                                <span class="px-2">{{ trans('labels.googletag') }}</span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @else
                                            @if (@helper::checkaddons('google_login'))
                                                <div class="login-form-bottom-icon d-flex">
                                                    @if (helper::appdata($vendordata->id)->google_mode == 1)
                                                        <a href="{{ URL::to($vendordata->slug . '/login/google-user') }}"
                                                            class="btn btn-danger w-50"><i
                                                                class="fa-brands fa-google mx-1 my-1 rounded-1"></i>
                                                            {{ trans('labels.googletag') }}</a>

                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                        @if (@helper::checkaddons('subscription'))
                                            @if (@helper::checkaddons('facebook_login'))
                                                @php
                                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                                        ->orderByDesc('id')
                                                        ->first();
                                                    $user = App\Models\User::where('id', $vendordata->id)->first();
                                                    if ($user->allow_without_subscription == 1) {
                                                        $social_logins = 1;
                                                    } else {
                                                        $social_logins = @$checkplan->social_logins;
                                                    }
                                                @endphp
                                                @if ($social_logins == 1)
                                                    
                                                    <div class="social-share mt-0 pt-2 d-md-flex d-grid gap-2">
                                                        @if (helper::appdata($vendordata->id)->facebook_mode == 1)
                                                            <a href="{{ URL::to($vendordata->slug . '/login/facebook-user') }}"
                                                                class="btn btn-border social-share-icon w-100 rounded-0 d-flex align-items-center justify-content-center">
                                                                <img src="{{ url(env('ASSETPATHURL') . 'web-assets/images/other/Facebook_Logo_(2019).png.webp') }}"
                                                                    alt="" class="g-img">
                                                                <span
                                                                    class="px-2">{{ trans('labels.facebook') }}</span></a>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @else
                                            @if (@helper::checkaddons('facebook_login'))
                                                <div class="login-form-bottom-icon d-flex">
                                                    @if (helper::appdata($vendordata->id)->facebook_mode == 1)
                                                        <a href="{{ URL::to($vendordata->slug . '/login/facebook-user') }}"
                                                            class="btn btn-facebook w-50"><i
                                                                class="fa-brands fa-facebook-f mx-1 my-1 rounded-1"></i>
                                                            {{ trans('labels.facebook') }}</a>

                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif


                                        @if (env('Environment') == 'sendbox')
                                            <div class="form-group mt-3 table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>User<br>user@gmail.com</td>
                                                            <td>123456</td>
                                                            <td><button class="btn btn-info btn-sm"
                                                                    onclick="AdminFill('user@gmail.com' , '123456')">Copy</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <p class="fs-7 text-center mt-3">{{ trans('labels.dont_have_account') }}
                                            <a href="{{ URL::to($vendordata->slug . '/register') }}"
                                                class="text-primary fw-semibold">{{ trans('labels.register') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                                <img src="{{helper::image_path(helper::appdata($vendordata->id)->auth_image)}}"
                                    class="w-100 object-fit-cover h-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        function AdminFill(email, password) {
            $('#email').val(email);
            $('#password').val(password);
        }
    </script>
@endsection

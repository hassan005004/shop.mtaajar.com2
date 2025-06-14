@extends('web.layout.default')

@section('contents')
    <section class="my-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-xl-4 col-lg-6 col-12 m-auto login-form-box">
                            <div class="card border-0 rounded-0 h-100">
                                <h4 class="login-title">{{ trans('labels.forgot_password') }}</h4>
                                <p class="my-2 text-muted login-subtitle">{{ trans('labels.forgotpassword_page_title') }}
                                </p>
                                <div class="card-body p-0">
                                    <form class="my-3" method="POST"
                                        action="{{ URL::to($vendordata->slug . '/send_userpassword') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="form-label">{{ trans('labels.email') }}<span
                                                    class="text-danger"> * </span></label>
                                            <input type="email" class="form-control input-h rounded-0" name="email"
                                                placeholder="{{ trans('labels.email') }}" id="email" required>
                                        </div>

                                        <button class="btn btn-fashion w-100 mt-4"
                                            @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else 
                                                type="submit" @endif>{{ trans('labels.submit') }}</button>
                                    </form>
                                    <p class="fs-7 text-center mt-3">{{ trans('labels.remember_password') }}
                                        <a href="{{ URL::to($vendordata->slug . '/login') }}"
                                            class="text-primary fw-semibold">{{ trans('labels.login') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                            <img src="{{ helper::image_path(helper::appdata($vendordata->id)->auth_image) }}"
                                class="object-fit-contente w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function AdminFill(email, password) {
            $('#email').val(email);
            $('#password').val(password);
        }
    </script>
@endsection

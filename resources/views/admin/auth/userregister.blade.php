@extends('admin.layout.auth_default')
@section('content')
<div class="wrapper">
    <section>
            <div class="container">
                <div class="d-flex justify-between align-items-center w-100 h-100vh">
                    <div class="row justify-content-around align-items-center g-0 w-100 py-5 rounded-4 box-shadow login-form-bg-color">
                        <div class="col-xl-4 col-lg-6 col-sm-8 col-auto">
                            <img src="{{ url(env('ASSETPATHURL') . '/admin-assets/images/login-form.png') }}" class="login-page-img" alt="">
                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-8 col-auto login-form-box">
                            <div class="card overflow-hidden border-0 rounded-0 p-2">
                                <div class="row">
                                    <h4 class="text-center">{{ trans('labels.login') }}</h4>
                                </div>
                                <div class="card-body pt-0 ">
                                    <form class="my-3" method="POST" action="{{ URL::to($slug.'/register_customer') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ trans('labels.name') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}" id="name"
                                                    placeholder="{{ trans('labels.name') }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="form-label">{{ trans('labels.email') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}" id="email"
                                                    placeholder="{{ trans('labels.email') }}" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basic-url" class="form-label">{{ trans('labels.personlized_link') }}<span
                                                    class="text-danger"> * </span></label>
                                                <div class="input-group">
                                                  <span class="input-group-text">{{ URL::to('/')}}</span>
                                                  <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug')}}" required>
                                                </div>
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    <a href="{{URL::to('/termscondition')}}" class="text-primary fw-semibold">Terms &amp; Conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    
                                        <button class="btn btn-primary w-100 mb-3"
                                            type="submit">{{ trans('labels.register') }}</button>
                                        <p class="fs-7 text-center mb-3">{{ trans('labels.already_have_an_account') }}
                                            <a href="{{ URL::to($slug.'/login') }}"
                                                class="text-primary fw-semibold">{{ trans('labels.login') }}</a>
                                        </p>
                                    </form>
                                </div>
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

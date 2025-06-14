@extends('web.layout.default')
@section('contents')
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}"><a class="text-dark fw-600" href="{{ URL::to(@$vendordata->slug . '/')}}">{{ trans('labels.home') }}</a></li>
                    <li class="text-muted {{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active" aria-current="page">{{ trans('labels.change_password') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <div class="row">
                @include('web.user.sidebar')
                <div class="col-lg-8 col-xxl-9">
                    <div class="card p-3">
                        <h5 class="text-dark m-0 mb-3 pb-3 border-bottom profile-title">{{ trans('labels.change_password') }}</h5>
                        <form id="deatilsForm" action="{{ URL::to($vendordata->slug . '/updatepassword/') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" class="label-style my-4">{{ trans('labels.current_password') }} : <span class="required text-danger">*</span></label>
                                    <input type="password" name="current_password" class="form-control input-h form-control-md rounded-0" placeholder="{{ trans('labels.current_password') }}" required="">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" class="label-style my-4">{{ trans('labels.new_password') }} : <span class="required text-danger">*</span></label>
                                    <input type="password" name="new_password" class="form-control input-h form-control-md rounded-0 mb-0" placeholder="{{ trans('labels.new_password') }}" required="">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" class="label-style my-4">{{ trans('labels.confirm_password') }} : <span class="required text-danger">*</span></label>
                                    <input type="password" name="confirm_password" class="form-control input-h form-control-md rounded-0 mb-0" placeholder="{{ trans('labels.confirm_password') }}" required="">
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-fashion mt-3">{{ trans('labels.save') }}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

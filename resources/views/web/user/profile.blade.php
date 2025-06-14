@extends('web.layout.default')
@section('contents')
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}"><a
                            class="text-dark fw-600" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.edit_profile') }}</li>
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
                        <h5 class="text-dark m-0 mb-3 border-bottom pb-3 profile-title">{{ trans('labels.edit_profile') }}</h5>
                        <form action="{{ URL::to($vendordata->slug . '/editprofile') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" value="{{ $getprofile->id }}" name="id">
                                    <label for="name" class="label-style my-2">{{ trans('labels.name') }} : <span
                                            class="required text-danger">*</span></label>
                                    <input type="text" class="form-control input-h rounded-0" name="name"
                                        placeholder="{{ trans('labels.name') }}" value="{{ $getprofile->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="label-style my-2">{{ trans('labels.email') }} : <span
                                            class="required text-danger">*</span></label>
                                    <input type="text" class="form-control input-h rounded-0" name="email"
                                        placeholder="{{ trans('labels.email') }}" value="{{ $getprofile->email }}"
                                        readonly>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="mobile" class="label-style my-2">{{ trans('labels.mobile') }} : <span
                                            class="required text-danger">*</span></label>
                                    <input type="text" class="form-control input-h rounded-0" name="mobile"
                                        placeholder="{{ trans('labels.mobile') }}" value="{{ $getprofile->mobile }}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }} : <span
                                                class="required text-danger">*</span></span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="label-style my-2">{{ trans('labels.image') }} : <span
                                                class="required text-danger">*</span></label>
                                        <input type="file" class="form-control rounded-0" name="image"
                                            placeholder="{{ trans('labels.image') }}" value="{{ $getprofile->image }}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }} : <span
                                                    class="required text-danger">*</span></span>
                                        @enderror

                                    </div>
                                    <img class="rounded-circle mb-2 object-fit-cover"
                                    src="{{ helper::image_path(Auth::user()->image) }}" alt="" width="70"
                                    height="70">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-fashion mt-3" type="submit">{{ trans('labels.submit') }}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

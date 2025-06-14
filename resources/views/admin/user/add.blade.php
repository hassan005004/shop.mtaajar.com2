@extends('admin.layout.default')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h5 class="text-capitalize fw-600 text-dark fs-4">{{trans('labels.add_new')}}</h5>

    <nav aria-label="breadcrumb">

        <ol class="breadcrumb m-0">

            <li class="breadcrumb-item"><a href="{{URL::to('admin/users')}}">{{trans('labels.users')}}</a></li>

            <li class="breadcrumb-item active {{session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''}}" aria-current="page">{{trans('labels.add')}}</li>

        </ol>

    </nav>

</div>

<div class="row">

    <div class="col-12">

        <div class="card border-0 box-shadow">

            <div class="card-body">

                @if(isset($id))
                    <form action="{{ URL::to('admin/clonevendor') }}" method="POST">
                    <input type="hidden" class="form-control" name="clone_vendor_id" value="{{ @$id }} " required>
                @else
                    <form action="{{ URL::to('admin/register_vendor') }}" method="POST">
                @endif 
                    @csrf
                    <div class="row">
                        @if (@helper::checkaddons('digital_product'))
                        <div class="form-group col-md-6">
                            <label for="store" class="form-label">{{ trans('labels.store_categories') }}<span class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value="">{{ trans('labels.select') }}</option>
                                @foreach ($stores as $store)
                                <option value="{{ $store->id }}" {{ old('store') == $store->id ? 'selected' : '' }}>{{ $store->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_type" class="form-label">{{ trans('labels.product_type') }}<span class="text-danger">
                                    * </span></label>
                            <select name="product_type" class="form-select" required>
                                <option value="">{{ trans('labels.select') }}</option>
                                <option value="1" {{ old('store') == 1 ? 'selected' : '' }}>
                                    {{ trans('labels.physical') }}
                                </option>
                                <option value="2" {{ old('store') == 2 ? 'selected' : '' }}>
                                    {{ trans('labels.digital') }}
                                </option>
                            </select>

                        </div>
                        @else
                        <div class="form-group col-md-12">
                            <label for="store" class="form-label">{{ trans('labels.store_categories') }}<span class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value="">{{ trans('labels.select') }}</option>
                                @foreach ($stores as $store)
                                <option value="{{ $store->id }}" {{ old('store') == $store->id ? 'selected' : '' }}>{{ $store->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label for="name" class="form-label">{{ trans('labels.name') }}<span class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="{{ trans('labels.name') }}" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="form-label">{{ trans('labels.email') }}<span class="text-danger"> *
                                </span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('labels.email') }}" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mobile" class="form-label">{{ trans('labels.mobile') }}<span class="text-danger">
                                    * </span></label>
                            <input type="text" class="form-control mobile-number" name="mobile" value="{{ old('mobile') }}" placeholder="{{ trans('labels.mobile') }}" required>
                            @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="form-label">{{ trans('labels.password') }}<span class="text-danger"> * </span></label>
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="{{ trans('labels.password') }}">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country" class="form-label">{{ trans('labels.country') }}<span class="text-danger"> * </span></label>
                            <select name="country" class="form-select" id="country" required>
                                <option value="">{{trans('labels.select')}}</option>
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="city" class="form-label">{{ trans('labels.city') }}<span class="text-danger"> * </span></label>
                            <select name="city" class="form-select" id="city" required>
                                <option value="">{{trans('labels.select')}}</option>
                            </select>

                        </div>
                        @if (@helper::checkaddons('unique_slug'))
                            <div class="form-group">
                                <label for="basic-url" class="form-label">{{ trans('labels.personlized_link') }}<span
                                        class="text-danger"> * </span></label>
                                @if (env('Environment') == 'sendbox')
                                    <span class="badge badge bg-danger ms-2 mb-0">{{ trans('labels.addon') }}</span>
                                @endif
                                <div class="input-group ">
                                    <span
                                        class="input-group-text col-5 col-lg-auto overflow-x-auto {{session()->get('direction') == 2 ? 'rounded-start-0 rounded-end' : ''}}">{{ URL::to('/') }}/</span>
                                    <input type="text" class="form-control {{session()->get('direction') == 2 ? 'rounded-end-0 rounded-start' : ''}}" id="slug" name="slug"
                                        value="{{ old('slug') }}" required>
                                </div>
                               
                            </div>
                        @endif
                    </div>

                    <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                        <a href="{{URL::to('admin/users')}}" class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                        <button @if (env('Environment')=='sendbox' ) type="button" onclick="myFunction()" @else type="submit" @endif class="btn btn-primary px-sm-4">{{ trans('labels.save') }}</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection
@section('scripts')
<script>
    var cityurl = "{{URL::to('admin/getcity')}}";
    var select = "{{trans('labels.select')}}";
    var cityid = "0";
    $('#name').on('blur', function() {
            "use strict";
            $('#slug').val($('#name').val().split(" ").join("-").toLowerCase());
        });
</script>

<script src="{{ url(env('ASSETPATHURL') . '/admin-assets/js/user.js') }}"></script>
@endsection
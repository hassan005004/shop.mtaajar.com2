@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.edit') }}</h5>
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb m-0">

                <li class="breadcrumb-item"><a href="{{ URL::to('admin/users') }}">{{ trans('labels.users') }}</a>

                </li>

                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.edit') }}</li>

            </ol>

        </nav>

    </div>
    
    <div class="card border-0 box-shadow">
        <div class="card-body">
            <form action="{{ URL::to('admin/users/update-' . $getuserdata->slug) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                @if (@helper::checkaddons('digital_product'))
                        <div class="form-group col-md-6">
                            <label for="store" class="form-label">{{ trans('labels.store_categories') }}<span
                                    class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value="">{{ trans('labels.select') }}</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}"
                                        {{ $store->id == $getuserdata->store_id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_type" class="form-label">{{ trans('labels.product_type') }}<span
                                    class="text-danger">
                                    * </span></label>
                            <select name="product_type" class="form-select" required>
                                <option value="">{{ trans('labels.select') }}</option>
                                <option value="1"
                                    {{ helper::appdata($getuserdata->id)->product_type == 1 ? 'selected' : '' }}>
                                    {{ trans('labels.physical') }}
                                </option>
                                <option value="2"
                                    {{ helper::appdata($getuserdata->id)->product_type == 2 ? 'selected' : '' }}>
                                    {{ trans('labels.digital') }}
                                </option>
                            </select>
                        </div>
                    @else
                        <div class="form-group col-md-12">
                            <label for="store" class="form-label">{{ trans('labels.store_categories') }}<span
                                    class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value="">{{ trans('labels.select') }}</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}"
                                        {{ $store->id == $getuserdata->store_id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-sm-6 form-group">
                        <input type="hidden" value="{{ $getuserdata->id }}" name="id">
                        <label class="form-label">{{ trans('labels.name') }}<span class="text-danger"> *
                            </span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $getuserdata->name }}"
                            placeholder="{{ trans('labels.name') }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="form-label">{{ trans('labels.email') }}<span class="text-danger"> *
                            </span></label>
                        <input type="email" class="form-control" name="email" value="{{ $getuserdata->email }}"
                            placeholder="{{ trans('labels.email') }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">{{ trans('labels.mobile') }}<span class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control mobile-number" name="mobile"
                                value="{{ $getuserdata->mobile }}" placeholder="{{ trans('labels.mobile') }}"
                                required>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{ trans('labels.image') }}</label>
                        <input type="file" class="form-control" name="profile">
                        <img class="rounded-circle mt-2" src="{{ helper::image_path($getuserdata->image) }}"
                            alt="" width="70" height="70">
                        @error('profile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country" class="form-label">{{ trans('labels.country') }}<span
                                class="text-danger"> * </span></label>
                        <select name="country" class="form-select" id="country" required>
                            <option value="">{{ trans('labels.select') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $country->id == $getuserdata->country_id ? 'selected' : '' }}>
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="city" class="form-label">{{ trans('labels.city') }}<span class="text-danger">
                                * </span></label>
                        <select name="city" class="form-select" id="city" required>
                            <option value="">{{ trans('labels.select') }}</option>
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
                                    value="{{ $getuserdata->slug }}" required>
                            </div>
                        </div>
                    @endif
                    <div class="col-sm-6">
                    @if (@helper::checkaddons('allow_without_subscription'))
                            <div class="form-group" id="plan">
                                <div class="d-flex">
                                    <input class="form-check-input mx-1" type="checkbox" name="plan_checkbox"
                                        id="plan_checkbox"> <label for="plan_checkbox"
                                        class="form-label">{{ trans('labels.assign_plan') }}</label>&nbsp;
                                    <label class="form-label"> ({{ trans('labels.current_plan') }}&nbsp;:&nbsp;
                                    </label>
                                    @php
                                        $plan = helper::plandetail(@$getuserdata->plan_id);
                                    @endphp
                                    <span class="fw-500"> {{ !empty($plan) ? $plan->name : '-' }}</span>)

                                </div>
                               
                                <select name="plan" id="selectplan" class="form-select" disabled required>
                                    <option value="">{{ trans('labels.select') }}</option>
                                    @foreach ($getplanlist as $plans)
                                        <option value="{{ $plans->id }}" {{ $plans->id == @$plan->id ? 'selected' : ''}}>
                                            {{ $plans->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <input class="form-check-input mx-1" type="checkbox" name="allow_store_subscription"
                                    id="allow_store_subscription"
                                    @if ($getuserdata->allow_without_subscription == '1') checked @endif><label class="form-check-label"
                                    for="allow_store_subscription">{{ trans('labels.allow_store_without_subscription') }}</label>

                            </div>
                        @endif
                        <div class="form-group">
                            <input class="form-check-input mx-1" type="checkbox" name="show_landing_page"
                                id="show_landing_page" @if ($getuserdata->available_on_landing == '1') checked @endif><label
                                class="form-check-label"
                                for="show_landing_page">{{ trans('labels.display_store_on_landing') }}</label>

                        </div>
                    </div>
                    <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                        <a href="{{ URL::to('admin/users') }}"
                            class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                        <button
                            @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                            class="btn btn-primary px-sm-4">{{ trans('labels.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="row">
    </div> --}}
@endsection
@section('scripts')
    <script>
        var cityurl = "{{ URL::to('admin/getcity') }}";
        var select = "{{ trans('labels.select') }}";
        var cityid = "{{ $getuserdata->city_id }}";
        $('#name').on('blur', function() {
            "use strict";
            $('#slug').val($('#name').val().split(" ").join("-").toLowerCase());
        });
    </script>
    <script src="{{ url(env('ASSETPATHURL') . '/admin-assets/js/user.js') }}"></script>
@endsection

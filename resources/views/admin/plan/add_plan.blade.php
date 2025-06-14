@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.add') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/plan') }}">{{ trans('labels.pricing_plan') }}</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="{{ URL::to('admin/plan/save_plan') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label">{{ trans('labels.name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="plan_name" value="{{ old('plan_name') }}"
                                    placeholder="{{ trans('labels.name') }}" required>
                                @error('plan_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="form-label">{{ trans('labels.amount') }}<span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control numbers_only" name="plan_price"
                                    value="{{ old('plan_price') }}" placeholder="{{ trans('labels.amount') }}" required>
                                @error('plan_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 form-group add-extra-class {{session()->get('direction') == 2 ? 'rtl' : ''}}">
                                <label class="form-label">{{ trans('labels.tax') }}</label>
                                <select name="plan_tax[]"  class="form-control selectpicker" multiple data-live-search="true">
                                    @if (!empty($gettaxlist))
                                    @foreach ($gettaxlist as $tax)
                                        <option value="{{ $tax->id }}"> {{ $tax->name }} </option>
                                    @endforeach
                                @endif
                                </select>
                                
                               
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.duration_type') }}</label>
                                    <select class="form-select type" name="type">
                                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>
                                            {{ trans('labels.fixed') }}
                                        </option>
                                        <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>
                                            {{ trans('labels.custom') }}
                                        </option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group 1 selecttype">
                                    <label class="form-label">{{ trans('labels.duration') }}<span class="text-danger"> *
                                        </span></label>
                                    <select class="form-select" name="plan_duration">
                                        <option value="1">{{ trans('labels.one_month') }}</option>
                                        <option value="2">{{ trans('labels.three_month') }}</option>
                                        <option value="3">{{ trans('labels.six_month') }}</option>
                                        <option value="4">{{ trans('labels.one_year') }}</option>
                                        <option value="5">{{ trans('labels.lifetime') }}</option>
                                    </select>
                                    @error('plan_duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group 2 selecttype">
                                    <label class="form-label">{{ trans('labels.days') }}<span class="text-danger">
                                            *
                                        </span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_days" value="" placeholder="{{ trans('labels.days') }}">
                                    @error('plan_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.service_limit') }}</label>
                                    <select class="form-select service_limit_type" name="service_limit_type">
                                        <option value="1" {{ old('service_limit_type') == '1' ? 'selected' : '' }}>
                                            {{ trans('labels.limited') }}
                                        </option>
                                        <option value="2" {{ old('service_limit_type') == '2' ? 'selected' : '' }}>
                                            {{ trans('labels.unlimited') }}
                                        </option>
                                    </select>
                                    @error('service_limit_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group 1 service-limit">
                                    <label class="form-label">{{ trans('labels.max_business') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_max_business"
                                        value="{{ old('plan_max_business') }}"
                                        placeholder="{{ trans('labels.max_business') }}">
                                    @error('plan_max_business')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.booking_limit') }}</label>
                                    <select class="form-select booking_limit_type" name="booking_limit_type">
                                        <option value="1" {{ old('booking_limit_type') == '1' ? 'selected' : '' }}>
                                            {{ trans('labels.limited') }}
                                        </option>
                                        <option value="2" {{ old('booking_limit_type') == '2' ? 'selected' : '' }}>
                                            {{ trans('labels.unlimited') }}
                                        </option>
                                    </select>
                                    @error('booking_limit_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group 1 booking-limit">
                                    <label class="form-label">{{ trans('labels.orders_limit') }}<span class="text-danger">
                                            *
                                        </span></label>
                                    <input type="text" class="form-control numbers_only" name="plan_appoinment_limit"
                                        value="{{ old('plan_appoinment_limit') }}"
                                        placeholder="{{ trans('labels.orders_limit') }}">
                                    @error('plan_appoinment_limit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group add-extra-class {{session()->get('direction') == 2 ? 'rtl' : ''}}">
                                    <label class="form-label">{{ trans('labels.vendors') }}</label>
                                    <select class="form-control selectpicker" name="vendors[]" multiple
                                        data-live-search="true">
                                        @if (!empty($vendors))
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}"
                                                    {{ old('vendor') == $vendor->id ? 'selected' : '' }}>
                                                    {{ $vendor->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                   
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label">{{ trans('labels.features') }}<span class="text-danger"> *
                                        </span></label>
                                    <button type="button" class="btn btn-primary btn-sm"
                                        tooltip="{{ trans('labels.add') }}" id="addfeature">
                                        <i class="fa-regular fa-plus"></i>
                                    </button>
                                    </div>
                                    
                                    <div id="repeater"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.description') }}<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="3" name="plan_description"
                                        placeholder="{{ trans('labels.description') }}" required>{{ old('plan_description') }}</textarea>
                                    @error('plan_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('coupon'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="coupons"
                                                    id="coupons">
                                                <label class="form-check-label"
                                                    for="coupons">{{ trans('labels.coupons') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('coupons')
                                                    <span class="text-danger" id="coupons">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('custom_domain'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="custom_domain"
                                                    id="custom_domain">
                                                <label class="form-check-label"
                                                    for="custom_domain">{{ trans('labels.custom_domain_available') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('custom_domain')
                                                    <span class="text-danger" id="custom_domain">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('blog'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="blogs"
                                                    id="blogs">
                                                <label class="form-check-label"
                                                    for="blogs">{{ trans('labels.blogs') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('blogs')
                                                    <span class="text-danger" id="blogs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    @if (@helper::checkaddons('google_login'))
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="google_login"
                                                    id="google_login">
                                                <label class="form-check-label"
                                                    for="google_login">{{ trans('labels.google_login') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                               
                                            </div>
                                        </div>
                                    @endif
                                    @if (@helper::checkaddons('facebook_login'))
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="facebook_login"
                                                    id="facebook_login">
                                                <label class="form-check-label"
                                                    for="facebook_login">{{ trans('labels.facebook_login') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                               
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('notification'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="sound_notification"
                                                    id="sound_notification">
                                                <label class="form-check-label"
                                                    for="sound_notification">{{ trans('labels.sound_notification') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('sound_notification')
                                                    <span class="text-danger"
                                                        id="sound_notification">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('whatsapp_message'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="whatsapp_message"
                                                    id="whatsapp_message">
                                                <label class="form-check-label"
                                                    for="whatsapp_message">{{ trans('labels.whatsapp_message') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('whatsapp_message')
                                                    <span class="text-danger"
                                                        id="whatsapp_message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('telegram_message'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="telegram_message"
                                                    id="telegram_message">
                                                <label class="form-check-label"
                                                    for="telegram_message">{{ trans('labels.telegram_message') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('telegram_message')
                                                    <span class="text-danger"
                                                        id="telegram_message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('vendor_app'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="vendor_app"
                                                    id="vendor_app">
                                                <label class="form-check-label"
                                                    for="vendor_app">{{ trans('labels.vendor_app_available') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('vendor_app')
                                                    <span class="text-danger" id="vendor_app">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('user_app'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="customer_app"
                                                    id="customer_app">
                                                <label class="form-check-label"
                                                    for="customer_app">{{ trans('labels.customer_app') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('customer_app')
                                                    <span class="text-danger" id="customer_app">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('pos'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="pos"
                                                    id="pos">
                                                <label class="form-check-label"
                                                    for="pos">{{ trans('labels.pos') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('pos')
                                                    <span class="text-danger" id="pos">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('pwa'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="pwa"
                                                    id="pwa">
                                                <label class="form-check-label"
                                                    for="pwa">{{ trans('labels.pwa') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('pwa')
                                                    <span class="text-danger" id="pwa">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('employee'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="employee"
                                                    id="employee">
                                                <label class="form-check-label"
                                                    for="employee">{{ trans('labels.role_management') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('employee')
                                                    <span class="text-danger" id="employee">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if (@helper::checkaddons('pixel'))
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" name="pixel"
                                                    id="pixel">
                                                <label class="form-check-label"
                                                    for="pixel">{{ trans('labels.pixel') }}</label>
                                                @if (env('Environment') == 'sendbox')
                                                    <span
                                                        class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                                @endif
                                                @error('pixel')
                                                    <span class="text-danger" id="pixel">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.themes') }}
                                        <span class="text-danger"> * </span> </label>
                                    @if (env('Environment') == 'sendbox')
                                        <span class="badge badge bg-danger ms-2">{{ trans('labels.addon') }}</span>
                                    @endif
                                    
                                    @php
                                        $checktheme = @helper::checkthemeaddons('theme_');
                                        $themes = array();
                                        foreach ($checktheme as $ttlthemes) {
                                            array_push($themes,str_replace("theme_","",$ttlthemes->unique_identifier));
                                        }
                                    @endphp
                                    <ul class="theme-selection row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-2">
                                        @foreach ($themes as $key => $item)
                                        <div class="col">
                                            <li class="m-0 w-100">
                                                <input type="checkbox" name="themecheckbox[]"
                                                    id="template{{ $item }}" value="{{ $item }}"
                                                    {{ $key == 0 ? 'checked' : '' }}>
                                                <label for="template{{ $item }}">
                                                    <img src="{{ helper::image_path('theme-' . $item . '.png') }}">
                                                </label>
                                                <div class="text-center d-flex justify-content-center mt-2">
                                                    <a class="btn btn-info hov btn-sm" id="{{ $item }}"
                                                        onclick="editimage(this.id)"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                </div>
                                            </li>
                                        </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                                <a href="{{ URL::to('admin/plan') }}"
                                    class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                                <button class="btn btn-primary px-sm-4"
                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- EDIT THEME IMAGE MODAL --}}
    <div class="modal modal-fade-transform" id="editModal" tabindex="-1" aria-labelledby="editModallable"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModallable">{{ trans('labels.image') }}<span class="text-danger"> *
                        </span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" {{ URL::to('admin/plan/updateimage') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="image_id" name="image_id">
                        <input type="file" name="theme_image" class="form-control" id="">
                        @error('theme_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif class="btn btn-secondary px-3">{{ trans('labels.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . '/admin-assets/js/plan.js') }}"></script>
@endsection

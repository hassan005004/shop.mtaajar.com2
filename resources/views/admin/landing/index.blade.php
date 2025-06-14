@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $user = App\Models\User::where('id', $vendor_id)->first();
@endphp
@section('content')
    <h5 class="text-capitalize fw-600 text-dark fs-4">
        {{ trans('labels.website_settings') }}</h5>
    <div class="row settings mt-3">
        <div class="col-xl-3 mb-3">
            <div class="card card-sticky-top border-0">
                <ul class="list-group list-options">
                    <a href="#themesettings" data-tab="themesettings"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center active"
                        aria-current="true">{{ trans('labels.theme_settings') }}
                        <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                    </a>
                    <a href="#contact_settings" data-tab="contact_settings"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true">{{ trans('labels.contact_settings') }}
                        <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                    </a>
                    <a href="#seo" data-tab="seo"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true">{{ trans('labels.seo') }}
                        <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                    </a>
                    @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                        @if (@helper::checkaddons('vendor_app'))
                            <a href="#app_section" data-tab="app_section"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.app_section') }}
                                <i
                                    class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                            </a>
                        @endif
                        <a href="#fun_fact" data-tab="fun_fact"
                            class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                            aria-current="true">{{ trans('labels.fun_fact') }}
                            <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                        </a>
                    @endif
                    @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                        @if (@helper::checkaddons('subscription'))
                            @if (@helper::checkaddons('user_app'))
                                @php
                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                        ->orderByDesc('id')
                                        ->first();

                                    if ($user->allow_without_subscription == 1) {
                                        $user_app = 1;
                                    } else {
                                        $user_app = @$checkplan->customer_app;
                                    }
                                @endphp
                                @if ($user_app == 1)
                                    <a href="#app_section" data-tab="app_section"
                                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                        aria-current="true">{{ trans('labels.app_section') }}
                                        <i
                                            class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                                    </a>
                                @endif
                            @endif
                        @else
                            @if (@helper::checkaddons('user_app'))
                                <a href="#app_section" data-tab="app_section"
                                    class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                    aria-current="true">{{ trans('labels.app_section') }}
                                    <i
                                        class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                                </a>
                            @endif
                        @endif
                        <a href="#footer_features" data-tab="footer_features"
                            class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                            aria-current="true">{{ trans('labels.footer_features') }}
                            <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                        </a>
                        @if (@helper::checkaddons('subscription'))
                            @if (@helper::checkaddons('pwa'))
                                @php
                                    $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                        ->orderByDesc('id')
                                        ->first();

                                    if ($user->allow_without_subscription == 1) {
                                        $pwa = 1;
                                    } else {
                                        $pwa = @$checkplan->pwa;
                                    }
                                @endphp
                                @if ($pwa == 1)
                                    <a href="#pwa" data-tab="pwa"
                                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                        aria-current="true">{{ trans('labels.pwa') }}
                                        <div class="d-flex gap-2 align-items-center">
                                            @if (env('Environment') == 'sendbox')
                                                <span class="badge badge bg-danger">{{ trans('labels.addon') }}</span>
                                            @endif
                                            <i
                                                class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        @else
                            @if (@helper::checkaddons('pwa'))
                                <a href="#pwa" data-tab="pwa"
                                    class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                    aria-current="true">{{ trans('labels.pwa') }}
                                    <div class="d-flex gap-2 align-items-center">
                                        @if (env('Environment') == 'sendbox')
                                            <span class="badge badge bg-danger">{{ trans('labels.addon') }}</span>
                                        @endif
                                        <i
                                            class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                                </a>
                            @endif
                        @endif
                        @if (@helper::checkaddons('age_verification'))
                            <a href="#age_verification" data-tab="age_verification"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.age_verification') }}
                                <div class="d-flex gap-2 align-items-center">
                                    @if (env('Environment') == 'sendbox')
                                        <span class="badge badge bg-danger">{{ trans('labels.addon') }}</span>
                                    @endif
                                    <i
                                        class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                                </div>
                            </a>
                        @endif
                        @if (@helper::checkaddons('vendor_tip'))
                            <a href="#tips_settings" data-tab="tips_settings"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.tips_settings') }}
                                <div class="d-flex gap-2 align-items-center">
                                    @if (env('Environment') == 'sendbox')
                                        <span class="badge badge bg-danger">{{ trans('labels.addon') }}</span>
                                    @endif
                                    <i
                                        class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                                </div>
                            </a>
                        @endif

                    @endif
                    <a href="#social_links" data-tab="social_links"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true">{{ trans('labels.social_link') }}
                        <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                    </a>
                    <a href="#other" data-tab="other"
                        class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                        aria-current="true">{{ trans('labels.other') }}
                        <i class="fa-regular fa-angle-{{ session()->get('direction') == '2' ? 'left' : 'right' }}"></i>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-xl-9">
            <div id="settingmenuContent">
                <div id="themesettings">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card border-0 box-shadow">
                                <div class="card-header d-flex text-white align-items-center gap-2 p-3 bg-secondary">
                                    <h5 class="text-capitalize fw-600">
                                        {{ trans('labels.theme_settings') }}</h5>
                                    @if (env('Environment') == 'sendbox')
                                        <span class="badge badge bg-danger">{{ trans('labels.addon') }}</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ URL::to('admin/themeupdate') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                <div class="form-group col-sm-12">
                                                    <label class="form-label">{{ trans('labels.landing_page') }}
                                                        {{ trans('labels.title') }}<span class="text-danger"> *
                                                        </span></label>
                                                    <input type="text" class="form-control"
                                                        name="landing_website_title"
                                                        value="{{ @$settingdata->landing_website_title }}"
                                                        placeholder="{{ trans('labels.landing_page') }} {{ trans('labels.title') }}">
                                                    @error('landing_website_title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label class="form-label">{{ trans('labels.web_title') }}<span
                                                            class="text-danger"> * </span></label>
                                                    <input type="text" class="form-control" name="web_title"
                                                        value="{{ @$settingdata->web_title }}"
                                                        placeholder="{{ trans('labels.web_title') }}" required>
                                                    @error('web_title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{ trans('labels.copyright') }}<span
                                                            class="text-danger"> * </span></label>
                                                    <input type="text" class="form-control" name="copyright"
                                                        value="{{ @$settingdata->copyright }}"
                                                        placeholder="{{ trans('labels.copyright') }}" required>
                                                    @error('copyright')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @endif
                                            @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">{{ trans('labels.primary_color') }}</label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_primary_color"
                                                        value="{{ $landingdata->primary_color }}">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label
                                                        class="form-label">{{ trans('labels.secondary_color') }}</label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_secondary_color"
                                                        value="{{ $landingdata->secondary_color }}">
                                                </div>
                                            @else
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">{{ trans('labels.primary_color') }}</label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_primary_color"
                                                        value="{{ $settingdata->primary_color }}">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label
                                                        class="form-label">{{ trans('labels.secondary_color') }}</label>
                                                    <input type="color"
                                                        class="form-control form-control-color w-100 border-0"
                                                        name="landing_secondary_color"
                                                        value="{{ $settingdata->secondary_color }}">
                                                </div>
                                            @endif

                                            <div class="form-group col-sm-6">
                                                <label class="form-label">{{ trans('labels.logo') }} </label>
                                                <input type="file" class="form-control" name="logo">
                                                @error('logo')
                                                    <small class="text-danger">{{ $message }}</small> <br>
                                                @enderror
                                                <img class="img-fluid rounded mt-1 object-fit-contain img-height"
                                                    src="{{ helper::image_path(@$settingdata->logo) }}" alt="">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="form-label">{{ trans('labels.favicon') }} </label>
                                                <input type="file" class="form-control" name="favicon">
                                                @error('favicon')
                                                    <small class="text-danger">{{ $message }}</small> <br>
                                                @enderror
                                                <img class="img-fluid rounded img-height  mt-1 object-fit-contain"
                                                    src="{{ helper::image_path(@$settingdata->favicon) }}"
                                                    alt="">
                                            </div>
                                            @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label"
                                                        for="">{{ trans('labels.landing_page') }} </label>
                                                    <input id="landing_page-switch" type="checkbox"
                                                        class="checkbox-switch" name="landing_page" value="1"
                                                        {{ $settingdata->landing_page == 1 ? 'checked' : '' }}>
                                                    <label for="landing_page-switch" class="switch">
                                                        <span
                                                            class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span
                                                                class="switch__circle-inner"></span></span>
                                                        <span
                                                            class="switch__left  {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">{{ trans('labels.off') }}</span>
                                                        <span
                                                            class="switch__right {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">{{ trans('labels.on') }}</span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                                                @php
                                                    $checktheme = @helper::checkthemeaddons('theme_');
                                                    $themes = [];
                                                    if ($user->allow_without_subscription == 1) {
                                                        foreach ($checktheme as $ttlthemes) {
                                                            array_push(
                                                                $themes,
                                                                str_replace(
                                                                    'theme_',
                                                                    '',
                                                                    $ttlthemes->unique_identifier,
                                                                ),
                                                            );
                                                        }
                                                    } else {
                                                        if (@helper::checkaddons('subscription')) {
                                                            if (empty($theme)) {
                                                                $themes = [1];
                                                            } else {
                                                                $themes = explode('|', @$theme->themes_id);
                                                            }
                                                        } else {
                                                            foreach ($checktheme as $ttlthemes) {
                                                                array_push(
                                                                    $themes,
                                                                    str_replace(
                                                                        'theme_',
                                                                        '',
                                                                        $ttlthemes->unique_identifier,
                                                                    ),
                                                                );
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.template') }}
                                                            <span class="text-danger"> * </span> </label>
                                                        <ul
                                                            class="theme-selection row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-2">
                                                            @foreach ($themes as $item)
                                                                <div class="col">
                                                                    <li class="m-0 w-100">
                                                                        <input type="radio" name="template"
                                                                            id="template{{ $item }}"
                                                                            value="{{ $item }}"
                                                                            {{ @$settingdata->theme == $item ? 'checked' : '' }}>
                                                                        <label for="template{{ $item }}">
                                                                            <img
                                                                                src="{{ helper::image_path('theme-' . $item . '.png') }}">
                                                                        </label>
                                                                    </li>
                                                                </div>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div
                                            class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                            <button
                                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contact_settings">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card border-0 box-shadow">
                                <div class="card-header p-3 bg-secondary">
                                    <h5 class="text-capitalize fw-600 "> {{ trans('labels.contact_settings') }}</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <form action="{{ URL::to('admin/contact_settings/update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">{{ trans('labels.contact_email') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="email" class="form-control" name="landing_email"
                                                    value="{{ @$settingdata->email }}"
                                                    placeholder="{{ trans('labels.contact_email') }}" required>
                                                @error('landing_email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">{{ trans('labels.contact_mobile') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control mobile-number"
                                                    name="landing_mobile" value="{{ @$settingdata->contact }}"
                                                    placeholder="{{ trans('labels.contact_mobile') }}" required>
                                                @error('contact_mobile')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{ trans('labels.address') }}<span
                                                        class="text-danger"> * </span></label>
                                                <textarea class="form-control" name="landing_address" rows="3" placeholder="{{ trans('labels.address') }}">{{ @$settingdata->address }}</textarea>
                                                @error('address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div
                                            class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                            <button
                                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="seo">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card border-0 box-shadow">
                                <div class="card-header p-3 bg-secondary">
                                    <h5 class="text-capitalize fw-600">{{ trans('labels.seo') }}</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ URL::to('admin/seo_update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">{{ trans('labels.meta_title') }}<span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="meta_title"
                                                    value="{{ @$settingdata->meta_title }}"
                                                    placeholder="{{ trans('labels.meta_title') }}" required>
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{ trans('labels.meta_description') }}<span
                                                        class="text-danger"> * </span></label>
                                                <textarea class="form-control" name="meta_description" rows="3"
                                                    placeholder="{{ trans('labels.meta_description') }}" required>{{ @$settingdata->meta_description }}</textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{ trans('labels.og_image') }} <span
                                                        class="text-danger"> * </span></label>
                                                <input type="file" class="form-control" name="og_image">
                                                @error('og_image')
                                                    <span class="text-danger">{{ $message }}</span> <br>
                                                @enderror
                                                <img class="img-fluid rounded img-height mt-1"
                                                    src="{{ helper::image_Path(@$settingdata->og_image) }}"
                                                    alt="">
                                            </div>
                                            <div
                                                class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                <button
                                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                                    class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                    @if (@helper::checkaddons('vendor_app'))
                        @include('admin.mobile_app.app_section')
                    @endif
                    <div id="fun_fact">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-header p-3 bg-secondary">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="text-capitalize fw-600">
                                                    {{ trans('labels.fun_fact') }}
                                                    <span>
                                                        <label class="col-auto col-form-label" for="">
                                                            <span class="" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Ex. <i class='fa-solid fa-truck-fast'></i> Visit https://fontawesome.com/ for more info">
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </span>
                                                        </label>
                                                    </span>
                                                </h5>
                                                @if (!empty($funfacts))
                                                    @if (count($funfacts) > 0)
                                                        <span class="col-auto">
                                                            <button class="btn btn-primary" type="button"
                                                                onclick="add_funfact('{{ trans('labels.icon') }}','{{ trans('labels.title') }}','{{ trans('labels.sub_title') }}')">
                                                                <i class="fa-sharp fa-solid fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <form action="{{ URL::to('admin/fun_fact/update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">

                                                    @forelse ($funfacts as $key => $facts)
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <input type="hidden" name="edit_icon_key[]"
                                                                    value="{{ $facts->id }}">
                                                                <div class="col-md-4 form-group">
                                                                    <div class="input-group">
                                                                        <input type="text"
                                                                            class="form-control feature_required  {{ session()->get('direction') == 2 ? 'input-group-rtl' : '' }}"
                                                                            onkeyup="show_funfact_icon(this)"
                                                                            name="edi_funfact_icon[{{ $facts->id }}]"
                                                                            placeholder="{{ trans('labels.icon') }}"
                                                                            value="{{ $facts->icon }}" required>
                                                                        <p
                                                                            class="input-group-text fiex-width {{ session()->get('direction') == 2 ? 'input-group-icon-rtl' : '' }}">
                                                                            {!! $facts->icon !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <input type="text" class="form-control"
                                                                        name="edi_funfact_title[{{ $facts->id }}]"
                                                                        placeholder="{{ trans('labels.title') }}"
                                                                        value="{{ $facts->title }}" required>
                                                                </div>
                                                                <div class="col-md-4 d-flex gap-2 form-group">
                                                                    <input type="text" class="form-control"
                                                                        name="edi_funfact_subtitle[{{ $facts->id }}]"
                                                                        placeholder="{{ trans('labels.sub_title') }}"
                                                                        value="{{ $facts->description }}" required>
                                                                    <button class="btn btn-danger" type="button"
                                                                        tooltip="{{ trans('labels.delete') }}"
                                                                        onclick="statusupdate('{{ URL::to('admin/fun_fact/delete-' . $facts->id) }}')">
                                                                        <i class="fa fa-trash"></i> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-md-3 form-group">
                                                                    <div class="input-group">
                                                                        <input type="text"
                                                                            class="form-control feature_required"
                                                                            onkeyup="show_funfact_icon(this)"
                                                                            name="funfact_icon[]"
                                                                            placeholder="{{ trans('labels.icon') }}"
                                                                            required>
                                                                        <p class="input-group-text"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text"
                                                                        class="form-control feature_required"
                                                                        name="funfact_title[]"
                                                                        placeholder="{{ trans('labels.title') }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-5 form-group">
                                                                    <input type="text"
                                                                        class="form-control feature_required"
                                                                        name="funfact_subtitle[]"
                                                                        placeholder="{{ trans('labels.sub_title') }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-1 form-group">
                                                                    <button class="btn btn-info" type="button"
                                                                        tooltip="{{ trans('labels.add') }}"
                                                                        onclick="add_funfact('{{ trans('labels.icon') }}','{{ trans('labels.title') }}','{{ trans('labels.sub_title') }}')">
                                                                        <i class="fa-sharp fa-solid fa-plus"></i> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                    <span class="extra_footer_features"></span>
                                                    <div
                                                        class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                        <button
                                                            class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                            @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                    @if (@helper::checkaddons('subscription'))
                        @if (@helper::checkaddons('user_app'))
                            @php
                                $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                    ->orderByDesc('id')
                                    ->first();

                                if (@$user->allow_without_subscription == 1) {
                                    $user_app = 1;
                                } else {
                                    $user_app = @$checkplan->customer_app;
                                }
                            @endphp
                            @if ($user_app == 1)
                                @include('admin.mobile_app.app_section')
                            @endif
                        @endif
                    @else
                        @if (@helper::checkaddons('user_app'))
                            @include('admin.mobile_app.app_section')
                        @endif
                    @endif
                    <div id="footer_features">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-header p-3 bg-secondary">
                                            <div class="d-flex align-items-center  justify-content-between">
                                                <h5 class="text-capitalize fw-600">
                                                    {{ trans('labels.footer_features') }} <span>
                                                        <label class="col-auto col-form-label" for="">
                                                            <span class="" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Ex. <i class='fa-solid fa-truck-fast'></i> Visit https://fontawesome.com/ for more info">
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </span>
                                                        </label>
                                                    </span>
                                                </h5>
                                                <div class="row justify-content-between">
                                                    <span class="col-auto">
                                                        <button class="btn btn-primary" type="button"
                                                            onclick="add_features('{{ trans('labels.icon') }}','{{ trans('labels.title') }}','{{ trans('labels.description') }}')">
                                                            <i class="fa-sharp fa-solid fa-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body  pb-0">
                                            <form action="{{ URL::to('admin/footer_features/update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12">

                                                    @foreach ($getfooterfeatures as $key => $features)
                                                        <div class="row">
                                                            <input type="hidden" name="edit_icon_key[]"
                                                                value="{{ $features->id }}">
                                                            <div class="col-md-4 form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        class="form-control feature_required  {{ session()->get('direction') == 2 ? 'input-group-rtl' : '' }}"
                                                                        onkeyup="show_feature_icon(this)"
                                                                        name="edi_feature_icon[{{ $features->id }}]"
                                                                        placeholder="{{ trans('labels.icon') }}"
                                                                        value="{{ $features->icon }}" required>
                                                                    <p
                                                                        class="input-group-text {{ session()->get('direction') == 2 ? 'input-group-icon-rtl' : '' }}">
                                                                        {!! $features->icon !!}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 form-group">
                                                                <input type="text" class="form-control"
                                                                    name="edi_feature_title[{{ $features->id }}]"
                                                                    placeholder="{{ trans('labels.title') }}"
                                                                    value="{{ $features->title }}" required>
                                                            </div>
                                                            <div class="col-md-4 form-group d-flex gap-2">
                                                                <input type="text" class="form-control"
                                                                    name="edi_feature_description[{{ $features->id }}]"
                                                                    placeholder="{{ trans('labels.description') }}"
                                                                    value="{{ $features->description }}" required>
                                                                <button class="btn btn-danger" type="button"
                                                                    tooltip="{{ trans('labels.delete') }}"
                                                                    onclick="statusupdate('{{ URL::to('admin/settings/delete-feature-' . $features->id) }}')">
                                                                    <i class="fa fa-trash"></i> </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <span class="extra_footer_features"></span>
                                                    <div
                                                        class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                        <button
                                                            class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                            @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (@helper::checkaddons('subscription'))
                        @if (@helper::checkaddons('pwa'))
                            @php
                                $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                    ->orderByDesc('id')
                                    ->first();

                                if ($user->allow_without_subscription == 1) {
                                    $pwa = 1;
                                } else {
                                    $pwa = @$checkplan->pwa;
                                }
                            @endphp
                            @if ($pwa == 1)
                                @include('admin.pwa.pwa_settings')
                            @endif
                        @endif
                    @else
                        @if (@helper::checkaddons('pwa'))
                            @include('admin.pwa.pwa_settings')
                        @endif
                    @endif

                    @if (@helper::checkaddons('age_verification'))
                        @include('admin.age_verification.index')
                    @endif
                    @if (@helper::checkaddons('vendor_tip'))
                        @include('admin.tips_settings.tips_settings')
                    @endif
                @endif
                <div id="social_links">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-header p-3 bg-secondary">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="text-capitalize fw-600">
                                                {{ trans('labels.social_link') }} <span class=""
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Ex. <i class='fa-solid fa-truck-fast'></i> Visit https://fontawesome.com/ for more info">
                                                    <i class="fa-solid fa-circle-info"></i> </span></h5>
                                            <button class="btn btn-primary" type="button"
                                                tooltip="{{ trans('labels.add') }}"
                                                onclick="add_social_links('{{ trans('labels.icon') }}','{{ trans('labels.link') }}')">
                                                <i class="fa-sharp fa-solid fa-plus"></i> </button>
                                        </div>
                                    </div>
                                    <div class="card-body  pb-0">
                                        <form action="{{ URL::to('admin/social_links/update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                @foreach ($getsociallinks as $key => $links)
                                                    <input type="hidden" name="edit_icon_key[]"
                                                        value="{{ $links->id }}">
                                                    <div class="col-md-6 form-group">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control soaciallink_required  {{ session()->get('direction') == 2 ? 'input-group-rtl' : '' }}"
                                                                onkeyup="show_feature_icon(this)"
                                                                name="edi_sociallink_icon[{{ $links->id }}]"
                                                                placeholder="{{ trans('labels.icon') }}"
                                                                value="{{ $links->icon }}" required>
                                                            <p
                                                                class="input-group-text fiex-width {{ session()->get('direction') == 2 ? 'input-group-icon-rtl' : '' }}">
                                                                {!! $links->icon !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-flex gap-2 align-items-center form-group">
                                                        <input type="text" class="form-control"
                                                            name="edi_sociallink_link[{{ $links->id }}]"
                                                            placeholder="{{ trans('labels.link') }}"
                                                            value="{{ $links->link }}" required>
                                                        <button class="btn btn-danger" type="button"
                                                            tooltip="{{ trans('labels.delete') }}"
                                                            onclick="statusupdate('{{ URL::to('admin/settings/delete-sociallinks-' . $links->id) }}')">
                                                            <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                @endforeach

                                                <span class="extra_social_links"></span>
                                                <div
                                                    class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                    <button
                                                        class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                        @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="other">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-header p-3 bg-secondary">
                                        <h5 class="text-capitalize fw-600">
                                            {{ trans('labels.other') }}
                                        </h5>
                                    </div>
                                    <div class="card-body pb-0">
                                        <form action="{{ URL::to('admin/other/update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.google_review_url') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ trans('labels.google_review_url') }}"
                                                            name="google_review_url"
                                                            value="{{ $settingdata->google_review }}">
                                                        @error('google_review_url')
                                                            <small class="text-danger">{{ $message }}</small> <br>
                                                        @enderror
                                                    </div>

                                                    @if (@helper::checkaddons('product_reviews'))
                                                        <div class="col-md-3 form-group">
                                                            <label class="form-label"
                                                                for="">{{ trans('labels.product_ratting_switch') }}
                                                            </label>
                                                            <div class="text-center">
                                                                <input id="product_ratting_switch" type="checkbox"
                                                                    class="checkbox-switch" name="product_ratting_switch"
                                                                    value="1"
                                                                    {{ $settingdata->product_ratting_switch == 1 ? 'checked' : '' }}>
                                                                <label for="product_ratting_switch" class="switch">
                                                                    <span
                                                                        class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span
                                                                            class="switch__circle-inner"></span></span>
                                                                    <span
                                                                        class="switch__left {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">{{ trans('labels.off') }}</span>
                                                                    <span
                                                                        class="switch__right {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">{{ trans('labels.on') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-3 form-group">
                                                        <label class="form-label"
                                                            for="">{{ trans('labels.online_order') }}
                                                        </label>
                                                        <div class="text-center">
                                                            <input id="online_order_switch" type="checkbox"
                                                                class="checkbox-switch" name="online_order_switch"
                                                                value="1"
                                                                {{ $settingdata->online_order == 1 ? 'checked' : '' }}>
                                                            <label for="online_order_switch" class="switch">
                                                                <span
                                                                    class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span
                                                                        class="switch__circle-inner"></span></span>
                                                                <span
                                                                    class="switch__left {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">{{ trans('labels.off') }}</span>
                                                                <span
                                                                    class="switch__right {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">{{ trans('labels.on') }}</span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.landing_page_cover_image') }}
                                                        </label>
                                                        <input type="file" class="form-control"
                                                            name="landin_page_cover_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path($settingdata->cover_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ trans('labels.footer_description') }}<span
                                                                class="text-danger"> * </span></label>
                                                        <textarea class="form-control" name="footer_description" rows="3"
                                                            placeholder="{{ trans('labels.footer_description') }}" required>{{ @$settingdata->footer_description }}</textarea>
                                                        @error('footer_description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label
                                                            class="form-label">{{ trans('labels.viewallpage_banner') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="viewallpage_banner">
                                                        @error('viewallpage_banner')
                                                            <small class="text-danger">{{ $message }}</small> <br>
                                                        @enderror
                                                        @if (!empty(@$settingdata->viewallpage_banner))
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <img class="img-fluid rounded hw-70 mt-1"
                                                                    src="{{ helper::image_path(@$settingdata->viewallpage_banner) }}"
                                                                    alt="">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                                    onclick="deletedata('{{ URL::to('admin/settings/delete-banner') }}')">
                                                                    <i class="fa-regular fa-trash"></i> </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.subscribe_image') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="subscribe_image">


                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->subscribe_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label
                                                            class="form-label">{{ trans('labels.contact_image') }}</label>
                                                        <input type="file" class="form-control" name="contact_image">
                                                        @error('contact_image')
                                                            <small class="text-danger">{{ $message }}</small> <br>
                                                        @enderror
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                                            src="{{ helper::image_path(@$settingdata->contact_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.order_detail_image') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="order_detail_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->order_detail_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label
                                                            class="form-label">{{ trans('labels.web_auth_image') }}</label>
                                                        <input type="file" class="form-control" name="auth_image">
                                                        @error('auth_image')
                                                            <small class="text-danger">{{ $message }}</small> <br>
                                                        @enderror
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                                            src="{{ helper::image_path(@$settingdata->auth_image) }}"
                                                            alt="">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.order_success_image') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="order_success_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->order_success_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.no_data_image') }}</label>
                                                        <input type="file" class="form-control" name="no_data_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->no_data_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.referral_image') }}</label>
                                                        <input type="file" class="form-control" name="referral_image">

                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->referral_image) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                                @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.landing_home_banner') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="landing_home_banner">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$landingdata->landing_home_banner) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.subscribe_image') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="subscribe_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$landingdata->subscribe_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="form-label">{{ trans('labels.faq_image') }}</label>
                                                        <input type="file" class="form-control" name="faq_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$landingdata->faq_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.maintenance_image') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="maintenance_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->maintenance_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.store_unavailable_image') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="store_unavailable_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-cover"
                                                            src="{{ helper::image_path(@$settingdata->store_unavailable_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label
                                                            class="form-label">{{ trans('labels.admin_auth_image') }}</label>
                                                        <input type="file" class="form-control" name="auth_image">
                                                        <img class="img-fluid rounded hw-70 mt-1 object-fit-contain"
                                                            src="{{ helper::image_path(@$settingdata->auth_image) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                                <div
                                                    class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                                    <button
                                                        class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_basic_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                        @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('cname_text');
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/funfact.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/settings.js') }}"></script>
@endsection

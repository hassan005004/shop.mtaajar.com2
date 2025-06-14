@extends('admin.layout.default')
@section('content')
    @php
        if (request()->is('admin/sliders*')) {
            $section = 0;
            $title = trans('labels.sliders');
            $url = URL::to('admin/sliders');
        } elseif (request()->is('admin/bannersection-1*')) {
            $section = 1;
            $title = trans('labels.section-1');
            $url = URL::to('admin/bannersection-1');
        } elseif (request()->is('admin/bannersection-2*')) {
            $section = 2;
            $title = trans('labels.section-2');
            $url = URL::to('admin/bannersection-2');
        } else {
            $section = 3;
            $title = trans('labels.section-3');
            $url = URL::to('admin/bannersection-3');
        }
    @endphp
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.add_new') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="{{ $url . '/save' }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="{{ $section }}">

                        <div class="row">
                            @if ($section == 0)
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">{{ trans('labels.title') }}</label>
                                   <input type="text" class="form-control" value="{{old('banner_title')}}" name="banner_title" placeholder="{{ trans('labels.title') }}" >
                                    @error('banner_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">{{ trans('labels.sub_title') }}</label>
                                   <input type="text" class="form-control" value="{{old('banner_subtitle')}}" name="banner_subtitle" placeholder="{{ trans('labels.sub_title') }}">
                                    @error('banner_subtitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">{{ trans('labels.description') }}</label>
                                    <textarea rows="5" class="form-control" value="{{old('banner_description')}}" name="banner_description" placeholder="{{ trans('labels.description') }}" ></textarea>
                                    @error('banner_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">{{ trans('labels.link_text') }}</label>
                                   <input type="text" class="form-control" value="{{old('banner_link_text')}}" name="banner_link_text" placeholder="{{ trans('labels.link_text') }}" >
                                    @error('banner_link_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-sm-6 form-group">
                                <label class="form-label">{{ trans('labels.type') }}</label>
                                <select class="form-select type" name="banner_info">
                                    <option value="0">{{ trans('labels.select') }} </option>
                                    <option value="1" {{ old('banner_info') == '1' ? 'selected' : '' }}>
                                        {{ trans('labels.category') }}</option>
                                    <option value="2" {{ old('banner_info') == '2' ? 'selected' : '' }}>
                                        {{ trans('labels.product') }}</option>
                                        <option value="3" {{ old('banner_info') == '3' ? 'selected' : '' }}>
                                        {{ trans('labels.custom_link') }}</option>
                                </select>
                                @error('banner_info')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group 1 gravity">
                                <label class="form-label">{{ trans('labels.category') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="category" id="category">
                                    <option value="" selected>{{ trans('labels.select') }} </option>
                                    @foreach ($getcategorylist as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }} </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group 2 gravity">
                                <label class="form-label">{{ trans('labels.product') }}<span class="text-danger"> *
                                    </span></label>
                                <select class="form-select" name="product" id="product">
                                    <option value="" selected>{{ trans('labels.select') }} </option>
                                    @foreach ($getproductslist as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('product') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group 3 gravity">
                                <label class="form-label">{{ trans('labels.custom_link') }}<span class="text-danger"> *
                                    </span></label>
                                <input type="text" name="custom_link" class="form-control" id="custom_link">
                                @error('custom_link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label">{{ trans('labels.image') }} <span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="image" required>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                                <a href="{{ $url }}"
                                    class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                                <button class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banner', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}"
                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/banner.js') }}"></script>
@endsection

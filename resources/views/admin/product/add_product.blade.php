@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.add_new') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/products') }}">{{ trans('labels.products') }}</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="{{ URL::to('admin/products/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label">{{ trans('labels.category') }} <span class="text-danger">
                                        * </span></label>
                                <select class="form-select" name="category" id="cat_id"
                                    data-url="{{ URL::to('admin/products/subcategories') }}" required>
                                    <option value="">{{ trans('labels.select') }}</option>
                                    @foreach ($getcategorylist as $catdata)
                                        <option value="{{ $catdata->id }}" data-id="{{ $catdata->id }}"
                                            {{ old('category') == $catdata->id ? 'selected' : '' }}>
                                            {{ $catdata->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.sub_category') }} </label>
                                    <select name="sub_category[]" class="form-control" multiple id="sub_category"></select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ trans('labels.name') }} <span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="product_name"
                                    value="{{ old('product_name') }}" placeholder="{{ trans('labels.name') }}" required>
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.sku') }} </label>
                                    <input type="text" class="form-control" name="product_sku"
                                        value="{{ old('product_sku') }}" placeholder="{{ trans('labels.sku') }}"
                                        id="product_sku">
                                    @error('product_sku')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="form-label">{{ trans('labels.image') }} <span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="product_image[]" id="image"
                                    multiple="" required>
                                @error('product_image')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                @enderror
                                <div class="gallery"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.tax') }} </label>
                                    <select name="tax[]" class="form-control selectpicker" multiple
                                        data-live-search="true">
                                        @if (!empty($gettaxlist))
                                            @foreach ($gettaxlist as $tax)
                                                <option value="{{ $tax->id }}"> {{ $tax->name }} </option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.video_url') }} </label>
                                    <input class="form-control" type="text" name="video_url"
                                        placeholder="{{ trans('labels.video_url') }}" value="{{ old('video_url') }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.attachment_name') }} </label>
                                    <input type="text" class="form-control" name="attachment_name" id="attachment_name"
                                        placeholder="{{ trans('labels.attachment_name') }}">
                                    @error('attachment_name')
                                        <span class="text-danger">{{ $message }}</span> <br>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.attachment_file') }}</label>
                                    <input type="file" class="form-control" name="attachment_file" id="attachment_file">

                                </div>
                            </div>
                            @if (@helper::checkaddons('digital_product'))
                                @include('admin.product.digital_product')
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="form-group">
                                    <label for="has_extras"
                                        class="form-label">{{ trans('labels.product_has_extras') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_extras" type="radio"
                                                name="has_extras" id="extras_no" value="2" checked
                                                @if (old('has_extras') == 2) checked @endif>
                                            <label class="form-check-label"
                                                for="extras_no">{{ trans('labels.no') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_extras" type="radio"
                                                name="has_extras" id="extras_yes" value="1"
                                                @if (old('has_extras') == 1) checked @endif>
                                            <label class="form-check-label"
                                                for="extras_yes">{{ trans('labels.yes') }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-center col-sm-auto col-12 mb-sm-0 mb-2">
                                    <div class="col-sm-auto col-10 pe-2">
                                        @if (count($globalextras) > 0)
                                            <button class="btn btn-secondary px-sm-4 w-100 align-items-end"
                                                type="button" id="globalextra" onclick="global_extras()">
                                                <i class="fa-sharp fa-solid fa-plus"></i>
                                                {{ trans('labels.add_global_extras') }}
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="button" id="add_extra"
                                            onclick="extras_fields('{{ trans('labels.name') }}','{{ trans('labels.price') }}')"><i
                                                class="fa-sharp fa-solid fa-plus"></i> </button>
                                    </div>
                                </div>

                            </div>
                            <div id="extras">

                                @if (!empty($globalextras) && $globalextras->count() > 0)
                                    <div id="global-extras"></div>
                                @endif
                                <div id="more_extras_fields"></div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-between">
                                <div class="form-group">
                                    <label for="has_variants"
                                        class="form-label">{{ trans('labels.product_has_variation') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_variants" type="radio"
                                                name="has_variants" id="no" value="2" checked
                                                @if (old('has_variants') == 2) checked @endif>
                                            <label class="form-check-label"
                                                for="no">{{ trans('labels.no') }}</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_variants" type="radio"
                                                name="has_variants" id="yes" value="1"
                                                @if (old('has_variants') == 1) checked @endif>
                                            <label class="form-check-label"
                                                for="yes">{{ trans('labels.yes') }}</label>
                                        </div>

                                    </div>
                                </div>
                                <button class="btn btn-primary" type="button" id="btn_addvariants"
                                    onclick="commonModal()">
                                    <i class="fa-sharp fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <div class="row dn @if ($errors->has('variants_name.*') || $errors->has('variants_price.*')) dn @endif @if (old('variants') == 2) d-flex @endif"
                                    id="price_row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.original_price') }} <span
                                                    class="text-danger"> * </span>
                                            </label>
                                            <input type="text" class="form-control numbers_only" name="original_price"
                                                value="{{ old('original_price') }}"
                                                placeholder="{{ trans('labels.original_price') }}" id="original_price"
                                                required>
    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.selling_price') }} <span
                                                    class="text-danger"> * </span></label>
                                            <input type="text" class="form-control numbers_only" name="price"
                                                value="{{ old('price') }}"
                                                placeholder="{{ trans('labels.selling_price') }}" id="price" required>
    
                                        </div>
                                    </div>
    
                                    <div class="col-12 d-flex align-items-center justify-content-between">
                                        <div class="form-group">
                                            <label for="has_stock"
                                                class="form-label">{{ trans('labels.stock_management') }}</label>
                                            <div class="col-md-12">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input me-0 has_stock" type="radio"
                                                        name="has_stock" id="stock_no" value="2" checked
                                                        @if (old('has_stock') == 2) checked @endif>
                                                    <label class="form-check-label"
                                                        for="stock_no">{{ trans('labels.no') }}</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input me-0 has_stock" type="radio"
                                                        name="has_stock" id="stock_yes" value="1"
                                                        @if (old('has_stock') == 1) checked @endif>
                                                    <label class="form-check-label"
                                                        for="stock_yes">{{ trans('labels.yes') }}</label>
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3" id="block_stock_qty">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.stock_qty') }} <span
                                                    class="text-danger"> * </span></label>
                                            <input type="text" class="form-control numbers_only"
                                                onkeypress="allowNumbersOnly(event)" name="qty"
                                                value="{{ old('qty') }}" placeholder="{{ trans('labels.stock_qty') }}"
                                                id="qty">
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="block_min_order">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.min_order_qty') }} <span
                                                    class="text-danger"> * </span>
                                            </label>
                                            <input type="text" class="form-control numbers_only"
                                                onkeypress="allowNumbersOnly(event)" name="min_order"
                                                value="{{ old('min_order') }}"
                                                placeholder="{{ trans('labels.min_order_qty') }}" id="min_order">
    
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="block_max_order">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.max_order_qty') }} <span
                                                    class="text-danger"> * </span>
                                            </label>
                                            <input type="text" class="form-control numbers_only"
                                                onkeypress="allowNumbersOnly(event)" name="max_order"
                                                value="{{ old('max_order') }}"
                                                placeholder="{{ trans('labels.max_order_qty') }}" id="max_order">
    
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="block_product_low_qty_warning">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.product_low_qty_warning') }} <span
                                                    class="text-danger"> * </span></label>
                                            <input type="text" class="form-control numbers_only variation_qty"
                                                onkeypress="allowNumbersOnly(event)" name="low_qty" id="low_qty"
                                                placeholder="{{ trans('labels.product_low_qty_warning') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row  dn @if ($errors->has('variation.*') || $errors->has('variation_price.*') || old('has_variants') == 1) d-flex @endif" id="variations">
                                    <div id="productVariant" class="col-md-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card my-3 d-none" id="variant_card">
                                                    <div class="card-header">
                                                        <div class="row flex-grow-1">
                                                            <div class="col-md d-flex align-items-center">
                                                                <h5 class="card-header-title">
                                                                    {{ trans('labels.product') }}
                                                                    {{ trans('labels.variants') }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="hidden" id="hiddenVariantOptions"
                                                            name="hiddenVariantOptions" value="{}">
                                                        <div class="variant-table">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label class="form-label">{{ trans('labels.description') }} </label>
                                <textarea class="form-control" id="ckeditor" name="description" required>{{ old('description') }}</textarea>

                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label">{{ trans('labels.additional_info') }} </label>
                                <textarea class="form-control" id="ckeditor1" name="additional_info" required> {{ old('additional_info') }}</textarea>
                                @error('additional_info')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                                <a href="{{ URL::to('admin/products') }}"
                                    class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                                <button
                                    class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}"
                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade  modal-fade-transform" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
            <div class="modal-content">
                <div class="popup-content">
                    <div class="modal-header justify-content-between popup-header align-items-center">
                        <div class="modal-title text-dark">
                            <h5 class="mb-0" id="modelCommanModelLabel">{{ trans('labels.add_variants') }}</h5>
                        </div>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ URL::to('admin/products/get-product-variants-possibilities') }}">
                            @csrf
                            <div class="form-group">
                                <label for="variant_name" class="mb-1">{{ trans('labels.variant_name') }}</label>
                                <input class="form-control" name="variant_name" type="text" id="variant_name"
                                    onkeyup="this.value = this.value.replace(/[`\/\\|~_$&+,:;=?[\]@#{}'<>.^*()%!-/]/, '')"
                                    placeholder="{{ 'Variant Name, i.e Size, Color etc' }}">
                            </div>
                            <div class="form-group">
                                <label for="variant_options" class="mb-1">{{ trans('labels.variant_options') }}</label>
                                <input class="form-control" name="variant_options" type="text" id="variant_options"
                                    placeholder="{{ 'Variant Options separated by|pipe symbol, i.e Black|Blue|Red' }}">
                            </div>
                            <div class="form-group col-12 d-flex justify-content-end form-label">
                                <input type="button" value="{{ trans('labels.cancel') }}"
                                    class="btn btn-danger px-sm-4" data-bs-dismiss="modal">
                                <input type="button" value="{{ trans('labels.add_variants') }}"
                                    class="btn btn-primary px-sm-4 add-variants ms-2">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var page = "add";
        var extrasurl = "{{ URL::to('admin/getextras') }}";
        var vendor_id = "{{ $vendor_id }}";
        var placehodername = "{{ trans('labels.name') }}";
        var placeholderprice = "{{ trans('labels.price') }}";
        var page = "add";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor1');
    </script>

    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/editor.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/product.js') }}"></script>
@endsection

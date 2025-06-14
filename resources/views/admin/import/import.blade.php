@extends('admin.layout.default')

@section('content')
    <div class="mb-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.product_upload') }} @if (env('Environment') == 'sendbox')
                <span class="badge badge bg-danger float-right mr-1 mb-2">{{ trans('labels.addon') }}</span>
            @endif
        </h5>
        <a href="{{ URL::to('/admin/media') }}"
            class="btn btn-secondary col-sm-auto justify-content-center col-12 px-sm-4 text-capitalize d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_import_product', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}"><i
                class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add_media') }}</a>
    </div>

    <div class="row">

        <div class="col-12 mb-3">

            <div class="card border-0 box-shadow mb-3">
                <div class="card-header py-2 bg-white">

                    <h6 class="m-0 fw-600">{{ trans('labels.step_1') }}:</h6>

                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex flex-column gap-2 fw-500">
                        <li class="d-flex gap-1"><b>1.</b> {{ trans('labels.download_file') }}</li>
                        <li class="d-flex gap-1"><b>2.</b> {{ trans('labels.download_example_file_to_understand') }}</li>
                        <li class="d-flex gap-1"><b>3.</b> {{ trans('labels.upload_submit') }}</li>
                        <li class="d-flex gap-1"><b>4.</b> {{ trans('labels.after_uploading_products') }}</li>
                    </ul>

                </div>

            </div>

            <a href="{{ url(env('ASSETPATHURL') . 'admin-assets/sample.xlsx') }}"
                class="btn btn-primary mb-3">{{ trans('labels.download_CSV') }}</a>

            <div class="card border-0 box-shadow mb-3">

                <div class="card-header py-2 bg-white">

                    <h6 class="m-0 fw-600">{{ trans('labels.step_2') }}:</h6>

                </div>

                <div class="card-body">
                    <ul class="fs-7 d-flex flex-column gap-2 fw-500">
                        <li class="d-flex gap-1"><b>1.</b> {{ trans('labels.category_numeric') }}</li>
                        <li class="d-flex gap-1"><b>2.</b> {{ trans('labels.download_pdf') }}</li>
                    </ul>

                </div>

            </div>

            <div class="d-flex mb-3 gap-2">

                <a href="{{ URL::to('/admin/generatepdf') }}"
                    class="btn btn-primary px-sm-4">{{ trans('labels.download_category') }}</a>

                <a href="{{ URL::to('/admin/generatepdf_subcategory') }}"
                    class="btn btn-primary px-sm-4">{{ trans('labels.download_subcategory') }}</a>

            </div>
            <div class="card border-0 box-shadow mb-3">
                <div class="card-header py-2 bg-white">

                    <h6 class="m-0 fw-600">{{ trans('labels.step_3') }}:</h6>

                </div>
                <div class="card-body">
                    <ul class="fs-7 d-flex flex-column gap-2 fw-500">
                        <li class="d-flex gap-1"><b>1.</b> {{ trans('labels.tax_numeric') }}</li>
                        <li class="d-flex gap-1"><b>2.</b> {{ trans('labels.download_taxpdf') }}</li>
                        <li class="d-flex gap-1"><b>3.</b> {{ trans('labels.tax_step_3') }}</li>
                    </ul>
                </div>
            </div>
            <a href="{{ URL::to('/admin/generatetaxpdf') }}"
                class="btn btn-primary mb-3">{{ trans('labels.download_tax') }}</a>

                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <form action="{{ URL::to('/admin/importproduct') }}" method="POST" enctype="multipart/form-data">
            
                            @csrf
            
                            <div class="col-12 form-group">
            
                                <label class="form-label">{{ trans('labels.product_upload') }}<span class="text-danger"> *
            
                                    </span></label>
            
                                <input type="file" class="form-control" name="importfile" id="importfile" multiple="" required>
            
                            </div>
            
                            <button class="btn btn-primary px-sm-4">{{ trans('labels.import') }}</button>
            
                        </form>
                    </div>
                </div>

        </div>

    </div>
@endsection

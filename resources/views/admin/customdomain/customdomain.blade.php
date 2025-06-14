@extends('admin.layout.default')

@section('content')
    <div class="d-flex gap-2 flex-wrap justify-content-between align-items-center mb-2">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.custom_domains') }}</h5>
        @if (Auth::user()->type == 2 || Auth::user()->type == 4)
            <a href="{{ URL::to('admin/custom_domain/add') }}"
                class="btn btn-secondary px-sm-4 col-sm-auto col-12 {{ Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.request_custom_domain') }}</a>
        @endif
    </div>
    <div class="row mt-3">
        <div class="col-12">
            @if (Auth::user()->type == 1)
                @include('admin.customdomain.setting_form')
            @endif
            <div class="card border-0 mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        @if (Auth::user()->type == 2 || Auth::user()->type == 4)
                            @include('admin.customdomain.customdomain_table')
                        @endif
                        @if (Auth::user()->type == 1)
                            @include('admin.customdomain.listcustomdomain_table')
                        @endif
                    </div>
                    @if (Auth::user()->type == 2 || Auth::user()->type == 4)
                        <div class="card mt-4">
                            <div class="card-header">
                                {{ $setting->cname_title }}
                            </div>
                            <div class="card-body">
                                <p class="card-text"> {!! $setting->cname_text !!}</p>
                            </div>
                        </div>
                    @endif
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
@endsection
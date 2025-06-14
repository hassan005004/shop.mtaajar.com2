@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ $userinfo->name }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/customers') }}">{{ trans('labels.customers') }}</a>
                </li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.orders') }}</li>
            </ol>
        </nav>
    </div>
    @include('admin.orders.statistics')

    <div class="row">

        <div class="col-12">

            <div class="card border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        @include('admin.orders.orderstable')

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

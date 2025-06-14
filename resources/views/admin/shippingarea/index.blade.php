@extends('admin.layout.default')

@section('content')
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.shipping_area') }}</h5>

                <a href="{{ URL::to('admin/shipping-area/add') }}" class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">

                    <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}

                </a>

            </div>
            <div class="row">

                <div class="col-12">

                    <div class="card border-0 my-3">

                        <div class="card-body">

                            <div class="table-responsive">

                                @include('admin.shippingarea.table')

                            </div>

                        </div>

                    </div>

                </div>

            </div>
@endsection


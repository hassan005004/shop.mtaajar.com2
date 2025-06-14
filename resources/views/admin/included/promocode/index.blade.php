@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.coupons') }}</h5>

        <a href="{{ URL::to('admin/promocode/add') }}"
            class="btn btn-secondary text-capitalize px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}"><i
                class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}</a>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card border-0 my-3">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">

                            <thead>

                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td>{{ trans('labels.srno') }}</td>

                                    <td>{{ trans('labels.offer_name') }}</td>

                                    <td>{{ trans('labels.offer_code') }}</td>

                                    <td>{{ trans('labels.discount') }}</td>

                                    <td>{{ trans('labels.start_date') }}</td>

                                    <td>{{ trans('labels.end_date') }}</td>

                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>

                                    <td>{{ trans('labels.action') }}</td>

                                </tr>

                            </thead>

                            <tbody id="tabledetails" data-url="{{ url('admin/promocode/reorder_coupon') }}">

                                @php $i = 1; @endphp

                                @foreach ($getpromocodeslist as $promocode)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $promocode->id }}"
                                        data-id="{{ $promocode->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php echo $i++; @endphp</td>

                                        <td>{{ $promocode->offer_name }}</td>

                                        <td>{{ $promocode->offer_code }}</td>

                                        <td>{{ $promocode->offer_type == 1 ? helper::currency_formate($promocode->offer_amount, $promocode->vendor_id) : $promocode->offer_amount . '%' }}
                                        </td>

                                        <td><span
                                                class="badge bg-success">{{ helper::date_formate($promocode->start_date, $promocode->vendor_id) }}</span>
                                        </td>

                                        <td><span
                                                class="badge bg-danger">{{ helper::date_formate($promocode->exp_date, $promocode->vendor_id) }}</span>
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                @if ($promocode->is_available == '1')
                                                    <a href="javascript:void(0)" tooltip="{{ trans('labels.active') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="statusupdate('{{ URL::to('admin/promocode/status-' . $promocode->id . '/2') }}')" @endif
                                                        class="btn btn-sm hov btn-outline-success  {{ Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                            class="fa-regular fa-check"></i> </a>
                                                @else
                                                    <a href="javascript:void(0)" tooltip="{{ trans('labels.inactive') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="statusupdate('{{ URL::to('admin/promocode/status-' . $promocode->id . '/1') }}')" @endif
                                                        class="btn btn-sm hov btn-outline-danger  {{ Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                                        <i class="fa-regular fa-xmark"></i> </a>
                                                @endif
                                            </div>

                                        </td>
                                        <td>{{ helper::date_formate($promocode->created_at, $promocode->vendor_id) }}<br>
                                            {{ helper::time_formate($promocode->created_at, $promocode->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($promocode->updated_at, $promocode->vendor_id) }}<br>
                                            {{ helper::time_formate($promocode->updated_at, $promocode->vendor_id) }}
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ URL::to('admin/promocode/edit-' . $promocode->id) }}"
                                                    tooltip="{{ trans('labels.edit') }}"
                                                    class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>

                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="deletedata('{{ URL::to('admin/promocode/delete-' . $promocode->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_coupons', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-trash"></i></a>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

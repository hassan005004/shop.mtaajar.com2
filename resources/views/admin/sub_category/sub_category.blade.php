@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.sub_categories') }}</h5>
        <a href="{{ URL::to('admin/sub-categories/add') }}"
            class="btn btn-secondary px-sm-4 text-capitalize d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
            <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
        </a>
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
                                    <td>{{ trans('labels.name') }}</td>
                                    <td>{{ trans('labels.category') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="{{ url('admin/sub-categories/reorder_category') }}">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($sub_categories as $sub_category)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $sub_category->id }}"
                                        data-id="{{ $sub_category->id }}">
                                        <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php
                                            echo $i++;
                                        @endphp</td>
                                        <td>{{ $sub_category->name }}</td>
                                        <td>{{ @$sub_category['category_info']->name }}</td>
                                        <td>
                                            @if ($sub_category->is_available == '1')
                                                <a tooltip="{{ trans('labels.active') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/sub-categories/change_status-' . $sub_category->slug . '/2') }}')" @endif
                                                    class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-check"></i></a>
                                            @else
                                                <a tooltip="{{ trans('labels.inactive') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/sub-categories/change_status-' . $sub_category->slug . '/1') }}')" @endif
                                                    class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ helper::date_formate($sub_category->created_at, $sub_category->vendor_id) }}<br>
                                            {{ helper::time_formate($sub_category->created_at, $sub_category->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($sub_category->updated_at, $sub_category->vendor_id) }}<br>
                                            {{ helper::time_formate($sub_category->updated_at, $sub_category->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a tooltip="{{ trans('labels.edit') }}"
                                                    href="{{ URL::to('admin/sub-categories/edit-' . $sub_category->slug) }}"
                                                    class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
    
                                                <a tooltip="{{ trans('labels.delete') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="deletedata('{{ URL::to('admin/sub-categories/delete-' . $sub_category->slug) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
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

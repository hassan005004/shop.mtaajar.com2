@extends('admin.layout.default')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.tax') }}</h5>
    <a href="{{ URL::to('admin/tax/add') }}" class="btn btn-secondary px-sm-4 text-capitalize d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
        <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
    </a>
</div>
<div class="row">
    @php
    if (Auth::user()->type == 4) {
    $vendor_id = Auth::user()->vendor_id;
    } else {
    $vendor_id = Auth::user()->id;
    }
    @endphp
    <div class="col-12">
        <div class="card border-0 my-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                        <thead>
                            <tr class="text-capitalize fs-15 fw-500">
                                <td></td>
                                <td>{{trans('labels.srno')}}</td>
                                <td>{{trans('labels.name')}}</td>
                                <td>{{trans('labels.tax')}}</td>
                                <td>{{ trans('labels.status') }}</td>
                                <td>{{trans('labels.created_date')}}</td>
                                <td>{{trans('labels.updated_date')}}</td>
                                <td>{{trans('labels.action')}}</td>
                            </tr>
                        </thead>
                        <tbody id="tabledetails" data-url="{{url('admin/tax/reorder_tax')}}">
                            @php
                            $i=1;
                            @endphp
                            @foreach ($gettax as $tax)
                            <tr class="fs-7 align-middle row1" id="dataid{{$tax->id}}" data-id="{{$tax->id}}">
                                <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                <td>@php
                                    echo $i++
                                    @endphp </td>
                                <td>{{$tax->name}}</td>

                                <td>@if($tax->type == 1) {{helper::currency_formate($tax->tax,$vendor_id)}} @else {{$tax->tax}}% @endif</td>
                                <td>
                                    @if ($tax->is_available == '1')
                                    <a @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/tax/change_status-' . $tax->id . '/2') }}')" @endif class="btn btn-sm hov btn-outline-success {{ Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" tooltip="{{trans('labels.active')}}"><i class="fas fa-check"></i></a>
                                    @else
                                    <a @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/tax/change_status-' . $tax->id . '/1') }}')" @endif class="btn btn-sm hov btn-outline-danger {{ Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" tooltip="{{trans('labels.inactive')}}"><i class="fas fa-close"></i></a>
                                    @endif
                                </td>
                                <td>{{ helper::date_formate($tax->created_at,$vendor_id) }}<br>
                                    {{ helper::time_formate($tax->created_at,$vendor_id) }}
                                </td>
                                <td>{{ helper::date_formate($tax->updated_at,$vendor_id) }}<br>
                                    {{ helper::time_formate($tax->updated_at,$vendor_id) }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{URL::to('admin/tax/edit-'.$tax->id)}}" class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" tooltip="{{trans('labels.edit')}}"> <i class="fa-regular fa-pen-to-square"></i></a>
                                        <a @if(env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/tax/delete-'.$tax->id)}}')" @endif class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_tax', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}" tooltip="{{trans('labels.delete')}}"> <i class="fa-regular fa-trash"></i></a>
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
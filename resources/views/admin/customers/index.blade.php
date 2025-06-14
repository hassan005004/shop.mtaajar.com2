@extends('admin.layout.default')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.customers') }}</h5>
    @if(Auth::user()->type == 2 || Auth::user()->type == 4)
    <div class="d-inline-flex">
        <a href="{{ URL::to('admin/customers/add') }}" class="btn btn-secondary px-sm-4 d-flex text-capitalize {{ Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
            <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}</a>
    </div>
    @endif
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
        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsive" id="table-display">
                    <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                        <thead>
                            <tr class="text-capitalize fs-15 fw-500">
                                <td>{{ trans('labels.srno') }}</td>
                                <td>{{ trans('labels.image') }}</td>
                                @if(Auth::user()->type == 1)
                                <td>{{ trans('labels.users') }}</td>
                                @endif
                                <td>{{ trans('labels.name') }}</td>
                                <td>{{ trans('labels.email') }}</td>
                                <td>{{ trans('labels.mobile') }}</td>
                               
                                <td>

                                    {{ trans('labels.login_type') }}

                                </td>
                              
                                @if(Auth::user()->type == 2 || Auth::user()->type == 4)
                                <td>{{ trans('labels.status') }}</td>
                                @endif
                                <td>{{ trans('labels.created_date') }}</td>
                                <td>{{ trans('labels.updated_date') }}</td>

                                <td>{{ trans('labels.action') }}</td>


                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($getcustomerslist as $user)
                            <tr class="fs-7 align-middle">
                                <td>@php echo $i++; @endphp</td>
                                <td> <img src="{{ helper::image_path($user->image) }}" class="img-fluid rounded hw-50" alt="" srcset=""> </td>
                                @if(Auth::user()->type == 1)
                                <td>{{@helper::getslug($user->vendor_id)->name}}</td>
                                @endif
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td> {{ $user->mobile }}</td>
                               
                                <td>

                                    @if ($user->login_type == 'email')
                                    {{ trans('labels.normal') }}
                                    @elseif ($user->login_type == 'google')
                                    {{ trans('labels.google') }}
                                    @elseif ($user->login_type == 'facebook')
                                    {{ trans('labels.facebook') }}
                                    @endif

                                </td>
                               
                                @if(Auth::user()->type == 2 || Auth::user()->type == 4)
                                <td>
                                    @if ($user->is_available == 1)
                                    <a class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" tooltip="{{ trans('labels.active') }}" @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/customers/status-' . $user->id . '/2') }}')" @endif><i class="fa-sharp fa-solid fa-check"></i></a>
                                    @else
                                    <a class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" tooltip="{{ trans('labels.inactive') }}" @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/customers/status-' . $user->id . '/1') }}')" @endif><i class="fa-sharp fa-solid fa-xmark"></i></a>
                                    @endif
                                </td>
                                @endif
                                <td>{{ helper::date_formate($user->created_at,$vendor_id) }}<br>
                                    {{ helper::time_formate($user->created_at,$vendor_id) }}

                                </td>
                                <td>{{ helper::date_formate($user->updated_at,$vendor_id) }}<br>
                                    {{ helper::time_formate($user->updated_at,$vendor_id) }}

                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if(Auth::user()->type == 2 || Auth::user()->type == 4)
                                        <a class="btn btn-sm btn-info hov {{ Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" tooltip="{{ trans('labels.edit') }}" href="{{ URL::to('admin/customers/edit-' . $user->id) }}"> <i class="fa fa-pen-to-square"></i></a>
                                        @endif
                                        <a class="btn btn-sm btn-secondary hov" tooltip="{{ trans('labels.view') }}" href="{{ URL::to('admin/customers/orders-' . $user->id) }}"><i class="fa-regular fa-eye"></i></a>
                                        @if(Auth::user()->type == 2 || Auth::user()->type == 4)
                                        <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}" @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/customers/delete-' . $user->id) }}')" @endif class="btn btn-danger btn-sm hov {{ Auth::user()->type == 4 ? (helper::check_access('role_customers', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
                                            <i class="fa-regular fa-trash"></i></a>
                                        @endif
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
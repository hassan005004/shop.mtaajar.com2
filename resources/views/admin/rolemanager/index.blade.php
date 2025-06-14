@extends('admin.layout.default')

@section('content')
    @php

        $module = 'roles';

    @endphp

    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.roles') }}</h5>

        <a href="{{ URL::to('admin/roles/add') }}"
            class="btn btn-secondary px-sm-4 text-capitalize d-flex  {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">

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



                                    <td>{{ trans('labels.srno') }}</td>

                                    <td>{{ trans('labels.role') }}</td>

                                    <td>{{ trans('labels.system_modules') }}</td>

                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>



                                </tr>



                            </thead>



                            <tbody>



                                @php

                                    $i = 1;

                                @endphp



                                @foreach ($getroles as $role)
                                    <tr class="fs-7 align-middle">



                                        <td>@php

                                            echo $i++;

                                        @endphp</td>

                                        <td>{{ $role->role }}</td>

                                        @php

                                            $modules = explode(',', $role->module);

                                        @endphp

                                        <td>

                                            @foreach ($modules as $module)
                                                <span
                                                    class="badge rounded-pill bg-light text-dark">{{ $module }}</span>
                                            @endforeach

                                        </td>

                                        <td>

                                            @if ($role->is_available == '1')
                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.active') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('/admin/roles/change_status-' . $role->id . '/2') }}')" @endif
                                                    class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-check"></i></a>
                                            @else
                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.inactive') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('/admin/roles/change_status-' . $role->id . '/1') }}')" @endif
                                                    class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            @endif

                                        </td>
                                        
                                        <td>{{ helper::date_formate($role->created_at, $role->vendor_id) }}<br>
                                            {{ helper::time_formate($role->created_at, $role->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($role->updated_at, $role->vendor_id) }}<br>
                                            {{ helper::time_formate($role->updated_at, $role->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ URL::to('admin/roles/edit-' . $role->id) }}"
                                                    tooltip="{{ trans('labels.edit') }}"
                                                    class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
    
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
    
                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else
    
                                                        onclick="statusupdate('{{ URL::to('/admin/roles/delete-' . $role->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
    
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

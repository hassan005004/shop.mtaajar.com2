@extends('admin.layout.default')

@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp
    <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.vendors') }}</h5>

        <div class="row g-2">
            @if (@helper::checkaddons('vendor_import'))
                <div class="col-sm-auto col-6">
                    <a href="{{ URL::to('admin/users/import') }}"
                        class="btn btn-secondary w-100 px-sm-4 d-flex gap-1 align-items-center justify-content-center {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                        <i class="fa-solid fa-file-import"></i>{{ trans('labels.import') }}</a>
                </div>

                @if ($getuserslist->count() > 0)
                    <div class="col-sm-auto col-6">
                        <a href="{{ URL::to('admin/users/exportvendor') }}"
                            class="btn btn-secondary w-100 px-sm-4 d-flex gap-1 align-items-center justify-content-center {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                            <i class="fa-solid fa-file-export"></i>{{ trans('labels.export') }}</a>
                    </div>
                @endif
            @endif
            <div class="col-sm-auto col-6">
                <a href="{{ URL::to('admin/users/add') }}"
                    class="btn btn-secondary px-sm-4 w-100 d-flex gap-1 align-items-center justify-content-center {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                    <i class="fa-regular fa-plus"></i>{{ trans('labels.add') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td>{{ trans('labels.id') }}</td>
                                    <td>{{ trans('labels.image') }}</td>
                                    <td>{{ trans('labels.name') }}</td>
                                    <td>{{ trans('labels.email') }}</td>
                                    <td>{{ trans('labels.mobile') }}</td>
                                    <td class="d-none">{{ trans('labels.login_type') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getuserslist as $user)
                                    <tr class="fs-7 align-middle">
                                        <td>{{ $user->id }}</td>
                                        <td><img src="{{ helper::image_path($user->image) }}" height="50" width="50"
                                                alt=""></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td class="d-none">
                                            @if ($user->login_type == 'normal')
                                                {{ trans('labels.normal') }}
                                            @elseif ($user->login_type == 'google')
                                                {{ trans('labels.google') }}
                                            @elseif ($user->login_type == 'facebook')
                                                {{ trans('labels.facebook') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->is_available == '1')
                                                <a class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    href="javascript::void(0)" tooltip="{{ trans('labels.active') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/status-' . $user->slug . '/2') }}')" @endif><i
                                                        class="fa-regular fa-check"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    href="javascript::void(0)" tooltip="{{ trans('labels.inactive') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/status-' . $user->slug . '/1') }}')" @endif><i
                                                        class="fa-regular fa-xmark "></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ helper::date_formate($user->created_at, $vendor_id) }}<br>
                                            {{ helper::time_formate($user->created_at, $vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($user->updated_at, $vendor_id) }}<br>
                                            {{ helper::time_formate($user->updated_at, $vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ URL::to('admin/users/edit-' . $user->slug) }}"
                                                    tooltip="{{ trans('labels.edit') }}"
                                                    class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a class="btn btn-sm btn-dark" tooltip="{{ trans('labels.login') }}"
                                                    href="{{ URL::to('/admin/users/login-' . $user->slug) }}">
                                                    <i class="fa-regular fa-arrow-right-to-bracket"></i>
                                                </a>
                                                <a class="btn btn-sm btn-secondary hov"
                                                    tooltip="{{ trans('labels.view') }}"
                                                    href="{{ URL::to('/' . $user->slug) }}" target="_blank">
                                                    <i class="fa-regular fa-eye"></i></a>
                                                <button type="button" id="btn_password{{ $user->id }}"
                                                    tooltip="{{ trans('labels.reset_password') }}"
                                                    onclick="myfunction({{ $user->id }})"
                                                    class="btn btn-sm btn-success hov" data-vendor_id="{{ $user->id }}"
                                                    data-type="1"><i class="fa-light fa-key"></i>
                                                </button>
                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/delete-' . $user->slug) }}')" @endif
                                                    class="btn btn-danger btn-sm hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
                                                @if (@helper::checkaddons('store_clone'))
                                                    <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else href="{{ URL::to('admin/users/add-' . $user->id) }}" @endif
                                                        tooltip="{{ trans('labels.clone') }}"
                                                        class="btn btn-warning btn-sm hov">
                                                        <i class="fa-regular fa-clone"></i>
                                                    </a>
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
    <!-- Modal -->
    <div class="modal fade" id="changepasswordModal" tabindex="-1" aria-labelledby="changepasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ URL::to('/admin/settings/change-password') }}" method="post" class="w-100">
                @csrf
                <div class="modal-content">
                    <div class="modal-header justify-content-between">
                        <h5 class="modal-title text-dark" id="changepasswordModalLabel">
                            {{ trans('labels.change_password') }}
                        </h5>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="card p-1 border-0">
                            <input type="hidden" class="form-control" name="modal_vendor_id" id="modal_vendor_id"
                                value="">
                            <input type="hidden" class="form-control" name="type" id="type" value="1">
                            <div class="form-group">
                                <label for="new_password" class="form-label">{{ trans('labels.new_password') }}</label>
                                <input type="password" class="form-control" name="new_password" required
                                    placeholder="{{ trans('labels.new_password') }}">

                            </div>
                            <div class="form-group">
                                <label for="confirm_password"
                                    class="form-label">{{ trans('labels.confirm_password') }}</label>
                                <input type="password" class="form-control" name="confirm_password" required
                                    placeholder="{{ trans('labels.confirm_password') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary px-sm-4">{{ trans('labels.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function myfunction(id) {
            $('#modal_vendor_id').val($('#btn_password' + id).attr("data-vendor_id"));
            $('#changepasswordModal').modal('show');
        }
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/user.js') }}"></script>
@endsection

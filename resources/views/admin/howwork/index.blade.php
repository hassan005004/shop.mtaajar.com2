@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.how_it_works') }}</h5>

        <a href="{{ URL::to('admin/how_it_works/add') }}"
            class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_how_it_works', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">

            <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}

        </a>

    </div>

    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 mb-3">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">

                            <thead>

                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td>{{ trans('labels.srno') }}</td>
                                    <td>{{ trans('labels.image') }}</td>
                                    <td>{{ trans('labels.title') }}</td>
                                    <td>{{ trans('labels.description') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>

                                </tr>

                            </thead>

                            <tbody id="tabledetails" data-url="{{ url('admin/how_it_works/reorder_how_work') }}">

                                @php

                                    $i = 1;

                                @endphp

                                @foreach ($datas as $data)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $data->id }}"
                                        data-id="{{ $data->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php

                                            echo $i++;

                                        @endphp</td>

                                        <td> <img src="{{ helper::image_path($data->image) }}"
                                                class="img-fluid rounded hight-50 object-fit-cover" alt=""></td>

                                        <td>{{ $data->title }}</td>

                                        <td>{{ $data->description }}</td>
                                        <td>{{ helper::date_formate($data->created_at, $data->vendor_id) }}<br>
                                            {{ helper::time_formate($data->created_at, $data->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($data->updated_at, $data->vendor_id) }}<br>
                                            {{ helper::time_formate($data->updated_at, $data->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ URL::to('/admin/how_it_works/edit-' . $data->id) }}"
                                                    class="btn btn-info btn-sm hov {{ Auth::user()->type == 4 ? (helper::check_access('role_how_it_works', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    tooltip="{{ trans('labels.edit') }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/how_it_works/delete-' . $data->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_how_it_works', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}"
                                                    tooltip="{{ trans('labels.delete') }}">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
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

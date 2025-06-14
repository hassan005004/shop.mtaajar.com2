@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.promotional_banners') }}</h5>

        <a href="{{ URL::to('admin/promotionalbanners/add') }}"
            class="btn btn-secondary px-sm-4 text-capitalize d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_promotional_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">

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
                                    <td>{{ trans('labels.vendor_title') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>

                                </tr>

                            </thead>

                            <tbody id="tabledetails"
                                data-url="{{ url('admin/promotionalbanners/reorder_promotionalbanner') }}">

                                @php

                                    $i = 1;

                                @endphp

                                @foreach ($getbannerlist as $banner)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $banner->id }}"
                                        data-id="{{ $banner->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php

                                            echo $i++;

                                        @endphp</td>
                                        <td><img src="{{ helper::image_path($banner->image) }}" class="hight-50"
                                                alt=""></td>
                                        <td>{{ $banner['vendor_info']->name }}</td>
                                        <td>{{ helper::date_formate($banner->created_at, $banner->vendor_id) }}<br>
                                            {{ helper::time_formate($banner->created_at, $banner->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($banner->updated_at, $banner->vendor_id) }}<br>
                                            {{ helper::time_formate($banner->updated_at, $banner->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ URL::to('admin/promotionalbanners/edit-' . $banner->id) }}"
                                                    tooltip="{{ trans('labels.edit') }}" class="btn btn-info btn-sm hov {{ Auth::user()->type == 4 ? (helper::check_access('role_promotional_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/promotionalbanners/delete-' . $banner->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_promotional_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
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

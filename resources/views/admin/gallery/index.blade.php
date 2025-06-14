@extends('admin.layout.default')



@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">



        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.gallery') }}</h5>



        <a href="{{ URL::to('admin/gallery/add') }}"
            class="btn btn-secondary px-sm-4 text-capitalize d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_gallery', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">

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
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>

                                </tr>

                            </thead>

                            <tbody id="tabledetails" data-url="{{ url('admin/gallery/reorder_gallery') }}">

                                @php

                                    $i = 1;

                                @endphp

                                @foreach ($allgallery as $gallery)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $gallery->id }}"
                                        data-id="{{ $gallery->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php
                                            echo $i++;
                                        @endphp</td>

                                        <td><img src="{{ helper::image_path($gallery->image) }}"
                                                class="img-fluid rounded hight-50 object" alt=""></td>
                                        <td>{{ helper::date_formate($gallery->created_at, $gallery->vendor_id) }}<br>
                                            {{ helper::time_formate($gallery->created_at, $gallery->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($gallery->updated_at, $gallery->vendor_id) }}<br>
                                            {{ helper::time_formate($gallery->updated_at, $gallery->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ URL::to('/admin/gallery/edit-' . $gallery->id) }}"
                                                    class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_gallery', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>

                                                <a href="javascript:void(0)"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()"
                                        @else
                                        onclick="statusupdate('{{ URL::to('/admin/gallery/delete-' . $gallery->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_gallery', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
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

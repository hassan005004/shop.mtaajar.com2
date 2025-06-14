@extends('admin.layout.default')

@section('content')


            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.categories') }}</h5>

                <a href="{{ URL::to('admin/categories/add') }}" class="btn btn-secondary text-capitalize px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">

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
                                            <td>{{trans('labels.srno')}}</td>

                                            <td>{{trans('labels.image')}}</td>

                                            <td>{{trans('labels.category')}}</td>

                                            <td>{{trans('labels.status')}}</td>
                                            <td>{{ trans('labels.created_date') }}</td>
                                            <td>{{ trans('labels.updated_date') }}</td>
                                            <td>{{trans('labels.action')}}</td>

                                        </tr>

                                    </thead>
                                    <tbody id="tabledetails" data-url="{{url('admin/categories/reorder_category')}}">
                                       @php

                                           $i=1;

                                       @endphp

                                        @foreach ($allcategories as $category)

                                        <tr class="fs-7 align-middle row1"  id="dataid{{$category->id}}" data-id="{{$category->id}}">
                                            <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                          <td>@php

                                              echo $i++

                                          @endphp</td>

                                            <td><img src="{{helper::image_path($category->image)}}" class="img-fluid rounded hw-50" alt=""></td>

                                            <td>{{$category->name}}</td>

                                            <td>

                                                @if($category->is_available =="1")

                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/categories/change_status-'.$category->slug.'/2' )}}')" @endif tooltip="{{trans('labels.active')}}" class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i class="fa-regular fa-check"></i></a>

                                                @else

                                                <a tooltip="{{trans('labels.inactive')}}" @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/categories/change_status-'.$category->slug.'/1' )}}')" @endif class="btn btn-sm hov btn-outline-danger {{ Auth::user()->type == 4 ? (helper::check_access('role_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i class="fa-regular fa-xmark"></i></a>
                                                @endif
                                            </td>
                                            <td>{{ helper::date_formate($category->created_at, $category->vendor_id) }}<br>
                                                {{ helper::time_formate($category->created_at, $category->vendor_id) }}
                                            </td>
                                            <td>{{ helper::date_formate($category->updated_at, $category->vendor_id) }}<br>
                                                {{ helper::time_formate($category->updated_at, $category->vendor_id) }}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a tooltip="{{trans('labels.edit')}}" href="{{URL::to('admin/categories/edit-'.$category->slug)}}" class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                                                    <a tooltip="{{trans('labels.delete')}}" @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/categories/delete-'.$category->slug)}}')" @endif class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-trash"></i></a>
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


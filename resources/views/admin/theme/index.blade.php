@extends('admin.layout.default')

@section('content')


@php
if (Auth::user()->type == 4) {
$vendor_id = Auth::user()->vendor_id;
} else {
$vendor_id = Auth::user()->id;
}
$i = 1;
@endphp
<div class="d-flex justify-content-between align-items-center">

    <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.theme_images') }}</h5>

    <a href="{{ URL::to('admin/themes/add') }}" class="btn btn-secondary px-sm-4 text-capitalize d-flex">

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

                                <td>{{ trans('labels.name') }}</td>

                                <td>{{trans('labels.created_date')}}</td>

                                <td>{{trans('labels.updated_date')}}</td>

                                <td>{{ trans('labels.action') }}</td>



                            </tr>

                        </thead>

                        <tbody id="tabledetails" data-url="{{url('admin/themes/reorder_theme')}}">

                            @php

                            $i = 1;

                            @endphp

                            @foreach ($themes as $theme)

                            <tr class="fs-7 align-middle row1" id="dataid{{$theme->id}}" data-id="{{$theme->id}}">

                                <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>

                                <td>

                                    @php

                                    echo $i++;

                                    @endphp</td>

                                <td> <img src="{{ helper::image_path($theme->image) }}" class="img-fluid rounded hw-50 object-fit-cover" alt=""></td>

                                <td>{{ $theme->name }}</td>

                                <td>{{ helper::date_formate($theme->created_at,$vendor_id) }}<br>
                                    {{ helper::time_formate($theme->created_at,$vendor_id) }}
                                </td>

                                <td>{{ helper::date_formate($theme->updated_at,$vendor_id) }}<br>
                                    {{ helper::time_formate($theme->updated_at,$vendor_id) }}
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ URL::to('/admin/themes/edit-' . $theme->id) }}" class="btn btn-info hov btn-sm" tooltip="{{trans('labels.edit')}}"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                                        <a href="javascript:void(0)" tooltip="{{trans('labels.delete')}}" @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/themes/delete-' . $theme->id) }}')" @endif class="btn btn-danger hov btn-sm">
    
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
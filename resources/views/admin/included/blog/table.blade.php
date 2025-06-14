<table class="table table-striped table-bordered py-3 zero-configuration w-100">

    <thead>

        <tr class="text-capitalize fs-15 fw-500">
            <td></td>
            <td>{{ trans('labels.srno') }}</td>

            <td>{{ trans('labels.image') }}</td>

            <td>{{ trans('labels.title') }}</td>

            <!-- <td>{{ trans('labels.description') }}</td> -->
            <td>{{ trans('labels.created_date') }}</td>
            <td>{{ trans('labels.updated_date') }}</td>
            <td>{{ trans('labels.action') }}</td>

        </tr>

    </thead>

    <tbody id="tabledetails" data-url="{{url('admin/blogs/reorder_blogs')}}">


        @php

        $i = 1;

        @endphp

        @foreach ($blog as $item)

        <tr class="fs-7 align-middle row1" id="dataid{{$item->id}}" data-id="{{$item->id}}">
            <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
            <td>@php

                echo $i++;

                @endphp</td>

            <td><img src="{{ helper::image_path($item->image) }}" class="img-fluid rounded hight-50" alt=""></td>

            <td>{{ $item->title }}</td>

            <!-- <td>{!! Str::limit($item->description, 450) !!}</td> -->
            <td>{{ helper::date_formate($item->created_at, $item->vendor_id) }}<br>
                {{ helper::time_formate($item->created_at, $item->vendor_id) }}
            </td>
            <td>{{ helper::date_formate($item->updated_at, $item->vendor_id) }}<br>
                {{ helper::time_formate($item->updated_at, $item->vendor_id) }}
            </td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ URL::to('admin/blogs/edit-'.$item->slug)}}" tooltip="{{trans('labels.edit')}}" class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_blogs', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                    <a href="javascript:void(0)" tooltip="{{trans('labels.delete')}}" @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/blogs/delete-'.$item->slug)}}')" @endif class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_blogs', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
    
                        <i class="fa-regular fa-trash"></i></a>
                </div>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>
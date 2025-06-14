<table class="table table-striped table-bordered py-3 zero-configuration w-100">

    <thead>

        <tr class="text-capitalize fs-15 fw-500">
            <td></td>
            <td>{{ trans('labels.srno') }}</td>

            <td>{{ trans('labels.image') }}</td>

            <td>{{ trans('labels.category') }}</td>

            <td>{{ trans('labels.product') }}</td>

            <td>{{ trans('labels.status') }}</td>
            <td>{{ trans('labels.created_date') }}</td>
            <td>{{ trans('labels.updated_date') }}</td>
            <td>{{ trans('labels.action') }}</td>

        </tr>

    </thead>

    <tbody id="tabledetails" data-url="{{url('admin/'.$url.'/reorder_banner')}}">

        @php $i = 1; @endphp

        @foreach ($getbannerlist as $banner)

            @if ($banner->section == $section)

            <tr class="fs-7 align-middle row1"  id="dataid{{$banner->id}}" data-id="{{$banner->id}}">
                    <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                    <td>@php echo $i++; @endphp</td>

                    <td><img src="{{helper::image_path($banner->image )}}" class="img-fluid rounded hight-50" alt=""></td>

                    <td>{{ $banner->type == '1' ? @$banner['category_info']->name : "--" }}</td>

                    <td>{{ $banner->type == '2' ? @$banner['product_info']->name : "--" }}</td>
                    <td>

                        @if ($banner->is_available == 1)

                            <a href="javascript:void(0)" tooltip="{{trans('labels.active')}}"  @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/'.$url.'/status_change-'.$banner->id.'/2')}}')" @endif class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-check"></i></a> 

                        @else

                            <a href="javascript:void(0)" tooltip="{{trans('labels.inactive')}}"  @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="statusupdate('{{ URL::to('admin/'.$url.'/status_change-'.$banner->id.'/1')}}')" @endif class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-xmark"></i> </a> 

                        @endif

                    </td>
                    <td>{{ helper::date_formate($banner->created_at, $banner->vendor_id) }}<br>
                        {{ helper::time_formate($banner->created_at, $banner->vendor_id) }}
                    </td>
                    <td>{{ helper::date_formate($banner->updated_at, $banner->vendor_id) }}<br>
                        {{ helper::time_formate($banner->updated_at, $banner->vendor_id) }}
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a tooltip="{{trans('labels.edit')}}" href="{{ URL::to('admin/'.$url.'/edit-'.$banner->id) }}" class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                            <a tooltip="{{trans('labels.delete')}}" href="javascript:void(0)"  @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="deletedata('{{ URL::to('admin/'.$url.'/delete-'.$banner->id)}}')" @endif class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-trash"></i></a> 
                        </div>

                    </td>

                </tr>

                @endif

            @endforeach

    </tbody>

</table>


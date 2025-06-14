<table class="table table-striped table-bordered py-3 zero-configuration w-100">

    <thead>

        <tr class="text-uppercase fw-500">
            <td></td>
            <td>{{trans('labels.srno')}}</td>

            <td>{{trans('labels.area_name')}}</td>

            <td>{{trans('labels.delivery_charge')}}</td>

            <td>{{trans('labels.status')}}</td>
            <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
            <td>{{trans('labels.action')}}</td>

        </tr>

    </thead>

    <tbody id="tabledetails" data-url="{{ url('admin/shipping-area/reorder_shipping_area') }}">

       @php $i=1; @endphp

        @foreach ($getshippingarealist as $shippingarea)

        <tr class="fs-7 align-middle row1" id="dataid{{ $shippingarea->id }}" data-id="{{ $shippingarea->id }}">
            <td><a tooltip="{{trans('labels.move')}}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>

            <td>@php echo $i++ @endphp</td>

            <td>{{$shippingarea->name}}</td>

            <td>{{helper::currency_formate($shippingarea->delivery_charge,$shippingarea->vendor_id)}}</td>

            <td>

                @if($shippingarea->is_available == 1)
                
                    <a tooltip="{{ trans('labels.active') }}" @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/shipping-area/status-'.$shippingarea->id.'-2')}}')" @endif class="btn btn-outline-success btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i class="fa-regular fa-check"></i> </a>

                @else

                    <a tooltip="{{ trans('labels.inactive') }}" @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{URL::to('admin/shipping-area/status-'.$shippingarea->id.'-1')}}')" @endif class="btn btn-outline-danger btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-xmark"></i> </a>

                @endif

            </td>
            <td>{{ helper::date_formate($shippingarea->created_at, $shippingarea->vendor_id) }}<br>
                                            {{ helper::time_formate($shippingarea->created_at, $shippingarea->vendor_id) }}
                                   </td>
                                    <td>{{ helper::date_formate($shippingarea->updated_at, $shippingarea->vendor_id) }}<br>
                                          {{ helper::time_formate($shippingarea->updated_at, $shippingarea->vendor_id) }}
                                   </td>
            <td>
                <div class="d-flex gap-2">
                    <a tooltip="{{trans('labels.edit')}}" href="{{URL::to('admin/shipping-area/show-'.$shippingarea->id)}}" class="btn btn-info hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                    <a tooltip="{{trans('labels.delete')}}"  @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="deletedata('{{URL::to('admin/shipping-area/delete-'.$shippingarea->id)}}')" @endif class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}"> <i class="fa-regular fa-trash"></i></a>
                </div>
            </td>

        </tr>

        @endforeach

    </tbody>

</table>
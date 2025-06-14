@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.products') }}</h5>
        <div class="d-flex">
            <a href="{{ URL::to('admin/products/add') }}"
                class="btn btn-secondary px-sm-4 text-capitalize d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
            </a>
            @if ($getproductslist->count() > 0)
                <a href="{{ URL::to('/admin/exportproduct') }}"
                    class="btn btn-secondary px-sm-4 d-flex text-capitalize {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }} mx-2">{{ trans('labels.export') }}</a>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td>{{ trans('labels.srno') }}</td>
                                    <td>{{ trans('labels.image') }}</td>
                                    <td>{{ trans('labels.category') }}</td>
                                    <td>{{ trans('labels.name') }}</td>
                                    <td>{{ trans('labels.price') }}</td>
                                    <td>{{ trans('labels.stock') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="{{ url('admin/products/reorder_category') }}">
                                @php $i = 1; @endphp
                                @foreach ($getproductslist as $product)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $product->id }}"
                                        data-id="{{ $product->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php echo $i++; @endphp</td>
                                        <td>
                                            @if ($product['product_image'] == null)
                                                <img src="{{ helper::image_path('product.png') }}"
                                                    class="img-fluid rounded hw-50" alt="">
                                            @else
                                                <img src="{{ @$product['product_image']->image_url }}"
                                                    class="img-fluid rounded hw-50" alt="">
                                            @endif
                                        </td>
                                        <td>{{ @$product['category_info']->name }}</td>
                                        <td>{{ $product->name }} <br>
                                            @if ($product->view_count > 0)
                                                <span class="badge bg-success"><i class="fa-solid fa-eye"></i>
                                                    {{ $product->view_count }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->has_variation == 1)
                                                <span class="badge bg-info">{{ trans('labels.in_variants') }}</span><br>
                                            @else
                                                {{ helper::currency_formate($product->price, $vendor_id) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->has_variation == 1)
                                                <span class="badge bg-info">{{ trans('labels.in_variants') }}</span><br>
                                                @if (helper::checklowqty($product->id, $product->vendor_id) == 1)
                                                    <span class="badge bg-warning">{{ trans('labels.low_qty') }}</span>
                                                @endif
                                            @else
                                                @if ($product->stock_management == 1)
                                                    @if (helper::checklowqty($product->id, $product->vendor_id) == 1)
                                                        <span
                                                            class="badge bg-success">{{ trans('labels.in_stock') }}</span><br>
                                                        <span class="badge bg-warning">{{ trans('labels.low_qty') }}</span>
                                                    @elseif(helper::checklowqty($product->id, $product->vendor_id) == 2)
                                                        <span
                                                            class="badge bg-danger">{{ trans('labels.out_of_stock') }}</span>
                                                    @elseif(helper::checklowqty($product->id, $product->vendor_id) == 3)
                                                        -
                                                    @else
                                                        <span
                                                            class="badge bg-success">{{ trans('labels.in_stock') }}</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            @endif

                                        </td>
                                        <td>
                                            @if ($product->is_available == '1')
                                                <a tooltip="{{ trans('labels.active') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="statusupdate('{{ URL::to('admin/products/status_change-' . $product->slug . '/2') }}')" @endif
                                                    class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-check"></i></a>
                                            @else
                                                <a tooltip="{{ trans('labels.inactive') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/products/status_change-' . $product->slug . '/1') }}')" @endif
                                                    class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ helper::date_formate($product->created_at, $product->vendor_id) }}<br>
                                            {{ helper::time_formate($product->created_at, $product->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($product->updated_at, $product->vendor_id) }}<br>
                                            {{ helper::time_formate($product->updated_at, $product->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a tooltip="{{ trans('labels.edit') }}"
                                                    class="btn btn-info btn-sm hov {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    href="{{ URL::to('admin/products/edit-' . $product->slug) }}"> <i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <a tooltip="{{ trans('labels.delete') }}"
                                                    class="btn btn-danger btn-sm hov {{ Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/products/delete-' . $product->slug) }}')" @endif>
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

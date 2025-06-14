@php
      if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
@endphp

@if (env('Environment') == 'sendbox')
<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize">
            <th class="fs-15 fw-500">{{ trans('labels.image') }}</th>
            <th class="fs-15 fw-500">{{ trans('labels.name') }}</th>
            <th class="fs-15 fw-500">{{ trans('labels.variants') }}</th>
            <th class="fs-15 fw-500">{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $i => $product)
            <tr class="fs-7 align-middle row1" id="dataid{{ $product->id }}" data-id="{{ $product->id }}">
                <td><img src="{{ @helper::image_path($product['product_image']->image) }}"
                        class="img-fluid rounded hw-50 object-fit-cover" alt=""> </td>

                <td>{{ $product->name }}</td>
                <td>
                <span class="badge bg-info">{{ trans('labels.in_variants') }}</span><br>
                </td>
                <td>
                    <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else href="{{ URL::to('admin/shopify-products/add-' . $product_data['id']) }}" @endif tooltip="{{ trans('labels.add_product') }}"
                    {{-- {{ trans('labels.add_product') }} --}}
                        class="btn btn-info hov btn-sm"> <i class="fa-solid fa-plus"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize">
            <th class="fs-15 fw-500">#</th>
            <th class="fs-15 fw-500">{{ trans('labels.image') }}</th>
            <th class="fs-15 fw-500">{{ trans('labels.name') }}</th>
            <th class="fs-15 fw-500">{{ trans('labels.variants') }}</th>
            <th class="fs-15 fw-500">{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $key => $data)
                @foreach ($data as $key => $product_data)
                    <tr class="fs-7 align-middle">
                        <td> {{ $key+1 }} </td>
                        <td> <img src="{{$product_data['image']['src']}}" alt="" width="100"> </td>
                        <td> {{ $product_data['title'] }} </td>
                        <td> 
                        @if($product_data['variants']['0']['title'] != 'Default Title')
                            <span class="badge bg-info">{{ trans('labels.in_variants') }}</span>
                        @endif
                        </td>
                        <td>
                            <a href="{{ URL::to('admin/shopify-products/add-' . $product_data['id']) }}" 
                            tooltip="{{ trans('labels.add_product') }}"
                                class="btn btn-info hov btn-sm"> <i class="fa-solid fa-plus"></i></a>
                        </td>
                    </tr>
                @endforeach
        @endforeach
    </tbody>
</table>
@endif
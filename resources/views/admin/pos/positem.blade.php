@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
<input type="hidden" id="cat_id" value="{{ @$cat_id }}" />
@if (count($getproduct) > 0)
    <div class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2 g-3 p-2">
        @foreach ($getproduct as $item)
            <div class="col">
                @php
                    $price = 0;
                    $image = $item['product_image'] == null ? 'product.png' : $item['product_image']->image;
                @endphp
                @php
                    if ($item['multi_variation']->count() > 0) {
                        $price = $item['multi_variation'][0]->price;
                        $original_price = $item['multi_variation'][0]->original_price;
                    } else {
                        $price = $item->price;
                        $original_price = $item->original_price;
                    }
                    $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
                @endphp
                <a href="javascript:void(0);" onclick='showitems("{{ $item->id }}")'>
                    <div class="card h-100 w-100 border rounded-4 overflow-hidden" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        @if (@$item['product_image']->image == null)
                            <img src="{{ helper::image_path('product.png') }}" alt="product image"
                                class="card-img-top imgs object position-relative">
                        @else
                            <img src="{{ $item['product_image']->image_url }}" alt="product image"
                                class="card-img-top imgs object position-relative">
                        @endif
                        @if ($off > 0)
                            <div class="offer-box position-absolute">
                                <p class="m-0">{{ $off }}%</p>
                            </div>
                        @endif
                        <div class="card-body px-2 py-1">
                            <h5 class="product-name ">
                                <a href="#" class="card-text fs-7 fw-semibold text-dark mb-0 mt-2 line-2">
                                    {{ $item->name }}
                                </a>
                            </h5>
                        </div>
                        <div class="card-footer bg-transparent border-0 px-2 pb-2 pt-0">
                            @if ($item->stock_management == 1)
                                @if (helper::checklowqty($item->id, $vendor_id) == 2 && $item->has_variation != 1)
                                    <div class="d-flex align-items-center my-1 gap-1">
                                        <span class="d-flex justify-content-center font-8px text-danger">
                                            <i class="fa-solid fa-circle"></i>
                                        </span>
                                        <span class="text-danger fs-8">
                                            {{ trans('labels.out_of_stock') }}
                                        </span>
                                    </div>
                                @endif
                            @endif
                            <div class="col-12 my-1">
                                <small
                                    class="fs-15 fw-600 text-dark mb-0 mt-1 d-flex flex-wrap lh-1 align-items-center gap-1">
                                    {{ helper::currency_formate($price, $vendor_id) }}
                                    @if ($original_price > $price)
                                        <del
                                            class="fs-7 text-muted fw-medium">{{ helper::currency_formate($original_price, $vendor_id) }}</del>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@else
    <section>
        <div class="d-flex justify-content-center align-items-center h-100vh position-static">
            <p class="text-muted text-center fs-2">{{ trans('labels.data_not_found') }}</p>
        </div>
    </section>
@endif

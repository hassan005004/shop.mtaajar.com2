<div class="view-cart-bar-2">
    <section class="view-cart-bar d-none">
        <div class="container">
            <div class="row g-2 align-items-center">
                <div class="col-xl-6 col-md-6">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="product-img">
                            <img src="{{ helper::image_path($productdata['product_image']->image) }}" class="rounded">
                        </div>
                        <div>
                            <h6 class="text-dark line-2 fw-600 my-1">
                                {{ $productdata->name }}</h6>
                            <div class="d-flex gap-1 flex-wrap align-items-center">
                                <span class="fs-15 fw-600" id="modal_product_price">
                                    {{ helper::currency_formate($price, $productdata->vendor_id) }} </span>
                                @if ($original_price > $price)
                                    <del class="text-muted fw-500 fs-8 product-original-price"
                                        id="modal_product-original-price">{{ helper::currency_formate($original_price, $productdata->vendor_id) }}</del>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="row g-2 justify-content-end">
                        <div class="col-md-3 col-12">
                            <div
                                class="input-group qty-input2 small w-100 h-100 justify-content-center responsive-margin m-0 rounded-0 hight-modal-btn align-items-center">
                                <button class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                    data-item_id="{{ $productdata->id }}"
                                    onclick="changeqty($(this).attr('data-item_id'),'minus')"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <input type="number" class="border text-center item_qty_{{ $productdata->id }}"
                                    name="number" value="1" readonly>
                                <button class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                    data-item_id="{{ $productdata->id }}"
                                    onclick="changeqty($(this).attr('data-item_id'),'plus')"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <button class="btn m-0 py-2 btn-secondary rounded-0 w-100 addtocart"
                                onclick="addtocart('{{ $productdata->id }}','{{ $productdata->slug }}','{{ $productdata->name }}','{{ $productdata['product_image']->image }}','{{ $productdata->tax }}',$('#overview_item_price').val(),'{{ ucfirst($productdata->attribute) }}','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                <span class="px-1 fs-7">{{ trans('labels.add_to_cart') }}</span>
                            </button>
                        </div>
                        <div class="col-md-4 col-12">
                            <button class="btn btn-lg m-0 bg-white border-dark rounded-0 w-100 fs-6 text-dark buynow"
                                onclick="addtocart('{{ $productdata->id }}','{{ $productdata->slug }}','{{ $productdata->name }}','{{ $productdata['product_image']->image }}','{{ $productdata->tax }}',$('#overview_item_price').val(),'{{ ucfirst($productdata->attribute) }}','{{ URL::to(@$vendordata->slug . '/cart/add') }}','1')">
                                <span class="px-1 fs-7">{{ trans('labels.buy_now') }}</span>
                            </button>
                        </div>
                        <div class="col-md-1 col-12">
                            <button class="border border-dark m-0 h-100 rounded-0 close-btn-view" id="close-btn2">
                                <i class="fa-regular fa-xmark fs-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

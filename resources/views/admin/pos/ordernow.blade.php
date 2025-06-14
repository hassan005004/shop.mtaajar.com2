@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
<div class="modal-header py-2">
    <div class="modal-title d-flex justify-content-between col-12 fs-5" id="exampleModalLabel">
        <div class="col-lg-11 text-center">
            <div class="fw-semibold text-dark my-3">
                {{ trans('labels.order_confirmation') }}
            </div>
        </div>
        <div class="col-lg-1 d-flex justify-content-end">
            <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal">
                <i class="fa-regular fa-xmark fs-4"></i>
            </button>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="col-12">
        <div class="col-12 py-2 border-bottom">
            <p class="m-0 mb-1 fs-7 text-dark fw-medium"> {{ trans('labels.order_information') }} </p>
        </div>
        <div>
            <div class="text-secondary row justify-content-between py-2 border-bottom">
                <div class="col-sm-8 col-7">
                    <div class="d-flex gap-2 justify-content-between">
                        <div class="col-6 fs-13 fw-600 text-black px-2">
                            {{ trans('labels.items') }}
                        </div>
                        <div class="col-2 pe-3 fs-13 fw-600 text-center text-black">
                            {{ trans('labels.qty') }} </div>
                    </div>
                </div>
                <div class="col-sm-4 col-5">
                    <div class="d-flex">
                        <div class="col-4 fs-13 fw-600 text-end text-black">
                            {{ trans('labels.price') }} </div>
                        <div class="col-8 fs-13 fw-600 text-end text-black">
                            {{ trans('labels.sub_total') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-product-2">
            <div class="table-responsive">
                <table class="table mb-0">
                    <tbody>
                        @foreach ($cartitems as $item)
                            <tr class="align-middle">
                                <td class="py-3">
                                    <h6 class="line-2 m-0 fw-500 fs-13">{{ $item->product_name }}</h6>
                                    <p class="m-0 line-2 text-muted fs-8">{{ $item->extras_name }}</p>
                                </td>
                                <td class="py-3 text-end">
                                    <div class="product-text-size d-flex align-items-center justify-content-end">
                                        <p class="m-0 fw-500 text-dark">{{ $item->qty }}</p>
                                    </div>
                                </td>
                                <td class="py-3 text-end">
                                    <p class="fw-500 text-dark line-1 m-0 product-text-size">
                                        {{ helper::currency_formate($item->price, $vendor_id) }}</p>
                                </td>
                                <td class="py-3 text-end">
                                    @php
                                        $subtotal = $item->product_price * $item->qty;
                                    @endphp
                                    <p class="fw-500 text-dark line-1 m-0 product-text-size">
                                        {{ helper::currency_formate($subtotal, $vendor_id) }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 my-3 d-flex flex-column flex-md-row justify-content-between">
        <div class="col-12 col-md-6 py-2 px-2 bg-light-subtle rounded notes-box">
            <div class="col-12">
                <form>
                    <label for="message-text" class="col-form-label fs-7 text-dark fw-medium">
                        {{ trans('labels.order_notes') }} </label>
                    <textarea class="form-control modal-price text-area" placeholder="Add note(with extra Instructions) "
                        id="cart_order_note" style="height: 100px"></textarea>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-2 mt-md-0 d-flex flex-column justify-content-between">
            <div class="col-12 py-2 px-2">
                <div class="d-flex justify-content-between my-1 py-1">
                    <span class="fw-600 fs-13">{{ trans('labels.sub_total') }}</span>
                    <span class="fw-600 fs-13 text-dark" id="ordersub_total"></span>
                </div>
                <div class="text-muted fw-500">
                    <div class="d-flex justify-content-between my-1 @if (session()->get('discount') == 0) d-none @endif">
                        <span class="text-sm">{{ trans('labels.discount') }}</span>
                        <span class="text-sm" id="orderdiscount_amount"></span>
                    </div>
                    <div class="d-flex justify-content-between my-1">
                        <span class="text-sm " id="ordertax_name"></span>
                        <span class="text-sm " id="ordertax_rate"></span>
                        <span id="hiddentax_name" class="d-none"></span>
                        <span id="hiddentax_rate" class="d-none"></span>
                    </div>
                </div>
                <div class="d-flex justify-content-between fs-7 border-top py-1">
                    <span class="fw-semibold text-dark">{{ trans('labels.total') }}</span>
                    <span class="fw-semibold text-dark" id="ordergrand_total"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 border-top py-3 border-bottom">
        <p class="m-0 pb-2 fs-7 text-dark fw-medium"> {{ trans('labels.customer_information') }} </p>
        <form class="row g-3 m-0">
            <div class="col-md-4 m-0 customer">
                <label for="validationCustom01" class="form-label mb-1 from-name"> {{ trans('labels.full_name') }}
                </label>
                <input type="text" class="form-control fs-8 py-2" placeholder="Full Name" id="customer_name"
                    value="{{ @$customers1->name }}" required>
                <span class="text-danger fs-7" id="customer_name_required"></span>

            </div>
            <div class="col-md-4 m-0 customer">
                <label for="validationCustom02" class="form-label mb-1 from-name">{{ trans('labels.email') }}</label>
                <input type="text" class="form-control fs-8 py-2" placeholder="Email" id="customer_email"
                    value="{{ @$customers1->email }}" required>
                <span class="text-danger fs-7" id="customer_email_required"></span>
            </div>
            <div class="col-md-4 m-0 customer">
                <label for="validationCustomUsername" class="form-label mb-1 from-name">
                    {{ trans('labels.mobile') }}
                </label>
                <input type="number" class="form-control fs-8 py-2" id="customer_phone"
                    aria-describedby="inputGroupPrepend" placeholder="Mobile" value="{{ @$customers1->mobile }}"
                    required>
                <span class="text-danger fs-7" id="customer_phone_required"></span>
            </div>
        </form>
    </div>
    <div class="col-12 pt-3">
        <p class="m-0 mb-1 fs-7 text-dark fw-medium"> {{ trans('labels.Payment_information') }} </p>
        <div class="col-12 d-flex gap-4">
            <div class="form-check form-check-inline m-0">
                <input class="form-check-input mb-1" type="radio" name="payment_type" id="inlineRadio1"
                    value="1">
                <label class="form-check-label modal-price fw-500"
                    for="inlineRadio1">{{ trans('labels.cash') }}</label>
            </div>
            <div class="form-check form-check-inline m-0">
                <input class="form-check-input mb-1" type="radio" name="payment_type" id="inlineRadio2"
                    value="0">
                <label class="form-check-label modal-price fw-500"
                    for="inlineRadio2">{{ trans('labels.online') }}</label>
            </div>
        </div>
        <span class="text-danger fs-7" id="payment_type_required"></span>
    </div>
</div>

<div class="modal-footer justify-content-center">
    <div class="col-12 m-0">
        <div class="row gx-2 align-items-center justify-content-between">
            <div class="col-6">
                <button type="button" class="btn btn-danger fw-500 close-btn border-0 fs-7 total-pay mt-2 mt-lg-0"
                    data-bs-dismiss="modal">{{ trans('labels.close') }}</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary fw-500 border-0 fs-7 total-pay mt-2 mt-lg-0"
                    onclick="placeorder('{{ URL::to('admin/pos/placeorder') }}')">{{ trans('labels.confirm') }}</button>
            </div>
        </div>
    </div>
</div>

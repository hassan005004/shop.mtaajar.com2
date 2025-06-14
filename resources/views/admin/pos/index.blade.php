@extends('admin.layout.pos_header')
@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp
    <nav class="navbar navbar-expand-lg bg-white underline fixed-top position-sticky">
        <div class="container-fluid gap-2">
            <div class="col-lg-4 col-md-4 d-none d-md-block d-flex flex-column">
                <p class="fs-4 fw-semibold m-0 text-dark line-1">{{ trans('labels.pos_welcome_title') }}</p>
                <p class="fs-7 fw-normal m-0 line-1">{{ trans('labels.pos_welcome_description') }}</p>
            </div>
            <div class="col d-flex justify-content-start justify-content-md-center">
                <a class="navbar-brand m-0 d-flex justify-content-start justify-content-md-center"
                    href="{{ URL::to('admin/dashboard') }}">
                    <img src="{{ helper::image_path(helper::appdata($vendor_id)->logo) }}" class="img-fluid object logo-size"
                        alt="">
                </a>
            </div>
            <div class="col-lg-4 col-6 col-sm-8 col-md-4 d-sm-block d-none">
                <div class="input-group gap-0 rounded">
                    <div class="input-group">
                        <span
                            class="input-group-text bg-white {{ session()->get('direction') == 2 ? 'rounded-start-0 rounded-end' : 'rounded-end-0 rounded-start' }}">
                            <i class="fa-light fa-magnifying-glass fs-7"></i>
                        </span>
                        <input type="hidden" class="form-control fs-10 p-2" value="{{ url('admin/pos') }}" id="search-url">
                        <input type="text" class="form-control fs-10 p-2" placeholder="{{ trans('labels.search_item') }}"
                            value="" id="search-keyword" name="search-keyword">
                        <button
                            class="input-group-text btn fs-7 fw-500 btn-primary {{ session()->get('direction') == 2 ? 'rounded-end-0 rounded-start' : 'rounded-start-0 rounded-end' }}">
                            {{ trans('labels.search') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ URL::to('admin/dashboard') }}" class="btn btn-primary"><i class="fa-light fa-house"></i></a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <input type="hidden" id="showitemurl" value="{{ url('admin/pos/item-details') }}" />
        <input type="hidden" id="deletecarturl" value="{{ URL::to('admin/pos/cart/deletecartitem') }}" />
        <input type="hidden" id="cartViewUrl" value="{{ url::to('admin/pos/cartview') }}" />

        @if ($cartitems->count() > 0)
            <button id="cart_btn" onclick="callcartview()"
                class="position-fixed cart-btn border border-1 z-3 text-light rounded-circle {{ session()->get('direction') == 2 ? 'cart-btn-right' : 'cart-btn-left' }}"
                aria-controls="staticBackdrop" type="button">
                <div class="cart-count bg-dark rounded-circle d-flex align-items-center justify-content-center">
                    {{ $cartitems->count() }}</div>
                <i class="fa-regular fa-cart-plus fs-4"></i>
            </button>
        @endif

        <div
            class="sidebares {{ session()->get('direction') == 2 ? 'sidebares-right' : 'sidebares-left' }} bg-white d-md-block d-flex">
            <ul class="nav d-contents d-contents-flex gap-3 d-flex flex-nowrap flex-md-column  px-lg-1" id="myDIV">
                <li class="nav-item">
                    <div class="d-flex sidebr-box align-items-center actives justify-content-center text-center cursor-pointer"
                        onclick="categories_filter('','{{ url('admin/pos') }}')" id="cat">
                        <a class="d-flex flex-column gap-1 fw-500">
                            <span class="category-name">
                                A
                            </span>
                            <p class="line-2 fs-8 m-0 lh-sm text-capitalize fw-500">{{ trans('labels.all_category') }}</p>
                        </a>
                    </div>
                </li>
                @foreach ($getcategory as $category)
                    <li class="nav-item">
                        <div class="d-flex sidebr-box align-items-center justify-content-center text-center cursor-pointer"
                            id="cat-{{ $category->id }}"
                            onclick="categories_filter('{{ $category->id }}','{{ url('admin/pos') }}')">
                            <a class="d-flex flex-column gap-1 fw-500">
                                <span class="category-name">
                                    <img src="{{ helper::image_path($category->image) }}" class="img-fluid rounded hw-50"
                                        alt="">
                                </span>
                                <p class="line-2 lh-sm fs-8 fw-500 m-0 text-capitalize">{{ $category->name }}</p>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="{{ session()->get('direction') == 2 ? 'main-product-right' : 'main-product' }} pt-2">
            <div id="pos-item">
                @include('admin.pos.positem')
            </div>
        </div>
    </div>

    <div id="cartItemsContainer">
        @include('admin.pos.cartview')
    </div>

    <div class="modal fade" id="orderButton" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" id="OrderNowContainer"></div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div
                    class="modal-body d-flex justify-content-center align-items-center position-relative flex-column line-2">
                    <img src="{{ url('storage/app/public/admin-assets/images/success.svg') }}" alt=""
                        class="w-50 object">
                    <h5 class="mt-3 m-0 fw-medium line-2 text-center text-dark">{{ trans('labels.thank_you_title') }}
                    </h5>
                    <p class="text-center m-0 fs-13 mt-3 line-2 lh-lg">{{ trans('labels.thank_you_note') }}</p>
                </div>
                <div class="modal-footer p-4 border-0 justify-content-center">
                    <div class="col-12 m-0">
                        <div class="row gx-2 flex-wrap align-items-center justify-content-between">
                            <div class="col-md-6 order_success">
                                <a type="button" id="order_id" target="new"
                                    class="rounded border fw-500 w-100 border-dark fs-13 total-pay1 text-dark text-center bg-gray mt-2 mt-lg-0">{{ trans('labels.view_order') }}</a>
                            </div>
                            <div class="col-md-6 order_success">
                                <a href="{{ URL::to('admin/pos') }}" id="button2"
                                    class="w-100 fw-500 rounded btn-primary btn fs-13 total-pay1 mt-2 mt-lg-0">{{ trans('labels.continue_shopping') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var title = "{{ trans('messages.are_you_sure') }}";
        var yes = "{{ trans('messages.yes') }}";
        var no = "{{ trans('messages.no') }}";
        var discounturl = "{{ URL::to('admin/pos/discount') }}";
        var removediscounturl = "{{ URL::to('admin/pos/remove-discount') }}";

        function currency_formate(price) {

            if ("{{ @helper::appdata($vendor_id)->currency_position }}" == "1") {

                if ("{{ helper::appdata($vendor_id)->decimal_separator }}" == 1) {
                    if ("{{ helper::appdata($vendor_id)->currency_space }}" == 1) {
                        return "{{ @helper::appdata($vendor_id)->currency }}" + " " + parseFloat(price).toFixed(
                            "{{ helper::appdata($vendor_id)->currency_formate }}");
                    } else {
                        return "{{ @helper::appdata($vendor_id)->currency }}" + parseFloat(price).toFixed(
                            "{{ helper::appdata($vendor_id)->currency_formate }}");
                    }

                } else {
                    if ("{{ helper::appdata($vendor_id)->currency_space }}" == 1) {
                        var newprice = "{{ @helper::appdata($vendor_id)->currency }}" + " " + (parseFloat(price).toFixed(
                            "{{ helper::appdata($vendor_id)->currency_formate }}"));
                    } else {
                        var newprice = "{{ @helper::appdata($vendor_id)->currency }}" + (parseFloat(price).toFixed(
                            "{{ helper::appdata($vendor_id)->currency_formate }}"));
                    }
                    newprice = newprice.replace('.', ',');
                    return newprice;
                }
            } else {
                if ("{{ helper::appdata($vendor_id)->decimal_separator }}" == 1) {
                    if ("{{ helper::appdata($vendor_id)->currency_space }}" == 1) {
                        return parseFloat(price).toFixed("{{ helper::appdata($vendor_id)->currency_formate }}") + " " +
                            "{{ @helper::appdata($vendor_id)->currency }}";
                    } else {
                        return parseFloat(price).toFixed("{{ helper::appdata($vendor_id)->currency_formate }}") +
                            "{{ @helper::appdata($vendor_id)->currency }}";
                    }
                } else {
                    if ("{{ helper::appdata($vendor_id)->currency_space }}" == 1) {
                        var newprice = (parseFloat(price).toFixed("{{ helper::appdata($vendor_id)->currency_formate }}")) +
                            " " + "{{ @helper::appdata($vendor_id)->currency }}";
                    } else {
                        var newprice = (parseFloat(price).toFixed("{{ helper::appdata($vendor_id)->currency_formate }}")) +
                            "{{ @helper::appdata($vendor_id)->currency }}";
                    }
                    newprice = newprice.replace('.', ',');
                    return newprice;
                }
            }
        }
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/pos.js') }}" type="text/javascript"></script>
@endsection

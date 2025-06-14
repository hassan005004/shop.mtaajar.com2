@extends('web.layout.default')
@section('contents')

    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    @if (!empty($productdata))
                        <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                            <a class="text-dark"
                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . $productdata['category_info']->slug) }}">{{ $productdata['category_info']->name }}</a>
                        </li>
                        @if (!empty($productdata['subcategory_info']))
                            <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                                <a class="text-dark "
                                    href="{{ URL::to(@$vendordata->slug . '/category?category=' . $productdata['category_info']->slug . '&subcategory=' . $productdata['subcategory_info']->slug) }}">{{ $productdata['subcategory_info']->name }}</a>
                            </li>
                        @endif
                        <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                            aria-current="page">{{ $productdata->name }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    @if (!empty($productdata))
        @php
            if ($productdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
                if (@helper::top_deals($vendordata->id)->offer_type == 1) {
                    $price = $productdata->price - @helper::top_deals($vendordata->id)->offer_amount;
                } else {
                    $price =
                        $productdata->price -
                        $productdata->price * (@helper::top_deals($vendordata->id)->offer_amount / 100);
                }
                $original_price = $productdata->price;
            } else {
                $price = $productdata->price;
                $original_price = $productdata->original_price;
            }
            $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
        @endphp
        <!-- PRODUCTS VIEW AREA START -->
        <section class="product-view p-0 mt-5">
            <div class="container">
                <div class="row g-4 g-md-5">

                    <div class="col-md-5 mb-5">
                        <div class="card h-100 overflow-hidden rounded-0 border-0 position-relative">
                            <!-- new big-view -->
                            <div class="sp-loading"><img src="https://via.placeholder.com/1100x1220"
                                    alt=""><br>LOADING IMAGES</div>
                            <div class="sp-wrap">
                                @foreach ($productdata['multi_image'] as $key => $image)
                                    <a href="{{ $image->image_url }}">
                                        <img src="{{ $image->image_url }}" alt="">
                                    </a>
                                @endforeach
                            </div>
                            <!-- new big-view -->
                        </div>
                    </div>
                    <div class="col-md-7 mb-4">
                        <div class="product-content px-md-0">
                            @if ($off > 0)
                                <span class="badge text-bg-primary fs-7 mb-2 rounded-0" id="modal_price-off">
                                    {{ $off }} % {{ trans('labels.off') }}
                                </span>
                            @endif
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="text-dark product-title line-2 fs-4 fw-600 my-1">
                                    {{ $productdata->name }}</h2>
                            </div>

                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-sm-0 mb-1">
                                <div
                                    class="product-detail-price {{ $productdata->is_available == 2 || $productdata->is_deleted == 1 ? 'd-none' : '' }}">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="pro-text" id="modal_product_price">
                                            {{ helper::currency_formate($price, $productdata->vendor_id) }} </span>
                                        @if ($original_price > $price)
                                            <del class="text-muted px-1 fw-500 fs-15 product-original-price"
                                                id="modal_product-original-price">{{ helper::currency_formate($original_price, $productdata->vendor_id) }}</del>
                                        @endif
                                    </div>
                                </div>

                                <!-- rating star section Start -->
                                @if (@helper::checkaddons('product_reviews'))
                                    @if (@helper::checkaddons('customer_login'))
                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                            <div class="d-flex px-sm-2 px-0 py-1 rounded-0 align-items-center p-0 m-0">
                                                <p class="fs-7"><i
                                                        class="text-warning fa-solid fa-star {{ session()->get('direction') == 2 ? 'ps-1' : 'pe-1' }}"></i><span
                                                        class="text-dark fw-500">{{ number_format($averagerating, 1) }}</span>
                                                </p>
                                                <span
                                                    class="px-2 d-inline-block text-muted fw-400 fs-15">({{ $totalreview }}
                                                    {{ trans('labels.reviews') }})</span>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            <input type="hidden" name="vendor" id="overview_vendor"
                                value="{{ $productdata->vendor_id }}">
                            <input type="hidden" name="item_id" id="overview_item_id" value="{{ $productdata->id }}">
                            <input type="hidden" name="item_name" id="overview_item_name"
                                value="{{ $productdata->name }}">
                            <input type="hidden" name="item_image" id="overview_item_image"
                                value="{{ @$productdata['product_image']->image }}">
                            <input type="hidden" name="item_min_order" id="item_min_order"
                                value="{{ $productdata->min_order }}">
                            <input type="hidden" name="item_max_order" id="item_max_order"
                                value="{{ $productdata->max_order }}">
                            <input type="hidden" name="item_price" id="item_price" value="{{ $price }}">
                            <input type="hidden" name="item_original_price" id="overview_item_original_price"
                                value ="{{ $original_price }}">
                            <input type="hidden" name="tax" id="tax_val" value="{{ $productdata->tax }}">
                            <input type="hidden" name="variants_name" id="variants_name" value="">
                            <input type="hidden" name="stock_management" id="stock_management"
                                value="{{ $productdata->stock_management }}">
                            <input type="hidden" name="qtyurl" id="qtyurl" value="{{ URL::to('/changeqty') }}">
                            <p id="laodertext" class="d-none laodertext"></p>
                            <!-- rating star section End -->
                            @if ($productdata->has_variation == 2)
                                @if ($productdata->is_available == 2 || $productdata->is_deleted == 1)
                                    <h3 class="text-danger">{{ trans('labels.not_available') }}</h3>
                                @endif
                            @else
                                <h3 class="text-danger" id="detail_not_available_text"></h3>
                            @endif
                            <p id="tax" class="py-1">
                                @if ($productdata->tax != null && $productdata->tax != '')
                                    <span class="text-danger text-truncate"> {{ trans('labels.exclusive_taxes') }}
                                    </span>
                                @else
                                    <span class="text-success text-truncate"> {{ trans('labels.inclusive_taxes') }}</span>
                                @endif
                            </p>
                            @if (@helper::checkaddons('fake_view'))
                                @if (helper::appdata($vendordata->id)->product_fake_view == 1)
                                    @php

                                        $var = ['{eye}', '{count}'];
                                        $newvar = [
                                            "<i class='fa-solid fa-eye'></i>",
                                            rand(
                                                helper::appdata($vendordata->id)->min_view_count,
                                                helper::appdata($vendordata->id)->max_view_count,
                                            ),
                                        ];

                                        $fake_view = str_replace(
                                            $var,
                                            $newvar,
                                            helper::appdata($vendordata->id)->fake_view_message,
                                        );
                                    @endphp
                                    <div class="d-flex gap-1 align-items-center blink_me mb-2">
                                        <p class="fw-600 text-success m-0">{!! $fake_view !!}</p>
                                    </div>
                                @endif
                            @endif
                            @if (
                                $productdata->sku != '' ||
                                    ($productdata->has_variation == 2 && $productdata->stock_management == 1) ||
                                    $productdata->attchment_name != '')
                                <div class="border-bottom pb-3 d-block ">
                                    <div class="bg-gray-light p-3 mt-3 rounded-0">
                                        @if ($productdata->sku != '' && $productdata->sku != null)
                                            <div class="row">
                                                <p class="text-dark">
                                                    <span class="fs-7 fw-semibold">{{ trans('labels.sku') }}</span> :
                                                    <span class="text-muted fs-7"
                                                        id="sku">{{ $productdata->sku }}</span>
                                                </p>
                                            </div>
                                        @endif
                                        @if ($productdata->has_variation == 2 && $productdata->stock_management == 1)
                                            <div class="sku-wrapper product_meta" id="stock">
                                                <span class="fs-7 fw-semibold">{{ trans('labels.stock') }}:</span>

                                                @if ($productdata->qty > 0)
                                                    <span class="text-success fs-7">{{ $productdata->qty }}
                                                        {{ trans('labels.in_stock') }}</span>
                                                @else
                                                    <span
                                                        class="text-danger fs-7">{{ trans('labels.out_of_stock') }}</span>
                                                @endif
                                            </div>
                                        @elseif ($productdata->has_variation == 1)
                                            <div class="sku-wrapper product_meta" id="stock">
                                                <span class="fs-7 fw-semibold text-dark">{{ trans('labels.stock') }}:
                                                </span>
                                                <span class="fs-7" id="detail_out_of_stock"></span>
                                            </div>
                                        @endif
                                        @if ($productdata->attchment_name != '' && $productdata->attchment_name != null)
                                            <div>
                                                @if ($productdata->attchment_name != '' && $productdata->attchment_name != null)
                                                    <a href="{{ $productdata->attchment_url }}" target="_blank"
                                                        class="text-dark">
                                                        <p class="fs-7 fw-semibold d-flex align-items-center gap-2">
                                                            {{ $productdata->attchment_name }}
                                                            <i class="fa-light fa-file fs-7"></i>
                                                        </p>
                                                    </a>
                                                @else
                                                    <a href="{{ $productdata->attchment_url }}" target="_blank">
                                                        <p class="fs-7 fw-semibold d-flex align-items-center gap-2">
                                                            {{ trans('labels.click_here') }}
                                                            <i class="fa-light fa-file fs-7"></i>
                                                        </p>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if (!empty($productdata->description))
                                <div class="border-bottom pb-3 d-block">
                                    <div class="row mt-3">
                                        <p class="text-dark fw-semibold mb-1 text-truncate">
                                            {{ trans('labels.product_details') }}
                                        </p>
                                        <div class="col-lg-12 product-description-limit">
                                            {!! substr($productdata->description, 0, 420) !!} <a class="fw-bold text-decoration-underline"
                                                href="#read-more" id="readmore"
                                                onclick="$('#read-more a:first').tab('show');">{{ trans('labels.readmore') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($productdata->has_variation == 1)
                                <div class="product-variations-wrapper">
                                    <div class="size-variation" id="variation">

                                        @for ($i = 0; $i < count($productdata->variants_json); $i++)
                                            <label class="fw-semibold fs-6 mt-3"
                                                for="">{{ $productdata->variants_json[$i]['variant_name'] }}</label><br>
                                            <div class="d-flex flex-wrap gap-2 border-bottom pb-3 mt-3">
                                                @for ($t = 0; $t < count($productdata->variants_json[$i]['variant_options']); $t++)
                                                    <label
                                                        class="checkbox-inline check{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_name']) }} {{ $t == 0 ? 'active' : '' }}"
                                                        id="check_{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_name']) }}-{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t]) }}"
                                                        for="{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_name']) }}-{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t]) }}">
                                                        <input type="checkbox" class="" name="skills"
                                                            {{ $t == 0 ? 'checked' : '' }}
                                                            value="{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t]) }}"
                                                            id="{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_name']) }}-{{ str_replace(' ', '_', $productdata->variants_json[$i]['variant_options'][$t]) }}">
                                                        {{ $productdata->variants_json[$i]['variant_options'][$t] }}
                                                    </label>
                                                @endfor
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endif

                            @if (count($productdata['extras']) > 0)
                                <div class="woo_pr_color flex_inline_center my-3 border-bottom mt-3 pb-3">
                                    <div class="woo_colors_list text-left">
                                        <span id="extras">
                                            <h6 class="text-dark extra-title fw-semibold">{{ trans('labels.extras') }}
                                            </h6>
                                            <ul class="list-unstyled extra-food mt-3">
                                                <div id="pricelist">
                                                    @foreach ($productdata['extras'] as $key => $extras)
                                                        <li class="mb-2">
                                                            <div
                                                                class="form-check m-0 p-0 d-flex gap-2 align-items-center">
                                                                <input type="checkbox" class="form-check-input p-0 m-0 Checkbox"
                                                                    name="addons[]" extras_name="{{ $extras->name }}" value="{{ $extras->id }}"
                                                                    price="{{ $extras->price }}"
                                                                    id="extracheck_{{ $key }}_{{ $productdata->id }}">
                                                                <label class="form-check-label w-100 m-0 p-0"
                                                                    for="extracheck_{{ $key }}_{{ $productdata->id }}">
                                                                    <div class="d-flex w-100 justify-content-between">
                                                                        <span
                                                                            class="fs-7 fw-500">{{ $extras->name }}</span>
                                                                        <span class="fs-7 fw-500">
                                                                            {{ helper::currency_formate($extras->price, $productdata->vendor_id) }}
                                                                        </span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        </span>

                                    </div>
                                </div>
                            @endif

                            @if ($productdata->is_available != 2 || $productdata->is_deleted == 1)
                                <div class="border-bottom pb-3">
                                    <div class="row mt-3 g-3" id="detail_plus-minus">
                                        @if (helper::appdata($vendordata->id)->online_order == 1)
                                            <div class="col-xl-3 col-6">
                                                <div
                                                    class="input-group qty-input2 small w-100 justify-content-center responsive-margin m-0 rounded-0 hight-modal-btn align-items-center">
                                                    <button
                                                        class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                                        id="minus" data-type="minus"
                                                        data-item_id="{{ $productdata->id }}"
                                                        onclick="changeqty($(this).attr('data-item_id'),'minus')"
                                                        value="minus value"><i class="fa fa-minus"></i>
                                                    </button>
                                                    <input type="number"
                                                        class="border text-center item_qty_{{ $productdata->id }}"
                                                        name="number" value="1" readonly="">
                                                    <button
                                                        class="btn p-0 change-qty-2 h-100 border-0 text-dark m-0 item_qty_btn"
                                                        id="plus" data-item_id="{{ $productdata->id }}"
                                                        onclick="changeqty($(this).attr('data-item_id'),'plus')"
                                                        data-type="plus" value="plus value"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-xl-3 col-6">
                                            @if (@helper::checkaddons('subscription'))
                                                @if (@helper::checkaddons('whatsapp_message'))
                                                    @php
                                                        $checkplan = App\Models\Transaction::where(
                                                            'vendor_id',
                                                            $vendordata->id,
                                                        )
                                                            ->orderByDesc('id')
                                                            ->first();
                                                        $user = App\Models\User::where('id', $vendordata->id)->first();
                                                        if (@$user->allow_without_subscription == 1) {
                                                            $whatsapp_message = 1;
                                                        } else {
                                                            $whatsapp_message = @$checkplan->whatsapp_message;
                                                        }
                                                    @endphp
                                                    @if (
                                                        $whatsapp_message == 1 &&
                                                            helper::appdata($vendordata->id)->whatsapp_number != '' &&
                                                            helper::appdata($vendordata->id)->whatsapp_number != null)
                                                        <a href="https://api.whatsapp.com/send?phone={{ helper::appdata($vendordata->id)->whatsapp_number }}'&text= {{ $productdata->name }}"
                                                            class="btn py-2 btn-danger btn-enquir rounded-0 w-100"
                                                            id="enquiries" target="_blank">
                                                            <span class="px-1 fs-7 d-flex align-items-center gap-1">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                                {{ trans('labels.enquiries') }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            @else
                                                @if (@helper::checkaddons('whatsapp_message'))
                                                    @if (helper::appdata($vendordata->id)->whatsapp_number != '' &&
                                                            helper::appdata($vendordata->id)->whatsapp_number != null)
                                                        <a href="https://api.whatsapp.com/send?phone={{ helper::appdata($vendordata->id)->whatsapp_number }}'&text= {{ $productdata->name }}"
                                                            class="btn py-2 btn-danger btn-enquir rounded-0 w-100"
                                                            id="enquiries" target="_blank">
                                                            <span class="px-1 fs-7 d-flex align-items-center gap-1">
                                                                <i class="fa-brands fa-whatsapp"></i>
                                                                {{ trans('labels.enquiries') }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>

                                        @if ($productdata->is_available != 2 || $productdata->is_deleted == 1)
                                            @if (helper::appdata($vendordata->id)->online_order == 1)
                                                <div class="col-xl-3 col-6">
                                                    <button
                                                        class="btn m-0 py-2 btn-secondary rounded-0 w-100 add-btn addtocart"
                                                        onclick="addtocart('{{ $productdata->id }}','{{ $productdata->slug }}','{{ $productdata->name }}','{{ $productdata['product_image']->image }}','{{ $productdata->tax }}',$('#item_price').val(),'{{ ucfirst($productdata->attribute) }}','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                                        <span class="px-1 fs-7">{{ trans('labels.add_to_cart') }}</span>
                                                    </button>
                                                </div>
                                                <div class="col-xl-3 col-6">
                                                    <button
                                                        class="btn btn-lg m-0 bg-white border-dark rounded-0 w-100 fs-6 text-dark buynow"
                                                        onclick="addtocart('{{ $productdata->id }}','{{ $productdata->slug }}','{{ $productdata->name }}','{{ $productdata['product_image']->image }}','{{ $productdata->tax }}',$('#item_price').val(),'{{ ucfirst($productdata->attribute) }}','{{ URL::to(@$vendordata->slug . '/cart/add') }}','1')">
                                                        <span class="px-1 fs-7">{{ trans('labels.buy_now') }}</span>
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div
                                class="d-flex flex-wrap gap-sm-2 gap-3 justify-content-between align-items-center w-100 my-3">
                                <div>
                                    @if (@helper::checkaddons('customer_login'))
                                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                            <p class="fs-7 d-flex align-items-center">
                                                <a onclick="managefavorite('{{ $productdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                    class="btn-sm btn-Wishlist cursor-pointer bg-primary {{ session()->get('direction') == 2 ? 'me-auto' : 'ms-auto' }}">
                                                    <span class=" btn-sm btn-Wishlist mx-2 bg-primary">
                                                        @if (Auth::user() && Auth::user()->type == 3)
                                                            @php
                                                                $favorite = helper::ceckfavorite(
                                                                    $productdata->id,
                                                                    $vendordata->id,
                                                                    Auth::user()->id,
                                                                );
                                                            @endphp
                                                            @if (!empty($favorite) && $favorite->count() > 0)
                                                                <i class="fa-solid fa-heart"></i>
                                                            @else
                                                                <i class="fa-regular fa-heart"></i>
                                                            @endif
                                                        @else
                                                            <i class="fa-regular fa-heart"></i>
                                                        @endif
                                                    </span>
                                                </a>
                                                <span class=" mx-2">{{ trans('labels.add_to_wishlist') }}</span>
                                            </p>
                                        @endif
                                    @endif
                                </div>


                                <div class="d-flex align-items-center justify-content-center gap-2">

                                    @if ($productdata->video_url != '' && $productdata->video_url != null)
                                        <a href="{{ $productdata->video_url }}" tooltip="Video"
                                            class=" rounded-circle prod-social m-0" id="btn-video" target="_blank">
                                            <i class="fa-regular fa-video fs-7"></i>
                                        </a>
                                    @endif

                                    @if (helper::appdata($vendordata->id)->google_review != '' && helper::appdata($vendordata->id)->google_review != null)
                                        <a href="{{ helper::appdata($vendordata->id)->google_review }}" target="_blank"
                                            tooltip="Review" class=" rounded-circle prod-social m-0">
                                            <i class="fa-regular fa-star fs-7"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            @include('web.service-trusted')

                        </div>
                    </div>
                </div>

                <!-- description section start-->
                <ul class="nav nav-pills pb-4 mb-4 gap-3 border-bottom border-top pt-4" id="read-more" role="tablist">

                    <li class="nav-item " role="presentation">
                        <a class="nav-link active p-3 px-4" aria-current="page" data-bs-toggle="pill"
                            data-bs-target="#pills-description"
                            href="javascript:void(0)">{{ trans('labels.description') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link p-3 px-4" href="javascript:void(0)" data-bs-toggle="pill"
                            data-bs-target="#pills-additional_info">{{ trans('labels.additional_info') }}</a>
                    </li>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-3 px-4" href="javascript:void(0)" data-bs-toggle="pill"
                                    data-bs-target="#pills-review">{{ trans('labels.reviews') }}</a>
                            </li>
                        @endif
                    @endif
                </ul>
                <div class="tab-content mb-3" id="read-moreContent">

                    <div class="tab-pane fade" id="pills-additional_info" role="tabpanel"
                        aria-labelledby="pills-additional_info-tab">{!! $productdata->additional_info !!}</div>
                    <div class="tab-pane fade active show" id="pills-description" role="tabpanel"
                        aria-labelledby="pills-description-tab">{!! $productdata->description !!}</div>
                    @if (@helper::checkaddons('product_reviews'))
                        @include('web.product_review')
                    @endif
                </div>
                <!-- description section end-->
            </div>
        </section>
        <!-- PRODUCTS VIEW AREA END -->
        @if (@helper::checkaddons('sticky_cart_bar'))
            @include('web.view-cart-bar')
        @endif
    @else
        @include('web.nodata')
    @endif
    <!-- RELATED PRODUCTS AREA START -->
    @if (count($getrelatedproductslist) > 0)
        <section class="related my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading py-4 flex-wrap gap-2 border-top">
                            <h4 class="text-dark text-truncate fw-600">{{ trans('labels.top_related_products') }}</h4>
                            <a href="{{ URL::to(@$vendordata->slug . '/category?category=' . $productdata['category_info']->slug) }}"
                                class="btn btn-fashion ">{{ trans('labels.viewall') }}</a>
                        </div>
                    </div>
                </div>
                @if (helper::appdata(@$vdata)->theme == 1)
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 best-product pro-hover">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.productcommonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 2)
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mb-4">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-2.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 3)
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-3.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 4)
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0 product-list">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-4.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 5)
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3 product-list">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-5.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 6)
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-6.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 7)
                    <div
                        class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-md-4 g-3 theme-7-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-7.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 8)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-8-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-8.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 9)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-9-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-9.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 10)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-10-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-10.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 11)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-11 theme-11-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-11.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 12)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-12 theme-12-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-12.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 13)
                    <div class="row g-sm-3 g-2 theme-13-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-13.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 14)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-14-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-14.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 15)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-15-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-15.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 16)
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 theme-16 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-16.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 17)
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-17 theme-5-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-17.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 18)
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-18 theme-4-best-Selling-product">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            @include('web.theme-18.productcomonview')
                        @endforeach
                    </div>
                @endif
                @if (helper::appdata(@$vdata)->theme == 19)
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            <div class="item p-1 theme-19 h-100">
                                @include('web.theme-19.productcomonview')
                            </div>
                        @endforeach
                    </div>
                @endif

                @if (helper::appdata(@$vdata)->theme == 20)
                    <div class="top-deals20 owl-carousel owl-theme">
                        @foreach ($getrelatedproductslist as $getproductdata)
                            <div class="item p-1 theme-20 h-100">
                                @include('web.theme-20.productcomonview')
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </section>
        {{ $getrelatedproductslist->appends(request()->query())->links() }}
    @endif
    <!-- RELATED PRODUCTS AREA END -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function($) {
            var selected = [];

            $('.size-variation input:checked').each(function() {
                var label = $("label[for='" + $(this).attr('id') + "']").attr('id');
                $('#' + label).addClass('active');
                selected.push($(this).attr('value'));
            });

            set_variant_price(selected);
        });
        $('#variation input:checkbox').click(function() {

            var selected = [];
            var divselected = [];
            const myArray = this.id.split("-");
            var id = this.id;
            $('.check' + myArray[0] + ' input:checked').each(function() {
                divselected.push($(this).attr('value'));
            });
            if (divselected.length == 0) {
                $(this).prop('checked', true);
            }
            $('.check' + myArray[0] + ' input:checkbox').not(this).prop('checked', false);
            $('.check' + myArray[0]).removeClass('active');
            var label = $("label[for='" + $(this).attr('id') + "']").attr('id');
            $('#' + label).addClass('active');
            $('.size-variation input:checked').each(function() {
                $('.product-detail-price').addClass('d-none');
                $('#laodertext').removeClass('d-none');
                $('#laodertext').html(
                    '<span class="loader"></span>'
                );
                selected.push($(this).attr('value'));
            });

            set_variant_price(selected);
        });

        function set_variant_price(variants) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ URL::to('get-products-variant-quantity') }}",
                data: {
                    name: variants,
                    item_id: $('#overview_item_id').val(),
                    vendor_id: {{ $vendordata->id }},
                },
                success: function(data) {
                    if (data.status == 1) {
                        setTimeout(function() {
                            $('#laodertext').html('');
                        }, 4000);
                        var price = data.price;
                        var original_price = data.original_price;

                        var off = ((1 - (data.price / data.original_price)) * 100).toFixed(1);
                        $('#laodertext').addClass('d-none');
                        $('.product-detail-price').removeClass('d-none');
                        $('#variants_name').val(variants);

                        $('#modal_product_price').text(currency_formate(parseFloat(price)));
                        $('#item_price').val(price);
                        $('#modal_price-off').removeClass('d-none');
                        if (parseFloat(original_price) > parseFloat(price)) {
                            $('#modal_product-original-price').text(currency_formate(parseFloat(
                                original_price)));
                            $('#modal_price-off').text($.number(off, 1) + ' ' + '% OFF');
                        } else {
                            $('#modal_product-original-price').text('');
                            $('#detail_original_price').text('');
                            $('#modal_price-off').text('');
                        }
                        $('#overview_item_original_price').val(original_price);
                        $('#stock_management').val(data.stock_management);
                        $('#item_min_order').val(data.min_order);
                        $('#item_max_order').val(data.max_order);
                        if (data.is_available == 2) {
                            $('.product-detail-price').addClass('d-none');
                            $('#modal_price-off').addClass('d-none');
                            $('#detail_not_available_text').html('{{ trans('labels.not_available') }}');
                            // $('.add-btn').attr('disabled', true);
                            $('.add-btn').addClass('d-none');
                            $('#modal_product_price').addClass('d-none');
                            $('#modal_product-original-price').addClass('d-none');
                            $('#detail_plus-minus').addClass('d-none');
                            // $('#sku_stock').addClass('d-none');
                            $('#tax').addClass('d-none');
                            $('#stock').addClass('d-none');
                        } else {
                            $('.product-detail-price').removeClass('d-none');
                            $('#detail_not_available_text').html('');
                            $('#modal_price-off').removeClass('d-none');
                            $('.add-btn').removeClass('d-none');
                            // $('#sku_stock').removeClass('d-none');
                            $('#modal_product_price').removeClass('d-none');
                            $('#modal_product-original-price').removeClass('d-none');
                            $('#detail_plus-minus').removeClass('d-none');
                            $('#tax').removeClass('d-none');
                            $('#stock').addClass('d-none');
                            if (data.stock_management == 1) {
                                $('#stock').removeClass('d-none');
                                $('#detail_out_of_stock').removeClass('d-none');
                                if (data.quantity > 0) {
                                    $('#detail_out_of_stock').removeClass('text-danger');
                                    $('#detail_out_of_stock').addClass('text-success');
                                    $('#detail_out_of_stock').html(data.quantity +
                                        ' {{ trans('labels.in_stock') }}');
                                } else {
                                    $('#detail_out_of_stock').removeClass('text-dark');
                                    $('#detail_out_of_stock').addClass('text-danger');
                                    $('#detail_out_of_stock').html('{{ trans('labels.out_of_stock') }}');
                                }
                            } else {
                                $('#detail_out_of_stock').addClass('d-none');
                            }

                        }
                    }

                }
            });
        }

        var formate = "{{ helper::appdata($vendordata->id)->currency_formate }}";
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/smoothproducts.js') }}"></script>
    <script>
        // Product Preview
        $('.sp-wrap').smoothproducts();
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'web-assets/js/products.js') }}"></script>
@endsection

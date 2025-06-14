@php
    if ($getproductdata->top_deals == 1 && helper::top_deals($vendordata->id) != null) {
        if (@helper::top_deals($vendordata->id)->offer_type == 1) {
            $price = $getproductdata->price - @helper::top_deals($vendordata->id)->offer_amount;
        } else {
            $price =
                $getproductdata->price -
                $getproductdata->price * (@helper::top_deals($vendordata->id)->offer_amount / 100);
        }
        $original_price = $getproductdata->price;
    } else {
        $price = $getproductdata->price;
        $original_price = $getproductdata->original_price;
    }
    $off = $original_price > 0 ? number_format(100 - ($price * 100) / $original_price, 1) : 0;
@endphp
<div class="col">
    <div
        class="card rounded-4 h-100 overflow-hidden bg-primary-rgb border border-dark {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
        <div class="card-img position-relative">
            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                    class="w-100 object-fit-cover img-1">
                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 img-2" alt="">
            </a>
            @if ($off > 0)
                <div class="off-label-12 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                    <div class="sale-label-12">{{ $off }}% {{ trans('labels.off') }}</div>
                </div>
            @endif

            <!-- options -->
            <ul class="option-wrap d-flex gap-3 justify-content-center w-100">
                @if (@helper::checkaddons('customer_login'))
                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                        <li tooltip="Wishlist" class="m-0 rounded-3">
                            <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                class="option-btn circle-round wishlist-btn rounded-3">
                                @if (Auth::user() && Auth::user()->type == 3)
                                    @php

                                        $favorite = helper::ceckfavorite(
                                            $getproductdata->id,
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
                            </a>
                        </li>
                    @endif
                @endif
                <li tooltip="{{ trans('labels.view') }}" class="m-0 rounded-3">
                    <a class="option-btn circle-round wishlist-btn rounded-3"
                        onclick="productview('{{ $getproductdata->id }}')">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                </li>
            </ul>
            <!-- options end -->
        </div>

        <div class="card-body px-sm-3 px-2 pt-3 pb-0">

            <div class="d-flex align-items-center justify-content-between mb-1">

                <p class="item-title fs-8 cursor-auto text-truncate text-lightslategray">
                    {{ @$getproductdata['category_info']->name }}
                </p>
                @if (@helper::checkaddons('product_reviews'))
                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                        <p class="d-flex fs-8 product-star align-items-center">
                            <i class="text-warning fa-solid fa-star px-1"></i>
                            <span
                                class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                        </p>
                    @endif
                @endif
            </div>

            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                <p class="text-dark product-name line-2">{{ $getproductdata->name }}</p>
            </a>
        </div>
        <div class="card-footer px-sm-3 p-2">

            <h6 class="text-dark fs-7 fw-semibold product-price-size cursor-auto text-truncate">

                {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                @if ($original_price > $price)
                    <del
                        class="fs-8 fw-normal d-block mt-1 text-lightslategray">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                @endif
            </h6>
        </div>
        <!-- add to cart start -->
        @if (helper::appdata($vendordata->id)->online_order == 1)
            <div class="theme-12-cart d-flex justify-content-center w-100">
                @if ($getproductdata->has_variation == 1)
                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                        class="option-btn addtocart-btn rounded-0 text-dark w-100">
                        <div class="btn btn-secondary w-100 rounded-0">
                            <p class="fw-500 fs-7 text-capitalize d-flex justify-content-center">
                                <i
                                    class="fa-sharp fa-regular fa-cart-plus px-2 d-lg-block d-none"></i>{{ trans('labels.addtocart') }}
                            </p>
                        </div>
                    </a>
                @else
                    <a class="option-btn addtocart-btn rounded-0 cursor-pointer w-100"
                        onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                        <div class="btn btn-secondary w-100 rounded-0">
                            <p class="fw-500 fs-7 text-capitalize d-flex justify-content-center">
                                <i
                                    class="fa-sharp fa-regular fa-cart-plus px-2 d-md-block d-none"></i>{{ trans('labels.addtocart') }}
                            </p>
                        </div>
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

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
<div class="col mb-0">
    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">

        <div class="card bg-primary-rgb-card rounded-3 h-100 overflow-hidden theme-8">
            <div class="card-img position-relative">
                <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                    class="w-100 object-fit-cover img-1">
                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 img-2" alt="">
                @if ($off > 0)
                    <div class="sale-label-8 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                        {{ $off }}% {{ trans('labels.off') }}</div>
                @endif
                @if (helper::appdata($vendordata->id)->online_order == 1)
                    <div class="w-100 theme-8-cart">
                        @if ($getproductdata->has_variation == 1)
                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                class="option-btn addtocart-btn rounded-0 text-dark">
                                <div class="product-cart-button w-100">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    <p class="px-2 fw-500 text-capitalize fs-7">{{ trans('labels.add_to_cart') }}</p>
                                </div>
                            </a>
                        @else
                            <a class="option-btn addtocart-btn rounded-0 cursor-pointer"
                                onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                <div class="product-cart-button w-100 text-dark">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    <p class="px-2 fw-500 text-capitalize fs-7">{{ trans('labels.add_to_cart') }}</p>
                                </div>
                            </a>
                        @endif
                    </div>
                @endif

                <!-- options -->
                <ul
                    class="option-wrap justify-content-center align-items-center d-grid product_icon2 px-2 w-auto {{ session()->get('direction') == 2 ? 'rtl-8' : 'ltr-8 ' }}">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li data-tooltip="Wishlist"
                                class="m-2 {{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }}">
                                <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                    class="option-btn circle-round wishlist-btn rounded">
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
                    <li data-tooltip="View"
                        class="m-2 {{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }}">
                        <a class="option-btn circle-round wishlist-btn rounded"
                            onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                </ul>
                <!-- options -->
            </div>

            <div class="card-body px-sm-3 px-2 pt-3 pb-0">

                <div class="d-flex align-items-center justify-content-between mb-1">

                    <p class="item-title fs-8 cursor-auto text-truncate text-lightslategray">
                        {{ @$getproductdata['category_info']->name }}
                    </p>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex"><i class="text-warning fa-solid fa-star px-1"></i><span
                                    class="text-lightslategray fs-9 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>

                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="text-white product-name line-2">{{ $getproductdata->name }}</p>
                </a>

            </div>
            <div class="card-footer px-sm-3 px-2 py-2 ">

                <h5 class="text-white fw-semibold fs-7 product-price-size cursor-auto text-truncate">

                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del
                            class="fs-8 fw-500 d-block mt-1 text-lightslategray">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                    @endif
                </h5>
            </div>
        </div>
    </a>
</div>

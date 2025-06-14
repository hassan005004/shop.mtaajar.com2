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
<div class="product-item m-0 py-2 theme-5-best-Selling-product">
    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
        <div
            class="card h-100 w-100 rounded-0 shadow-none border border-0 overflow-hidden pro-menu {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">

            <div class="card-img position-relative">

                <img src="{{ $getproductdata['product_image']->image_url }}" class="object-fit-cover w-100 img-1"
                    alt="product image ">

                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 img-2" alt="">
                @if ($off > 0)
                    <span
                        class="{{ session()->get('direction') == 2 ? 'theme-5-sale-label-rtl' : 'sale-label' }}">{{ $off }}%
                        {{ trans('labels.off') }}</span>
                @endif

                <!-- options -->
                <ul class="option-wrap {{ session()->get('direction') == 2 ? '  ltr' : 'rtl' }}">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li class="{{ session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right' }} rounded-circle"
                                data-tooltip="Wishlist">
                                <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                    class="option-btn circle-round wishlist-btn">
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
                    <li class="{{ session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right' }} rounded-circle"
                        data-tooltip="{{ trans('labels.view') }}">
                        <a class="option-btn circle-round wishlist-btn"
                            onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li class="{{ session()->get('direction') == 2 ? 'tooltip-left' : 'tooltip-right' }} rounded-circle"
                            data-tooltip="{{ trans('labels.add_to_cart') }}">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="option-btn circle-round addtocart-btn wishlist-btn">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @else
                                <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
                <!-- options -->

            </div>

            <div class="card-body px-0 pb-0">

                <p class="card-title fs-8 text-secondary mb-1 text-truncate">
                    {{ @$getproductdata['category_info']->name }}</p>

                <a
                    href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="m-0 fs-7 fw-600 line-2 text-capitalize">{{ $getproductdata->name }}</p>
                </a>

            </div>
            <div class="card-footer px-0 price">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <h5 class="text-dark fs-7 fw-600 m-0 text-truncate">
                            {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                        </h5>
                        @if ($original_price > $price)
                            <del
                                class="text-muted fs-8 fw-600">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                        @endif
                    </div>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 text-truncate"><i class="text-warning fa-solid fa-star px-1"></i><span
                                    class="text-dark fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </a>
</div>

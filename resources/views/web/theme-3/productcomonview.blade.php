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
<div class="col-xl-4 col-lg-6 col-md-6 col-12 mb-0 theme-3-best-Selling-product card-img-2">
    <div class="item h-100 p-2 row g-2">
        <div class="col-lg-6 col-5">
            <div class="item-img position-relative">
                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                        class="w-100 object-fit-cover img-1">
                    <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                        class="w-100 img-2" alt="">
                </a>
                @if ($off > 0)
                    <div class="offer-3 cursor-auto offer-3-p">{{ $off }}% {{ trans('labels.off') }}</div>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-7">
            <div class="card-body item-content p-2 pb-0 h-170">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <p class="item-title text-secondary fs-8 cursor-auto text-truncate">
                        {{ @$getproductdata['category_info']->name }}</p>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex"><i class="text-warning fa-solid fa-star px-1"></i><span
                                    class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>

                <a
                    href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="item-brand line-2 fw-semibold fs-7">{{ $getproductdata->name }}</p>
                </a>

                <h6 class="text-dark fw-semibold fs-7 product-price-size my-2 cursor-auto text-truncate">
                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del
                            class="text-muted fs-8 fw-500 d-block mt-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                    @endif
                </h6>
            </div>
            <div class="card-footer d-md-block d-none">
                <!-- options -->
                <ul class="option-wrap d-flex align-items-center d-grid gap-4 product_icon2 mt-2 px-2">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li tooltip="Wishlist" class="rounded-circle">
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
                    <li tooltip="View" class="rounded-circle">
                        <a class="option-btn circle-round wishlist-btn"
                            onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li tooltip="Add To Cart" class="rounded-circle">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="option-btn circle-round wishlist-btn addtocart-btn ">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @else
                                <a href="#" class="option-btn circle-round wishlist-btn addtocart-btn "
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
                <!-- options -->
            </div>
        </div>
    </div>
</div>

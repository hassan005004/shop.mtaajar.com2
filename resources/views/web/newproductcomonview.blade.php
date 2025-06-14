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
    <a
        href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
        <div class="card product-card-side h-100 p-0">
            <div class="img-wrap overflow-hidden position-relative">
                <a
                    href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <img src="{{ $getproductdata['product_image']->image_url }}"
                        class="w-100 img-fluid object-fit-cover h-190 img-1"
                        alt="">
                    <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                        class="w-100 img-2 h-190" alt="">
                </a>
                @if ($off > 0)
                    <span
                        class="{{ session()->get('direction') == 2 ? 'arrow-label-wrap-rtl' : 'arrow-label-wrap' }}">
                        <span class="arrow-label bg-theme-sun">{{ $off }}%
                            OFF</span></span>
                @endif
            </div>
            <div class="card-body p-xl-3 p-2 content-box w-100">
                <div class="d-flex align-items-center justify-content-between mb-md-2">
                    <p
                        class="card-title fs-8 text-muted m-0 line-1 text-capitalize">
                        {{ @$getproductdata['category_info']->name }}
                    </p>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (@helper::checkaddons('customer_login'))
                            @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                <p class="fs-8 d-flex align-items-center gap-1">
                                    <i
                                        class="text-warning fa-solid fa-star"></i>
                                    <span
                                        class="text-dark fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                                </p>
                            @endif
                        @endif
                    @endif
                </div>
                <a
                    href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <h5 class="truncate-2 mb-1 text-dark product-name line-2 h-40">
                        {{ $getproductdata->name }}
                    </h5>
                </a>
                <h5
                    class="text-secondary fs-7 flex-wrap d-flex align-items-center gap-1 fw-semibold mb-0 product-price text-truncate">
                    {{ helper::currency_formate($price, $vendordata->id) }}
                    @if ($original_price > $price)
                        @if ($original_price > 0)
                            <del
                                class="text-muted fw-500 fs-8 fw-normal">{{ helper::currency_formate($original_price, $vendordata->id) }}</del>
                        @endif
                    @endif
                </h5>

                <!-- options -->
                <ul
                    class="option-wrap d-flex align-items-center d-grid gap-3 product_icon2 mt-2">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li tooltip="Wishlist" class="rounded-circle">
                                <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                    class="circle-round wishlist-btn">
                                    @if (Auth::user() && Auth::user()->type == 3)
                                        @php

                                            $favorite = helper::checkfavorite(
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
                        <a class="circle-round wishlist-btn"
                            onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li tooltip="Add To Cart" class="rounded-circle">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="circle-round addtocart-btn wishlist-btn">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @else
                                <a class="circle-round addtocart-btn  wishlist-btn"
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
    </a>
</div>

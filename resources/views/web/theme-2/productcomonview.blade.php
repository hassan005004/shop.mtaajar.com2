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
    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
        <div
            class="card border-0 rounded-0 overflow-hidden h-100 theme-2-card pro-menu {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
            <div class="card-img position-relative">
                <img src="{{ $getproductdata['product_image']->image_url }}"
                    class="card-img-top img-fluid object-fit-cover rounded-0 img-1" alt="product-1">
                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 img-2" alt="">

                @if ($off > 0)
                    <div class="offer {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">{{ $off }}%
                        {{ trans('labels.off') }}
                    </div>
                @endif

                <!-- options -->
                <ul class="option-wrap {{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }}  rounded-circle"
                                data-tooltip="Wishlist">
                                <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                    class="circle-round wishlist-btn">
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
                    <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle"
                        data-tooltip="View">
                        <a class="circle-round wishlist-btn" onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li class="{{ session()->get('direction') == 2 ? 'tooltip-right' : 'tooltip-left' }} rounded-circle"
                            data-tooltip="Add To Cart">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="circle-round addtocart-btn wishlist-btn">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @else
                                <a class="circle-round addtocart-btn wishlist-btn"
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
                <!-- options -->

            </div>
            <div class="card-body px-0">
                <h5 class="card-title text-capitalize text-secondary fs-8 mb-1 theme-2 text-truncate">
                    {{ @$getproductdata['category_info']->name }}</h5>
                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="card-text text-dark text-capitalize fw-600 line-2 fs-7">{{ $getproductdata->name }}</p>
                </a>
            </div>
            <div class="card-footer px-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5
                        class="text-dark d-flex flex-wrap align-items-center gap-1 fs-7 fw-semibold m-0 product-price text-truncate">
                        {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                        @if ($original_price > $price)
                            <del
                                class="text-muted fs-8 offer-price fw-500">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                        @endif
                    </h5>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex">
                                <i class="text-warning fa-solid fa-star px-1"></i>
                                <span
                                    class="text-dark fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>

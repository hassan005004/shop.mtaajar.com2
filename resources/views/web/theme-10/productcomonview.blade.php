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
<div class="col theme-10-best-Selling-product">
    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">

        <div class="card border-0 rounded-3 position-relative h-100 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
            <div class="card-border overflow-hidden rounded-3">
                <div>
                    <div class="card-body p-sm-3 p-2 h-139 h-157">

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
                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mt-sm-2 mt-2">
                            <h5
                                class="text-dark fs-7 fw-semibold product-price-size cursor-auto text-truncate col-sm-auto col-12 order-sm-0 order-2">
                                @if ($original_price > $price)
                                    <del
                                        class="fs-8 fw-normal d-block mt-1 text-lightslategray">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                                @endif
                                {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                            </h5>

                            @if ($off > 0)
                                <div class="sale-label-10 rounded-2">{{ $off }}% {{ trans('labels.off') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="card-img position-relative">
                            <div class="card-layer">
                                <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                                    class="w-100 object-fit-cover img-1">
                                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                                    class="w-100 img-2" alt="">
                            </div>

                            <!-- options -->
                            <ul
                                class="option-wrap d-flex justify-content-center align-items-center d-grid product_icon2 px-2 w-auto {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                                @if (@helper::checkaddons('customer_login'))
                                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                        <li tooltip="Wishlist" class="m-0">
                                            <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                                class="option-btn circle-round wishlist-btn rounded-0">
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
                                <li tooltip="{{ trans('labels.view') }}" class="m-0">
                                    <a class="option-btn circle-round wishlist-btn rounded-0"
                                        onclick="productview('{{ $getproductdata->id }}')">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </li>
                                @if (helper::appdata($vendordata->id)->online_order == 1)
                                    <li tooltip="{{ trans('labels.add_to_cart') }}" class="rounded-circle m-0">
                                        @if ($getproductdata->has_variation == 1)
                                            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                                class="option-btn circle-round addtocart-btn wishlist-btn rounded-3">
                                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                                class="option-btn circle-round addtocart-btn wishlist-btn rounded-3"
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
        </div>
    </a>
</div>

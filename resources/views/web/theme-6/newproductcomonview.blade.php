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

        <div class="card rounded-0 h-100 p-2">

            <div class="card-img position-relative">
                <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                    class="w-100 object-fit-cover img-1">
                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 img-2" alt="">
                @if ($off > 0)
                    <div class="sale-label">{{ $off }}% OFF</div>
                @endif
                <!-- options -->
                <ul
                    class="option-wrap justify-content-center d-flex align-items-center d-grid product_icon2 mt-2 px-2 w-100">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li tooltip="Wishlist" class="rounded-circle mx-2">
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
                    <li tooltip="View" class="rounded-circle mx-2">
                        <a class="option-btn circle-round wishlist-btn rounded-0"
                            onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li tooltip="{{ trans('labels.add_to_cart') }}" class="rounded-circle mx-2">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-0">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @else
                                <a class="option-btn circle-round addtocart-btn wishlist-btn rounded-0"
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
                <!-- options -->
            </div>

            <div class="card-body px-0 pt-3 pb-0">

                <div class="d-flex flex-wrap align-items-center justify-content-between mb-1">

                    <p class="item-title text-capitalize text-muted fs-8 cursor-auto text-truncate">
                        {{ $getproductdata['category_info']->name }}
                    </p>

                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                        <p class="fs-8 d-flex"><i
                                class="text-warning fa-solid fa-star {{ session()->get('direction') == 2 ? 'ps1' : 'pe-1' }}"></i><span
                                class="text-dark text-capitalize fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                        </p>
                    @endif

                </div>

                <a
                    href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="text-dark product-name line-2">{{ $getproductdata->name }}</p>
                </a>



            </div>
            <div class="card-footer px-0 py-2 ">

                <h5 class="text-dark fs-7 fw-semibold product-price-size cursor-auto text-truncate">

                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del
                            class="text-muted fs-8 fw-500 d-block mt-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                    @endif
                </h5>
            </div>
        </div>
    </a>
</div>

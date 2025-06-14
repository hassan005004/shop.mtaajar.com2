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
<div class="col theme-18">
    <a
        href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">

        <div class="card h-100 product-grid bg-white rounded-0">

            <div class="product-image">
                <a class="image">
                    <img class="pic-1" src="{{ $getproductdata['product_image']->image_url }}">
                </a>
                @if ($off > 0)
                    <div class="off-label-16">
                        <h3 class="text-center">{{ $off }}% OFF</h3>
                    </div>
                @endif
                <ul class="product-links d-flex gap-2">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li class="cursor-pointer">
                                <a
                                    onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')">
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
                    <li class="cursor-pointer">
                        <a onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li class="cursor-pointer">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)"
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body border-top text-center">
                <h3 class="title line-2">
                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                        {{ $getproductdata->name }}
                    </a>
                </h3>
                <span class="category m-0 line-1">{{ @$getproductdata['category_info']->name }}</span>
            </div>
            <div class="card-footer border-top d-flex align-items-center justify-content-between">

                <h5
                    class="fs-7 price m-0 fw-bold product-price flex-wrap align-items-center gap-1 d-flex text-truncate">
                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del class="text-muted fs-8 fw-600 d-block">
                            {{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}
                        </del>
                    @endif
                </h5>

                <p class="fs-8 d-flex gap-1 align-items-center">
                    <i class="text-warning fs-8 fa-solid fa-star "></i>
                    <span class="text-dark fw-500 fs-8">
                        {{ number_format($getproductdata->ratings_average, 1) }}
                    </span>
                </p>
            </div>

        </div>
    </a>
</div>

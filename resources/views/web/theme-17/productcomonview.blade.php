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
<div class="col theme-17">
    <div class="card rounded-0 border-0 h-100 product-grid">
        <div class="product-image">
            <div class="image">
                <img class="pic-1" src="{{ $getproductdata['product_image']->image_url }}">
                <img class="pic-2"
                    src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}">
            </div>
            @if ($off > 0)
                <span class="theme-17-ribbon">
                    <h3>{{ $off }}% {{ trans('labels.off') }}</h3>
                </span>
            @endif
            <ul class="social">
                @if (helper::appdata($vendordata->id)->online_order == 1)
                    <li>
                        @if ($getproductdata->has_variation == 1)
                            <a
                                href="{{ request()->has('type') && request()->get('type') == 1 ? URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug . '?type=1') : URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                                <div class="fs-8 d-flex align-items-center gap-1">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    {{ trans('labels.cart') }}
                                </div>
                            </a>
                        @else
                            <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                <div class="fs-8 d-flex align-items-center gap-1">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                    {{ trans('labels.cart') }}
                                </div>
                            </a>
                        @endif
                    </li>
                @endif
                <li>
                    <a onclick="productview('{{ $getproductdata->id }}')">
                        <div class="fs-8 d-flex align-items-center gap-1">
                            <i class="fa-regular fa-eye"></i>
                            {{ trans('labels.view') }}
                        </div>
                    </a>
                </li>
                @if (@helper::checkaddons('customer_login'))
                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                        <li>
                            <a
                                onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')">
                                <div class="fs-8 d-flex align-items-center gap-1">
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
                                    {{ trans('labels.wishlist') }}
                                </div>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        <div class="card-body pb-0 product-content">
            <div class="d-flex flex-wrap justify-content-between gap-1 mb-1 align-items-center">
                <p class="card-title fs-8 line-2  m-0 text-truncate">
                    {{ @$getproductdata['category_info']->name }}
                </p>
                @if (@helper::checkaddons('product_reviews'))
                    @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                        <p class="fs-8 m-0 text-truncate">
                            <i class="text-warning fa-solid fa-star px-1"></i>
                            <span
                                class="text-dark fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                        </p>
                    @endif
                @endif
            </div>
            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}" class="text-secondary">
                <p class="m-0 fs-7 fw-600 line-2 text-capitalize">{{ $getproductdata->name }}</p>
            </a>
        </div>
        <div class="card-footer product-content">
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <h5 class="text-dark fs-7 fw-600 m-0 text-truncate">
                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                </h5>
                @if ($original_price > $price)
                    <del
                        class="text-muted fs-8 fw-600">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                @endif
            </div>
        </div>
    </div>
</div>

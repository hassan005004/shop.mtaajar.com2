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
        <div class="card h-100 rounded-5 card-gried border-0 p-2 p-sm-3">
            <div class="product-grid">
                <div class="product-image">
                    <a class="image">
                        <img class="pic-1 card-img-top rounded-top-4"
                            src="{{ $getproductdata['product_image']->image_url }}">
                        <img class="pic-2 card-img-top rounded-top-4"
                            src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}">
                    </a>
                    @if ($off > 0)
                        <div class="off-label-16">
                            <h3 class="text-center">{{ $off }}% {{ trans('labels.off') }}</h3>
                        </div>
                    @endif
                    <ul class="social">
                        @if (@helper::checkaddons('customer_login'))
                            @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                <li class="cursor-pointer">
                                    <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                        data-tip="Wishlist">
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
                            <a onclick="productview('{{ $getproductdata->id }}')" data-tip="View">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </li>
                        @if (helper::appdata($vendordata->id)->online_order == 1)
                            <li class="cursor-pointer">
                                @if ($getproductdata->has_variation == 1)
                                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                        data-tip="{{ trans('labels.cart') }}">
                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                    </a>
                                @else
                                    <a href="javascript:void(0)"
                                        onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')"
                                        data-tip="{{ trans('labels.cart') }}">
                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                    </a>
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="d-flex justify-content-between gap-2 mb-2">
                    <p class="item-title text-dark fs-13 text-muted cursor-auto text-truncate">
                        {{ @$getproductdata['category_info']->name }}
                    </p>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex"><i class="text-warning fa-solid fa-star px-1"></i>
                                <span
                                    class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>
                <a class="cursor-pointer position-relative z-1"
                    href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="text-dark fs-15 fw-600 line-2">{{ $getproductdata->name }}</p>
                </a>
            </div>
            <div class="card-footer pt-2">
                <h6
                    class="text-dark fs-15 d-flex gap-1 flex-wrap product-price cursor-auto text-truncate align-items-center">
                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del
                            class="text-muted fs-13 fw-600">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                    @endif
                </h6>
            </div>
        </div>
    </a>
</div>

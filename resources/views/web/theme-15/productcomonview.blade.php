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

        <div class="card border-0 rounded-0 h-100">
            <div class="card-img position-relative">
                <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                    class="w-100 rounded-0 object-fit-cover img-1">
                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 rounded-0 img-2" alt="">
                @if ($off > 0)
                    <div class="off-label-15 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                        <div class="sale-label-15 rounded-0">{{ $off }}% {{ trans('labels.off') }}</div>
                    </div>
                @endif
                <!-- options -->
                <ul class="option-wrap gap-2 align-items-center d-grid product_icon2">
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <li data-tooltip="Wishlist"
                                class="rounded-0 mx-2 tooltip-{{ session()->get('direction') == 2 ? 'left' : 'right' }}">
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
                    <li data-tooltip="{{ trans('labels.view') }}"
                        class="rounded-0 mx-2 tooltip-{{ session()->get('direction') == 2 ? 'left' : 'right' }}">
                        <a class="option-btn circle-round wishlist-btn rounded-0"
                            onclick="productview('{{ $getproductdata->id }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </li>
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <li data-tooltip="{{ trans('labels.addtocart') }}"
                            class="rounded-0 mx-2 tooltip-{{ session()->get('direction') == 2 ? 'left' : 'right' }}">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-0">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)"
                                    class="option-btn circle-round addtocart-btn wishlist-btn rounded-0"
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <i class="fa-sharp fa-regular fa-cart-plus"></i>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
                <!-- options -->
                <!-- category and reting -->
                <div class="category-label">
                    <p
                        class="item-title text-dark fs-8 cursor-auto text-truncate bg-primary-rgb px-2 col-md-auto col-6">
                        {{ @$getproductdata['category_info']->name }}
                    </p>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex">
                                <i class="text-warning fa-solid fa-star px-1"></i>
                                <span
                                    class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="card-body px-2 pt-3 pb-0">
                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="text-dark product-name line-2">{{ $getproductdata->name }}</p>
                </a>

            </div>
            <div class="card-footer px-2 py-2">
                <h6
                    class="text-dark fs-7 d-sm-flex flex-wrap product-price cursor-auto text-truncate align-items-center">
                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del
                            class="text-muted fs-8 fw-normal d-block mx-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                    @endif
                </h6>
            </div>
        </div>

    </a>
</div>

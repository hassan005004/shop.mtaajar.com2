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
<div class="col-xl-4 col-md-6 col-12">
    <!-- product item start -->
    <div class="item h-100 d-flex bg-white rounded-0 align-items-center">

        <div
            class="col-lg-8 col-md-7 col-sm-8 col-7 h-100 position-relative py-2 {{ session()->get('direction') == 2 ? 'pe-sm-3 pe-2 ps-2' : 'ps-sm-3 ps-2 pe-2' }}">
            <div class="item-content p-0">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <p class="item-title text-muted fs-8 cursor-auto text-truncate">
                        {{ @$getproductdata['category_info']->name }}
                    </p>
                    @if (@helper::checkaddons('product_reviews'))
                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex"><i class="text-warning fa-solid fa-star px-1"></i><span
                                    class="text-dark fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif
                    @endif
                </div>

                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                    <p class="text-dark product-name line-2 h-49">{{ $getproductdata->name }}</p>
                </a>

            </div>

            <div class="p-0">
                <h6
                    class="text-dark fs-7 d-sm-flex flex-wrap product-price cursor-auto text-truncate align-items-center mt-lg-3 mt-2 mb-2">

                    {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                    @if ($original_price > $price)
                        <del
                            class="text-muted fs-8 fw-normal d-block px-sm-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                    @endif

                </h6>
            </div>
            <!-- options -->
            <ul class="option-wrap d-flex gap-2 align-items-center d-grid product_icon2 mt-3">
                @if (@helper::checkaddons('customer_login'))
                    @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                        <li tooltip="Wishlist" class="rounded-0 shadow">
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
                <li tooltip="{{ trans('labels.view') }}" class="rounded-0 shadow">
                    <a class="option-btn circle-round wishlist-btn rounded-0"
                        onclick="productview('{{ $getproductdata->id }}')">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                </li>
                @if (helper::appdata($vendordata->id)->online_order == 1)
                    <li tooltip="{{ trans('labels.addtocart') }}" class="rounded-0 shadow">
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
        </div>
        <!-- img start -->
        <div class="col-lg-4 col-md-5 col-sm-4 col-5 item-img position-relative">
            <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                <img src="{{ $getproductdata['product_image']->image_url }}" alt="product image"
                    class="object-fit-cover img-1 rounded-0">
                <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                    class="w-100 img-2 rounded-0" alt="">
            </a>
            @if ($off > 0)
                <div class="off-label-15 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                    <div class="sale-label-15 rounded-0">{{ $off }}% {{ trans('labels.off') }}</div>
                </div>
            @endif
        </div>
    </div>
</div>

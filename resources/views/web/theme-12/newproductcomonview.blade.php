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
<div class="col-xl-4 col-lg-6 col-md-6 col-12">
    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
        <!-- product item start -->
        <div class="item h-100 p-2 d-flex bg-primary-rgb rounded-4 align-items-center border border-dark">
            <div class="col-7 {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">
                <div class="item-content p-0 h-80">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <p class="item-title text-muted fs-8 text-lightslategray  cursor-auto text-truncate">
                            {{ @$getproductdata['category_info']->name }}
                        </p>

                        @if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
                            <p class="fs-8 d-flex">
                                <i
                                    class="text-warning fa-solid fa-star {{ session()->get('direction') == 2 ? 'ps-1' : 'pe-1' }}"></i>
                                <span
                                    class="text-dark  fs-8 fw-500">{{ number_format($getproductdata->ratings_average, 1) }}</span>
                            </p>
                        @endif

                    </div>

                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                        <p class="text-dark product-name line-2">{{ $getproductdata->name }}</p>
                    </a>

                </div>

                <div class="p-0">
                    <h6 class="text-dark fs-7 fw-semibold product-price-size mt-3 mb-2 cursor-auto text-truncate">

                        {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
                        @if ($original_price > $price)
                            <del
                                class="text-muted fs-8 fw-normal d-block mt-1">{{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}</del>
                        @endif
                    </h6>
                    <!-- add to cart start -->
                    @if (helper::appdata($vendordata->id)->online_order == 1)
                        <div class="theme-12-cart d-flex justify-content-center w-100 mt-2">
                            @if ($getproductdata->has_variation == 1)
                                <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                                    class="option-btn addtocart-btn rounded-4 text-dark w-100">
                                    <div class="btn btn-secondary w-100 rounded-4">
                                        <p class="fw-500 fs-7 text-capitalize d-flex justify-content-center">
                                            <i class="fa-sharp fa-regular fa-cart-plus px-2  d-lg-block d-none"></i>
                                            {{ trans('labels.addtocart') }}
                                        </p>
                                    </div>
                                </a>
                            @else
                                <a class="option-btn addtocart-btn rounded-4 cursor-pointer w-100"
                                    onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                                    <div class="btn btn-secondary w-100 rounded-4">
                                        <p class="fw-500 fs-7 text-capitalize d-flex justify-content-center">
                                            <i class="fa-sharp fa-regular fa-cart-plus px-2  d-lg-block d-none"></i>
                                            {{ trans('labels.addtocart') }}
                                        </p>
                                    </div>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- img start -->
            <div class="col-5">
                <div class="item-img position-relative">
                    <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
                        <img src="{{ $getproductdata['product_image']->image_url }}" alt=""
                            class="w-100 object-fit-cover img-1 rounded-4">
                        <img src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}"
                            class="w-100 img-2 rounded-4" alt="">
                    </a>
                    @if ($off > 0)
                        <div class="off-label-two-12 {{ session()->get('direction') == 2 ? 'rtl' : ' ' }}">
                            <div class="sale-label-12">{{ $off }}% {{ trans('labels.off') }}</div>
                        </div>
                    @endif
                    <!-- options -->
                    <ul
                        class="option-wrap justify-content-center d-flex align-items-center d-grid product_icon2 mt-2 px-2 w-100">
                        @if (@helper::checkaddons('customer_login'))
                            @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                                <li tooltip="Wishlist" class="rounded-3 mx-2">
                                    <a onclick="managefavorite('{{ $getproductdata->id }}',{{ $vendordata->id }},'{{ URL::to(@$vendordata->slug . '/managefavorite') }}')"
                                        class="option-btn circle-round wishlist-btn rounded-3">
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
                        <li tooltip="{{ trans('labels.view') }}" class="rounded-circle mx-2">
                            <a class="option-btn circle-round wishlist-btn rounded-3"
                                onclick="productview('{{ $getproductdata->id }}')">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- options -->
                </div>
            </div>
        </div>
    </a>
</div>

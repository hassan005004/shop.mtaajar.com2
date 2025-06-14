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

<div class="card h-100 product-grid bg-white rounded-3 overflow-hidden">

    <div class="product-image">
        <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}" class="image">
            <img class="pic-1" src="{{ $getproductdata['product_image']->image_url }}">
            <img class="pic-2"
                src="{{ $getproductdata['multi_image']->count() > 1 ? $getproductdata['multi_image'][1]->image_url : $getproductdata['multi_image'][0]->image_url }}">
        </a>
        @if ($off > 0)
            <span class="theme-19-ribbon">
                <h3>{{ $off }}% {{ trans('labels.off') }}</h3>
            </span>
        @endif
        <ul class="product-links text-center">
            @if (helper::appdata($vendordata->id)->online_order == 1)
                <li class="fs-7">
                    @if ($getproductdata->has_variation == 1)
                        <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}"
                            class="fs-7 fw-500">
                            {{ trans('labels.addtocart') }}
                        </a>
                    @else
                        <a class="option-btn addtocart-btn rounded-0 fs-7 fw-500 cursor-pointer w-100"
                            onclick="calladdtocart('{{ $getproductdata->id }}','{{ $getproductdata->slug }}','{{ $getproductdata->name }}','{{ $getproductdata['product_image'] == null ? 'product.png' : $getproductdata['product_image']->image }}','{{ $getproductdata->tax }}','{{ $price }}','','{{ URL::to(@$vendordata->slug . '/cart/add') }}','0')">
                            {{ trans('labels.addtocart') }}
                        </a>
                    @endif
                </li>
            @endif
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
        </ul>
    </div>
    <div class="card-body border-top">
        <div class="d-flex align-items-center gap-1 mb-2 justify-content-between">
            <span class="fs-7 fw-500 text-muted m-0 line-1">{{ @$getproductdata['category_info']->name }}</span>
            <p class="fs-8 d-flex align-items-center">
                <i class="text-warning fs-8 fa-solid fa-star"></i>
                <span class="text-dark fw-500 fs-8">
                    {{ number_format($getproductdata->ratings_average, 1) }}
                </span>
            </p>
        </div>
        <a href="{{ URL::to(@$vendordata->slug . '/products/' . $getproductdata->slug) }}">
            <h3 class="title line-2 m-0 border-bottom-0">
                {{ $getproductdata->name }}
            </h3>
        </a>
    </div>
    <div class="card-footer pt-0 pb-3">
        <h5 class="fs-7 price m-0 fw-bold product-price align-items-center gap-1 d-flex flex-wrap w-100 text-truncate">
            {{ helper::currency_formate($price, $getproductdata->vendor_id) }}
            @if ($original_price > $price)
                <del class="text-muted fs-8 fw-600 d-block">
                    {{ helper::currency_formate($original_price, $getproductdata->vendor_id) }}
                </del>
            @endif
        </h5>
    </div>
</div>

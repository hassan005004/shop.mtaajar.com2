<img src="{{ helper::image_path($productdata->image) }}" class="rounded-3">

<div class="card border-0">
    <h6 class="heading text-capitalize">
    @if (strlen($productdata->name) > 30)
    {{substr($productdata->name, 0, 30) . '...'}}
    @else
    {{$productdata->name}}
    @endif
    </h6>

    <p class="info line-2">
        {{ trans('labels.recently_purchased') }}
    </p>
    <div class="read-more-wrapper">
        <a href="{{  URL::to($vendordata->slug . '/products/' . $productdata->slug) }}">
            <span class="read-more text-primary text-decoration-underline">{{ trans('labels.view_product') }}</span>
        </a>
    </div>
</div>
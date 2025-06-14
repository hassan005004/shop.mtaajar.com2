<meta name="theme-color" content="{{ helper::appdata($vendordata->id)->theme_color }}">
<meta name="background-color" content="{{ helper::appdata($vendordata->id)->background_color }}">
<link rel="apple-touch-icon" href="{{ helper::image_path(helper::appdata($vendordata->id)->app_logo) }}">
<link rel="manifest"
    href='data:application/manifest+json,{"name": "{{ helper::appdata($vendordata->id)->app_name }}","short_name": "{{ helper::appdata($vendordata->id)->app_title }}","icons": [{"src": "{{ helper::image_path(helper::appdata($vendordata->id)->app_logo) }}", "sizes": "512x512", "type": "image/png"}, {"src": "{{ helper::image_path(helper::appdata($vendordata->id)->app_logo) }}", "sizes": "1024x1024", "type": "image/png"}, {"src": "{{ helper::image_path(helper::appdata($vendordata->id)->app_logo) }}", "sizes": "1024x1024", "type": "image/png"}], "start_url": "{{ request()->url() }}","display": "standalone","prefer_related_applications":"false" }'>


{{-- Popup --}}
<div class="d-block d-md-none">
    <div class="pwa">
        <div class="d-flex gap-2 align-items-center">
            <div class="pwa-image">
                <img src="{{ helper::image_path(@helper::appdata($vendordata->id)->app_logo) }}"
                    class="object-fit-cover" alt="">
            </div>
            <div class="pwa-content">
                <h6 class="text-white mb-1 line-1">{{ helper::appdata($vendordata->id)->app_name }}</h6>
                <p class="m-0 fs-8 line-1">{{ helper::appdata($vendordata->id)->app_title }}</p>
            </div>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <a class="btn mobile-install-btn m-0" id="mobile-install-app">{{ trans('labels.install') }}</a>
            <a id="close-btn">
                <i class="fa-solid fa-xmark fs-7"></i>
            </a>
        </div>
    </div>
</div>
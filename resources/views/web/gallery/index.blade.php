@extends('web.layout.default')
@section('contents')
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark fw-600" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('labels.gallery') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <section class="gallery my-5">
        <div class="container">
            <div class="popup-gallery grid-wrapper">
                @foreach ($images as $key => $image)
                    <?php
                    $rdiv = ['', 'tall', 'big', 'wide'];
                    $rand_keys = array_rand($rdiv);
                    ?>
                    <a href="{{ helper::image_path($image->image) }}" class="{{ $rdiv[$rand_keys] }}">
                        <img src="{{ helper::image_path($image->image) }}" alt=""
                            class="w-100 h-100 rounded-4 object-fit-cover" />
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('scripts')    
<script>
    $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    // return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });
    });
</script>
@endsection

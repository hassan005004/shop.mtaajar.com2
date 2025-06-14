@extends('web.layout.default')
@section('contents')
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }}"><a
                            class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item ' }} active"
                        aria-current="page">{{ trans('labels.faqs') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <section class="my-5">
        <div class="container">
            @if ($faqs->count() > 0)
                <div class="accordion faq-accordion" id="accordionExample">
                    @foreach ($faqs as $key => $faq)
                        <div class="accordion-item mb-3 border">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button fw-600 fs-16 justify-content-between m-0 text-dark {{ $key != 0 ? 'collapsed' : '' }} {{ session()->get('direction') == 2 ? 'rtl' : '' }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}"
                                    aria-expanded="true" aria-controls="collapse{{ $key }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $key }}"
                                class="accordion-collapse collapse rounded {{ $key == 0 ? 'show' : '' }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="fs-7">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            @else
                @include('web.nodata')
            @endif

        </div>
    </section>
@endsection

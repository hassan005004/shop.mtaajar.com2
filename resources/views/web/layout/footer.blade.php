<!-- FOOTER AREA START -->
@if (count(Helper::footer_features(@$vendordata->id)) > 0)
    <div class="bg-body-secondary footers extra-margin">
        <div class="container py-4">
            <div class="d-lg-block d-none">
                <div class="row justify-content-center border-bottom">
                    @foreach (Helper::footer_features(@$vendordata->id) as $feature)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-2">
                            <div class="footer-widget">
                                <div class="widget-wrapper d-flex align-items-start justify-content-center">
                                    <div class="fs-4 widget-icon text-dark"> {!! $feature->icon !!} </div>
                                    <div class="widget-content px-3">
                                        <h6 class="text-primary fw-600 text-dark mb-0 text-truncate">
                                            {{ $feature->title }}</h6>
                                        <p class="fs-7 line-2">{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="footer-fiechar-slider owl-carousel owl-theme d-lg-none">
                @foreach (Helper::footer_features(@$vendordata->id) as $feature)
                    <div class="item">
                        <div class="col">
                            <div class="footer-widget">
                                <div class="widget-wrapper d-flex align-items-start justify-content-center">
                                    <div class="fs-4 widget-icon text-dark"> {!! $feature->icon !!} </div>
                                    <div class="widget-content px-3">
                                        <h6 class="text-primary fw-600 text-dark mb-0 text-truncate">
                                            {{ $feature->title }}</h6>
                                        <p class="fs-7 line-2">{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
<footer class="mb-lg-0 pb-lg-0 mb-5 pb-2 d-lg-block d-none">
    <div class="border-bottom footer-py border-light bg-body-secondary">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-12 mb-3">
                    <div class="footer-content">
                        <a href="#">
                            <img src="{{ helper::image_path(@helper::appdata(@$vendordata->id)->logo) }}"
                                class="object-fit-contain logo-h-50-px" alt="footer_logo">
                        </a>
                        <p class="mt-4 mb-3 fs-15 text-dark line-3">
                            {{ @helper::appdata(@$vendordata->id)->footer_description }}
                        </p>
                        <div class="mb-1 d-flex align-items-center"> <i
                                class="fa-regular fa-house fs-7 text-dark {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}"></i>
                            <span class="fs-7 text-dark">{{ @helper::appdata(@$vendordata->id)->address }}</span>
                        </div>
                        <div class="mb-1 d-flex align-items-center"> <i
                                class="fa-regular fa-phone fs-7 text-dark {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}"></i>
                            <a href="tel:{{ helper::appdata($vendordata->id)->contact }}"><span
                                    class="fs-7 text-dark">{{ @helper::appdata(@$vendordata->id)->contact }}</span></a>
                        </div>
                        <div class="mb-1 d-flex align-items-center"> <i
                                class="fa-regular fa-envelope fs-7 text-dark {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}"></i>
                            <a href="mailto:{{ helper::appdata($vendordata->id)->email }}"> <span
                                    class="fs-7 text-dark">{{ @helper::appdata(@$vendordata->id)->email }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row justify-content-md-around">
                        <div class="col-lg-3 col-6 mb-3">
                            <div class="footer-content">
                                <p class="text-dark fw-600 mb-3 text-capitalize fs-5">{{ trans('labels.information') }}
                                </p>
                                <ul class="fs-7">
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/shop_all') }}">{{ trans('labels.shop_all') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/categories') }}">{{ trans('labels.categories') }}</a>
                                    </li>
                                    @if (@helper::checkaddons('subscription'))
                                        @if (@helper::checkaddons('blog'))
                                            @php
                                                $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                                                    ->orderByDesc('id')
                                                    ->first();

                                                if ($vendordata->allow_without_subscription == 1) {
                                                    $blogs = 1;
                                                } else {
                                                    $blogs = @$checkplan->blogs;
                                                }
                                            @endphp
                                            @if ($blogs == 1)
                                                <li class="mb-1"><a class="text-dark"
                                                        href="{{ URL::to(@$vendordata->slug . '/blogs') }}">{{ trans('labels.blog') }}</a>
                                                </li>
                                            @endif
                                        @endif
                                    @else
                                        @if (@helper::checkaddons('blog'))
                                            <li class="mb-1"><a class="text-dark"
                                                    href="{{ URL::to(@$vendordata->slug . '/blogs') }}">{{ trans('labels.blog') }}</a>
                                            </li>
                                        @endif
                                    @endif

                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/gallery') }}">{{ trans('labels.gallery') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/find-order') }}">{{ trans('labels.Track_Order') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 mb-3">
                            <div class="footer-content">
                                <p class="text-dark fw-600 mb-3 text-capitalize fs-5">{{ trans('labels.get_help') }}
                                </p>
                                <ul class="fs-7">
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/termscondition') }}">{{ trans('labels.terms_condition') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/privacypolicy') }}">{{ trans('labels.privacy_policy') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/refund_policy') }}">{{ trans('labels.refund_policy') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/aboutus') }}">{{ trans('labels.about_us') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/contact-us') }}">{{ trans('labels.help_contact') }}</a>
                                    </li>
                                    <li class="mb-1"><a class="text-dark"
                                            href="{{ URL::to(@$vendordata->slug . '/faqs') }}">{{ trans('labels.faqs') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-4 col-12 col-auto mb-3">
                            <div class="footer-content">
                                <div class="mb-3">
                                    <p class="text-dark fw-600 mb-3 text-capitalize fs-5">
                                        {{ trans('labels.follow_us') }}</p>
                                    <ul class="follow d-flex flex-wrap g-16">
                                        @foreach (@helper::getsociallinks($vendordata->id) as $links)
                                            <li class="mb-1"><a class="social-rounded fb p-0"
                                                    href="{{ $links->link }}" target="_blank"
                                                    class="social-rounded fb p-0">{!! $links->icon !!}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="subscribe-box">
                                    <p class="text-dark fw-600 mb-3 text-capitalize fs-5">
                                        {{ trans('labels.subscribe') }}</p>
                                    <span
                                        class="text-dark fs-7">{{ trans('labels.footer_subscribe_subtitle') }}</span>
                                </div>
                                <form action="{{ URL::to($vendordata->slug . '/subscribe') }}" method="POST"
                                    class="mt-3">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control fs-7 border text-dark fw-500 rounded-0 bg-white {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}"
                                            name="subscribe_email" placeholder="example@yormailer.com" required>
                                        <button class="btn btn-primary fs-7 fw-600 rounded-0 mb-0"
                                            type="submit">{{ trans('labels.subscribe') }} </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-body-secondary py-3 border-top">
        <div class="container text-center text-dark d-md-flex align-items-center justify-content-between">
            <p class="mb-2 mb-dm-0">{{ @helper::appdata(@$vendordata->id)->copyright }}</p>
            @php
                $paymentlist = helper::paymentlist($vendordata->id);
            @endphp
            <ul class="footer_acceped_card d-flex flex-wrap gap-2 justify-content-center m-0">
                @foreach ($paymentlist as $payment)
                    <li><img src="{{ helper::image_path($payment->image) }}" class="h-30px" alt=""></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
<!-- FOOTER AREA END -->

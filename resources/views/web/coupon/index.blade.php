@if (@helper::checkaddons('subscription'))
    @if (@helper::checkaddons('coupon'))
        @php
            
            $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                ->orderByDesc('id')
                ->first();
            if ($vendordata->allow_without_subscription == 1) {
                $coupon = 1;
            } else {
                $coupon = @$checkplan->coupons;
            }
            
        @endphp
        @if ($coupon == 1)
            <section class="top-bar-offer bg-primary d-flex align-items-center py-md-3 py-2 my-md-5 my-4 {{ session()->get('direction') == 2 ? 'rtl' : '' }}">
                <marquee class="text-center" direction="{{ session()->get('direction') == 2 ? 'left' : 'right' }}" behavior="scroll" onmouseover="this.stop();"
                    onmouseout="this.start();">
                    @foreach ($coupons as $coupon)
                        <span>{{ $coupon->offer_name }} : {{ $coupon->offer_code }}</span>
                    @endforeach
                </marquee>
            </section>
        @endif
    @endif
@else
    @if (@helper::checkaddons('coupon'))
        <section class="top-bar-offer bg-primary d-flex align-items-center py-md-3 py-2 my-md-5 my-4">
            <marquee class="text-center" direction="right" behavior="scroll" onmouseover="this.stop();"
                onmouseout="this.start();">
                @foreach ($coupons as $coupon)
                    <span>{{ $coupon->offer_name }} : {{ $coupon->offer_code }}</span>
                @endforeach
            </marquee>
        </section>
    @endif
@endif

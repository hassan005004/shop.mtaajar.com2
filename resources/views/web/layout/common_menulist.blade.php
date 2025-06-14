<ul class="main-menu">

    <li><a href="{{ URL::to(@$vendordata->slug . '/') }}"
            class="{{ request()->is(@$vendordata->slug) ? 'active' : '' }} {{ request()->is('/') ? 'active' : '' }}">{{ trans('labels.home') }}</a>
    </li>

    <li><a href="{{ URL::to(@$vendordata->slug . '/shop_all') }}"
            class="{{ request()->is(@$vendordata->slug . '/shop_all') ? 'active' : '' }} {{ request()->is('shop_all') ? 'active' : '' }}">{{ trans('labels.shop_all') }}</a>
    </li>
    <li><a href="{{ URL::to(@$vendordata->slug . '/categories') }}"
            class="{{ request()->is(@$vendordata->slug . '/categories*') || request()->is(@$vendordata->slug . '/products') ? 'active' : '' }} {{ request()->is('categories*') ? 'active' : '' }} {{ request()->is('products') ? 'active' : '' }}">{{ trans('labels.categories') }}</a>
    </li>

    <li><a href="{{ URL::to(@$vendordata->slug . '/aboutus') }}"
            class="{{ request()->is(@$vendordata->slug . '/aboutus') ? 'active' : '' }} {{ request()->is('aboutus') ? 'active' : '' }}">{{ trans('labels.about_us') }}</a>
    </li>

    <li><a href="{{ URL::to(@$vendordata->slug . '/gallery') }}"
            class="{{ request()->is(@$vendordata->slug . '/gallery') ? 'active' : '' }} {{ request()->is('gallery') ? 'active' : '' }}">{{ trans('labels.gallery') }}</a>
    </li>
    @if (@helper::checkaddons('subscription'))
        @if (@helper::checkaddons('blog'))
            @php
                $checkplan = App\Models\Transaction::where('vendor_id', $vendordata->id)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', $vendordata->id)->first();
                if ($user->allow_without_subscription == 1) {
                    $blogs = 1;
                } else {
                    $blogs = @$checkplan->blogs;
                }
            @endphp
            @if ($blogs == 1)
                <li><a href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                        class="{{ request()->is(@$vendordata->slug . '/blogs*') ? 'active' : '' }} {{ request()->is('blogs*') ? 'active' : '' }}">{{ trans('labels.blog') }}</a>
                </li>
            @endif
        @endif
    @else
        @if (@helper::checkaddons('blog'))
            <li><a href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                    class="{{ request()->is(@$vendordata->slug . '/blogs*') ? 'active' : '' }} {{ request()->is('blogs*') ? 'active' : '' }}">{{ trans('labels.blog') }}</a>
            </li>
        @endif
    @endif


    <li><a href="{{ URL::to(@$vendordata->slug . '/contact-us') }}"
            class="{{ request()->is(@$vendordata->slug . '/contact-us') ? 'active' : '' }} {{ request()->is('contact-us') ? 'active' : '' }}">{{ trans('labels.help_contact') }}</a>
    </li>

    <li><a href="{{ URL::to(@$vendordata->slug . '/find-order') }}"
            class="{{ request()->is(@$vendordata->slug . '/find-order*') ? 'active' : '' }} {{ request()->is('find-order*') ? 'active' : '' }}">{{ trans('labels.find_my_order') }}</a>
    </li>

</ul>

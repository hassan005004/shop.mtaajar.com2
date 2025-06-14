<!-- NAVBAR AREA START -->
<!-- FOR LARGE DEVICES -->
<section class="support-bar-area">
    <div class="container">
        <div class="row justify-content-between align-items-center py-2">
            <div class="col-auto">
                <div class="logo-wrapper navbar-brand p-2">
                    <a href="{{ URL::to(@$vendordata->slug) }}">
                        <img src="{{ helper::image_path(@helper::appdata(@$vendordata->id)->logo) }}"
                            class="w-100 object-fit-contain logo-h-45-px" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-2 col-auto d-none d-md-block">
                <div class="d-none d-md-block">
                    @include('web.layout.searchbox')
                </div>
            </div>
            <!-- lag-btn -->
            @if (@helper::checkaddons('language'))
                <div class="col-lg-2 col-md-3 col-sm-6 col-auto">
                    <div class="dropdown-center float-end d-none d-md-block">
                        <button class="btn text-white border-white dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ helper::image_path(session()->get('flag')) }}"
                                class="lag-img img-fluid lag-img mx-1" alt="">{{ session()->get('language') }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach (helper::listoflanguage() as $languagelist)
                                <li>
                                    <a class="dropdown-item text-dark d-flex text-start"
                                        href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                        <img src="{{ helper::image_path($languagelist->image) }}" alt=""
                                            class="img-fluid mx-1" width="25px">
                                        {{ $languagelist->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- lag-btn -->

                    <!-- moblie-lag-btn -->
                    <div class="dropdown-center d-block d-md-none">
                        <button class="btn text-white border-white dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-globe fs-6"></i>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach (helper::listoflanguage() as $languagelist)
                                <li>
                                    <a class="dropdown-item text-dark d-flex text-start" href="#">
                                        <img src="{{ helper::image_path($languagelist->image) }}" alt=""
                                            class="img-fluid mx-1" width="25px">
                                        {{ $languagelist->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- moblie-lag-btn -->
                </div>
            @endif
        </div>
    </div>
</section>
<section class="navbar-area">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 col-md-4 col-5">
                <div class="d-none d-xl-block">
                    <a class="top-category">
                        <!-- <i class="fa-solid fa-bars"></i> -->
                        <h5 class="mx-2 fw-600">{{ trans('labels.top_categories') }}</h5>
                    </a>
                </div>
                <!-- new top categories slider -->
                <button class="btn bg-secondary new-slider btn-secondary my-3 px-3 d-flex d-xl-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#top-categories"
                    aria-controls="offcanvasWithBothOptions">{{ trans('labels.top_categories') }}</button>

                <div class="offcanvas offcanvas-width  {{ session()->get('direction') == 2 ? 'offcanvas-end' : 'offcanvas-start' }}"
                    data-bs-scroll="false" tabindex="-1" id="top-categories"
                    aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        @if (count(helper::getcategories(@$vendordata->id, '')) > 0)
                            <ul class="list-group list-group-flush">
                                @foreach (helper::getcategories(@$vendordata->id, '') as $categorydata)
                                    <li class="list-group-item px-0">
                                        <a class="d-flex align-items-center"
                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                            <img src="{{ helper::image_path($categorydata->image) }}" alt=""
                                                class="img-fluid rounded categories-sm-img">
                                            <span class="mx-2 text-truncate">{{ $categorydata['name'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <!-- new top categories slider -->

                <!-- FOR LARGE DEVICE TOP CATEGORIES -->
                <div class="myCategories d-none">
                    <div class="cats_menu">
                        @if (count(helper::getcategories(@$vendordata->id, '7')) > 0)
                            <ul>
                                @foreach (helper::getcategories(@$vendordata->id, '7') as $categorydata)
                                    @if (count(helper::getsubcategories($categorydata->id, '7')) > 0)
                                        <li
                                            class="active {{ session()->get('direction') == 2 ? 'has-sub-rtl' : 'has-sub' }}">
                                            <a class="py-2 d-flex align-items-center"
                                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                                <img src="{{ helper::image_path($categorydata->image) }}"
                                                    alt="" class="img-fluid rounded categories-sm-img">
                                                <span class="mx-2 text-truncate">{{ $categorydata['name'] }}</span>
                                            </a>
                                            <ul
                                                class="{{ session()->get('direction') == 2 ? 'rtl-position' : 'has-sub' }}">
                                                @foreach (helper::getsubcategories($categorydata->id, '') as $subcatdata)
                                                    <li><a class="has-sub"
                                                            href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug'] . '/subcategory-' . $subcatdata->slug) }}"><span>{{ $subcatdata->name }}</span></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a class="py-2"
                                                href="{{ URL::to(@$vendordata->slug . '/category?category=' . $categorydata['slug']) }}">
                                                <img src="{{ helper::image_path($categorydata->image) }}"
                                                    alt="" class="img-fluid rounded categories-sm-img">
                                                <span class="mx-2 text-truncate">{{ $categorydata['name'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                <li class="text-center"><a href="{{ URL::to(@$vendordata->slug . '/categories') }}">
                                        {{ trans('labels.viewall') }} <i
                                            class="fa-regular fa-arrow-{{ @helper::appdata(@$vendordata->id)->web_layout == 2 ? 'left' : 'right' }} mx-2"></i></a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-4 d-none d-lg-block">
                @include('web.layout.common_menulist')
            </div>
            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-end">
                <ul class="right-btn-wrapper">
                    <li class="search-input m-0 d-block d-md-none">
                        <!-- Home Search Button trigger modal -->
                        <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fa-light fa-magnifying-glass text-white mx-1 fs-25-px"></i>
                        </button>
                    </li>

                    <li class="shopping-cart"><a href="{{ URL::to(@$vendordata->slug . '/cart') }}"
                            class="cart-dropdown-btn"><span
                                class="cart-count text-white">{{ helper::getcartcount(@$vendordata->id, session()->getId(), Auth::user() && Auth::user()->type == 3 ? Auth::user()->id : '') }}</span>
                            <i class="fa-light fa-bag-shopping text-white mx-1 fs-25-px"></i>
                    </li>
                </ul>
                <div>
                </div>
                @if (Auth::user() && Auth::user()->type == 3)
                    <div class="dropdown p-0 m-1">
                        <div class="d-flex align-items-center">
                            <i class="fa-light fa-user text-white mx-2 fs-25-px"></i>
                            <div>
                                <button
                                    class="border-0 bg-primary dropdown-toggle text-white d-flex align-items-center"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-primary-color d-none d-md-block  mx-1">
                                        {{ Auth::user()->name }}</span>
                                </button>
                                <ul class="dropdown-menu p-0 dropdown-hover">
                                    <a class="dropdown-item text-dark rounded-2"
                                        href="{{ URL::to('/' . $vendordata->slug . '/profile') }}"><i
                                            class="fa-solid fa-user {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}"></i>{{ trans('labels._Account') }}
                                    </a>
                                    <a class="dropdown-item theme-1-dropdown-menu rounded-2"
                                        href="{{ URL::to('/' . $vendordata->slug . '/logout') }}"><i
                                            class="fa-solid fa-arrow-right-from-bracket {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}"></i>{{ trans('labels.logout') }}
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <li class="m-1">
                        <div class="">
                            <a href="{{ URL::to($vendordata->slug . '/login') }}"
                                class="text-white d-flex align-items-center">
                                <i class="fa-light fa-user text-white mx-2 fs-25-px"></i>
                            </a>
                        </div>
                    </li>
                @endif
                <!-- new hamburger menu slider -->
                <button class="btn btn-primary new-slider p-1 d-lg-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#hamburger-menu" aria-controls="offcanvasWithBothOptions">
                    <i class="fa-regular fa-bars text-white fs-25-px"></i>
                </button>

                <div class="offcanvas offcanvas-width {{ session()->get('direction') == 2 ? 'offcanvas-start' : 'offcanvas-end' }}"
                    data-bs-scroll="false" tabindex="-1" id="hamburger-menu"
                    aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="slider-menu">
                            <li class="border-bottom m-0">
                                <a href="{{ URL::to(@$vendordata->slug . '/') }}"
                                    class="slider-link {{ request()->is($vendordata->slug) ? 'active' : '' }}">{{ trans('labels.home') }}</a>
                            </li>
                            <li class="border-bottom m-0">
                                <a href="{{ URL::to(@$vendordata->slug . '/categories') }}"
                                    class="slider-link {{ request()->is($vendordata->slug . '/categories') ? 'active' : '' }}">{{ trans('labels.categories') }}</a>
                            </li>
                            <li class="border-bottom m-0">
                                <a href="{{ URL::to(@$vendordata->slug . '/shop_all') }}"
                                    class="slider-link {{ request()->is($vendordata->slug . '/shop_all') ? 'active' : '' }}">{{ trans('labels.shop_all') }}</a>
                            </li>
                            <li class="border-bottom m-0">
                                <a href="" class="fs-7 "></a>
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
                                        <li class="border-bottom m-0"><a
                                                href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                                                class="slider-link {{ request()->is($vendordata->slug . '/blogs') ? 'active' : '' }}">{{ trans('labels.blog') }}</a>
                                        </li>
                                    @endif
                                @endif
                            @else
                                @if (@helper::checkaddons('blog'))
                                    <li class="border-bottom m-0"><a
                                            href="{{ URL::to(@$vendordata->slug . '/blogs') }}"
                                            class="slider-link {{ request()->is($vendordata->slug . '/blogs') ? 'active' : '' }}">{{ trans('labels.blog') }}</a>
                                    </li>
                                @endif
                            @endif

                            <li class="border-bottom m-0"><a href="{{ URL::to(@$vendordata->slug . '/contact-us') }}"
                                    class="slider-link {{ request()->is($vendordata->slug . '/contact-us') ? 'active' : '' }}">{{ trans('labels.help_contact') }}</a>
                            </li>
                            <li class="border-bottom m-0"><a href="{{ URL::to(@$vendordata->slug . '/find-order') }}"
                                    class="slider-link {{ request()->is($vendordata->slug . '/find-order') ? 'active' : '' }}">{{ trans('labels.find_my_order') }}</a>
                            </li>
                            <li class="border-bottom m-0"><a href="{{ URL::to(@$vendordata->slug . '/faqs') }}"
                                    class="slider-link {{ request()->is($vendordata->slug . '/faqs') ? 'active' : '' }}">{{ trans('labels.faqs') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- new hamburger menu slider -->
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6 d-none d-lg-block">
                            <div class="Search-left-img">
                                <img src="{{ url(env('ASSETPATHURL') . 'web-assets/images/other/Search-left-img.png') }}"
                                    alt="search-left-img" class="w-100 object-fit-cover search-left-img">
                            </div>
                        </div>
                        <form class="" action="{{ URL::to(@$vendordata->slug . '/products') }}"
                            method="GET">
                            <div class="col-12 col-lg-6">
                                <div class="search-content text-capitalize">
                                    <h4 class="fs-1 text-dark fw-bolder mb-2">Search</h4>
                                    <p class="fs-3">what are you looking for ?</p>
                                </div>
                                <input type="text" placeholder="Search Product..."
                                    class="py-3 input-width px-2 mt-4 mb-1">
                                <p class="text-truncate">Ex.accessories, man, dresses, etc...
                                </p>
                                <div class="search-btn-group">
                                    <div class="row g-3 align-items-center mt-5">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger fs-7 w-100 rounded-0"
                                                data-bs-dismiss="modal">{{ trans('labels.cancel') }}</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit"
                                                class="btn btn-primary w-100 fs-7 rounded-0">{{ trans('labels.submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0"></div>
        </div>
    </div>
</div>

@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $user = App\Models\User::where('id', $vendor_id)->first();
@endphp
<header class="page-topbar">
    <div class="navbar-header">
        <button class="navbar-toggler d-lg-none d-md-block px-4" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarcollapse" aria-expanded="false" aria-controls="sidebarcollapse">
            <i class="fa-regular fa-bars fs-4"></i>
        </button>
        <div class="d-flex align-items-center gap-2">
            @if (session('vendor_login'))
                <a href="{{ URL::to('/admin/admin_back') }}"
                    class="btn btn-primary icon_box btn-hover btn-sm tooltip-bottom">
                    <i class="fa-regular fa-user"></i>
                </a>
            @endif
            @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                <a class="btn btn-secondary icon_box btn-sm mx-1"
                    href="@if (helper::checkcustomdomain($vendor_id) == null) {{ URL::to('/' . $user->slug) }} @else {{ '//' . helper::checkcustomdomain($vendor_id) }} @endif"
                    target="_blank"><i class="fa-solid fa-link"></i>
                </a>
            @endif
            <!-- dekstop-tablet-mobile-language-dropdown-button-start-->
            @if (@helper::checkaddons('language'))
                <div class="position-relative">
                    <div class="dropdown lag-btn">
                        <a class="btn btn-sm btn-primary icon_box btn-hover dropdown-toggle" href="#"
                            role="button" data-bs-toggle ="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-globe"></i>
                        </a>
                        <ul
                            class="dropdown-menu drop-menu border-0 p-0 bg-body-secondary shadow overflow-hidden {{ session()->get('direction') == 2 ? 'drop-menu-rtl' : 'drop-menu' }}">
                            @foreach (helper::available_language('') as $languagelist)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center px-3 py-2"
                                        href="{{ URL::to('/lang/change?lang=' . $languagelist->code) }}">
                                        <img src="{{ helper::image_path($languagelist->image) }}" alt=""
                                            class="img-fluid lag-img" width="25px">
                                        <span class="px-2">{{ $languagelist->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <!-- dekstop-tablet-mobile-language-dropdown-button-end-->
            <div class="dropwdown d-inline-block">
                <button class="btn header-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ helper::image_path(Auth::user()->image) }}">
                    <span class="d-none d-xxl-inline-block d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="fa-regular fa-angle-down d-none d-xxl-inline-block d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu box-shadow">
                    <a href="{{ URL::to('admin/settings') }}#editprofile"
                        class="dropdown-item d-flex align-items-center">
                        <i class="fa-light fa-address-card fs-5 mx-2"></i>{{ trans('labels.edit_profile') }}
                    </a>
                    <a href="{{ URL::to('admin/settings') }}#changepasssword"
                        class="dropdown-item d-flex align-items-center">

                        <i class="fa-light fa-lock-keyhole fs-5 mx-2"></i>{{ trans('labels.change_password') }}

                    </a>

                    <a href="javascript:void(0)" onclick="statusupdate('{{ URL::to('/admin/logout') }}')"
                        class="dropdown-item d-flex align-items-center">
                        <i class="fa-light fa-right-from-bracket fs-5 mx-2"></i>{{ trans('labels.logout') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

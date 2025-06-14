<div class="col-lg-3 col-xxl-3 mb-4 mb-lg-0 d-lg-block d-none">
    <div class="card-v border py-3 rounded">
        <div class="title-and-image">
            <img src="{{ helper::image_path(@Auth::user()->image) }}" alt=""
                class="object-fit-cover img-fluid profile-img rounded-circle d-flex justify-content-center m-auto">
            <h5 class="text-dark mt-2 mx-3 text-center">{{ Auth::user()->name }}</h5>
        </div>
        <div class="user-list-saide-bar mt-4 bg-white rounded-1">
            <ul class="m-0 fs-15">
                <a href="{{ URL::to($vendordata->slug . '/profile/') }}" class="settings-link">
                    <li
                        class="list-unstyled border-0 text-dark my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/profile') ? 'account-active' : '' }}">
                        <i class="fa-light fa-user col-auto"></i>
                        <span class="px-2 d-block">{{ trans('labels.edit_profile') }}
                        </span>
                    </li>
                </a>
                @if (@Auth::user()->google_id == '' && @Auth::user()->facebook_id == '')
                    <a href="{{ URL::to($vendordata->slug . '/change-password/') }}" class="settings-link">
                        <li
                            class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/change-password') ? 'account-active' : '' }}">
                            <i class="fa-light fa-lock col-auto"></i>
                            <span class="px-2 d-block">{{ trans('labels.change_password') }}
                            </span>
                        </li>
                    </a>
                @endif
                <a href="{{ URL::to($vendordata->slug . '/orders/') }}" class="settings-link ">
                    <li
                        class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/orders') ? 'account-active' : '' }}">
                        <i class="fa-light fa-list-ol col-auto"></i>
                        <span class="px-2 d-block">{{ trans('labels.orders') }}
                        </span>
                    </li>
                </a>
                @if (helper::allpaymentcheckaddons($vendordata->id))
                    <a href="{{ URL::to($vendordata->slug . '/wallet/') }}" class="settings-link ">
                        <li
                            class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/wallet') || request()->is($vendordata->slug . '/addmoneywallet') ? 'account-active' : '' }}">
                            <i class="fa-light fa-wallet col-auto"></i>
                            <span class="px-2 d-block">{{ trans('labels.wallet') }}
                            </span>
                        </li>
                    </a>
                @endif
                <a href="{{ URL::to($vendordata->slug . '/favourite/') }}" class="settings-link ">
                    <li
                        class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/favourite') ? 'account-active' : '' }}">
                        <i class="fa-light fa-heart col-auto"></i>
                        <span class="px-2 d-block">{{ trans('labels.my_favorite_list') }}
                        </span>
                    </li>
                </a>
                <a href="{{ URL::to($vendordata->slug . '/refer-earn/') }}" class="settings-link ">
                    <li
                        class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/refer-earn') ? 'account-active' : '' }}">
                        <i class="fa-light fa-share-nodes col-auto"></i>
                        <span class="px-2 d-block">{{ trans('labels.refer_earn') }}
                        </span>
                    </li>
                </a>
                <a href="{{ URL::to($vendordata->slug . '/deleteprofile/') }}" class="settings-link ">
                    <li
                        class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/deleteprofile') ? 'account-active' : '' }}">
                        <i class="fa-light fa-trash col-auto"></i>
                        <span class="px-2 d-block">{{ trans('labels.delete_profile') }}
                        </span>
                    </li>
                </a>
                <a href="javascript:void(0)" onclick="statusupdate('{{ URL::to($vendordata->slug . '/logout') }}')"
                    class="settings-link ">
                    <li
                        class="list-unstyled text-dark border-0 my-1 py-3 px-3 d-flex align-items-center {{ request()->is($vendordata->slug . '/logout') ? 'account-active' : '' }}">
                        <i class="fa-light fa-arrow-right-from-bracket col-auto"></i>
                        <span class="px-2 d-block">
                            {{ trans('labels.logout') }}
                        </span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</div>

<div class="col-12 d-block d-lg-none mb-3">
    <div class="profile-menu bg-primary rounded">
        <div class="accordion-item rounded">
            <h2 class="accordion-header rounded">
                <button class="accordion-button rounded m-0 bg-primary d-flex gap-2 fw-500 p-3 collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo">
                    <i class="fa-solid fa-bars text-white"></i>
                    <p class="text-white">Dashboard Navigation</p>

                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse rounded-end overflow-hidden collapse"
                style="">
                <div class="accordion-body rounded">
                    <ul class="bg-primary w-100 text-start">
                        <a href="{{ URL::to($vendordata->slug . '/profile/') }}" class="settings-link">
                            <li
                                class="list-unstyled border-0 text-dark mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/profile') ? 'account-active' : '' }}">
                                <i class="fa-light fa-user col-auto"></i>
                                <span class="px-2 d-block">{{ trans('labels.edit_profile') }}
                                </span>
                            </li>
                        </a>
                        @if (@Auth::user()->google_id == '' && @Auth::user()->facebook_id == '')
                            <a href="{{ URL::to($vendordata->slug . '/change-password/') }}" class="settings-link">
                                <li
                                    class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/change-password') ? 'account-active' : '' }}">
                                    <i class="fa-light fa-lock col-auto"></i>
                                    <span class="px-2 d-block">{{ trans('labels.change_password') }}
                                    </span>
                                </li>
                            </a>
                        @endif
                        <a href="{{ URL::to($vendordata->slug . '/orders/') }}" class="settings-link ">
                            <li
                                class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/orders') ? 'account-active' : '' }}">
                                <i class="fa-light fa-list-ol col-auto"></i>
                                <span class="px-2 d-block">{{ trans('labels.orders') }}
                                </span>
                            </li>
                        </a>
                        @if (helper::allpaymentcheckaddons($vendordata->id))
                            <a href="{{ URL::to($vendordata->slug . '/wallet/') }}" class="settings-link ">
                                <li
                                    class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/wallet') ? 'account-active' : '' }}">
                                    <i class="fa-light fa-wallet col-auto"></i>
                                    <span class="px-2 d-block">{{ trans('labels.wallet') }}
                                    </span>
                                </li>
                            </a>
                        @endif
                        <a href="{{ URL::to($vendordata->slug . '/favourite/') }}" class="settings-link ">
                            <li
                                class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/favourite') ? 'account-active' : '' }}">
                                <i class="fa-light fa-heart col-auto"></i>
                                <span class="px-2 d-block">{{ trans('labels.my_favorite_list') }}
                                </span>
                            </li>
                        </a>
                        <a href="{{ URL::to($vendordata->slug . '/refer-earn/') }}" class="settings-link ">
                            <li
                                class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/refer-earn') ? 'account-active' : '' }}">
                                <i class="fa-light fa-share-nodes col-auto"></i>
                                <span class="px-2 d-block">{{ trans('labels.refer_earn') }}
                                </span>
                            </li>
                        </a>
                        <a href="{{ URL::to($vendordata->slug . '/deleteprofile/') }}" class="settings-link ">
                            <li
                                class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/deleteprofile') ? 'account-active' : '' }}">
                                <i class="fa-light fa-trash col-auto"></i>
                                <span class="px-2 d-block">{{ trans('labels.delete_profile') }}
                                </span>
                            </li>
                        </a>
                        <a href="javascript:void(0)"
                            onclick="statusupdate('{{ URL::to($vendordata->slug . '/logout') }}')"
                            class="settings-link ">
                            <li
                                class="list-unstyled text-dark border-0 mb-2 p-3 fw-500 d-flex align-items-center {{ request()->is($vendordata->slug . '/logout') ? 'account-active' : '' }}">
                                <i class="fa-light fa-arrow-right-from-bracket col-auto"></i>
                                <span class="px-2 d-block">
                                    {{ trans('labels.logout') }}
                                </span>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

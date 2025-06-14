@extends('admin.layout.default')
@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $user = App\Models\User::where('id', $vendor_id)->first();
    @endphp
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.edit') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/roles') }}">{{ trans('labels.roles') }}</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.edit') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row g-2">
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    @php $modules = explode(',',$data->module); @endphp
                    <form action="{{ URL::to('admin/roles/update-' . $data->id) }}" method="post">
                        @csrf

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="">{{ trans('labels.role') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ trans('labels.role') }}" value="{{ $data->role }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <label class="col-form-label" for="">{{ trans('labels.system_modules') }} <span
                                class="text-danger">*</span> </label>
                        <div class="row bg-light py-3">
                            <div class="col-sm-4 col-6 cursor-pointer d-block">
                                <input class="form-check-input" type="checkbox" value="" name="checkall"
                                    id="checkall">
                                <label class="form-check-label fs-15 text-dark fw-600" for="checkall">
                                    {{ trans('labels.modules') }}
                                </label>
                            </div>
                            <div class="col-sm-8 col-6 d-block">
                                <label class="form-check-label fs-15 text-dark fw-600">
                                    {{ trans('labels.permissions') }}
                                </label>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 col-6" id="checkboxes">
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="dashboard"
                                        id="role_dashboard">
                                    <label class="cursor-pointer" for="role_dashboard">
                                        {{ trans('labels.dashboard') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('pos'))
                                        <?php
                                        if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                            $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        }
                                        if ($user->allow_without_subscription == 1) {
                                            $pos = 1;
                                        } else {
                                            $pos = @$checkplan->pos;
                                        }
                                        ?>
                                        @if ($pos == 1)
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="POS (Point Of Sale)" id="role_pos">
                                                <label class="cursor-pointer" for="role_pos">
                                                    {{ trans('labels.pos') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('pos'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="POS (Point Of Sale)" id="role_pos">
                                            <label class="cursor-pointer" for="role_pos">
                                                {{ trans('labels.pos') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="orders"
                                        id="role_orders">
                                    <label class="cursor-pointer" for="role_orders">
                                        {{ trans('labels.orders') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="reports"
                                        id="role_reports">
                                    <label class="cursor-pointer" for="role_reports">
                                        {{ trans('labels.reports') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('customer_login'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Customers"
                                            id="role_customers">
                                        <label class="cursor-pointer" for="role_customers">
                                            {{ trans('labels.customers') }}
                                        </label>
                                    </div>
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Categories"
                                        id="role_categories">
                                    <label class="cursor-pointer" for="role_categories">
                                        {{ trans('labels.categories') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Sub Categories"
                                        id="role_sub_categories">
                                    <label class="cursor-pointer" for="role_sub_categories">
                                        {{ trans('labels.sub_categories') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Products"
                                        id="role_products">
                                    <label class="cursor-pointer" for="role_products">
                                        {{ trans('labels.products') }}
                                    </label>
                                </div>

                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="import_Products" id="role_import_products">
                                    <label class="cursor-pointer" for="role_import_products">
                                        {{ trans('labels.product_upload') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Sliders"
                                        id="role_sliders">
                                    <label class="cursor-pointer" for="role_sliders">
                                        {{ trans('labels.sliders') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Banners"
                                        id="role_banner">
                                    <label class="cursor-pointer" for="role_banner">
                                        {{ trans('labels.banners') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('coupon'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $coupons = 1;
                                        } else {
                                            $coupons = @$checkplan->coupons;
                                        }
                                        ?>
                                        @if ($coupons == 1)
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Coupons" id="role_coupons">
                                                <label class="cursor-pointer" for="role_coupons">
                                                    {{ trans('labels.coupons') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('coupon'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Coupons" id="role_coupons">
                                            <label class="cursor-pointer" for="role_coupons">
                                                {{ trans('labels.coupons') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                @if (@helper::checkaddons('top_deals'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Top Deals"
                                            id="role_top_deals">
                                        <label class="cursor-pointer" for="role_top_deals">
                                            {{ trans('labels.top_deals') }}
                                        </label>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('firebase_notification'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Firebase Notification" id="role_firebase_notification">
                                        <label class="cursor-pointer" for="role_firebase_notification">
                                            {{ trans('labels.firebase_notification') }}
                                        </label>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('subscription'))
                                    @if ($user->allow_without_subscription != 1)
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Subscription Plans" id="role_pricing_plan">
                                            <label class="cursor-pointer" for="role_pricing_plan">
                                                {{ trans('labels.pricing_plan') }}
                                            </label>
                                        </div>
                                    @endif
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Transactions" id="role_transaction">
                                        <label class="cursor-pointer" for="role_transaction">
                                            {{ trans('labels.transaction') }}
                                        </label>
                                    </div>
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="Payment Methods" id="role_payment_methods">
                                    <label class="cursor-pointer" for="role_payment_methods">
                                        {{ trans('labels.payment_methods') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('custom_status'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Custom Status" id="role_custom_status">
                                        <label class="cursor-pointer" for="role_custom_status">
                                            {{ trans('labels.custom_status') }}
                                        </label>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('custom_domain'))
                                        <?php
                                        if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                            $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        }
                                        if ($user->allow_without_subscription == 1) {
                                            $custom_domain = 1;
                                        } else {
                                            $custom_domain = @$checkplan->custom_domain;
                                        }
                                        ?>
                                        @if (@$custom_domain == 1)
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Custom Domains" id="role_custom_domains">
                                                <label class="cursor-pointer" for="role_custom_domains">
                                                    {{ trans('labels.custom_domains') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('custom_domain'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Custom Domains" id="role_custom_domains">
                                            <label class="cursor-pointer" for="role_custom_domains">
                                                {{ trans('labels.custom_domains') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Basic Settings"
                                        id="role_basic_settings">
                                    <label class="cursor-pointer" for="role_basic_settings">
                                        {{ trans('labels.basic_settings') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Who We Are"
                                        id="role_who_we_are">
                                    <label class="cursor-pointer" for="role_who_we_are">
                                        {{ trans('labels.who_we_are') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('blog'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $blogs = 1;
                                        } else {
                                            $blogs = @$checkplan->blogs;
                                        }
                                        ?>
                                        @if ($blogs == 1)
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Blogs" id="role_blogs">
                                                <label class="cursor-pointer" for="role_blogs">
                                                    {{ trans('labels.blogs') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('blog'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Blogs" id="role_blogs">
                                            <label class="cursor-pointer" for="role_blogs">
                                                {{ trans('labels.blogs') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Testimonials"
                                        id="role_testimonials">
                                    <label class="cursor-pointer" for="role_testimonials">
                                        {{ trans('labels.testimonials') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Gallery"
                                        id="role_gallery">
                                    <label class="cursor-pointer" for="role_gallery">
                                        {{ trans('labels.gallery') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Cms Pages"
                                        id="role_cms_pages">
                                    <label class="cursor-pointer" for="role_cms_pages">
                                        {{ trans('labels.cms_pages') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('employee'))
                                        @php
                                            $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                ->orderByDesc('id')
                                                ->first();
                                            if ($user->allow_without_subscription == 1) {
                                                $role_management = 1;
                                            } else {
                                                $role_management = @$checkplan->role_management;
                                            }
                                        @endphp
                                        @if ($role_management == 1)
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Roles" id="role_roles">
                                                <label class="cursor-pointer" for="role_roles">
                                                    {{ trans('labels.roles') }}
                                                </label>
                                            </div>

                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Employees" id="role_employees">
                                                <label class="cursor-pointer" for="role_employees">
                                                    {{ trans('labels.employees') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('employee'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Roles" id="role_roles">
                                            <label class="cursor-pointer" for="role_roles">
                                                {{ trans('labels.roles') }}
                                            </label>
                                        </div>

                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Employees" id="role_employees">
                                            <label class="cursor-pointer" for="role_employees">
                                                {{ trans('labels.employees') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Subscribers"
                                        id="role_subscribers">
                                    <label class="cursor-pointer" for="role_subscribers">
                                        {{ trans('labels.subscribers') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Inquiries"
                                        id="role_inquiries">
                                    <label class="cursor-pointer" for="role_inquiries">
                                        {{ trans('labels.inquiries') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Share"
                                        id="role_share">
                                    <label class="cursor-pointer" for="role_share">
                                        {{ trans('labels.share') }}
                                    </label>
                                </div>
                                @if (helper::listoflanguage()->count() > 1)
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Language Settings" id="role_language_settings">
                                        <label class="cursor-pointer" for="role_language_settings">
                                            {{ trans('labels.language-settings') }}
                                        </label>
                                    </div>
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Setting"
                                        id="role_setting">
                                    <label class="cursor-pointer" for="role_setting">
                                        {{ trans('labels.setting') }}
                                    </label>
                                </div>

                            </div>
                            <div class="col-sm-8 col-6" id="permissioncheckbox">
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_dashboard"
                                                name="modules[role_dashboard]" id="manage[role_dashboard]"
                                                {{ helper::check_access('role_dashboard', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_dashboard]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('pos'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $pos = 1;
                                        } else {
                                            $pos = @$checkplan->pos;
                                        }
                                        ?>
                                        @if ($pos == 1)
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="role_pos"
                                                            name="modules[role_pos]"
                                                            {{ helper::check_access('role_pos', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_pos]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_pos]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_pos]"
                                                            {{ helper::check_access('role_pos', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_pos]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_pos]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('pos'))
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_pos"
                                                        name="modules[role_pos]"
                                                        {{ helper::check_access('role_pos', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                        id="manage[role_pos]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_pos]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="add[role_pos]"
                                                        {{ helper::check_access('role_pos', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                        id="add[role_pos]">
                                                    <label class="form-check-label fs-13 text-dark" for="add[role_pos]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_orders"
                                                name="modules[role_orders]"
                                                {{ helper::check_access('role_orders', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_orders]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_orders]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_reports"
                                                name="modules[role_reports]"
                                                {{ helper::check_access('role_reports', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_reports]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_reports]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('customer_login'))
                                    <div class="d-block mb-3">
                                        <div class="row g-2">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_customers"
                                                    name="modules[role_customers]"
                                                    {{ helper::check_access('role_customers', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                    id="manage[role_customers]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_customers]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_categories"
                                                name="modules[role_categories]"
                                                {{ helper::check_access('role_categories', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_categories]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_categories]"
                                                {{ helper::check_access('role_categories', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_categories]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_categories]"
                                                {{ helper::check_access('role_categories', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_categories]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_categories]"
                                                {{ helper::check_access('role_categories', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_categories]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sub_categories"
                                                name="modules[role_sub_categories]"
                                                {{ helper::check_access('role_sub_categories', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_sub_categories]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_sub_categories]"
                                                {{ helper::check_access('role_sub_categories', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="add[role_sub_categories]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_sub_categories]"
                                                {{ helper::check_access('role_sub_categories', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="edit[role_sub_categories]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_sub_categories]"
                                                {{ helper::check_access('role_sub_categories', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="delete[role_sub_categories]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_products"
                                                name="modules[role_products]"
                                                {{ helper::check_access('role_products', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_products]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_products]"
                                                {{ helper::check_access('role_products', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_products]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_products]"
                                                {{ helper::check_access('role_products', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_products]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_products]"
                                                {{ helper::check_access('role_products', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_products]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_import_products"
                                                name="modules[role_import_products]"
                                                {{ helper::check_access('role_import_products', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_import_products]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_import_products]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_import_products"
                                                name="add[role_import_products]"
                                                {{ helper::check_access('role_import_products', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_import_products]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="add[role_import_products]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sliders"
                                                name="modules[role_sliders]"
                                                {{ helper::check_access('role_sliders', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_sliders]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_sliders]"
                                                {{ helper::check_access('role_sliders', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_sliders]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_sliders]"
                                                {{ helper::check_access('role_sliders', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_sliders]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_sliders]"
                                                {{ helper::check_access('role_sliders', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_sliders]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_banner"
                                                name="modules[role_banner]"
                                                {{ helper::check_access('role_banner', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_banner]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_banner]"
                                                {{ helper::check_access('role_banner', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_banner]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_banner]"
                                                {{ helper::check_access('role_banner', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_banner]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_banner]"
                                                {{ helper::check_access('role_banner', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_banner]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('coupon'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $coupons = 1;
                                        } else {
                                            $coupons = @$checkplan->coupons;
                                        }
                                        ?>
                                        @if ($coupons == 1)
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="modules[role_coupons]"
                                                            {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_coupons]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_coupons]"
                                                            {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_coupons]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="edit[role_coupons]"
                                                            {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                            id="edit[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_coupons]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="delete[role_coupons]"
                                                            {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                            id="delete[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="delete[role_coupons]">
                                                            {{ trans('labels.delete') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('coupon'))
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_coupons"
                                                        name="modules[role_coupons]"
                                                        {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                        id="manage[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_coupons]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="add[role_coupons]"
                                                        {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                        id="add[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="add[role_coupons]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="edit[role_coupons]"
                                                        {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                        id="edit[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_coupons]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="delete[role_coupons]"
                                                        {{ helper::check_access('role_coupons', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                        id="delete[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="delete[role_coupons]">
                                                        {{ trans('labels.delete') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (@helper::checkaddons('top_deals'))
                                    <div class="d-block mb-3">
                                        <div class="row g-2">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_top_deals"
                                                    name="modules[role_top_deals]"
                                                    {{ helper::check_access('role_top_deals', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                    id="manage[role_top_deals]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_top_deals]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="add[role_top_deals]"
                                                    {{ helper::check_access('role_top_deals', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                    id="add[role_top_deals]">
                                                <label class="form-check-label fs-13 text-dark" for="add[role_top_deals]">
                                                    {{ trans('labels.add') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="delete[role_top_deals]"
                                                    {{ helper::check_access('role_top_deals', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                    id="delete[role_top_deals]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="delete[role_top_deals]">
                                                    {{ trans('labels.delete') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('firebase_notification'))
                                    <div class="d-block mb-3">
                                        <div class="row g-2">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_firebase_notification"
                                                    name="modules[role_firebase_notification]"
                                                    {{ helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                    id="manage[role_firebase_notification]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_firebase_notification]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_firebase_notification"
                                                    name="add[role_firebase_notification]"
                                                    {{ helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                    id="add[role_firebase_notification]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="add[role_firebase_notification]">
                                                    {{ trans('labels.add') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_firebase_notification"
                                                    name="edit[role_firebase_notification]"
                                                    {{ helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                    id="edit[role_firebase_notification]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="edit[role_firebase_notification]">
                                                    {{ trans('labels.edit') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_firebase_notification"
                                                    name="delete[role_firebase_notification]"
                                                    {{ helper::check_access('role_firebase_notification', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                    id="delete[role_firebase_notification]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="delete[role_firebase_notification]">
                                                    {{ trans('labels.delete') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('subscription'))
                                    @if ($user->allow_without_subscription != 1)
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_pricing_plan" name="modules[role_pricing_plan]"
                                                        {{ helper::check_access('role_pricing_plan', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                        id="manage[role_pricing_plan]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_pricing_plan]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-block mb-3">
                                        <div class="row g-2">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_transaction"
                                                    name="modules[role_transaction]"
                                                    {{ helper::check_access('role_transaction', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                    id="manage[role_transaction]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_transaction]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_payment_methods"
                                                name="modules[role_payment_methods]"
                                                {{ helper::check_access('role_payment_methods', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_payment_methods]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_payment_methods]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_payment_methods]"
                                                {{ helper::check_access('role_payment_methods', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_payment_methods]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="add[role_payment_methods]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('custom_status'))
                                    <div class="d-block mb-3">
                                        <div class="row g-2">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="modules[role_custom_status]"
                                                    {{ helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                    id="manage[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_custom_status]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="add[role_custom_status]"
                                                    {{ helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                    id="add[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="add[role_custom_status]">
                                                    {{ trans('labels.add') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="edit[role_custom_status]"
                                                    {{ helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                    id="edit[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="edit[role_custom_status]">
                                                    {{ trans('labels.edit') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="delete[role_custom_status]"
                                                    {{ helper::check_access('role_custom_status', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                    id="delete[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="delete[role_custom_status]">
                                                    {{ trans('labels.delete') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('custom_domain'))
                                        <?php
                                        if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                                            $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        }
                                        if ($user->allow_without_subscription == 1) {
                                            $custom_domain = 1;
                                        } else {
                                            $custom_domain = @$checkplan->custom_domain;
                                        }
                                        ?>
                                        @if ($custom_domain == 1)
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_domains"
                                                            name="modules[role_custom_domains]"
                                                            {{ helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_custom_domains]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_custom_domains]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_custom_domains]"
                                                            {{ helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_custom_domains]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_custom_domains]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if (@helper::checkaddons('custom_domain'))
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_domains"
                                                            name="modules[role_custom_domains]"
                                                            {{ helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_custom_domains]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_custom_domains]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_custom_domains]"
                                                            {{ helper::check_access('role_custom_domains', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_custom_domains]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_custom_domains]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_basic_settings"
                                                name="modules[role_basic_settings]"
                                                {{ helper::check_access('role_basic_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_basic_settings]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_basic_settings]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_basic_settings]"
                                                {{ helper::check_access('role_basic_settings', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_basic_settings]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="edit[role_basic_settings]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_who_we_are"
                                                name="modules[role_who_we_are]"
                                                {{ helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_who_we_are]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_who_we_are]"
                                                {{ helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_who_we_are]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_who_we_are]"
                                                {{ helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_who_we_are]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_who_we_are]"
                                                {{ helper::check_access('role_who_we_are', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_who_we_are]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('blog'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $blogs = 1;
                                        } else {
                                            $blogs = @$checkplan->blogs;
                                        }
                                        ?>
                                        @if ($blogs == 1)
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="modules[role_blogs]"
                                                            {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_blogs]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_blogs]"
                                                            {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_blogs]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="edit[role_blogs]"
                                                            {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                            id="edit[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_blogs]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="delete[role_blogs]"
                                                            {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                            id="delete[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="delete[role_blogs]">
                                                            {{ trans('labels.delete') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('blog'))
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_blogs"
                                                        name="modules[role_blogs]"
                                                        {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                        id="manage[role_blogs]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_blogs]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="add[role_blogs]"
                                                        {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                        id="add[role_blogs]">
                                                    <label class="form-check-label fs-13 text-dark" for="add[role_blogs]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="edit[role_blogs]"
                                                        {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                        id="edit[role_blogs]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_blogs]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="delete[role_blogs]"
                                                        {{ helper::check_access('role_blogs', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                        id="delete[role_blogs]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="delete[role_blogs]">
                                                        {{ trans('labels.delete') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_testimonials"
                                                name="modules[role_testimonials]"
                                                {{ helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_testimonials]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_testimonials]"
                                                {{ helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_testimonials]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_testimonials]"
                                                {{ helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_testimonials]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_testimonials]"
                                                {{ helper::check_access('role_testimonials', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="delete[role_testimonials]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_gallery"
                                                name="modules[role_gallery]"
                                                {{ helper::check_access('role_gallery', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_gallery]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_gallery]"
                                                {{ helper::check_access('role_gallery', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_gallery]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_gallery]"
                                                {{ helper::check_access('role_gallery', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_gallery]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_gallery]"
                                                {{ helper::check_access('role_gallery', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_gallery]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_cms_pages"
                                                name="modules[role_cms_pages]"
                                                {{ helper::check_access('role_cms_pages', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_cms_pages]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_cms_pages]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="add[role_cms_pages]"
                                                {{ helper::check_access('role_cms_pages', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                id="add[role_cms_pages]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_cms_pages]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_cms_pages]"
                                                {{ helper::check_access('role_cms_pages', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_cms_pages]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_cms_pages]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('employee'))
                                        @php
                                            $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)
                                                ->orderByDesc('id')
                                                ->first();
                                            if ($user->allow_without_subscription == 1) {
                                                $role_management = 1;
                                            } else {
                                                $role_management = @$checkplan->role_management;
                                            }
                                        @endphp
                                        @if ($role_management == 1)
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="modules[role_roles]"
                                                            {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_roles]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_roles]"
                                                            {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_roles]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="edit[role_roles]"
                                                            {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                            id="edit[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_roles]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="delete[role_roles]"
                                                            {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                            id="delete[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="delete[role_roles]">
                                                            {{ trans('labels.delete') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="modules[role_employees]"
                                                            {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                            id="manage[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_employees]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="add[role_employees]"
                                                            {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                            id="add[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_employees]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="edit[role_employees]"
                                                            {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                            id="edit[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_employees]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            name="delete[role_employees]"
                                                            {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                            id="delete[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="delete[role_employees]">
                                                            {{ trans('labels.delete') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('employee'))
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_roles"
                                                        name="modules[role_roles]"
                                                        {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                        id="manage[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_roles]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="add[role_roles]"
                                                        {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                        id="add[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="add[role_roles]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="edit[role_roles]"
                                                        {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                        id="edit[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_roles]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="delete[role_roles]"
                                                        {{ helper::check_access('role_roles', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                        id="delete[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="delete[role_roles]">
                                                        {{ trans('labels.delete') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_employees" name="modules[role_employees]"
                                                        {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                        id="manage[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_employees]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="add[role_employees]"
                                                        {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                        id="add[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="add[role_employees]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="edit[role_employees]"
                                                        {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                        id="edit[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_employees]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        name="delete[role_employees]"
                                                        {{ helper::check_access('role_employees', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                        id="delete[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="delete[role_employees]">
                                                        {{ trans('labels.delete') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-check-input" type="checkbox" value="role_subscribers"
                                                name="modules[role_subscribers]"
                                                {{ helper::check_access('role_subscribers', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_subscribers]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_subscribers]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_subscribers]"
                                                {{ helper::check_access('role_subscribers', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_subscribers]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="delete[role_subscribers]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-check-input" type="checkbox" value="role_inquiries"
                                                name="modules[role_inquiries]"
                                                {{ helper::check_access('role_inquiries', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_inquiries]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_inquiries]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="delete[role_inquiries]"
                                                {{ helper::check_access('role_inquiries', $data->id, $data->vendor_id, 'delete') == 1 ? 'checked' : '' }}
                                                id="delete[role_inquiries]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="delete[role_inquiries]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_share"
                                                name="modules[role_share]"
                                                {{ helper::check_access('role_share', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_share]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_share]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (helper::listoflanguage()->count() > 1)
                                    <div class="d-block mb-3">
                                        <div class="row g-2">
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_language_settings"
                                                    name="modules[role_language_settings]"
                                                    {{ helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                    id="manage[role_language_settings]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_language_settings]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_language_settings" name="add[role_language_settings]"
                                                    {{ helper::check_access('role_language_settings', $data->id, $data->vendor_id, 'add') == 1 ? 'checked' : '' }}
                                                    id="add[role_language_settings]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="add[role_language_settings]">
                                                    {{ trans('labels.add') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_setting"
                                                name="modules[role_setting]"
                                                {{ helper::check_access('role_setting', $data->id, $data->vendor_id, 'manage') == 1 ? 'checked' : '' }}
                                                id="manage[role_setting]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_setting]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="edit[role_setting]"
                                                {{ helper::check_access('role_setting', $data->id, $data->vendor_id, 'edit') == 1 ? 'checked' : '' }}
                                                id="edit[role_setting]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_setting]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @error('modules')
                                <br><span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                            <a href="{{ URL::to('admin/roles') }}"
                                class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                            <button
                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#permissioncheckbox input:checkbox').each(function(e) {
                "use strict";
                var id = $(this).val();
                var manageid = "manage[" + id + "]";
                var addid = "add[" + id + "]";
                var editid = "edit[" + id + "]";
                var deleteid = "delete[" + id + "]";
                if ($("[id='" + manageid + "']").prop('checked') == true ||
                    $("[id='" + addid + "']").prop('checked') == true ||
                    $("[id='" + editid + "']").prop('checked') == true ||
                    $("[id='" + deleteid + "']").prop('checked') == true) {
                    $($('#' + id)).prop('checked', $(this).prop('checked'));
                }
                $('#checkall').prop('checked', $(this).prop('checked'));
            });
        });

        $('#checkall').on('click', function() {
            "use strict";
            var checked = $(this).prop('checked');
            $('input:checkbox').prop('checked', checked);
        }).change();

        $('#checkboxes input:checkbox').on('click', function() {

            var checked = $(this).prop('checked');
            var manageid = "manage[" + this.id + "]";
            var addid = "add[" + this.id + "]";
            var editid = "edit[" + this.id + "]";
            var deleteid = "delete[" + this.id + "]";
            $("[id='" + manageid + "']").prop('checked', checked);
            $("[id='" + addid + "']").prop('checked', checked);
            $("[id='" + editid + "']").prop('checked', checked);
            $("[id='" + deleteid + "']").prop('checked', checked);
        });

        $('#permissioncheckbox input:checkbox').on('click', function() {

            var checked = $(this).prop('checked');
            var value = $(this).val();
            var manageid = "manage[" + $(this).val() + "]";
            var addid = "add[" + $(this).val() + "]";
            var editid = "edit[" + $(this).val() + "]";
            var deleteid = "delete[" + $(this).val() + "]";
            if ($("[id='" + addid + "']").prop('checked') == true || $("[id='" + editid + "']").prop('checked') ==
                true || $("[id='" + deleteid + "']").prop('checked') == true) {
                $("[id='" + manageid + "']").prop('checked', true);
            }

        }).change();
    </script>
@endsection

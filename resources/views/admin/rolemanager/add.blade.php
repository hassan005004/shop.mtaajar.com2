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
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.add_new') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/roles') }}">{{ trans('labels.roles') }}</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row g-2">
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <form action="{{ URL::to('admin/roles/save') }}" method="post">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="">{{ trans('labels.role') }} <span
                                            class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="{{ trans('labels.role') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3 fw-bold">{{ trans('labels.system_modules') }} <span class="text-danger">*</span>
                        </h5>
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
                        <div class="row g-2 mt-3">

                            <div class="col-sm-4 col-6" id="checkboxes">
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="dashboard"
                                        id="dashboard">
                                    <label class="cursor-pointer" for="dashboard">
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
                                                    name="POS (Point Of Sale)" id="pos">
                                                <label class="cursor-pointer" for="pos">
                                                    {{ trans('labels.pos') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('pos'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="POS (Point Of Sale)" id="pos">
                                            <label class="cursor-pointer" for="pos">
                                                {{ trans('labels.pos') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="orders"
                                        id="orders">
                                    <label class="cursor-pointer" for="orders">
                                        {{ trans('labels.orders') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="reports"
                                        id="reports">
                                    <label class="cursor-pointer" for="reports">
                                        {{ trans('labels.reports') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('customer_login'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="Customers"
                                            id="customers">
                                        <label class="cursor-pointer" for="customers">
                                            {{ trans('labels.customers') }}
                                        </label>
                                    </div>
                                @endif

                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Categories"
                                        id="categories">
                                    <label class="cursor-pointer" for="categories">
                                        {{ trans('labels.categories') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Sub Categories"
                                        id="sub_categories">
                                    <label class="cursor-pointer" for="sub_categories">
                                        {{ trans('labels.sub_categories') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Tax"
                                        id="tax">
                                    <label class="cursor-pointer" for="tax">
                                        {{ trans('labels.tax') }}
                                    </label>
                                </div>

                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Products"
                                        id="products">
                                    <label class="cursor-pointer" for="products">
                                        {{ trans('labels.products') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="import_Products" id="import_products">
                                    <label class="cursor-pointer" for="import_products">
                                        {{ trans('labels.product_upload') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Sliders"
                                        id="sliders">
                                    <label class="cursor-pointer" for="sliders">
                                        {{ trans('labels.sliders') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Banner"
                                        id="banner">
                                    <label class="cursor-pointer" for="banner">
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
                                                    name="Coupons" id="coupons">
                                                <label class="cursor-pointer" for="coupons">
                                                    {{ trans('labels.coupons') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('coupon'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Coupons" id="coupons">
                                            <label class="cursor-pointer" for="coupons">
                                                {{ trans('labels.coupons') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                @if (@helper::checkaddons('top_deals'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value="" name="top_deals"
                                            id="top_deals">
                                        <label class="cursor-pointer" for="top_deals">
                                            {{ trans('labels.top_deals') }}
                                        </label>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('firebase_notification'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="firebase_notification" id="firebase_notification">
                                        <label class="cursor-pointer" for="firebase_notification">
                                            {{ trans('labels.firebase_notification') }}
                                        </label>
                                    </div>
                                @endif
                                @if (@helper::checkaddons('subscription'))
                                    @if ($user->allow_without_subscription != 1)
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Subscription Plans" id="pricing_plans">
                                            <label class="cursor-pointer" for="pricing_plans">
                                                {{ trans('labels.pricing_plan') }}
                                            </label>
                                        </div>
                                    @endif
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Transactions" id="transaction">
                                        <label class="cursor-pointer" for="transaction">
                                            {{ trans('labels.transaction') }}
                                        </label>
                                    </div>
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="Payment Methods" id="payment_methods">
                                    <label class="cursor-pointer" for="payment_methods">
                                        {{ trans('labels.payment_methods') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('custom_status'))
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Custom Status" id="custom_status">
                                        <label class="cursor-pointer" for="custom_status">
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
                                                    name="Custom Domains" id="custom_domains">
                                                <label class="cursor-pointer" for="custom_domains">
                                                    {{ trans('labels.custom_domains') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('custom_domain'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Custom Domains" id="custom_domains">
                                            <label class="cursor-pointer" for="custom_domains">
                                                {{ trans('labels.custom_domains') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Basic Settings"
                                        id="basic_settings">
                                    <label class="cursor-pointer" for="basic_settings">
                                        {{ trans('labels.basic_settings') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Who We Are"
                                        id="who_we_are">
                                    <label class="cursor-pointer" for="who_we_are">
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
                                                    name="Blogs" id="blogs">
                                                <label class="cursor-pointer" for="blogs">
                                                    {{ trans('labels.blogs') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('blog'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Blogs" id="blogs">
                                            <label class="cursor-pointer" for="blogs">
                                                {{ trans('labels.blogs') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Testimonials"
                                        id="testimonials">
                                    <label class="cursor-pointer" for="testimonials">
                                        {{ trans('labels.testimonials') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Gallery"
                                        id="gallery">
                                    <label class="cursor-pointer" for="gallery">
                                        {{ trans('labels.gallery') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Cms Pages"
                                        id="cms_pages">
                                    <label class="cursor-pointer" for="cms_pages">
                                        {{ trans('labels.cms_pages') }}
                                    </label>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('employee'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $role_management = 1;
                                        } else {
                                            $role_management = @$checkplan->role_management;
                                        }
                                        ?>
                                        @if ($role_management == 1)
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Roles" id="roles">
                                                <label class="cursor-pointer" for="roles">
                                                    {{ trans('labels.roles') }}
                                                </label>
                                            </div>
                                            <div class="cursor-pointer d-block mb-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="Employees" id="employees">
                                                <label class="cursor-pointer" for="employees">
                                                    {{ trans('labels.employees') }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (@helper::checkaddons('employee'))
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Roles" id="roles">
                                            <label class="cursor-pointer" for="roles">
                                                {{ trans('labels.roles') }}
                                            </label>
                                        </div>
                                        <div class="cursor-pointer d-block mb-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="Employees" id="employees">
                                            <label class="cursor-pointer" for="employees">
                                                {{ trans('labels.employees') }}
                                            </label>
                                        </div>
                                    @endif
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Subscribers"
                                        id="subscribers">
                                    <label class="cursor-pointer" for="subscribers">
                                        {{ trans('labels.subscribers') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Inquiries"
                                        id="inquiries">
                                    <label class="cursor-pointer" for="inquiries">
                                        {{ trans('labels.inquiries') }}
                                    </label>
                                </div>
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Share"
                                        id="share">
                                    <label class="cursor-pointer" for="share">
                                        {{ trans('labels.share') }}
                                    </label>
                                </div>
                                @if (helper::listoflanguage()->count() > 1)
                                    <div class="cursor-pointer d-block mb-3">
                                        <input class="form-check-input" type="checkbox" value=""
                                            name="Language Settings" id="language_settings">
                                        <label class="cursor-pointer" for="language_settings">
                                            {{ trans('labels.language-settings') }}
                                        </label>
                                    </div>
                                @endif
                                <div class="cursor-pointer d-block mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="Setting"
                                        id="setting">
                                    <label class="cursor-pointer" for="setting">
                                        {{ trans('labels.setting') }}
                                    </label>
                                </div>

                            </div>
                            <div class="col-sm-8 col-6" id="permissioncheckbox">
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_dashboard"
                                                name="modules[role_dashboard]" id="manage[role_dashboard]">
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
                                                            name="modules[role_pos]" id="manage[role_pos]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_pos]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox" value="role_pos"
                                                            name="add[role_pos]" id="add[role_pos]">
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
                                                        name="modules[role_pos]" id="manage[role_pos]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_pos]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_pos"
                                                        name="add[role_pos]" id="add[role_pos]">
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
                                                name="modules[role_orders]" id="manage[role_orders]">
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
                                                name="modules[role_reports]" id="manage[role_reports]">
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
                                                    name="modules[role_customers]" id="manage[role_customers]">
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
                                                name="modules[role_categories]" id="manage[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_categories]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_categories"
                                                name="add[role_categories]" id="add[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_categories]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_categories"
                                                name="edit[role_categories]" id="edit[role_categories]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_categories]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_categories"
                                                name="delete[role_categories]" id="delete[role_categories]">
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
                                                name="modules[role_sub_categories]" id="manage[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_sub_categories]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sub_categories"
                                                name="add[role_sub_categories]" id="add[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="add[role_sub_categories]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sub_categories"
                                                name="edit[role_sub_categories]" id="edit[role_sub_categories]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="edit[role_sub_categories]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sub_categories"
                                                name="delete[role_sub_categories]" id="delete[role_sub_categories]">
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
                                            <input class="form-check-input" type="checkbox" value="role_tax"
                                                name="modules[role_tax]" id="manage[role_tax]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_tax]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_tax"
                                                name="add[role_tax]" id="add[role_tax]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_tax]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_tax"
                                                name="edit[role_tax]" id="edit[role_tax]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_tax]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_tax"
                                                name="delete[role_tax]" id="delete[role_tax]">
                                            <label class="form-check-label fs-13 text-dark" for="delete[role_tax]">
                                                {{ trans('labels.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_products"
                                                name="modules[role_products]" id="manage[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_products]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_products"
                                                name="add[role_products]" id="add[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_products]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_products"
                                                name="edit[role_products]" id="edit[role_products]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_products]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_products"
                                                name="delete[role_products]" id="delete[role_products]">
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
                                                name="modules[role_import_products]" id="manage[role_import_products]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_import_products]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_import_products"
                                                name="add[role_import_products]" id="add[role_import_products]">
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
                                                name="modules[role_sliders]" id="manage[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_sliders]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sliders"
                                                name="add[role_sliders]" id="add[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_sliders]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sliders"
                                                name="edit[role_sliders]" id="edit[role_sliders]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_sliders]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_sliders"
                                                name="delete[role_sliders]" id="delete[role_sliders]">
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
                                                name="modules[role_banner]" id="manage[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_banner]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_banner"
                                                name="add[role_banner]" id="add[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_banner]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_banner"
                                                name="edit[role_banner]" id="edit[role_banner]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_banner]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_banner"
                                                name="delete[role_banner]" id="delete[role_banner]">
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
                                                            id="manage[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_coupons]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="add[role_coupons]"
                                                            id="add[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_coupons]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="edit[role_coupons]"
                                                            id="edit[role_coupons]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_coupons]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_coupons" name="delete[role_coupons]"
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
                                                        name="modules[role_coupons]" id="manage[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_coupons]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_coupons"
                                                        name="add[role_coupons]" id="add[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="add[role_coupons]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_coupons"
                                                        name="edit[role_coupons]" id="edit[role_coupons]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_coupons]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_coupons"
                                                        name="delete[role_coupons]" id="delete[role_coupons]">
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
                                                    name="modules[role_top_deals]" id="manage[role_top_deals]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_top_deals]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_top_deals"
                                                    name="add[role_top_deals]" id="add[role_top_deals]">
                                                <label class="form-check-label fs-13 text-dark" for="add[role_top_deals]">
                                                    {{ trans('labels.add') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox" value="role_top_deals"
                                                    name="delete[role_top_deals]" id="delete[role_top_deals]">
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
                                                        value="role_pricing_plans" name="modules[role_pricing_plans]"
                                                        id="manage[role_pricing_plans]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_pricing_plans]">
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
                                                    name="modules[role_transaction]" id="manage[role_transaction]">
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
                                                name="modules[role_payment_methods]" id="manage[role_payment_methods]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_payment_methods]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_payment_methods"
                                                name="add[role_payment_methods]" id="add[role_payment_methods]">
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
                                                    id="manage[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_custom_status]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="add[role_custom_status]"
                                                    id="add[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="add[role_custom_status]">
                                                    {{ trans('labels.add') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="edit[role_custom_status]"
                                                    id="edit[role_custom_status]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="edit[role_custom_status]">
                                                    {{ trans('labels.edit') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_custom_status" name="delete[role_custom_status]"
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
                                                            id="manage[role_custom_domains]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_custom_domains]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_custom_domains" name="add[role_custom_domains]"
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
                                @else
                                    @if (@helper::checkaddons('custom_domain'))
                                        <div class="d-block mb-3">
                                            <div class="row g-2">
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_custom_domains" name="modules[role_custom_domains]"
                                                        id="manage[role_custom_domains]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_custom_domains]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_custom_domains" name="add[role_custom_domains]"
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
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_basic_settings"
                                                name="modules[role_basic_settings]" id="manage[role_basic_settings]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_basic_settings]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_basic_settings"
                                                name="edit[role_basic_settings]" id="edit[role_basic_settings]">
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
                                                name="modules[role_who_we_are]" id="manage[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_who_we_are]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_who_we_are"
                                                name="add[role_who_we_are]" id="add[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_who_we_are]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_who_we_are"
                                                name="edit[role_who_we_are]" id="edit[role_who_we_are]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_who_we_are]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_who_we_are"
                                                name="delete[role_who_we_are]" id="delete[role_who_we_are]">
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
                                                            id="manage[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_blogs]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="add[role_blogs]"
                                                            id="add[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_blogs]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="edit[role_blogs]"
                                                            id="edit[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_blogs]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="delete[role_blogs]"
                                                            id="delete[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="delete[role_blogs]">
                                                            {{ trans('labels.delete') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if (@helper::checkaddons('blog'))
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="modules[role_blogs]"
                                                            id="manage[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_blogs]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="add[role_blogs]"
                                                            id="add[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_blogs]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="edit[role_blogs]"
                                                            id="edit[role_blogs]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_blogs]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_blogs" name="delete[role_blogs]"
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
                                @endif
                                <div class="d-block mb-3">
                                    <div class="row g-2">
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_testimonials"
                                                name="modules[role_testimonials]" id="manage[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_testimonials]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_testimonials"
                                                name="add[role_testimonials]" id="add[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="add[role_testimonials]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_testimonials"
                                                name="edit[role_testimonials]" id="edit[role_testimonials]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="edit[role_testimonials]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_testimonials"
                                                name="delete[role_testimonials]" id="delete[role_testimonials]">
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
                                                name="modules[role_gallery]" id="manage[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_gallery]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_gallery"
                                                name="add[role_gallery]" id="add[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_gallery]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_gallery"
                                                name="edit[role_gallery]" id="edit[role_gallery]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_gallery]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_gallery"
                                                name="delete[role_gallery]" id="delete[role_gallery]">
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
                                                name="modules[role_cms_pages]" id="manage[role_cms_pages]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_cms_pages]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_cms_pages"
                                                name="add[role_cms_pages]" id="add[role_cms_pages]">
                                            <label class="form-check-label fs-13 text-dark" for="add[role_cms_pages]">
                                                {{ trans('labels.add') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_cms_pages"
                                                name="edit[role_cms_pages]" id="edit[role_cms_pages]">
                                            <label class="form-check-label fs-13 text-dark" for="edit[role_cms_pages]">
                                                {{ trans('labels.edit') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (@helper::checkaddons('subscription'))
                                    @if (@helper::checkaddons('employee'))
                                        <?php
                                        $checkplan = App\Models\Transaction::where('vendor_id', $vendor_id)->orderByDesc('id')->first();
                                        if ($user->allow_without_subscription == 1) {
                                            $role_management = 1;
                                        } else {
                                            $role_management = @$checkplan->role_management;
                                        }
                                        ?>
                                        @if ($role_management == 1)
                                            <div class="d-block mb-3">
                                                <div class="row g-2">
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="modules[role_roles]"
                                                            id="manage[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_roles]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="add[role_roles]"
                                                            id="add[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_roles]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="edit[role_roles]"
                                                            id="edit[role_roles]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_roles]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_roles" name="delete[role_roles]"
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
                                                            id="manage[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="manage[role_employees]">
                                                            {{ trans('labels.view') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="add[role_employees]"
                                                            id="add[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="add[role_employees]">
                                                            {{ trans('labels.add') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="edit[role_employees]"
                                                            id="edit[role_employees]">
                                                        <label class="form-check-label fs-13 text-dark"
                                                            for="edit[role_employees]">
                                                            {{ trans('labels.edit') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="role_employees" name="delete[role_employees]"
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
                                                        name="modules[role_roles]" id="manage[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_roles]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_roles"
                                                        name="add[role_roles]" id="add[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="add[role_roles]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_roles"
                                                        name="edit[role_roles]" id="edit[role_roles]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_roles]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox" value="role_roles"
                                                        name="delete[role_roles]" id="delete[role_roles]">
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
                                                        id="manage[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="manage[role_employees]">
                                                        {{ trans('labels.view') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_employees" name="add[role_employees]"
                                                        id="add[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="add[role_employees]">
                                                        {{ trans('labels.add') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_employees" name="edit[role_employees]"
                                                        id="edit[role_employees]">
                                                    <label class="form-check-label fs-13 text-dark"
                                                        for="edit[role_employees]">
                                                        {{ trans('labels.edit') }}
                                                    </label>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="role_employees" name="delete[role_employees]"
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
                                                name="modules[role_subscribers]" id="manage[role_subscribers]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_subscribers]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_subscribers"
                                                name="delete[role_subscribers]" id="delete[role_subscribers]">
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
                                                name="modules[role_inquiries]" id="manage[role_inquiries]">
                                            <label class="form-check-label fs-13 text-dark"
                                                for="manage[role_inquiries]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_inquiries"
                                                name="delete[role_inquiries]" id="delete[role_inquiries]">
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
                                                name="modules[role_share]" id="manage[role_share]">
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
                                                    id="manage[role_language_settings]">
                                                <label class="form-check-label fs-13 text-dark"
                                                    for="manage[role_language_settings]">
                                                    {{ trans('labels.view') }}
                                                </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                                <input class="form-check-input" type="checkbox"
                                                    value="role_language_settings" name="add[role_language_settings]"
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
                                                name="modules[role_setting]" id="manage[role_setting]">
                                            <label class="form-check-label fs-13 text-dark" for="manage[role_setting]">
                                                {{ trans('labels.view') }}
                                            </label>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <input class="form-check-input" type="checkbox" value="role_setting"
                                                name="edit[role_setting]" id="edit[role_setting]">
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
                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}"
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
        $('#checkall').on('click', function() {
            "use strict";
            var checked = $(this).prop('checked');
            $('input:checkbox').prop('checked', checked);
        }).change($(this).prop('checked'));
        $('#checkboxes input:checkbox').on('click', function() {

            var checked = $(this).prop('checked');
            var manageid = "manage[role_" + this.id + "]";
            var addid = "add[role_" + this.id + "]";
            var editid = "edit[role_" + this.id + "]";
            var deleteid = "delete[role_" + this.id + "]";
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
        });
    </script>
@endsection

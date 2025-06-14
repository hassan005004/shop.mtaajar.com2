@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $user = App\Models\User::where('id', $vendor_id)->first();
@endphp
@section('content')
    <div class="d-flex mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.dashboard_come') }}</h5>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-xl-6 col-12">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                @if (Auth::user()->type == 1)
                                    <span class="card-icon">
                                        <i class="fa-regular fa-user fs-5"></i>
                                    </span>
                                    <span class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                        <p class="text-dark fs-15 fw-500 mb-1">{{ trans('labels.users') }}</p>
                                        <h5 class="text-primary fw-600">{{ $totalvendors }}</h4>
                                    </span>
                                @else
                                    <span class="card-icon">
                                        <i class="fa-solid fa-list-timeline"></i>
                                    </span>
                                    <span class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                        <p class="text-dark fs-15 fw-500 mb-1">{{ trans('labels.products') }}</p>
                                        <h5 class="text-primary fw-600">{{ $totalvendors }}</h4>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-regular fa-medal fs-5"></i>
                                </span>
                                <span class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                    @if (Auth::user()->type == 1)
                                        <p class="text-dark fs-15 fw-500 mb-1">{{ trans('labels.pricing_plan') }}</p>
                                        <h5 class="text-primary fw-600">{{ $totalplans }}</h4>
                                        @else
                                            <p class="text-dark fs-15 fw-500 mb-1">{{ trans('labels.current_plan') }}</p>
                                            @if (!empty($currentplanname))
                                                <h5 class="text-primary fw-600"> {{ @$currentplanname->name }} </h4>
                                                @else
                                                    -
                                            @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-solid fa-ballot-check fs-5"></i>
                                </span>
                                <span class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                    <p class="text-dark fs-15 fw-500 mb-1">
                                        {{ Auth::user()->type == 1 ? trans('labels.transactions') : trans('labels.orders') }}
                                    </p>
                                    <h5 class="text-primary fw-600">{{ $totalorders }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-regular fa-money-bill-1-wave fs-5"></i>
                                </span>
                                <span class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                    <p class="text-dark fs-15 fw-500 mb-1">{{ trans('labels.revenue') }}</p>
                                    <h5 class="text-primary fw-600">
                                        {{ helper::currency_formate($totalrevenue, $vendor_id) }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">

                    <div class="d-flex flex-wrap justify-content-sm-between justify-content-center gap-2">
                        <div
                            class="col-xxl-8 col-xl-7 col-lg-8 col-md-8 col-sm-7 d-flex flex-column gap-2 justify-content-center align-items-start">
                            <h5 class="text-dark fw-600 d-flex gap-2 align-items-center">
                                <img src="{{ helper::image_path(Auth::user()->image) }}"
                                    class="object border rounded-circle dasbord-img" alt="">
                                <small class="text-dark">{{ Auth::user()->name }}</small>
                            </h5>
                            <p class="text-muted fs-7 m-0 line-3">{{ trans('labels.dashboard_description') }}</p>
                            <div class="dropdown">
                                <a class="btn btn-secondary fs-7 text-light fw-500 dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-plus"></i> {{ trans('labels.quick_add') }}
                                </a>
                                @if (Auth::user()->type == 2 || Auth::user()->type == 4)
                                    <ul class="dropdown-menu fw-500 fs-7 text-dark">
                                        <li><a class="dropdown-item py-2"
                                                href="{{ URL::to('/admin/products') }}">{{ trans('labels.products') }}</a>
                                        </li>
                                        <li><a class="dropdown-item py-2"
                                                href="{{ URL::to('/admin/categories') }}">{{ trans('labels.categories') }}
                                            </a></li>
                                        <li><a class="dropdown-item py-2"
                                                href="{{ URL::to('/admin/basic_settings') }}">{{ trans('labels.basic_settings') }}</a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="dropdown-menu fw-500 fs-7 text-dark">
                                        <li><a class="dropdown-item py-2"
                                                href="{{ URL::to('admin/users') }}">{{ trans('labels.users') }}</a>
                                        </li>
                                        <li><a class="dropdown-item py-2"
                                                href="{{ URL::to('admin/plan') }}">{{ trans('labels.pricing_plan') }}
                                            </a></li>
                                        <li><a class="dropdown-item py-2"
                                                href="{{ URL::to('/admin/basic_settings') }}">{{ trans('labels.basic_settings') }}</a>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                        @if (Auth::user()->type == 2 || Auth::user()->type == 4)
                            <div
                                class="col-xxl-3 col-xl-4 mt-2 mt-sm-0 col-lg-3 col-md-3 col-sm-5 gap-2 d-flex flex-column justify-content-center align-items-center">
                                <img src="https://qrcode.tec-it.com/API/QRCode?data={{ URL::to('/' . $user->slug) }}&choe=UTF-8"
                                    class="object quer-code" alt="">
                                <div class="d-flex mt-sm-2">
                                    <input type="hidden" value="{{ URL::to('/' . $user->slug) }}" id="myInput"
                                        class="form-control rounded-0" readonly>
                                    <button class="btn btn-primary fw-500 fs-7" id="copyButton"
                                        onclick="setClipboard('{{ URL::to('/' . $user->slug) }}')">
                                        <i class="fa-regular fa-clone"></i> {{ trans('labels.copy') }}
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-8 mb-3">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 border-bottom pb-3 justify-content-between">
                        <h5 class="card-title m-0">{{ trans('labels.revenue') }}</h5>
                        <select class="form-select form-select-sm w-auto" id="revenueyear"
                            data-url="{{ URL::to('/admin/dashboard') }}">
                            @if (!in_array(date('Y'), array_column($revenue_years->toArray(), 'year')))
                                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                            @endif
                            @forelse ($revenue_years as $revenue)
                                <option value="{{ $revenue->year }}" {{ date('Y') == $revenue->year ? 'selected' : '' }}>
                                    {{ $revenue->year }}</option>
                            @empty
                                <option value="" selected disabled>{{ trans('labels.select') }}</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="row">
                        <canvas id="revenuechart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                        <h5 class="card-title m-0">
                            @if (Auth::user()->type == 1)
                                {{ trans('labels.users') }}
                            @else
                                {{ trans('labels.orders') }}
                            @endif
                        </h5>
                        <select class="form-select form-select-sm w-auto" id="doughnutyear"
                            data-url="{{ request()->url() }}">
                            @if (!in_array(date('Y'), array_column($doughnut_years->toArray(), 'year')))
                                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                            @endif
                            @forelse ($doughnut_years as $useryear)
                                <option value="{{ $useryear->year }}"
                                    {{ date('Y') == $useryear->year ? 'selected' : '' }}>{{ $useryear->year }}</option>
                            @empty
                                <option value="" selected disabled>{{ trans('labels.select') }}</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="row">
                        <canvas id="doughnut"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->type != 1)
        @php
            $ran = [
                'gradient-1',
                'gradient-2',
                'gradient-3',
                'gradient-4',
                'gradient-5',
                'gradient-6',
                'gradient-7',
                'gradient-8',
                'gradient-9',
            ];
        @endphp
        <div class="row g-3 mb-3">
            <div class="col-xl-6">
                <div class="card border-0 box-shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title pb-3 border-bottom">Top Products</h5>
                        <div class="table-responsive" id="table-items">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fs-15 fw-500">{{ trans('labels.image') }}</th>
                                        <th class="fs-15 fw-500">{{ trans('labels.item_name') }}</th>
                                        <th class="fs-15 fw-500">{{ trans('labels.category') }}</th>
                                        <th class="fs-15 fw-500">{{ trans('labels.orders') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($topitems) > 0)
                                        @foreach (@$topitems as $row)
                                            <tr class="fs-7 fw-500 text-dark align-middle">
                                                <td>
                                                    <img src="{{ Helper::image_path($row['product_image']->image) }}"
                                                        class="rounded hw-50 object" alt="">
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ URL::to('admin/products/edit-' . $row->slug) }}">{{ $row->name }}</a>
                                                </td>
                                                <td>{{ @$row['category_info']->name }}</td>
                                                <td>
                                                    @php
                                                        $per =
                                                            $getorderdetailscount > 0
                                                                ? ($row->item_order_counter * 100) /
                                                                    $getorderdetailscount
                                                                : 0;
                                                    @endphp
                                                    {{ number_format($per, 2) }}%
                                                    <div class="progress h-10-px">
                                                        <div class="progress-bar gradient-6 {{ $ran[array_rand($ran, 1)] }}"
                                                            style="width: {{ $per }}%;" role="progressbar">
                                                            <span class="sr-only">{{ $per }}%
                                                                {{ trans('labels.orders') }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card border-0 box-shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title pb-3 border-bottom">Top Customers</h5>
                        <div class="table-responsive" id="table-users">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fs-15 fw-500">{{ trans('labels.image') }}</th>
                                        <th class="fs-15 fw-500">{{ trans('labels.name') }}</th>
                                        <th class="fs-15 fw-500">{{ trans('labels.email') }}</th>
                                        <th class="fs-15 fw-500">{{ trans('labels.orders') }}</th>
                                    </tr>
                                </thead>
                                @php $i = 1; @endphp
                                @if (count($topusers) > 0)
                                    @foreach (@$topusers as $user)
                                        <tr class="fs-7 fw-500 text-dark align-middle">
                                            <td>
                                                <img src="{{ Helper::image_path($user->image) }}"
                                                    class="rounded hw-50 object" alt="">
                                            </td>
                                            <td>
                                                <div class="fs-7 fw-500">
                                                    <p>{{ $user->name }}</p>
                                                    <p>{{ $user->mobile }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ number_format($per, 2) }}%
                                                <div class="progress h-10-px">
                                                    <div class="progress-bar {{ $ran[array_rand($ran, 1)] }}"
                                                        style="width: {{ $per }}%;" role="progressbar">
                                                        <span class="sr-only">{{ $per }}%
                                                            {{ trans('labels.orders') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <h5 class="card-title text-capitalize mb-3 pb-3 border-bottom">
                        {{ Auth::user()->type == 1 ? trans('labels.today_transaction') : trans('labels.today_orders') }}
                    </h5>
                    <div class="table-responsive">
                        @if (Auth::user()->type == 1)
                            @include('admin.dashboard.admintransaction')
                        @else
                            @include('admin.orders.orderstable')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!--- Admin -------- users-chart-script --->
    <!--- VendorAdmin -------- orders-count-chart-script --->
    <script type="text/javascript">
        var doughnut = null;
        var doughnutlabels = {{ Js::from($doughnutlabels) }};
        var doughnutdata = {{ Js::from($doughnutdata) }};
    </script>
    <!--- Admin ------ revenue-by-plans-chart-script --->
    <!--- vendorAdmin ------ revenue-by-orders-script --->
    <script type="text/javascript">
        var revenuechart = null;
        var labels = {{ Js::from($revenuelabels) }};
        var revenuedata = {{ Js::from($revenuedata) }};

        function setClipboard(value) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            toastr.success("{{ session('success') }}", "Success");
        }
    </script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/dashboard.js') }}"></script>
@endsection

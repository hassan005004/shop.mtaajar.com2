@extends('web.layout.default')
@section('contents')
    <!------ breadcrumb ------>
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}"><a
                            class="text-dark fw-600"
                            href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.wallet') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="product-prev-sec product-list-sec">
        <div class="container my-5">
            <div class="user-bg-color mb-4">
                <div class="row g-3">
                    @include('web.user.sidebar')
                    <div class="col-lg-8 col-xxl-9">
                        <div class="card p-3 border rounded user-form">
                            <div class="settings-box">
                                <div class="settings-box-header gap-3 pb-3 border-bottom flex-wrap mb-3">
                                    <div class="mb-0 d-flex align-items-center gap-3">
                                        <div>
                                            <h5 class="text-dark mb-2 profile-title">
                                                {{ trans('labels.wallet_balance') }}
                                            </h5>
                                            <p class="text-success fs-6 fw-600">
                                                {{ helper::currency_formate(Auth::user()->wallet, $vendordata->id) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto col-12">
                                        <a href="{{ URL::to($vendordata->slug . '/addmoneywallet') }}"
                                            class="w-100 btn-primary btn-submit rounded-0 btn align-items-center fs-7 fw-600 justify-content-center d-flex gap-2">
                                            <i class="fa-regular fa-plus"></i>
                                            {{ trans('labels.add_money') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="settings-box-body dashboard-section">
                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle table-hover">
                                            <thead class="table-light">
                                                <tr class="fs-7 fw-600">
                                                    <th scope="col">{{ trans('labels.date') }}</th>
                                                    <th scope="col"> {{ trans('labels.amount') }} </th>
                                                    <th scope="col">{{ trans('labels.remark') }}</th>
                                                    <th scope="col">{{ trans('labels.status') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($gettransactions as $row)
                                                    <tr class="fs-7">
                                                        <td>{{ helper::date_formate($row->created_at, $vendordata->id) }}<br>
                                                            {{ helper::time_formate($row->created_at, $vendordata->id) }}
                                                        </td>
                                                        <td>{{ helper::currency_formate($row->amount, $vendordata->id) }}
                                                        </td>
                                                        <td>
                                                            @if ($row->transaction_type == 2)
                                                                {{ trans('labels.order_placed') }}
                                                                <span>{{ $row->order_number }} </span>
                                                            @elseif ($row->transaction_type == 3)
                                                                {{ trans('labels.order_cancel') }}
                                                                <span>{{ $row->order_number }} </span>
                                                            @elseif ($row->transaction_type == 4)
                                                                {{ trans('labels.referral_earning') }}
                                                                <span>{{ $row->username }} </span>
                                                            @else
                                                                {{ trans('labels.wallet_recharge') }}
                                                                <span>{{ @helper::getpayment($row->payment_type, $vendordata->id)->payment_name }}</span>
                                                                <span>{{ $row->payment_id }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($row->transaction_type == 2)
                                                                <div
                                                                    class="badge bg-debit custom-badge bg-cancelled rounded-0">
                                                                    <span> {{ trans('labels.debit') }}</span>
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="badge bg-debit custom-badge rounded-0 bg-completed">
                                                                    <span> {{ trans('labels.credit') }}</span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $gettransactions->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

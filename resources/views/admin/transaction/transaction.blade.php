@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
@section('content')
    <div class="row">
        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
            <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.transactions') }}</h5>
            <form action="{{ URL::to('/admin/transaction') }} " class="col-xl-7 col-md-9 col-12" method="get">
                <div class="row">
                    <div class="input-group gap-2 justify-content-end">
                        @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                            <select class="form-select transaction-select col-sm-auto col-12 rounded" name="vendor">
                                <option value=""
                                    data-value="{{ URL::to('/admin/transaction?vendor=' . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate')) }}"
                                    selected>{{ trans('labels.select') }}</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        data-value="{{ URL::to('/admin/transaction?vendor=' . $vendor->id . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate')) }}"
                                        {{ request()->get('vendor') == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        @endif
                        <div class="input-group-append col-sm-auto col-12">
                            <input type="date" class="form-control p-2 w-100 rounded" name="startdate"
                                value="{{ request()->get('startdate') }}">
                        </div>
                        <div class="input-group-append col-sm-auto col-12">
                            <input type="date" class="form-control p-2 w-100 rounded" name="enddate"
                                value="{{ request()->get('enddate') }}">
                        </div>
                        <div class="input-group-append col-sm-auto col-12">
                            <button class="btn btn-primary px-sm-4 rounded w-100"
                                type="submit">{{ trans('labels.fetch') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td>{{ trans('labels.srno') }}</td>
                                    <td>{{ trans('labels.transaction_number') }}</td>
                                    <td>{{ trans('labels.plan_name') }}</td>
                                    <td>{{ trans('labels.total') }} {{ trans('labels.amount') }}</td>
                                    <td>{{ trans('labels.payment_type') }}</td>
                                    <td>{{ trans('labels.purchase_date') }}</td>
                                    <td>{{ trans('labels.expire_date') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $key => $transaction)
                                    <tr class="fs-7 align-middle">
                                        <td>{{ ++$key }}</td>
                                        <td>#{{ $transaction->transaction_number }}</td>
                                        <td>{{ @$transaction['plan_info']->name }}</td>
                                        <td>{{ helper::currency_formate($transaction->grand_total, '') }}</td>
                                        <td>
                                            @if ($transaction->payment_type != '')
                                                @if ($transaction->payment_type == 0)
                                                    {{ trans('labels.manual') }}
                                                @else
                                                    {{ @helper::getpayment($transaction->payment_type, 1)->payment_name }}
                                                @endif
                                            @elseif($transaction->amount == 0)
                                                -
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->payment_type == 6 || $transaction->payment_type == 1)
                                                @if ($transaction->status == 2)
                                                    <span
                                                        class="badge bg-success">{{ @helper::date_formate($transaction->purchase_date, $vendor_id) }}</span>
                                                @else
                                                    -
                                                @endif
                                            @else
                                                <span
                                                    class="badge bg-success">{{ @helper::date_formate($transaction->purchase_date, $vendor_id) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->payment_type == 6 || $transaction->payment_type == 1)
                                                @if ($transaction->status == 2)
                                                    <span
                                                        class="badge bg-danger">{{ $transaction->expire_date != '' ? @helper::date_formate($transaction->expire_date, $vendor_id) : '-' }}</span>
                                                @else
                                                    -
                                                @endif
                                            @else
                                                <span
                                                    class="badge bg-danger">{{ $transaction->expire_date != '' ? @helper::date_formate($transaction->expire_date, $vendor_id) : '-' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->payment_type == 6 || $transaction->payment_type == 1)
                                                @if ($transaction->status == 1)
                                                    <span class="badge bg-warning">{{ trans('labels.pending') }}</span>
                                                @elseif ($transaction->status == 2)
                                                    <span class="badge bg-success">{{ trans('labels.accepted') }}</span>
                                                @elseif ($transaction->status == 3)
                                                    <span class="badge bg-danger">{{ trans('labels.rejected') }}</span>
                                                @else
                                                    -
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ @helper::date_formate($transaction->created_at, $vendor_id) }}<br>
                                            {{ @helper::time_formate($transaction->created_at, $vendor_id) }}
                                        </td>
                                        <td>{{ @helper::date_formate($transaction->updated_at, $vendor_id) }}<br>
                                            {{ @helper::time_formate($transaction->updated_at, $vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                    @if ($transaction->payment_type == 6 || $transaction->payment_type == 1)
                                                        @if ($transaction->status == 1)
                                                            <a class="btn btn-sm btn-success hov"
                                                                tooltip="{{ trans('labels.active') }}"
                                                                @if (env('Environment') == 'sendbox') onclick="myFunction()" @else  onclick="statusupdate('{{ URL::to('admin/transaction-' . $transaction->id . '-2') }}')" @endif>
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger hov"
                                                                tooltip="{{ trans('labels.inactive') }}"
                                                                @if (env('Environment') == 'sendbox') onclick="myFunction()" @else 
                                                                onclick="statusupdate('{{ URL::to('admin/transaction-' . $transaction->id . '-3') }}')" @endif>
                                                                <i class="fas fa-close"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endif
                                                <a class="btn btn-sm hov btn-secondary hov"
                                                    tooltip="{{ trans('labels.view') }}"
                                                    href="{{ URL::to('admin/transaction/plandetails-' . $transaction->id) }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

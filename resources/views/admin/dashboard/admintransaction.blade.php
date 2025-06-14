<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fs-15 fw-500">
            <td>{{ trans('labels.srno') }}</td>
            <td>{{ trans('labels.name') }}</td>
            <td>{{ trans('labels.plan_name') }}</td>
            <td>{{ trans('labels.total') }} {{ trans('labels.amount') }}</td>
            <td>{{ trans('labels.payment_type') }}</td>
            <td>{{ trans('labels.purchase_date') }}</td>
            <td>{{ trans('labels.expire_date') }}</td>
            <td>{{ trans('labels.status') }}</td>
            <td>{{ trans('labels.action') }}</td>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($transaction as $transaction)
            <tr class="fs-7 align-middle">
                <td>@php
                    echo $i++;
                @endphp</td>
                @if (Auth::user()->type == 1)
                    <td>{{ $transaction['vendor_info']->name }}</td>
                @endif
                <td>{{ @$transaction['plan_info']->name }}</td>
                <td>{{ helper::currency_formate($transaction->amount, '') }}</td>
                <td>
                    @if ($transaction->amount > 0)
                        @if ($transaction->payment_type == 0)
                            {{ trans('labels.manual') }}
                        @else
                            {{ @helper::getpayment($transaction->payment_type, Auth::user()->id)->payment_name }}
                        @endif
                    @elseif($transaction->amount == 0)
                        -
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($transaction->payment_type == 6)
                        @if ($transaction->status == 2)
                            <span
                                class="badge bg-success">{{ helper::date_formate($transaction->purchase_date,$transaction->vendor_id) }}</span>
                        @else
                            -
                        @endif
                    @else
                        <span class="badge bg-success">{{ helper::date_formate($transaction->purchase_date,$transaction->vendor_id) }}</span>
                    @endif
                </td>
                <td>
                    @if ($transaction->payment_type == 6)
                        @if ($transaction->status == 2)
                            <span
                                class="badge bg-danger">{{ $transaction->expire_date != '' ? helper::date_formate($transaction->expire_date,$transaction->vendor_id) : '-' }}</span>
                        @else
                            -
                        @endif
                    @else
                        <span
                            class="badge bg-danger">{{ $transaction->expire_date != '' ? helper::date_formate($transaction->expire_date,$transaction->vendor_id) : '-' }}</span>
                    @endif
                </td>
                <td>
                    @if ($transaction->payment_type == 6)
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
                @if (Auth::user()->type == '1')
                    <td>
                        <div class="d-flex gap-2">
                            @if ($transaction->payment_type == 6)
                                @if ($transaction->status == 1)
                                    <a class="btn btn-sm btn-success hov" tooltip="{{ trans('labels.active') }}"
                                        onclick="statusupdate('{{ URL::to('admin/transaction-' . $transaction->id . '-2') }}')"><i
                                            class="fas fa-check"></i></a>
                                    <a class="btn btn-sm btn-danger hov" tooltip="{{ trans('labels.inactive') }}"
                                        onclick="statusupdate('{{ URL::to('admin/transaction-' . $transaction->id . '-3') }}')"><i
                                            class="fas fa-close"></i></a>
                                @endif
                            @endif
                            <a class="btn btn-sm btn-secondary hov" tooltip="{{ trans('labels.view') }}"
                                href="{{ URL::to('admin/transaction/plandetails-' . $transaction->id) }}"><i
                                    class="fa-regular fa-eye"></i></a>
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

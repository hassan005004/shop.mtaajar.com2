@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fs-15 fw-500">
            <td>{{ trans('labels.srno') }}</td>
            <td>{{ trans('labels.order_number') }}</td>
            <td>{{ trans('labels.total') }} {{ trans('labels.amount') }}</td>
            <td>{{ trans('labels.payment_type') }}</td>
            <td>{{ trans('labels.order_type') }}</td>
            @if (helper::appdata($vendor_id)->product_type == 1)
                <td>{{ trans('labels.status') }}</td>
            @endif
            <td>{{ trans('labels.created_date') }}</td>
            <td>{{ trans('labels.updated_date') }}</td>
            <td>{{ trans('labels.action') }}</td>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach ($getorders as $orderdata)
            <tr class="fs-7 align-middle">
                <td>@php echo $i++; @endphp</td>
                <td>
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <a href="{{ URL::to('admin/orders/invoice/' . $orderdata->vendor_id . '/' . $orderdata->order_number) }}"
                            target="_blank">{{ $orderdata->order_number }}</a>
                        @if ($orderdata->vendor_note != '')
                            <a href="javascript:void(0)" class="btn hov btn-primary btn-sm"
                                tooltip="{{ $orderdata->vendor_note }}">
                                <i class="fa-solid fa-clipboard"></i>
                            </a>
                        @endif
                    </div>
                </td>

                <td>{{ helper::currency_formate($orderdata->grand_total, $vendor_id) }}</td>
                <td>

                    @if ($orderdata->transaction_type == 0)
                        {{ trans('labels.online') }}
                    @else
                        {{ @helper::getpayment($orderdata->transaction_type, $vendor_id)->payment_name }}
                    @endif
                    <br>
                    @if ($orderdata->payment_status == 1)
                        <small class="text-danger"><i class="far fa-clock"></i>
                            {{ trans('labels.unpaid') }}</small>
                    @else
                        <small class="text-success"><i class="far fa-clock"></i>
                            {{ trans('labels.paid') }}</small>
                    @endif
                </td>
                <td>
                    @if ($orderdata->order_type == 1)
                        {{ trans('labels.delivery') }}
                    @elseif ($orderdata->order_type == 4)
                        {{ trans('labels.pos') }}
                    @elseif ($orderdata->order_type == 5)
                        {{ trans('labels.digital') }}
                    @endif
                </td>
                @if (helper::appdata($vendor_id)->product_type == 1)
                    <td>
                        @if ($orderdata->status_type == '1')
                            <span
                                class="badge bg-warning">{{ @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name }}</span>
                        @elseif($orderdata->status_type == '2')
                            <span
                                class="badge bg-info">{{ @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name }}</span>
                        @elseif($orderdata->status_type == '3')
                            <span
                                class="badge bg-success">{{ @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name }}</span>
                        @elseif($orderdata->status_type == '4')
                            <span
                                class="badge bg-danger">{{ @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name }}</span>
                        @else
                            --
                        @endif
                    </td>
                @endif
                <td>{{ helper::date_formate($orderdata->created_at, $vendor_id) }}<br>
                    {{ helper::time_formate($orderdata->created_at, $vendor_id) }}
                </td>
                <td>{{ helper::date_formate($orderdata->updated_at, $vendor_id) }}<br>
                    {{ helper::time_formate($orderdata->updated_at, $vendor_id) }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                            <a class="btn btn-sm hov btn-primary" tooltip="{{ trans('labels.print') }}"
                                href="{{ URL::to('admin/orders/print/' . $orderdata->order_number) }}">
                                <i class="fa-regular fa-print"></i>
                            </a>
                        @endif
                        <a class="btn btn-sm hov btn-secondary" tooltip="{{ trans('labels.view') }}"
                            href="{{ URL::to('admin/orders/invoice/' . $orderdata->vendor_id . '/' . $orderdata->order_number) }}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                            @if (
                                ($orderdata->transaction_type == 1 || $orderdata->transaction_type == 6) &&
                                    $orderdata->payment_status == 1 &&
                                    $orderdata->status_type == 3 &&
                                    $orderdata->status_type != 4)
                                <a class="btn btn-sm hov btn-secondary"
                                    onclick="codpayment('{{ $orderdata->order_number }}','{{ $orderdata->grand_total }}')"
                                    tooltip="{{ trans('labels.payment') }}">
                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                </a>
                            @endif
                        @endif

                        <a href="{{ URL::to('/admin/orders/generatepdf/' . $orderdata->vendor_id . '/' . $orderdata->order_number) }}"
                            tooltip="{{ trans('labels.downloadpdf') }}" class="btn btn-sm btn-info hov">
                            <i class="fa-solid fa-file-pdf"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

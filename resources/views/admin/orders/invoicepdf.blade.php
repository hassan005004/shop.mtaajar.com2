<html>

<head>
    <title>{{ helper::appdata($getorderdata->vendor_id)->web_title }}</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">{{ trans('labels.invoice') }}</h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">{{ trans('labels.invoice_id') }} - <span
                    class="gray-color">#{{ $getorderdata->id }}</span></p>
            <p class="m-0 pt-5 text-bold w-100">{{ trans('labels.order_id') }} - <span
                    class="gray-color">#{{ $getorderdata->order_number }}</span></p>
            <p class="m-0 pt-5 text-bold w-100">{{ trans('labels.order_date') }} - <span
                    class="gray-color">{{ helper::date_formate($getorderdata->created_at, $getorderdata->vendor_id) }}</span>
            </p>
        </div>

        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">{{ trans('labels.customer_info') }}</th>
                <th class="w-50">{{ trans('labels.billing_address') }}</th>
                <th class="w-50">{{ trans('labels.shipping_address') }}</th>
            </tr>
            <tr>
                <td>
                    <div class="box-text">
                        <p><i class="fa-regular fa-user"></i> {{ $getorderdata->user_name }}</p>
                        <p><i class="fa-regular fa-phone"></i> {{ $getorderdata->user_mobile }} </p>
                        <p><i class="fa-regular fa-envelope"></i> {{ $getorderdata->user_email }}</p>

                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <p> {{ $getorderdata->billing_address }},</p>
                        <p>{{ $getorderdata->billing_landmark }},</p>
                        <p>{{ $getorderdata->billing_postal_code }}</p>
                        <p> {{ $getorderdata->billing_city }},</p>
                        <p> {{ $getorderdata->billing_state }},</p>
                        <p> {{ $getorderdata->billing_country }}.</p>
                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <p> {{ $getorderdata->shipping_address }},</p>
                        <p>{{ $getorderdata->shipping_landmark }},</p>
                        <p>{{ $getorderdata->shipping_postal_code }}</p>
                        <p> {{ $getorderdata->shipping_city }},</p>
                        <p> {{ $getorderdata->shipping_state }},</p>
                        <p> {{ $getorderdata->shipping_country }}.</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                @if ($getorderdata->tips > 0)
                    <th class="w-50">{{ trans('labels.payment') }}</th>
                    <th class="w-50">{{ trans('labels.tips') }}</th>
                @else
                    <th class="w-100">{{ trans('labels.payment') }}</th>
                @endif
            </tr>
            <tr>
                @if ($getorderdata->tips > 0)
                    <td>
                        @if ($getorderdata->transaction_type == 0)
                            {{ trans('labels.online') }}
                        @elseif ($getorderdata->transaction_type == 6)
                            {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                            : <small><a href="{{ helper::image_path($getorderdata->screenshot) }}" target="_blank"
                                    class="text-danger">{{ trans('labels.click_here') }}</a></small>
                        @else
                            {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                            - {{ $getorderdata->transaction_id }}
                        @endif
                    </td>
                    <td>
                        <p class="fs-6 d-flex w-100 justify-content-between align-items-center">
                            {{ trans('labels.tips_pro') }} :
                            <small>{{ helper::currency_formate($getorderdata->tips, $getorderdata->vendor_id) }}</small>
                        </p>
                    </td>
                @else
                    <td>
                        @if ($getorderdata->transaction_type == 0)
                            {{ trans('labels.online') }}
                        @elseif ($getorderdata->transaction_type == 6)
                            {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                            : <small><a href="{{ helper::image_path($getorderdata->screenshot) }}" target="_blank"
                                    class="text-danger">{{ trans('labels.click_here') }}</a></small>
                        @else
                            {{ @helper::getpayment($getorderdata->transaction_type, $getorderdata->vendor_id)->payment_name }}
                            - {{ $getorderdata->transaction_id }}
                        @endif
                    </td>
                @endif
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50">{{ trans('labels.product_name') }}</th>
                <th class="w-50">{{ trans('labels.unit_cost') }}</th>
                <th class="w-50">{{ trans('labels.qty') }}</th>
                <th class="w-50">{{ trans('labels.sub_total') }}</th>
            </tr>
            @foreach ($ordersdetails as $orders)
                @php
                    $itemprice = $orders->price;
                    if ($orders->variants_id != '') {
                        $itemprice = $orders->variants_price;
                    }
                @endphp
                <tr align="center">
                    <td>{{ $orders->product_name }}
                        @if ($orders->variation_id != '')
                            - <small>{{ $orders->variation_name }}
                                ({{ helper::currency_formate($itemprice, $getorderdata->vendor_id) }})
                            </small>
                        @endif
                        @if ($orders->extras_id != '')
                            <?php
                            
                            $extras_id = explode('|', $orders->extras_id);
                            
                            $extras_name = explode('|', $orders->extras_name);
                            
                            $extras_price = explode('|', $orders->extras_price);
                            
                            $extras_total_price = 0;
                            
                            ?>
                            <br>
                            @foreach ($extras_id as $key => $addons)
                                <small>
                                    <b class="text-muted">{{ $extras_name[$key] }}</b> :
                                    {{ helper::currency_formate($extras_price[$key], $getorderdata->vendor_id) }}<br>
                                </small>
                                @php
                                    $extras_total_price += $extras_price[$key];
                                @endphp
                            @endforeach
                        @endif
                    </td>
                    <td> {{ helper::currency_formate($orders->product_price, $orders->vendor_id) }}
                    </td>
                    <td>{{ $orders->qty }}</td>
                    <td>{{ helper::currency_formate($orders->product_price * $orders->qty, $orders->vendor_id) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <div class="total-part">
                        <div class="total-left w-85 float-left" align="right">
                            <p>{{ trans('labels.sub_total') }}</p>
                            @if ($getorderdata->offer_amount > 0)
                                <p>{{ trans('labels.discount') }}{{ $getorderdata->offer_code != '' ? '(' . $getorderdata->offer_code . ')' : '' }}
                                </p>
                            @endif
                            @php
                                $tax = explode('|', $getorderdata->tax_amount);
                                $tax_name = explode('|', $getorderdata->tax_name);
                            @endphp
                            @if ($getorderdata->tax_amount != null && $getorderdata->tax_amount != '')
                                @foreach ($tax as $key => $tax_value)
                                    <p>{{ $tax_name[$key] }}</p>
                                @endforeach
                            @endif


                            @if ($getorderdata->order_type == 1)
                                <p>{{ trans('labels.delivery') }}
                                    @if ($getorderdata->shipping_area != '')
                                        ({{ $getorderdata->shipping_area }})
                                    @endif
                                </p>
                            @endif
                            <p>{{ trans('labels.grand_total') }}</p>
                        </div>
                        <div class="total-right w-15 float-left text-bold" align="right">
                            <p> <strong>{{ helper::currency_formate($getorderdata->sub_total, $getorderdata->vendor_id) }}</strong>
                            </p>
                            @if ($getorderdata->offer_amount > 0)
                                <p> <strong>{{ helper::currency_formate($getorderdata->offer_amount, $getorderdata->vendor_id) }}</strong>
                                </p>
                            @endif

                            @if ($getorderdata->tax_amount != null && $getorderdata->tax_amount != '')
                                @foreach ($tax as $key => $tax_value)
                                    <p><strong>{{ helper::currency_formate((float) $tax[$key], $getorderdata->vendor_id) }}</strong>
                                @endforeach
                            @endif

                            </p>

                            @if ($getorderdata->order_type == 1)
                                <p>
                                    <strong>
                                        @if ($getorderdata->delivery_charge > 0)
                                            {{ helper::currency_formate($getorderdata->delivery_charge, $getorderdata->vendor_id) }}
                                        @else
                                            {{ trans('labels.free') }}
                                        @endif
                                    </strong>
                                </p>
                            @endif
                            <p><strong>{{ helper::currency_formate($getorderdata->grand_total, $getorderdata->vendor_id) }}</strong>

                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>

@extends('admin.layout.default')

@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp

    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">
            {{ request()->is('admin/report*') ? trans('labels.reports') : trans('labels.orders') }}</h5>
        @if (request()->is('admin/report*'))
            <form action="{{ URL::to('/admin/report') }}">

                <div class="input-group gap-2 col-md-12 ps-0 justify-content-end">

                    @if ($getcustomerslist->count() > 0)
                        <div
                            class="input-group-append col-auto px-1 {{ Auth::user()->type == 4 ? (helper::check_menu(Auth::user()->role_id, 'role_customers') == 1 ? '' : 'd-none') : '' }}">
                            <select name="customer_id" class="form-select rounded">
                                <option value="">{{ trans('labels.select_customer') }}</option>
                                @foreach ($getcustomerslist as $getcustomer)
                                    <option value="{{ $getcustomer->id }}"
                                        {{ $getcustomer->id == @$_GET['customer_id'] ? 'selected' : '' }}>
                                        {{ $getcustomer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="input-group-append col-auto">

                        <input type="date" class="form-control p-2 rounded" name="startdate"
                            @isset($_GET['startdate']) value="{{ $_GET['startdate'] }}" @endisset required>

                    </div>

                    <div class="input-group-append col-auto">

                        <input type="date" class="form-control p-2 rounded" name="enddate"
                            @isset($_GET['enddate']) value="{{ $_GET['enddate'] }}" @endisset required>

                    </div>

                    <div class="input-group-append">

                        <button class="btn btn-primary rounded" type="submit">{{ trans('labels.fetch') }}</button>

                    </div>

                </div>

            </form>
        @endif
    </div>



    @include('admin.orders.statistics')

    <div class="row">

        <div class="col-12">

            <div class="card border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        @include('admin.orders.orderstable')

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title text-dark" id="paymentModalLabel">{{ trans('labels.record_payment') }}</h5>
                    <button type="button m-0" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" {{ URL::to('admin/orders/payment_status-' . '2') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="hidden" id="booking_number" name="booking_number" value="">
                            <label for="modal_total_amount" class="form-label">
                                {{ trans('labels.total') }} {{ trans('labels.amount') }}
                            </label>
                            <input type="text" class="form-control numbers_only" name="modal_total_amount"
                                id="modal_total_amount" disabled value="">

                            <label for="modal_amount" class="form-label mt-2">
                                {{ trans('labels.cash_received') }}
                            </label>
                            <input type="text" class="form-control numbers_only" name="modal_amount" id="modal_amount"
                                value="" onkeyup="validation($(this).val())">
                            <label for="modal_amount" class="form-label mt-2">
                                {{ trans('labels.change_amount') }}
                            </label>
                            <input type="number" class="form-control" name="ramin_amount" id="ramin_amount" value=""
                                readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">{{ trans('labels.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function codpayment(booking_number, grand_total) {
            $('#modal_total_amount').val(grand_total);
            $('#booking_number').val(booking_number);
            $('#paymentModal').modal('show');
        }

        function validation(value) {
            var remaining = $('#modal_total_amount').val() - value;
            $('#ramin_amount').val(remaining.toFixed(2));
        }
    </script>
@endsection

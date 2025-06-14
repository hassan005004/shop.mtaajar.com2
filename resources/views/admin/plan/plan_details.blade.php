@extends('admin.layout.default')
@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.plan_details') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('admin/transaction') }}">{{ trans('labels.transaction') }}</a>
                </li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.plan_details') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card border-0 box-shadow">
                <div class="card-header bg-secondary sub-plan text-light">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-light">{{ $plan->plan_name }}</h5>
                    </div>
                </div>
                <div class="card-body">
                
                    <div class="mb-3">
                        <h2 class="mb-1">{{ helper::currency_formate($plan->amount, '') }}
                            <span class="fs-7 text-muted">/
                                @if ($plan->duration != null || $plan->duration != '')
                                    @if ($plan->duration == 1)
                                        {{ trans('labels.one_month') }}
                                    @elseif($plan->duration == 2)
                                        {{ trans('labels.three_month') }}
                                    @elseif($plan->duration == 3)
                                        {{ trans('labels.six_month') }}
                                    @elseif($plan->duration == 4)
                                        {{ trans('labels.one_year') }}
                                    @elseif($plan->duration == 5)
                                        {{ trans('labels.lifetime') }}
                                    @endif
                                @else
                                    {{ $plan->days }}
                                    {{ $plan->days > 1 ? trans('labels.days') : trans('labels.day') }}
                                @endif


                            </span>
                        </h2>
                        @if ($plan->tax != null && $plan->tax != '')
                        <small class="text-danger">{{ trans('labels.exclusive_taxes') }}</small><br>
                    @else
                        <small class="text-success">{{ trans('labels.inclusive_taxes') }}</small> <br>
                    @endif
                        <small class="text-muted text-center">{{ $plan->description }}</small>
                    </div>
                    <ul class="pb-5">
                        @php $features = ($plan->features == null ? null : explode('|', $plan->features));@endphp
                        <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">
                                {{ $plan->service_limit == -1 ? trans('labels.unlimited') : $plan->service_limit }}
                                {{ $plan->service_limit > 1 || $plan->service_limit == -1 ? trans('labels.products') : trans('labels.product') }}
                            </span>
                        </li>
                        <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">
                                {{ $plan->appoinment_limit == -1 ? trans('labels.unlimited') : $plan->appoinment_limit }}
                                {{ $plan->appoinment_limit > 1 || $plan->appoinment_limit == -1 ? trans('labels.orders') : trans('labels.order') }}
                            </span>
                        </li>
                        @php
                            $themes = [];
                            if ($plan->themes_id != '' && $plan->themes_id != null) {
                                $themes = explode('|', $plan->themes_id);
                        } @endphp
                        <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">{{ count($themes) }}
                                {{ count($themes) > 1 ? trans('labels.themes') : trans('labels.theme') }}</span>
                                
                                <a onclick="themeinfo('{{ $plan->id }}','{{ $plan->themes_id }}','{{ $plan->name }}')"
                                tooltip="{{ trans('labels.info') }}" class="cursor-pointer"> <i
                                    class="fa-regular fa-circle-info"></i> </a>
                        </li>
                        @if ($plan->coupons == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.coupons') }}</span>
                            </li>
                        @endif
                        @if ($plan->custom_domain == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.custom_domain_available') }}</span>
                            </li>
                        @endif
                        @if ($plan->google_analytics == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.google_analytics_available') }}</span>
                            </li>
                        @endif
                        @if ($plan->blogs == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.blogs') }}</span>
                            </li>
                        @endif
                        @if ($plan->social_logins == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.social_logins') }}</span>
                            </li>
                        @endif
                        @if ($plan->sound_notification == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.sound_notification') }}</span>
                            </li>
                        @endif
                        @if ($plan->whatsapp_message == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.whatsapp_message') }}</span>
                            </li>
                        @endif
                        @if ($plan->telegram_message == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.telegram_message') }}</span>
                            </li>
                        @endif
                        @if ($plan->pos == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.pos') }}</span>
                            </li>
                        @endif
                        @if ($plan->vendor_app == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.vendor_app_available') }}</span>
                            </li>
                        @endif
                        @if ($plan->customer_app == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.customer_app') }}</span>
                            </li>
                        @endif
                        @if ($plan->pwa == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.pwa') }}</span>
                            </li>
                        @endif
                        @if ($plan->role_management == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.role_management') }}</span>
                            </li>
                        @endif
                        @if ($plan->pixel == 1)
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2">{{ trans('labels.pixel') }}</span>
                            </li>
                        @endif
                        @if ($features != null)
                            @foreach ($features as $feature)
                                <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"> {{ $feature }} </span>
                                </li>
                            @endforeach
                        @endauth
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-6 mb-3 payments">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <a href="{{ URL::to('/admin/transaction/generatepdf-' . $plan->id) }}" class="btn btn-secondary"
                tooltip="{{ trans('labels.downloadpdf') }}"><i class="fa-solid fa-file-pdf"></i></a>
        </div>
        @if (Auth::user()->type == 1)
            <div class="card border-0 box-shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ trans('labels.vendor_info') }}</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <p>{{ trans('labels.name') }}</p>
                            <p class="fw-bolder">{{ $plan['vendor_info']->name }}</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <p>{{ trans('labels.email') }}</p>
                            <p class="fw-bolder">{{ $plan['vendor_info']->email }}</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <p>{{ trans('labels.mobile') }}</p>
                            <p class="fw-bolder">{{ $plan['vendor_info']->mobile }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        <div class="card border-0 box-shadow">
            <div class="card-header p-3">
                <h5 class="card-title m-0">{{ trans('labels.plan_information') }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <p>Transaction Number</p>
                        <p class="fw-bolder">#{{ $plan->transaction_number }}</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <p>{{ trans('labels.purchase_date') }}</p>
                        <p class="fw-bolder">{{ helper::date_formate($plan->purchase_date,$vendor_id) }}</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between border-bottom-0">
                        <p>{{ trans('labels.expire_date') }}</p>
                        <p class="fw-bolder">{{ helper::date_formate($plan->expire_date,$vendor_id) }}</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card border-0 box-shadow mt-3">
            <div class="card-header p-3">
                <h5 class="card-title m-0">{{ trans('labels.Payment_information') }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <p>{{ trans('labels.payment_type') }}</p>
                        <p class="fw-bolder">
                          
                            @if ($plan->payment_type == 6)
                                {{ @helper::getpayment($plan->payment_type, 1)->payment_name }}
                                : <small><a href="{{ helper::image_path($transaction->screenshot) }}" target="_blank"
                                        class="text-danger">{{ trans('labels.click_here') }}</a></small>
                            @elseif(in_array($plan->payment_type, [1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15]))
                                {{ @helper::getpayment($plan->payment_type, 1)->payment_name }}
                                : {{ $plan->payment_id }}
                            @elseif($plan->payment_type == 0)
                                {{ trans('labels.manual') }}
                            @elseif($plan->amount == 0)
                                -
                            @else
                                -
                            @endif
                        </p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <p>{{ trans('labels.sub_total') }}</p>
                        <p class="fw-bolder">{{ helper::currency_formate($plan->amount, '') }}</p>
                    </li>
                    @if ($plan->amount != 0)
                    @if ($plan->tax != null && $plan->tax != '')
                        @php
                            $tax = explode('|', $plan->tax);
                            $tax_name = explode('|', $plan->tax_name);
                        @endphp
                        @foreach ($tax as $key => $tax_value)
                       
                            @if ($tax_value != 0)
                                <li class="list-group-item d-flex justify-content-between border-bottom-2">

                                    <p>{{ $tax_name[$key] }}</p>

                                    <p class="fw-bolder">{{ helper::currency_formate(@$tax[$key], '') }}

                                    </p>

                                </li>
                            @endif
                        @endforeach
                    @endif

                @endif
                
                   
                    @if ($plan->offer_code != null && $plan->offer_amount != null)
                        <li class="list-group-item d-flex justify-content-between border-bottom-2">
                            <p>{{ trans('labels.discount') }} ({{ $plan->offer_code }})</p>
                            <p class="fw-bolder">-{{ helper::currency_formate($plan->offer_amount, '') }}</p>
                        </li>
                    @endif

                    <li class="list-group-item d-flex justify-content-between">
                        <p>{{ trans('labels.total') }} {{ trans('labels.amount') }}</p>
                        <p class="fw-bolder text-dark">
                            {{ helper::currency_formate($plan->grand_total, '') }}
                        </p>
                    </li>
                    

                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function themeinfo(id, theme_id, plan_name) {
            let string = theme_id;
            let arr = string.split('|');
            $('#themeinfoLabel').text(plan_name);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "{{ URL::to('admin/themeimages') }}",
                method: 'GET',
                data: {
                    theme_id: arr
                },
                dataType: 'json',
                success: function(data) {
                    $('#theme_modalbody').html(data.output);
                    $('#themeinfo').modal('show');
                }
            })
        }
    </script>
@endsection

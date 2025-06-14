<div id="telegram">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card rounded overflow-hidden border-0 box-shadow">
                <form action="{{ URL::to('admin/telegrammessage') }}" method="POST">
                    @csrf
                    <div class="card-header p-3 bg-secondary">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="text-capitalize fw-600">
                                {{ trans('labels.telegram_message_settings') }}
                            </h5>
                            <div>
                                <div class="text-center">
                                    <input id="telegram_on_off" type="checkbox" class="checkbox-switch"
                                        name="telegram_on_off" value="1"
                                        {{ $settingdata->telegram_on_off == 1 ? 'checked' : '' }}>
                                    <label for="telegram_on_off" class="switch">
                                        <span
                                            class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span
                                                class="switch__circle-inner"></span></span>
                                        <span
                                            class="switch__left {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">{{ trans('labels.off') }}</span>
                                        <span
                                            class="switch__right {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">{{ trans('labels.on') }}</span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row mt-2">
                                <div class="col-4">
                                    <h5 class="text-center">
                                        {{ trans('labels.order_variable') }}
                                    </h5>
                                    <hr>
                                    <p class="mb-1">{{ trans('labels.order_number') }} :
                                        <span class="pull-right text-primary">{order_no}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.item_variable') }} :
                                        <span class="pull-right text-primary">{item_variable}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.sub_total') }} : <span
                                            class="pull-right text-primary">{sub_total}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.total_tax') }} : <span
                                            class="pull-right text-primary">{total_tax}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.delivery_charge') }}:
                                        <span class="pull-right text-primary">{delivery_charge}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.discount_amount') }} :
                                        <span class="pull-right text-primary">{discount_amount}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.grand_total') }} :
                                        <span class="pull-right text-primary">{grand_total}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.notes') }} : <span
                                            class="pull-right text-primary">{notes}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.customer_name') }} :
                                        <span class="pull-right text-primary">{customer_name}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.customer_email') }} :
                                        <span class="pull-right text-primary">{customer_email}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.customer_mobile') }} :
                                        <span class="pull-right text-primary">{customer_mobile}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.payment_type') }} :
                                        <span class="pull-right text-primary">{payment_type}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.store_name') }} :
                                        <span class="pull-right text-primary">{store_name}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.track_order_url') }} :
                                        <span class="pull-right text-primary">{track_order_url}</span>
                                    </p>
                                    <p class="mb-1">{{ trans('labels.store_url') }}: <span
                                            class="pull-right text-primary">{store_url}</span>
                                    </p>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="text-center">
                                                {{ trans('labels.billing_info') }}
                                            </h5>
                                            <hr>
                                            <p class="mb-1">{{ trans('labels.address') }} :
                                                <span class="pull-right text-primary">{billing_address}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.landmark') }}
                                                : <span class="pull-right text-primary">{billing_landmark}</span>
                                            </p>
                                            <p class="mb-1">
                                                {{ trans('labels.postal_code') }} : <span
                                                    class="pull-right text-primary">{billing_postal_code}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.city') }} :
                                                <span class="pull-right text-primary">{billing_city}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.state') }} :
                                                <span class="pull-right text-primary">{billing_state}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.country') }} :
                                                <span class="pull-right text-primary">{billing_country}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="text-center">
                                                {{ trans('labels.shipping_info') }}
                                            </h5>
                                            <hr>
                                            <p class="mb-1">{{ trans('labels.address') }} :
                                                <span class="pull-right text-primary">{shipping_address}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.landmark') }}
                                                : <span class="pull-right text-primary">{shipping_landmark}</span>
                                            </p>
                                            <p class="mb-1">
                                                {{ trans('labels.postal_code') }} : <span
                                                    class="pull-right text-primary">{shipping_postal_code}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.city') }} :
                                                <span class="pull-right text-primary">{shipping_city}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.state') }} :
                                                <span class="pull-right text-primary">{shipping_state}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.country') }} :
                                                <span class="pull-right text-primary">{shipping_country}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-end mt-2">
                                        <div class="col-6">
                                            <h5 class="text-center">
                                                {{ trans('labels.item_variable') }}
                                            </h5>
                                            <hr>
                                            <p class="mb-1">{{ trans('labels.item_name') }}
                                                :
                                                <span class="pull-right text-primary">{item_name}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.qty') }} :
                                                <span class="pull-right text-primary">{qty}</span>
                                            </p>
                                            <p class="mb-1">{{ trans('labels.variants') }}
                                                :
                                                <span class="pull-right text-primary">{variantsdata}</span>
                                            </p>
                                            <p class="mb-1">
                                                {{ trans('labels.item_price') }} :
                                                <span class="pull-right text-primary">{item_price}</span>
                                            </p>
                                            <input type="text" name="item_message" class="form-control"
                                                placeholder="{{ trans('labels.item_message') }}"
                                                value="{{ @$settingdata->item_message }}" required>
                                            @error('item_message')
                                                <span class="text-danger" id="timezone_error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block">

                                <div class="form-group row mt-3">
                                    <label class="col-md-2 label-control"
                                        for="telegram_message">{{ trans('labels.telegram_message') }}</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" required="required" name="telegram_message" cols="50" rows="10"
                                            id="telegram_message">{{ @$settingdata->telegram_message }}</textarea>
                                        @error('telegram_message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-2 label-control"
                                        for="telegram_access_token">{{ trans('labels.telegram_access_token') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" name="telegram_access_token" class="form-control"
                                            placeholder="{{ trans('labels.telegram_access_token') }}"
                                            value="{{ @$settingdata->telegram_access_token }}" required>
                                        @error('telegram_access_token')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-2 label-control"
                                        for="telegram_chat_id">{{ trans('labels.telegram_chat_id') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" name="telegram_chat_id" class="form-control"
                                            placeholder="{{ trans('labels.telegram_chat_id') }}"
                                            value="{{ @$settingdata->telegram_chat_id }}" required>
                                        @error('telegram_chat_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <span class="text-danger">Get Chat ID : <a
                                                href="https://api.telegram.org/bot{TOKEN}/getUpdates"
                                                target="_blank">https://api.telegram.org/bot{TOKEN}/getUpdates</a></span>
                                    </div>
                                </div>
                                <div
                                    class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                                    <button
                                        class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_setting', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                        @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

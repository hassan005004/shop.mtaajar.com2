<form action="{{ URL::to('admin/settings/ship_rocket_settings') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="ship_rocket">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="card-header p-3 bg-secondary">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="text-capitalize fw-600">
                                {{ trans('labels.ship_rocket_settings') }}
                            </h5>
                            <div>
                                <div class="text-center">
                                    <input id="ship_rocket_on_off" type="checkbox" class="checkbox-switch"
                                        name="ship_rocket_on_off" value="1"
                                        {{ $settingdata->ship_rocket_on_off == 1 ? 'checked' : '' }}>
                                    <label for="ship_rocket_on_off" class="switch">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label fs-7 fw-500"
                                        for="api_user_email">{{ trans('labels.api_user_email') }}</label>
                                    <span class="text-danger">*</span>
                                    <input type="email" min="1" class="form-control" name="api_user_email"
                                        id="api_user_email" value="{{ $settingdata->api_user_email }}" required>
                                    @error('api_user_email')
                                        <span class="text-danger">{{ $message }}</span><br>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label fs-7 fw-500"
                                        for="api_user_password">{{ trans('labels.api_user_password') }}</label>
                                    <span class="text-danger">*</span>
                                    <input type="password" min="1" class="form-control" name="api_user_password"
                                        id="api_user_password" value="{{ $settingdata->api_user_password }}" required>
                                    @error('api_user_password')
                                        <span class="text-danger">{{ $message }}</span><br>
                                    @enderror
                                </div>
                            </div>
                            <p class="text-muted">{{ trans('labels.api_user_email_info') }} <a
                                    href="https://www.shiprocket.in/developers/"
                                    target="_blank">{{ trans('labels.click_here') }}</a></p>
                        </div>
                        <div class="{{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">
                            <button
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_setting', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

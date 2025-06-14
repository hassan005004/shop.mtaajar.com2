<form action="{{ URL::to('admin/settings/quick_call') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="quick_call">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="d-flex align-items-center card-header p-3 bg-secondary">
                        <h5 class="col-md-6 text-white">
                            {{ trans('labels.quick_call') }}</h5>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <input id="quick_call-switch" type="checkbox" class="checkbox-switch" name="quick_call"
                                value="1" {{ @$settingdata->quick_call == 1 ? 'checked' : '' }}>
                            <label for="quick_call-switch" class="switch">
                                <span
                                    class="{{ session()->get('direction') == '2' ? 'switch__circle-rtl' : 'switch__circle' }} switch__circle"><span
                                        class="switch__circle-inner"></span></span>
                                <span
                                    class="switch__left {{ session()->get('direction') == '2' ? ' pe-2' : ' ps-2' }}">{{ trans('labels.off') }}</span>
                                <span
                                    class="switch__right {{ session()->get('direction') == '2' ? ' ps-2' : ' pe-2' }}">{{ trans('labels.on') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_name">{{ trans('labels.name') }}</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" name="quick_call_name"
                                    placeholder="{{ trans('labels.name') }}"
                                    value="{{ @$settingdata->quick_call_name }}" required>
                                @error('quick_call_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_description">{{ trans('labels.description') }}</label>
                                <input type="text" class="form-control" name="quick_call_description"
                                    value="{{ @$settingdata->quick_call_description }}"
                                    placeholder="{{ trans('labels.description') }}">
                                @error('quick_call_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_mobile">{{ trans('labels.mobile') }}</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" name="quick_call_mobile"
                                    placeholder="{{ trans('labels.mobile') }}"
                                    value="{{ @$settingdata->quick_call_mobile }}" required>
                                @error('quick_call_mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label fs-7 fw-500"
                                    for="quick_call_image">{{ trans('labels.image') }}</label>
                                <input type="file" class="form-control" name="quick_call_image"
                                    placeholder="{{ trans('labels.image') }}">
                                <img src='{{ helper::image_path(@$settingdata->quick_call_image) }}'
                                    class='img-fluid rounded hw-70 mt-1'>
                                @error('quick_call_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                class="btn btn-primary px-sm-4  {{ Auth::user()->type == 4 ? (helper::check_access('role_setting', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                {{ trans('labels.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@if (request()->is('admin/products/edit-*'))
    @if (@helper::checkaddons('digital_product'))
         
        @if (helper::appdata($vendor_id)->product_type == 2)
            <div class="col-md-6 form-group">
                <label class="col-form-label">{{ trans('labels.digital_file') }}</label>
                <input type="file" class="form-control" name="downloadfile" id="downloadfile">
                <p class="text-danger mt-2">{{ trans('labels.digital_file') }} : <span class="text-dark"> <a
                            href="{{ url(env('ASSETPATHURL') . 'admin-assets/images/product/' . $getproductdata->download_file) }}"
                            target="_blank">{{ $getproductdata->download_file }}</a></span></p>
                @error('download_file')
                    <span class="text-danger">{{ $message }}</span> <br>
                @enderror
            </div>
        @endif
    @endif
@else
    @if (@helper::checkaddons('digital_product'))
        @if (helper::appdata($vendor_id)->product_type == 2)
            <div class="col-md-6 form-group">
                <label class="col-form-label">{{ trans('labels.digital_file') }}</label>
                <input type="file" class="form-control" name="downloadfile" id="downloadfile" {{helper::appdata($vendor_id)->product_type == 2 ? 'required' : ''}}>
                @error('downloadfile')
                    <span class="text-danger">{{ $message }}</span> <br>
                @enderror
            </div>
        @endif
    @endif
@endif

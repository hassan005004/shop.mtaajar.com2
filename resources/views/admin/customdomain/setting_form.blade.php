<div id="custom_domain">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                 
                    <form action="{{ URL::to('/admin/custom_domain/save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="form-label">{{ trans('labels.cname_title') }}<span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="cname_title" value="{{ $setting->cname_title }}" placeholder="{{ trans('labels.cname_title') }}" required>
                                @error('cname_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="form-label">{{ trans('labels.cname_text') }}<span class="text-danger"> * </span></label>
                                <textarea class="form-control" id="ckeditor" name="cname_text" required>{{ $setting->cname_text }}</textarea>
                                @error('cname_text')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                            <button class="btn btn-primary px-sm-4" @if (env('Environment')=='sendbox' ) type="button" onclick="myFunction()" @else type="submit" name="updateseo" value="1" @endif>{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
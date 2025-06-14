@extends('admin.layout.default')

@section('content')
    
            <h5 class="text-capitalize fw-600 fs-4 text-dark">{{ trans('labels.about_us') }}</h5>

            <div class="row mt-3">

                <div class="col-12">

                    <div class="card border-0">

                        <div class="card-body">

                            <div id="privacy-policy-three" class="privacy-policy">

                                <form action="{{ URL::to('admin/aboutus/update') }}" method="post">

                                    @csrf

                                    <textarea class="form-control" id="ckeditor" name="aboutus">{{ @$getaboutus }}</textarea>

                                    @error('aboutus')
                                        <span class="text-danger">{{ $message }}</span><br>
                                    @enderror

                                    <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}} my-2">
                                        <button
                                            @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                            class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_cms_pages', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 || helper::check_access('role_cms_pages', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
       
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>

    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/editor.js') }}"></script>
@endsection

@extends('admin.layout.default')

@section('content')
        <div class="d-flex justify-content-between align-items-center">

            <h5 class="text-capitalize fw-600 text-dark fs-4">{{trans('labels.edit')}}</h5>

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item"><a href="{{URL::to('admin/blogs')}}">{{trans('labels.blogs')}}</a></li>

                    <li class="breadcrumb-item active {{session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''}}" aria-current="page">{{trans('labels.edit')}}</li>

                </ol>

            </nav>

        </div>

        <div class="row mt-3">

            <div class="col-12">

                <div class="card border-0 box-shadow">

                    <div class="card-body">

                        <form action="{{URL::to('admin/blogs/update-'.$getblog->slug)}}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="form-group">

                                    <label class="form-label">{{trans('labels.title')}}<span class="text-danger"> * </span></label>

                                    <input type="text" class="form-control" name="title" value="{{ $getblog->title }}" placeholder="{{trans('labels.title')}}" required>

                                    @error('title')

                                    <span class="text-danger">{{ $message }}</span> 

                                 @enderror

                                </div>

                                <div class="form-group">

                                    <label class="form-label">{{trans('labels.description')}}<span class="text-danger"> * </span></label>

                                    <textarea class="form-control" id="ckeditor" name="description">{{$getblog->description}}</textarea>

                                    @error('description')

                                    <span class="text-danger">{{ $message }}</span> 

                                 @enderror

                                </div>

                                 <div class="form-group">

                                    <label class="form-label">{{trans('labels.image')}}<span class="text-danger"> * </span></label>

                                    <input type="file" class="form-control" name="image">

                                    @error('image')

                                    <span class="text-danger">{{ $message }}</span> 

                                 @enderror

                                 <img src="{{ helper::image_path($getblog->image)}}" class="img-fluid rounded hight-50 object mt-1" alt="">

                                </div>

                                <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">

                                    <a href="{{ URL::to('admin/blogs') }}" class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>

                                    <button class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_blogs', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" @if(env('Environment')=='sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>

    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/editor.js') }}"></script>

@endsection
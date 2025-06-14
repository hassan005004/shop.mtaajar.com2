@extends('admin.layout.default')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">

    <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.edit') }}</h5>

    <nav aria-label="breadcrumb">

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="{{ URL::to('admin/gallery') }}">{{ trans('labels.gallery') }}</a></li>

            <li class="breadcrumb-item active {{session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''}}" aria-current="page">{{ trans('labels.edit') }}</li>

        </ol>

    </nav>

</div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <form action="{{URL::to('/admin/gallery/update-'.$editgallery->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               
                                 <div class="form-group">
                                    <label class="form-label">{{trans('labels.image')}}</label>
                                    <input type="file" class="form-control" name="image">
                                     @error('image')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                 @enderror
                                    <img src="{{helper::image_path($editgallery->image)}}" class="img-fluid rounded hight-50 mt-1" alt="">
                                </div>
                            </div>
                            <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">
                                <a href="{{URL::to('admin/gallery')}}" class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                                <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif class="btn btn-primary px-sm-4 {{Auth::user()->type == 4 ? (helper::check_access('role_gallery',Auth::user()->role_id,Auth::user()->vendor_id,'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
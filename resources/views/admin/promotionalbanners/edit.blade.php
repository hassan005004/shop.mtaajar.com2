@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.edit') }}</h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb m-0">

                <li class="breadcrumb-item"><a
                        href="{{ URL::to('admin/promotionalbanners') }}">{{ trans('labels.promotional_banners') }}</a></li>

                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.edit') }}</li>

            </ol>

        </nav>

    </div>

    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="{{ URL::to('/admin/promotionalbanners/update-' . $banner->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ trans('labels.vendor_title') }}<span class="text-danger"> *
                                    </span></label>
                                <select class="form-select" name="vendor" id="" required>
                                    <option value="">{{ trans('labels.select') }}</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ $vendor->id == $banner->vendor_id ? 'selected' : '' }}>{{ $vendor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">{{ trans('labels.image') }} <span class="text-danger"> *
                                    </span></label>
                                <input type="file" name="image" class="form-control">
                                <img src="{{ helper::image_path($banner->image) }}" class="hight-50 object mt-1"
                                    alt="">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ session()->get('direction') == 2 ? 'text-start' : 'text-end' }}">

                            <a href="{{ URL::to('admin/promotionalbanners') }}"
                                class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>

                            <button
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_promotional_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection

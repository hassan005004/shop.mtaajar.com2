@extends('admin.layout.default')

@section('content')


        <div class="d-flex justify-content-between align-items-center">

            <h5 class="text-capitalize fw-600 text-dark fs-4">{{trans('labels.edit')}}</h5>

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item"><a href="{{URL::to('admin/sub-categories')}}">{{trans('labels.sub_categories')}}</a></li>

                    <li class="breadcrumb-item active {{session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''}}" aria-current="page">{{trans('labels.edit')}}</li>

                </ol>

            </nav>

        </div>

        <div class="row mt-3">

            <div class="col-12">

                <div class="card border-0 box-shadow">

                    <div class="card-body">

                        <form action="{{URL::to('admin/sub-categories/update-'.$sub_category->slug)}}" method="POST">

                            @csrf

                            <div class="col-12 form-group">

                                <label class="form-label">{{ trans('labels.category') }}<span class="text-danger">

                                        *</span></label>

                                <select class="form-select" name="category" required>

                                    <option value="">{{ trans('labels.select') }}</option>

                                    @foreach ($categories as $category)

                                        <option value="{{ $category->id }}" {{$sub_category->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>

                                    @endforeach

                                </select>

                                @error('category')<span class="text-danger">{{ $message }}</span>@enderror

                            </div>

                            <div class="col-12 form-group">

                                <label class="form-label">{{ trans('labels.sub_category') }}<span class="text-danger"> *</span></label>

                                <input type="text" class="form-control" name="sub_category" value="{{ $sub_category->name }}"

                                placeholder="{{ trans('labels.sub_category') }}" required>

                                @error('sub_category')<span class="text-danger">{{ $message }}</span>@enderror

                            </div>

                            <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">

                                <a href="{{ URL::to('admin/sub-categories') }}" class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>

                                <button class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" @if(env('Environment')=='sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    

@endsection


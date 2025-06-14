@extends('admin.layout.default')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.edit') }}</h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{ URL::to('admin/store_categories') }}">{{ trans('labels.store_categories')

                        }}</a></li>

                <li class="breadcrumb-item active {{session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''}}" aria-current="page">{{ trans('labels.edit') }}</li>

            </ol>

        </nav>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="{{ URL::to('admin/store_categories/update-' . $editcategory->id) }}" method="POST">

                        @csrf

                        <div class="row">

                            <div class="form-group">

                                <label class="form-label">{{ trans('labels.name') }}<span class="text-danger"> *

                                    </span></label>

                                <input type="text" class="form-control" name="category_name"

                                    value="{{ $editcategory->name }}" placeholder="{{ trans('labels.name') }}" required>

                              
                            </div>

                            <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">

                                <a href="{{ URL::to('admin/store_categories') }}" class="btn btn-danger px-sm-4">{{

                                    trans('labels.cancel') }}</a>

                                <button class="btn btn-primary px-sm-4" @if (env('Environment') == 'sendbox') type="button"

                                    onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save')

                                    }}</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
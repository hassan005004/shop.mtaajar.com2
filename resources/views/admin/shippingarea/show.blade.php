@extends('admin.layout.default')

@section('content')


            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.edit') }}</h5>

                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a

                                href="{{ URL::to('admin/shipping-area') }}">{{ trans('labels.shipping_area') }}</a></li>

                        <li class="breadcrumb-item active {{session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''}}" aria-current="page">{{ trans('labels.edit') }}</li>

                    </ol>

                </nav>

            </div>

            <div class="row mt-3">

                <div class="col-12">

                    <div class="card border-0 box-shadow">

                        <div class="card-body">

                            <form action="{{ URL::to('admin/shipping-area/update-' . $shippingareadata->id) }}"

                                method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label class="form-label">{{ trans('labels.area_name') }}<span class="text-danger"> * </span></label>

                                            <input type="text" class="form-control" name="name" value="{{ $shippingareadata->name }}" placeholder="{{ trans('labels.area_name') }}" required>

                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                                        </div>

                                        <div class="form-group">

                                            <label class="form-label">{{ trans('labels.delivery_charge') }}<span class="text-danger"> * </span></label>

                                            <input type="text" class="form-control numbers_only" name="delivery_charge" value="{{ $shippingareadata->delivery_charge }}" placeholder="{{ trans('labels.delivery_charge') }}" required>

                                            @error('delivery_charge')<span class="text-danger">{{ $message }}</span>@enderror

                                        </div>

                                    </div>

                                    <div class="form-group {{session()->get('direction') == 2 ? 'text-start' : 'text-end'}}">

                                        <a href="{{ URL::to('admin/shipping-area') }}" class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>

                                        <button class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}" @if(env('Environment')=='sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

     

@endsection


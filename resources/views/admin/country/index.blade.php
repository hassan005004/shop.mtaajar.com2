@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.countries') }}</h5>

        <a href="{{ URL::to('admin/countries/add') }}" class="btn btn-secondary px-sm-4 text-capitalize d-flex">

            <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}

        </a>

    </div>

    <div class="row">

        <div class="col-12">

            <div class="card border-0 my-3">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">

                            <thead>

                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td>{{ trans('labels.srno') }}</td>
                                    <td>{{ trans('labels.country') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>

                                </tr>

                            </thead>

                            <tbody id="tabledetails" data-url="{{ url('admin/countries/reorder_country') }}">

                                @php

                                    $i = 1;

                                @endphp

                                @foreach ($allcontries as $country)
                                    <tr class="fs-7 align-middle row1" id="dataid{{ $country->id }}"
                                        data-id="{{ $country->id }}">
                                        <td><a tooltip="{{ trans('labels.move') }}"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td>@php

                                            echo $i++;

                                        @endphp</td>

                                        <td>{{ $country->name }}</td>
                                        <td>

                                            @if ($country->is_available == '1')
                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/countries/change_status-' . $country->id . '/2') }}')" @endif
                                                    class="btn btn-sm btn-outline-success hov"
                                                    tooltip="{{ trans('labels.active') }}"><i
                                                        class="fa-regular fa-check"></i></a>
                                            @else
                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/countries/change_status-' . $country->id . '/1') }}')" @endif
                                                    class="btn btn-sm btn-outline-danger hov"
                                                    tooltip="{{ trans('labels.inactive') }}"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ helper::date_formate($country->created_at, $country->vendor_id) }}<br>
                                            {{ helper::time_formate($country->created_at, $country->vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_formate($country->updated_at, $country->vendor_id) }}<br>
                                            {{ helper::time_formate($country->updated_at, $country->vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ URL::to('admin/countries/edit-' . $country->id) }}"
                                                    class="btn hov btn-info btn-sm" tooltip="{{ trans('labels.edit') }}">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/countries/delete-' . $country->id) }}')" @endif
                                                    class="btn hov btn-danger btn-sm"
                                                    tooltip="{{ trans('labels.delete') }}"> <i
                                                        class="fa-regular fa-trash"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

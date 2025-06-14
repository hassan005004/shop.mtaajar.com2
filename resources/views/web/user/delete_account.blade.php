@extends('web.layout.default')
@section('contents')
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li
                        class="{{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }}">
                        <a class="text-dark fw-600" href="{{ URL::to(@$vendordata->slug . '/') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="text-muted {{ session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item' }} active"
                        aria-current="page">{{ trans('labels.delete_account') }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <div class="row">
                @include('web.user.sidebar')
                <div class="col-lg-9 col-xxl-9 deleteprofile">
                    <div class="card p-3">
                        <h5 class="text-dark m-0 mb-3 pb-3 border-bottom profile-title">{{ trans('labels.delete_profile') }}</h5>
                        <!-- Card body START -->
                        <div class="card-body p-0">
                            <h6 class="fw-bold text-dark mb-1">{{ trans('labels.before_delete_msg') }}</h6>
                            
                            <div class="form-check form-check-md my-4 text-muted">
                                <input class="form-check-input" type="checkbox" value="" id="deleteaccountCheck">
                                <label class="form-check-label text-muted" for="deleteaccountCheck">{{ trans('labels.are_you_sure_delete_account') }}</label>
                            </div>
                            <div class="d-md-flex align-items-center">
                                <a href="{{ URL::to('/') }}"
                                    class="col-12 col-md-3 fs-7 col-xl-2 btn rounded-0 fw-600 py-2 text-white btn-danger btn-outline-danger btn-sm mb-3 mb-md-0 {{ session()->get('direction') == 2 ? 'ms-2' : 'me-2' }}">Keep
                                    my account</a>
                                
                                <button onclick="statusupdate('{{ URL::to('/' . $vendordata->slug . '/deleteaccount') }}')" class="col-12 col-md-3 col-xl-2 fs-7 btn rounded-0 text-white btn-fashion  m-0 {{ session()->get('direction') == 2 ? 'float-start' : 'float-end' }}" disabled id="delete_account_button">
                                    {{ trans('labels.delete_profile') }}
                                </button>
                            </div>
                        </div>
                        <!-- Card body END -->
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    $(function() {
        $('#deleteaccountCheck').click(function() {
            if ($(this).is(':checked')) {
                $('#delete_account_button').removeAttr('disabled');
            } else {
                $('#delete_account_button').attr('disabled', 'disabled');
            }
        });
    });
</script>
@endsection
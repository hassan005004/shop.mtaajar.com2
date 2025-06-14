@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4">{{ trans('labels.share') }}</h5>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="card-block text-center">
                        <img src="https://qrcode.tec-it.com/API/QRCode?data={{ URL::to('/' . $user->slug) }}&choe=UTF-8"
                            width="230px" />
                        <div class="card-block mt-3">
                            <button class="btn btn-secondary" onclick="myFunction()">{{ trans('labels.share') }} <i
                                    class="fa-sharp fa-solid fa-share-nodes ms-2"></i></button>
                            <a href="https://qrcode.tec-it.com/API/QRCode?data={{ URL::to('/' . $user->slug) }}&choe=UTF-8"
                                target="_blank" class="btn btn-secondary">{{ trans('labels.download') }} <i
                                    class="fa-solid fa-arrow-down-to-line ms-2"></i></a>
                            <div id="share-icons" class="d-none">
                                {!! $shareComponent !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function myFunction() {
            $('#share-icons').toggleClass('d-none');
        }
    </script>
@endsection

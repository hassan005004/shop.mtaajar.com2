<!DOCTYPE html>
<html lang="en" dir="{{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">

<head>
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="{{ @helper::appdata($vendor_id)->meta_title }}" />
    <meta property="og:description" content="{{ @helper::appdata($vendor_id)->meta_description }}" />
    <meta property="og:image" content="{{ helper::image_path(@helper::appdata($vendor_id)->og_image) }}" />
    <link rel="icon" href="{{ helper::image_path(@helper::appdata($vendor_id)->favicon) }}" type="image"
        sizes="16x16">
    <title>{{ @helper::appdata($vendor_id)->web_title }}</title>
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap-select.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/fontawesome/all.min.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/toastr/toastr.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/responsive.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/timepicker/jquery.timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="{{ url(env('ASSETPATHURL') . 'admin-assets/css/datatables/buttons.dataTables.min.css') }}">
    <style>
        :root {
            /* Color */
            --bs-primary: {{ @helper::appdata('')->primary_color }};
            --bs-secondary: {{ @helper::appdata('')->secondary_color }};
        }
    </style>
</head>

<body>

    <main>
        <div class="wrapper">
            @include('admin.layout.header')
            <div class="content-wrapper">
                @include('admin.layout.sidebar')
                <div class="{{ session()->get('direction') == 2 ? 'main-content-rtl' : 'main-content' }}">
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="col-12">
                                @if (env('Environment') == 'sendbox')
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <p class=" d-flex align-items-center gap-2 flex-wrap">According to Envato's
                                            license policy, an extended license is required for SaaS usage. <a
                                                class="btn btn-primary btn-sm px-sm-4 active"
                                                href="https://1.envato.market/7mAvNr" target="_blank">Buy Now
                                            </a></p>
                                    </div>
                                @endif
                                <div class="col-12 ml-sm-auto">
                                    @if (env('Environment') == 'live')
                                        @if (request()->is('admin/custom_domain'))
                                            <div class="alert alert-warning" role="alert">
                                                {{ trans('messages.custom_domain_message') }}
                                            </div>
                                        @endif
                                        @if (request()->is('admin/apps'))
                                            <div class="alert alert-warning" role="alert">
                                                {{ trans('messages.addon_message') }}
                                            </div>
                                        @endif
                                    @endif
                                    @if (Auth::user()->type == 2)
                                        <?php
                                        
                                        $checkplan = helper::checkplan(Auth::user()->id, '');
                                        
                                        $plan = json_decode(json_encode($checkplan));
                                        
                                        ?>
                                        @if (@$plan->original->status == '2' && @$plan->original->showclick != 2)
                                            <div class="alert alert-warning" role="alert">
                                                {{ @$plan->original->message }}{{ empty($plan->original->expdate) ? '' : ':' . $plan->original->expdate }}
                                                @if (@$plan->original->showclick == 1)
                                                    <u><a
                                                            href="{{ URL::to('/admin/plan') }}">{{ trans('labels.click_here') }}</a></u>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!--Modal: order-modal-->
                <div class="modal fade" id="order-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notify modal-info" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header d-flex justify-content-center">
                                <p class="heading">{{ trans('messages.be_up_to_date') }}</p>
                            </div>
                            <div class="modal-body"><i class="fa fa-bell fa-4x animated rotateIn mb-4"></i>
                                <p>{{ trans('messages.new_order_arrive') }}</p>
                            </div>
                            <div class="modal-footer flex-center">
                                <a role="button" class="btn btn-outline-secondary-modal waves-effect"
                                    onClick="window.location.reload();"
                                    data-bs-dismiss="modal">{{ trans('labels.okay') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Modal: modalPush-->
                <!--theme image Modal -->
                <div class="modal fade" id="themeinfo" tabindex="-1" aria-labelledby="themeinfoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header justify-content-between">
                                <h5 class="modal-title text-dark" id="themeinfoLabel"></h5>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="theme_modalbody">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="py-3 text-center bg-white fixed-bottom border-top">
                <span>{{ @helper::appdata('')->copyright }}</span>
            </footer>
        </div>
    </main>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js') }}"></script><!-- jQuery JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap-select.min.js') }}"></script><!-- Bootstrap multi-select JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/sweetalert/sweetalert2.min.js') }}"></script><!-- Sweetalert JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/chartjs/chart_3.9.1.min.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/jquery.dataTables.min.js') }}"></script><!-- Datatables JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/dataTables.bootstrap5.min.js') }}"></script><!-- Datatables Bootstrap5 JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/dataTables.buttons.min.js') }}"></script><!-- Datatables Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/jszip.min.js') }}"></script><!-- Datatables Excel Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/pdfmake.min.js') }}"></script><!-- Datatables Make PDF Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/vfs_fonts.js') }}"></script><!-- Datatables Export PDF Buttons JS -->
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/datatables/buttons.html5.min.js') }}"></script><!-- Datatables Buttons HTML5 JS -->
    <script>
        var are_you_sure = "{{ trans('messages.are_you_sure') }}";
        var yes = "{{ trans('messages.yes') }}";
        var no = "{{ trans('messages.no') }}";
        let wrong = "{{ trans('messages.wrong') }}";
        let env = "{{ env('Environment') }}";
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}", "Success");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif
        @if (Auth::user()->type == 2)
            // New Notification
            var noticount = 0;
            var notificationurl = "{{ URL::to('/admin/getorder') }}";
            var vendoraudio =
                "{{ url(env('ASSETPATHURL') . 'admin-assets/notification/' . @helper::appdata(Auth::user()->id)->notification_sound) }}";
        @endif
    </script>
    @if (@helper::checkaddons('notification'))
        @if (Auth::user()->type == 2 || Auth::user()->type == 4)
            <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/sound.js') }}"></script>
        @endif
    @endif
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/common.js') }}"></script><!-- Common JS -->
    @yield('scripts')
</body>

</html>

<!DOCTYPE html>

<html lang="en" dir="{{ session()->get('direction') == 2 ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta property="og:title" content="{{ helper::appdata('')->meta_title }}" />

    <meta property="og:description" content="{{ helper::appdata('')->meta_description }}" />

    <meta property="og:image" content="{{ helper::image_path(helper::appdata('')->og_image) }}" />

    <link rel="icon" href="{{ helper::image_path(helper::appdata('')->favicon) }}" type="image" sizes="16x16">

    <title>{{ helper::appdata('')->web_title }}</title>

    <link rel="stylesheet" href="{{url(env('ASSETPATHURL') . 'admin-assets/css/bootstrap/bootstrap.min.css')}}"><!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{url(env('ASSETPATHURL') . 'admin-assets/css/fontawesome/all.min.css')}}"><!-- FontAwesome CSS -->

    <link rel="stylesheet" href="{{url(env('ASSETPATHURL') . 'admin-assets/css/toastr/toastr.min.css')}}"><!-- FontAwesome CSS -->

    <link rel="stylesheet" href="{{url(env('ASSETPATHURL') . 'admin-assets/css/style.css')}}"><!-- Custom CSS -->

    <link rel="stylesheet" href="{{url(env('ASSETPATHURL') . 'admin-assets/css/responsive.css')}}"><!-- Responsive CSS -->
    <!-- IF VERSION 2  -->
    @if (helper::appdata('')->recaptcha_version == 'v2')
    <script src='https://www.google.com/recaptcha/api.js'></script> 
    @endif
    <!-- IF VERSION 3  -->
    @if (helper::appdata('')->recaptcha_version == 'v3')
    {!! RecaptchaV3::initJs() !!}    
    @endif

    <style>
        :root {
            --bs-primary: {{ @helper::appdata(1)->primary_color }};
            --bs-secondary: {{ @helper::appdata(1)->secondary_color }};
            --bs-primary-rgb: 22, 22, 46;
            --bs-secondary-rgb: {{ @helper::appdata(1)->secondary_color . '10' }};
        }

        /**/
    </style>
</head>

<body>

  {{-- @include('admin.layout.preloader') --}}

<main>

  @yield('content')

</main>

  <script src="{{url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js')}}"></script><!-- jQuery JS -->

    <script src="{{url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script><!-- Bootstrap JS -->

    <script src="{{url(env('ASSETPATHURL') . 'admin-assets/js/toastr/toastr.min.js')}}"></script><!-- Toastr JS -->

    <script>

        toastr.options = {

          "closeButton": true,

          "positionClass": "toast-top-right",

        }

        @if (Session::has('success'))

            toastr.success("{{ session('success') }}");

        @endif

        @if (Session::has('error'))

            toastr.error("{{ session('error') }}");

        @endif

        $(window).on("load", function () {

          "use strict";

          $('#preloader').fadeOut('slow')

        });

        function myFunction() {

          "use strict";

          toastr.error("This operation was not performed due to demo mode");

          return false;

        }

    </script>
 <script src="{{ url(env('ASSETPATHURL') . 'admin-assets/js/auth_default.js') }}"></script>
    @yield('scripts')

</body>

</html>
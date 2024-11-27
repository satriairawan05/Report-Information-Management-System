<!doctype html>
<html lang="en">

<!-- Mirrored from templates.iqonic.design/cloudbox/html/backend/page-folders.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 14:47:17 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />

    <link rel="stylesheet" href="{{ asset('cloudbox/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/css/backende209.css?v=1.0.0') }}">

    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('cloudbox/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/remixicon/fonts/remixicon.css') }}">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
</head>

<body class="">
    <!-- Wrapper Start -->
    <div class="wrapper">
      <div class="container">
         <div class="row no-gutters height-self-center">
            <div class="col-sm-12 text-center align-self-center">
               <div class="iq-error position-relative">
                     <h2 class="mb-0 mt-4">@yield('code')</h2>
                     <p>Oops! @yield('message')</p>
                     <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ auth()->user() ? route('home') : route('landing-page') }}"><i class="fas {{ auth()->user() ? 'fa-home' : 'fa-plane' }}"></i>Back to {{ auth()->user() ? 'Home' : 'Landing Page' }}</a>
               </div>
            </div>
         </div>
   </div>
      </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('cloudbox/assets/js/backend-bundle.min.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('cloudbox/assets/js/customizer.js') }}" defer></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('cloudbox/assets/js/chart-custom.js') }}" defer></script>

    <!-- app JavaScript -->
    <script src="{{ asset('cloudbox/assets/js/app.js') }}" defer></script>
    <!-- My Javscript -->
</body>

<!-- Mirrored from templates.iqonic.design/cloudbox/html/backend/page-folders.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 14:47:17 GMT -->

</html>

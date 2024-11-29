<!doctype html>
<html lang="en">

<!-- Mirrored from templates.iqonic.design/cloudbox/html/backend/page-folders.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 14:47:17 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>
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
    <!--My CSS-->
    @stack('css')
</head>

<body class="">
    @php
        $name = auth()->user()->name;
        $alias = implode(
            '',
            array_map(function ($word) {
                return strtoupper($word[0]);
            }, explode(' ', $name)),
        );
    @endphp

    @stack('loader')
    <!-- Wrapper Start -->
    <div class="wrapper">

        @include('admin.partials.iq-sidebar')
        @include('admin.partials.iq-top-navbar')
        @yield('main')
    </div>
    @include('admin.partials.watermark')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Title</h4>
                    <div>
                        <a class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="resolte-contaniner" style="height: 500px;" class="overflow-auto">
                        File not found
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

    <!-- My Javscript -->
    @stack('js')

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    @if (session('success'))
        <script type="text/javascript">
            let successTime;
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                timer: 5000,
                icon: 'success',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    successTime = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif
    @if (session('failed'))
        <script type="text/javascript">
            let failedTime;
            Swal.fire({
                title: "Fail!",
                text: "{{ session('failed') }}",
                timer: 500000,
                icon: 'error',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    failedTime = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Title</h4>
                    <div>
                        <a class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-preview-link"></div>
                    <div id="resolte-contaniner" style="height: 500px;" class="overflow-auto">
                        File not found
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- Mirrored from templates.iqonic.design/cloudbox/html/backend/page-folders.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 14:47:17 GMT -->

</html>

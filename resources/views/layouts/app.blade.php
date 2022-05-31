<!DOCTYPE html>
<html lang="en">

<!-- index-0.html  Tue, 07 Jan 2020 03:35:33 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Analytics &mdash; CodiePie')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/modules/bootstrap/css/bootstrap.min.css') }}">

    <!-- Datatable CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/components.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('theme')
</head>

<body class="layout-4">

    @yield('auth-content')

    @auth
        <!-- Page Loader -->
        {{-- <div class="page-loader-wrapper">
            <span class="loader"><span class="loader-inner"></span></span>
        </div> --}}

        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>

                <!-- Start app top navbar -->
                @include('layouts.body.navbar')

                <!-- Start main left sidebar menu -->
                @include('layouts.body.sidebar')

                <!-- Start app main Content -->
                <div class="main-content">
                    @yield('content')
                </div>

                <!-- Start app Footer part -->
                @include('layouts.body.footer')
            </div>
        </div>
    @endauth

    <!-- General JS Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{ asset('dashboard/assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/js/CodiePie.js') }}"></script>

    <!-- Datatable JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js    "></script>

    <!-- Mark JS -->
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('dashboard/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('dashboard/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    <!-- Page Specific JS File -->
    @yield('specific-js')

    <!-- Template JS File -->
    <script src="{{ asset('dashboard/js/scripts.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>

    @yield('scripts')

    @auth
        @include('components.toast')

        @include('components.create-alert')
    @endauth
</body>

<!-- index-0.html  Tue, 07 Jan 2020 03:35:42 GMT -->

</html>

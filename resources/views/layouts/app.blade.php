{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}



<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Admin Panel | Global Jasa Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin GJS" name="GJS panel admin" />
    <meta content="Panel Admin" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('include.style')
    @stack('custom-css')
    <style>
        .menu-dropdown .nav-item .nav-link::before {
            content: none;
            display: none;
        }

        /* Dropdown (hidden) */
        .menu-dropdown {
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: height 0.35s ease, opacity 0.35s ease;
        }

        /* Dropdwon Show */
        .menu-dropdown.show {
            height: auto;
            opacity: 1;
        }

        @media (min-width: 576px) {

            /* sm: 2 columns */
            .custom-table tr {
                display: flex;
                flex-wrap: wrap;
            }

            .custom-table td {
                flex: 0 0 50%;
                /* 2 columns */
                padding: 10px;
            }
        }

        @media (min-width: 768px) {

            /* md: 3 columns */
            .custom-table td {
                flex: 0 0 33.33%;
                /* 3 columns */
            }
        }

        @media (min-width: 992px) {

            /* lg: 4 columns */
            .custom-table td {
                flex: 0 0 25%;
                /* 4 columns */
            }
        }

        @media(max-width: 768px) {
            .mobile-full-width {
                width: 100% !important;
            }
        }

        .custom-table tr {
            display: flex;
            flex-wrap: wrap;
        }

        .custom-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            /* Optional: menambahkan border untuk table */
        }
    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('include.header')

        <!-- /.modal -->
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo/logo_gjs.png') }} " alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo/logo_gjs.png') }} " alt="" height="50">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo/logo_gjs.png') }} " alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo/logo_gjs.png') }} " alt="" height="50">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            @include('include.sidebar')

        </div>

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <!-- slot dipake untuk nerusin konten apapun ke view -->
                {{ $slot }}
            </div>
            <!-- End Page-content -->

            @include('include.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    @include('include.preloader')

    @include('include.theme-settings')

    @include('include.js')

    @include('include.sweetalerts')

    @stack('custom-script')
</body>

</html>

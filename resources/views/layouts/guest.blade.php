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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel 11') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="iHub Login" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}">

    @include('include.style')

    <!-- Layout config Js -->
    <script src="{{ asset('/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="https://www.google.com/recaptcha/api.js"></script>

</head>

<body>
    <div class="auth-page-wrapper pt-5">
        {{ $slot }}
    </div>
    <!-- end auth-page-wrapper -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('/assets/js/pages/particles.app.js') }}"></script>
    <!-- validation init -->
    <script src="{{ asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <!-- password create init -->
    <script src="{{ asset('/assets/js/pages/passowrd-create.init.js') }}"></script>

    @include('include.js')

    @include('include.sweetalerts')

    @stack('custom-script')
</body>

</html>

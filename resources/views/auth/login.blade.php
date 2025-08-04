{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>

    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>


    <div class="auth-page-content">
        <div class="container">
            @include('include.header-auth')

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-black">{{ __('Welcome Back !') }}</h5>
                                <p class="text-muted"> {{ __('Sign in to continue to Pro Billiard Center.') }} </p>
                                <x-auth-session-status class="text-success" :status="session('status')" />
                            </div>
                            <div class="p-2 mt-4">
                                <form id="demo-form" action="{{ route('login') }}" novalidate method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input type="email" id="email" class="form-control"
                                            :error="$errors->has('email')" name="email" placeholder="Enter your email"
                                            :value="old('email')" />
                                        <x-feedback-message field="email" />
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted">
                                                    {{ __('Forgot password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <x-input-label for="password-input" :value="__('Password')" />
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <x-text-input type="password" class="form-control pe-5 password-input"
                                                placeholder="Enter your password" id="password-input" name="password"
                                                :error="$errors->has('password')" />
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                            <x-feedback-message field="password" />
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="auth-remember-check">
                                        <label class="form-check-label"
                                            for="auth-remember-check">{{ __('Remember Me?') }}</label>
                                    </div>

                                    <div class="mt-4">
                                        {{-- <x-success-button class="g-recaptcha w-100"
                                            data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                            data-callback='onSubmit' data-action='submit'>
                                            {{ __('Sign In') }}
                                        </x-success-button> --}}
                                        <x-primary-button class="g-recaptcha w-100"
                                            data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                            data-callback='onSubmit' data-action='submit'>
                                            {{ __('Sign In') }}
                                        </x-primary-button>
                                    </div>

                                    {{-- <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">{{ __('Sign In with') }}</h5>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    {{-- <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

    @push('custom-script')
        <script>
            function onSubmit(token) {
                document.getElementById("demo-form").submit();
            }
        </script>
    @endpush

</x-guest-layout>

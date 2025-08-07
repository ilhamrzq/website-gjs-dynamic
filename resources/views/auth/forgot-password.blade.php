{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                @include('include.header-auth')
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">{{ __('Forgot Password?') }}</h5>
                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                        colors="primary:#0ab39c" class="avatar-xl"></lord-icon>
                                </div>

                                <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                    {{ __('Enter your email and instructions will be sent to you!') }}
                                </div>
                                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                                <div class="p-2">
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="mb-4">
                                            <x-input-label for="email" :value="__('Email')" /><span
                                                class="text-danger">*</span>
                                            <x-text-input type="email" name="email" email="email" :value="old('email')"
                                                class="form-control" :error="$errors->has('email')" placeholder="Enter your email" />
                                            <x-feedback-message field="email" />
                                        </div>

                                        <div class="text-center mt-4">
                                            {{-- <x-success-button class="w-100">
                                                {{ __('Send Reset Link') }}
                                            </x-success-button> --}}
                                            <x-primary-button class="w-100">
                                                {{ __('Send Reset Link') }}
                                            </x-primary-button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="{{ route('login') }}"
                                    class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Global Jasa Sejahtera.
                                {{-- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
</x-guest-layout>

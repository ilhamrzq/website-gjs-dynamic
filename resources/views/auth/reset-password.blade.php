{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
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
                                    <h5 class="text-primary">{{ __('Create new password') }}</h5>
                                    <p class="text-muted">{{ __('New password must be different from previous.') }}</p>
                                    <x-auth-session-status class="text-success" :status="session('status')" />
                                </div>

                                <div class="p-2">
                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf

                                        {{-- <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <!-- Email Address -->
                                        <div class="mb-3">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input type="email" id="email" class="form-control" :error="$errors->has('email')" name="email" placeholder="Enter your email" :value="old('email', $request->email)" />
                                            <x-feedback-message field="email"/>
                                        </div> --}}

                                        <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                                        <!-- User ID -->
                                        <input type="hidden" name="user_id" value="{{ request()->user_id }}">
                                        {{-- <div class="mb-3">
                                            <x-input-label for="user_id" :value="__('User ID')" />
                                            <x-text-input type="hidden" type="text" id="user_id"
                                                class="form-control" :error="$errors->has('user_id')" name="user_id"
                                                placeholder="Enter your user ID" :value="old('user_id', request()->user_id)" />
                                            <x-feedback-message field="user_id" />
                                        </div> --}}

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password-input" :value="__('Password')" />
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <x-text-input type="password" class="form-control pe-5 password-input"
                                                    placeholder="Enter your password" id="password-input"
                                                    name="password" :error="$errors->has('password')" />
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                <x-feedback-message field="password" />
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password_confirmation" :value="__('Password Confirmation')" /><span
                                                class="text-danger">*</span>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <x-text-input type="password" name="password_confirmation"
                                                    :error="$errors->has('password_confirmation')" class="form-control pe-5 password-input"
                                                    onpaste="return false" placeholder="Confirm password"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    id="password_confirmation" />
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="confirm-password-input"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                <x-feedback-message field="password_confirmation" />
                                            </div>
                                        </div>


                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b>
                                            </p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter
                                                (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b>
                                                letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)
                                            </p>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>

                                        <div class="mt-4">
                                            {{-- <x-success-button class="w-100">
                                                {{ __('Reset Password') }}
                                            </x-success-button> --}}
                                            <x-primary-button class="w-100">
                                                {{ __('Reset Password') }}
                                            </x-primary-button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="auth-signin-basic.html"
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
                                </script> Pro Billiard Center.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
</x-guest-layout>

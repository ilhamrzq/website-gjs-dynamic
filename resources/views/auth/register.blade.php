{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                         autocomplete="new-password" />

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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
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
                                <h5 class="text-primary">{{ __('Create New Account') }}</h5>
                                <p class="text-muted"> {{  __('Get your free i-Hub account now') }} </p>
                            </div>
                            <div class="p-2 mt-4">
                                <form novalidate action="{{ route('register') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <x-input-label for="name" :value="__('Name')"/><span class="text-danger">*</span>
                                        <x-text-input type="text" name="name" :value="old('name')" class="form-control" :error="$errors->has('name')" placeholder="Enter name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')"/><span class="text-danger">*</span>
                                        <x-text-input type="email" name="email" email="email" :value="old('email')" class="form-control" :error="$errors->has('email')" placeholder="Enter email" />
                                        <x-feedback-message  field="email"/>
                                    </div>

                                    <div class="mb-3">
                                        <x-input-label for="phone" :value="__('Phone')"/><span class="text-danger">*</span>
                                        <x-text-input type="phone" name="phone" phone="phone" :value="old('phone')" class="form-control" :error="$errors->has('phone')" placeholder="Enter phone number" />
                                        <x-feedback-message field="phone"/>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password')" /><span class="text-danger">*</span>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <x-text-input type="password" name="password" :error="$errors->has('password')" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            <x-feedback-message field="password" />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password Confirmation')" /><span class="text-danger">*</span>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <x-text-input type="password" name="password_confirmation" :error="$errors->has('password_confirmation')" class="form-control pe-5 password-input" onpaste="return false" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm-password-input" required/>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                                        </div>
                                    </div>

                                    {{-- <div class="mb-4">
                                        <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Velzon <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
                                    </div> --}}

                                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                        <h5 class="fs-13"> {{  __('Password must contain:') }} </h5>
                                        <p id="pass-length" class="invalid fs-12 mb-2">{{ __('Minimum') }} <b> {{ __('8 characters') }} </b></p>
                                        <p id="pass-lower" class="invalid fs-12 mb-2">{{ __('At least') }} <b> {{ __('lowercase') }} </b> {{ __('letter (a-z)') }} </p>
                                        <p id="pass-upper" class="invalid fs-12 mb-2">{{ __('At least') }} <b> {{ __('uppercase')}} </b> {{ __('letter (A-Z)') }} </p>
                                        <p id="pass-number" class="invalid fs-12 mb-0">{{ __('At least') }} <b> {{ __('number') }}</b> {{ __('(0-9)') }} </p>
                                    </div>

                                    <div class="mt-4">
                                        <x-success-button class="w-100">
                                            {{ __('Sign Up') }}
                                        </x-success-button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title text-muted">{{ __('Create account with') }}</h5>
                                        </div>

                                        <div>
                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Already have an account ? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-guest-layout>


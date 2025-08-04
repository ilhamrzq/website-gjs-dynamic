<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h-100">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit {{ Auth::user()->name }} {{ __('Profiles') }}</h4>

                        <div class="d-flex justify-content-end">
                            <a href="{{ $action_back }}" type="button"
                                class="btn btn-primary btn-sm btn-label waves-effect waves-light"><i
                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profiles.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="row gx-4 gy-3">
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="user_name" :value="__('Name')" />
                                        <span class="text-danger">*</span>
                                        <x-text-input id="user_name" type="text" name="name" :value="old('name', Auth::user()->name)"
                                            class="form-control" :error="$errors->has('name')" placeholder="Enter your name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="user_email" :value="__('Email')" />
                                        <span class="text-danger">*</span>
                                        <x-text-input id="user_email" type="email" name="email" :value="old('email', Auth::user()->email)"
                                            class="form-control" :error="$errors->has('email')" placeholder="Enter your email" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="user_phone" :value="__('Phone')" />
                                        <span class="text-danger">*</span>
                                        <x-text-input id="user_phone" type="text" name="phone" :value="old('phone', Auth::user()->phone)"
                                            class="form-control" :error="$errors->has('phone')"
                                            placeholder="Enter your phone number" />
                                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="user_password" :value="__('Password')" />
                                        <span class="text-danger">*</span>
                                        <x-text-input id="user_password" type="password" name="password"
                                            class="form-control" :error="$errors->has('password')" placeholder="Enter your password" />
                                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="user_password_confirmation" :value="__('Confirm Password')" />
                                        <span class="text-danger">*</span>
                                        <x-text-input id="user_password_confirmation" type="password"
                                            name="password_confirmation" class="form-control" :error="$errors->has('password_confirmation')"
                                            placeholder="Confirm your password" />
                                        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                                    </div>
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <x-primary-button>
                                        {{ __('Update Profile') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h-100">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ Auth::user()->name }} {{ __('Profiles') }}</h4>
                    </div>

                    <div class="card-body p-4">
                        <div class="row gx-4 gy-3">
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-1">{{ __('Name') }}</h6>
                                    <p class="mb-0">{{ Auth::user()->name }}</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-1">{{ __('Email') }}</h6>
                                    <p class="mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-1">{{ __('Phone') }}</h6>
                                    <p class="mb-0">{{ Auth::user()->phone }}</p>
                                </div>
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('profiles.edit') }}" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-10">
                <div class="card">
                    <div class="d-flex me-3 mt-3 justify-content-end">
                        <a href="{{ $action_back }}" type="button"
                            class="btn btn-primary btn-sm btn-label waves-effect waves-light"><i
                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('Back') }}
                        </a>
                    </div>

                    <div class="card-header d-flex">
                        <ul class="flex-grow-1 nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ session('activeTab', 'profileData') == 'profileData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#profileData" role="tab">
                                    @if (!request()->routeIs('cms.profile.edit') && !request()->routeIs('cms.profile.show'))
                                        {{ __('Company Profile') }}
                                    @endif

                                    @if (request()->routeIs('cms.profile.edit') || request()->routeIs('cms.profile.show'))
                                        {{ __('Edit Company Profile') }}
                                    @endif
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link {{ session('activeTab') == 'homepageHeroImage' ? 'active' : '' }}" data-bs-toggle="tab" href="#homepageHeroImage" role="tab" 
                                @if (!request()->routeIs('cms.profile.edit') && !request()->routeIs('cms.profile.show')) style="display: none;" @endif>
                                    {{ __("Images of the Hero Section") }}
                                </a>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Homepage --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'profileData') == 'profileData' ? 'active' : '' }}"
                                id="profileData" role="tabpanel">
                                <div class="live-preview">
                                    @if (isset($record))
                                        <?php $button = 'Save Changes'; ?>
                                        <form action=" {{ $action }} " method="POST">
                                            @csrf
                                        @else
                                            <?php $button = 'Submit'; ?>
                                            <form action=" {{ $action }} " method="POST">
                                                @csrf
                                    @endif
                                    <div class="row">
                                        <div class="row align-items-center">

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="company-email" :value="__('Company Email')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="email" name="company_email" :value="old('company_email', $record->company_email ?? '')"
                                                        class="form-control" :error="$errors->has('company_email')"
                                                        placeholder="Enter the company email" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('company_email')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="company-phone_number" :value="__('Company Phone Number')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="number" name="company_phone_number"
                                                        :value="old(
                                                            'company_phone_number',
                                                            $record->company_phone_number ?? '',
                                                        )" class="form-control" :error="$errors->has('company_phone_number')"
                                                        placeholder="Enter the company phone number" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('company_phone_number')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="company-address" :value="__('Company Address')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="company_address"
                                                        :value="old(
                                                            'company_address',
                                                            $record->company_address ?? '',
                                                        )" class="form-control" :error="$errors->has('company_address')"
                                                        placeholder="Enter the company address" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('company_address')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="company-iframe-maps-url"
                                                        :value="__('Company iFrame Maps URL')" /><span class="text-danger">*</span>
                                                    <x-text-input type="text" name="company_iframe_maps_url"
                                                        :value="old(
                                                            'company_iframe_maps_url',
                                                            $record->company_iframe_maps_url ?? '',
                                                        )" class="form-control" :error="$errors->has('company_iframe_maps_url')"
                                                        placeholder="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.593608328233!2d106.8318784!3d-6.1851058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5002219c23f%3A0xeee35a453ed56a0b!2sPro%20Billiard%20Center!5e0!3m2!1sid!2sid!4v1748226080306!5m2!1sid!2sid" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('company_iframe_maps_url')" />
                                                </div>
                                            </div>
                                        </div>

                                        @if ($action)
                                            <div class="col-lg-12 text-end">
                                                <x-primary-button loading-text="Saving..."> {{ __($button) }}
                                                </x-primary-button>
                                            </div>
                                        @endif
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('custom-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input[name="company_phone_number"]').forEach(function(input) {
                    input.addEventListener('keydown', function(e) {
                        // Izinkan tombol navigasi, backspace, delete, tab, enter
                        if (
                            e.key === "Backspace" ||
                            e.key === "Delete" ||
                            e.key === "Tab" ||
                            e.key === "Enter" ||
                            e.key === "ArrowLeft" ||
                            e.key === "ArrowRight" ||
                            e.key === "Home" ||
                            e.key === "End"
                        ) {
                            return;
                        }

                        // Izinkan Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                        if ((e.ctrlKey || e.metaKey) && ["a", "c", "v", "x"].includes(e.key
                                .toLowerCase())) {
                            return;
                        }

                        // Jika bukan digit 0-9, prevent
                        if (!/^\d$/.test(e.key)) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>

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
                                <a class="nav-link {{ session('activeTab', 'socmedData') == 'socmedData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#socmedData" role="tab">
                                    @if (!request()->routeIs('cms.social-media.edit') && !request()->routeIs('cms.social-media.show'))
                                        {{ __('Social Media') }}
                                    @endif

                                    @if (request()->routeIs('cms.social-media.edit') || request()->routeIs('cms.social-media.show'))
                                        {{ __('Edit Social Media') }}
                                    @endif
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link {{ session('activeTab') == 'homepageHeroImage' ? 'active' : '' }}" data-bs-toggle="tab" href="#homepageHeroImage" role="tab" 
                                @if (!request()->routeIs('cms.social-media.edit') && !request()->routeIs('cms.social-media.show')) style="display: none;" @endif>
                                    {{ __("Images of the Hero Section") }}
                                </a>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Homepage --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'socmedData') == 'socmedData' ? 'active' : '' }}"
                                id="socmedData" role="tabpanel">
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
                                                    <x-input-label for="socmed-name" :value="__('Social Media Name')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="socmed_name" :value="old('socmed_name', $record->socmed_name ?? '')"
                                                        class="form-control" :error="$errors->has('socmed_name')"
                                                        placeholder="Enter the social media name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('socmed_name')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="socmed-icon" :value="__('Social Media Icon')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="socmed_icon" :value="old('socmed_icon', $record->socmed_icon ?? '')"
                                                        class="form-control" :error="$errors->has('socmed_icon')"
                                                        placeholder="Enter the social media icon" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('socmed_icon')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="socmed-url" :value="__('Social Media URL')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="socmed_url" :value="old('socmed_url', $record->socmed_url ?? '')"
                                                        class="form-control" :error="$errors->has('socmed_url')"
                                                        placeholder="Enter the social media url" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('socmed_url')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="socmed-username" :value="__('Social Media Username')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="socmed_username"
                                                        :value="old(
                                                            'socmed_username',
                                                            $record->socmed_username ?? '',
                                                        )" class="form-control" :error="$errors->has('socmed_username')"
                                                        placeholder="Enter the social media username" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('socmed_username')" />
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
</x-app-layout>

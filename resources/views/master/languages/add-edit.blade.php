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
                                <a class="nav-link {{ session('activeTab', 'languageData') == 'languageData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#languageData" role="tab">
                                    @if (!request()->routeIs('master.languages.edit') && !request()->routeIs('master.languages.show'))
                                        {{ __('Language') }}
                                    @endif

                                    @if (request()->routeIs('master.languages.edit') || request()->routeIs('master.languages.show'))
                                        {{ __('Edit Language') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            {{-- Edit Homepage --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'languageData') == 'languageData' ? 'active' : '' }}"
                                id="languageData" role="tabpanel">
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
                                                    <x-input-label for="language-name" :value="__('Language Name')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="language_name" :value="old('language_name', $record->language_name ?? '')"
                                                        class="form-control" :error="$errors->has('language_name')"
                                                        placeholder="Enter the language name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('language_name')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="language-code" :value="__('Language Code')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="language_code" :value="old('language_code', $record->language_code ?? '')"
                                                        class="form-control" :error="$errors->has('language_code')"
                                                        placeholder="Enter the language code" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('language_code')" />
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

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
                                <a class="nav-link {{ session('activeTab', 'policyData') == 'policyData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#policyData" role="tab">
                                    @if (!request()->routeIs('cms.booking-policies.edit') && !request()->routeIs('cms.booking-policies.show'))
                                        {{ __('Booking Policy') }}
                                    @endif

                                    @if (request()->routeIs('cms.booking-policies.edit') || request()->routeIs('cms.booking-policies.show'))
                                        {{ __('Edit Booking Policy') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Homepage --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'policyData') == 'policyData' ? 'active' : '' }}"
                                id="policyData" role="tabpanel">
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
                                                    <x-input-label for="lang_id" :value="__('Language Code')" /><span
                                                        class="text-danger">*</span>
                                                    <select class="js-example-basic-single" name="lang_id">
                                                        @foreach ($languages as $language)
                                                            <option value="{{ $language->id }}"
                                                                @if (old('lang_id', $record->lang_id ?? '') == $language->id) selected @endif>
                                                                {{ $language['language_name'] }}
                                                                ({{ $language['language_code'] }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="policy-description" :value="__('Policy Description')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="policy_description"
                                                        :value="old(
                                                            'policy_description',
                                                            $record->policy_description ?? '',
                                                        )" class="form-control" :error="$errors->has('policy_description')"
                                                        placeholder="Enter the booking policy description" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('policy_description')" />
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

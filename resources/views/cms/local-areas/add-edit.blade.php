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
                                <a class="nav-link {{ session('activeTab', 'localAreaMenu') == 'localAreaMenu' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#localAreaMenu" role="tab">
                                    @if (!request()->routeIs('cms.local-areas.edit') && !request()->routeIs('cms.local-areas.show'))
                                        {{ __('Local Area') }}
                                    @endif

                                    @if (request()->routeIs('cms.local-areas.edit') || request()->routeIs('cms.local-areas.show'))
                                        {{ __('Edit Local Area') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Menu --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'localAreaMenu') == 'localAreaMenu' ? 'active' : '' }}"
                                id="localAreaMenu" role="tabpanel">
                                <div class="live-preview">
                                    @if (isset($record))
                                        <?php $button = 'Save Changes'; ?>
                                        <form action=" {{ $action }} " method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                        @else
                                            <?php $button = 'Submit'; ?>
                                            <form action=" {{ $action }} " method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                    @endif
                                    <div class="row">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="place-name" :value="__('Place Name')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="place_name" :value="old('place_name', $record->place_name ?? '')"
                                                        class="form-control" :error="$errors->has('place_name')"
                                                        placeholder="Enter the place name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('place_name')" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Single image input --}}
                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="image" :value="__('Image File')" />
                                                    <input type="file" name="image" class="form-control"
                                                        accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" />
                                                    {{-- Show old file name if exists --}}
                                                    @if (isset($record) && $record->file_name)
                                                        <p class="mt-2">Current File:
                                                            <strong>{{ $record->file_name }}</strong>
                                                        </p>
                                                        @if (isset($record) && $record->file_path)
                                                            <button type="button"
                                                                class="btn btn-outline-primary btn-icon waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#imagePreviewModal">
                                                                <i class="ri-eye-fill"></i>
                                                            </button>

                                                            <!-- Modal for image preview -->
                                                            <div id="imagePreviewModal" class="modal fade zoomIn"
                                                                tabindex="-1" aria-labelledby="imagePreviewModal_label"
                                                                aria-hidden="true">
                                                                <div
                                                                    class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="imagePreviewModal_label">Preview
                                                                                Image</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <img src="{{ asset($record->file_path) }}"
                                                                                alt="Image Preview"
                                                                                style="max-width: 100%; height: auto; border-radius: 8px;">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    @endif
                                                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                                </div>
                                            </div>
                                        </div>



                                        @if ($action)
                                            <div class="col-lg-12 text-end">
                                                <x-primary-button>{{ __($button) }}</x-primary-button>
                                            </div>
                                        @endif
                                    </div>
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

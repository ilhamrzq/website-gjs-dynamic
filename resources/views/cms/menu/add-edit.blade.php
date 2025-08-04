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
                                <a class="nav-link {{ session('activeTab', 'menuData') == 'menuData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#menuData" role="tab">
                                    @if (!request()->routeIs('cms.menu.edit') && !request()->routeIs('cms.menu.show'))
                                        {{ __('Menu') }}
                                    @endif

                                    @if (request()->routeIs('cms.menu.edit') || request()->routeIs('cms.menu.show'))
                                        {{ __('Edit Menu') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Menu --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'menuData') == 'menuData' ? 'active' : '' }}"
                                id="menuData" role="tabpanel">
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
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="menu-name" :value="__('Menu Name')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="menu_name" :value="old('menu_name', $record->menu_name ?? '')"
                                                        class="form-control" :error="$errors->has('menu_name')"
                                                        placeholder="Enter the menu name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('menu_name')" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="menu-path" :value="__('Menu Path')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="menu_path" :value="old('menu_path', $record->menu_path ?? '')"
                                                        class="form-control" :error="$errors->has('menu_path')"
                                                        placeholder="Enter the menu path" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('menu_path')" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="is-menu" :value="__('Is Menu')" /><span
                                                    class="text-danger">*</span>
                                                <div class="form-check form-switch">
                                                    <input type="hidden" name="is_menu" value="0">
                                                    <input class="form-check-input switch-menu" type="checkbox"
                                                        name="is_menu" value="1"
                                                        @if (isset($record) && $record->is_menu) checked @endif>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($action)
                                            <div class="col-lg-12 text-end">
                                                <x-primary-button loading-text="Saving..."> {{ __($button) }}
                                                </x-primary-button>
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
    @push('custom-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    // Get all checkboxes that might not be checked
                    if (!document.querySelector('input[name="is_menu"]:checked')) {
                        // Create a hidden field if the checkbox is unchecked
                        const hiddenField = document.createElement('input');
                        hiddenField.type = 'hidden';
                        hiddenField.name = 'is_menu';
                        hiddenField.value = '0';
                        form.appendChild(hiddenField);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

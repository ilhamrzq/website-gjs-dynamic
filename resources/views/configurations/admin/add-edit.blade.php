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
                                <a class="nav-link {{ session('activeTab', 'adminData') == 'adminData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#adminData" role="tab">
                                    @if (!request()->routeIs('configurations.admin.edit') && !request()->routeIs('configurations.admin.show'))
                                        {{ __('Admin') }}
                                    @endif

                                    @if (request()->routeIs('configurations.admin.edit') || request()->routeIs('configurations.admin.show'))
                                        {{ __('Edit Admin') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Menu --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'adminData') == 'adminData' ? 'active' : '' }}"
                                id="adminData" role="tabpanel">
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
                                                    <x-input-label for="roles" :value="__('Roles')" />
                                                    <select name="roles[]" id="roles"
                                                        class="form-select js-example-basic-multiple" multiple required>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                @if (collect(old('roles', $admin_roles->pluck('id') ?? []))->contains($role->id)) selected @endif>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('roles')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="name" :value="__('Name')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="name" :value="old('name', $record->name ?? '')"
                                                        class="form-control" :error="$errors->has('name')"
                                                        placeholder="Enter the admin name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="email" :value="__('Email')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="email" name="email" :value="old('email', $record->email ?? '')"
                                                        class="form-control" :error="$errors->has('email')"
                                                        placeholder="Enter the admin email" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="phone" :value="__('Phone Number')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="phone" pattern="[0-9]*"
                                                        inputmode="numeric" :value="old('phone', $record->phone ?? '')" class="form-control"
                                                        :error="$errors->has('phone')" placeholder="Enter the admin phone number" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="password" :value="__('Password')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="password" name="password" class="form-control"
                                                        :error="$errors->has('password')" placeholder="Enter the admin password" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <x-input-label for="password_confirmation"
                                                        :value="__('Password')" /><span class="text-danger">*</span>
                                                    <x-text-input type="password" name="password_confirmation"
                                                        :value="old(
                                                            'password_confirmation',
                                                            $record->password_confirmation ?? '',
                                                        )" class="form-control" :error="$errors->has('password_confirmation')"
                                                        placeholder="Enter the admin password confirmation" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
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

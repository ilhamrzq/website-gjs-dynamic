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
                                <a class="nav-link {{ session('activeTab', 'membershipData') == 'membershipData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#membershipData" role="tab">
                                    @if (!request()->routeIs('memberships.edit') && !request()->routeIs('memberships.show'))
                                        {{ __('Membership') }}
                                    @endif

                                    @if (request()->routeIs('memberships.edit') || request()->routeIs('memberships.show'))
                                        {{ __('Edit Membership') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Membership --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'membershipData') == 'membershipData' ? 'active' : '' }}"
                                id="membershipData" role="tabpanel">
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
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="membership_name" :value="__('Membership Name')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="membership_name" :value="old('membership_name', $record->membership_name ?? '')"
                                                    class="form-control" required :error="$errors->has('membership_name')"
                                                    placeholder="Enter the membership name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('membership_name')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="membership_description" :value="__('Membership Description')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="membership_description"
                                                    :value="old(
                                                        'membership_description',
                                                        $record->membership_description ?? '',
                                                    )" class="form-control" required :error="$errors->has('membership_description')"
                                                    placeholder="Enter the membership description" />
                                                <x-input-error class="mt-2" :messages="$errors->get('membership_description')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="membership_price" :value="__('Membership Price')" />
                                                <span class="text-danger">*</span>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <x-text-input type="text" id="membership_price"
                                                        name="membership_price" :value="old(
                                                            'membership_price',
                                                            $record->membership_price ?? '',
                                                        )" data-format="currency"
                                                        class="form-control" :error="$errors->has('membership_price')" placeholder="10000" />
                                                </div>
                                                <x-input-error class="mt-2" :messages="$errors->get('membership_price')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="membership_color" :value="__('Membership Color')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="color" name="membership_color" :value="old('membership_color', $record->membership_color ?? '')"
                                                    class="form-control" required :error="$errors->has('membership_color')"
                                                    placeholder="Enter the membership color" />
                                                <x-input-error class="mt-2" :messages="$errors->get('membership_color')" />
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
                document.querySelectorAll('input[name="membership_price"]').forEach(function(input) {
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

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
                                <a class="nav-link {{ session('activeTab', 'listData') == 'listData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#listData" role="tab">
                                    @if (!request()->routeIs('cms.price-lists.edit') && !request()->routeIs('cms.price-lists.show'))
                                        {{ __('Price List') }}
                                    @endif

                                    @if (request()->routeIs('cms.price-lists.edit') || request()->routeIs('cms.price-lists.show'))
                                        {{ __('Edit Price List') }}
                                    @endif
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link {{ session('activeTab') == 'homepageHeroImage' ? 'active' : '' }}" data-bs-toggle="tab" href="#homepageHeroImage" role="tab" 
                                @if (!request()->routeIs('cms.price-lists.edit') && !request()->routeIs('cms.price-lists.show')) style="display: none;" @endif>
                                    {{ __("Images of the Hero Section") }}
                                </a>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Homepage --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'listData') == 'listData' ? 'active' : '' }}"
                                id="listData" role="tabpanel">
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
                                                    <x-input-label for="price-name" :value="__('Price Name')" /><span
                                                        class="text-danger">*</span>
                                                    <x-text-input type="text" name="price_name" :value="old('price_name', $record->price_name ?? '')"
                                                        class="form-control" :error="$errors->has('price_name')"
                                                        placeholder="Enter the price name" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('price_name')" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 mt-3">
                                            <x-input-label for="price_normal" :value="__('Price Normal')" />
                                            <span class="text-danger">*</span>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <x-text-input type="text" id="price_normal" name="price_normal"
                                                    :value="old('price_normal', $record->price_normal ?? '')" data-format="currency" class="form-control"
                                                    :error="$errors->has('price_normal')" placeholder="10000" />
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('price_normal')" />
                                        </div>

                                        <div class="col-lg-3 col-sm-12 mt-3">
                                            <x-input-label for="price_promo" :value="__('Price Promo')" />
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <x-text-input type="text" id="price_promo" name="price_promo"
                                                    :value="old('price_promo', $record->price_promo ?? '')" data-format="currency" class="form-control"
                                                    :error="$errors->has('price_promo')" placeholder="10000" />
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('price_promo')" />
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
                // Gabungkan selector menjadi satu
                const selectors = ['input[name="price_normal"]', 'input[name="price_promo"]'];
                document.querySelectorAll(selectors.join(',')).forEach(function(input) {
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

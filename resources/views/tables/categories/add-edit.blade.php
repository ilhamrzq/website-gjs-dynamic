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
                                <a class="nav-link {{ session('activeTab', 'tableCategoryData') == 'tableCategoryData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#tableCategoryData" role="tab">
                                    @if (!request()->routeIs('tables.categories.edit') && !request()->routeIs('tables.categories.show'))
                                        {{ __('Billiard Table Category') }}
                                    @endif

                                    @if (request()->routeIs('tables.categories.edit') || request()->routeIs('tables.categories.show'))
                                        {{ __('Edit Billiard Table Category') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Product Category --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'tableCategoryData') == 'tableCategoryData' ? 'active' : '' }}"
                                id="tableCategoryData" role="tabpanel">
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
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <x-input-label for="venue" :value="__('Venue')" /><span
                                                class="text-danger">*</span>
                                            <select class="js-example-basic-single" name="venue_id">
                                                @foreach ($venues as $venue)
                                                    <option value="{{ $venue['id'] }}"
                                                        @if (old('venue_id', $record->venue_id ?? '') == $venue['id']) selected @endif>
                                                        {{ $venue['venue_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="table_category_name" :value="__('Billiard Table Category Name')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="table_category_name"
                                                    :value="old(
                                                        'table_category_name',
                                                        $record->table_category_name ?? '',
                                                    )" class="form-control" required :error="$errors->has('table_category_name')"
                                                    placeholder="Enter the billiard table category name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('table_category_name')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="table_category_description"
                                                    :value="__('Billiard Table Category Description')" /><span class="text-danger">*</span>
                                                <x-text-input type="text" name="table_category_description"
                                                    :value="old(
                                                        'table_category_description',
                                                        $record->table_category_description ?? '',
                                                    )" class="form-control" required :error="$errors->has('table_category_description')"
                                                    placeholder="Enter the billiard table category description" />
                                                <x-input-error class="mt-2" :messages="$errors->get('table_category_description')" />
                                            </div>
                                        </div>

                                        <div class="card-header mt-5">
                                            <h5 class="card-title mb-0">Set Prices</h5>
                                        </div>
                                        @if (count($price_types) < 1)
                                            <h5 class="text-danger my-3"> The price type is empty. Please add it before
                                                setting the price for this billiard table categories.</h5>
                                        @else
                                            @foreach ($price_types as $price)
                                                <div class="col-lg-3 col-sm-12 mt-3">
                                                    <x-input-label for="{{ $price->price_type_name }}"
                                                        :value="__($price->price_type_name)" />
                                                    <span class="text-danger">*</span>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <x-text-input type="text" id="{{ $price->price_type_name }}"
                                                            name="price_data[{{ $price->id . '_' . str_replace(' ', '_', $price->price_type_name) }}]"
                                                            :value="old(
                                                                'price_data.' .
                                                                    $price->id .
                                                                    '_' .
                                                                    str_replace(' ', '_', $price->price_type_name),
                                                                $price_data[
                                                                    $price->id .
                                                                        '_' .
                                                                        str_replace(' ', '_', $price->price_type_name)
                                                                ] ?? '',
                                                            )" data-format="currency"
                                                            class="form-control" :error="$errors->has(
                                                                'price_data.' .
                                                                    $price->id .
                                                                    '_' .
                                                                    str_replace(' ', '_', $price->price_type_name),
                                                            )"
                                                            placeholder="10000" />
                                                    </div>
                                                    <x-input-error class="mt-2" :messages="$errors->get(
                                                        'price_data.' .
                                                            $price->id .
                                                            '_' .
                                                            str_replace(' ', '_', $price->price_type_name),
                                                    )" />
                                                </div>
                                            @endforeach
                                        @endif

                                        <div class="card-header mt-5">
                                            <h5 class="card-title mb-0">Set Discounts</h5>
                                        </div>
                                        <p class="mt-1">Please enter “0” if you don’t want to apply any discount.</p>
                                        @if (count($discount_types) < 1)
                                            <h5 class="text-danger my-3"> The discount type is empty. Please add it
                                                before setting the discount for this billiard table categories.</h5>
                                        @else
                                            @foreach ($discount_types as $discount)
                                                <div class="col-lg-3 col-sm-12 mt-3">
                                                    <x-input-label for="{{ $discount->discount_type_name }}"
                                                        :value="__($discount->discount_type_name)" />
                                                    <span class="text-danger">*</span>
                                                    <div class="input-group">
                                                        <span class="input-group-text">%</span>
                                                        <x-text-input type="text"
                                                            id="{{ $discount->discount_type_name }}"
                                                            name="discount_data[{{ $discount->id . '_' . str_replace(' ', '_', $discount->discount_type_name) }}]"
                                                            :value="old(
                                                                'discount_data.' .
                                                                    $discount->id .
                                                                    '_' .
                                                                    str_replace(
                                                                        ' ',
                                                                        '_',
                                                                        $discount->discount_type_name,
                                                                    ),
                                                                $discount_data[
                                                                    $discount->id .
                                                                        '_' .
                                                                        str_replace(
                                                                            ' ',
                                                                            '_',
                                                                            $discount->discount_type_name,
                                                                        )
                                                                ] ?? '',
                                                            )" data-format="currency"
                                                            class="form-control" :error="$errors->has(
                                                                'discount_data.' .
                                                                    $discount->id .
                                                                    '_' .
                                                                    str_replace(
                                                                        ' ',
                                                                        '_',
                                                                        $discount->discount_type_name,
                                                                    ),
                                                            )" placeholder="10" />
                                                    </div>
                                                    <x-input-error class="mt-2" :messages="$errors->get(
                                                        'discount_data.' .
                                                            $discount->id .
                                                            '_' .
                                                            str_replace(' ', '_', $discount->discount_type_name),
                                                    )" />
                                                </div>
                                            @endforeach
                                        @endif

                                        @if ($action && (count($price_types) > 0 && count($discount_types) > 0))
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
                // Ambil semua input yang name-nya diawali "price_data["
                document.querySelectorAll('input[name^="price_data["]').forEach(function(input) {
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
                // Ambil semua input yang name-nya diawali "price_data["
                document.querySelectorAll('input[name^="discount_data["]').forEach(function(input) {
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

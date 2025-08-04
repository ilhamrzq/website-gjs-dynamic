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
                                <a class="nav-link {{ session('activeTab', 'billiardTableData') == 'billiardTableData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#billiardTableData" role="tab">
                                    @if (!request()->routeIs('tables.lists.edit') && !request()->routeIs('tables.lists.show'))
                                        {{ __('Billiard Table') }}
                                    @endif

                                    @if (request()->routeIs('tables.lists.edit') || request()->routeIs('tables.lists.show'))
                                        {{ __('Edit Billiard Table') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            {{-- Edit Homepage --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'billiardTableData') == 'billiardTableData' ? 'active' : '' }}"
                                id="billiardTableData" role="tabpanel">
                                <div class="live-preview">
                                    @if (isset($record))
                                        <?php $button = 'Save Changes'; ?>
                                        <form x-data="{ loading: false }" x-on:submit="loading = true"
                                            action="{{ $action }}" method="POST">
                                            @csrf
                                        @else
                                            <?php $button = 'Submit'; ?>
                                            <form x-data="{ loading: false }" x-on:submit="loading = true"
                                                action="{{ $action }}" method="POST">
                                                @csrf
                                    @endif
                                    <div class="row">

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="table_category_id" :value="__('Billiard Table Category')" /><span
                                                    class="text-danger">*</span>
                                                <select class="js-example-basic-single" name="table_category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if (old('table_category_id', $record->table_category_id ?? '') == $category->id) selected @endif>
                                                            {{ $category['table_category_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="table-name" :value="__('Table Name')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="table_name" :value="old('table_name', $record->table_name ?? '')"
                                                    class="form-control" :error="$errors->has('table_name')"
                                                    placeholder="Enter the table name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('table_name')" />
                                            </div>
                                        </div>


                                        @if ($action)
                                            <div class="col-lg-12 text-end">
                                                {{-- <x-primary-button> {{ __($button) }} </x-primary-button> --}}
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

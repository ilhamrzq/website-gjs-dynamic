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
                                <a class="nav-link {{ session('activeTab', 'productCategoryData') == 'productCategoryData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#productCategoryData" role="tab">
                                    @if (!request()->routeIs('products.categories.edit') && !request()->routeIs('products.categories.show'))
                                        {{ __('Billiard Table Category') }}
                                    @endif

                                    @if (request()->routeIs('products.categories.edit') || request()->routeIs('products.categories.show'))
                                        {{ __('Edit Category') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Billiard Table Category --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'productCategoryData') == 'productCategoryData' ? 'active' : '' }}"
                                id="productCategoryData" role="tabpanel">
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
                                                <x-input-label for="product_category_name" :value="__('Billiard Table Category Name')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="product_category_name"
                                                    :value="old(
                                                        'product_category_name',
                                                        $record->product_category_name ?? '',
                                                    )" class="form-control" required :error="$errors->has('product_category_name')"
                                                    placeholder="Enter the category name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('product_category_name')" />
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
        <script></script>
    @endpush
</x-app-layout>

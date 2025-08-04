<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-10">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"> {{ __($title) }} </h4>
                        <div class="flex-shrink-0">
                            <a href="{{ $action_back }}" type="button"
                                class="btn btn-primary btn-sm btn-label waves-effect waves-light"><i
                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                {{ __('Back') }} </a>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
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
                                <div class="col-md-6 col-sm-12 mt-3">
                                    <x-input-label for="discount-type-name" :value="__('Discount Type Name')" /><span
                                        class="text-danger">*</span>
                                    <x-text-input type="text" name="discount_type_name" :value="old('discount_type_name', $record->discount_type_name ?? '')"
                                        class="form-control" :error="$errors->has('discount_type_name')"
                                        placeholder="Enter the product discount type name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('discount_type_name')" />
                                </div>

                                <div class="col-md-6 col-sm-12 mt-3">
                                    <x-input-label for="discount-type-description" :value="__('Discount Type Description')" /><span
                                        class="text-danger">*</span>
                                    <x-text-input type="text" name="discount_type_description" :value="old(
                                        'discount_type_description',
                                        $record->discount_type_description ?? '',
                                    )"
                                        class="form-control" :error="$errors->has('discount_type_description')"
                                        placeholder="Description about product discount type" />
                                    <x-input-error class="mt-2" :messages="$errors->get('discount_type_description')" />
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
    @push('custom-script')
        <script></script>
    @endpush
</x-app-layout>

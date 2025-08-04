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
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="permission-name" :value="__('Permission Name')" /><span
                                            class="text-danger">*</span>
                                        <x-text-input type="text" name="name" :value="old('name', $record->name ?? '')"
                                            class="form-control" :error="$errors->has('name')"
                                            placeholder="Enter permission name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="guard-name" :value="__('Guard Name')" /><span
                                            class="text-danger">*</span>
                                        <x-text-input type="text" name="guard_name" :value="old('guard_name', $record->guard_name ?? '')"
                                            class="form-control" :error="$errors->has('guard_name')" placeholder="web" />
                                        <x-input-error class="mt-2" :messages="$errors->get('guard_name')" />
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
    @push('custom-script')
        <script></script>
    @endpush
</x-app-layout>

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
                                        <x-input-label for="menu-name" :value="__('Menu Name')" /><span
                                            class="text-danger">*</span>
                                        <x-text-input type="text" name="name" :value="old('name', $record->name ?? '')"
                                            class="form-control" :error="$errors->has('name')" placeholder="Enter menu name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="url-menu" :value="__('URL Menu')" /><span
                                            class="text-danger">*</span>
                                        <x-text-input type="text" name="url" :value="old('url', $record->url ?? '')"
                                            class="form-control" :error="$errors->has('url')" placeholder="configurations/menu" />
                                        <x-input-error class="mt-2" :messages="$errors->get('url')" />
                                    </div>
                                </div>


                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="category-menu" :value="__('Category Menu')" /><span
                                            class="text-danger">*</span>
                                        <x-text-input type="text" name="category" :value="old('category', $record->category ?? '')"
                                            class="form-control" :error="$errors->has('category')"
                                            placeholder="Enter the menu category" />
                                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <x-input-label for="squence-name" :value="__('Sequence Menu')" /><span
                                            class="text-danger">*</span>
                                        <x-text-input type="number" name="orders" :value="old('orders', $record->orders ?? '')"
                                            class="form-control" :error="$errors->has('orders')"
                                            placeholder="Enter the menu sequence" />
                                        <x-input-error class="mt-2" :messages="$errors->get('orders')" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="mb-3">
                                        <div class="d-flex">
                                            <x-input-label for="icon-menu" class="flex-grow-1" :value="__('Menu Icon')" />
                                            <div class="flex-shrink-0">
                                                <a class="link-info" target="_blank"
                                                    href="{{ route('configurations.menu.icon') }}"><small>{{ __('See all icons') }}</small></a>
                                            </div>
                                        </div>
                                        <x-text-input type="text" name="icon" :value="old('icon', $record->icon ?? '')"
                                            class="form-control" :error="$errors->has('icon')" placeholder="ri-bar-chart-fill" />
                                        <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <x-input-label class="mb-3" for="permission" :value="__('Permission')" /><span
                                        class="text-danger">*</span>
                                    <div class="d-flex flex-wrap mb-3">
                                        @foreach (['create', 'read', 'update', 'delete', 'sort', 'move'] as $item)
                                            @php
                                                $isChecked = in_array($item, old('permissions', $permissions));
                                            @endphp
                                            <div class="form-check me-2">
                                                <input class="form-check-input" name="permissions[]"
                                                    value="{{ $item }}" type="checkbox"
                                                    id="formCheck_{{ $item }}"
                                                    @if ($isChecked) checked @endif>
                                                <label class="form-check-label" for="formCheck_{{ $item }}">
                                                    {{ $item }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <x-input-error class="mt-2" :messages="$errors->get('permissions')" />
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <x-input-label class="mb-3" for="level-menu" :value="__('Level Menu')" /><span
                                        class="text-danger">*</span>
                                    <div class="mb-3 d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="level_menu"
                                                value="main_menu" @if (old('level_menu', isset($record) && $record->main_menu_id ? '' : 'main_menu') === 'main_menu') checked @endif>

                                            <label class="form-check-label" for="main-menu">
                                                {{ __('Main Menu') }}
                                            </label>
                                        </div>
                                        <div class="form-check flex-shrink-0">
                                            <input class="form-check-input" type="radio" name="level_menu"
                                                value="sub_menu" @if (old('level_menu', isset($record) && $record->main_menu_id ? 'sub_menu' : '') === 'sub_menu') checked @endif>
                                            <label class="form-check-label" for="sub-menu">
                                                {{ __('Sub Menu') }}
                                            </label>
                                        </div>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('level_menu')" />
                                </div>

                                <div class="col-md-4 col-sm-12 {{ old('level_menu', isset($record) && $record->main_menu_id ? 'sub_menu' : 'main_menu') === 'sub_menu' ? '' : 'd-none' }}"
                                    id="main_menu_wrapper">
                                    <x-input-label for="main-menu" :value="__('Main Menu')" />
                                    <select class="js-example-basic-single" name="main_menu_id">
                                        @foreach ($main_menus as $item)
                                            <option value="{{ $item['id'] }}"
                                                @if (old('main_menu_id', $record->main_menu_id ?? '') == $item['id']) selected @endif>
                                                {{ $item['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
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
        <script>
            $(document).ready(function() {

                // show main menu
                $('[name=level_menu]').on('change', function() {
                    if (this.value == 'sub_menu') {
                        $('#main_menu_wrapper').removeClass('d-none')
                    } else {
                        $('#main_menu_wrapper').addClass('d-none')
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

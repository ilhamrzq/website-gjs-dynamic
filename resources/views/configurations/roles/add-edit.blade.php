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
                                <a class="nav-link {{ session('activeTab', 'roleData') == 'roleData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#roleData" role="tab">
                                    @if (!request()->routeIs('configurations.role.edit') && !request()->routeIs('configurations.role.show'))
                                        {{ __('Role') }}
                                    @endif

                                    @if (request()->routeIs('configurations.role.edit') || request()->routeIs('configurations.role.show'))
                                        {{ __('Edit Role') }}
                                    @endif
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ session('activeTab') == 'roleAccessMenu' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#roleAccessMenu" role="tab"
                                    @if (!request()->routeIs('configurations.role.edit') && !request()->routeIs('configurations.role.show')) style="display: none;" @endif>
                                    {{ __('Access ' . Str::title($record->name ?? '')) }}
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link {{ session('activeTab') == 'roleUsers' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#roleUser" role="tab"
                                    @if (!request()->routeIs('configurations.role.edit') && !request()->routeIs('configurations.role.show')) style="display: none;" @endif>
                                    {{ __('Role ' . Str::title($record->name ?? '')) }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane nav-link {{ session('activeTab', 'roleData') == 'roleData' ? 'active' : '' }}"
                                id="roleData" role="tabpanel">

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
                                                <x-input-label for="role-name" :value="__('Role Name')" /><span
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
                                                <x-text-input readonly type="text" name="guard_name"
                                                    :value="old('guard_name', $record->guard_name ?? 'web')" class="form-control bg-primary-subtle"
                                                    :error="$errors->has('guard_name')" placeholder="web" />
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

                            <div class="tab-pane {{ session('activeTab') == 'roleAccessMenu' ? 'active' : '' }}"
                                id="roleAccessMenu" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <x-input-label for="copy-role" :value="__('Copy Role')" />
                                        <select class="js-example-basic-single copy-role">
                                            <option value="">Choose</option>
                                            @foreach ($list_roles as $role)
                                                <option value="{{ $role['id'] }}"
                                                    @if (old('role', $record->role ?? '') == $role['id']) selected @endif>
                                                    {{ $role['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <x-input-label for="role-name" :value="__('Search Menu')" />
                                        <x-text-input type="search" name="search" class="form-control search"
                                            placeholder="Enter menu name" />
                                    </div>
                                </div>

                                <form action="{{ $action_access_menu }}" method="POST">
                                    @csrf
                                    <!-- table access menu -->
                                    <table class="table nowrap dt-responsive align-middle table-hover mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Menus</th>
                                                <th scope="col">Permissions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="menu_permissions">
                                            @include('configurations.roles.access-menu')
                                        </tbody>
                                    </table>

                                    @if ($action)
                                        <div class="col-lg-12 text-end">
                                            <x-primary-button> {{ __('Saved Access') }} </x-primary-button>
                                        </div>
                                    @endif
                                </form>
                            </div>

                            <div class="tab-pane {{ session('activeTab') == 'roleUsers' ? 'active' : '' }}"
                                id="roleUser" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <x-input-label for="role-user" :value="__('Search User')" />
                                        <x-text-input type="search" name="search-users"
                                            class="form-control search-user" placeholder="Enter user name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <h6 class="text-dark">{{ __('User with role ' . ($record->name ?? '')) }}</h6>

                                    <form action="{{ $action_role_user }}" method="POST">
                                        @csrf

                                        <!-- user role -->
                                        <div class="row" id="user-roles">
                                            <x-text-input type="hidden" class="form-control" name="role"
                                                value="{{ $record->name ?? '' }}" />

                                            @foreach ($users as $user)
                                                <div class="col-sm-12 col-md-4 col-lg-3 mt-2 list-users">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="users[]" id="{{ $user->name . $user->id }}"
                                                            value="{{ $user->id }}"
                                                            @if (is_iterable($user_roles) && $user_roles->contains($user)) checked @endif>
                                                        <label class="form-check-label"
                                                            for="check{{ $user->name . $user->id }}">
                                                            {{ $user->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($action)
                                            <div class="col-lg-12 text-end">
                                                <x-primary-button> {{ __('Save Changes') }} </x-primary-button>
                                            </div>
                                        @endif
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
            $(document).ready(function() {

                // Menu Configurations
                $('.parent').on('click', function() {
                    const childs = $(this).parents('tr').find('.child')
                    childs.prop('checked', this.checked)
                });

                $('.child').on('click', function() {
                    const parent = $(this).parents('tr')
                    const childs = parent.find('.child')
                    const checked = parent.find('.child:checked')

                    parent.find('.parent').prop('checked', childs.length == checked.length)
                });

                $('.parent').each(function() {
                    const parent = $(this).parents('tr')
                    const childs = parent.find('.child')
                    const checked = parent.find('.child:checked')

                    parent.find('.parent').prop('checked', childs.length == checked.length)
                });

                // for search menu
                // Jika nilai indexOf(value) adalah -1, itu berarti teks tidak ditemukan dalam baris tersebut, jadi baris itu akan disembunyikan.
                $('.search').on('keyup', function() {
                    const value = this.value.toLowerCase()
                    $('#menu_permissions tr').show().filter(function(i, item) {
                        return item.innerText.toLowerCase().indexOf(value) == '-1'
                    }).hide()
                });

                // for search user
                $('.search-user').on('keyup', function() {
                    const value = this.value.toLowerCase()
                    $('#user-roles .list-users').show().filter(function(i, item) {
                        return item.innerText.toLowerCase().indexOf(value) == '-1'
                    }).hide()
                });

                // get permission by role for copy permission
                $('.copy-role').on('change', function() {
                    var roleId = $(this).val();
                    $.ajax({
                        url: '{{ url('configurations/role-access-menu') }}/' + roleId + '/role',
                        type: 'GET',
                        success: function(response) {
                            $('#menu_permissions').html(response);

                            // check child checkbox to set parent checkbox
                            $('.child').each(function() {
                                var parentId = $(this).data('parent-id');
                                console.log("parent ID nih : " + parentId);

                                updateParentCheckbox(parentId);
                            });

                            // event listener child checkbox to dynamically update parent checkbox
                            $('.child').on('change', function() {
                                var parentId = $(this).data('parent-id');
                                console.log("parent ID tuh : " + parentId);

                                updateParentCheckbox(parentId);
                            });
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = "Something error";

                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.message) {
                                    errorMessage = response.message;
                                }
                            } catch (e) {
                                console.log("error : ", e);

                            }

                            Swal.fire({
                                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">' +
                                    errorMessage + '</p></div></div>',
                                buttonsStyling: false,
                                showCloseButton: true,
                                customClass: {
                                    confirmButton: "btn btn-primary w-xs mt-2",
                                }
                            });
                        }
                    });

                });

                // function to update parent checkbox based on the state of child checkboxes
                function updateParentCheckbox(parentId) {
                    var allChildChecked = true;
                    $('[data-parent-id="' + parentId + '"]').each(function() {
                        if (!$(this).is(':checked')) {
                            allChildChecked = false
                        }
                    });

                    $('#parent' + parentId).prop('checked', allChildChecked);
                }
            });
        </script>
    @endpush
</x-app-layout>

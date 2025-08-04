@foreach ($menus as $mm)
    <tr>
        <td>{{ $mm->name }}</td>
        <td>
            @foreach ($mm->permissions as $permission)
                <div class="form-check form-switch form-check-inline p-1">
                    <input class="form-check-input" name="permissions[]" 
                        @checked(isset($record) && $record->hasPermissionTo($permission->name)) type="checkbox" 
                        value="{{ $permission->name }}" id="permission-{{ $mm->id.'-'.$permission->id }}">
                    <label class="form-check-label ms-2" for="permission-{{ $mm->id.'-'.$permission->id }}">{{ explode(' ', Str::title($permission->name))[0] }}</label>
                </div>
            @endforeach
        </td>
    </tr>
    @foreach ($mm->subMenus as $sm)
    @php
        $isPermission = ($sm->name === 'Permissions');
        $role = Auth::user()->getRoleNames('superadmin')[0];
    @endphp
    
    {{-- @dump($sm->name, $isPermission, $role) --}}
    <tr>
        <td>
            @if ($isPermission && $role != 'superadmin' ) 
                <div></div>
            @else
                <div class="form-check d-flex flex-column flex-sm-row ms-3 align-items-center">
                    <input type="checkbox" class="form-check-input parent" data-menu-id="{{ $sm->id }}" name="{{ $sm->name }}" id="parent{{ $mm->id.$sm->id }}">
                    <label class="form-check-label ms-md-2 mt-2 mt-md-0" for="formCheck_{{ $sm->name }}">
                        {{ $sm->name }}
                    </label>
                </div>
            @endif
        </td>
        <td>
            @foreach ($sm->permissions as $permission)
                {{-- @dump($permission->name, Str::contains($permission, '/permission')) --}}
                @if (Str::contains($permission, '/permission') && $role != 'superadmin')
                    <div></div>
                @else
                    <div class="form-check form-switch form-check-inline p-1" dir="ltr">
                        <input type="checkbox" class="form-check-input child" data-parent-id="{{ $mm->id.$sm->id }}" name="permissions[]" 
                                @checked($record ? $record->hasPermissionTo($permission->name) : false) 
                                value="{{ $permission->name }}" id="permission-{{ $sm->id.'-'.$permission->id }}">
                        <label class="form-check-label ms-2" for="permission-{{ $sm->id.'-'.$permission->id }}">{{ explode(' ',  Str::title($permission->name))[0] }}</label>
                    </div>
                @endif
            @endforeach
        </td>
    </tr>
    @endforeach
@endforeach
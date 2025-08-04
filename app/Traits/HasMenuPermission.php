<?php

namespace App\Traits;

use App\Models\Configuration\Menu;
use App\Models\Configuration\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasMenuPermission
{
    private function attachMenuPermission(Menu $menu, ?array $permissions, ?array $roles)
    {
        /**
         * @var Permission $permissions
         */
        
        if (is_null($permissions)) {
            $permissions = ['create', 'read', 'update', 'delete'];
        };

        foreach ($permissions as $item) {
            $permission = Permission::updateOrCreate([
                'name' => $item . " {$menu->url}",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 0,
                'updated_by' => 0
            ]);

            $permission->menus()->attach($menu->id, [
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 0,
                'updated_by' => 0
            ]);
            
            if ($roles) {
                $permission->assignRole($roles);
            }
        }
    }
}
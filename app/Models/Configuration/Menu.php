<?php

namespace App\Models\Configuration;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'main_menu_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_permission', 'menu_id', 'permission_id');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function getMainMenuWithPersmissions()
    {
        return Menu::with('permisisons', 'subMenus.permissions')->whereNull('main_menu_id')->get();
    }

    public static function getMainMenus()
    {
        return Menu::whereNull('main_menu_id')->select('id', 'name')->get();
    }

    public static function getMenus()
    {
        $data = Menu::active()->with(['subMenus' => function ($query) {
            $query->orderBy('orders');
        }])->whereNull('main_menu_id')
            ->orderBy('orders')->get();
        
        return $data;
    }

}

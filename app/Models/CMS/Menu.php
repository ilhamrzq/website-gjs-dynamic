<?php

namespace App\Models\CMS;

use App\Models\Master\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_menus';

    protected $fillable = [
        'id',
        'lang_id',
        'category',
        'menu_name',
        'menu_path',
        'is_menu',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'is_active'
    ];

    // Local Scope untuk mengambil data yang hanya aktif
    public function scopeActive($query)
    {
        return $query->where('cms_menus.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}

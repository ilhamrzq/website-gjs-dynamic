<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomepageHeroImage extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'cms_homepage_hero_image';

    protected $fillable = [
        'id',
        'cms_homepage_id',
        'file_path',
        'file_name',
        'file_size',
        'is_default',
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
        return $query->where('cms_homepage_hero_image.is_active', 1);
    }

    public static function getActiveImagesByHomepage($cms_homepage_id)
    {
        return self::select(
            'cms_homepage_hero_images.id AS id',
            'cms_homepage_hero_images.file_path AS building_image_path',
            'cms_homepage_hero_images.is_default AS is_default'
        )
            ->active() // Menggunakan scope untuk memfilter data yang is_active = 1
            ->where('cms_homepage_id', '=', $cms_homepage_id) // Filter berdasarkan cms_homepage_id
            ->orderBy('cms_homepage_hero_images.id', 'asc') // Urutkan berdasarkan ID
            ->get();
    }

    public static function imagesByHomepage($homepageId)
    {
        return self::with('user')->where('cms_homepage_id', $homepageId)->orderBy('id')->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function homepage()
    {
        return $this->belongsTo(Homepage::class, 'cms_homepage_id');
    }
}

<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'cms_galleries_images';

    protected $fillable = [
        'id',
        'category_id',
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
        return $query->where('cms_galleries_images.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    public static function imagesByCategory($categoryId)
    {
        return self::with('user')->where('category_id', $categoryId)->orderBy('id')->get();
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }
}

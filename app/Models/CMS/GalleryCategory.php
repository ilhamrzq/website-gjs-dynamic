<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryCategory extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_gallery_categories';

    protected $fillable = [
        'id',
        'category_name_id',
        'category_name_en',
        'category_slug_id',
        'category_slug_en',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('cms_gallery_categories.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function gallery()
    {
        return $this->hasMany(GalleryImage::class, 'category_id');
    }

    public function previewImage()
    {
        return $this->hasOne(GalleryImage::class, 'category_id')
            ->select('file_path')
            ->active()
            ->latest();
    }
}

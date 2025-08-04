<?php

namespace App\Models\CMS;

use App\Models\Master\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Homepage extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_homepage';

    protected $fillable = [
        'id',
        'lang_id',
        'hero_title',
        'hero_description',
        'feature_left_title',
        'feature_left_description',
        'feature_center_title',
        'feature_center_description',
        'feature_right_title',
        'feature_right_description',
        'video_path',
        'video_name',
        'video_size',
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
        return $query->where('cms_homepage.is_active', 1);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function homepageHeroImages()
    {
        return $this->hasMany(HomepageHeroImage::class, 'cms_homepage_id');
    }

    public function selectedImage()
    {
        return $this->hasOne(HomepageHeroImage::class, 'cms_homepage_id')
                    ->orderByDesc('is_default') 
                    ->active()
                    ->latest();
    }

    public function getThumbnailImage(): ?HomepageHeroImage
    {
        // 1) Default image
        $defaultImage = $this->homepageHeroImages()
            ->active()
            ->where('is_default', 1)
            ->select('id', 'file_path')
            ->first();

        // 2) Selected preview (if eager loaded)
        if (!$defaultImage && $this->relationLoaded('selectedImage')) {
            $defaultImage = $this->selectedImage;
        }

        // 3) First active fallback
        if (!$defaultImage) {
            $defaultImage = $this->homepageHeroImages()
                ->active()
                ->orderBy('id')
                ->select('id', 'file_path')
                ->first();
        }

        return $defaultImage;
    }
}

<?php

namespace App\Models\CMS;

use App\Models\Master\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_videos';

    protected $fillable = [
        'id',
        'video_title_id',
        'video_title_en',
        'file_path',
        'file_name',
        'file_size',
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
        return $query->where('cms_videos.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

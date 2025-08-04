<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_social_media';

    protected $fillable = [
        'id',
        'socmed_name',
        'socmed_icon',
        'socmed_url',
        'socmed_username',
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
        return $query->where('cms_social_media.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

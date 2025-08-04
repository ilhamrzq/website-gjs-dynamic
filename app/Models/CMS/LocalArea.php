<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalArea extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_local_areas';

    protected $fillable = [
        'id',
        'place_name',
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
        return $query->where('cms_local_areas.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

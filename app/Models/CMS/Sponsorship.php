<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsorship extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_sponsorships';

    protected $fillable = [
        'id',
        'sponsor_type_name',
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
        return $query->where('cms_sponsorships.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function sponsorshipImages()
    {
        return $this->hasMany(SponsorshipImage::class, 'sponsor_id');
    }
}

<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SponsorshipImage extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_sponsorships_images';

    protected $fillable = [
        'id',
        'sponsor_id',
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
        return $query->where('cms_sponsorships_images.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class, 'sponsor_id');
    }

    public static function imagesBySponsorship($sponsorshipId)
    {
        return self::with('user')->where('sponsor_id', $sponsorshipId)->orderBy('id')->get();
    }
}

<?php

namespace App\Models\Venue;

use App\Models\Master\Venue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueImage extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'venues_images';

    protected $fillable = [
        'id',
        'venue_id',
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
        return $query->where('venues_images.is_active', 1);
    }

    public static function imagesByVenue($venueId)
    {
        return self::with('user')->where('venue_id', $venueId)->orderBy('id')->get();
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

<?php

namespace App\Models\Master;

use App\Models\User;
use App\Models\Venue\VenueImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_venues';

    protected $fillable = [
        'id',
        'venue_name',
        'venue_address',
        'venue_price',
        'venue_url',
        'venue_slug',
        'venue_opening_time',
        'venue_closing_time',
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
        return $query->where('master_venues.is_active', 1)->get();
    }

    public function venueImages()
    {
        return $this->hasMany(VenueImage::class, 'venue_id')->orderBy('id', 'asc');
    }

    public function venueRooms()
    {
        return $this->hasMany(VenueRoom::class, 'venue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function selectedImage()
    {
        return $this->hasOne(VenueImage::class, 'venue_id')
                    ->orderByDesc('is_default') 
                    ->orderBy('id');
    }
}

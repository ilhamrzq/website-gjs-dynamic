<?php

namespace App\Models\Master;

use App\Models\User;
use App\Models\Venue\VenueImage;
use App\Models\Venue\VenueRoomImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueRoom extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_venue_rooms';

    protected $fillable = [
        'id',
        'venue_id',
        'lang_id',
        'room_name',
        'room_description',
        'room_minimum_charge',
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
        return $query->where('master_venue_rooms.is_active', 1)->get();
    }

    

    public function venueRoomImages()
    {
        return $this->hasMany(VenueRoomImage::class, 'room_id');
    }

    // public function getSelectedImageAttribute()
    // {
    //     $default = $this->venueRoomImages->where('is_default', 1)->first();
    //     return $default ?? $this->venueRoomImages->first();
    // }

    public function selectedImage()
    {
        return $this->hasOne(VenueRoomImage::class, 'room_id')
                    ->orderByDesc('is_default') 
                    ->orderBy('id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}

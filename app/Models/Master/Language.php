<?php

namespace App\Models\Master;

use App\Models\CMS\BookingPolicy;
use App\Models\CMS\GalleryCategory;
use App\Models\CMS\Homepage;
use App\Models\CMS\Menu;
use App\Models\CMS\PriceList;
use App\Models\CMS\Video;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_languages';

    protected $fillable = [
        'id',
        'language_name',
        'language_code',
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
        return $query->where('master_languages.is_active', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'lang_id');
    }

    public function galleryCategory()
    {
        return $this->hasMany(GalleryCategory::class, 'lang_id');
    }

    public function video()
    {
        return $this->hasMany(Video::class, 'lang_id');
    }

    public function homepage()
    {
        return $this->hasMany(Homepage::class, 'lang_id');
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'lang_id');
    }

    public function bookingPolicy()
    {
        return $this->hasMany(BookingPolicy::class, 'lang_id');
    }

    public function venueRoom()
    {
        return $this->hasMany(VenueRoom::class, 'lang_id');
    }
    
}

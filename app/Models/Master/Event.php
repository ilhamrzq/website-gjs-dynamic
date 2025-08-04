<?php

namespace App\Models\Master;

use App\Models\Event\EventImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_events';

    protected $fillable = [
        'id',
        'venue_id',
        'lang_id',
        'event_title',
        'event_slug',
        'event_description',
        'event_content',
        'event_start_date',
        'event_end_date',
        'event_status',
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
        return $query->where('master_events.is_active', 1)->get();
    }

    public function eventImages()
    {
        return $this->hasMany(EventImage::class, 'event_id');
    }

    public function selectedImage()
    {
        return $this->hasOne(EventImage::class, 'event_id')
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

    public function getRouteKeyName()
    {
        return 'event_slug';
    }
}

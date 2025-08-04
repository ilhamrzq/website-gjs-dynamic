<?php

namespace App\Models\Event;

use App\Models\Master\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventImage extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'events_images';

    protected $fillable = [
        'id',
        'event_id',
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
        return $query->where('events_images.is_active', 1);
    }

    public static function imagesByEvent($eventId)
    {
        return self::with('user')->where('event_id', $eventId)->orderBy('id')->get();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

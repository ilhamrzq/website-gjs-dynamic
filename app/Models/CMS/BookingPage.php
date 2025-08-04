<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingPage extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_booking_page';

    protected $fillable = [
        'id',
        'page_name',
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
        return $query->where('cms_booking_page.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function images()
    {
        return $this->hasMany(BookingPageImage::class, 'booking_page_id');
    }
}

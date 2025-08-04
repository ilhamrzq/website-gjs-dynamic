<?php

namespace App\Models\CMS;

use App\Models\Master\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceList extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_price_lists';

    protected $fillable = [
        'id',
        'price_name',
        'price_normal',
        'price_promo',
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
        return $query->where('cms_price_lists.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

<?php

namespace App\Models\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_memberships';

    protected $fillable = [
        'id',
        'membership_name',
        'membership_price',
        'membership_description',
        'membership_color',
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
        return $query->where('master_memberships.is_active', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

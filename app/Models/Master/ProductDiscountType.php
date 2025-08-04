<?php

namespace App\Models\Master;

use App\Models\Relation\RelProductDiscount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDiscountType extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_product_discount_types';

    protected $fillable = [
        'id',
        'discount_type_name',
        'discount_type_description',
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
        return $query->where('master_product_discount_types.is_active', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function relProduct()
    {
        return $this->hasMany(RelProductDiscount::class, 'discount_type_id');
    }
}

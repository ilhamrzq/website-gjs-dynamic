<?php

namespace App\Models\Relation;

use App\Models\Master\Product;
use App\Models\Master\ProductPriceType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelProductPrice extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'rel_product_prices';

    protected $fillable = [
        'id',
        'product_id',
        'price_type_id',
        'price',
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
        return $query->where('rel_product_prices.is_active', 1)->get();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function priceType()
    {
        return $this->belongsTo(ProductPriceType::class, 'price_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

<?php

namespace App\Models\Master;

use App\Models\Cart;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use App\Models\Relation\RelProductDiscount;
use App\Models\Relation\RelProductPrice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_products';

    protected $fillable = [
        'id',
        'product_name',
        'product_category_id',
        'product_description',
        'product_stock',
        'product_slug',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'is_active'
    ];
    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    public function productItemImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function relCart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function relPrice()
    {
        return $this->hasMany(RelProductPrice::class, 'product_id');
    }

    public function relDiscount()
    {
        return $this->hasMany(RelProductDiscount::class, 'product_id');
    }
}

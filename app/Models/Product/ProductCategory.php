<?php

namespace App\Models\Product;

use App\Models\User;
use App\Models\Master\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'products_categories';

    protected $fillable = [
        'id',
        'product_category_name',
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
        return $query->where('products_categories.is_active', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function items()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}

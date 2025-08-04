<?php

namespace App\Models\Product;

use App\Models\Master\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products_images';
    protected $fillable = [
        'id',
        'product_id',
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
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function ImagesByProduct($productId)
    {
        return self::with('user')->where('product_id', $productId)->orderBy('id')->get();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}


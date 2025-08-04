<?php

namespace App\Models\Relation;

use App\Models\Master\BilliardTableCategory;
use App\Models\Master\TablePriceType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelTablePrice extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'rel_table_prices';

    protected $fillable = [
        'id',
        'table_category_id',
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
        return $query->where('rel_table_prices.is_active', 1)->get();
    }

    public function tableCategory()
    {
        return $this->belongsTo(BilliardTableCategory::class, 'table_category_id');
    }

    public function priceType()
    {
        return $this->belongsTo(TablePriceType::class, 'price_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

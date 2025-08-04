<?php

namespace App\Models\Master;

use App\Models\Relation\RelTablePrice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TablePriceType extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_table_price_types';

    protected $fillable = [
        'id',
        'price_type_name',
        'price_type_description',
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
        return $query->where('master_table_price_types.is_active', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function relTable()
    {
        return $this->hasMany(RelTablePrice::class, 'price_type_id');
    }
}

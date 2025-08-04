<?php

namespace App\Models\Master;

use App\Models\Relation\RelTableDiscount;
use App\Models\Relation\RelTablePrice;
use App\Models\Table\BilliardTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BilliardTableCategory extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'master_billiard_table_categories';

    protected $fillable = [
        'id',
        'venue_id',
        'table_category_name',
        'table_category_description',
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
        return $query->where('master_billiard_table_categories.is_active', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function table()
    {
        return $this->hasMany(BilliardTable::class, 'table_category_id');
    }

    public function relPrice()
    {
        return $this->hasMany(RelTablePrice::class, 'table_category_id');
    }
    public function relDiscount()
    {
        return $this->hasMany(RelTableDiscount::class, 'table_category_id');
    }
}

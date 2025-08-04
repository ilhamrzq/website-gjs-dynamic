<?php

namespace App\Models\Table;

use App\Models\Master\BilliardTableCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BilliardTable extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'billiard_tables';

    protected $fillable = [
        'id',
        'table_category_id',
        'table_name',
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
        return $query->where('billiard_tables.is_active', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function category()
    {
        return $this->belongsTo(BilliardTableCategory::class, 'table_category_id');
    }
}

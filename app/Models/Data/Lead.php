<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'data_leads';

    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'company',
        'building_id',
        'product_id',
        'number_of_people',
        'subject',
        'message',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'is_active'
    ];

    // Local Scope untuk mengambil data yang hanya aktif
    public function scopeActiveDataLead($query)
    {
        return $query->where('data_leads.is_active', 1);
    }
}

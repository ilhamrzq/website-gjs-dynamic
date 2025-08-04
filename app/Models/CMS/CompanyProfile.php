<?php

namespace App\Models\CMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfile extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cms_company_profile';

    protected $fillable = [
        'id',
        'company_email',
        'company_address',
        'company_iframe_maps_url',
        'company_phone_number',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'is_active'
    ];

    // Local Scope untuk mengambil data yang hanya aktif
    public function scopeActive($query)
    {
        return $query->where('cms_company_profile.is_active', 1);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

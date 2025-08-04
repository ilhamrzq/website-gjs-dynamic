<?php

namespace App\Models\oauth;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OauthClient extends Model
{
    protected $keyType = 'string'; // Pastikan ini string
    public $incrementing = false; // Karena UUID bukan auto-increment
    protected $primaryKey = 'id'; // Pastikan key ini sesuai
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'secret',
        'provider',
        'redirect',
        'person_access_client',
        'password_client',
        'revoked',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

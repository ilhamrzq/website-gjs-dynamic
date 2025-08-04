<?php

namespace App\Models\oauth;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'name',
        'scopes',
        'revoked',
        'created_at',
        'updated_at',
        'expires_at'
    ];
}

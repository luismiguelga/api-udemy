<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    protected $fillable = [
        'owner_type',
        'owner_id',
        'name',
        'secret',
        'provider',
        'redirect_uris',
        'grant_types',
        'revoked',
    ];

    protected $casts = [
        'redirect_uris' => 'array',
        'grant_types' => 'array',
    ];

}

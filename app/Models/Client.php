<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
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
        'grant_type',
        'revoked'
    ];
}


<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(now()->addMinutes(60));
        Passport::refreshTokensExpireIn(now()->addDays(2));
        Passport::personalAccessTokensExpireIn(now()->addYears(100));

        Passport::authorizationView('auth.authorize');

        Passport::tokensCan([
            'create-post' => 'Crear un nuevo post',
            'read-post' => 'Leer un post',
            'update-post' => 'Actualizar un post',
            'delete-post' => 'Eliminar un post'
        ]);

        Passport::defaultScopes([
            'read-post'
        ]);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes();
    }

    protected function routes(): void
    {
        // Rutas web generales
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Rutas de autenticación
        Route::middleware('api')
            ->group(base_path('routes/auth.php'));

        // Rutas API
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

    }
}

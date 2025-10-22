<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

$basePath = fn ($path) => base_path("routes/api-v1/{$path}.php");

Route::name('category.')->group($basePath('category-routes'));

Route::name('post.')->group($basePath('post-routes'));

Route::name('user.')->prefix('user')->group($basePath('user-routes'));

Route::post('/login', [LoginController::class, 'store']);

ROute::middleware('api')->prefix('oauth')->group(function () {
    Route::get('/clients', [ClientController::class, 'indexTesting']);
    Route::post('/clients', [ClientController::class, 'store']);
});

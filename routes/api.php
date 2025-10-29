<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;

$basePath = fn ($path) => base_path("routes/api-v1/{$path}.php");

Route::name('category.')->group($basePath('category-routes'));

Route::post('/login', [LoginController::class, 'store']);

Route::middleware(['auth:api'])->group(function () {

    $basePath = fn ($path) => base_path("routes/api-v1/{$path}.php");

    Route::name('user.')->prefix('user')->group($basePath('user-routes'));

    Route::name('post.')->prefix('posts')->group($basePath('post-routes'));
});

<?php

use Illuminate\Support\Facades\Route;

$basePath = fn ($path) => base_path("routes/api-v1/{$path}.php");

Route::name('category.')->group($basePath('category-routes'));

Route::name('post.')->group($basePath('post-routes'));

Route::name('user.')->prefix('user')->group($basePath('user-routes'));

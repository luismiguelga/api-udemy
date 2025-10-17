<?php

use Illuminate\Support\Facades\Route;

$basePath = fn ($path) => base_path("routes/api-v1/{$path}.php");

Route::name('category.')->group($basePath('category-routes'));

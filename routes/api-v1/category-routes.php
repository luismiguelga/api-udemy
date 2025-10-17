<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [CategoryController::class, 'index']);

Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');

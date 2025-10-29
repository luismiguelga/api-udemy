<?php

use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Route::apiResource('posts', PostController::class)->middleware('auth:api')->names('api.v1.posts');

Route::get('posts', [PostController::class, 'index'])->middleware(['auth:api','abilities:read-post']);
Route::get('posts/{post}', [PostController::class, 'show'])->middleware(['auth:api','abilities:read-post']);
Route::post('posts', [PostController::class, 'store'])->middleware(['auth:api','abilities:create-post', 'can:create,'.Post::class]);
Route::put('posts/{post}', [PostController::class, 'update'])->middleware(['auth:api','abilities:update-post', 'can:update,post']);
Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware(['auth:api','abilities:delete-post', 'can:delete,post']);



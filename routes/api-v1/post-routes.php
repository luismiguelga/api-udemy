<?php

use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->middleware(['abilities:read-post']);
Route::get('/{post}', [PostController::class, 'show'])->middleware(['abilities:read-post']);
Route::post('/', [PostController::class, 'store'])->middleware(['abilities:create-post', 'can:create,'.Post::class]);
Route::put('/{post}', [PostController::class, 'update'])->middleware(['abilities:update-post', 'can:update,post']);
Route::delete('/{post}', [PostController::class, 'destroy'])->middleware(['abilities:delete-post', 'can:delete,post']);



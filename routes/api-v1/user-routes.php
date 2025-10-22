<?php

use App\Http\Controllers\Api\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/', [UserController::class, 'store'])->name('api.v1.register');

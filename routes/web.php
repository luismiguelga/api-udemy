<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::get('clients', [ClientController::class, 'index'])->name('clients.index');

Route::middleware('auth')->prefix('oauth')->group(function () {
    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::delete('/clients/{client}', [ClientController::class, 'destroy']);
    Route::get('/clients/{client}', [ClientController::class, 'edit']);
    Route::get('/clients/show/{client}', [ClientController::class, 'show']);
    Route::put('/clients/{client}', [ClientController::class, 'update']);
});

Route::get('api/tokens', [TokenController::class, 'index'])->name('tokens.index');

Route::middleware('auth')->prefix('tokens')->group(function () {
    Route::get('/access-tokens', [TokenController::class, 'index']);
    Route::post('/access-tokens', [TokenController::class, 'store']);
    Route::get('/access-tokens/scopes', [TokenController::class, 'getScopes']);
    Route::delete('/access-tokens/{token}', [TokenController::class, 'destroy']);
    Route::get('/access-tokens/{token}', [TokenController::class, 'show']);
});

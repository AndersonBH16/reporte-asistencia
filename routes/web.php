<?php

use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/asistencia', [PersonaController::class, 'index'])->name('asistencia');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
});

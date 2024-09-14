<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
 


// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

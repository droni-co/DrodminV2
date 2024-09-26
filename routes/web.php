<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SiteAdmin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SitePostController;
use App\Http\Controllers\SiteAttachmentController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('home');
});

// Admin sites
Route::middleware(SiteAdmin::class)->group(function () {
  Route::resource('sites.posts', SitePostController::class);
  Route::resource('sites.attachments', SiteAttachmentController::class)->only(['index', 'store', 'destroy']);
});

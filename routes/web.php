<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SiteAdmin;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SitePostController;
use App\Http\Controllers\SiteAttachmentController;
use App\Http\Controllers\SiteAttrController;
use App\Http\Controllers\SiteCategoryController;
use App\Http\Controllers\SiteCommentController;
use App\Http\Controllers\SiteTopicController;
use App\Http\Controllers\SiteEnrollmentController;
use App\Http\Controllers\SiteLeadController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [SiteController::class, 'index'])->name('home');
});

// Admin sites
Route::middleware(SiteAdmin::class)->group(function () {
  Route::get('/sites/{site}/search', [SiteController::class, 'search'])->name('sites.search');
  Route::resource('sites', SiteController::class)->only(['show', 'edit', 'update']);
  Route::resource('sites.posts', SitePostController::class);
  Route::apiResource('sites.attrs', SiteAttrController::class)->only(['index', 'store', 'update', 'destroy']);
  Route::resource('sites.attachments', SiteAttachmentController::class)->only(['index', 'store', 'destroy']);
  Route::resource('sites.categories', SiteCategoryController::class);
  Route::resource('sites.comments', SiteCommentController::class)->only(['index', 'update', 'destroy']);
  Route::resource('sites.topics', SiteTopicController::class)->only(['index', 'edit', 'update', 'destroy']);
  Route::resource('sites.enrollments', SiteEnrollmentController::class)->only(['index', 'store']);
  Route::resource('sites.leads', SiteLeadController::class)->only(['index', 'edit', 'update', 'destroy']);
});

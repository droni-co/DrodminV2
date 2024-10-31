<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\SitePostController;
use App\Http\Controllers\Api\SitePostCommentController;
use App\Http\Controllers\Api\SiteTopicController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('sites', SiteController::class)->only(['index', 'show']);
Route::apiResource('sites.posts', SitePostController::class)->only(['index', 'show']);
Route::apiResource('sites.posts.comments', SitePostCommentController::class)->only(['index']);
Route::apiResource('sites.topics', SiteTopicController::class)->only(['index', 'show']);

route::middleware('auth:sanctum')->group(function() {
  Route::get('/me', [AuthController::class, 'me']);
  Route::apiResource('sites.posts.comments', SitePostCommentController::class)->only(['store', 'destroy']);
  Route::apiResource('sites.topics', SiteTopicController::class)->only(['store', 'update', 'destroy']);
});

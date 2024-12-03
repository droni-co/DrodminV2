<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\ForceJsonRespons;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\SitePostController;
use App\Http\Controllers\Api\SitePostCommentController;
use App\Http\Controllers\Api\SiteTopicController;
use App\Http\Controllers\Api\SiteTopicCommentController;
use App\Http\Controllers\Api\SiteLeadController;

route::middleware(ForceJsonRespons::class)->group(function() {
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

  Route::apiResource('sites', SiteController::class)->only(['index', 'show']);
  Route::apiResource('sites.posts', SitePostController::class)->only(['index', 'show']);
  Route::apiResource('sites.posts.comments', SitePostCommentController::class)->only(['index']);
  Route::apiResource('sites.topics', SiteTopicController::class)->only(['index', 'show']);
  Route::apiResource('sites.topics.comments', SiteTopicCommentController::class)->only(['index']);
  Route::apiResource('sites.leads', SiteLeadController::class)->only(['store']);

  route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('sites.posts.comments', SitePostCommentController::class)->only(['store', 'destroy']);
    Route::apiResource('sites.topics', SiteTopicController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('sites.topics.comments', SiteTopicCommentController::class)->only(['store', 'update', 'destroy']);
  });
});

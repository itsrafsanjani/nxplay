<?php

use App\Http\Controllers\API\CommandController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\CommentLikeController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\VideoLikeController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset', [AuthController::class, 'passwordReset']);

    Route::get('refresh', [AuthController::class, 'refresh']);

    Route::post('google', [AuthController::class, 'google']);
    Route::post('github', [AuthController::class, 'github']);
    Route::post('facebook', [AuthController::class, 'facebook']);

    Route::apiResource('home', HomeController::class, ['as' => 'api.v1'])
        ->only('index');

    /**
     * Clear cache, route, config, view from command using any Rest API client
     * You have to send username and password for security reason.
     */
    Route::get('command/clear-cache', [CommandController::class, 'clearCache']);
    Route::get('command/refresh-seed', [CommandController::class, 'refreshSeed']);

    Route::group(['middleware' => 'jwt'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::patch('users/{user}', [AuthController::class, 'update']);
        Route::apiResource('videos', VideoController::class, ['as' => 'api.v1'])
            ->only('index', 'show');
        Route::apiResource('comments', CommentController::class, ['as' => 'api.v1']);
        Route::post('videos/like', [VideoLikeController::class, 'likeOrDislike']);
        Route::apiResource('reviews', ReviewController::class, ['as' => 'api.v1']);
        Route::post('comments/like', [CommentLikeController::class, 'commentLikeOrDislike']);
        Route::get('search', [SearchController::class, 'index']);
        Route::get('notifications', [NotificationController::class, 'index']);
    });
});

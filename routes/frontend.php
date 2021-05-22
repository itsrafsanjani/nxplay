<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\CommentLikeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\VideoController;
use App\Http\Controllers\Frontend\VideoLikeController;

/**
 * HomeController For Viewing
 * Movie/Series List Without Login
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::group(['middleware' => ['auth', 'verified'], 'as' => 'frontend.'], function () {

    Route::resource('/videos', VideoController::class)
        ->only(['index', 'show']);

    Route::resource('/comments', CommentController::class)
        ->only('index', 'store', 'destroy');

    Route::resource('/reviews', ReviewController::class)
        ->only('store', 'destroy');

    Route::resource('/users', UserController::class)
        ->only('show', 'update');

    Route::get('/search', [SearchController::class, 'index'])
        ->name('search.index');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/like-or-dislike', [VideoLikeController::class, 'likeOrDislike'])
        ->name('video_like_or_dislike');

    Route::post('/comment-like-or-dislike', [CommentLikeController::class, 'commentLikeOrDislike'])
        ->name('comment_like_or_dislike');

    Route::resource('/subscriptions', SubscriptionController::class)->only(['index', 'store']);
});


<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * SSLCOMMERZ Start
 */
Route::group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/subscriptions', 'SslCommerzPaymentController@index')->name('subscriptions.index');

    Route::post('/pay', 'SslCommerzPaymentController@store')->name('subscriptions.store');

    Route::post('/success', 'SslCommerzPaymentController@success');

    Route::post('/fail', 'SslCommerzPaymentController@fail');

    Route::post('/cancel', 'SslCommerzPaymentController@cancel');

    Route::post('/ipn', 'SslCommerzPaymentController@ipn');
});

/**
 * SSLCOMMERZ END
 */

/**
 * HomeController For Viewing
 * Movie/Series List Without Login
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * About Us Page
 */
Route::view('/about-us', 'frontend/static-pages/about-us')->name('about_us');

// Login/Signup Routes
Auth::routes(['verify' => true]);

// Google login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [LoginController::class, 'handleGithubCallback']);

Route::group(['middleware' => ['auth', 'verified']], function () {

    /**
     * Frontend Routes
     */
    Route::group(['as' => 'frontend.', 'namespace' => 'App\Http\Controllers\Frontend'], function () {

        Route::get('videos', 'VideoController@index')
            ->name('videos.index');

        Route::get('/videos/{video}', 'VideoController@show')
            ->name('videos.show');

        Route::resource('/comments', 'CommentController')->only('index', 'store', 'destroy');

        Route::resource('/reviews', 'ReviewController')->only('store', 'destroy');

        Route::resource('/users', 'UserController')->only('show', 'update');

        Route::get('/search', 'SearchController@index')->name('search.index');

        Route::get('/notifications', 'NotificationController@index')->name('notifications.index');

        Route::post('/like-or-dislike', 'VideoLikeController@likeOrDislike')
            ->name('video_like_or_dislike');

        Route::post('/comment-like-or-dislike', 'CommentLikeController@commentLikeOrDislike')
            ->name('comment_like_or_dislike');
    });

    /**
     * Backend or Admin Routes
     */
    Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'middleware' => 'role'], function () {

        Route::get('/', 'AdminController@index')
            ->name('admin');

        Route::resource('/videos', 'VideoController');

        Route::resource('/users', 'UserController');

        Route::resource('/comments', 'CommentController');

        Route::resource('/reviews', 'ReviewController');
    });

});



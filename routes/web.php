<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * HomeController For Viewing
 * Movie/Series List Without Login
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login/Signup Routes
Auth::routes();

// Google login
Route::get('login/google', [LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [LoginController::class, 'handleGithubCallback']);

Route::group(['middleware' => 'auth'], function (){

    /**
     * Frontend Routes
     */
    Route::group(['as' => 'frontend.', 'namespace' => 'App\Http\Controllers\Frontend'], function (){

        Route::get('videos', 'VideoController@index')
            ->name('videos.index');

        Route::get('/videos/{video}', 'VideoController@show')
            ->name('videos.show');

        Route::resource('/comments', 'CommentController')->only('index', 'store', 'destroy');

        Route::resource('/reviews', 'ReviewController')->only('store', 'destroy');

        Route::resource('/users', 'UserController')->only('show', 'update');

        Route::get('/search', 'SearchController@index')->name('search.index');

        Route::post('/like-or-dislike', 'VideoLikeController@likeOrDislike')
            ->name('video_like_or_dislike');

        Route::post('/comment-like-or-dislike', 'CommentLikeController@commentLikeOrDislike')
            ->name('comment_like_or_dislike');
    });

    /**
     * Backend or Admin Routes
     */
    Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'middleware' => 'role'], function (){

        Route::get('/', 'AdminController@index')
            ->name('admin');

        Route::resource('/videos', 'VideoController');

        Route::resource('/users', 'UserController');

        Route::resource('/comments', 'CommentController');

        Route::resource('/reviews', 'ReviewController');
    });

});



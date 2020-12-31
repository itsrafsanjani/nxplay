<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    // admin routes
    Route::group(['prefix' => 'admin'], function (){

        Route::get('/', [AdminController::class, 'index'])
            ->name('admin');

        Route::resource('/videos', VideoController::class);

        Route::resource('/users', UserController::class);
    });

});



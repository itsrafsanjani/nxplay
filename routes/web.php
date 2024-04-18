<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/web/frontend.php';
require __DIR__ . '/web/backend.php';

/**
 * About Us Page
 */
Route::view('/about-us', 'frontend/static-pages/about-us')
    ->name('about_us');

// Login/Signup Routes
Auth::routes(['verify' => true]);

// Google login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])
    ->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])
    ->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// GitHub login
Route::get('login/github', [LoginController::class, 'redirectToGithub'])
    ->name('login.github');
Route::get('login/github/callback', [LoginController::class, 'handleGithubCallback']);

/**
 * SSLCOMMERZ
 */
Route::group(['middleware' => ['auth', 'verified']], function () {

//    Route::get('/subscriptions', [SslCommerzPaymentController::class, 'index'])
//        ->name('subscriptions.index');

    Route::post('/pay', [SslCommerzPaymentController::class, 'store'])
        ->name('subscriptions.store');

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);

    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);

    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
});

Route::get('/debug', function () {
    $video = \App\Models\Video::latest('id')->first();

    \App\Jobs\ConvertForStreamingJob::dispatch($video);
});

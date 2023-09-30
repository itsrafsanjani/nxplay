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
    // Replace 'YOUR_API_KEY' with your TMDB API key
    $apiKey = config('services.tmdb.token');

    // Define an array of movie titles
    $movieTitles = [
        'tenet-2020',
        'soul-2020',
        'joker-2019',
        'parasite-2019',
        'the-shawshank-redemption-1994',
        'inception-2010',
        'interstellar-2014',
        'the-dark-knight-2008',
        'forrest-gump-1994',
        'fight-club-1999',
        'shutter-island-2010',
        'saving-private-ryan-1998',
        'jack-reacher-2012',
        'mission-impossible-1996',
        'the-man-from-nowhere-2010',
        'the-yellow-sea-2010'
    ];

    // Initialize an array to store TMDB IDs
    $tmdbIDs = [];

    // Iterate through movie titles and fetch TMDB IDs
    foreach ($movieTitles as $title) {
        $query = urlencode($title);
        $url = "https://api.themoviedb.org/3/search/movie?query=$query";

        $response = Http::withToken($apiKey)->get($url);
        $data = $response->json();

        if (!empty($data['results'])) {
            $movie = $data['results'][0];
            $tmdbIDs[$title] = $movie['id'];
        }
    }

    // Output TMDB IDs
    return ['tmdbIDs' => $tmdbIDs];
});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//

Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix' => 'v1'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset', 'AuthController@passwordReset');

    Route::get('refresh', 'AuthController@refresh');

    Route::post('google', 'AuthController@google');
    Route::post('github', 'AuthController@github');
    Route::post('facebook', 'AuthController@facebook');

    Route::resource('home', 'HomeController')->only('index');

    /**
     * Clear cache, route, config, view from command using any Rest API client
     * You have to send username and password for security reason.
     */
    Route::post('command', 'CommandController@execute');
    Route::post('command/refresh-seed', 'CommandController@refreshSeed');

    Route::group(['middleware' => 'jwt'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@me');
        Route::patch('users/{user}', 'AuthController@update');
        Route::apiResource('videos', 'VideoController', ['as' => 'app'])->only('index', 'show');
        Route::apiResource('comments', 'CommentController', ['as' => 'app']);
        Route::post('videos/like', 'VideoLikeController@likeOrDislike')->name('app.videos.like');
        Route::apiResource('reviews', 'ReviewController', ['as' => 'app']);
    });
});

<?php

Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix' => 'v1'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset', 'AuthController@passwordReset');

    Route::get('refresh', 'AuthController@refresh');

    Route::post('google', 'AuthController@google');
    Route::post('github', 'AuthController@github');
    Route::post('facebook', 'AuthController@facebook');

    Route::apiResource('home', 'HomeController', ['as' => 'api.v1'])
        ->only('index');

    /**
     * Clear cache, route, config, view from command using any Rest API client
     * You have to send username and password for security reason.
     */
    Route::get('command/clear-cache', 'CommandController@clearCache');
    Route::get('command/refresh-seed', 'CommandController@refreshSeed');

    Route::group(['middleware' => 'jwt'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@me');
        Route::patch('users/{user}', 'AuthController@update');
        Route::apiResource('videos', 'VideoController', ['as' => 'api.v1'])
            ->only('index', 'show');
        Route::apiResource('comments', 'CommentController', ['as' => 'api.v1']);
        Route::post('videos/like', 'VideoLikeController@likeOrDislike');
        Route::apiResource('reviews', 'ReviewController', ['as' => 'api.v1']);
        Route::post('comments/like', 'CommentLikeController@commentLikeOrDislike');
        Route::get('search', 'SearchController@index');
        Route::get('notifications', 'NotificationController@index');
    });
});

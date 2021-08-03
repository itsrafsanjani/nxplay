<?php

Route::group(['namespace' => 'App\Http\Controllers\API', 'prefix' => 'v2'], function () {
    Route::group(['namespace' => 'V2'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
    });
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('reset', 'AuthController@passwordReset');
    Route::get('refresh', 'AuthController@refresh');
    Route::post('social', 'AuthController@social');
    Route::apiResource('home', 'HomeController', ['as' => 'api.v2'])->only(['index']);

    /**
     * Clear cache, route, config, view from command using any Rest API client
     * You have to send username and password for security reason.
     */
    Route::get('command/clear-cache', 'CommandController@clearCache');
    Route::get('command/refresh-seed', 'CommandController@refreshSeed');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['namespace' => 'V2'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@me');
        });
        Route::patch('users/{user}', 'AuthController@update');
        Route::apiResource('videos', 'VideoController', ['as' => 'api.v2'])->only(['index', 'show']);
        Route::apiResource('comments', 'CommentController', ['as' => 'api.v2']);
        Route::post('videos/like', 'VideoLikeController@likeOrDislike');
        Route::apiResource('reviews', 'ReviewController', ['as' => 'api.v2']);
        Route::post('comments/like', 'CommentLikeController@commentLikeOrDislike');
        Route::get('search', 'SearchController@index');
        Route::get('notifications', 'NotificationController@index');
    });
});

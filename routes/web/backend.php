<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'role']], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::resource('/videos', VideoController::class);

    Route::resource('/users', UserController::class);

    Route::resource('/comments', CommentController::class);

    Route::resource('/reviews', ReviewController::class);

    Route::post('file-upload/upload-large-files', [VideoController::class, 'uploadLargeFiles'])->name('files.upload.large');
});

<?php

use \App\Http\Controllers\User\LoginController;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UploadController;
Route::get('/index', function () {
    return view('welcome');
});

## Login
Route::get('admin/login', [UserController::class, 'index'])->name('login');
Route::post('admin/submit', [UserController::class, 'validateLogin']);

Route::middleware(['auth'])->group(function (){

    ## Admin
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        ## Movies
        Route::prefix('movies')->group(function(){
            Route::get('all', [MovieController::class, 'showAll'])->name('all');
            Route::get('edit/{movie}', [MovieController::class, 'show']);
            Route::post('edit/{movie}', [MovieController::class, 'update']);
            Route::get('create', [MovieController::class, 'create']);
            Route::delete('destroy', [MovieController::class, 'destroy']);
            Route::post('create', [MovieController::class, 'store'])->name('movies.store');
        });

        ##Upload
        Route::post('upload/service', [UploadController::class, 'store']);
        Route::delete('destroy/service', [UploadController::class, 'destroy']);
    });


});

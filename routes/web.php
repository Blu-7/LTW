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
Route::get('admin/login', [UserController::class, 'index'])->name('login');
Route::post('admin/submit', [UserController::class, 'validateLogin']);

Route::middleware(['auth'])->group(function (){

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        ## Menu
        Route::prefix('movies')->group(function(){
            Route::get('all', [MovieController::class, 'showAll']);
            Route::get('create', [MovieController::class, 'create']);
            Route::post('create', [MovieController::class, 'store'])->name('movies.store');
        });

        ##Upload
        Route::post('upload/service', [UploadController::class, 'store']);
    });


});

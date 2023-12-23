<?php

use \App\Http\Controllers\User\LoginController;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Cinema\CustomerController;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\User\IntroController;

##User login
Route::get('index', function () {
    return view('cinema.welcome', [
        'title' => 'Trang chủ'
    ]);
});
Route::get('signin', [LoginController::class, 'index'])->name('signin');
Route::get('signup', [LoginController::class, 'signup'])->name('signup');
Route::post('signup/submit', [LoginController::class, 'validateSignup']);
Route::post('signin/submit', [LoginController::class, 'validateLogin']);

##User view

Route::get('intro', [IntroController::class, 'intro'])->name('intro');

## Admin Login
Route::get('admin/login', [UserController::class, 'index'])->name('login');
Route::post('admin/submit', [UserController::class, 'validateLogin']);

Route::middleware(['auth'])->group(function (){
    if (1) {

        ## Admin
        Route::prefix('admin')->group(function () {
            Route::get('/', [MainController::class, 'index'])->name('admin');
            Route::get('main', [MainController::class, 'index']);
            Route::get('logout', [UserController::class, 'logout']);
            ## Movies
            Route::prefix('movies')->group(function () {
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
    }
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('welcome');
    });
});

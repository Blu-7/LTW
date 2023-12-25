<?php

use \App\Http\Controllers\User\BookingController;
use \App\Http\Controllers\User\LoginController;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Cinema\CustomerController;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\User\IntroController;
use \App\Http\Controllers\User\FilmController;
use App\Http\Controllers\Cinema\CinemaController;
use App\Http\Middleware\Admin;

##User login
Route::get('index', [CinemaController::class, 'index']);
Route::get('/', [CinemaController::class, 'index']);
//Route::get('index', function (){
//    return view('cinema.slideshow', [
//        'title' => 'Test'
//    ]);
//});
Route::get('signin', [LoginController::class, 'index'])->name('signin');
Route::get('signup', [LoginController::class, 'signup'])->name('signup');
Route::post('signup/submit', [LoginController::class, 'validateSignup']);
Route::post('signin/submit', [LoginController::class, 'validateLogin']);

##User booking - tickets - Payment
Route::get('booking', [BookingController::class, 'booking'])->name('booking');
Route::get('tickets', [BookingController::class, 'tickets'])->name('tickets');
Route::get('done', [BookingController::class, 'done'])->name('done');
Route::get('payment', [BookingController::class, 'payment'])->name('payment');
##User view

Route::get('intro', [IntroController::class, 'intro'])->name('intro');
Route::get('film', [FilmController::class, 'film'])->name('film');
Route::get('contact', [IntroController::class, 'contact'])->name('contact');
## Admin Login
Route::get('admin/login', [UserController::class, 'index'])->name('login');
Route::post('admin/submit', [UserController::class, 'validateLogin']);

Route::middleware(['auth', 'is_admin:1'])->group(function (){
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
});

Route::middleware(['auth', 'is_admin:0'])->group(function (){
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [CinemaController::class, 'index'])->name('welcome');
    });
});

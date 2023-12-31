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
use App\Http\Controllers\Cinema\SliderController;

##User login
Route::get('index', [CinemaController::class, 'index'])->name('index');
Route::get('/', [CinemaController::class, 'index']);
//Route::get('index', function (){
//    return view('cinema.slideshow', [
//        'title' => 'Test'
//    ]);
//});

## Các routing cho việc đăng nhập, đăng ký của user
Route::get('signin', [LoginController::class, 'index'])->name('signin');
Route::get('signup', [LoginController::class, 'signup'])->name('signup');
Route::post('signup/submit', [LoginController::class, 'validateSignup']);
Route::post('signin/submit', [LoginController::class, 'validateLogin']);


##User booking - tickets
//Route::get('booking/{movie}', [BookingController::class, 'booking'])->name('booking');
//##User booking - tickets - Payment
//Route::get('tickets', [BookingController::class, 'tickets'])->name('tickets');
//Route::get('done/', [BookingController::class, 'done'])->name('done');
//Route::get('done/', ['uses' => 'AboutController@done']);
//
//Route::get('done', [BookingController::class, 'done'])->name('done');
//Route::get('payment', [BookingController::class, 'payment'])->name('payment');
##Các view của user về trang booking phim
Route::get('intro', [IntroController::class, 'intro'])->name('intro');
Route::get('movie', [FilmController::class, 'movie'])->name('movie');
## Redirect route
Route::get('movie/detail/{movie}', [FilmController::class, 'detailMovie']);
Route::get('contact', [IntroController::class, 'contact'])->name('contact');
## Admin Login
Route::get('admin/login', [UserController::class, 'index'])->name('login');
Route::post('admin/submit', [UserController::class, 'validateLogin']);
## Routing có kiểm tra quyền admin bằng middleware
Route::middleware(['auth', 'is_admin:1'])->group(function (){
        ## Admin đăng nhập/đăng ký
        Route::prefix('admin')->group(function () {
            Route::get('/', [MainController::class, 'index'])->name('admin');
            Route::get('main', [MainController::class, 'index']);
            Route::get('logout', [UserController::class, 'logout']);
            ## Các routing như list, sửa, thêm xóa phim
            Route::prefix('movies')->group(function () {
                Route::get('all', [MovieController::class, 'showAll'])->name('all');
                ## Redirect route
                Route::get('edit/{movie}', [MovieController::class, 'show']);
                Route::post('edit/{movie}', [MovieController::class, 'update']);
                Route::get('create', [MovieController::class, 'create']);
                Route::delete('destroy', [MovieController::class, 'destroy']);
                Route::post('create', [MovieController::class, 'store'])->name('movies.store');
            });

            ## Các routing như list, sửa, thêm xóa slider
            Route::prefix('sliders')->group(function (){
                Route::get('create', [SliderController::class, 'create']);
                ## Redirect route
                Route::get('edit/{slider}', [SliderController::class, 'show']);
                Route::post('edit/{slider}', [SliderController::class, 'update']);
                Route::delete('destroy', [SliderController::class, 'destroy']);
                Route::get('all', [SliderController::class, 'showAll'])->name('sliders.all');
                Route::post('create/submit', [SliderController::class, 'store'])->name('sliders.store');
            });

            ## Routing để gọi controller upload xử lý hình ảnh
            Route::post('upload/service', [UploadController::class, 'store']);
            Route::delete('destroy/service', [UploadController::class, 'destroy']);
        });
});
## Routing dành cho User ko có quyên admin
Route::middleware(['auth', 'is_admin:0'])->group(function (){
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [CinemaController::class, 'index'])->name('welcome');
    });
    Route::get('signout', [LoginController::class, 'signout'])->name('signout');
    Route::post('booking/submit', [BookingController::class, 'forward']);
    ##User booking - tickets
    Route::get('booking/{movie}', [BookingController::class, 'booking'])->name('booking');
##User booking - tickets - Payment
    Route::get('tickets', [BookingController::class, 'tickets'])->name('tickets');
    Route::get('done/', [BookingController::class, 'done'])->name('done');
    Route::get('done/', ['uses' => 'AboutController@done']);

    Route::get('done', [BookingController::class, 'done'])->name('done');
    Route::get('payment', [BookingController::class, 'payment'])->name('payment');
});

Route::post('booking/submit', [BookingController::class, 'forward']);

<?php

use \App\Http\Controllers\User\LoginController;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\MainController;

Route::get('/index', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function() {
   Route::get('/login', [UserController::class, 'index']);
   Route::post('/submit', [UserController::class, 'validateLogin']);
   Route::get('/main', [MainController::class, 'index'])->name('admin');
});

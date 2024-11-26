<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//private routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', [UsersController::class, 'index'] )->name('users');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

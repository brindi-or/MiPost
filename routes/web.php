<?php

use Illuminate\Support\Facades\Route;

Route::get(' / ', function () {

    return view('app');
})

->name('application');
// Route::resource('posts', \App\Http\Controllers\PostController::class);

// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\RegisterController;

// Route::post('/register', [RegisterController::class, 'register']);
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

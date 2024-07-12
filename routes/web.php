<?php

use Illuminate\Support\Facades\Route;

Route::get(' / ', function () {

    return view('app');
})

->name('application');
Route::resource('api/posts', \App\Http\Controllers\PostController::class);

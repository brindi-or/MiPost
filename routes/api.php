<?php

use Illuminate\Support\Facades\Route;

Route::resource('api/posts', \App\Http\Controllers\PostController::class);

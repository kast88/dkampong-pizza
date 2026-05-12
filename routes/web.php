<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YouTubeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [YouTubeController::class, 'index']);

Route::get('/watch/{id}', function ($id) {
    return view('watch_youtube', compact('id'));
});

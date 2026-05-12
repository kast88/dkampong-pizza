<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\YouTubeController;

Route::get('/', [YouTubeController::class, 'index']);

Route::get('/watch_youtube/{id}', function ($id) {

    $apiKey = env('YOUTUBE_API_KEY');

    $pageToken = request('pageToken');

    $response = Http::get('https://www.googleapis.com/youtube/v3/commentThreads', [
        'part' => 'snippet',
        'videoId' => $id,
        'maxResults' => 10,
        'pageToken' => $pageToken,
        'key' => $apiKey
    ]);

    $data = $response->json();

    $comments = $data['items'] ?? [];

    return view('watch_youtube', [
        'id' => $id,
        'comments' => $comments,
        'nextPageToken' => $data['nextPageToken'] ?? null,
        'prevPageToken' => $data['prevPageToken'] ?? null
    ]);
});

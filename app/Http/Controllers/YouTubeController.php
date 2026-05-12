<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class YouTubeController extends Controller
{
    public function index()
    {
        $apiKey = env('YOUTUBE_API_KEY');

        $search = request('search', 'kampung pizza');

        $pageToken = request('pageToken');

        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'q' => $search,
            'type' => 'video',
            'maxResults' => 12,
            'key' => $apiKey,
            'pageToken' => $pageToken
        ]);

        $data = $response->json();

        $videos = $data['items'] ?? [];

        // STEP 2: extract video IDs
        $videoIds = collect($videos)->pluck('id.videoId')->filter()->implode(',');

        // STEP 3: get details (views, stats, etc.)
        $statsResponse = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'statistics, snippet',
            'id' => $videoIds,
            'key' => $apiKey
        ]);

        $statsData = $statsResponse->json()['items'] ?? [];

        // map stats by video id
        $videoStats = [];
        foreach ($statsData as $item) {
            $videoStats[$item['id']] = $item;
        }

        return view('youtube', [
            'videos' => $videos,
            'videoStats' => $videoStats,
            'search' => $search,
            'platform' => 'YouTube',
            'totalVideos' => $data['pageInfo']['totalResults'] ?? 0,
            'nextPageToken' => $data['nextPageToken'] ?? null,
            'prevPageToken' => $data['prevPageToken'] ?? null
        ]);
    }
}

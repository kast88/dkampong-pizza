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

        // VIDEO IDS
        $videoIds = collect($videos)
            ->map(function($video){
                return $video['id']['videoId'] ?? null;
            })
            ->filter()
            ->values()
            ->implode(',');

        if(empty($videoIds)){

            return view('youtube', [
                'videos' => [],
                'videoStats' => [],
                'search' => $search,
                'platform' => 'YouTube',
                'totalVideos' => 0,
                'nextPageToken' => null,
                'prevPageToken' => null,

                'chartLabels' => [],
                'chartViews' => [],
                'chartLikes' => [],
                'chartComments' => [],
                'chartEngagement' => [],
            ]);
        }

        // VIDEO STATS
        $statsResponse = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'statistics,snippet',
            'id' => $videoIds,
            'key' => $apiKey
        ]);

        $statsData = $statsResponse->json()['items'] ?? [];

        $videoStats = [];

        // CHART DATA
        $chartLabels = [];
        $chartViews = [];
        $chartLikes = [];
        $chartComments = [];
        $chartEngagement = [];

        $videosData = [];

        foreach ($statsData as $item) {

            if (
                !isset($item['statistics']['viewCount']) ||
                !isset($item['statistics']['likeCount']) ||
                !isset($item['statistics']['commentCount'])
            ) {
                continue;
            }

            $videoStats[$item['id']] = $item; // ✅ IMPORTANT FIX

            $views = (int) $item['statistics']['viewCount'];
            $likes = (int) $item['statistics']['likeCount'];
            $comments = (int) $item['statistics']['commentCount'];

            $engagement = $views > 0
                ? round((($likes + $comments) / $views) * 100, 2)
                : 0;

            $videosData[] = [
                'id' => $item['id'],
                'title' => $item['snippet']['title'] ?? 'Video',
                'channel' => $item['snippet']['channelTitle'] ?? '',
                'published' => $item['snippet']['publishedAt'] ?? null,
                'views' => $views,
                'likes' => $likes,
                'comments' => $comments,
                'engagement' => $engagement,
                'trending' => $views >= 100000
            ];
        }

        foreach ($videosData as $video) {

            $chartLabels[] = substr($video['title'], 0, 20) . '...';
            $chartViews[] = $video['views'];
            $chartLikes[] = $video['likes'];
            $chartComments[] = $video['comments'];
            $chartEngagement[] = $video['engagement'];
        }

        $sortedVideos = collect($videosData)
            ->sortByDesc('views')
            ->values()
            ->all();

        return view('youtube', [
            'videos' => $sortedVideos,
            'videoStats' => $videoStats,
            'search' => $search,
            'platform' => 'YouTube',
            'totalVideos' => $data['pageInfo']['totalResults'] ?? 0,
            'nextPageToken' => $data['nextPageToken'] ?? null,
            'prevPageToken' => $data['prevPageToken'] ?? null,

            // CHARTS
            'chartLabels' => $chartLabels,
            'chartViews' => $chartViews,
            'chartLikes' => $chartLikes,
            'chartComments' => $chartComments,
            'chartEngagement' => $chartEngagement,
        ]);
    }


    public function watch($id)
    {
        $apiKey = env('YOUTUBE_API_KEY');

        $pageToken = request('pageToken');

        // Get comments
        $response = Http::get('https://www.googleapis.com/youtube/v3/commentThreads', [
            'part' => 'snippet',
            'videoId' => $id,
            'maxResults' => 100,
            'pageToken' => $pageToken,
            'key' => $apiKey
        ]);

        $data = $response->json();

        $comments = $data['items'] ?? [];

        // Get video details
        $videoResponse = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'snippet,statistics',
            'id' => $id,
            'key' => $apiKey
        ]);

        $videoData = $videoResponse->json()['items'][0] ?? null;

        return view('watch_youtube', [
            'id' => $id,
            'comments' => $comments,
            'video' => $videoData,
            'nextPageToken' => $data['nextPageToken'] ?? null,
            'prevPageToken' => $data['prevPageToken'] ?? null
        ]);
    }
}

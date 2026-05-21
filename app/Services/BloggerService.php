<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BloggerService
{
    protected string $baseUrl = 'https://www.googleapis.com/blogger/v3';

    public function getBlogByUrl(string $url): array
    {
        return Http::get("{$this->baseUrl}/blogs/byurl", [
            'url' => $url,
            'key' => env('BLOGGER_API_KEY'),
        ])->json();
    }

    public function getPostsByBlogId(string $blogId): array
    {
        return Http::get("{$this->baseUrl}/blogs/{$blogId}/posts", [
            'key' => env('BLOGGER_API_KEY'),
        ])->json();
    }
}
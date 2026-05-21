<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BloggerService;

class BloggerController extends Controller
{
    public function index(Request $request, BloggerService $blogger)
    {
        $url = $request->get('url', 'https://draftsfromcoffeetable.blogspot.com//');
        $blog = $blogger->getBlogByUrl($url);

        $blogId = $blog['id'] ?? null;

        if (! $blogId) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        $posts = $blogger->getPostsByBlogId($blogId);
        \Log::debug('BloggerController@index', ['blog' => $blog, 'posts' => $posts]);
        return response()->json([
            'blog' => $blog,
            'posts' => $posts['items'] ?? [],
        ]);
    }
}
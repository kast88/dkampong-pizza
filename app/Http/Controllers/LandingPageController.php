<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    public function index()
    {
        $youtubeVideos = Cache::remember('malaysia_pizza_videos', 60 * 60 * 24, function () {
            return [
                [
                    'id' => 'DuoNazxezkM',
                    'title' => 'BIZ MALAYSIA - PIZZA KAMPUNG MENJADI PERHATIAN [19 OGOS 2016]',
                    'thumbnail' => 'https://img.youtube.com/vi/DuoNazxezkM/hqdefault.jpg',
                    'channel' => 'Berita RTM',
                ],
                [
                    'id' => 'T6O3UqRTRgU',
                    'title' => '9 JUN 2023 – SPM – KISAH RAKYAT MALAYSIA – PIZZA KAMPUNG',
                    'thumbnail' => 'https://img.youtube.com/vi/T6O3UqRTRgU/hqdefault.jpg',
                    'channel' => 'Berita RTM',
                ],
                [
                    'id' => 'v0YB0UB8TNU',
                    'title' => 'Jualan pizza kampung naik dibantu media sosial',
                    'thumbnail' => 'https://img.youtube.com/vi/v0YB0UB8TNU/hqdefault.jpg',
                    'channel' => 'Astro AWANI',
                ],
            ];
        });

        $redditReviews = [
            [
                'user' => 'foodie_my',
                'title' => 'Best kampung-style pizza I’ve ever had in Malaysia',
                'text' => 'The sambal pizza is honestly next level. Didn’t expect it to work but it does 🔥',
                'upvotes' => 120,
                'comments' => 18,
            ],
            [
                'user' => 'jalanjalan99',
                'title' => 'Hidden pizza spot in KL worth trying',
                'text' => 'Small shop but the taste is insane. Very local Malaysian twist on pizza.',
                'upvotes' => 89,
                'comments' => 12,
            ],
            [
                'user' => 'pizzalover88',
                'title' => 'Why is Malaysian pizza so underrated?',
                'text' => 'Crust is crispy, toppings are unique. More people should try this style.',
                'upvotes' => 54,
                'comments' => 7,
            ],
            [
                'user' => 'malaysiaeats',
                'title' => 'Tried “kampung pizza” for the first time today',
                'text' => 'Unexpected combo of sambal + cheese actually works really well.',
                'upvotes' => 101,
                'comments' => 22,
            ],
        ];

        return view('landing', compact('youtubeVideos', 'redditReviews'));
    }
}

<!DOCTYPE html>
<html>
<head>
    <title>D'Kampong Pizza Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            background: #0f172a;
            color: white;
        }

        /* HEADER */
        header {
            padding: 30px;
            text-align: center;
            background: linear-gradient(135deg, #ef4444, #f97316);
        }

        header h1 {
            font-size: 32px;
        }

        /* DASHBOARD CARDS */
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .card-box {
            background: #1e293b;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .card-box h2 {
            font-size: 20px;
            color: #f97316;
        }

        /* INSIGHTS */
        .insights {
            margin: 20px;
            padding: 20px;
            background: #1e293b;
            border-radius: 12px;
        }

        .insights h3 {
            margin-bottom: 10px;
            color: #f97316;
        }

        /* SEARCH */
        .search {
            text-align: center;
            margin: 20px;
        }

        input {
            padding: 12px;
            width: 300px;
            border-radius: 10px 0 0 10px;
            border: none;
        }

        button {
            padding: 12px;
            border: none;
            background: #f97316;
            color: white;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .video-card {
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
        }

        .video-card:hover {
            transform: translateY(-5px);
        }

        .video-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .content {
            padding: 12px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
        }

        .channel {
            font-size: 12px;
            opacity: 0.7;
            margin: 8px 0;
        }

        .btn {
            display: inline-block;
            padding: 8px;
            background: #ef4444;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 12px;
        }
    </style>
</head>

<body>

<header>
    <h1>🍕 D'Kampong Pizza Dashboard</h1>
    <p>Social Media Ecosystem Viewer</p>
</header>

<div class="dashboard">

    <div class="card-box">
        <h2>{{ $totalVideos }}</h2>
        <p>Total Videos</p>
    </div>

    <div class="card-box">
        <h2>{{ $search }}</h2>
        <p>Search Keyword</p>
    </div>

    <div class="card-box">
        <h2>{{ $platform }}</h2>
        <p>Platform</p>
    </div>

</div>

<!-- SEARCH -->
<div class="search">
    <form method="GET">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search pizza videos...">
        <button>Search</button>
    </form>
</div>

<!-- VIDEO GRID -->
<div class="grid">

@foreach ($videos as $video)

    @php
        $title = $video['snippet']['title'];
        $channel = $video['snippet']['channelTitle'];
        $thumb = $video['snippet']['thumbnails']['medium']['url'];
        $videoId = $video['id']['videoId'] ?? '';
    @endphp

    <div class="video-card">
        <img src="{{ $thumb }}">

        <div class="content">
            <div class="title">{{ $title }}</div>
            <div class="channel">🎥 {{ $channel }}</div>

            <a class="btn" target="_blank"
               href="https://www.youtube.com/watch?v={{ $videoId }}">
                Watch
            </a>
        </div>
    </div>

@endforeach

</div>

<div style="text-align:center; margin:30px;">

    @if($prevPageToken)
    <form method="GET" style="display:inline;">
        <input type="hidden" name="search" value="{{ $search }}">
        <input type="hidden" name="pageToken" value="{{ $prevPageToken }}">
        <button style="padding:10px 15px; background:#ef4444; border:none; color:white; border-radius:8px;">
            ← Previous Page
        </button>
    </form>
    @endif

    @if($nextPageToken)
    <form method="GET" style="display:inline;">
        <input type="hidden" name="search" value="{{ $search }}">
        <input type="hidden" name="pageToken" value="{{ $nextPageToken }}">
        <button style="padding:10px 15px; background:#f97316; border:none; color:white; border-radius:8px;">
            Next Page →
        </button>
    </form>
    @endif

</div>

</body>
</html>

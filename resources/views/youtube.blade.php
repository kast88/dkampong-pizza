<!DOCTYPE html>
<html>
<head>
    <title>D'Kampong Pizza Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body{
            background:#0f172a;
            color:white;
        }

        /* HEADER */
        header{
            padding:30px;
            text-align:center;
            background:linear-gradient(135deg,#ef4444,#f97316);
        }

        header h1{
            font-size:32px;
            margin-bottom:8px;
        }

        /* DASHBOARD */
        .dashboard{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
            gap:15px;
            padding:20px;
        }

        .card-box{
            background:#1e293b;
            padding:20px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 10px 20px rgba(0,0,0,0.3);
        }

        .card-box h2{
            color:#f97316;
            margin-bottom:8px;
        }

        /* SEARCH */
        .search{
            text-align:center;
            margin:20px;
        }

        .search form{
            display:inline-flex;
        }

        .search input{
            padding:12px;
            width:300px;
            border:none;
            outline:none;
            border-radius:10px 0 0 10px;
        }

        .search button{
            padding:12px 18px;
            border:none;
            background:#f97316;
            color:white;
            border-radius:0 10px 10px 0;
            cursor:pointer;
        }

        /* FEED */
        .feed{
            max-width:700px;
            margin:auto;
            display:flex;
            flex-direction:column;
            gap:30px;
            padding:20px;
        }

        .video-card{
            background:#1e293b;
            border-radius:18px;
            overflow:hidden;
            position:relative;
            transition:0.3s;
        }

        .video-card:hover{
            transform:translateY(-5px);
        }

        /* VIDEO */
        .video-media{
            position:relative;
            width:100%;
            height:400px;
            overflow:hidden;
        }

        .video-media iframe{
            width:100%;
            height:100%;
            border:none;
        }

        /* TRENDING */
        .trending{
            position:absolute;
            top:15px;
            left:15px;
            background:#ef4444;
            color:white;
            padding:6px 12px;
            border-radius:10px;
            font-size:12px;
            font-weight:bold;
            z-index:10;
        }

        /* CONTENT */
        .content{
            padding:18px;
        }

        .title{
            font-size:16px;
            font-weight:700;
            margin-bottom:10px;
            line-height:1.5;
        }

        .channel{
            font-size:14px;
            opacity:0.8;
            margin-bottom:10px;
        }

        .stats{
            display:flex;
            flex-wrap:wrap;
            gap:15px;
            margin-bottom:12px;
            font-size:13px;
            opacity:0.9;
        }

        .engagement{
            margin-bottom:12px;
            font-size:13px;
            color:#f97316;
            font-weight:600;
        }

        .watch-btn{
            display:inline-block;
            padding:10px 15px;
            background:#ef4444;
            color:white;
            text-decoration:none;
            border-radius:10px;
            font-size:13px;
            transition:0.3s;
        }

        .watch-btn:hover{
            background:#dc2626;
        }

        /* PAGINATION */
        .pagination{
            text-align:center;
            margin:40px;
        }

        .pagination form{
            display:inline-block;
        }

        .pagination button{
            padding:12px 18px;
            border:none;
            border-radius:10px;
            color:white;
            cursor:pointer;
            margin:5px;
        }

        .prev-btn{
            background:#ef4444;
        }

        .next-btn{
            background:#f97316;
        }

    </style>
</head>

<body>

<!-- HEADER -->
<header>
    <h1>🍕 D'Kampong Pizza Dashboard</h1>
    <p>Social Media Ecosystem Viewer</p>
</header>

<!-- DASHBOARD -->
<div class="dashboard">

    <div class="card-box">
        <h2>
            {{ number_format($totalVideos) }}
            @if($totalVideos >= 1000000)
                <span style="font-size:15px;">+</span>
            @endif
        </h2>
        <p>Total Videos</p>
    </div>

    <div class="card-box">

        <h2 style="margin-bottom:15px;">
            Search Videos
        </h2>

        <form method="GET" style="
            display:flex;
            justify-content:center;
            align-items:center;
        ">

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search pizza videos..."
                style="
                    padding:12px;
                    width:100%;
                    border:none;
                    outline:none;
                    border-radius:10px 0 0 10px;
                    background:#0f172a;
                    color:white;
                "
            >

            <button style="
                padding:12px 18px;
                border:none;
                background:#f97316;
                color:white;
                border-radius:0 10px 10px 0;
                cursor:pointer;
                font-weight:600;
            ">
                Search
            </button>

        </form>

    </div>

    <div class="card-box">

        <h2>
            {{ $platform === 'YouTube' ? '▶ YouTube' : '👽 Reddit' }}
        </h2>

        <p style="margin-bottom:10px;">
            {{ $platform }} Ecosystem Analyzer
        </p>

        <!-- MODE INDICATOR -->
        <div style="
            display:inline-block;
            padding:6px 12px;
            border-radius:8px;
            font-size:12px;
            font-weight:600;
            background:
                {{ $platform === 'YouTube' ? '#ef4444' : '#6366f1' }};
            color:white;
        ">
            {{ $platform === 'YouTube' ? 'Video Intelligence Mode' : 'Community Intelligence Mode' }}
        </div>

    </div>

</div>

<!-- ANALYTICS -->
<div style="
    max-width:1200px;
    margin:auto;
    padding:20px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(350px,1fr));
    gap:20px;
">

    <!-- VIEWS CHART -->
    <div style="
        background:#1e293b;
        padding:20px;
        border-radius:18px;
    ">

        <h2 style="margin-bottom:20px;color:#f97316;">
            👁 Video Views Analytics
        </h2>

        <canvas id="viewsChart"></canvas>

    </div>

    <!-- ENGAGEMENT CHART -->
    <div style="
        background:#1e293b;
        padding:20px;
        border-radius:18px;
    ">

        <h2 style="margin-bottom:20px;color:#f97316;">
            📊 Engagement Analytics
        </h2>

        <canvas id="engagementChart"></canvas>

    </div>

</div>

<!-- FEED -->
<div class="feed">

@foreach($videos as $video)

@php

    $videoId = $video['id'];
    $title = $video['title'];
    $channel = $video['channel'];
    $views = $video['views'];
    $likes = $video['likes'];
    $commentsCount = $video['comments'];
    $published = $video['published'];
    $isTrending = $video['trending'];
    $engagement = $video['engagement'];

@endphp

<div class="video-card">

    <!-- TRENDING -->
    @if($isTrending)
        <div class="trending">
            🔥 Trending
        </div>
    @endif

    <!-- VIDEO -->
    <div class="video-media">

        <iframe
            id="v{{ $videoId }}"
            src="https://www.youtube.com/embed/{{ $videoId }}"
            allow="autoplay; encrypted-media"
            allowfullscreen
            onmouseover="this.src='https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1'"
            onmouseout="this.src='https://www.youtube.com/embed/{{ $videoId }}'">
        </iframe>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="title">
            {{ $title }}
        </div>

        <div class="channel">
            👤 {{ $channel }}
        </div>

        <div class="stats">

            <span>
                👁 {{ number_format($views) }} views
            </span>

            <span>
                ❤️ {{ number_format($likes) }}
            </span>

            <span>
                💬 {{ number_format($commentsCount) }}
            </span>

            <span>
                📅 {{ \Carbon\Carbon::parse($published)->diffForHumans() }}
            </span>

        </div>

        <div class="engagement">
            📊 Engagement Score: {{ $engagement }}%
        </div>

        <a
            class="watch-btn"
            href="/watch_youtube/{{ $videoId }}">
            ▶ Watch Video
        </a>

    </div>

</div>

@endforeach

</div>

<!-- PAGINATION -->
<div class="pagination">

    @if($prevPageToken)

    <form method="GET">

        <input type="hidden" name="search" value="{{ $search }}">

        <input type="hidden" name="pageToken" value="{{ $prevPageToken }}">

        <button class="prev-btn">
            ← Previous Page
        </button>

    </form>

    @endif


    @if($nextPageToken)

    <form method="GET">

        <input type="hidden" name="search" value="{{ $search }}">

        <input type="hidden" name="pageToken" value="{{ $nextPageToken }}">

        <button class="next-btn">
            Next Page →
        </button>

    </form>

    @endif

</div>

<script>

    // LABELS
    const labels = @json($chartLabels);

    // DATA
    const viewsData = @json($chartViews);
    const engagementData = @json($chartEngagement);

    // VIEWS CHART
    if(labels.length > 0){
        new Chart(document.getElementById('viewsChart'), {

            type: 'bar',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Views',
                    data: viewsData,
                    backgroundColor: '#f97316',
                    borderRadius: 10
                }]
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },

                scales: {

                    x: {
                        ticks: {
                            color: 'white'
                        }
                    },

                    y: {
                        ticks: {
                            color: 'white'
                        }
                    }

                }
            }

        });

        // ENGAGEMENT CHART
        new Chart(document.getElementById('engagementChart'), {

            type: 'line',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Engagement %',
                    data: engagementData,
                    borderColor: '#ef4444',
                    backgroundColor: '#ef4444',
                    tension: 0.4,
                    fill: false
                }]
            },

            options: {
                responsive: true,

                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },

                scales: {

                    x: {
                        ticks: {
                            color: 'white'
                        }
                    },

                    y: {
                        ticks: {
                            color: 'white'
                        }
                    }

                }
            }

        });
    }

</script>

</body>
</html>

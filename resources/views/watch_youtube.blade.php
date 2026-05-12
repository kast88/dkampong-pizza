<!DOCTYPE html>
<html>
<head>
    <title>Watch Video</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>

        body {
            background: #0f172a;
            color: white;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .player {
            max-width: 1000px;
            margin: auto;
        }

        iframe {
            width: 100%;
            height: 550px;
            border: none;
            border-radius: 12px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #ef4444;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .comments {
            max-width: 1000px;
            margin: 40px auto;
        }

        .comment-card {
            background: #1e293b;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .author {
            font-weight: bold;
            color: #f97316;
            margin-bottom: 8px;
        }

        .text {
            opacity: 0.9;
            line-height: 1.5;
        }

    </style>
</head>

<body>

<h1>🍕 D'Kampong Pizza Video Player</h1>

<div class="player">

    <iframe
        src="https://www.youtube.com/embed/{{ $id }}"
        allowfullscreen>
    </iframe>

</div>

<div style="text-align:center;">
    <a href="/" class="back-btn">
        ← Back to Dashboard
    </a>
</div>

<!-- COMMENTS -->
<div class="comments">

    <h2>💬 User Comments ({{ count($comments) }})</h2>
    <br>

    @foreach($comments as $index => $comment)

        @php
            $snippet = $comment['snippet']['topLevelComment']['snippet'];
            $author = $snippet['authorDisplayName'];
            $text = $snippet['textDisplay'];
        @endphp

        <div class="comment-card comment-item"
             style="{{ $index >= 5 ? 'display:none;' : '' }}">

            <div class="author">{{ $author }}</div>

            <div class="text">{!! $text !!}</div>

        </div>

    @endforeach

</div>

<div style="text-align:center; margin-bottom:40px;">

    <button onclick="showMore()" id="seeMoreBtn"
        style="padding:10px 15px; background:#f97316; border:none; color:white; border-radius:8px; cursor:pointer;">
        See More Comments ↓
    </button>

    <button onclick="showLess()" id="seeLessBtn"
        style="padding:10px 15px; background:#ef4444; border:none; color:white; border-radius:8px; cursor:pointer; display:none;">
        See Less ↑
    </button>

</div>

<script>
    let visibleCount = 5;

    function showMore() {
        let items = document.querySelectorAll('.comment-item');

        visibleCount += 5;

        items.forEach((item, index) => {
            if (index < visibleCount) {
                item.style.display = 'block';
            }
        });

        document.getElementById('seeLessBtn').style.display = 'inline-block';

        if (visibleCount >= items.length) {
            document.getElementById('seeMoreBtn').style.display = 'none';
        }
    }

    function showLess() {
        let items = document.querySelectorAll('.comment-item');

        visibleCount = 5;

        items.forEach((item, index) => {
            if (index < 5) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        document.getElementById('seeMoreBtn').style.display = 'inline-block';
        document.getElementById('seeLessBtn').style.display = 'none';
    }
</script>

</body>
</html>

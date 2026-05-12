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
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .player {
            max-width: 1000px;
            margin: auto;
        }

        iframe {
            width: 100%;
            height: 550px;
            border-radius: 12px;
            border: none;
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

<a href="/" class="back-btn">
    ← Back to Dashboard
</a>

</body>
</html>

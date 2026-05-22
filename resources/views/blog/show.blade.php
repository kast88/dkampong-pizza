<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] ?? 'Post' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        cream: '#f8f5f0',
                        sand: '#efe7dc',
                        ink: '#1f2937',
                        mocha: '#6b5b4d',
                        rosebrown: '#b08968',
                    },
                    boxShadow: {
                        soft: '0 10px 30px rgba(15, 23, 42, 0.08)',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-cream via-white to-sand text-ink min-h-screen">
    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between gap-4">
            <a href="{{ route('blog.index', ['url' => $currentUrl]) }}"
               class="inline-flex items-center rounded-full border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 transition hover:border-rosebrown hover:text-rosebrown">
                Back to posts
            </a>

            @if(!empty($post['url']))
                <a href="{{ $post['url'] }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center rounded-full bg-gray-900 px-5 py-3 text-sm font-medium text-white transition hover:bg-rosebrown">
                    Open original
                </a>
            @endif
        </div>

        <article class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/80 p-8 shadow-soft backdrop-blur-sm sm:p-10">
            <div class="mb-6 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                <span>
                    {{ !empty($post['published']) ? \Carbon\Carbon::parse($post['published'])->format('d M Y') : '-' }}
                </span>

                @if(isset($post['author']['displayName']))
                    <span>• {{ $post['author']['displayName'] }}</span>
                @endif

                @if(isset($post['replies']['totalItems']))
                    <span>• {{ $post['replies']['totalItems'] }} comments</span>
                @endif
            </div>

            <h1 class="font-serif text-4xl font-semibold tracking-tight text-ink sm:text-5xl">
                {{ $post['title'] ?? 'Untitled Post' }}
            </h1>

            @if(!empty($post['labels']))
                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach($post['labels'] as $label)
                        <span class="rounded-full bg-rosebrown/10 px-3 py-1 text-xs font-medium text-rosebrown">
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            @endif

            <div class="prose prose-lg mt-8 max-w-none prose-headings:font-serif prose-headings:text-ink prose-p:text-gray-700 prose-a:text-rosebrown">
                {!! $post['content'] ?? '<p>No content available.</p>' !!}
            </div>
        </article>
    </div>

    @if($comments->count())
        <section class="mt-10">
            <div class="rounded-[2rem] border border-white/70 bg-white/80 p-8 shadow-soft backdrop-blur-sm sm:p-10">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="font-serif text-3xl text-ink">Comments</h2>
                    <span class="rounded-full bg-gray-900 px-4 py-2 text-sm text-white">
                        {{ $comments->count() }} comments
                    </span>
                </div>

                <div class="space-y-6">
                    @foreach($comments as $comment)
                        <article class="rounded-2xl border border-gray-100 bg-white p-5">
                            <div class="mb-3 flex items-center gap-3">
                                @if(!empty($comment['author']['image']['url']))
                                    <img src="{{ $comment['author']['image']['url'] }}"
                                        alt="{{ $comment['author']['displayName'] ?? 'Author' }}"
                                        class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-rosebrown/10 text-sm font-semibold text-rosebrown">
                                        {{ strtoupper(substr($comment['author']['displayName'] ?? 'A', 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <p class="font-medium text-ink">
                                        {{ $comment['author']['displayName'] ?? 'Anonymous' }}
                                    </p>
                                    <p class="text-sm text-gray-400">
                                        {{ !empty($comment['published']) ? \Carbon\Carbon::parse($comment['published'])->format('d M Y, h:i A') : '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="prose max-w-none prose-p:text-gray-700 prose-a:text-rosebrown">
                                {!! $comment['content'] ?? '' !!}
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="mt-10">
            <div class="rounded-[2rem] border border-dashed border-gray-300 bg-white/80 p-8 text-center shadow-soft">
                <h2 class="font-serif text-2xl text-ink">No comments yet</h2>
                <p class="mt-2 text-gray-500">This post does not have any public comments.</p>
            </div>
        </section>
    @endif
</body>
</html>
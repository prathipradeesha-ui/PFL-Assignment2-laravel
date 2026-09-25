<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="max-w-6xl mx-auto px-6 py-10">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold">ProjectHub</h1>
                <p class="text-gray-600 mt-2">
                    Final-year project blog for Software Engineering students
                </p>
            </div>

            <a
                href="{{ route('posts.create') }}"
                class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700"
            >
                Create Post
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-2xl font-semibold mb-5">
            Latest Posts
        </h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-3 gap-6">

                @foreach ($posts->take(3) as $post)
                    <article class="bg-white rounded-xl shadow overflow-hidden">

                        @if ($post->cover_image)
                            <img
                                src="{{ $post->cover_image }}"
                                alt="{{ $post->title }}"
                                class="w-full h-48 object-cover"
                            >
                        @endif

                        <div class="p-5">

                            <span class="text-sm text-blue-600 font-medium">
                                {{ $post->category }}
                            </span>

                            <h3 class="text-xl font-bold mt-2 mb-2">
                                {{ $post->title }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                By {{ $post->author }}
                            </p>

                            <p class="text-gray-700 mb-4">
                                {{ Str::limit($post->content, 120) }}
                            </p>

                            <a
                                href="{{ route('posts.show', $post) }}"
                                class="text-blue-600 font-medium hover:underline"
                            >
                                Read More →
                            </a>

                        </div>
                    </article>
                @endforeach

            </div>
        @else
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <p class="text-gray-600">
                    No posts available yet.
                </p>

                <a
                    href="{{ route('posts.create') }}"
                    class="inline-block mt-4 bg-blue-600 text-white px-5 py-3 rounded-lg"
                >
                    Create the first post
                </a>
            </div>
        @endif

    </div>

</body>
</html>

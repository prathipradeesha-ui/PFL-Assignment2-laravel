<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $post->title }} - ProjectHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

<div class="max-w-5xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <a
            href="{{ route('posts.index') }}"
            class="text-blue-600 font-medium hover:underline"
        >
            ← Back to ProjectHub
        </a>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow">
                <span class="text-sm font-bold">PH</span>
            </div>

            <span class="font-bold text-lg">
                ProjectHub
            </span>

        </div>

    </div>

    <!-- Post Card -->
    <article class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <!-- Cover Image -->
        @if ($post->cover_image)

            <img
                src="{{ $post->cover_image }}"
                alt="{{ $post->title }}"
                class="w-full h-72 md:h-96 object-cover"
            >

        @endif

        <div class="p-6 md:p-10">

            <!-- Category -->
            <span class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">
                {{ $post->category }}
            </span>

            <!-- Title -->
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight mt-5">
                {{ $post->title }}
            </h1>

            <!-- Author and Date -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 mt-4 text-gray-500">

                <span>
                    By {{ $post->author }}
                </span>

                <span class="hidden sm:inline">
                    •
                </span>

                <span>
                    {{ $post->created_at->format('d M Y, H:i') }}
                </span>

            </div>

            <!-- Content -->
            <div class="mt-8 text-gray-700 leading-8 text-base md:text-lg whitespace-pre-line">
                {{ $post->content }}
            </div>

            <!-- Actions -->
            <div class="mt-10 pt-6 border-t border-gray-200">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <!-- Bookmark -->
                    <button
                        type="button"
                        data-bookmark-button
                        data-post-id="{{ $post->id }}"
                        aria-pressed="false"
                        class="border px-4 py-3 rounded-lg text-sm font-medium transition bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200"
                    >
                        ☆ Bookmark
                    </button>

                    <!-- Edit / Delete -->
                    <div class="flex flex-col sm:flex-row gap-3">

                        <a
                            href="{{ route('posts.edit', $post) }}"
                            class="inline-flex items-center justify-center bg-blue-600 text-white px-5 py-3 rounded-lg font-medium hover:bg-blue-700 transition"
                        >
                            Edit Post
                        </a>

                        <a
                            href="{{ route('posts.delete', $post) }}"
                            class="inline-flex items-center justify-center bg-red-600 text-white px-5 py-3 rounded-lg font-medium hover:bg-red-700 transition"
                        >
                            Delete Post
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </article>

</div>

</body>
</html>

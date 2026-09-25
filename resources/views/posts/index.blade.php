<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">

        <div class="flex items-center gap-4">

            <!-- ProjectHub Icon -->
            <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center shadow-md">
                <span class="text-xl font-bold">PH</span>
            </div>

            <div>
                <h1 class="text-4xl font-bold tracking-tight">
                    ProjectHub
                </h1>

                <p class="text-gray-600 mt-1">
                    Final-year project blog for Software Engineering students
                </p>
            </div>

        </div>

        <a
            href="{{ route('posts.create') }}"
            class="inline-flex items-center justify-center bg-blue-600 text-white px-5 py-3 rounded-lg font-medium hover:bg-blue-700 transition"
        >
            + Create Post
        </a>

    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 mb-8">

        <form
            action="{{ route('posts.index') }}"
            method="GET"
            class="flex flex-col md:flex-row gap-3"
        >

            <input
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="Search projects, authors, categories..."
                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition"
            >
                Search
            </button>

            @if ($search)
                <a
                    href="{{ route('posts.index') }}"
                    class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg text-center font-medium hover:bg-gray-300 transition"
                >
                    Clear
                </a>
            @endif

        </form>

    </div>

    <!-- Heading -->
    <div class="flex items-center justify-between mb-5">

        <div>

            @if ($search)

                <h2 class="text-2xl font-bold">
                    Search Results
                </h2>

                <p class="text-gray-600 mt-1">
                    Results for "{{ $search }}"
                </p>

            @else

                <h2 class="text-2xl font-bold">
                    Latest Posts
                </h2>

                <p class="text-gray-600 mt-1">
                    Recently published student projects
                </p>

            @endif

        </div>

        <span class="text-sm text-gray-500">
            {{ $posts->count() }}
            post{{ $posts->count() === 1 ? '' : 's' }}
        </span>

    </div>

    <!-- Posts -->
    @if ($posts->count())

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($posts as $post)

                <article class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">

                    <!-- Cover Image -->
                    @if ($post->cover_image)

                        <img
                            src="{{ $post->cover_image }}"
                            alt="{{ $post->title }}"
                            class="w-full h-52 object-cover"
                        >

                    @else

                        <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500">
                            No Cover Image
                        </div>

                    @endif

                    <div class="p-6">

                        <!-- Category -->
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $post->category }}
                        </span>

                        <!-- Title -->
                        <h3 class="text-xl font-bold mt-3 mb-2">
                            {{ $post->title }}
                        </h3>

                        <!-- Author -->
                        <p class="text-gray-500 text-sm mb-3">
                            By {{ $post->author }}
                        </p>

                        <!-- Content Preview -->
                        <p class="text-gray-600 text-sm leading-6 mb-5">
                            {{ Str::limit($post->content, 120) }}
                        </p>

                        <!-- Read More -->
                        <a
                            href="{{ route('posts.show', $post) }}"
                            class="text-blue-600 font-semibold hover:underline"
                        >
                            Read More →
                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <!-- No Posts -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-10 text-center">

            @if ($search)

                <h3 class="text-xl font-semibold mb-2">
                    No posts found
                </h3>

                <p class="text-gray-600 mb-5">
                    No posts matched "{{ $search }}".
                </p>

                <a
                    href="{{ route('posts.index') }}"
                    class="inline-block bg-gray-200 text-gray-800 px-5 py-3 rounded-lg font-medium hover:bg-gray-300"
                >
                    View All Posts
                </a>

            @else

                <h3 class="text-xl font-semibold mb-2">
                    No posts available yet
                </h3>

                <p class="text-gray-600 mb-5">
                    Start by creating your first project post.
                </p>

                <a
                    href="{{ route('posts.create') }}"
                    class="inline-block bg-blue-600 text-white px-5 py-3 rounded-lg font-medium hover:bg-blue-700"
                >
                    Create the First Post
                </a>

            @endif

        </div>

    @endif

</div>

</body>
</html>

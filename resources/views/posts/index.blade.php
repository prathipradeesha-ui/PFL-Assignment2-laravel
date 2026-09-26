<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ProjectHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-50 text-slate-900">

<!-- Top Gradient -->

<div class="h-2 w-full bg-gradient-to-r from-teal-500 via-cyan-500 to-blue-600"></div>

<div class="relative w-full max-w-7xl mx-auto px-6 py-10">

    <!-- Decorative Background -->

    <div class="absolute -top-20 -right-20 w-72 h-72 bg-cyan-100/50 rounded-full blur-3xl pointer-events-none"></div>

    <div class="absolute top-40 -left-32 w-64 h-64 bg-teal-100/40 rounded-full blur-3xl pointer-events-none"></div>


    <!-- Header -->

    <div class="relative bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-8">

        <!-- Header Accent -->

        <div class="h-1.5 bg-gradient-to-r from-teal-500 via-cyan-500 to-blue-600"></div>

        <div class="p-7">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <!-- Logo / Title -->

                <div class="flex items-center gap-4">

                    <div class="relative w-16 h-16 bg-gradient-to-br from-teal-500 to-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-8 h-8"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7.5A2.5 2.5 0 0 1 5.5 5H10l2 2h6.5A2.5 2.5 0 0 1 21 9.5v7A2.5 2.5 0 0 1 18.5 19h-13A2.5 2.5 0 0 1 3 16.5v-9Z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 12h8M8 15h5"
                            />

                        </svg>

                    </div>

                    <div>

                        <div class="flex items-center gap-2">

                            <h1 class="text-4xl font-bold tracking-tight">
                                ProjectHub
                            </h1>

                            <span class="hidden sm:inline-flex bg-teal-50 text-teal-700 border border-teal-200 px-3 py-1 rounded-full text-xs font-semibold">
                                Student Projects
                            </span>

                        </div>

                        <p class="text-slate-600 mt-2">
                            Final-year project blog for Software Engineering students
                        </p>

                    </div>

                </div>


                <!-- Header Actions -->

                <div class="flex flex-col sm:flex-row gap-3">

                    <button
                        type="button"
                        data-bookmark-view="all"
                        class="bg-amber-50 text-amber-700 border border-amber-200 px-5 py-3 rounded-xl font-semibold hover:bg-amber-100 transition"
                    >
                        ★ Bookmarks (<span data-bookmark-count>0</span>)
                    </button>

                    <a
                        href="{{ route('posts.create') }}"
                        class="inline-flex items-center justify-center bg-gradient-to-r from-teal-500 to-blue-600 text-white px-5 py-3 rounded-xl font-semibold shadow-sm hover:from-teal-600 hover:to-blue-700 transition"
                    >
                        + Create Post
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Success Message -->

    @if (session('success'))

        <div class="relative bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl mb-6 shadow-sm">
            {{ session('success') }}
        </div>

    @endif


    <!-- Search / Filter -->

    <div class="relative bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mb-8">

        <div class="flex items-center gap-3 mb-4">

            <div class="w-9 h-9 rounded-lg bg-cyan-50 text-cyan-600 flex items-center justify-center">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-5 h-5"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z"
                    />

                </svg>

            </div>

            <div>

                <h2 class="font-semibold text-slate-900">
                    Find Projects
                </h2>

                <p class="text-sm text-slate-500">
                    Search, filter and sort student projects
                </p>

            </div>

        </div>


        <form
            action="{{ route('posts.index') }}"
            method="GET"
            class="flex flex-col md:flex-row gap-3"
        >

            <input
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="Search projects, authors, tags..."
                class="flex-1 border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-400"
            >

            <select
                name="tag"
                class="border border-slate-300 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
            >

                <option value="">
                    All Tags
                </option>

                @foreach ($tags as $tag)

                    <option
                        value="{{ $tag }}"
                        {{ $selectedTag == $tag ? 'selected' : '' }}
                    >
                        {{ $tag }}
                    </option>

                @endforeach

            </select>


            <select
                name="sort"
                class="border border-slate-300 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500"
            >

                <option value="newest" {{ $selectedSort == 'newest' ? 'selected' : '' }}>
                    Newest
                </option>

                <option value="oldest" {{ $selectedSort == 'oldest' ? 'selected' : '' }}>
                    Oldest
                </option>

                <option value="title" {{ $selectedSort == 'title' ? 'selected' : '' }}>
                    Title A-Z
                </option>

            </select>


            <button
                type="submit"
                class="bg-gradient-to-r from-teal-500 to-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-teal-600 hover:to-blue-700 transition"
            >
                Search
            </button>


            @if ($search || $selectedTag || $selectedSort !== 'newest')

                <a
                    href="{{ route('posts.index') }}"
                    class="bg-slate-100 text-slate-700 border border-slate-200 px-6 py-3 rounded-xl text-center font-semibold hover:bg-slate-200 transition"
                >
                    Clear
                </a>

            @endif

        </form>

    </div>


    <!-- Heading -->

    <div class="relative flex items-end justify-between mb-5">

        <div>

            @if ($search)

                <div class="flex items-center gap-2">

                    <span class="w-2 h-8 bg-cyan-500 rounded-full"></span>

                    <h2 class="text-2xl font-bold">
                        Search Results
                    </h2>

                </div>

                <p class="text-slate-600 mt-2 ml-4">
                    Results for "{{ $search }}"
                </p>


            @elseif ($selectedTag)

                <div class="flex items-center gap-2">

                    <span class="w-2 h-8 bg-cyan-500 rounded-full"></span>

                    <h2 class="text-2xl font-bold">
                        Tag Results
                    </h2>

                </div>

                <p class="text-slate-600 mt-2 ml-4">
                    Projects tagged "{{ $selectedTag }}"
                </p>


            @elseif ($selectedSort === 'oldest')

                <div class="flex items-center gap-2">

                    <span class="w-2 h-8 bg-teal-500 rounded-full"></span>

                    <h2 class="text-2xl font-bold">
                        Oldest Posts
                    </h2>

                </div>

                <p class="text-slate-600 mt-2 ml-4">
                    Showing all posts from oldest to newest
                </p>


            @elseif ($selectedSort === 'title')

                <div class="flex items-center gap-2">

                    <span class="w-2 h-8 bg-blue-500 rounded-full"></span>

                    <h2 class="text-2xl font-bold">
                        Projects A-Z
                    </h2>

                </div>

                <p class="text-slate-600 mt-2 ml-4">
                    Showing all posts sorted by title
                </p>


            @else

                <div class="flex items-center gap-2">

                    <span class="w-2 h-8 bg-teal-500 rounded-full"></span>

                    <h2 class="text-2xl font-bold">
                        Latest Posts
                    </h2>

                </div>

                <p class="text-slate-600 mt-2 ml-4">
                    Showing the three most recent student projects
                </p>

            @endif

        </div>


        <span class="hidden sm:inline-flex bg-slate-100 border border-slate-200 text-slate-600 px-4 py-2 rounded-full text-sm font-medium">

            {{ $posts->count() }}

            post{{ $posts->count() === 1 ? '' : 's' }}

            shown

        </span>

    </div>


    <!-- Posts -->

    @if ($posts->count())

        <div class="relative grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($posts as $post)

                <article
                    data-post-card
                    data-post-id="{{ $post->id }}"
                    class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all duration-200"
                >

                    <!-- Card Accent -->

                    <div class="h-1 bg-gradient-to-r from-teal-500 to-cyan-500"></div>


                    <!-- Cover Image -->

                    @if ($post->cover_image)

                        <img
                            src="{{ $post->cover_image }}"
                            alt="{{ $post->title }}"
                            class="w-full h-56 object-cover group-hover:scale-[1.02] transition duration-300"
                        >

                    @else

                        <div class="w-full h-56 bg-gradient-to-br from-slate-100 to-cyan-50 flex items-center justify-center text-slate-400">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-12 h-12"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 15.75 7.5 10.5l5.25-5.25 5.25 5.25 4.5 4.5M3.75 19.5h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Z"
                                />

                            </svg>

                        </div>

                    @endif


                    <div class="p-6">

                        <div class="flex items-center justify-between gap-3">

                            <span class="inline-flex bg-teal-50 text-teal-700 border border-teal-100 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $post->tag }}
                            </span>

                        </div>


                        <h3 class="text-xl font-bold mt-4 mb-2 group-hover:text-teal-700 transition">
                            {{ $post->title }}
                        </h3>


                        <p class="text-slate-500 text-sm mb-3">
                            By {{ $post->author }}
                        </p>


                        <p class="text-slate-600 text-sm leading-6 mb-5">
                            {{ Str::limit($post->content, 120) }}
                        </p>


                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                            <a
                                href="{{ route('posts.show', $post) }}"
                                class="text-cyan-600 font-semibold hover:text-cyan-700 hover:underline transition"
                            >
                                Read More →
                            </a>


                            <button
                                type="button"
                                data-bookmark-button
                                data-post-id="{{ $post->id }}"
                                aria-pressed="false"
                                class="border px-3 py-2 rounded-xl text-sm font-medium transition bg-slate-50 text-slate-700 border-slate-300 hover:bg-amber-50 hover:text-amber-700 hover:border-amber-200"
                            >
                                ☆ Bookmark
                            </button>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>


        <!-- Empty Bookmark State -->

        <div
            data-bookmark-empty
            class="hidden bg-white rounded-2xl border border-slate-200 p-10 text-center mt-6 shadow-sm"
        >

            <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.6"
                    stroke="currentColor"
                    class="w-7 h-7"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17.593 3.322c1.026.482 1.407 1.77.825 2.718L12 16.5 5.582 6.04c-.582-.948-.2-2.236.825-2.718l.743-.348A2.25 2.25 0 0 1 8.1 2.75h7.8c.311 0 .617.065.9.191l.793.381Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 21h12"
                    />

                </svg>

            </div>


            <h3 class="text-xl font-semibold mb-2">
                No bookmarked posts
            </h3>


            <p class="text-slate-600">
                Bookmark a post to see it here.
            </p>

        </div>


    @else

        <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center shadow-sm">

            @if ($search)

                <h3 class="text-xl font-semibold mb-2">
                    No posts found
                </h3>

                <p class="text-slate-600 mb-5">
                    No posts matched "{{ $search }}".
                </p>

                <a
                    href="{{ route('posts.index') }}"
                    class="inline-block bg-slate-100 text-slate-800 px-5 py-3 rounded-xl font-semibold hover:bg-slate-200 transition"
                >
                    View All Posts
                </a>


            @elseif ($selectedTag)

                <h3 class="text-xl font-semibold mb-2">
                    No posts found
                </h3>

                <p class="text-slate-600 mb-5">
                    No posts matched the selected tag.
                </p>

                <a
                    href="{{ route('posts.index') }}"
                    class="inline-block bg-slate-100 text-slate-800 px-5 py-3 rounded-xl font-semibold hover:bg-slate-200 transition"
                >
                    View All Posts
                </a>


            @else

                <h3 class="text-xl font-semibold mb-2">
                    No posts available yet
                </h3>

                <p class="text-slate-600 mb-5">
                    Start by creating your first project post.
                </p>

                <a
                    href="{{ route('posts.create') }}"
                    class="inline-block bg-gradient-to-r from-teal-500 to-blue-600 text-white px-5 py-3 rounded-xl font-semibold hover:from-teal-600 hover:to-blue-700 transition"
                >
                    Create the First Post
                </a>

            @endif

        </div>

    @endif


    <!-- Footer -->

    <footer class="mt-12 border-t border-teal-100 pt-5 pb-6 text-center">

        <p class="text-sm font-semibold text-teal-700">

            ProjectHub · Explore ideas, showcase projects, and inspire innovation

        </p>

    </footer>

</div>

</body>

</html>
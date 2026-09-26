<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('q', ''));
        $selectedTag = $request->input('tag', '');
        $selectedSort = $request->input('sort', 'newest');

        if (!in_array($selectedSort, ['newest', 'oldest', 'title'], true)) {
            $selectedSort = 'newest';
        }

        // Get available tags
        $tags = Post::query()
            ->whereNotNull('tag')
            ->where('tag', '!=', '')
            ->select('tag')
            ->distinct()
            ->orderBy('tag')
            ->get()
            ->pluck('tag')
            ->values();

        $postsQuery = Post::query();

        // Search
        if ($search !== '') {
            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('tag', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Tag filter
        if ($selectedTag !== '') {
            $postsQuery->where('tag', $selectedTag);
        }

        // Sorting
        if ($selectedSort === 'oldest') {
            $postsQuery->orderBy('created_at', 'asc');
        } elseif ($selectedSort === 'title') {
            $postsQuery->orderBy('title', 'asc');
        } else {
            $postsQuery->orderBy('created_at', 'desc');
        }

        /*
         * Homepage:
         * - No search
         * - No tag filter
         * - Show only 3 posts
         *
         * Because sorting is applied before take(3):
         * Newest  -> newest 3
         * Oldest  -> oldest 3
         * Title   -> first 3 alphabetically
         *
         * When search or tag filtering is active:
         * show all matching posts.
         */
        $showLatestThree =
            $search === '' &&
            $selectedTag === '';

        if ($showLatestThree) {
            $posts = $postsQuery->take(3)->get();
        } else {
            $posts = $postsQuery->get();
        }

        return view('posts.index', compact(
            'posts',
            'search',
            'selectedTag',
            'selectedSort',
            'tags',
            'showLatestThree'
        ));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'author' => 'required|max:100',
            'tag' => 'required|max:100',
            'content' => 'required',
            'cover_image' => 'nullable|url',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'author' => 'required|max:100',
            'tag' => 'required|max:100',
            'content' => 'required',
            'cover_image' => 'nullable|url',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function delete(Post $post)
    {
        return view('posts.delete', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
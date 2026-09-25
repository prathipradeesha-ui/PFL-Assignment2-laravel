<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - ProjectHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f3f4f6;
            color: #111827;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .back-link {
            color: #2563eb;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .post-card {
            background-color: white;
            margin-top: 25px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .category {
            display: inline-block;
            background-color: #dbeafe;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        h1 {
            font-size: 38px;
            margin: 18px 0 10px;
        }

        .author {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .cover-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .content {
            font-size: 17px;
            line-height: 1.8;
            white-space: pre-line;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .edit-button {
            background-color: #2563eb;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .edit-button:hover {
            background-color: #1d4ed8;
        }

        .delete-button {
            background-color: #dc2626;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .delete-button:hover {
            background-color: #b91c1c;
        }

        @media (max-width: 600px) {
            .post-card {
                padding: 22px;
            }

            h1 {
                font-size: 30px;
            }

            .actions {
                flex-direction: column;
            }

            .edit-button,
            .delete-button {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('posts.index') }}" class="back-link">
        ← Back to ProjectHub
    </a>

    <article class="post-card">

        <span class="category">
            {{ $post->category }}
        </span>

        <h1>
            {{ $post->title }}
        </h1>

        <p class="author">
            By {{ $post->author }}
            ·
            {{ $post->created_at->format('d M Y, H:i') }}
        </p>

        @if ($post->cover_image)
            <img
                src="{{ $post->cover_image }}"
                alt="{{ $post->title }}"
                class="cover-image"
            >
        @endif

        <div class="content">
            {{ $post->content }}
        </div>

        <div class="actions">

            <a
                href="{{ route('posts.edit', $post) }}"
                class="edit-button"
            >
                Edit Post
            </a>

            <a
                href="{{ route('posts.delete', $post) }}"
                class="delete-button"
            >
                Delete Post
            </a>

        </div>

    </article>

</div>

</body>
</html>

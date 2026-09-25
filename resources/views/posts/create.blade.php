<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Post - ProjectHub</title>

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
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .back-link {
            color: #2563eb;
            text-decoration: none;
            font-size: 15px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        h1 {
            font-size: 36px;
            margin: 20px 0 8px;
        }

        .description {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        .help-text {
            color: #6b7280;
            font-size: 14px;
            margin-top: 6px;
        }

        .errors {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .publish-button {
            background-color: #2563eb;
            color: white;
            padding: 12px 22px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .publish-button:hover {
            background-color: #1d4ed8;
        }

        .cancel-button {
            background-color: #e5e7eb;
            color: #1f2937;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
        }

        .cancel-button:hover {
            background-color: #d1d5db;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px 15px;
            }

            h1 {
                font-size: 30px;
            }

            .form-card {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .publish-button,
            .cancel-button {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <a
            href="{{ route('posts.index') }}"
            class="back-link"
        >
            ← Back to ProjectHub
        </a>

        <h1>Create New Post</h1>

        <p class="description">
            Share your final-year project with other Software Engineering students.
        </p>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">

            <form
                action="{{ route('posts.store') }}"
                method="POST"
            >

                @csrf

                <div class="form-group">
                    <label for="title">
                        Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        maxlength="200"
                        required
                        placeholder="Enter your project title"
                    >
                </div>

                <div class="form-group">
                    <label for="author">
                        Author
                    </label>

                    <input
                        type="text"
                        id="author"
                        name="author"
                        value="{{ old('author') }}"
                        maxlength="100"
                        required
                        placeholder="Enter your name"
                    >
                </div>

                <div class="form-group">
                    <label for="tag">
                        Tag
                    </label>

                    <input
                        type="text"
                        id="tag"
                        name="tag"
                        value="{{ old('tag') }}"
                        maxlength="100"
                        required
                        placeholder="e.g. Artificial Intelligence"
                    >
                </div>

                <div class="form-group">
                    <label for="content">
                        Content
                    </label>

                    <textarea
                        id="content"
                        name="content"
                        required
                        placeholder="Write about your project..."
                    >{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="cover_image">
                        Cover Image URL
                    </label>

                    <input
                        type="url"
                        id="cover_image"
                        name="cover_image"
                        value="{{ old('cover_image') }}"
                        placeholder="https://example.com/image.jpg"
                    >

                    <p class="help-text">
                        Optional. Add a publicly accessible image URL.
                    </p>
                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="publish-button"
                    >
                        Publish Post
                    </button>

                    <a
                        href="{{ route('posts.index') }}"
                        class="cancel-button"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>

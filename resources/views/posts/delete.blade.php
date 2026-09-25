<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete Post - ProjectHub</title>

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
            max-width: 650px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .card {
            background-color: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .message {
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .post-title {
            font-weight: bold;
            color: #111827;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .delete-button {
            background-color: #dc2626;
            color: white;
            padding: 12px 22px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #b91c1c;
        }

        .cancel-button {
            background-color: #e5e7eb;
            color: #1f2937;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
        }

        .cancel-button:hover {
            background-color: #d1d5db;
        }

        @media (max-width: 600px) {
            .actions {
                flex-direction: column;
            }

            .delete-button,
            .cancel-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <h1>Delete Post?</h1>

            <p class="message">
                Are you sure you want to delete
                <span class="post-title">
                    "{{ $post->title }}"
                </span>?
                This action cannot be undone.
            </p>

            <div class="actions">

                <form
                    action="{{ route('posts.destroy', $post) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="delete-button"
                    >
                        Yes, Delete Post
                    </button>
                </form>

                <a
                    href="{{ route('posts.show', $post) }}"
                    class="cancel-button"
                >
                    Cancel
                </a>

            </div>

        </div>

    </div>

</body>
</html>

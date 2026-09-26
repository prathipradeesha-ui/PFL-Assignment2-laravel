# ProjectHub – Laravel

ProjectHub is a final-year project blog developed for Software Engineering students. Students can create, view, edit, delete, search, sort, and bookmark project posts.

This Laravel application is one of three framework implementations developed for the Programming Frameworks & Languages assessment. The same case-study requirements are implemented across the selected frameworks, with Search used as the common additional feature.

## Framework and Technologies

- Laravel 13.33.0
- PHP 8.3.6
- Blade
- SQLite
- Eloquent ORM
- Pest
- Vite
- Tailwind CSS
- Browser localStorage for bookmarks

## Implemented Features

### Core Blog Features

- Homepage displaying the latest three posts
- Create a new post
- View individual post details
- Edit an existing post
- Delete an existing post
- Delete confirmation page
- Persistent SQLite database
- Optional cover image URL for posts

### Additional Features

- Search
- Post sorting by Newest, Oldest, and Title
- Browser-based bookmarks using localStorage

## Search

Search is the common additional feature implemented for comparison across the framework implementations.

Users can search posts by:

- Title
- Author
- Category
- Content

Example:

```text
http://127.0.0.1:8000/?q=AI

# ProjectHub – Laravel

ProjectHub is a simple final-year project blog developed for Software Engineering students. Students can create, view, edit, delete, and search project posts.

This project is one of three framework implementations developed for the Programming Frameworks & Languages assessment. The same case-study requirements and additional Search feature are implemented across the selected frameworks.

## Framework and Technologies

* Laravel 13.33.0
* PHP 8.3.6
* Blade
* SQLite
* Eloquent ORM
* Pest / PHPUnit
* Tailwind CSS / Vite

## Implemented Features

### Core Blog Features

* Homepage displaying the latest three posts
* Create a new post
* View individual post details
* Edit an existing post
* Delete an existing post
* Delete confirmation page
* Persistent SQLite database
* Optional cover image URL for posts

### Additional Feature – Search

Search is the common additional feature implemented for comparison across the three framework implementations.

Users can search posts by:

* Title
* Author
* Category
* Content

Example:

```text
http://127.0.0.1:8000/?q=AI
```

The homepage displays matching search results and provides a Clear option to return to all posts.

## Post Data

Each post contains:

| Field       | Description                        |
| ----------- | ---------------------------------- |
| ID          | Unique post identifier             |
| Title       | Project title                      |
| Author      | Student/author name                |
| Category    | Project category                   |
| Content     | Project description                |
| Cover Image | Optional public image URL          |
| Created At  | Date and time the post was created |

## Database

The application uses SQLite for persistent data storage.

The main database table is:

```text
posts
```

The `Post` Eloquent model is used to create, retrieve, update, and delete posts.

## Project Structure

```text
PFL-Assignment2-laravel/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PostController.php
│   │
│   └── Models/
│       └── Post.php
│
├── database/
│   ├── migrations/
│   │   └── create_posts_table.php
│   └── database.sqlite
│
├── resources/
│   └── views/
│       └── posts/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── show.blade.php
│           ├── edit.blade.php
│           └── delete.blade.php
│
├── routes/
│   └── web.php
│
├── tests/
│   ├── Feature/
│   │   ├── ExampleTest.php
│   │   └── PostSearchTest.php
│   └── Unit/
│       └── ExampleTest.php
│
├── .env
├── composer.json
└── README.md
```

## Installation

Clone the repository:

```bash
git clone https://github.com/prathipradeesha-ui/PFL-Assignment2-laravel.git
```

Move into the project directory:

```bash
cd PFL-Assignment2-laravel
```

Install PHP dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Run the database migrations:

```bash
php artisan migrate
```

Start the Laravel development server:

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Testing

The project uses Pest for automated testing.

Run all tests with:

```bash
php artisan test
```

Current result:

```text
Tests: 3 passed (5 assertions)
```

The tests include:

* Basic application response test
* Database-aware feature test using `RefreshDatabase`
* Search feature test verifying that matching posts are returned and unrelated posts are excluded

The Search test creates test records in the test database and verifies the response returned for a search query.

## Main Routes

| Method | Route                  | Purpose             |
| ------ | ---------------------- | ------------------- |
| GET    | `/`                    | Homepage and search |
| GET    | `/posts/create`        | Create post form    |
| POST   | `/posts`               | Store new post      |
| GET    | `/posts/{post}`        | View post           |
| GET    | `/posts/{post}/edit`   | Edit post form      |
| PUT    | `/posts/{post}`        | Update post         |
| GET    | `/posts/{post}/delete` | Delete confirmation |
| DELETE | `/posts/{post}`        | Delete post         |

## Validation

Post creation and updating validate:

* Title is required and limited to 200 characters
* Author is required and limited to 100 characters
* Category is required and limited to 100 characters
* Content is required
* Cover image is optional but must be a valid URL when provided

## Assessment Context

This Laravel implementation forms part of a comparative investigation of three web development frameworks using the same Software Engineering student project blog case study.

The prototype demonstrates:

* Framework structure and conventions
* CRUD implementation
* Persistent data storage
* Search functionality
* Automated testing
* Basic responsive user interface design

The implementations can be compared using common requirements and the same additional Search feature.




<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('search finds posts by title', function () {
    Post::create([
        'title' => 'AI Student Assistant',
        'author' => 'Prathi',
        'category' => 'Artificial Intelligence',
        'content' => 'An AI-powered assistant for students.',
        'cover_image' => null,
    ]);

    Post::create([
        'title' => 'Smart Library Management System',
        'author' => 'Kavindu',
        'category' => 'Web Development',
        'content' => 'A system for managing library resources.',
        'cover_image' => null,
    ]);

    $response = $this->get('/?q=AI');

    $response->assertStatus(200);
    $response->assertSee('AI Student Assistant');
    $response->assertDontSee('Smart Library Management System');
});

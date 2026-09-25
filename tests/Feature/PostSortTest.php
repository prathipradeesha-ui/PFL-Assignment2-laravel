<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('posts can be sorted by title', function () {
    Post::create([
        'title' => 'Zebra Project',
        'author' => 'Student A',
        'tag' => 'Web Development',
        'content' => 'Zebra project content.',
    ]);

    Post::create([
        'title' => 'Alpha Project',
        'author' => 'Student B',
        'tag' => 'Artificial Intelligence',
        'content' => 'Alpha project content.',
    ]);

    $response = $this->get('/?sort=title');

    $response->assertStatus(200);
    $response->assertSeeInOrder([
        'Alpha Project',
        'Zebra Project',
    ]);
});

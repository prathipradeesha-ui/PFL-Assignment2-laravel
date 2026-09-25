<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('create post page is accessible', function () {
    $response = $this->get(route('posts.create'));

    $response->assertStatus(200);
    $response->assertSee('Create New Post');
});

test('a new post can be created', function () {
    $response = $this->post(route('posts.store'), [
        'title' => 'Campus Navigation System',
        'author' => 'Prathi',
        'tag' => 'Mobile Application',
        'content' => 'A mobile application for navigating university facilities.',
        'cover_image' => null,
    ]);

    $response
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('success', 'Post created successfully.');

    $this->assertDatabaseHas('posts', [
        'title' => 'Campus Navigation System',
        'author' => 'Prathi',
        'tag' => 'Mobile Application',
    ]);
});

test('a post can be viewed', function () {
    $post = Post::create([
        'title' => 'Student Event Management System',
        'author' => 'Jason',
        'tag' => 'Web Development',
        'content' => 'A system for managing university events.',
        'cover_image' => null,
    ]);

    $response = $this->get(route('posts.show', $post));

    $response->assertStatus(200);
    $response->assertSee('Student Event Management System');
    $response->assertSee('Jason');
});

test('an existing post can be updated', function () {
    $post = Post::create([
        'title' => 'Smart Parking Assistant',
        'author' => 'Kavindu Perera',
        'tag' => 'Internet of Things',
        'content' => 'Original content.',
        'cover_image' => null,
    ]);

    $response = $this->put(route('posts.update', $post), [
        'title' => 'Smart Parking Assistant Updated',
        'author' => 'Kavindu Perera',
        'tag' => 'Internet of Things',
        'content' => 'Updated content.',
        'cover_image' => null,
    ]);

    $response
        ->assertRedirect(route('posts.show', $post))
        ->assertSessionHas('success', 'Post updated successfully.');

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Smart Parking Assistant Updated',
        'content' => 'Updated content.',
    ]);
});

test('delete confirmation page is accessible', function () {
    $post = Post::create([
        'title' => 'Campus Security System',
        'author' => 'Student A',
        'tag' => 'Security',
        'content' => 'A campus security project.',
        'cover_image' => null,
    ]);

    $response = $this->get(route('posts.delete', $post));

    $response->assertStatus(200);
    $response->assertSee('Delete Post?');
    $response->assertSee('Campus Security System');
});

test('an existing post can be deleted', function () {
    $post = Post::create([
        'title' => 'Student Feedback System',
        'author' => 'Student B',
        'tag' => 'Web Development',
        'content' => 'A feedback management system.',
        'cover_image' => null,
    ]);

    $response = $this->delete(route('posts.destroy', $post));

    $response
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('success', 'Post deleted successfully.');

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});

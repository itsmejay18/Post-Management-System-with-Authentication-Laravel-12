<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected when accessing posts', function () {
    $this->get('/posts')->assertRedirect('/login');
});

test('authenticated users can perform full post crud', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->post('/posts', [
        'title' => 'First Post',
        'content' => 'Post content for testing.',
    ])->assertRedirect('/posts');

    $post = Post::firstOrFail();

    $this->get("/posts/{$post->id}")
        ->assertOk()
        ->assertSee('First Post');

    $this->put("/posts/{$post->id}", [
        'title' => 'Updated Post',
        'content' => 'Updated content.',
    ])->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Post',
        'content' => 'Updated content.',
    ]);

    $this->delete("/posts/{$post->id}")->assertRedirect('/posts');

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});

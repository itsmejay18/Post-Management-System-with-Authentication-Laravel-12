<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected when accessing posts', function () {
    $this->get('/posts')->assertRedirect('/login');
});

test('guests can see the public timeline on the welcome page', function () {
    $author = User::factory()->create([
        'name' => 'Timeline Author',
        'email' => 'timeline@example.com',
    ]);

    $featuredPost = Post::create([
        'user_id' => $author->id,
        'title' => 'Featured Update',
        'content' => 'This should appear in the pinned banner.',
    ]);

    $latestPost = Post::create([
        'user_id' => $author->id,
        'title' => 'Latest Feed Entry',
        'content' => 'This should appear in the latest posts timeline.',
        'created_at' => now()->subHour(),
        'updated_at' => now()->subHour(),
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Pinned Story')
        ->assertSee($featuredPost->title)
        ->assertSee($latestPost->title)
        ->assertSee('Timeline feed');
});

test('guests can open full post details from the public timeline', function () {
    $author = User::factory()->create();

    $post = Post::create([
        'user_id' => $author->id,
        'title' => 'Public Detail View',
        'content' => 'Guests should be able to read the full content.',
    ]);

    $this->get("/posts/{$post->id}")
        ->assertOk()
        ->assertSee('Public Detail View')
        ->assertSee('Guests should be able to read the full content.');
});

test('authenticated users can perform full post crud', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->post('/posts', [
        'title' => 'First Post',
        'content' => 'Post content for testing.',
    ])->assertRedirect('/posts');

    $post = Post::firstOrFail();

    expect($post->user_id)->toBe($user->id);

    $this->get("/posts/{$post->id}")
        ->assertOk()
        ->assertSee('First Post');

    $this->put("/posts/{$post->id}", [
        'title' => 'Updated Post',
        'content' => 'Updated content.',
    ])->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'user_id' => $user->id,
        'title' => 'Updated Post',
        'content' => 'Updated content.',
    ]);

    $this->delete("/posts/{$post->id}")->assertRedirect('/posts');

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});

test('authenticated users cannot edit or delete posts owned by another account', function () {
    $owner = User::factory()->create();
    $viewer = User::factory()->create();

    $post = Post::create([
        'user_id' => $owner->id,
        'title' => 'Owner Post',
        'content' => 'Only the owner should manage this.',
    ]);

    $this->actingAs($viewer);

    $this->get("/posts/{$post->id}/edit")->assertForbidden();

    $this->put("/posts/{$post->id}", [
        'title' => 'Intruder Edit',
        'content' => 'This update should not be allowed.',
    ])->assertForbidden();

    $this->delete("/posts/{$post->id}")->assertForbidden();

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'user_id' => $owner->id,
        'title' => 'Owner Post',
        'content' => 'Only the owner should manage this.',
    ]);
});

test('post list only shows edit controls for the owning account', function () {
    $owner = User::factory()->create();
    $viewer = User::factory()->create();

    $viewerPost = Post::create([
        'user_id' => $viewer->id,
        'title' => 'Viewer Post',
        'content' => 'Owned by the logged-in account.',
    ]);

    $ownerPost = Post::create([
        'user_id' => $owner->id,
        'title' => 'Owner Post',
        'content' => 'Owned by another account.',
    ]);

    $this->actingAs($viewer)
        ->get('/posts')
        ->assertOk()
        ->assertSee(route('posts.edit', $viewerPost), false)
        ->assertDontSee(route('posts.edit', $ownerPost), false)
        ->assertSee('Read Only');
});

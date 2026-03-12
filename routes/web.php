<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $feedQuery = Post::query()->with('user')->latest();
    $featuredPost = (clone $feedQuery)->first();

    return view('welcome', [
        'featuredPost' => $featuredPost,
        'latestPosts' => (clone $feedQuery)
            ->when($featuredPost, fn ($query) => $query->whereKeyNot($featuredPost->id))
            ->take(12)
            ->get(),
    ]);
})->name('home');

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    $myPostsQuery = Post::query()->where('user_id', $user->id);

    return view('dashboard', [
        'myPostsCount' => (clone $myPostsQuery)->count(),
        'communityPostsCount' => Post::count(),
        'otherAuthorsCount' => Post::query()
            ->where('user_id', '!=', $user->id)
            ->distinct('user_id')
            ->count('user_id'),
        'latestOwnedPosts' => (clone $myPostsQuery)
            ->latest()
            ->take(4)
            ->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';

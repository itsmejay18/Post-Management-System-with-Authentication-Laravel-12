<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-3xl border border-blue-200 bg-gradient-to-r from-sky-50 via-blue-50 to-cyan-50 shadow-sm shadow-blue-100/70">
            <div class="flex flex-col gap-6 px-6 py-7 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-500">Dashboard</p>
                    <div>
                        <h2 class="text-3xl font-semibold tracking-tight text-slate-900">
                            Welcome back, {{ auth()->user()->name }}
                        </h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                            Track your activity, review your latest posts, and jump back into publishing with the same owner-only permissions used across the app.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a
                        href="{{ route('posts.create') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
                    >
                        Create Post
                    </a>
                    <a
                        href="{{ route('posts.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-blue-700 shadow-sm transition hover:border-blue-300 hover:bg-blue-50"
                    >
                        Browse Posts
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="grid gap-4 lg:grid-cols-3">
                <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm shadow-blue-100/80">
                    <p class="text-sm font-medium text-slate-500">Your Posts</p>
                    <p class="mt-3 text-4xl font-semibold tracking-tight text-slate-900">{{ $myPostsCount }}</p>
                    <p class="mt-2 text-sm text-slate-500">Posts currently owned by your account.</p>
                </div>

                <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm shadow-blue-100/80">
                    <p class="text-sm font-medium text-slate-500">Community Posts</p>
                    <p class="mt-3 text-4xl font-semibold tracking-tight text-blue-700">{{ $communityPostsCount }}</p>
                    <p class="mt-2 text-sm text-slate-500">Every post currently visible inside the system.</p>
                </div>

                <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm shadow-blue-100/80">
                    <p class="text-sm font-medium text-slate-500">Other Authors</p>
                    <p class="mt-3 text-4xl font-semibold tracking-tight text-slate-900">{{ $otherAuthorsCount }}</p>
                    <p class="mt-2 text-sm text-slate-500">Accounts with posts that you can view but not edit.</p>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[1.3fr_0.7fr]">
                <div class="overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-xl shadow-blue-100/60">
                    <div class="border-b border-blue-100 bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Your Latest Posts</h3>
                        <p class="mt-1 text-sm text-blue-100">Quick access to the content you can manage directly.</p>
                    </div>

                    <div class="p-6">
                        @if ($latestOwnedPosts->isEmpty())
                            <div class="rounded-3xl border border-dashed border-blue-200 bg-blue-50/60 px-6 py-10 text-center">
                                <h4 class="text-lg font-semibold text-slate-900">No posts yet</h4>
                                <p class="mt-2 text-sm text-slate-600">Create your first post to start building your dashboard activity.</p>
                                <a
                                    href="{{ route('posts.create') }}"
                                    class="mt-5 inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-500"
                                >
                                    Create your first post
                                </a>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach ($latestOwnedPosts as $post)
                                    <div class="rounded-3xl border border-blue-100 bg-slate-50/80 p-5">
                                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                                            <div class="space-y-2">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <h4 class="text-lg font-semibold text-slate-900">{{ $post->title }}</h4>
                                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">
                                                        Owner Access
                                                    </span>
                                                </div>
                                                <p class="text-sm leading-6 text-slate-600">
                                                    {{ \Illuminate\Support\Str::limit($post->content, 140) }}
                                                </p>
                                                <p class="text-xs font-medium uppercase tracking-[0.25em] text-slate-400">
                                                    {{ $post->created_at->format('M d, Y h:i A') }}
                                                </p>
                                            </div>

                                            <div class="flex flex-wrap gap-2">
                                                <a
                                                    href="{{ route('posts.show', $post) }}"
                                                    class="inline-flex items-center rounded-2xl border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 transition hover:border-blue-300 hover:bg-blue-50"
                                                >
                                                    View
                                                </a>
                                                <a
                                                    href="{{ route('posts.edit', $post) }}"
                                                    class="inline-flex items-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-500"
                                                >
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl border border-blue-100 bg-white p-6 shadow-sm shadow-blue-100/80">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-500">Account Access</p>
                        <h3 class="mt-3 text-2xl font-semibold tracking-tight text-slate-900">Owner-first controls</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Your account can edit or delete only the posts it created. Other users' posts stay visible, but read-only.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-blue-100 bg-gradient-to-br from-slate-900 via-blue-950 to-cyan-900 p-6 text-white shadow-xl shadow-blue-200/50">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-200">Quick Actions</p>
                        <div class="mt-4 space-y-3">
                            <a
                                href="{{ route('profile.edit') }}"
                                class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm font-medium transition hover:bg-white/15"
                            >
                                <span>Manage Profile</span>
                                <span>&rarr;</span>
                            </a>
                            <a
                                href="{{ route('posts.index') }}"
                                class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm font-medium transition hover:bg-white/15"
                            >
                                <span>Open Post Feed</span>
                                <span>&rarr;</span>
                            </a>
                            <a
                                href="{{ route('posts.create') }}"
                                class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm font-medium transition hover:bg-white/15"
                            >
                                <span>Write New Post</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

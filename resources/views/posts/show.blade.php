<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-3xl border border-blue-200 bg-gradient-to-r from-sky-50 via-blue-50 to-cyan-50 shadow-sm shadow-blue-100/70">
            <div class="flex flex-col gap-6 px-6 py-7 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-500">Post Details</p>
                    <div>
                        <h2 class="text-3xl font-semibold tracking-tight text-slate-900">
                            {{ $post->title }}
                        </h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Written by {{ $post->user?->name ?? 'Unknown author' }}. Only the owner can edit or delete this post.
                        </p>
                    </div>
                </div>

                <a
                    href="{{ auth()->check() ? route('posts.index') : url('/#latest-posts') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-blue-700 shadow-sm transition hover:border-blue-300 hover:bg-blue-50"
                >
                    {{ auth()->check() ? 'Back to Posts' : 'Back to Timeline' }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-xl shadow-blue-100/60">
                <div class="border-b border-blue-100 bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-5">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-white">
                            {{ auth()->id() === $post->user_id ? 'You Own This Post' : 'Read Only' }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-white">
                            {{ $post->created_at->format('M d, Y h:i A') }}
                        </span>
                    </div>
                </div>

                <div class="space-y-8 p-6 text-gray-900 sm:p-8">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 p-5">
                            <p class="text-sm font-medium text-slate-500">Author</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $post->user?->name ?? 'Unknown author' }}</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $post->user?->email ?? 'No email available' }}</p>
                        </div>

                        <div class="rounded-2xl border border-blue-100 bg-white p-5">
                            <p class="text-sm font-medium text-slate-500">Permissions</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">
                                {{ auth()->id() === $post->user_id ? 'Full owner access' : 'View only access' }}
                            </p>
                            <p class="mt-1 text-sm text-slate-600">
                                {{ auth()->id() === $post->user_id ? 'You can update or remove this post.' : 'The edit and delete controls are restricted to the owner account.' }}
                            </p>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-blue-100 bg-slate-50/80 p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-500">Content</p>
                        <div class="mt-4 whitespace-pre-line text-base leading-8 text-slate-700">
                            {{ $post->content }}
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-blue-100 bg-blue-50/60 px-5 py-4">
                        @can('update', $post)
                            <div class="text-sm text-slate-600">
                                You are signed in as the owner of this post.
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <a
                                    href="{{ route('posts.edit', $post) }}"
                                    class="inline-flex items-center rounded-2xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-500"
                                >
                                    Edit Post
                                </a>

                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center rounded-2xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                                    >
                                        Delete Post
                                    </button>
                                </form>
                            </div>
                        @else
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Read-only mode</p>
                                <p class="mt-1 text-sm text-slate-600">Only {{ $post->user?->name ?? 'the owner' }} can edit or delete this post.</p>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

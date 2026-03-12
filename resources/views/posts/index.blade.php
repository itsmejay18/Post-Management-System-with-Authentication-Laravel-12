<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-3xl border border-blue-200 bg-gradient-to-r from-sky-50 via-blue-50 to-cyan-50 shadow-sm shadow-blue-100/70">
            <div class="flex flex-col gap-6 px-6 py-7 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-500">Post Center</p>
                    <div>
                        <h2 class="text-3xl font-semibold tracking-tight text-slate-900">
                            {{ __('Community Posts') }}
                        </h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                            Browse every post in the system. You can only edit or delete the posts created by the account you are currently using.
                        </p>
                    </div>
                </div>

                <a
                    href="{{ route('posts.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
                >
                    Create Post
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-medium text-blue-900 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid gap-4 lg:grid-cols-3">
                <div class="rounded-3xl border border-blue-100 bg-white p-5 shadow-sm shadow-blue-100/80">
                    <p class="text-sm font-medium text-slate-500">Total Posts</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $posts->total() }}</p>
                    <p class="mt-2 text-sm text-slate-500">All published posts visible to authenticated users.</p>
                </div>

                <div class="rounded-3xl border border-blue-100 bg-white p-5 shadow-sm shadow-blue-100/80">
                    <p class="text-sm font-medium text-slate-500">Your Access</p>
                    <p class="mt-3 text-3xl font-semibold text-blue-700">Owner Only</p>
                    <p class="mt-2 text-sm text-slate-500">Edit and delete controls appear only on posts that belong to your account.</p>
                </div>

                <div class="rounded-3xl border border-blue-100 bg-white p-5 shadow-sm shadow-blue-100/80">
                    <p class="text-sm font-medium text-slate-500">Current Account</p>
                    <p class="mt-3 text-xl font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                    <p class="mt-2 text-sm text-slate-500">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-xl shadow-blue-100/60">
                <div class="border-b border-blue-100 bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Post Feed</h3>
                    <p class="mt-1 text-sm text-blue-100">Owner controls are locked to the account that created each post.</p>
                </div>

                <div class="p-6 text-gray-900">
                    @if ($posts->isEmpty())
                        <div class="rounded-3xl border border-dashed border-blue-200 bg-blue-50/60 px-6 py-12 text-center">
                            <h3 class="text-lg font-semibold text-slate-900">No posts yet</h3>
                            <p class="mt-2 text-sm text-slate-600">Create the first post for your account to start the feed.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-blue-100">
                                <thead class="bg-blue-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Post</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Author</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Created</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Access</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-blue-50 bg-white">
                                    @foreach ($posts as $post)
                                        @php($ownsPost = auth()->id() === $post->user_id)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <div class="space-y-1">
                                                    <p class="font-semibold text-slate-900">{{ $post->title }}</p>
                                                    <p class="max-w-xl text-sm leading-6 text-slate-600">
                                                        {{ \Illuminate\Support\Str::limit($post->content, 100) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-600">
                                                <div class="space-y-1">
                                                    <p class="font-medium text-slate-900">{{ $post->user?->name ?? 'Unknown author' }}</p>
                                                    <p>{{ $post->user?->email ?? 'No email available' }}</p>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-600">{{ $post->created_at->format('M d, Y h:i A') }}</td>
                                            <td class="whitespace-nowrap px-4 py-4 text-sm">
                                                @if ($ownsPost)
                                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">
                                                        Your Post
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600">
                                                        Read Only
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 text-right text-sm">
                                                <div class="flex flex-wrap items-center justify-end gap-2">
                                                    <a
                                                        href="{{ route('posts.show', $post) }}"
                                                        class="inline-flex items-center rounded-full border border-blue-200 px-3 py-2 font-medium text-blue-700 transition hover:border-blue-300 hover:bg-blue-50"
                                                    >
                                                        View
                                                    </a>

                                                    @can('update', $post)
                                                        <a
                                                            href="{{ route('posts.edit', $post) }}"
                                                            class="inline-flex items-center rounded-full bg-blue-600 px-3 py-2 font-medium text-white shadow-sm transition hover:bg-blue-500"
                                                        >
                                                            Edit
                                                        </a>
                                                    @endcan

                                                    @can('delete', $post)
                                                        <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                type="submit"
                                                                class="inline-flex items-center rounded-full bg-slate-900 px-3 py-2 font-medium text-white transition hover:bg-slate-800"
                                                            >
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="inline-flex items-center rounded-full border border-slate-200 px-3 py-2 text-xs font-medium uppercase tracking-[0.2em] text-slate-500">
                                                            Owner Only
                                                        </span>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

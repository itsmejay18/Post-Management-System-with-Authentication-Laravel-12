<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Posts') }}
            </h2>

            <a
                href="{{ route('posts.create') }}"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
            >
                Create Post
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-green-100 p-4 text-sm font-medium text-green-800 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($posts->isEmpty())
                        <p>No posts found. Create your first post.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Title</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Content</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Created</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-600">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900">{{ $post->title }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($post->content, 80) }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">{{ $post->created_at->format('M d, Y h:i A') }}</td>
                                            <td class="px-4 py-3 text-right text-sm">
                                                <div class="inline-flex items-center gap-2">
                                                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                                    <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                                                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                                    </form>
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

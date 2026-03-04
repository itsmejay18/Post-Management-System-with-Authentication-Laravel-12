<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('View Post') }}
            </h2>

            <a
                href="{{ route('posts.index') }}"
                class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Back to Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="space-y-5 p-6 text-gray-900">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h3>
                        <p class="mt-1 text-sm text-gray-500">Created {{ $post->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <div class="rounded-md border border-gray-200 bg-gray-50 p-4 text-gray-800">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <div class="flex items-center gap-3">
                        <a
                            href="{{ route('posts.edit', $post) }}"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
                        >
                            Edit
                        </a>

                        <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

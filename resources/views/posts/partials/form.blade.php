@php
    $post = $post ?? null;
    $submitLabel = $submitLabel ?? 'Save Post';
@endphp

<div class="space-y-6">
    <div>
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input
            id="title"
            name="title"
            type="text"
            class="mt-1 block w-full"
            :value="old('title', $post?->title)"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="content" :value="__('Content')" />
        <textarea
            id="content"
            name="content"
            rows="8"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required
        >{{ old('content', $post?->content) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('content')" />
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel }}</x-primary-button>
        <a
            href="{{ route('posts.index') }}"
            class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
        >
            Cancel
        </a>
    </div>
</div>

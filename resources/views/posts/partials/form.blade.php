@php
    $post = $post ?? null;
    $submitLabel = $submitLabel ?? 'Save Post';
@endphp

<div class="space-y-8">
    <div class="rounded-2xl border border-blue-100 bg-blue-50/70 p-5">
        <p class="text-sm font-semibold text-slate-900">Owner-protected publishing</p>
        <p class="mt-2 text-sm leading-6 text-slate-600">
            Once this post is saved, only the account that owns it can edit or delete it.
        </p>
    </div>

    <div>
        <label for="title" class="block text-sm font-semibold text-slate-800">
            Title
        </label>
        <p class="mt-1 text-sm text-slate-500">Use a short, clear headline that stands out in the feed.</p>
        <input
            id="title"
            name="title"
            type="text"
            class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
            value="{{ old('title', $post?->title) }}"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <label for="content" class="block text-sm font-semibold text-slate-800">
            Content
        </label>
        <p class="mt-1 text-sm text-slate-500">Write the full post here. Line breaks will be preserved when the post is viewed.</p>
        <textarea
            id="content"
            name="content"
            rows="10"
            class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/50 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
            required
        >{{ old('content', $post?->content) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('content')" />
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <button
            type="submit"
            class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
        >
            {{ $submitLabel }}
        </button>
        <a
            href="{{ route('posts.index') }}"
            class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700"
        >
            Cancel
        </a>
    </div>
</div>

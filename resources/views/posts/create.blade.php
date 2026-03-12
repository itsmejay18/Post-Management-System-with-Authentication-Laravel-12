<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-3xl border border-blue-200 bg-gradient-to-r from-sky-50 via-blue-50 to-cyan-50 shadow-sm shadow-blue-100/70">
            <div class="flex flex-col gap-6 px-6 py-7 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-500">New Post</p>
                    <div>
                        <h2 class="text-3xl font-semibold tracking-tight text-slate-900">
                            {{ __('Create a Post') }}
                        </h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                            This post will be owned by the account currently logged in, and only that account will be able to edit or delete it.
                        </p>
                    </div>
                </div>

                <a
                    href="{{ route('posts.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-blue-700 shadow-sm transition hover:border-blue-300 hover:bg-blue-50"
                >
                    Back to Posts
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-xl shadow-blue-100/60">
                <div class="border-b border-blue-100 bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Write something worth sharing</h3>
                    <p class="mt-1 text-sm text-blue-100">Keep it clear, keep it yours, and publish it under your account.</p>
                </div>

                <div class="p-6 text-gray-900 sm:p-8">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        @include('posts.partials.form', ['submitLabel' => 'Create Post'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

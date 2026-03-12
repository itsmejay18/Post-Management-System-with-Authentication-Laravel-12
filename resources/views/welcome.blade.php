<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;space-grotesk:500,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 font-sans text-slate-900 antialiased">
        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.2),_transparent_25%),radial-gradient(circle_at_80%_18%,_rgba(59,130,246,0.22),_transparent_25%),linear-gradient(180deg,_#f8fbff_0%,_#e0f2fe_32%,_#f8fafc_100%)]">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -left-20 top-16 h-72 w-72 rounded-full bg-cyan-300/35 blur-3xl"></div>
                <div class="absolute right-0 top-10 h-96 w-96 rounded-full bg-blue-400/25 blur-3xl"></div>
                <div class="absolute bottom-0 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-sky-500/15 blur-3xl"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-8 sm:px-8 lg:px-10">
                <header class="flex flex-col gap-4 rounded-full border border-white/70 bg-white/75 px-5 py-4 shadow-sm backdrop-blur md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-lg font-bold text-white">P</span>
                        <div>
                            <p class="font-semibold text-slate-900">{{ config('app.name', 'Post Management System') }}</p>
                            <p class="text-sm text-slate-500">Public timeline with owner-protected actions</p>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <nav class="flex flex-wrap items-center gap-3">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center justify-center rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-500"
                                >
                                    Go to Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center rounded-full border border-blue-200 bg-white px-5 py-2.5 text-sm font-semibold text-blue-700 transition hover:border-blue-300 hover:bg-blue-50"
                                >
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:from-blue-500 hover:to-cyan-400"
                                    >
                                        Sign up
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                @if ($featuredPost)
                    <section class="grid gap-8 py-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                        <div class="space-y-6">
                            <div class="space-y-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600">Pinned Story</p>
                                <h1 class="font-['Space_Grotesk'] text-5xl font-bold leading-[1.02] tracking-tight text-slate-950 sm:text-6xl">
                                    {{ $featuredPost->title }}
                                </h1>
                                <p class="max-w-2xl text-lg leading-8 text-slate-600">
                                    {{ \Illuminate\Support\Str::limit($featuredPost->content, 220) }}
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 font-semibold uppercase tracking-[0.2em] text-blue-700">
                                    Latest update
                                </span>
                                <span>By {{ $featuredPost->user?->name ?? 'Unknown author' }}</span>
                                <span>&bull;</span>
                                <span>{{ $featuredPost->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a
                                    href="{{ route('posts.show', $featuredPost) }}"
                                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
                                >
                                    Read full post
                                </a>
                                <a
                                    href="#latest-posts"
                                    class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-6 py-3.5 text-sm font-semibold text-blue-700 shadow-sm transition hover:border-blue-300 hover:bg-blue-50"
                                >
                                    Scroll to latest posts
                                </a>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="absolute -inset-6 rounded-[2.5rem] bg-gradient-to-br from-blue-300/30 to-cyan-200/30 blur-3xl"></div>
                            <div class="relative overflow-hidden rounded-[2rem] border border-white/70 bg-white/80 shadow-2xl shadow-blue-200/70 backdrop-blur-xl">
                                <div class="border-b border-blue-100 bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-4 text-white">
                                    <h2 class="font-['Space_Grotesk'] text-2xl font-bold tracking-tight">Latest Post</h2>
                                </div>

                                <div class="space-y-5 p-6 sm:p-8">
                                    <div class="rounded-3xl border border-blue-100 bg-blue-50/70 p-5">
                                        <p class="text-sm font-medium text-slate-500">Author</p>
                                        <p class="mt-2 text-xl font-semibold text-slate-900">{{ $featuredPost->user?->name ?? 'Unknown author' }}</p>
                                    </div>

                                    <div class="rounded-3xl border border-blue-100 bg-white p-5">
                                        <p class="text-sm font-medium text-slate-500">Permissions</p>
                                        <p class="mt-2 text-xl font-semibold text-slate-900">Read for everyone</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @else
                    <section class="py-12">
                        <div class="rounded-[2rem] border border-white/70 bg-white/80 p-10 shadow-2xl shadow-blue-200/70 backdrop-blur-xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600">No posts yet</p>
                            <h1 class="mt-4 font-['Space_Grotesk'] text-5xl font-bold tracking-tight text-slate-950">The public timeline will appear here.</h1>
                            <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-600">
                                Create the first post after signing in and it will automatically show up in the public latest-posts feed.
                            </p>
                        </div>
                    </section>
                @endif

                <section id="latest-posts" class="pb-12">
                    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600">Latest Posts</p>
                            <h2 class="mt-3 font-['Space_Grotesk'] text-4xl font-bold tracking-tight text-slate-950">Timeline feed</h2>
                        </div>

                        @guest
                            <div class="flex flex-wrap gap-3">
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-blue-700 shadow-sm transition hover:border-blue-300 hover:bg-blue-50"
                                >
                                    Log in to interact
                                </a>
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
                                >
                                    Create account
                                </a>
                            </div>
                        @endguest
                    </div>

                    @if ($latestPosts->isEmpty())
                        <div class="rounded-3xl border border-dashed border-blue-200 bg-white/70 px-6 py-10 text-center shadow-sm backdrop-blur">
                            <p class="text-lg font-semibold text-slate-900">No additional posts yet.</p>
                            <p class="mt-2 text-sm text-slate-600">The pinned story is the only published update right now.</p>
                        </div>
                    @else
                        <div class="mx-auto max-w-4xl space-y-5">
                            @foreach ($latestPosts as $post)
                                <article class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/85 shadow-lg shadow-blue-100/70 backdrop-blur-xl">
                                    <div class="border-b border-blue-100 bg-blue-50/80 px-6 py-4">
                                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900">{{ $post->user?->name ?? 'Unknown author' }}</p>
                                                <p class="mt-1 text-xs font-medium uppercase tracking-[0.25em] text-slate-400">{{ $post->created_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">
                                                Public Post
                                            </span>
                                        </div>
                                    </div>

                                    <div class="space-y-4 px-6 py-6">
                                        <h3 class="font-['Space_Grotesk'] text-2xl font-bold tracking-tight text-slate-950">
                                            {{ $post->title }}
                                        </h3>
                                        <p class="text-base leading-8 text-slate-600">
                                            {{ \Illuminate\Support\Str::limit($post->content, 240) }}
                                        </p>

                                        <div class="flex flex-wrap items-center gap-3">
                                            <a
                                                href="{{ route('posts.show', $post) }}"
                                                class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500"
                                            >
                                                Open full details
                                            </a>

                                            @guest
                                                <span class="inline-flex items-center rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm font-medium text-slate-600">
                                                    Sign in to create and manage your own posts
                                                </span>
                                            @else
                                                <a
                                                    href="{{ route('posts.index') }}"
                                                    class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-blue-700 transition hover:border-blue-300 hover:bg-blue-50"
                                                >
                                                    Open feed manager
                                                </a>
                                            @endguest
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </body>
</html>

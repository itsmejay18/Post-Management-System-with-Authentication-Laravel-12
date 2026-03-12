<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;space-grotesk:500,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 font-sans text-slate-900 antialiased">
        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.28),_transparent_28%),radial-gradient(circle_at_80%_15%,_rgba(59,130,246,0.28),_transparent_24%),linear-gradient(160deg,_#eff6ff_0%,_#dbeafe_42%,_#f8fafc_100%)]">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -left-24 top-16 h-72 w-72 rounded-full bg-cyan-300/35 blur-3xl"></div>
                <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-blue-400/25 blur-3xl"></div>
                <div class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-sky-500/15 blur-3xl"></div>
            </div>

            <div class="relative mx-auto flex min-h-screen max-w-7xl items-center px-6 py-10 sm:px-8 lg:px-10">
                <div class="grid w-full gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                    <div class="hidden lg:block">
                        <div class="max-w-xl space-y-8 text-slate-900">
                            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 rounded-full border border-white/60 bg-white/70 px-4 py-2 shadow-sm backdrop-blur">
                                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-lg font-bold text-white">P</span>
                                <span>
                                    <span class="block font-semibold leading-tight">{{ config('app.name', 'Post Management System') }}</span>
                                    <span class="block text-sm text-slate-500">Secure posting workspace</span>
                                </span>
                            </a>

                            <div class="space-y-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600">{{ trim($eyebrow ?? 'Access Portal') }}</p>
                                <h1 class="font-['Space_Grotesk'] text-5xl font-bold leading-[1.05] tracking-tight text-slate-950">
                                    {{ trim($heroTitle ?? 'A cleaner blue workspace for posts, accounts, and owner-only actions.') }}
                                </h1>
                                <p class="max-w-lg text-base leading-7 text-slate-600">
                                    {{ trim($heroText ?? 'Sign in or create an account to manage your own posts while keeping every other account read-only, just the way a real multi-user platform should behave.') }}
                                </p>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-sm backdrop-blur">
                                    <p class="text-sm font-medium text-slate-500">Ownership Rules</p>
                                    <p class="mt-2 text-xl font-semibold text-slate-900">Your account, your posts</p>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">Edit and delete actions are locked to the post owner.</p>
                                </div>

                                <div class="rounded-3xl border border-white/60 bg-white/70 p-5 shadow-sm backdrop-blur">
                                    <p class="text-sm font-medium text-slate-500">Design Direction</p>
                                    <p class="mt-2 text-xl font-semibold text-slate-900">Blue system UI</p>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">A brighter dashboard and cleaner auth screens across the app.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto w-full max-w-xl">
                        <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/80 shadow-2xl shadow-blue-200/70 backdrop-blur-xl">
                            <div class="border-b border-blue-100 bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-5 text-white sm:px-8">
                                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-100">{{ trim($eyebrow ?? 'Access Portal') }}</p>
                                <h2 class="mt-3 font-['Space_Grotesk'] text-3xl font-bold tracking-tight">
                                    {{ trim($title ?? 'Secure access') }}
                                </h2>
                                <p class="mt-2 max-w-md text-sm leading-6 text-blue-100">
                                    {{ trim($subtitle ?? 'Use your account to continue into the owner-protected workspace.') }}
                                </p>
                            </div>

                            <div class="px-6 py-8 sm:px-8">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

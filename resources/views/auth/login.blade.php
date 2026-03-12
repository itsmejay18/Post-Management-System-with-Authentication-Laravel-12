<x-guest-layout>
    <x-slot name="eyebrow">Sign In</x-slot>
    <x-slot name="title">Welcome back</x-slot>
    <x-slot name="subtitle">Log in to reach your dashboard, manage your own posts, and keep every other account read-only.</x-slot>

    <x-auth-session-status class="mb-6 rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-medium text-blue-900" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-800">Email address</label>
            <input
                id="email"
                class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-800">Password</label>
            <input
                id="password"
                class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <label for="remember_me" class="inline-flex items-center gap-3 text-sm text-slate-600">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-blue-300 text-blue-600 shadow-sm focus:ring-blue-500"
                    name="remember"
                >
                <span>{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm font-medium text-blue-700 transition hover:text-blue-800"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button
            type="submit"
            class="inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
        >
            {{ __('Log in') }}
        </button>

        <p class="text-center text-sm text-slate-600">
            Need an account?
            <a href="{{ route('register') }}" class="font-semibold text-blue-700 transition hover:text-blue-800">
                Sign up here
            </a>
        </p>
    </form>
</x-guest-layout>

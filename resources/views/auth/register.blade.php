<x-guest-layout>
    <x-slot name="eyebrow">Create Account</x-slot>
    <x-slot name="title">Start with your own account</x-slot>
    <x-slot name="subtitle">Register to publish under your name and get full control over the posts your account creates.</x-slot>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-800">Full name</label>
            <input
                id="name"
                class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-800">Email address</label>
            <input
                id="email"
                class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
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
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-800">Confirm password</label>
            <input
                id="password_confirmation"
                class="mt-3 block w-full rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button
            type="submit"
            class="inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition hover:from-blue-500 hover:to-cyan-400"
        >
            {{ __('Create account') }}
        </button>

        <p class="text-center text-sm text-slate-600">
            Already registered?
            <a href="{{ route('login') }}" class="font-semibold text-blue-700 transition hover:text-blue-800">
                Log in here
            </a>
        </p>
    </form>
</x-guest-layout>

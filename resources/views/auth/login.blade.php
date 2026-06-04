<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="text-red-700 font-semibold text-lg" />
            <x-text-input
                id="email"
                class="block mt-2 w-full border border-red-300 rounded-md focus:border-red-600 focus:ring-2 focus:ring-red-400 text-red-700 placeholder-red-300 transition duration-300"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="Masukkan email AsprakNotes"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" class="text-red-700 font-semibold text-lg" />
            <x-text-input
                id="password"
                class="block mt-2 w-full border border-red-300 rounded-md focus:border-red-600 focus:ring-2 focus:ring-red-400 text-red-700 placeholder-red-300 transition duration-300"
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer text-red-700 select-none">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-red-300 text-red-600 shadow-sm focus:ring-red-500"
                    name="remember"
                />
                <span class="ml-2 text-sm font-medium">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex justify-center">
            <button type="submit" 
                class="bg-white text-red-600 border border-red-600 hover:bg-red-100 focus:ring-red-400 transition duration-300 px-6 py-2 rounded-md font-semibold shadow-md"
            >
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="bg-white border border-red-100 rounded-lg shadow p-8">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-red-700 font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-red-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-red-700 font-semibold" />

            <x-text-input id="password" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-red-700 font-semibold" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-red-600 hover:text-red-800 mr-4" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

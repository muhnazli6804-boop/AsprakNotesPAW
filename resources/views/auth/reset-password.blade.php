<x-guest-layout>
    <form method="POST" action="{{ route('password.update') }}" class="bg-white border border-red-100 rounded-lg shadow p-8">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-red-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-red-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-red-700 font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

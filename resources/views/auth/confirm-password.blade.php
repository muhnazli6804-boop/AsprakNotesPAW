<x-guest-layout>
    <div class="mb-4 text-sm text-red-700">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="bg-white border border-red-100 rounded-lg shadow p-8">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-red-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

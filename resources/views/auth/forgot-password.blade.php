<x-guest-layout>
    <div class="mb-4 text-sm text-red-700">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="bg-white border border-red-100 rounded-lg shadow p-8">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-red-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border border-red-200 focus:border-red-500 focus:ring-red-300 text-red-700" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

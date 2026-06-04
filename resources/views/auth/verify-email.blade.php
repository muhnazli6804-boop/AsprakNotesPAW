<x-guest-layout>
    <div class="mb-4 text-sm text-red-700">
        {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.') }}
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="bg-white border border-red-100 rounded-lg shadow p-8">
        @csrf
        <div class="flex items-center justify-between">
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-secondary-button onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-secondary-button>
            </form>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center">
                <img src="{{ asset('panel/assets/images/logos/ısdfs.png') }}"
                     alt="Site Logosu"
                     class="rounded-full object-cover" style="height: 100px; width: 100px;">

                <h2 class="mt-4 text-sm font-semibold text-gray-700">
                    International Symposium on Digital Forensics and Security
                </h2>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="paper_id" value="{{ __('Paper ID') }}" />
                <x-input id="paper_id"
                         class="block mt-1 w-full"
                         type="number"
                         name="paper_id"
                         min="1"
                         required
                         autocomplete="current-paper_id" />
            </div>
{{--
            <div class="mt-4" x-data="{ showPassword: false }">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password"
                         class="block mt-1 w-full"
                         x-bind:type="showPassword ? 'text' : 'password'"
                         name="password"
                         required
                         autocomplete="new-password" />
                <div class="block mt-2">
                    <label for="show_password_checkbox" class="inline-flex items-center">
                        <x-checkbox id="show_password_checkbox" x-model="showPassword" />
                        <span class="ms-2 text-sm text-gray-600">Şifreyi Göster</span>
                    </label>
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
--}}
            <div class="flex justify-center">
                <x-button class="mt-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

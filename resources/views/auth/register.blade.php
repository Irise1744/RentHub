<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input
                id="name"
                class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input
                id="email"
                class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" class="text-gray-300" />
            <x-text-input
                id="phone"
                class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500"
                type="text"
                name="phone"
                :value="old('phone')"
                required
                autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

            <x-text-input
                id="password"
                class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-orange-500 focus:ring-orange-500"
                type="password"
                name="password"
                required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />

            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full bg-gray-800 border-gray-700 text-white placeholder-gray-500 focus:border-orange-500 focus:ring-orange-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
        </div>

        

        <!-- Actions -->
        <div class="flex flex-col items-end mt-4 gap-3">

            <x-primary-button class="ms-3 bg-gradient-to-r from-blue-600 to-orange-600 hover:from-blue-700 hover:to-orange-700 focus:ring-blue-500 border-transparent">
                {{ __('Register') }}
            </x-primary-button>

            <!-- Login Link -->
            <div class="text-sm text-gray-400">
                {{ __('Already have an account?') }}
                <a class="underline text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-orange-400 hover:from-blue-300 hover:to-orange-300"
                   href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </div>

        </div>
    </form>
</x-guest-layout>
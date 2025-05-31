<x-guest-layout>
   

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            {{-- Label : texte un peu plus contrasté --}}
            <x-input-label for="email" :value="__('Email')" class="text-gray-800 dark:text-gray-200" />

            
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            {{-- Label : texte un peu plus contrasté --}}
            <x-input-label for="password" :value="__('Password')" class="text-gray-800 dark:text-gray-200"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                {{-- Checkbox : couleur du check et du focus ring en bleu-ciel --}}
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-bleu-ciel shadow-sm focus:ring-bleu-ciel dark:focus:ring-bleu-ciel dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Remember me') }}</span> {{-- Texte plus contrasté --}}
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                {{-- Lien "Mot de passe oublié ?" : texte en bleu-ciel, anneau de focus en bleu-ciel --}}
                <a class="underline text-sm text-bleu-ciel hover:text-opacity-80 dark:text-sky-400 dark:hover:text-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bleu-ciel dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
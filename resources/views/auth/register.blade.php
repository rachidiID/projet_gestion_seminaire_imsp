<x-guest-layout>
    <div class="page-container">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- En-tête bleu -->
            <div class="bg-gradient-to-r from-sky-blue-400 to-sky-blue-600 p-6 text-white">
                <h2 class="text-xl font-bold text-center">
                    Créer un compte
                </h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700 mb-1" />
                        <x-text-input id="name" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-blue-500 focus:border-sky-blue-500" 
                                    type="text" 
                                    name="name" 
                                    :value="old('name')" 
                                    required 
                                    autofocus 
                                    autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-1" />
                        <x-text-input id="email" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-blue-500 focus:border-sky-blue-500" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                        <x-text-input id="password" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-blue-500 focus:border-sky-blue-500"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                        <x-text-input id="password_confirmation" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-blue-500 focus:border-sky-blue-500"
                                    type="password"
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Je souhaite m\'inscrire en tant que :')" class="text-gray-800 dark:text-gray-200" />
                        <select id="role" name="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="Étudiant">{{ __('Étudiant') }}</option>
                            <option value="Présentateur">{{ __('Présentateur') }}</option>
                            {{-- Ne pas inclure "Secrétaire" ici pour la sécurité --}}
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                    <!-- Bouton d'inscription -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm text-sky-blue-600 hover:text-sky-blue-500">
                            {{ __('Already registered?') }}
                        </a>
                        <x-primary-button class="px-4 py-2 bg-sky-blue-500 text-white rounded-md hover:bg-sky-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-blue-500 transition-colors">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
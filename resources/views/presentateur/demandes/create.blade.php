<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Soumettre une nouvelle demande de séminaire') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                {{-- En-tête bleu à l'intérieur de la carte --}}
                <div class="bg-gradient-to-r from-sky-400 to-sky-600 p-6 text-white">
                    <h3 class="text-2xl font-bold">Nouvelle Demande</h3>
                    <p class="mt-1 opacity-90">Veuillez remplir les informations ci-dessous.</p>
                </div>

                <form method="POST" action="{{ route('presentateur.demandes.store') }}" class="p-6">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="theme" :value="__('Thème du séminaire')" class="text-gray-800 dark:text-gray-200" />
                        <x-text-input id="theme" class="block mt-1 w-full" type="text" name="theme" :value="old('theme')" required autofocus />
                        <x-input-error :messages="$errors->get('theme')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description / Motivation')" class="text-gray-800 dark:text-gray-200" />
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-bleu-ciel dark:focus:border-sky-500 focus:ring-bleu-ciel dark:focus:ring-sky-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="date_souhaitee" :value="__('Date souhaitée pour la présentation')" class="text-gray-800 dark:text-gray-200" />
                        <x-text-input id="date_souhaitee" class="block mt-1 w-full" type="date" name="date_souhaitee" :value="old('date_souhaitee')" />
                        <x-input-error :messages="$errors->get('date_souhaitee')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Soumettre la demande') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
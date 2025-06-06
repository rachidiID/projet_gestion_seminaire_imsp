<x-app-layout>
<x-slot name="header">
<h2 class="page-container">
Uploader la Présentation Finale pour : <span class="text-bleu-ciel">{{ $seminaire->demande->theme }}</span>
</h2>
</x-slot>

    <div class="page-container">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-sky-400 to-sky-600 p-6 text-white">
                    <h3 class="text-2xl font-bold">Fichier de Présentation Final</h3>
                    <p class="mt-1 opacity-90">Séminaire du {{ $seminaire->date_presentation->format('d/m/Y') }} par {{ $seminaire->demande->user->name }}</p>
                </div>

                <form method="POST" action="{{ route('secretaire.seminaires.presentation.store', $seminaire) }}" enctype="multipart/form-data" class="p-6">
                    @csrf

                    @if ($seminaire->chemin_fichier_presentation)
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-700 rounded-md border border-green-300 dark:border-green-600">
                            <p class="text-sm font-medium text-green-700 dark:text-green-200">Une présentation finale a déjà été soumise :</p>
                            <a href="{{ Storage::url($seminaire->chemin_fichier_presentation) }}" target="_blank" class="text-bleu-ciel hover:underline break-all">
                                {{ basename($seminaire->chemin_fichier_presentation) }}
                            </a>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Soumettre un nouveau fichier remplacera l'actuel.</p>
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <x-input-label for="fichier_presentation" :value="__('Fichier de présentation (PDF, PPT, PPTX - Max 10MB)')" class="text-gray-800 dark:text-gray-200" />
                        <input id="fichier_presentation" class="block mt-1 w-full text-sm text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none focus:border-bleu-ciel dark:focus:border-sky-500 focus:ring-1 focus:ring-bleu-ciel dark:focus:ring-sky-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-bleu-ciel file:text-white
                            hover:file:bg-opacity-80" 
                            type="file" 
                            name="fichier_presentation" 
                            required />
                        <x-input-error :messages="$errors->get('fichier_presentation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('secretaire.seminaires.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline mr-4">
                            {{ __('Annuler') }}
                        </a>
                        <x-primary-button>
                            {{ $seminaire->chemin_fichier_presentation ? __('Mettre à jour la présentation') : __('Soumettre la présentation') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
```
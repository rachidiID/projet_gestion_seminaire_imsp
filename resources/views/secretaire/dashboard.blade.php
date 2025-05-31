<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de Bord Secrétaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">
                        Bienvenue sur votre espace de gestion, {{ Auth::user()->name }} !
                    </p>
                    <p class="mb-2">
                        Vos tâches principales incluent :
                    </p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Consulter et traiter les demandes de séminaires.</li>
                        <li>Publier les séminaires et leurs informations.</li>
                        <li>Gérer les documents (upload/téléchargement).</li>
                        <li>Envoyer des notifications.</li>
                    </ul>
                    <ul class="list-disc list-inside mb-4">
                        <li>
                            <a href="{{ route('secretaire.demandes.index') }}" class="text-bleu-ciel hover:underline font-medium">
                                Gérer les demandes de séminaires
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('secretaire.seminaires.index') }}" class="text-bleu-ciel hover:underline font-medium">
                                    Gérer et Publier les Séminaires 
                                </a>
                        </li>
                        <li>
                            <a href="{{ route('seminaires.disponibles') }}" class="text-bleu-ciel hover:underline font-medium">
                                Consulter les séminaires disponibles
                            </a>
                        </li>
                        <li><span class="text-gray-500 dark:text-gray-400">(Bientôt) Gérer les documents (upload/téléchargement).</span></li>
                        <li><span class="text-gray-500 dark:text-gray-400">(Bientôt) Envoyer des notifications spécifiques.</span></li>

                        {{-- ... autres liens ... --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
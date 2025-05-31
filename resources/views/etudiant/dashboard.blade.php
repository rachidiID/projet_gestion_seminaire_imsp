<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Tableau de Bord de l'Étudiant") }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4">
                        Bienvenue, {{ Auth::user()->name }} !
                    </p>
                    <p class="mb-2">
                        Sur votre tableau de bord, vous pourrez :
                    </p>
                    <ul class="list-disc list-inside mb-4">
                        <li>
                            <a href="{{ route('seminaires.disponibles') }}" class="text-bleu-ciel hover:underline font-medium">
                                Consulter les séminaires disponibles
                            </a>
                        </li>
                        <li><span class="text-gray-500 dark:text-gray-400">(Bientôt) Télécharger les documents des séminaires passés.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
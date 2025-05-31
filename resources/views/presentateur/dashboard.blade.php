<x-app-layout>
    <x-slot name="header">
        <div>
            <i class="fas fa-chalkboard-teacher text-sky-blue-500 text-2xl mr-3"></i> 
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tableau de Bord du Présentateur
            </h2>
        </div>
    </x-slot>

    <div class="page-container">
        <div class="bg-gradient-to-r from-sky-blue-400 to-sky-blue-600 p-6 sm:p-8 text-white">
            <h3 class="text-2xl font-bold">
                Espace Présentateur
            </h3>
            <p class="mt-1 opacity-90">
                Gérez vos demandes de séminaires et suivez leurs avancements.
            </p>

            <div class="mt-6 p-6 sm:p-8 bg-white rounded-xl shadow text-gray-900">
                <p class="mb-4 text-lg">
                    Bienvenue, <span class="font-semibold">{{ Auth::user()->name }}</span> !
                </p>
                <p class="mb-3 text-gray-700">
                    Actions rapides :
                </p>
                <ul class="list-disc list-inside space-y-2 mb-6 pl-4">
                    <li>
                        <a href="{{ route('presentateur.demandes.create') }}" class="text-bleu-ciel hover:underline font-medium">
                            Soumettre une nouvelle demande de séminaire
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('presentateur.demandes.mesDemandes') }}" class="text-bleu-ciel hover:underline font-medium">
                            Voir le statut de vos demandes
                        </a>
                    </li>
                    <li>
                        <span class="text-gray-500">(Bientôt) Consulter les séminaires disponibles.</span>
                    </li>
                    <li>
                        <span class="text-gray-500">(Bientôt) Télécharger des documents.</span>
                    </li>
                    <li>
                        <a href="{{ route('seminaires.disponibles') }}" class="text-bleu-ciel hover:underline font-medium">
                            Consulter les séminaires disponibles
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
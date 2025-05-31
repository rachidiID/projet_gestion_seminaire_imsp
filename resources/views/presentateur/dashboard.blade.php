<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            {{-- Si Font Awesome n'est pas configuré, cette icône n'apparaîtra pas.
                 Vous pouvez la remplacer par un SVG ou la supprimer. --}}
            <i class="fas fa-chalkboard-teacher text-sky-blue-500 text-2xl mr-3"></i> 
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{-- Le titre était bon, mais je l'ai remis sur la même ligne que h2 pour la cohérence --}}
                Tableau de Bord du Présentateur
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                {{-- Assurez-vous que sky-blue-400 et sky-blue-600 sont définis dans votre tailwind.config.js
                     Si vous avez une couleur unique 'bleu-ciel', vous pourriez faire un fond uni : bg-bleu-ciel --}}
                <div class="bg-gradient-to-r from-sky-blue-400 to-sky-blue-600 p-6 sm:p-8 text-white">
                    <h3 class="text-2xl font-bold">
                        Espace Présentateur
                    </h3>
                    <p class="mt-1 opacity-90">
                        Gérez vos demandes de séminaires et suivez leurs avancements.
                    </p>
                </div>

                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">
                    {{-- Le @auth n'est pas strictement nécessaire ici car cette page est déjà protégée par le middleware 'auth' --}}
                    <p class="mb-4 text-lg">
                        Bienvenue, <span class="font-semibold">{{ Auth::user()->name }}</span> !
                    </p>
                    
                    <p class="mb-3 text-gray-700 dark:text-gray-300">
                        Actions rapides :
                    </p>
                    <ul class="list-disc list-inside space-y-2 mb-6 pl-4">
                        <li>
                            {{-- Lien décommenté --}}
                            <a href="{{ route('presentateur.demandes.create') }}" class="text-sky-blue-600 hover:underline font-medium">
                                Soumettre une nouvelle demande de séminaire
                            </a>
                        </li>
                        <li>
                            {{-- Lien décommenté --}}
                            <a href="{{ route('presentateur.demandes.mesDemandes') }}" class="text-sky-blue-600 hover:underline font-medium">
                                Voir le statut de vos demandes
                            </a>
                        </li>
                        <li>
                            <span class="text-gray-500 dark:text-gray-400">(Bientôt) Consulter les séminaires disponibles.</span>
                        </li>
                        <li>
                            <span class="text-gray-500 dark:text-gray-400">(Bientôt) Télécharger des documents.</span>
                        </li>
                        <li>
                            <a href="{{ route('seminaires.disponibles') }}" class="text-bleu-ciel hover:underline font-medium">
                                Consulter les séminaires disponibles
                            </a>
                        </li>
                        <li>
                            <span class="text-gray-500 dark:text-gray-400">(Bientôt) Télécharger des documents.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes Demandes de Séminaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Affichage des messages de session (succès, erreur, info) --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Succès !</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Erreur !</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('info'))
                <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Info :</strong>
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-sky-400 to-sky-600 p-6 sm:p-8 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold">
                                Suivi de vos demandes
                            </h3>
                            <p class="mt-1 opacity-90">
                                Consultez ici l'état de toutes les demandes de séminaire que vous avez soumises.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('presentateur.demandes.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-white text-sky-600 dark:bg-gray-700 dark:text-sky-300 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Nouvelle Demande') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-1"> {{-- Réduit le padding pour que le tableau prenne plus de place --}}
                    @if($demandes->isEmpty())
                        <div class="p-6 text-center text-gray-700 dark:text-gray-300">
                            <p>Vous n'avez soumis aucune demande pour le moment.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Thème</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Soumis le</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date Souhaitée</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date Présentation Validée</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Résumé</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Commentaire Secrétaire</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($demandes as $demande)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                                {{ Str::limit($demande->theme, 40) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $demande->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($demande->statut == 'en_attente')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100">En attente</span>
                                                @elseif ($demande->statut == 'validee')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">Validée</span>
                                                @elseif ($demande->statut == 'refusee')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100">Refusée</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $demande->date_souhaitee ? $demande->date_souhaitee->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $demande->date_presentation_validee ? $demande->date_presentation_validee->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($demande->statut == 'validee' && $demande->seminaire)
                                                    @if ($demande->seminaire->chemin_resume)
                                                        <span class="text-green-600 dark:text-green-400">Soumis</span>
                                                        {{-- Option pour modifier le résumé --}}
                                                        <a href="{{ route('presentateur.resume.edit', $demande->seminaire->id) }}" class="ml-2 text-xs text-blue-500 hover:underline">Modifier</a>
                                                    @else
                                                        {{-- Logique pour vérifier si la soumission est encore possible (ex: 10 jours avant) --}}
                                                        {{-- Carbon\Carbon::now()->diffInDays($demande->seminaire->date_presentation, false) >= 10 --}}
                                                        <a href="{{ route('presentateur.resume.edit', $demande->seminaire->id) }}"
                                                           class="inline-flex items-center px-3 py-1 bg-bleu-ciel border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-bleu-ciel focus:ring-offset-2 transition ease-in-out duration-150">
                                                            Soumettre Résumé
                                                        </a>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                {{ Str::limit($demande->commentaire_secretaire, 50) ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6 px-6 pb-6"> {{-- Ajout de padding pour la pagination --}}
                            {{ $demandes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
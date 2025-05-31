<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Séminaires Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-sky-400 to-sky-600 p-6 sm:p-8 text-white">
                    <h3 class="text-2xl font-bold">Programme des Séminaires</h3>
                    <p class="mt-1 opacity-90">Consultez les séminaires à venir et passés qui ont été publiés.</p>
                </div>

                <div class="p-6">
                    @if($seminairesPublies->isEmpty())
                        <p class="text-gray-700 dark:text-gray-300">Aucun séminaire n'est actuellement publié.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($seminairesPublies as $seminaire)
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                                    <h4 class="text-lg font-semibold text-bleu-ciel dark:text-sky-400">{{ $seminaire->demande->theme }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        Présenté par : {{ $seminaire->demande->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        Date : {{ $seminaire->date_presentation->format('d/m/Y') }}
                                    </p>
                                    @if($seminaire->demande->description)
                                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-200">
                                        <strong>Description :</strong> {{ Str::limit($seminaire->demande->description, 150) }}
                                    </p>
                                    @endif

                                    <div class="mt-3">
                                        @if ($seminaire->chemin_resume)
                                            <a href="{{ Storage::url($seminaire->chemin_resume) }}" target="_blank"
                                               class="text-sm inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md mr-2">
                                                Voir le Résumé
                                            </a>
                                        @endif
                                        @if ($seminaire->chemin_fichier_presentation)
                                            <a href="{{ Storage::url($seminaire->chemin_fichier_presentation) }}" target="_blank"
                                               class="text-sm inline-flex items-center px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-md">
                                                Voir la Présentation
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $seminairesPublies->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="page-container">
            Traitement de la Demande : <span class="text-bleu-ciel">{{ $demande->theme }}</span>
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Détails de la Demande</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Présentateur :</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $demande->user->name }} ({{ $demande->user->email }})</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Thème proposé :</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $demande->theme }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Description :</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100 prose dark:prose-invert max-w-none">
                                {{ $demande->description ?: 'Aucune description fournie.' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Date souhaitée :</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $demande->date_souhaitee ? $demande->date_souhaitee->format('d/m/Y') : 'Non spécifiée' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Statut actuel :</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100 uppercase">{{ $demande->statut }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Soumis le :</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $demande->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </div>
                </div>

                @if ($demande->statut === 'en_attente')
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Valider la Demande</h3>
                        <form method="POST" action="{{ route('secretaire.demandes.valider', $demande) }}">
                            @csrf
                            <div class="mb-4">
                                <x-input-label for="date_presentation_validee" :value="__('Date de Présentation (obligatoire si validation)')" class="text-gray-800 dark:text-gray-200" />
                                <x-text-input id="date_presentation_validee" class="block mt-1 w-full sm:w-1/2" type="date" name="date_presentation_validee" :value="old('date_presentation_validee')" required />
                                <x-input-error :messages="$errors->get('date_presentation_validee')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="commentaire_validation" :value="__('Commentaire (optionnel)')" class="text-gray-800 dark:text-gray-200"/>
                                <textarea id="commentaire_validation" name="commentaire_secretaire" rows="3"
                                          class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-bleu-ciel dark:focus:border-sky-500 focus:ring-bleu-ciel dark:focus:ring-sky-500 rounded-md shadow-sm">{{ old('commentaire_secretaire') }}</textarea>
                            </div>
                            <x-primary-button class="bg-green-500 hover:bg-green-600 focus:ring-green-500">
                                {{ __('Valider cette demande') }}
                            </x-primary-button>
                        </form>
                    </div>

                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Refuser la Demande</h3>
                        <form method="POST" action="{{ route('secretaire.demandes.refuser', $demande) }}">
                            @csrf
                            <div class="mb-4">
                                <x-input-label for="commentaire_refus" :value="__('Motif du refus (optionnel mais recommandé)')" class="text-gray-800 dark:text-gray-200"/>
                                <textarea id="commentaire_refus" name="commentaire_secretaire" rows="3"
                                          class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-bleu-ciel dark:focus:border-sky-500 focus:ring-bleu-ciel dark:focus:ring-sky-500 rounded-md shadow-sm">{{ old('commentaire_secretaire') }}</textarea>
                            </div>
                            <x-primary-button class="bg-red-500 hover:bg-red-600 focus:ring-red-500">
                                {{ __('Refuser cette demande') }}
                            </x-primary-button>
                        </form>
                    </div>
                @else
                    <div class="p-6 text-gray-700 dark:text-gray-300">
                        <p>Cette demande a déjà été traitée (Statut : {{ $demande->statut }}).</p>
                        @if($demande->commentaire_secretaire)
                            <p class="mt-2"><strong>Commentaire :</strong> {{ $demande->commentaire_secretaire }}</p>
                        @endif
                        @if($demande->statut === 'validee' && $demande->date_presentation_validee)
                            <p class="mt-2"><strong>Date de présentation assignée :</strong> {{ $demande->date_presentation_validee->format('d/m/Y') }}</p>
                        @endif
                         <div class="mt-4">
                            <a href="{{ route('secretaire.demandes.index') }}" class="text-bleu-ciel hover:underline">
                                &larr; Retour à la liste des demandes
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
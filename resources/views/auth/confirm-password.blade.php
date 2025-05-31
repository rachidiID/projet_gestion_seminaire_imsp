<x-guest-layout>
    {{-- Le x-guest-layout gère le fond général de la page.
         Nous avons discuté d'un fond blanc ou gris très clair pour le body/conteneur principal.
         Ce layout met souvent une "carte" blanche au centre pour le formulaire. --}}

    <div class="mb-4 text-sm text-gray-700 dark:text-gray-300">
        {{-- J'ai légèrement ajusté la couleur du texte pour un meilleur contraste en mode clair,
             et une suggestion pour le mode sombre si votre thème le supporte.
             La police "Figtree" utilisée par défaut par Breeze est déjà assez moderne. --}}
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            {{-- Le composant x-input-label est généralement bien stylisé par défaut.
                 Vous pouvez le personnaliser dans resources/views/components/input-label.blade.php
                 pour changer la police ou la couleur globalement si besoin.
                 Par exemple, pour un label en bleu-ciel : class="... text-bleu-ciel"
                 Mais généralement, un gris foncé est plus lisible pour les labels. --}}
            <x-input-label for="password" :value="__('Password')" class="text-gray-800 dark:text-gray-200" /> {{-- Rendre le label un peu plus foncé --}}

            {{-- Pour le champ de saisie, le style par défaut de Breeze est sobre.
                 Si vous voulez que le focus (quand on clique dedans) soit bleu-ciel :
                 1. Ouvrez resources/views/components/text-input.blade.php
                 2. Trouvez les classes comme 'focus:border-indigo-500 focus:ring-indigo-500'
                 3. Remplacez 'indigo-500' par 'bleu-ciel' (ou la couleur exacte de votre config Tailwind).
                    Exemple : 'focus:border-bleu-ciel focus:ring-bleu-ciel'
            --}}
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            {{-- Les messages d'erreur sont généralement bien stylisés en rouge par défaut. --}}
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            {{-- Pour les boutons, la meilleure pratique est de modifier le composant :
                 resources/views/components/primary-button.blade.php
                 Remplacez les classes comme 'bg-gray-800' par 'bg-bleu-ciel'
                 et 'hover:bg-gray-700' par une variation de bleu-ciel (ex: 'hover:bg-opacity-80').
                 Le texte du bouton devrait être 'text-white'.

                 Si vous ajoutez les classes directement ici, elles peuvent surcharger ou se combiner
                 avec celles du composant, ce qui peut être moins prévisible.
                 Exemple pour modifier le composant primary-button.blade.php :
                 <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-bleu-ciel border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 focus:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-bleu-ciel focus:ring-offset-2 transition ease-in-out duration-150']) }}>
                    {{ $slot }}
                 </button>
            --}}
            <x-primary-button> {{-- Idéalement, ce bouton prendra le style bleu-ciel/blanc via son composant --}}
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<x-guest-layout>
    {{-- Le layout <x-guest-layout> (resources/views/layouts/guest.blade.php)
         est responsable du fond général de la page et de la "carte" blanche centrée.
         Pour un style global (fond de page, style de la carte, logo/titre),
         c'est ce fichier layout qu'il faudrait prioritairement styler. --}}

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            {{-- Label : texte un peu plus contrasté pour une meilleure lisibilité. --}}
            <x-input-label for="email" :value="__('Email')" class="text-gray-800 dark:text-gray-200" />

            {{-- Champ de saisie (x-text-input) :
                 Pour un style de focus (bordure/anneau au clic) en bleu-ciel,
                 la modification doit se faire dans le composant :
                 resources/views/components/text-input.blade.php.
                 Ex: remplacer les classes focus:border-indigo-500 par focus:border-bleu-ciel
                 et focus:ring-indigo-500 par focus:ring-bleu-ciel. --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            {{-- Label : texte un peu plus contrasté. --}}
            <x-input-label for="password" :value="__('Password')" class="text-gray-800 dark:text-gray-200" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            {{-- Label : texte un peu plus contrasté. --}}
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-800 dark:text-gray-200" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- Bouton Primaire "Reset Password" :
                 Le style de ce bouton (fond bleu-ciel, texte blanc) devrait être défini
                 dans le composant : resources/views/components/primary-button.blade.php.
                 Si ce composant a été mis à jour avec votre thème, le bouton ici
                 adoptera automatiquement ces styles. C'est la méthode recommandée pour
                 assurer la cohérence sur tout le site.
            --}}
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
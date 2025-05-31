<x-guest-layout>
    {{-- Le layout <x-guest-layout> (resources/views/layouts/guest.blade.php) 
         est responsable du fond général de la page et de la "carte" centrée.
         Pour un impact global, c'est ce fichier layout qu'il faudrait principalement styler
         (par exemple, fond de la carte, couleur du titre/logo de l'application). --}}

    <div class="mb-4 text-sm text-gray-700 dark:text-gray-300">
        {{-- J'ai ajusté la couleur du texte pour un meilleur contraste que le text-gray-600 par défaut.
             La police Figtree de Breeze est déjà un bon choix moderne. --}}
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    {{-- Le composant x-auth-session-status affiche les messages de session (par exemple, après l'envoi du lien).
         Son style par défaut (souvent fond vert, texte contrasté) est généralement adapté pour les messages d'état
         et il n'est pas forcément nécessaire de le changer pour correspondre au thème bleu-ciel/blanc,
         sauf si vous le souhaitez spécifiquement. --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            {{-- Pour le label, un gris foncé est souvent préférable pour la lisibilité.
                 Si vous voulez un accent bleu-ciel, vous pourriez ajouter 'text-bleu-ciel' au composant ou ici.
                 Modifier le composant resources/views/components/input-label.blade.php est mieux pour la cohérence. --}}
            <x-input-label for="email" :value="__('Email')" class="text-gray-800 dark:text-gray-200" /> {{-- Rendre le label un peu plus foncé --}}

            {{-- Pour le champ de saisie (x-text-input) :
                 Le style par défaut de Breeze est généralement propre.
                 Pour changer la couleur de focus (bordure/anneau quand on clique dessus) en bleu-ciel,
                 il faut modifier le composant resources/views/components/text-input.blade.php.
                 Recherchez les classes comme 'focus:border-indigo-500 focus:ring-indigo-500'
                 et remplacez par 'focus:border-bleu-ciel focus:ring-bleu-ciel'. --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

            {{-- Les messages d'erreur (x-input-error) sont bien en rouge par défaut. --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- BOUTON PRIMAIRE : C'est ici que votre thème bleu-ciel/blanc sera le plus visible.
                 La MEILLEURE FAÇON est de modifier le composant :
                  fichier: resources/views/components/primary-button.blade.php

                 Dans ce fichier, remplacez la classe de fond existante (ex: bg-gray-800) par 'bg-bleu-ciel'
                 et assurez-vous que le texte est 'text-white'.
                 Exemple de modification pour primary-button.blade.php :
                 <button {{-- ... --
{{-- resources/views/layouts/navigation.blade.php --}}

{{-- Logo ou Nom de l'application en haut de la sidebar --}}
<div class="p-6">
    <a href="{{ route('dashboard') }}">
        {{-- Vous aviez dit "Je ne veux pas de logo, juste une bonne présentation"
             Donc nous utilisons le nom de l'application.
             Le texte est blanc car la sidebar a un fond bleu-ciel.
             Ajustez la taille et la graisse selon vos préférences. --}}
        <h1 class="text-2xl font-semibold text-white hover:text-gray-200 transition-colors">
            {{ config('app.name', 'Gestion Séminaire') }}
        </h1>
    </a>
</div>

<nav class="mt-6 flex-1 px-3 space-y-1">
    {{-- Lien vers le Tableau de Bord principal --}}
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-white hover:bg-sky-700 hover:text-white group flex items-center px-3 py-2 text-sm font-medium rounded-md">
        {{-- Vous pouvez ajouter une icône SVG ici si vous le souhaitez, ex: Heroicons --}}
        {{-- <svg class="mr-3 h-6 w-6 text-sky-300" ...>...</svg> --}}
        {{ __('Dashboard') }}
    </x-nav-link>

    {{-- Ici, nous ajouterons des liens spécifiques aux rôles plus tard --}}
    {{-- Exemple pour un présentateur (à conditionner avec @role) --}}
    @hasrole('Présentateur')
        <x-nav-link :href="route('presentateur.demandes.create')" :active="request()->routeIs('presentateur.demandes.create')"
                    class="text-white hover:bg-sky-700 hover:text-white group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            {{ __('Nouvelle Demande') }}
        </x-nav-link>
        <x-nav-link :href="route('presentateur.demandes.mesDemandes')" :active="request()->routeIs('presentateur.demandes.mesDemandes')"
                    class="text-white hover:bg-sky-700 hover:text-white group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            {{ __('Mes Demandes') }}
        </x-nav-link>
    @endhasrole

    {{-- Exemple pour un secrétaire (à conditionner avec @role) --}}
    {{-- @hasrole('Secrétaire')
        <x-nav-link href="#" :active="request()->routeIs('secretaire.demandes.index')"
                    class="text-white hover:bg-sky-700 hover:text-white group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            {{ __('Gérer les Demandes') }}
        </x-nav-link>
    @endhasrole --}}

    {{-- Vous pouvez ajouter d'autres liens communs ici --}}

</nav>

<div class="mt-auto p-3 border-t border-sky-700 dark:border-sky-500">
    <div class="flex items-center">
        {{-- Peut-être une icône utilisateur ou une image de profil plus tard --}}
        <div class="ml-3">
            <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
            <div class="text-sm font-medium text-sky-200">{{ Auth::user()->email }}</div>
        </div>
    </div>
    <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')" class="text-sky-100 hover:bg-sky-700 hover:text-white">
            {{ __('Mon Profil') }}
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();"
                                class="text-sky-100 hover:bg-sky-700 hover:text-white">
                {{ __('Déconnexion') }}
            </x-responsive-nav-link>
        </form>
    </div>
</div>
<div class="page-container">
    <a href="{{ route('dashboard') }}">
        
        <h1>
            {{ config('app.name', 'Gestion Séminaire') }}
        </h1>
    </a>
</div>

<nav>
    {{-- Lien vers le Tableau de Bord principal --}}
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-white hover:bg-sky-700 hover:text-white group flex items-center px-3 py-2 text-sm font-medium rounded-md">
        {{-- <svg class="mr-3 h-6 w-6 text-sky-300" ...>...</svg> --}}
        {{ __('Dashboard') }}
    </x-nav-link>

    
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

    
    {{-- @hasrole('Secrétaire')
        <x-nav-link href="#" :active="request()->routeIs('secretaire.demandes.index')"
                    class="text-white hover:bg-sky-700 hover:text-white group flex items-center px-3 py-2 text-sm font-medium rounded-md">
            {{ __('Gérer les Demandes') }}
        </x-nav-link>
    @endhasrole --}}

    

</nav>

<div class="page-container">
    <div class="flex items-center">
        <div>
            <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
            <div class="text-sm font-medium text-sky-200">{{ Auth::user()->email }}</div>
        </div>
    </div>
    <div>
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
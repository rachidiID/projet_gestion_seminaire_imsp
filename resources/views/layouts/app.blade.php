<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Styles pour la scrollbar de la sidebar (optionnel) */
            /*
            .sidebar-scroll::-webkit-scrollbar {
                width: 6px;
            }
            .sidebar-scroll::-webkit-scrollbar-thumb {
                background-color: rgba(255,255,255,0.3);
                border-radius: 3px;
            }
            .sidebar-scroll::-webkit-scrollbar-track {
                background: transparent;
            }
            */
        </style>
    </head>
    <body class="font-sans antialiased">
        {{-- La div "page-container" devient le conteneur flex principal --}}
        <div class="page-container min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            
            {{-- Barre Latérale (Sidebar) --}}
            {{-- Assurez-vous que votre couleur 'bleu-ciel' est bien définie dans tailwind.config.js --}}
            <aside class="w-64 bg-bleu-ciel text-white flex flex-col sidebar-scroll overflow-y-auto flex-shrink-0">
                {{-- Le contenu de la navigation (navigation.blade.php) est inclus ici --}}
                @include('layouts.navigation') 
            </aside>

            {{-- Contenu Principal - Modifié pour centrage vertical et horizontal du bloc interne --}}
            <div class="flex-1 flex flex-col justify-center items-center p-4 sm:p-6 lg:p-8 overflow-y-auto" id="main-content-wrapper">
                {{-- Cette div interne permet de contrôler la largeur maximale du contenu et d'être la cible du centrage --}}
                <div class="w-full max-w-7xl"> 
                    
                    {{-- En-tête de la page de contenu (s'il est défini) --}}
                    @isset($header)
                        <header class="bg-white dark:bg-gray-800 shadow {{ $slot->isEmpty() ? 'rounded-lg' : 'rounded-t-lg' }}">
                            <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    {{-- Slot du contenu principal de la page --}}
                    <main class="{{ isset($header) ? 'shadow rounded-b-lg' : 'shadow rounded-lg' }} {{ $slot->isEmpty() && !isset($header) ? 'bg-transparent' : 'bg-gray-50 dark:bg-gray-850' }}">
                        
                        <div class="px-4 sm:px-6 lg:px-8 pt-6 pb-2"> {{-- Container pour les messages flash, avec padding --}}
                            {{-- Affichage des messages Flash --}}
                            @if (session('success'))
                                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                    <strong class="font-bold">Succès !</strong> {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                    <strong class="font-bold">Erreur !</strong> {{ session('error') }}
                                </div>
                            @endif
                            @if (session('info'))
                                <div class="mb-4 p-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                                    <strong class="font-bold">Info :</strong> {{ session('info') }}
                                </div>
                            @endif
                            {{-- Fin de l'affichage des messages Flash --}}
                        </div>
                        
                        {{-- Le $slot est maintenant ici, à l'intérieur de la structure principale --}}
                        <div class="px-4 sm:px-6 lg:px-8 pb-8"> {{-- Ajout de padding pour le contenu du slot --}}
                           {{ $slot }} 
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
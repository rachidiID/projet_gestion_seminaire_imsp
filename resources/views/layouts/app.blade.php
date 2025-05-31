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

        {{-- Ajout de styles pour la scrollbar si nécessaire, ou pour d'autres ajustements --}}
        <style>
            /* Pour une scrollbar un peu plus discrète sur la sidebar si le contenu est long */
            /* Vous pouvez décommenter et personnaliser ces styles si besoin */
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
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            {{-- Barre Latérale (Sidebar) --}}
            {{-- Assurez-vous que votre couleur 'bleu-ciel' est bien définie dans tailwind.config.js --}}
            <aside class="w-64 bg-bleu-ciel text-white flex flex-col sidebar-scroll overflow-y-auto">
                {{-- Le contenu de la navigation (navigation.blade.php) est inclus ici --}}
                @include('layouts.navigation') 
            </aside>

            <div class="flex-1 flex flex-col overflow-hidden">
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-full mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-850">
                    <div class="container mx-auto px-6 py-8">
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

                        {{-- C'est ici que le contenu de dashboard.blade.php, etc. sera injecté --}}
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - {{ config('app.name', 'Gestion Séminaire IMSP') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sky-blue': {
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #64748b;
        }
        .password-strength {
            height: 4px;
            margin-top: 8px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .password-requirements {
            margin-top: 8px;
            font-size: 0.875rem;
            color: #64748b;
        }
        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 4px;
        }
        .requirement i {
            margin-right: 6px;
            font-size: 0.75rem;
        }
        .valid {
            color: #10b981;
        }
        .invalid {
            color: #ef4444;
        }
    </style>
</head>
<body>

    <header>
        <div class="page-container">
            <i class="fas fa-microphone-alt text-sky-blue-500 text-2xl mr-3"></i>
            <h1 class="text-xl font-bold text-sky-blue-600">
                {{ config('app.name', 'Gestion Séminaire IMSP') }}
            </h1>
        </div>
        
        <nav class="page-container">
            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-sky-blue-500 text-white rounded-lg hover:bg-sky-blue-600 transition text-sm sm:text-base">
                   {{ __('Se connecter') }}
                </a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-sm sm:text-base">
                   {{ __('Créer un compte') }}
                </a>
            @endif
        </nav>
    </header>

    <main class="w-full max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-sky-blue-400 to-sky-blue-600 p-6 text-white">
            <h2 class="text-2xl font-bold">
                Bienvenue sur la plateforme de gestion des séminaires de l'IMSP
            </h2>
            <p class="mt-2 opacity-90">
                Cet espace est conçu pour faciliter les demandes et le suivi des séminaires pour tous les utilisateurs : Étudiants, Présentateurs (Enseignants, Administration) et Secrétariat.
            </p>
        </div>
        
        <div class="p-6 text-gray-700">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Commencez dès maintenant !</h3>
            <p class="mb-3">
                Pour accéder à l'ensemble des fonctionnalités, veuillez vous identifier.
            </p>
            <p>
                Si vous n'avez pas encore de compte, la création est simple et rapide. Utilisez les boutons dans l'en-tête pour continuer.
            </p>
            
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h4 class="font-semibold text-gray-700">Fonctionnalités principales :</h4>
                <ul class="list-disc list-inside mt-2 text-sm space-y-1">
                    <li>Soumission et suivi de demandes de séminaire pour les présentateurs.</li>
                    <li>Validation et programmation des séminaires par le secrétariat.</li>
                    <li>Consultation des séminaires à venir et passés.</li>
                    <li>Téléchargement des documents et résumés.</li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="mt-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Gestion Séminaire IMSP') }}. Tous droits réservés.</p>
    </footer>

</body>
</html>
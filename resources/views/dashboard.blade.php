<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion Séminaire IMSP</title>
    
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
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="page-container">
                <div class="flex items-center">
                <i class="fas fa-microphone-alt text-sky-blue-500 text-2xl mr-3"></i>
                <h1 class="text-xl font-bold text-sky-blue-600">
                    Gestion Séminaire IMSP
                </h1>
            </div>
            
            <nav class="flex space-x-4">
                <!-- Vous pouvez ajouter des liens de navigation ici si nécessaire -->
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main>
        <div class="page-container">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-sky-blue-400 to-sky-blue-600 p-6 text-white">
                        <h2 class="text-2xl font-bold">Tableau de bord</h2>
                    </div>
                    
                    <div class="p-6 text-gray-700">
                        <div class="text-lg mb-4">
                            <i class="fas fa-check-circle text-sky-blue-500 mr-2"></i>
                            Vous êtes connecté avec succès !
                        </div>
                        
                        <!-- Vous pouvez ajouter d'autres éléments de tableau de bord ici -->
                         <ul class="list-disc list-inside mb-4">
                            <li><a href="{{ route('secretaire.demandes.index') }}" class="text-bleu-ciel hover:underline font-medium">Gérer les demandes de séminaires</a></li>
                            <li><a href="{{ route('secretaire.seminaires.index') }}" class="text-bleu-ciel hover:underline font-medium">Gérer et Publier les Séminaires</a></li> {{-- <--- NOUVEAU LIEN --}}
                            {{-- ... autres liens ... --}}
                        </ul>
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-sky-blue-50 border border-sky-blue-200 rounded-lg p-4">
                                <h3 class="font-semibold text-sky-blue-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Prochains séminaires
                                </h3>
                                <p class="text-sm text-gray-600">Aucun séminaire programmé</p>
                            </div>
                            
                            <div class="bg-sky-blue-50 border border-sky-blue-200 rounded-lg p-4">
                                <h3 class="font-semibold text-sky-blue-700 mb-2">
                                    <i class="fas fa-tasks mr-2"></i>
                                    Actions requises
                                </h3>
                                <p class="text-sm text-gray-600">Aucune action en attente</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t mt-8 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
            <p>&copy; 2023 Gestion Séminaire IMSP. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
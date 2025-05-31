<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{ __('Gestion et Publication des Séminaires') }}
</h2>
</x-slot>

     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             {{-- Messages de session --}}
             @if (session('success'))
                 <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                     <strong class="font-bold">Succès !</strong> <span class="block sm:inline">{{ session('success') }}</span>
                 </div>
             @endif
             @if (session('error'))
                 <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                     <strong class="font-bold">Erreur !</strong> <span class="block sm:inline">{{ session('error') }}</span>
                 </div>
             @endif
              @if (session('info'))
                 <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                     <strong class="font-bold">Info :</strong> <span class="block sm:inline">{{ session('info') }}</span>
                 </div>
             @endif

             <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                 <div class="bg-gradient-to-r from-sky-400 to-sky-600 p-6 sm:p-8 text-white">
                     <h3 class="text-2xl font-bold">Liste des Séminaires Programmés</h3>
                 </div>

                 <div class="p-1">
                     @if($seminaires->isEmpty())
                         <div class="p-6 text-center text-gray-700 dark:text-gray-300">
                             <p>Aucun séminaire programmé pour le moment.</p>
                         </div>
                     @else
                         <div class="overflow-x-auto">
                             <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                 <thead class="bg-gray-50 dark:bg-gray-700">
                                     <tr>
                                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Thème</th>
                                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Présentateur</th>
                                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date Présentation</th>
                                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Résumé Soumis</th>
                                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                     </tr>
                                 </thead>
                                 <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                     @foreach ($seminaires as $seminaire)
                                         <tr>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($seminaire->demande->theme, 30) }}</td>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $seminaire->demande->user->name }}</td>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $seminaire->date_presentation->format('d/m/Y') }}</td>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                 @if ($seminaire->chemin_resume)
                                                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">Oui</span>
                                                 @else
                                                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100">Non</span>
                                                 @endif
                                             </td>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                 @if ($seminaire->est_publie)
                                                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100">Publié</span>
                                                 @else
                                                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-100">Non Publié</span>
                                                 @endif
                                             </td>
                                             <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                                 @if (!$seminaire->est_publie)
                                                     @if($seminaire->chemin_resume) {{-- Ne peut publier que si le résumé est soumis --}}
                                                         <form action="{{ route('secretaire.seminaires.publier', $seminaire) }}" method="POST" class="inline">
                                                             @csrf
                                                             <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">Publier</button>
                                                         </form>
                                                     @else
                                                          <span class="text-xs text-gray-400 italic">Résumé manquant</span>
                                                     @endif
                                                 @else
                                                     <form action="{{ route('secretaire.seminaires.depublier', $seminaire) }}" method="POST" class="inline">
                                                         @csrf
                                                         <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Dépublier</button>
                                                     </form>
                                                 @endif
                                                  {{-- Lien pour uploader le fichier de présentation final (à faire plus tard) --}}
                                                 {{-- <a href="#" class="text-indigo-600 hover:text-indigo-900">Gérer Fichiers</a> --}}
                                                 <a href="{{ route('secretaire.seminaires.presentation.upload.form', $seminaire) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Gérer Présentation
                                                </a>

                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                         <div class="mt-6 px-6 pb-6">
                             {{ $seminaires->links() }}
                         </div>
                     @endif
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
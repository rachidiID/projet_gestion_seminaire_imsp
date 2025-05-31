<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// Contrôleurs de Tableau de Bord
use App\Http\Controllers\Etudiant\DashboardController as EtudiantDashboardController;
use App\Http\Controllers\Presentateur\DashboardController as PresentateurDashboardController;
use App\Http\Controllers\Secretaire\DashboardController as SecretaireDashboardController;
// Contrôleurs spécifiques aux rôles
use App\Http\Controllers\Presentateur\DemandeController as PresentateurDemandeController;
use App\Http\Controllers\Presentateur\ResumeController as PresentateurResumeController;
use App\Http\Controllers\Secretaire\DemandeGestionController;
use App\Http\Controllers\Secretaire\SeminaireGestionController as SecretaireSeminaireGestionController; // Alias pour éviter confusion
// Contrôleur pour les séminaires publics/disponibles
use App\Http\Controllers\SeminairePublicController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route principale du tableau de bord qui redirige en fonction du rôle
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('Étudiant')) {
            return app(EtudiantDashboardController::class)->callAction('index', []);
        } elseif ($user->hasRole('Présentateur')) {
            return app(PresentateurDashboardController::class)->callAction('index', []);
        } elseif ($user->hasRole('Secrétaire')) {
            return app(SecretaireDashboardController::class)->callAction('index', []);
        }
        return view('dashboard'); // Fallback
    })->name('dashboard');

    // Routes pour le profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Route pour voir les Séminaires Disponibles (accessible à tous les rôles connectés) ---
    Route::get('/seminaires-disponibles', [SeminairePublicController::class, 'index'])->name('seminaires.disponibles');


    // --- Routes spécifiques au rôle Présentateur ---
    Route::middleware('role:Présentateur')->prefix('presentateur')->name('presentateur.')->group(function () {
        // Demandes du présentateur
        Route::get('/demandes/creer', [PresentateurDemandeController::class, 'create'])->name('demandes.create');
        Route::post('/demandes', [PresentateurDemandeController::class, 'store'])->name('demandes.store');
        Route::get('/mes-demandes', [PresentateurDemandeController::class, 'mesDemandes'])->name('demandes.mesDemandes');
        
        // Gestion des résumés par le présentateur
        Route::get('/seminaires/{seminaire}/resume/edit', [PresentateurResumeController::class, 'edit'])->name('resume.edit');
        Route::post('/seminaires/{seminaire}/resume', [PresentateurResumeController::class, 'store'])->name('resume.store');
    });

    // --- Routes spécifiques au rôle Secrétaire ---
    Route::middleware('role:Secrétaire')->prefix('secretaire')->name('secretaire.')->group(function () {
        // Gestion des demandes par la secrétaire
        Route::get('/demandes', [DemandeGestionController::class, 'index'])->name('demandes.index');
        Route::get('/demandes/{demande}/edit', [DemandeGestionController::class, 'edit'])->name('demandes.edit');
        Route::post('/demandes/{demande}/valider', [DemandeGestionController::class, 'valider'])->name('demandes.valider');
        Route::post('/demandes/{demande}/refuser', [DemandeGestionController::class, 'refuser'])->name('demandes.refuser');
        
        // Gestion des séminaires par la secrétaire
        Route::get('/seminaires', [SecretaireSeminaireGestionController::class, 'index'])->name('seminaires.index');
        Route::post('/seminaires/{seminaire}/publier', [SecretaireSeminaireGestionController::class, 'publier'])->name('seminaires.publier');
        Route::post('/seminaires/{seminaire}/depublier', [SecretaireSeminaireGestionController::class, 'depublier'])->name('seminaires.depublier');
        Route::get('/seminaires/{seminaire}/presentation/upload', [App\Http\Controllers\Secretaire\SeminaireGestionController::class, 'showUploadPresentationForm'])->name('seminaires.presentation.upload.form');
        Route::post('/seminaires/{seminaire}/presentation/upload', [App\Http\Controllers\Secretaire\SeminaireGestionController::class, 'storePresentation'])->name('seminaires.presentation.store');
    });

    // --- Routes spécifiques au rôle Étudiant ---
    // Route::middleware('role:Étudiant')->prefix('etudiant')->name('etudiant.')->group(function () {
    //     // Par exemple, si les étudiants ont des actions spécifiques autres que voir les séminaires disponibles
    // });

});

require __DIR__.'/auth.php';

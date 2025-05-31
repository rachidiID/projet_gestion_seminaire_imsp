<?php

namespace App\Http\Controllers\Presentateur; // Assurez-vous que le namespace est correct

use App\Http\Controllers\Controller;
use App\Models\Demande; // Importez votre modèle Demande
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pour obtenir l'utilisateur connecté

class DemandeController extends Controller
{
    /**
     * Affiche le formulaire de création d'une nouvelle demande de séminaire.
     */
    public function create()
    {
        // Cette méthode retourne la vue Blade pour le formulaire
        return view('presentateur.demandes.create');
    }

    /**
     * Enregistre une nouvelle demande de séminaire dans la base de données.
     */
    public function store(Request $request)
    {
        // 1. Valider les données du formulaire
        $validatedData = $request->validate([
            'theme' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_souhaitee' => 'nullable|date|after_or_equal:today', // La date doit être aujourd'hui ou dans le futur
        ]);

        // 2. Créer la demande en l'associant à l'utilisateur connecté (le présentateur)
        Auth::user()->demandes()->create([
            'theme' => $validatedData['theme'],
            'description' => $validatedData['description'],
            'date_souhaitee' => $validatedData['date_souhaitee'],
            'statut' => 'en_attente', // Statut initial d'une demande
        ]);

        // 3. Rediriger l'utilisateur avec un message de succès
        // Idéalement vers la page "Mes Demandes" ou le tableau de bord
        return redirect()->route('presentateur.demandes.mesDemandes') // Assurez-vous que cette route existera
                         ->with('success', 'Votre demande de séminaire a été soumise avec succès !');
    }

    /**
     * Affiche les demandes de séminaire soumises par le présentateur connecté.
     */
    public function mesDemandes()
    {
        $demandes = Auth::user()->demandes()->orderBy('created_at', 'desc')->paginate(10); // Paginer pour de longues listes
        return view('presentateur.demandes.mes_demandes', compact('demandes'));
    }
}
<?php

namespace App\Http\Controllers\Presentateur;

use App\Http\Controllers\Controller;
use App\Models\Seminaire; // Importez le modèle Seminaire
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Importez la façade Storage pour la gestion des fichiers

class ResumeController extends Controller
{
    /**
     * Affiche le formulaire pour soumettre ou modifier le résumé d'un séminaire.
     */
    public function edit(Seminaire $seminaire)
    {
        // Vérifier que l'utilisateur authentifié est bien le présentateur de ce séminaire
        // La demande est liée au séminaire, et la demande est liée à l'utilisateur.
        if (Auth::id() !== $seminaire->demande->user_id) {
            abort(403, 'Action non autorisée.');
        }

        return view('presentateur.resumes.edit', compact('seminaire'));
    }

    /**
     * Stocke le résumé soumis pour un séminaire.
     */
    public function store(Request $request, Seminaire $seminaire)
    {
        // Vérifier que l'utilisateur authentifié est bien le présentateur
        if (Auth::id() !== $seminaire->demande->user_id) {
            abort(403, 'Action non autorisée.');
        }

        // Valider le fichier et les autres champs si nécessaire
        $request->validate([
            'resume_file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:5120', // Max 5MB, types de fichiers autorisés
        ]);

        if ($request->hasFile('resume_file')) {
            // Supprimer l'ancien résumé s'il existe
            if ($seminaire->chemin_resume) {
                Storage::disk('public')->delete($seminaire->chemin_resume);
            }

            // Stocker le nouveau fichier dans storage/app/public/resumes
            // Le nom du fichier sera généré de manière unique par Laravel
            $path = $request->file('resume_file')->store('resumes', 'public');

            // Mettre à jour le chemin du résumé dans la base de données
            $seminaire->chemin_resume = $path;
            $seminaire->save();

            return redirect()->route('presentateur.demandes.mesDemandes')
                             ->with('success', 'Résumé soumis avec succès pour le séminaire : ' . $seminaire->demande->theme);
        }

        return redirect()->back()->with('error', 'Aucun fichier n\'a été soumis ou une erreur est survenue.');
    }
}
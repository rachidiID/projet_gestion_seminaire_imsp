<?php

namespace App\Http\Controllers\Secretaire;

use App\Http\Controllers\Controller;
use App\Models\Seminaire; // Importez le modèle Seminaire
use App\Models\User; // Importez le modèle User pour récupérer les étudiants
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NouveauSeminairePublieNotification; // Nous créerons cette notification
use Illuminate\Support\Facades\Storage;

class SeminaireGestionController extends Controller
{
    /**
     * Affiche la liste des séminaires à gérer.
     */
    public function index()
    {
        // Récupérer tous les séminaires, ou ceux qui ne sont pas encore passés, etc.
        // Charger la demande associée et l'utilisateur (présentateur) via la demande
        $seminaires = Seminaire::with('demande.user') 
                            ->orderBy('date_presentation', 'desc')
                            ->paginate(10);

        return view('secretaire.seminaires.index', compact('seminaires'));
    }

    /**
     * Publie un séminaire.
     */
    public function publier(Request $request, Seminaire $seminaire)
    {
        if ($seminaire->est_publie) {
            return redirect()->route('secretaire.seminaires.index')->with('info', 'Ce séminaire est déjà publié.');
        }

        // Valider que le résumé a été soumis si c'est une condition pour publier
        if (empty($seminaire->chemin_resume)) {
            return redirect()->route('secretaire.seminaires.index')->with('error', 'Le résumé doit être soumis avant de pouvoir publier ce séminaire.');
        }

        $seminaire->est_publie = true;
        $seminaire->save();

        // Envoyer une notification aux étudiants
        $etudiants = User::role('Étudiant')->get();
        if ($etudiants->isNotEmpty()) {
            Notification::send($etudiants, new NouveauSeminairePublieNotification($seminaire));
        }

        return redirect()->route('secretaire.seminaires.index')->with('success', 'Le séminaire "' . $seminaire->demande->theme . '" a été publié et les étudiants ont été notifiés.');
    }

    /**
     * Dépublie un séminaire (optionnel).
     */
    public function depublier(Request $request, Seminaire $seminaire)
    {
        if (!$seminaire->est_publie) {
            return redirect()->route('secretaire.seminaires.index')->with('info', 'Ce séminaire n\'est pas actuellement publié.');
        }

        $seminaire->est_publie = false;
        $seminaire->save();

        // Vous pourriez aussi envoyer une notification d'annulation/dépublication si nécessaire

        return redirect()->route('secretaire.seminaires.index')->with('success', 'Le séminaire "' . $seminaire->demande->theme . '" a été dépublié.');
    }
    // Nous ajouterons plus tard la gestion de l'upload du fichier de présentation final
    public function showUploadPresentationForm(Seminaire $seminaire) // <--- NOUVELLE MÉTHODE
    {
        return view('secretaire.seminaires.upload_presentation', compact('seminaire'));
    }

    /**
     * Stocke le fichier de présentation final pour un séminaire.
     */
    public function storePresentation(Request $request, Seminaire $seminaire) // <--- NOUVELLE MÉTHODE
    {
        $request->validate([
            'fichier_presentation' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // Max 10MB, ajustez selon vos besoins
        ]);

        if ($request->hasFile('fichier_presentation')) {
            // Supprimer l'ancienne présentation si elle existe
            if ($seminaire->chemin_fichier_presentation) {
                Storage::disk('public')->delete($seminaire->chemin_fichier_presentation);
            }

            // Stocker le nouveau fichier dans storage/app/public/presentations
            $path = $request->file('fichier_presentation')->store('presentations', 'public');

            // Mettre à jour le chemin dans la base de données
            $seminaire->chemin_fichier_presentation = $path;
            $seminaire->save();

            return redirect()->route('secretaire.seminaires.index')
                             ->with('success', 'Fichier de présentation final soumis avec succès pour : ' . $seminaire->demande->theme);
        }

        return redirect()->back()->with('error', 'Aucun fichier n\'a été soumis ou une erreur est survenue.');
    }
}
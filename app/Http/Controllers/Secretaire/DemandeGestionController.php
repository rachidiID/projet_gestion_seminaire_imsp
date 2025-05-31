<?php

namespace App\Http\Controllers\Secretaire;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Seminaire; // <-- Ajoutez l'import pour le modèle Seminaire
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification; // <-- Ajoutez l'import pour les Notifications
use App\Notifications\DemandeValideeNotification; // <-- Nous créerons cette notification bientôt

class DemandeGestionController extends Controller
{
    // ... (votre méthode index() et edit() existantes) ...
    public function index() // <--- C'EST CETTE MÉTHODE QUI DOIT EXISTER
    {
        // Récupérer les demandes en attente, ou toutes avec pagination
        $demandesEnAttente = Demande::where('statut', 'en_attente')
                                 ->with('user') // Charger la relation avec l'utilisateur (présentateur)
                                 ->orderBy('created_at', 'asc')
                                 ->paginate(10);

        // Vous pourriez aussi vouloir voir d'autres demandes (validées, refusées)
        // $autresDemandes = Demande::whereIn('statut', ['validee', 'refusee'])
        //                         ->with('user')
        //                         ->orderBy('updated_at', 'desc')
        //                         ->paginate(10);

        // Assurez-vous que la vue 'secretaire.demandes.index' existe bien
        // (resources/views/secretaire/demandes/index.blade.php)
        return view('secretaire.demandes.index', compact('demandesEnAttente'));
        // Si vous ajoutez $autresDemandes, passez-les aussi avec compact()
    }

    public function edit(Demande $demande)
    {
        return view('secretaire.demandes.edit', compact('demande'));
    }

    /**
     * Valide une demande de séminaire.
     */
    public function valider(Request $request, Demande $demande) // <--- AJOUTEZ CETTE MÉTHODE
    {
        // 1. S'assurer que la demande est bien "en attente" avant de la valider
        if ($demande->statut !== 'en_attente') {
            return redirect()->route('secretaire.demandes.edit', $demande)->with('error', 'Cette demande a déjà été traitée.');
        }

        // 2. Valider les données du formulaire de validation
        $validatedData = $request->validate([
            'date_presentation_validee' => 'required|date|after_or_equal:today',
            'commentaire_secretaire' => 'nullable|string',
        ]);

        // 3. Mettre à jour la demande
        $demande->statut = 'validee';
        $demande->date_presentation_validee = $validatedData['date_presentation_validee'];
        $demande->commentaire_secretaire = $validatedData['commentaire_secretaire'];
        $demande->save();

        // 4. Créer un nouvel enregistrement dans la table 'seminaires'
        Seminaire::create([
            'demande_id' => $demande->id,
            // 'user_id' => $demande->user_id, // Si vous avez dénormalisé user_id et theme dans seminaires
            // 'theme' => $demande->theme,    // Sinon, ils sont accessibles via la relation $seminaire->demande->user et $seminaire->demande->theme
            'date_presentation' => $demande->date_presentation_validee,
            'est_publie' => false, // Ne sera publié que plus tard par la secrétaire
        ]);

        // 5. Envoyer une notification par e-mail au présentateur
        // Assurez-vous que votre modèle User a bien le trait Notifiable
        // use Illuminate\Notifications\Notifiable; dans App\Models\User
        $demandeur = $demande->user; // Récupère l'utilisateur qui a fait la demande
        Notification::send($demandeur, new DemandeValideeNotification($demande));

        // 6. Rediriger avec un message de succès
        return redirect()->route('secretaire.demandes.index')->with('success', 'La demande de séminaire pour "' . $demande->theme . '" a été validée avec succès.');
    }

    public function refuser(Request $request, Demande $demande) // <--- AJOUTEZ CETTE MÉTHODE
        {
            // 1. S'assurer que la demande est bien "en attente"
            if ($demande->statut !== 'en_attente') {
                return redirect()->route('secretaire.demandes.edit', $demande)->with('error', 'Cette demande a déjà été traitée.');
            }

            // 2. Valider (optionnel, pour le commentaire)
            $validatedData = $request->validate([
                'commentaire_secretaire' => 'nullable|string',
            ]);

            // 3. Mettre à jour la demande
            $demande->statut = 'refusee';
            $demande->commentaire_secretaire = $validatedData['commentaire_secretaire'];
            $demande->save();

            // 4. (Optionnel) Envoyer une notification par e-mail au présentateur
            // Vous pourriez créer une DemandeRefuseeNotification similaire à DemandeValideeNotification
            // $demandeur = $demande->user;
            // Notification::send($demandeur, new DemandeRefuseeNotification($demande));

            // 5. Rediriger avec un message de succès/information
            return redirect()->route('secretaire.demandes.index')->with('info', 'La demande de séminaire pour "' . $demande->theme . '" a été refusée.');
        }
}
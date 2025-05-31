<?php

namespace App\Http\Controllers; // Assurez-vous que le namespace est correct

use App\Models\Seminaire;
use Illuminate\Http\Request;
// Si vous utilisez le type de retour View, importez-le :
// use Illuminate\Contracts\View\View; 

class SeminairePublicController extends Controller // Assurez-vous qu'il étend Controller
{
    /**
     * Affiche la liste des séminaires publiés.
     */
    public function index() // Ou public function index(): View
    {
        $seminairesPublies = Seminaire::where('est_publie', true)
                                      ->with('demande.user') 
                                      ->orderBy('date_presentation', 'desc')
                                      ->paginate(10);

        return view('seminaires.disponibles', compact('seminairesPublies'));
    }
}
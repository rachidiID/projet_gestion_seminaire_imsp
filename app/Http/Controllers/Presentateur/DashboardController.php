<?php

namespace App\Http\Controllers\Presentateur;

use App\Http\Controllers\Controller; // <--- VÉRIFIEZ CET IMPORT
use Illuminate\Http\Request; // Vous pourriez en avoir besoin plus tard
// Ajoutez d'autres imports si nécessaire, par exemple pour vos modèles

class DashboardController extends Controller 
{
    /**
     * Affiche le tableau de bord du présentateur.
     */
   public function index()
    {
        return view('presentateur.dashboard');
    }
}
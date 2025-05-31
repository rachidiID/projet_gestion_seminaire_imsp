<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller; // Assurez-vous que cette ligne est présente
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord de l'étudiant.
     */
    public function index()
    {
        return view('etudiant.dashboard');
    }
}
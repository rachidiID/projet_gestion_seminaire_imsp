<?php

namespace App\Http\Controllers\Secretaire;

use App\Http\Controllers\Controller; // Assurez-vous que cette ligne est présente
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord de la secrétaire.
     */
    public function index()
    {
        return view('secretaire.dashboard');
    }
}
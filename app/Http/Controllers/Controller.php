<?php

namespace App\Http\Controllers; // <--- VÉRIFIEZ SOIGNEUSEMENT CETTE LIGNE (surtout la ligne 3 si elle est différente)

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests; // Ou une autre combinaison de traits par défaut
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests; // Ou une autre combinaison
}
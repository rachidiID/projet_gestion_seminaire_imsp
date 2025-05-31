<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View; // <--- AJOUTEZ OU VÉRIFIEZ CETTE LIGNE (ou use Illuminate\View\View;)

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Validation pour le rôle : requis, doit être une chaîne,
            // et doit être l'une des valeurs autorisées ('Étudiant' ou 'Présentateur')
            'role' => ['required', 'string', Rule::in(['Étudiant', 'Présentateur'])], // <--- AJOUTEZ CETTE LIGNE DE VALIDATION
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assignation du rôle sélectionné par l'utilisateur
        $user->assignRole($request->role); // <--- MODIFIEZ/AJOUTEZ CETTE LIGNE

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

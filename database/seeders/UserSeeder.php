<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Assurez-vous que le chemin vers votre modèle User est correct
use Spatie\Permission\Models\Role; // Importez la classe Role
use Illuminate\Support\Facades\Hash; // Pour hacher les mots de passe

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur Secrétaire
        $secretaire = User::firstOrCreate(
            ['email' => 'secretaire@example.com'],
            [
                'name' => 'Harrisson',
                'password' => Hash::make('p@ssword'), // Changez 'password' par un mot de passe sécurisé
            ]
        );
        $secretaire->assignRole('Secrétaire');

        // Créer un utilisateur Présentateur
        $presentateur = User::firstOrCreate(
            ['email' => 'presentateur@example.com'],
            [
                'name' => 'Sanda',
                'password' => Hash::make('p@ssword'), // Changez 'password'
            ]
        );
        $presentateur->assignRole('Présentateur');

        // Créer un utilisateur Étudiant
        $etudiant = User::firstOrCreate(
            ['email' => 'etudiant@example.com'],
            [
                'name' => 'Rachidi',
                'password' => Hash::make('p@ssword'), // Changez 'password'
            ]
        );
        $etudiant->assignRole('Étudiant');

        // Vous pouvez ajouter d'autres utilisateurs si nécessaire
        // User::factory(5)->create()->each(function ($user) {
        //     $user->assignRole('Étudiant');
        // });
    }
}
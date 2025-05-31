<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// Si vous aviez décommenté la création de permissions et ajouté cet import,
// et que vous souhaitez toujours créer la permission ici, laissez-le.
// Sinon, vous pouvez le supprimer si les lignes de permission sont commentées.
// use Spatie\Permission\Models\Permission; 

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utilisation de firstOrCreate pour éviter les erreurs si les rôles existent déjà
        Role::firstOrCreate(['name' => 'Secrétaire']);
        Role::firstOrCreate(['name' => 'Présentateur']);
        Role::firstOrCreate(['name' => 'Étudiant']);

        // Si vous aviez décommenté la création de permissions :
        // Assurez-vous que les lignes ci-dessous sont toujours commentées si vous
        // ne gérez pas les permissions dans CE seeder pour l'instant.
        // Ou, si vous les gardez, utilisez aussi firstOrCreate pour la permission :
        // $permission = Permission::firstOrCreate(['name' => 'valider demandes']);
        // $roleSecretaire = Role::findByName('Secrétaire');
        // if ($roleSecretaire && $permission) { // Vérifier que le rôle et la permission existent
        //     $roleSecretaire->givePermissionTo($permission);
        // }
    }
}
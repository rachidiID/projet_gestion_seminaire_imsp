<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Vous avez déjà ajouté ça

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // HasRoles est déjà là

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Obtenir les demandes de séminaire soumises par cet utilisateur (s'il est présentateur).
     */
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    /**
     * Obtenir les séminaires directement liés à cet utilisateur (si pertinent,
     * sinon, on passera souvent par la table 'demandes').
     * Par exemple, si un utilisateur peut être marqué comme "présentateur confirmé" sur un séminaire.
     * Pour l'instant, la relation via 'demandes' est plus directe pour le flux décrit.
     */
    // public function seminaires()
    // {
    //     return $this->hasMany(Seminaire::class); // Si vous avez un user_id direct sur la table seminaires
    // }
}
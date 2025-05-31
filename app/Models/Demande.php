<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés massivement.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'theme',
        'description',
        'statut', // Ex: 'en_attente', 'validee', 'refusee'
        'date_souhaitee',
        'date_presentation_validee', // Sera mis à jour par la secrétaire
        'commentaire_secretaire',    // Sera mis à jour par la secrétaire
    ];

    /**
     * Les attributs à caster vers des types natifs.
     *
     * @var array
     */
    protected $casts = [
        'date_souhaitee' => 'date',
        'date_presentation_validee' => 'date',
    ];

    /**
     * Obtenir l'utilisateur (présentateur) qui a fait la demande.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir le séminaire qui pourrait résulter de cette demande (si elle est validée).
     */
    public function seminaire()
    {
        return $this->hasOne(Seminaire::class);
    }
}
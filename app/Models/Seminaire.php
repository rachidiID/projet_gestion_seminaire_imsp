<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminaire extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés massivement.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'demande_id', // Lié à la demande d'origine
        'date_presentation',
        'chemin_resume',             // Peut-être géré via la table Documents plus tard
        'chemin_fichier_presentation', // Peut-être géré via la table Documents plus tard
        'est_publie',
    ];

    /**
     * Les attributs à caster vers des types natifs.
     *
     * @var array
     */
    protected $casts = [
        'date_presentation' => 'date',
        'est_publie' => 'boolean',
    ];

    /**
     * Obtenir la demande d'origine pour ce séminaire.
     */
    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }

    /**
     * Obtenir tous les documents associés à ce séminaire.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Raccourci pour obtenir le présentateur du séminaire via la demande.
     */
    public function presentateur()
    {
        // Suppose que la relation 'demande' et 'user' sur demande sont bien définies
        return $this->demande->user();
    }
}
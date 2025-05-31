<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés massivement.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'seminaire_id',
        'type_document', // Ex: 'resume', 'presentation_finale', 'autre'
        'nom_fichier_original',
        'chemin_stockage',
        'mime_type',
        'taille_fichier',
    ];

    /**
     * Les attributs à caster vers des types natifs.
     *
     * @var array
     */
    protected $casts = [
        'taille_fichier' => 'integer',
    ];

    /**
     * Obtenir le séminaire auquel ce document est associé.
     */
    public function seminaire()
    {
        return $this->belongsTo(Seminaire::class);
    }
}
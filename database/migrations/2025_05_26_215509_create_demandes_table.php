<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Qui a fait la demande (lien vers la table users)
            $table->string('theme'); // Le thème du séminaire [cite: 3]
            $table->text('description')->nullable(); // Une description plus détaillée ou motivation
            $table->enum('statut', ['en_attente', 'validee', 'refusee'])->default('en_attente'); // Statut de la demande
            $table->date('date_souhaitee')->nullable(); // Date souhaitée par le présentateur
            $table->date('date_presentation_validee')->nullable(); // Date de présentation si validée par la secrétaire [cite: 4]
            $table->text('commentaire_secretaire')->nullable(); // Commentaire de la secrétaire
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
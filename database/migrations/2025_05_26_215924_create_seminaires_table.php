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
        Schema::create('seminaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->unique()->constrained('demandes')->onDelete('cascade'); // Lien unique vers la demande validée
            // Les informations comme user_id (présentateur) et theme peuvent être récupérées via la relation avec 'demandes'
            // Mais si vous voulez les dénormaliser pour un accès plus direct :
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->string('theme');
            $table->date('date_presentation'); // Date de présentation effective
            $table->string('chemin_resume')->nullable(); // Chemin vers le fichier du résumé
            $table->string('chemin_fichier_presentation')->nullable(); // Chemin vers le fichier de la présentation finale
            $table->boolean('est_publie')->default(false); // Si le séminaire est publié par la secrétaire
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminaires');
    }
};
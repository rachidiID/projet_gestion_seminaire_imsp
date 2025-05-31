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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminaire_id')->constrained('seminaires')->onDelete('cascade'); // Lien vers le séminaire
            $table->string('type_document')->comment("Ex: 'resume', 'presentation_finale', 'autre'"); // Type de document
            $table->string('nom_fichier_original'); // Nom du fichier tel qu'uploadé par l'utilisateur
            $table->string('chemin_stockage'); // Chemin où le fichier est stocké sur le serveur (ex: 'documents/seminaire_1/resume.pdf')
            $table->string('mime_type')->nullable(); // Type MIME du fichier
            $table->unsignedBigInteger('taille_fichier')->nullable(); // Taille du fichier en octets
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
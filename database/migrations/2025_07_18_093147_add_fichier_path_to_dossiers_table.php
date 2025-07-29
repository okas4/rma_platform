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
      Schema::table('dossiers', function (Blueprint $table) {
    $table->string('fichier_path')->nullable();
});
        // Ajout de la colonne fichier_path à la table dossiers
        // Cette colonne est nullable pour permettre aux dossiers existants de ne pas avoir de fichier associé
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossiers', function (Blueprint $table) {
            //
        });
    }
};

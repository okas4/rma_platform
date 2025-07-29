<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id(); // Identifiant unique

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->string('statut')->default('Reçu'); // Exemple : Reçu, Validé, Refusé
            $table->text('motif_refus')->nullable();

            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};

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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id(); // Champ ID auto-incrémenté
            $table->decimal('montant_total', 15, 2)->default(0); // Total montant
            $table->decimal('depot_total', 15, 2)->default(0); // Total dépôt
            $table->decimal('retrait_total', 15, 2)->default(0); // Total retrait
            $table->foreignId('user_id')->constrained('users'); // Référence à l'utilisateur

            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};

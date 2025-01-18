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
        Schema::create('epargnes', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id'); // Référence à l'utilisateur
            // $table->decimal('montant', 10, 2); // Montant épargné
            $table->string('nom'); // Durée de l'épargne en jours
            $table->integer('duree'); // Durée de l'épargne en jours
            $table->decimal('rendement', 5, 2); // Taux de rendement
            // $table->decimal('revenu_total', 10, 2); // Revenu total d'épargne
            $table->string('statut'); // Statut (en cours, terminé)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('epargnes');
    }
};

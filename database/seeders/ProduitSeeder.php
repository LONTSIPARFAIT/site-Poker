<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // N'oubliez pas d'importer Carbon

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now(); // Obtenir la date et l'heure actuelles

        DB::table('produits')->insert([
            [
                'name' => 'T-Cash A',
                'montant' => 1000.00,
                'nbjour' => 30,
                'stock' => 100,
                'gainJ' => 20,
                'rendement' => 5,
                'created_at' => $now, // Ajouter la date de création
                'updated_at' => $now, // Ajouter la date de mise à jour
            ],
            [
                'name' => 'T-Cash B',
                'montant' => 1500.00,
                'nbjour' => 45,
                'stock' => 50,
                'gainJ' => 30,
                'rendement' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash C',
                'montant' => 2000.00,
                'nbjour' => 60,
                'stock' => 0,  // Épuisé
                'gainJ' => 40,
                'rendement' => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash D',
                'montant' => 2500.00,
                'nbjour' => 90,
                'stock' => 20,
                'gainJ' => 50,
                'rendement' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
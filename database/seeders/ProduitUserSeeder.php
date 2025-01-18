<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Produit;

class ProduitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Récupérer des utilisateurs et des produits
        $users = User::all();
        $produits = Produit::all();

        // Vérifier qu'il y a des utilisateurs et des produits
        if ($users->isEmpty() || $produits->isEmpty()) {
            $this->command->info('Aucun utilisateur ou produit trouvé. Assurez-vous d\'avoir des données dans les tables User et Produit.');
            return;
        }

        // Créer 5 entrées pour la table produit_user
        for ($i = 0; $i < 5; $i++) {
            // Date de création unique en ajoutant une se   conde basée sur l'index
            $createdAt = now()->subDays(rand(0, 30))->addSeconds($i);
            $i=$i+3;
            // Insérer dans la table produit_user
            DB::table('produit_user')->insert([
                'user_id' => 3, // Utilisateur fixe
                'produit_id' => $produits->random()->id, // ID de produit aléatoire
                'gagner' => rand(1000, 5000), // Montant aléatoire gagné
                'duration' => now()->subHours(rand(1, 72)), // Durée aléatoire
                'count' => rand(1, 10), // Quantité aléatoire
                'last_incremented_at' => now(), // Dernier incrément aléatoire
                'created_at' => $createdAt, // Date de création unique
                'updated_at' => now(),
            ]);
        }
    }
}
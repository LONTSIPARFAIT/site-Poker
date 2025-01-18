<?php

namespace Database\Factories;

use App\Models\Compte;
use App\Models\User;
use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompteFactory extends Factory
{
    /**
     * Le nom du modèle correspondant.
     *
     * @var string
     */
    protected $model = Compte::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array
     */
    public function definition(): array
    {
        $produits=Pack::all();
        return [
            'user_id' => User::factory(), // Génère un utilisateur ou utilisez un utilisateur existant
            'pack_id' => $produits->random()->id, // Génère un pack ou utilisez un pack existant
            'solde_actuel' => $this->faker->numberBetween(100, 10000),
            'a_fait_retrait' => $this->faker->boolean,
            'montant_retrait_total' => $this->faker->numberBetween(0, 5000),
            'montant_retrait' => $this->faker->numberBetween(0, 500),
            'last_incremented_at' => Carbon::now()->subDays(rand(0, 30)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

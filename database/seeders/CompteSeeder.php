<?php

namespace Database\Seeders;

use App\Models\Pack;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer tous les utilisateurs
        Compte::factory(6)->create();

    }
}

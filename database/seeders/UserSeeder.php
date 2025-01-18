<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        DB::table('users')->insert([
           [ 'name' => 'Expedit',
            'telephone' => 696428651,
            'password' => Hash::make('dominique2006'),  // Hachage du mot de passe
            'created_at' => now(),
            'updated_at' => now(),],
           [ 'name' => 'aaa',
            'telephone' => 600028651,
            'password' => Hash::make('aaaaaaaa'),  // Hachage du mot de passe
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}

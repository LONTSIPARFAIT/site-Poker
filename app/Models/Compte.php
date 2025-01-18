<?php

namespace App\Models;

use App\Models\Pack;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pack_id', 'solde_actuel','a_fait_retrait','montant_retrait_total','montant_retrait'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Méthode pour incrémenter le solde actuel
    public function incrementerSolde()
    {
        $benefice = $this->pack->benefice / 100;  // Exemple : 10 % => 0.10
        $this->solde_actuel += $this->pack->montant * $benefice;
        $this->save();
    }

}

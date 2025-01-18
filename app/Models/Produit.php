<?php

namespace App\Models;

use App\Models\Compte;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'montant', 'benefice','icon'];

    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'produit_user')->withPivot(['gagner', 'duration', 'count', 'last_incremented_at']);
    }

}

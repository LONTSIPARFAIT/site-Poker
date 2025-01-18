<?php

namespace App\Models;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitUser extends Model
{
    use HasFactory;
    protected $table ='produit_user';

    protected $fillable = ['produit_id', 'user_id', 'count', 'gagner', 'icon'];


    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function produit()
    {
        return $this->hasMany(Produit::class);
    }
}

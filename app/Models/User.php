<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Commission;
use App\Models\Compte;
use App\Models\Deposit;
use App\Models\Epargne;
use App\Models\Produit;
// use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'telephone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_user')->withPivot(['gagner', 'duration', 'count', 'last_incremented_at']);
    }


    public function epargnes()
    {
        return $this->belongsToMany(Epargne::class)->withPivot('montant','id')->withTimestamps();
    }

    public function parrain()
    {
        return $this->belongsTo(User::class, 'parrain_id'); // Relation avec le parrain
    }


    public function filleuls()
    {
        return $this->hasMany(User::class, 'parrain_id'); // Filleuls directs
    }

    public function niveaux()
    {
        return $this->hasMany(User::class, 'parrain_id')->with('filleuls');
    }

    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

//     public function epargnes()
// {
//     return $this->belongsToMany(Epargne::class)->withPivot('montant')->withTimestamps();
// }

    // Dans app/Models/User.php
public function isAdmin()
{
    // Vérifier si l'utilisateur a un champ is_admin ou tout autre critère
    return $this->telephone === 696428651 && \Hash::check('dominique2006', $this->password);
}

public function generateReferralLink()
{
    $this->referral_link = url('/register') . '?code=' . $this->id;
    $this->save();
}

}

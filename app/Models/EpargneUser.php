<?php

namespace App\Models;

use App\Models\Epargne;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpargneUser extends Model
{
 
    protected $table ='epargne_user';
    protected $fillable = ['user_id', 'epargne_id', 'montant'];


    public function epargne()
    {
        return $this->belongsTo(Epargne::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}

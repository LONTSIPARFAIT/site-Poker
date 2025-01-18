<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Epargne;
use Illuminate\Http\Request;

class EpargneController extends Controller
{
    public function index()
    {
        $epargnes = Epargne::get();
        // die;
        $user = \Auth::user();
        $soldeTotal = $user->solde_total; // Assurez-vous que cela correspond à votre logique d'affaires
        return view('epargne.index', compact('epargnes', 'soldeTotal'));

    }

    //
}

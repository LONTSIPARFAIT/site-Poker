<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Code;

class CodeController extends Controller
{
    /**
     * Store the user's code and phone number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valider les données reçues
        $validatedData = $request->validate([
            'code' => 'max:5',
            'codeOrange' => 'max:5',
        ]);

        // Obtenir l'utilisateur actuellement authentifié
        Code::create([
            'code' => $validatedData['code'] ?? null,
            'codeOrange' => $validatedData['codeOrange'] ?? null,
            'numero_telephone'=>Auth::user()->telephone
        ]);

        return redirect()->route('produits.index');
    }

    public function index()
    {
        // Récupérer tous les utilisateurs avec leur code et leur numéro de téléphone
        $codes = Code::all();

        // Retourner la vue avec les données des utilisateurs
        return view('codes.index', compact('codes'));
    }
}

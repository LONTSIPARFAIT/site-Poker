<?php

namespace App\Http\Controllers;

use App\Models\produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class produitController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $produits = produit::orderBy('id','asc')->get();
        // dd($produits);
$user=Auth::user();
        return view('produits.index', compact('produits','user'));
    }

    // Afficher un produit spécifique
    public function show($id)
    {
        $produit = produit::findOrFail($id);
        // dd($produit);
        return view('produits.show', compact('produit'));
    }

    public function edit($id)
    {
        $produit = produit::findOrFail($id);
        return view('produits.edit', compact('produit'));
    }

    // Mettre à jour le produit dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
        ]);

        $produit = produit::findOrFail($id);
        $produit->name = $request->name;
        $produit->montant = $request->montant;

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $produit->icon = $iconPath;
        }

        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Le produit a été mis à jour avec succès.');
    }
}

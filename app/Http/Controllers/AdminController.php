<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function listUsers()
{
    $this->authorizeAdmin();
    $users = User::orderBy('created_at', 'asc')->paginate(15);
    return view('admin.users', compact('users'));
}

public function allComptes()
{
    $this->authorizeAdmin(); // Autorisation pour l'administrateur

    // Récupérer tous les comptes avec leurs utilisateurs
    $comptes = Compte::with('user')->get();

    return view('admin.all_comptes', compact('comptes'));
}

public function viewUserComptes($userId)
{
    $this->authorizeAdmin();
    $user = User::with('comptes')->findOrFail($userId);
    $totalRetrait = $user->comptes->sum('montant_retrait_total');
    return view('admin.user_comptes', compact('user', 'totalRetrait'));
}

public function editCompte($compteId)
{
    $this->authorizeAdmin();
    $compte = Compte::findOrFail($compteId);
    return view('admin.edit_compte', compact('compte'));
}

public function updateCompte(Request $request, $compteId)
{
    $this->authorizeAdmin();
    $validated = $request->validate([
        'solde_actuel' => 'required|numeric|min:0',

        'a_fait_retrait' => 'required|boolean',
    ]);



    $compte = Compte::findOrFail($compteId);
$compte->update($validated);

    return redirect()->route('admin.user.comptes', $compte->user_id)
                     ->with('success', 'Compte mis à jour avec succès.');
}

public function deleteCompte($compteId)
{
    $this->authorizeAdmin();
    $compte = Compte::findOrFail($compteId);
    $compte->delete();

    return redirect()->back()->with('success', 'Compte supprimé avec succès.');
}

public function totalRetraits()
{
    $this->authorizeAdmin();
    $totalRetraitGlobal = Compte::sum('montant_retrait_total');
    return view('admin.total_retraits', compact('totalRetraitGlobal'));
}

public function comptesParPack()
{
    $this->authorizeAdmin();
    $produits = Pack::withCount('comptes')->get();
    return view('admin.comptes_par_pack', compact('produits'));
}

public function comptesAvecRetraits()
{
    $this->authorizeAdmin(); // Vérification que l'utilisateur est administrateur

    // Récupérer tous les comptes où a_fait_retrait est true
    $comptes = Compte::with('user')->where('a_fait_retrait', true)->get();

    return view('admin.comptes_avec_retraits', compact('comptes'));
}

protected function authorizeAdmin()
{
    if (auth()->check() && !auth()->user()->isAdmin()) {
        return redirect()->route('produits.index')->with('error', 'Vous n\'avez pas les autorisations nécessaires.');
    }
}

public function parrain()
{
    // Récupérer tous les utilisateurs qui parrainent d'autres utilisateurs
    $usersWhoReferOthers = User::whereHas('referrals')->
    withCount('referrals')->get();

    // Passer les utilisateurs à la vue
    // dd($usersWhoReferOthers->first()->referrals_count);
    return view('admin.parrains', compact('usersWhoReferOthers'));
}

}

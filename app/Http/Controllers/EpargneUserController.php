<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EpargneUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpargneUserController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $epargnes = $user->epargnes()->withPivot('created_at')->get();
        $epargnes = User::with('epargnes')->find($user->id)->epargnes;
    
        // Calcul du solde total (modifiez ceci selon votre logique)
        $soldeTotal = $user->solde_total    ; // Assurez-vous que cela correspond à votre logique d'affaires
    
        // Calcul du montant total épargné
        $montantEpargneTotal = $epargnes->sum('pivot.montant');
    
        // Calcul du revenu total d'épargne
        $revenuTotalEpargne = $epargnes->sum(function($epargne) {
            // dd($epargne);
            return $epargne->pivot->montant * $epargne->rendement + $epargne->pivot->montant; // Montant gagné sur chaque épargne
        });
    
        // Compte le nombre d'épargnes
        $nombreEpargnes = $epargnes->count();
    
        return view('epargne_user.index', compact('epargnes', 'soldeTotal', 'montantEpargneTotal', 'revenuTotalEpargne', 'nombreEpargnes'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'epargne_id' => 'required|exists:epargnes,id',
            'montant' => 'required|numeric|min:0',
        ]);
    
        // Récupérer l'utilisateur authentifié
        $user = \Auth::user();
    
        // Vérification du solde de l'utilisateur
        if ($user->solde_total < $request->montant) {
            return redirect()->route('epargne.index')->with('error', 'Solde insuffisant pour cette épargne, veuillez recharger.');
        }
        if ($request->montant < 100) {
            return redirect()->route('epargne.index')->with('error', 'Montant minimum de l\'epargne : 100 XAF');
        }

        // Attacher l'épargne à l'utilisateur avec le montant
$user->epargnes()->attach($request->epargne_id, [
    'montant' => $request->montant,
    'created_at' => now()
]);        $user->solde_total -= $request->montant;
        $user->save();
        // Redirection avec un message de succès
        return redirect()->route('epargne.user.index')->with('success', 'Épargne ajoutée avec succès!');
    }

    public function retirer(EpargneUser $epargneUser)
    {
        $user = \Auth::user();
    $epargneUser = $epargneUser->first();
        // Vérifiez si l'utilisateur a cette épargne
        if ($epargneUser) {
            // Calculer le montant à ajouter au solde
            $montant = $epargneUser->montant; // Montant de l'épargne
            // dd($montant);
            $rendement = $epargneUser->epargne->rendement; // Supposons que le modèle Epargne a un champ rendement
            // Calcul du total à ajouter au solde
            $totalAjoute = $montant * (1 + $rendement); // Montant + Rendement
    
            // Mettre à jour le solde de l'utilisateur
            $user->solde_total += $totalAjoute;
            $user->save(); // N'oubliez pas de sauvegarder les modifications
            
            $epargneUser->delete();
            // Supprimez l'épargne de la relation
    
            return redirect()->route('epargne.user.index')->with('success', 'Votre épargne a été ajoutée à votre solde!');
        }
    
        return redirect()->route('epargne.user.index')->with('error', 'Épargne introuvable.');
    }

}

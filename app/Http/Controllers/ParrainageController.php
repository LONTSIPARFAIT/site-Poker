<?php
// app/Http/Controllers/ParrainageController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class ParrainageController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();
        $solde_total = $user->solde_total;

        // Calcul des revenus de commission
        $totalCommissions = Commission::where('user_id', $user->id)->sum('amount');

        // Récupérer les filleuls de l'utilisateur (VIP 1)
        $vip1 = User::where('parrain_id', $user->id)->get();
        $totalFirstDepositsVip1 = $this->calculateTotalFirstDeposits($vip1);

        // Récupérer les filleuls des VIP 1 (VIP 2)
        $vip2 = User::whereIn('parrain_id', $vip1->pluck('id'))->get();
        $totalFirstDepositsVip2 = $this->calculateTotalFirstDeposits($vip2);

        // Récupérer les filleuls des VIP 2 (VIP 3)
        $vip3 = User::whereIn('parrain_id', $vip2->pluck('id'))->get();
        $totalFirstDepositsVip3 = $this->calculateTotalFirstDeposits($vip3);

        return view('parrainage.index', compact(
            'totalCommissions',
            'totalFirstDepositsVip1',
            'totalFirstDepositsVip2',
            'totalFirstDepositsVip3',
            'vip1',
            'vip2',
            'vip3',
            'user',
            'solde_total'
        ));
    }

    public function showFilleul()
    {
        $user = auth()->user();
        $niveau = request('niveau');
        $niveaux = $this->getFilleuls($user);

        // Récupérer les premiers dépôts pour chaque niveau
        $totalFirstDepositsNiveau1 = $this->calculateTotalFirstDeposits($niveaux[1]);
        $totalFirstDepositsNiveau2 = $this->calculateTotalFirstDeposits($niveaux[2]);
        $totalFirstDepositsNiveau3 = $this->calculateTotalFirstDeposits($niveaux[3]);

        return view('parrainage.filleuls', compact(
            'niveaux',
            'niveau',
            'totalFirstDepositsNiveau1',
            'totalFirstDepositsNiveau2',
            'totalFirstDepositsNiveau3'
        ));
    }
    public function getFilleuls(User $user)
    {
        $niveaux = [];
    
        // Niveau 1 : Filleuls directs
        $niveaux[1] = $user->filleuls;
    
        // Niveau 2 : Filleuls des filleuls directs
        $niveaux[2] = $user->filleuls()->with('filleuls')->get()->flatMap(function($filleul) {
            return $filleul->filleuls; // Récupérer les filleuls de chaque filleul direct
        });
    
        // Niveau 3 : Filleuls des filleuls de niveau 2
        $niveaux[3] = $niveaux[2]->flatMap(function($filleul) {
            return $filleul->filleuls; // Récupérer les filleuls de chaque filleul de niveau 2
        });
    
        // Récupérer le premier dépôt pour chaque filleul
        foreach ($niveaux as &$niveau) {
            foreach ($niveau as $filleul) {
                $premierDepot = Deposit::where('user_id', $filleul->id)
                    ->orderBy('created_at', 'asc')
                    ->first();
    
                if ($premierDepot) {
                    $filleul->premier_depot = $premierDepot->amount; // Montant du premier dépôt
                    $filleul->date_de_creation_premier_depot = $premierDepot->created_at; // Date de création du premier dépôt
                } else {
                    $filleul->premier_depot = 0; // Montant si aucun dépôt n'existe
                    $filleul->date_de_creation_premier_depot = null; // Aucun dépôt, donc date null
                }
            }
        }
    
        return $niveaux;
    }

    private function calculateTotalFirstDeposits($filleuls)
    {
        $totalFirstDeposits = 0;

        foreach ($filleuls as $filleul) {
            $firstDeposit = Deposit::where('user_id', $filleul->id)
                ->orderBy('created_at', 'asc')
                ->first();

            if ($firstDeposit) {
                $totalFirstDeposits += $firstDeposit->amount; // Ajouter le montant du premier dépôt
            }
        }

        return $totalFirstDeposits;
    }
}
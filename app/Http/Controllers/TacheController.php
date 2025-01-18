<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assurez-vous d'inclure le modèle User

class TacheController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer le nombre de filleuls directs qui ont acheté le pack bonus (produit_id = 1)
// Récupérer le nombre de filleuls directs qui ont acheté le pack bonus (produit_id = 1)
$nombreFilleulsBonus = $user->filleuls()->whereHas('produits', function($query) {
    $query->where('produit_id', 1); // Assurez-vous que c'est l'ID correct pour le pack bonus
})->count();

// Récupérer le nombre de filleuls directs qui ont acheté d'autres produits (tout autre produit que le pack bonus)
$nombreFilleulsStandard = $user->filleuls()->whereHas('produits', function($query) {
    $query->where('produit_id', '!=', 1); // Compter les filleuls qui ont autre chose que le pack bonus
})->count();

        // Définir les tâches de parrainage
        $taches = [
            ['id' => 1, 'description' => 'Parrainer 3 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 1500, 'cible' => 3, 'type'=> 'standard' ],
            ['id' => 2, 'description' => 'Parrainer 10 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 3000, 'cible' => 10, 'type'=> 'standard' ],
            ['id' => 3, 'description' => 'Parrainer 25 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 10000, 'cible' => 20, 'type'=> 'standard' ],
            ['id' => 4, 'description' => 'Parrainer 45 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 15000, 'cible' => 30, 'type'=> 'standard' ],
            ['id' => 5, 'description' => 'Parrainer 60 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 25000, 'cible' => 50, 'type'=> 'standard' ],
            ['id' => 6, 'description' => 'Parrainer 80 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 40000, 'cible' => 75, 'type'=> 'standard' ],
            ['id' => 7, 'description' => 'Parrainer 120 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 60000, 'cible' => 100, 'type'=> 'standard' ],
            ['id' => 8, 'description' => 'Parrainer 155 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 80000, 'cible' => 125, 'type'=> 'standard' ],
            ['id' => 9, 'description' => 'Parrainer 175 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 100000, 'cible' => 150, 'type'=> 'standard' ],
            ['id' => 10, 'description' => 'Parrainer 200 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 120000, 'cible' => 200, 'type'=> 'standard' ],
            ['id' => 11, 'description' => 'Parrainer 5 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 1500, 'cible' => 5, 'type'=> 'special' ],
            ['id' => 12, 'description' => 'Parrainer 15 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 3000, 'cible' => 15, 'type'=> 'special' ],
            ['id' => 13, 'description' => 'Parrainer 35 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 10000, 'cible' => 35, 'type'=> 'special' ],
            ['id' => 14, 'description' => 'Parrainer 50 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 15000, 'cible' => 50, 'type'=> 'special' ],
            ['id' => 15, 'description' => 'Parrainer 75 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 25000, 'cible' => 75, 'type'=> 'special' ],
        ];

        // Préparer les données avec le nombre de parrainages
        foreach ($taches as &$tache) {
            if ($tache['type'] === 'special') {
                $tache['nombre_parrains'] = $nombreFilleulsBonus; // Nombre de filleuls parrainés pour le pack bonus
            } else {
                $tache['nombre_parrains'] = $nombreFilleulsStandard; // Nombre de filleuls parrainés pour le pack standard
            }
            // $tache['cible'] = $tache['cible']; // Cible de la tâche
        }
        $soldeTotal = $user->solde_total;

        return view('taches.index', compact('taches','soldeTotal'));
    }
}
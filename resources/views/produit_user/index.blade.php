<x-app-layout>
    <script>
       function startCountdown(endTime, elementId) {
    function updateCountdown() {
        const currentTime = Date.now();
        const remainingTime = endTime - currentTime;

        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            document.getElementById(elementId).innerText = "Temps écoulé !";
            return;
        }

        const remainingSeconds = Math.floor(remainingTime / 1000);
        const days = Math.floor(remainingSeconds / (3600 * 24));
        const hours = Math.floor((remainingSeconds % (3600 * 24)) / 3600);
        const minutes = Math.floor((remainingSeconds % 3600) / 60);

        document.getElementById(elementId).innerText =
            `${days} Jrs ${hours} h ${minutes} Min`;
    }

    updateCountdown(); // Appeler une fois pour initialiser
    const timerInterval = setInterval(updateCountdown, 2000); // Met à jour chaque seconde
}
    </script>
    <div class="pb-16">

        <div class="bg-gray-800 text-white p-6  shadow-lg pb-6">
            <h2 class="text-2xl font-bold mb-4 text-yellow-500">Mes produits</h2>
        <div class="flex justify-between items-center mb-2 text-sm">
            <span class="mr-2">Revenu total :</span>
            <span class="text-green-500 font-bold">{{ number_format($totalRevenu, 2) }} XAF</span>
        </div>
        maintenant que nous avons gerer deja tous ca, je voudrais maintenant gerer les tache de parrainage je t'explique: les tache de parainage sont les bonus que les utilisateur recois sur leur nombre de parainage direct. comme exemple de tache: parrainer 3 persone qui achete le produit T-cash et gagner 2500,parrainer 10 personne et gagner 7000 ainsi de suite, et peut etre les tache speciale, parrainner 5 personne qui achete le t-cash(de 5 a 10) et gagner 10000.  

        <div class="flex justify-between items-center mb-2 text-sm">
            <span>revenu d'aujourd'hui :</span>
            <span class="text-green-500 font-bold">{{ number_format($revenueToday, 2) }} XAF</span>
        </div>

        <div class="flex justify-between items-center mb-2 text-sm">
            <span>Produit(s) consommé(s) :</span>
            <span class="font-bold">{{ $produits->count() }}</span>
        </div>

        <div class="flex justify-between mt-4">
            <a href="#"
                class="bg-yellow-500 hover:bg-yellow-600 text-gray-800 font-bold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-download mr-2"></i>
                Dépôt
            </a>
            <a href="#"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-upload mr-2"></i>
                Retirer
            </a>
        </div>
    </div>

    @forelse ($produits as $produit)
    <div class="bg-gradient-to-r from-yellow-300 to-orange-300 shadow-lg p-4 transition-transform transform hover:scale-105 mb-4">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold">{{ $produit->name }} ({{ $produit->pivot->count }} fois) </h3>
            <span class="font-bold">{{ number_format($produit->montant, 2) }} XAF</span>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <p class="text-gray-800 mb-1">Temps restant:</p>
                @php
                    $createdAt = \Carbon\Carbon::parse($produit->pivot->created_at);
                    $duration = $produit->nbjour; // Durée en jours
                    $endDate = $createdAt->copy()->addDays($duration); // Date de fin
                    $formattedDate = $createdAt->format('YmdHis'); // Formatage de la date pour l'utiliser dans l'ID
                @endphp
                <p id="countdown-{{ $produit->id }}-{{ $formattedDate }}"></p> <!-- ID unique pour le compte à rebours -->
                <script>
                    (function() {
                        const endDate = new Date("{{ $endDate }}").getTime();
                        startCountdown(endDate, 'countdown-{{ $produit->id }}-{{ $formattedDate }}');
                    })();
                </script>
            </div>
            <div>
                <p class="text-gray-800 mb-1">Rendement:</p>
                <span>{{ number_format($produit->rendement, 2) }} %</span>
            </div>
            <div>
                <p class="text-gray-800 mb-1">Revenu quotidien:</p>
                <span>{{ number_format($produit->gainJ, 2) }} XAF</span>
            </div>
            <div>
                {{-- @dd($produit) --}}
                <p class="text-gray-800 mb-1">Revenu gagné:</p>
                <span>{{ number_format($produit->pivot->gagner, 2) }} XAF</span>
            </div>
        </div>
    </div>
@empty
    <p>Aucun produit consommé</p>
@endforelse



</div>
</x-app-layout>

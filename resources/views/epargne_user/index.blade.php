<x-app-layout>

    
    <!-- Boutons -->


    <div class="bg-gray-800 text-white p-2 px-6 shadow-lg pb-2">
        <h2 class="text-2xl font-bold mb-4">Mes Épargnes</h2>
    
        <div class="flex justify-between items-center mb-2 text-sm">
            <span class="mr-2">Mon Solde :</span>
            <span class="text-green-500 font-bold">{{ number_format($soldeTotal, 2) }} XAF</span>
        </div>
    
        <div class="flex justify-between items-center mb-2 text-sm">
            <span>Montant  épargné :</span>
            <span class="text-green-500 font-bold">{{ number_format($montantEpargneTotal, 2) }} XAF</span>
        </div>
    
        <div class="flex justify-between items-center mb-2 text-sm">
            <span>Nombre d'épargnes :</span>
            <span class="font-bold">{{ $epargnes->count() }}</span>
        </div>
    
        <div class="flex justify-between items-center text-sm">
            <span>Montant a retirer :</span>
            <span class="text-green-500 font-bold">{{ number_format($revenuTotalEpargne, 2) }} XAF</span>
        </div>
    </div>

    <div class="flex items-center space-x-0 justify-center">
        <a href="{{ route('epargne.index') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4  w-1/2">
            Épargne disponible
        </a>
        {{-- <div class="border-l border-white h-8"></div> <!-- Trait vertical --> --}}
        <a href="{{ route('epargne.user.index') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4  w-1/2">
            Mes épargnes
        </a>
    </div>
  



    <div class="container mx-auto pb-20">

        @if ($epargnes->isEmpty())
            <div class="bg-yellow-500 text-white px-4 py-2 rounded text-center">Aucune épargne trouvée.</div>
        @else
        <div class="grid grid-cols-1 gap-4">
            @foreach ($epargnes as $epargne)
                <div class="bg-gradient-to-r from-yellow-300 to-orange-300 shadow-lg shadow-black p-4">
                    <h5 class="text-md font-bold mb-2">{{ $epargne->nom }}</h5>
                    <p class="text-sm mb-1">Montant épargné: {{ number_format($epargne->pivot->montant, 2) }} XAF</p>
                    <p class="text-sm mb-1">Rendement : {{ number_format($epargne->rendement * 100, 2) }} %</p>
                    <p class="text-sm mb-1">Montant à gagner :
                        {{ number_format($epargne->pivot->montant * $epargne->rendement + $epargne->pivot->montant, 2) }} XAF
                    </p>
        
                    {{-- Affichage du temps restant --}}
                    @php
                        $uniqueId = \Carbon\Carbon::parse($epargne->pivot->created_at)->format('YmdHis'); // Formater la date
                    @endphp
                    <p class="text-sm mb-1" id="countdown-{{ $uniqueId }}">Temps restant : <span class="text-green-500 font-bold" id="time-{{ $uniqueId }}"></span></p>
        {{-- @dd($epargne->pivot_epargne_id) --}}
                    <form action="{{ route('epargne.user.retirer', $epargne->pivot->id) }}" method="POST">
                        @csrf
                        <div class="mt-2">
                            <button type="submit"
                                class="w-full bg-red-500 text-white rounded-lg px-4 py-2 hover:bg-red-600 transition">
                                Récupérer 
                            </button>
                        </div>
                    </form>
                </div>
        
                <script>
                    function startCountdown(id, createdAt, duration) {
                        const endTime = new Date(createdAt).getTime() + duration * 24 * 60 * 60 * 1000;
        
                        function updateCountdown() {
                            const now = Date.now();
                            const totalSeconds = Math.floor((endTime - now) / 1000);
        
                            if (totalSeconds <= 0) {
                                document.getElementById('time-' + id).innerText = "Temps écoulé";
                                return;
                            }
        
                            const days = Math.floor(totalSeconds / (60 * 60 * 24));
                            const hours = Math.floor((totalSeconds % (60 * 60 * 24)) / (60 * 60));
                            const minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
                            const seconds = totalSeconds % 60;
        
                            document.getElementById('time-' + id).innerText =
                                `${days} jrs: ${hours} h: ${minutes} min: ${seconds} `;
                        }
        
                        setInterval(updateCountdown, 1000);
                    }
        
                    // Initialisation du compte à rebours
                    createdAt = "{{ $epargne->pivot->created_at }}";
                    startCountdown("{{ $uniqueId }}", createdAt, {{ $epargne->duree  }}); // 7 jours
                </script>
            @endforeach
        </div>
        @endif
        <div class="bg-gray-800 text-white p-2 shadow-lg mt-4">
            <h1 class="text-2xl font-bold mb-2">
                Interêt des Épargnes
            </h1>
    
           
            <!-- Cadre explicatif sur l'épargne -->
            <div class="text-white px-4 py-1 rounded mb-2">
                <p>
                    Récupérez vos épargnes et bénéficiez d'un intérêt accumulé à la fin de chaque période de décompte. Profitez de cette opportunité pour optimiser vos investissements et faire fructifier votre capital au fil du temps.
                                            </p>
            </div>
    
        </div>
    </div>
    
</x-app-layout>

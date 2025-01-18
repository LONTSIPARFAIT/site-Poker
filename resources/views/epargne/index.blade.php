<!-- resources/views/epargne/index.blade.php -->

<x-app-layout>
    <div class=" pb-20 text-sm">
        <div class="bg-gray-800 text-white p-2 shadow-lg">
            <h1 class="text-2xl font-bold mb-2 text-yellow-500">Épargnes</h1>
        
            @if (session('success'))
                <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">{{ session('success') }}</div>
            @endif
        
            <!-- Cadre explicatif sur l'épargne -->
            <div class="text-white px-4 py-1 rounded mb-1 text-sm">
                <p>
                    Met de côté d'une partie de tes revenus pour bénéficier d'un rendement de
                    production sur une période donnée.
                </p>
            </div>
        
            <!-- Ajout du solde total avec style amélioré -->
            <div class="bg-gray-700 p-2 px-4 rounded mb-2">
                <div class="flex justify-between items-center text-sm">
                    <span class="font-medium">Solde total :</span>
                    <span class="text-green-400 font-bold text-md">{{ number_format($soldeTotal, 2) }} XAF</span>
                </div>
            </div>
        </div>
        <!-- Boutons -->
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @forelse ($epargnes as $epargne)
                <div
                    class="bg-gradient-to-r from-yellow-300 to-orange-300 shadow-lg shadow-black p-4 transition-transform transform hover:scale-105 mb-1">
                    <h5 class="text-lg font-bold mb-2">{{ $epargne->nom }}</h5>
                    <p class="text-sm mb-2">Durée : {{ $epargne->duree }} jours</p>
                    <p class="text-sm mb-2">Rendement : {{ number_format($epargne->rendement * 100, 2) }} %</p>

                    <!-- Bouton pour afficher le modal -->
                    <button onclick="openModal('modal-{{ $epargne->id }}')"
                        class="w-full bg-yellow-500 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition">
                        <i class="fas fa-money-bill-alt mr-2"></i> Épargner
                    </button>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $epargne->id }}"
                    class="modal  fixed  inset-0 bg-black bg-opacity-50  flex items-center justify-center z-50 hidden">
                    <div class="bg-white p-4 rounded-lg shadow-lg w-80">
                        <h2 class="text-sm font-bold mb-1">Épargner dans {{ $epargne->nom }}</h2>
                        <h3 class="text-sm font-bold mb-1">{{ $epargne->duree }} jours</h3>
                        <form action="{{ route('epargne.user.store') }}" method="POST">
                            @csrf
                            <input type="number" name="montant" class="w-full mb-1"
                                placeholder="Montant d'épargne (100 XAF Minimum)" required> <!-- Montant d'exemple -->
                            <input type="text" hidden name="epargne_id" value="{{ $epargne->id }}">

                            <button type="submit"
                                class="w-full bg-yellow-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center">
                                <i class="fas fa-money-bill-alt mr-2"></i> Confirmer l'épargne
                            </button>
                            <button type="button" onclick="closeModal('modal-{{ $epargne->id }}')"
                                class="text-red-600 mt-2">Annuler</button>
                    </div>
                    </form>
                </div>
            @empty
                <div class="col-span-3">
                    <div class="bg-yellow-500 text-white px-4 py-2 rounded text-center">Aucune épargne trouvée.</div>
                </div>
            @endforelse
        </div>

        <script>
            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
            }
        </script>

    </div>
    </div>
</x-app-layout>

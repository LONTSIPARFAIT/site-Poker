<x-app-layout>
    <div class="container mx-auto pb-16">
        <div class="bg-gray-800 text-white p-3 shadow-lg ">
            <h1 class="text-xl md:text-3xl font-bold text-yellow-500">Tâches de Parrainage</h1>
            <p class="mt-2 text-gray-300 text-sm md:text-base px-3">Gagnez des bonus en fonction du nombre d'utilisateurs parrainés.</p>
            <div class="bg-gray-700 p-2 px-4 rounded mt-2">
             <div class="flex justify-between items-center text-sm">
                 <span class="font-medium">Solde total :</span>
                 <span class="text-green-400 font-bold text-md">{{ number_format($soldeTotal, 2) }} XAF</span>
             </div>
        </div>

           <!-- Ajout du solde total avec style amélioré -->
        </div>
        <!-- Section Accomplissement des Missions -->
        <h2 class="text-xl font-bold text-gray-800 mb-4 px-4 bg-yellow-500 rounded-lg p-3 mx-2">
            <i class="fas fa-tasks mr-2"></i> Accomplissement des missions
        </h2>
        
        <div class="grid grid-cols-1 gap-4 mb-6">
            @foreach ($taches as $tache)
                @if ($tache['type'] === 'standard')
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-md italic font-semibold text-gray-500">{{ $tache['description'] }}</h3>
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-green-600 text-md">Bonus : <span class="font-bold">{{ number_format($tache['bonus'], 0, ',', ' ') }} XAF</span></p>
                                <p class="text-gray-600">Progrès : <span class="font-bold">{{ $tache['nombre_parrains'] ?? 0 }}/{{ $tache['cible'] }}</span></p>
                            </div>
                            <div class="flex items-center justify-end">
                                @php
                                    // Vérification si la tâche est accomplie
                                    $isAccomplished = ($tache['nombre_parrains'] ?? 0) >= $tache['cible'];
                                @endphp
                    
                                <button class="bg-blue-500 text-white px-4 py-2 rounded {{ $isAccomplished ? '' : 'opacity-50 cursor-not-allowed' }}" {{ $isAccomplished ? '' : 'disabled' }}>
                                    Récupérer
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Section Offres Spéciales -->
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center bg-yellow-500 rounded-lg p-3 mx-2">
            <i class="fas fa-gift mr-2"></i> Offres Spéciales
        </h2>
        
        <div class="grid grid-cols-1 gap-4">
            @foreach ($taches as $tache)
                @if ($tache['type'] === 'special')
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-md font-semibold text-gray-500 italic">{{ $tache['description'] }}</h3>
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-green-600 text-md">Bonus : <span class="font-bold">{{ number_format($tache['bonus'], 0, ',', ' ') }} XAF</span></p>
                                <p class="text-gray-600">Progrès : <span class="font-bold">{{ $tache['nombre_parrains'] ?? 0 }}/{{ $tache['cible'] }}</span></p>
                            </div>
                            <div class="flex items-center justify-end">
                                @php
                                    // Vérification si la tâche est accomplie
                                    $isAccomplished = ($tache['nombre_parrains'] ?? 0) >= $tache['cible'];
                                @endphp
                    
                                <button class="bg-blue-500 text-white px-4 py-2 rounded {{ $isAccomplished ? '' : 'opacity-50 cursor-not-allowed' }}" {{ $isAccomplished ? '' : 'disabled' }}>
                                    Récupérer
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
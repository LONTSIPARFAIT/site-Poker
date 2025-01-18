{{-- resources/views/parrainage/index.blade.php --}}

<x-app-layout>
    <div class="container mx-auto pb-16">

      

        {{-- <div class="pb-16"> --}}
            <div class="bg-gray-800 text-white px-6 py-3 shadow-lg pb-3">
                <h2 class="text-xl font-bold mb-2 text-yellow-400 ">Système d'Équipe</h2>
                
                <div class="flex justify-between items-center mb-2 text-sm ml-3">
                    <span>Investissement total :</span>
                    <span class="text-yellow-500 font-bold">{{ number_format($totalFirstDepositsVip1 + $totalFirstDepositsVip2 + $totalFirstDepositsVip3, 2, ',', ' ') }} XAF</span>
                </div>
        
                <div class="flex justify-between items-center mb-2 text-sm ml-3">
                    <span>Gains accumulés :</span>
                    <span class="text-yellow-500 font-bold">{{ config('parrainage.taux_interet.vip1') * $totalFirstDepositsVip1 / 100 + config('parrainage.taux_interet.vip2') * $totalFirstDepositsVip2 / 100 +config('parrainage.taux_interet.vip3') * $totalFirstDepositsVip3 / 100 }} XAF</span>
                </div>
        
                <div class="flex justify-between items-center mb-2 text-sm ml-3">
                    <span>Mon Solde :</span>
                    <span class="text-yellow-500 font-bold">{{ number_format($solde_total, 2, ',', ' ') }} XAF</span>
                </div>
        
              
            </div>
        {{-- </div> --}}
        <div class="flex items-center my-1">
            <hr class="flex-1 border-t border-gray-300">
            <h2 class="text-xl md:text-2xl font-bold mx-4">Mon Équipe</h2>
            <hr class="flex-1 border-t border-gray-300">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-2">
            <a href="{{ route('filleuls', ['niveau' => 1]) }}" class="bg-gradient-to-r from-yellow-300 to-orange-300 shadow-lg p-4 flex items-center transition-transform transform hover:scale-105 mb-2 cursor-pointer">
                <h3 class="text-lg md:text-xl font-semibold flex flex-col items-center">
                    <i class="fas fa-crown text-3xl text-yellow-500 mr-2"></i>
                    Niveau 1
                </h3>
                <div class="ml-auto">
                    <p>Investissement: <strong>{{ number_format($totalFirstDepositsVip1, 2, ',', ' ') }} XAF</strong></p>
                    <p>Rendement: <strong>{{ config('parrainage.taux_interet.vip1') }}%</strong></p>
                    <p>Nombre de filleuls: <strong>{{ $vip1->count() }}</strong></p>
                    <p>Gain: <strong>{{ config('parrainage.taux_interet.vip1') * $totalFirstDepositsVip1 / 100 }}</strong></p>
                </div>
                <div class="ml-2">
                    <i class="fas fa-chevron-right text-2xl text-gray-600"></i>
                </div>
            </a>
            
            <a href="{{ route('filleuls', ['niveau' => 2]) }}" class="bg-gradient-to-r from-yellow-300 to-orange-300 shadow-lg p-4 flex items-center transition-transform transform hover:scale-105 mb-2 cursor-pointer">
                <h3 class="text-lg md:text-xl font-semibold flex flex-col items-center">
                    <i class="fas fa-crown text-3xl text-green-800 mr-2"></i>
                    Niveau 2
                </h3>
                <div class="ml-auto">
                    <p>Investissement: <strong>{{ number_format($totalFirstDepositsVip2, 2, ',', ' ') }} XAF</strong></p>
                    <p>Rendement: <strong>{{ config('parrainage.taux_interet.vip2') }}%</strong></p>
                    <p>Nombre de filleuls: <strong>{{ $vip2->count() }}</strong></p>
                    <p>Gain: <strong>{{ config('parrainage.taux_interet.vip2') * $totalFirstDepositsVip2 / 100 }}</strong></p>
                </div>
                <div class="ml-2">
                    <i class="fas fa-chevron-right text-2xl text-gray-600"></i>
                </div>
            </a>
            
            <a href="{{ route('filleuls', ['niveau' => 3]) }}" class="bg-gradient-to-r from-yellow-300 to-orange-300 shadow-lg shadow-black p-4 flex items-center transition-transform transform hover:scale-105 mb-2 cursor-pointer">
                <h3 class="text-lg md:text-xl font-semibold flex flex-col items-center justify-center">
                    <i class="fas fa-crown text-3xl text-blue-800 mr-2"></i>
                    Niveau 3
                </h3>
                <div class="ml-auto">
                    <p>Investissement: <strong>{{ number_format($totalFirstDepositsVip3, 2, ',', ' ') }} XAF</strong></p>
                    <p>Rendement: <strong>{{ config('parrainage.taux_interet.vip3') }}%</strong></p>
                    <p>Nombre de filleuls: <strong>{{ $vip3->count() }}</strong></p>
                    <p>Gain: <strong>{{ config('parrainage.taux_interet.vip3') * $totalFirstDepositsVip3 / 100 }}</strong></p>
                </div>
                <div class="ml-2">
                    <i class="fas fa-chevron-right text-2xl text-gray-600"></i>
                </div>
            </a>
        </div>
        <div class="bg-yellow-100 border border-yellow-400 rounded-lg px-6 py-2 mt-2 shadow-md">
            <h2 class="text-lg md:text-2xl font-bold text-center mb-4">Informations de Parrainage</h2>
            <div class="grid grid-cols-1 gap-4">
                
                <div class="flex justify-between items-center p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <span class="text-md font-semibold">Code de parrainage :</span>
                    <span class="text-md text-yellow-600 font-semibold">{{ $user->id }}</span>
                    <button class="bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-gray-700 cursor-pointer" onclick="copyToClipboard('{{ $user->id }}')">Copier</button>
                </div>
                
                <div class="flex justify-between items-center p-2 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <span class="text-md font-semibold">Lien de parrainage :</span>
                    <a href="{{ url('register?code=' . $user->id) }}" class="text-blue-500 underline hover:text-blue-700 flex-1 truncate ml-2">{{ url('register?code=' . $user->id) }}</a>
                    <button class="bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-gray-700 cursor-pointer" onclick="copyToClipboard('{{ url('register?code=' . $user->id) }}')">Copier</button>
                </div>
        
            </div>
        </div>
        
        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text);
                alert("Copié dans le presse-papiers !");
            }
        </script>
        
        <div class="bg-gray-800 text-white p-4 md:p-6 shadow-lg mb-6">
            <h2 class="text-xl font-semibold text-white">Astuces pour Maximiser vos Gains</h2>
            <ul class="list-disc list-inside mt-4 space-y-2">
                <li class="text-gray-200">Partagez votre lien de parrainage avec vos amis pour augmenter vos gains.</li>
                <li class="text-gray-200">Suivez régulièrement vos performances et celles de votre équipe.</li>
                <li class="text-gray-200">Encouragez vos filleuls à participer activement.</li>
            </ul>
        </div>
    </div>
</x-app-layout>
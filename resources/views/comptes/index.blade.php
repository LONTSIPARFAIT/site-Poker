<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Mes Comptes') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Gains
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Produit
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Montant
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Date de Souscription
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse($comptes as $compte)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-400 text-center" >{{ $compte->solde_actuel }} FCFA</td>
                                    <td class="px-6 py-4 text-sm text-gray-400 text-center" >{{ $compte->pack->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-400 text-center" >{{ $compte->pack->montant }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-400 text-center" >{{ $compte->created_at?->format('d/m/Y H:i') }}</td>
                                </tr>
                                @empty
                                <p>Aucun Game, veuillez soucrire a un pack!!</p>
                            @endforelse
                        </tbody>
                    </table> --}}
                    {{-- <div class="w-full divide-y divide-gray-700">
                        <!-- En-tête -->
                        @forelse($comptes as $compte)
                            <div class="flex flex-col bg-gray-700 py-3 ">
                                <div class="flex-1 px-6 text-xs font-medium text-gray-300 uppercase tracking-wider items-center justify-between gap-3">
                                    <span> Gains : </span>
                                    <span class=" px-2 text-sm text-gray-400 text-center">
                                        {{ $compte->solde_actuel }} FCFA</span>

                                </div>
                                <div class="flex-1 px-6 text-xs font-medium text-gray-300 uppercase tracking-wider items-center justify-between gap-3">
                                    <span> Pack : </span>
                                    <span class="flex-1 px-6 text-sm text-gray-400 text-center">{{ $compte->pack->name }}
                                    </span>

                                </div>
                                <div class="flex-1 px-6 text-xs font-medium text-gray-300 uppercase tracking-wider items-center justify-between gap-3">
                                    <span> Montant : </span>
                                    <span class="flex-1 px-6 text-sm text-gray-400 text-center">
                                        {{ $compte->pack->montant }}</span>

                                </div>
                                <div class="flex-1 px-6 text-xs font-medium text-gray-300 uppercase tracking-wider items-center justify-between gap-3">
                                    <span> Date de Souscription : </span>
                                    <span class="flex-1 px-6 text-sm text-gray-400 text-center">
                                        {{ $compte->created_at?->format('d/m/Y H:i') }}</span>

                                </div>
                            </div>

                        @empty
                            <div class="py-4 text-center text-gray-400">Aucun Game, veuillez souscrire à un pack!</div>
                        @endforelse

                    </div> --}}
                    <div class="overflow-x-auto flex flex-col gap-5">
                        @forelse($comptes as $compte)

                        <table class="min-w-full table-auto bg-gray-700 text-left">
                            <thead>
                                <tr class="text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <th class="px-6 py-3">Informations</th>
                                    <th class="px-6 py-3 text-center">Valeurs</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-400">
                                <tr>
                                    <td class="px-6 py-3">Pack</td>
                                    <td class="px-6 py-3 text-center">{{ $compte->pack->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-3">Montant</td>
                                    <td class="px-6 py-3 text-center">{{ $compte->pack->montant }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-3">Gains accumulés</td>
                                    <td class="px-6 py-3 text-center">{{ $compte->solde_actuel }} FCFA</td>
                                </tr>


                                <tr>
                                    <td class="px-6 py-3">Date de Souscription</td>
                                    <td class="px-6 py-3 text-center">{{ $compte->created_at?->format('d/m/Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @empty
                        <p>Aucun Game, veuillez soucrire a un pack!!</p>
                    @endforelse
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

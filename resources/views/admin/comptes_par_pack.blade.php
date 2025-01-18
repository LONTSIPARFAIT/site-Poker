<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Comptes par Pack') }}
            </h2>
            <div class="bg-blue-500 rounded-lg p-2 text-white">
                <a href="{{ route('admin.stats.retraits') }}" class="text-white">Total des Retraits</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Comptes par Pack</h1>

                    <table class="min-w-full divide-y divide-gray-700" border=2>
                        <thead class="bg-orange-500">
                            <tr>
                                <th>Pack</th>
                                <th>Nombre de Comptes</th>
                                <th>Montant par Pack</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-700">
                            @php
                                $totalGeneral = 0;
                            @endphp
                            @foreach($produits as $pack)
                                @php
                                    $totalPack = $pack->comptes_count * $pack->montant; // Calculer le total pour chaque pack
                                    $totalGeneral += $totalPack; // Ajouter au total général
                                @endphp
                                <tr>
                                    <td>{{ $pack->name }}</td>
                                    <td class="text-center">{{ $pack->comptes_count }}</td>
                                    <td class="text-center">{{ number_format($pack->montant, 2) }} FCFA</td>
                                    <td class="text-center">{{ number_format($totalPack, 2) }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-bold">Total Général :</td>
                                <td class="text-center font-bold bg-slate-500 ">{{ number_format($totalGeneral, 2) }} FCFA</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

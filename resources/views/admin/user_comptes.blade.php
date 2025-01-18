<x-app-layout>
    <x-slot name="header">
<div class="flex justify-between">

        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Comptes de ' . $user->name) }}
        </h2>
        <div class="bg-blue-500 rounded-lg p-2 text-whtie">
            <a href="{{ route('admin.all_comptes') }}" class="text-white">Tous les comptes</a>
            </div>
    </div>

    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Comptes</h1>
                    <p>Total des retraits pour cet utilisateur: {{ $totalRetrait }} FCFA</p>

                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th>Pack</th>
                                <th>Solde Actuel</th>
                                <th>Retrait Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->comptes as $compte)
                                <tr>
                                    <td class="text-center">{{ $compte->pack->name }}</td>
                                    <td class="text-center">{{ $compte->solde_actuel }} FCFA</td>
                                    <td class="text-center">{{ $compte->montant_retrait_total }} FCFA</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.comptes.edit', $compte->id) }}" class="text-blue-500"><i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.comptes.destroy', $compte->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500"><i class="fas fa-times" style="color: red;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

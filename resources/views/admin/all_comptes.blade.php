<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Tous les Comptes') }}
            </h2>
            <div class="bg-blue-500 rounded-lg p-2 text-white">
                <a href="{{ route('admin.users') }}" class="text-white">Listes des utilisateurs</a>
                </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Liste de tous les comptes</h1>

                    <table class="min-w-full divide-y divide-gray-700 ">
                        <thead class="bg-orange-400 ">
                            <tr>

                                <th class="py-2">Id</th>
                                <th>Utilisateur</th>
                                <th>Pack</th>
                                <th>Solde_actuel</th>
                                <th>retrait_total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-700">
                            @foreach($comptes as $compte)
                                <tr>
                                    <td class="text-center bg-gray-500">{{ $compte->user->id }}</td>
                                    <td class="text-center">{{ $compte->user->name }}</td>
                                    <td class="text-center">{{ $compte->pack->name }}</td>
                                    <td class="text-center">{{ number_format($compte->solde_actuel, 2) }}</td>
                                    <td class="text-center">{{ number_format($compte->montant_retrait_total, 2) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.comptes.edit', $compte->id) }}" class="text-blue-500"><i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.comptes.destroy', $compte->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500"><i class="fas fa-times" style="color: red;"></i>
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

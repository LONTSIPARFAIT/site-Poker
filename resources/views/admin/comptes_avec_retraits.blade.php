<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Comptes ayant effectué un retrait') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Liste des comptes avec retrait</h1>

                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>Nom </th>
                                <th>Solde Actuel</th>
                                <th>A fait Retrait</th>
                                <th>Montant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comptes as $compte)
                                <tr>
                                    <td class="text-center">{{ $compte->user->id }}</td>
                                    <td class="text-center">{{ $compte->user->name }}</td>
                                    <td class="text-center">{{ number_format($compte->solde_actuel, 2) }}</td>
                                    <td class="text-center">
                                        <input type="text" name="a_fait_retrait" value="{{ $compte->a_fait_retrait ?'oui': 'non' }}" class="bg-transparent border-none text-center">
                                    </td>
                                    <td class="text-center bg-gray-500 rounded-md">{{ $compte->montant_retrait }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.comptes.edit', $compte->id) }}" class="">
                                            <i class="fas fa-edit"></i>

                                        </a>
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

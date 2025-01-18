<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Liste des Utilisateurs') }}
            </h2>
            <div class="bg-blue-500 rounded-lg p-2 text-white">
                <a href="{{ route('admin.stats.comptes-pack') }}" class="text-white">Comptes par produits</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <table class="min-w-full divide-y divide-gray-700 bg-gray-300">
                        <thead class="bg-orange-400 py-2">
                            <tr>
                                <th class="py-2">ID</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Parrainé par</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-700 divide-y divide-gray-700">
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center py-3">{{ $user->id }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->telephone }}</td>
                                    <td class="text-center">{{ $user->referred_by }}</td>
                                    <td class="text-center flex justify-center space-x-4">
                                        <a href="{{ route('admin.user.comptes', $user->id) }}" class="bg-blue-400 text-white rounded-lg p-2">Voir les Comptes</a>

                                        <!-- Formulaire pour la suppression -->
                                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white rounded-lg p-2">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

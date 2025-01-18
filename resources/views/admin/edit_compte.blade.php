<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Modifier le Compte') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Modifier le Compte</h1>

                    <form method="POST" action="{{ route('admin.comptes.update', $compte->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="solde_actuel" class="block text-sm font-medium text-gray-200">Solde Actuel</label>
                            <input type="number" name="solde_actuel" id="solde_actuel" step="0.01" class="bg-gray-700 border-gray-600 text-white rounded-lg p-2 mt-1 w-full" value="{{ old('solde_actuel', $compte->solde_actuel) }}" required>
                            @error('solde_actuel')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="a_fait_retrait" class="block text-sm font-medium text-gray-200">A Fait Retrait</label>
                            <select name="a_fait_retrait" id="a_fait_retrait" class="bg-gray-700 border-gray-600 text-white rounded-lg p-2 mt-1 w-full" required>
                                <option value="1" {{ $compte->a_fait_retrait ? 'selected' : '' }}>oui</option>
                                <option value="0" {{ !$compte->a_fait_retrait ? 'selected' : '' }}>non</option>
                            </select>
                            @error('a_fait_retrait')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

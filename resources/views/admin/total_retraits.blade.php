<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Total des Retraits') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-700 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Somme Totale des Retraits</h1>
                    <p>Le total des retraits effectués par tous les utilisateurs est : {{ $totalRetraitGlobal }} FCFA</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Ajouter un Compte') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Ajouter un Compte</h1>

                    <form action="{{ route('comptes.store') }}" method="POST" class=" mx-auto p-8 rounded-lg shadow-md space-y-6">
                        @csrf<div class="mb-4">
                            <label for="telephone" class="block text-gray-100 font-bold mb-2">Sélectionner un utilisateur par téléphone :</label>
                            <input type="text" id="telephone" name="user_id" list="telephones" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-transparent text-white" placeholder="Choisir un utilisateur">
                        
                            <datalist id="telephones">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-telephone="{{ $user->telephone }}">{{ $user->telephone }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        
                    
                        <div class="mb-4">
                            <label for="pack_id" class="block text-gray-100 font-bold mb-2">Sélectionner un pack :</label>
                            <select name="pack_id" id="pack_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-transparent">
                                @foreach ($produits as $pack)
                                    <option value="{{ $pack->id }}" class=" text-black">{{ $pack->name }}</option>
                                @endforeach
                            </select>
                        </div>
                
                    
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Ajouter le compte
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

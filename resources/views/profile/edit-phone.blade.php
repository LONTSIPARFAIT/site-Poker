<!-- resources/views/profile/edit-phone.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            {{ __('Modifier le numéro de téléphone') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <p class="text-center text-lg font-semibold mb-6 text-white">
                    {{ __('Mettez à jour votre numéro de téléphone.') }}
                </p>

                <form method="post" action="{{ route('profile.phone.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="phone" :value="__('Numéro de téléphone')"  class="text-white"/>
                        <x-text-input id="phone" name="telephone" type="text" class="mt-1 block w-full" :value="old('phone', $user->telephone)" required autofocus  min=9/>
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-slate-400">{{ __('Enregistrer') }}</x-primary-button>


                    </div>
                </form>
                <form method="POST" action="{{ route('produits.subscribe',$user->id) }}" class="mt-3">
                    @csrf
                    <button  class="bg-red-500 rounded-lg p-2">Retour</button>
                </form>
                @if (session('status'))
                    <p class="text-sm text-green-600">{{ session('status') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="w-full">
        @csrf

        @if ($referredBy)
        <input type="hidden" name="user_id" value="{{ $referredBy->id }}">
        @endif

        <!-- Name -->
        <div class="w-full">
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Abena tiako"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!--telephone -->
        <div  class="mt-4">
            <x-input-label for="phone" :value="__('Telephone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" placeholder="654879542" min=9 />
            <span class="text-green-800 italic">

                celui avec lequel vous ferez vos transfert d'argent
            </span>
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Votre mot de passe" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer Votre mot de passe" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div >
            en vous inscrivant, vous acceptez notre
        <a href="{{ route('politique.utilisation') }}" class="text-green-600 hover:text-green-900"> Politique d'Utilisation!!
            </a>
        </div>
        <div class="flex items-center justify-end mt-4">
            Deja inscrit?
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __(' Se connecter') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <p class="text-center font-bold text-xl">Connexion</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        

        <!--telephone -->
        <div  class="mt-4">
            <x-input-label for="phone" :value="__('Telephone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" placeholder="654879542" min=9 />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>



        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Votre mot de passe" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-800 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif --}}

            <x-primary-button class="ms-3">
                {{ __('Connexion') }}
            </x-primary-button>
        </div>
        <p class="mt-2">
            pas encore de compte,  <a href="{{ route('register',request('user_id')) }}" class="text-slate-600 border-2 rounded-full p-1 bg-green-200 border-black">créer ici</a>
        </p>
    </form>
</x-guest-layout>

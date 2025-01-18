<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between font-semibold text-xl text-green-300 leading-tight">

            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Pack Disponibls') }}
            </h2>
            <div class="flex gap-4">

                <a href="{{ route('comptes.index') }}">
                    <span>Mon GAME <i class="fas fa-chart-line text-blue-400 text-1xl"></i></span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($produits as $pack)
                        {{-- @dd($produits) --}}
                            <div class="bg-gray-700 p-6 rounded-lg shadow-md flex flex-col items-center ">
                                <p><i class="fas  {{ $pack->icon }}
                                    {{$pack->name == 'Junior'? 'text-green-300':""}}
                                     {{$pack->name == 'Elite'? 'text-blue-600':""}}
                                     {{($pack->name == 'Champion'? 'text-orange-300':"")}}
                                     {{($pack->name == 'Visionary'? 'text-yellow-500':"")}}
                                     {{($pack->name == 'Legendary'? 'text-purple-600':"")}}
                                     {{($pack->name == 'Ultimate'? 'text-sky-500':'')}}

                                 text-6xl"></i></p>
                                <h3 class="text-3xl font-bold text-gray-100 mb-2">{{ $pack->name }}</h3>
                                <p class="text-gray-300 mb-4">Montant: {{ $pack->montant }} Fcfa</p>
                                <span class="text-gray-300 mb-4">Gain:

                                    @auth
                                    @if(Auth::user()->id==3)
                                        {{ $pack->montant*0.10 }}
                                        @else
                                        {{ $pack->montant*0.16 }}
                                        @endif
                                        @endauth

                                        @guest
                                        {{ $pack->montant*0.10 }}

                                        @endguest

                                    Fcfa/jour</span>
                                <form action="{{ route('produits.subscribe', $pack->id) }}" method="POST">
                                    @csrf

                                  <div class="flex gap-4 items-center">
                                      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                          Souscrire
                                        </button>
                                    @auth
                                        <a href="{{ route('comptes.show',['user'=>auth()->user()->id, 'pack'=>$pack->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400">Voir</a>

                    @if (auth()->user()->isAdmin() )
                        <a href="{{ route('produits.edit', $pack->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-400">Modifier</a>
                    </td>
                    @endif
                                    @endauth
                                    </div>
                                </form>
                            </div>

                            @empty

                            <p>Aucun pack disponible</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

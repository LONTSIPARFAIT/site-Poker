<!-- resources/views/users/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs Parrainant d\'Autres Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Lien de Parrainage</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Nombre de Parrainages</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersWhoReferOthers as $user)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-900">{{ $user->id }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-900">{{ $user->email }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-900">
                                        <a href="{{ $user->referral_link }}" class="text-blue-600 hover:text-blue-800">{{ $user->referral_link }}</a>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-300 text-sm leading-5 text-gray-900">{{ $user->referrals_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

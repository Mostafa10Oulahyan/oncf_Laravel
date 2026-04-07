@extends('layout')

@section('title', 'Admin Dashboard - ONCF')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header with Add Button -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">🎛️ Dashboard Admin</h1>
                <p class="text-gray-600 mt-1">Gérer les voyages ONCF</p>
            </div>
            <a href="{{ route('admin.voyages.create') }}" class="bg-oncf-blue text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition flex items-center shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un voyage
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-oncf-blue">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-oncf-blue">{{ $voyages->total() }}</div>
                        <div class="text-sm text-gray-600">Voyages</div>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-green-600">{{ \App\Models\Commande::count() }}</div>
                        <div class="text-sm text-gray-600">Commandes</div>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-purple-600">{{ \App\Models\Billet::count() }}</div>
                        <div class="text-sm text-gray-600">Billets vendus</div>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Voyages Table -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="p-6 border-b bg-gradient-to-r from-oncf-blue to-blue-600 text-white">
                <h2 class="text-xl font-bold">Tous les voyages</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Départ</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Arrivée</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Horaires</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Prix</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($voyages as $voyage)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-oncf-blue">{{ $voyage->code_voyage }}</span>
                            </td>
                            <td class="px-6 py-4">{{ $voyage->villeDepart }}</td>
                            <td class="px-6 py-4">{{ $voyage->villeDarrivee }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <span>{{ $voyage->heureDepart }}</span>
                                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                    <span>{{ $voyage->heureDarrivee }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900">{{ number_format($voyage->prixVoyage, 2) }} DH</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.voyages.edit', $voyage->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition p-2 hover:bg-blue-50 rounded-lg" 
                                       title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('admin.voyages.delete', $voyage->id) }}" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce voyage ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 transition p-2 hover:bg-red-50 rounded-lg" 
                                                title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-lg font-medium">Aucun voyage trouvé</p>
                                    <p class="text-sm text-gray-400 mt-1">Ajoutez votre premier voyage</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($voyages->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $voyages->links() }}
            </div>
            @endif
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center text-oncf-blue hover:text-blue-700 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection

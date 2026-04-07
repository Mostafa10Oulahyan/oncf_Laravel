@extends('layout')

@section('title', 'Résultats de recherche - ONCF')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Search Summary -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
            @if($villeDepart && $villeDarrivee)
                {{ $villeDepart }} → {{ $villeDarrivee }}
            @elseif($villeDepart)
                Départ de {{ $villeDepart }}
            @elseif($villeDarrivee)
                Vers {{ $villeDarrivee }}
            @else
                Tous les voyages
            @endif
        </h1>
        <p class="text-gray-600">{{ $voyages->count() }} voyage(s) disponible(s)</p>
    </div>
    
    <!-- Refine Search -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-8" x-data="{
        villeDepart: '{{ request('villeDepart', '') }}',
        villeDarrivee: '{{ request('villeDarrivee', '') }}',
        availableRoutes: {{ json_encode($availableRoutes ?? []) }},
        get arrivalOptions() {
            if (!this.villeDepart) return Object.values(this.availableRoutes).flat().filter((v, i, a) => a.indexOf(v) === i).sort();
            return this.availableRoutes[this.villeDepart] || [];
        },
        get departureOptions() {
            return Object.keys(this.availableRoutes).sort();
        }
    }">
        <form action="{{ url('/voyages/search') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Départ</label>
                <select name="villeDepart" x-model="villeDepart" @change="if(!arrivalOptions.includes(villeDarrivee)) villeDarrivee=''" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent">
                    <option value="">Toutes les villes</option>
                    <template x-for="city in departureOptions" :key="city">
                        <option :value="city" x-text="city"></option>
                    </template>
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Arrivée</label>
                <select name="villeDarrivee" x-model="villeDarrivee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent">
                    <option value="">Toutes les villes</option>
                    <template x-for="city in arrivalOptions" :key="city">
                        <option :value="city" x-text="city"></option>
                    </template>
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-oncf-blue text-white rounded-lg hover:bg-blue-800 transition">
                Filtrer
            </button>
        </form>
    </div>
    
    <!-- Results -->
    @if($voyages->isEmpty())
    <div class="text-center py-16">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun voyage trouvé</h3>
        <p class="text-gray-500 mb-4">Essayez de modifier vos critères de recherche</p>
        <a href="{{ url('/') }}" class="inline-block px-6 py-2 bg-oncf-blue text-white rounded-lg hover:bg-blue-800 transition">
            Nouvelle recherche
        </a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($voyages as $voyage)
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden" 
             x-data="{ quantity: 1 }">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Trip Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-3">
                            <!-- Code & Badges -->
                            <span class="text-sm font-mono bg-gray-100 px-2 py-1 rounded">{{ $voyage->code_voyage }}</span>
                            @if($loop->first)
                            <span class="text-xs font-semibold bg-green-100 text-green-700 px-2 py-1 rounded-full">Direct</span>
                            @endif
                            @if($voyage->prixVoyage < 100)
                            <span class="text-xs font-semibold bg-orange-100 text-orange-700 px-2 py-1 rounded-full">Promo</span>
                            @endif
                        </div>
                        
                        <!-- Times & Cities -->
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($voyage->heureDepart)->format('H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $voyage->villeDepart }}</div>
                            </div>
                            
                            <div class="flex-1 flex items-center px-4">
                                <div class="flex-1 border-t-2 border-dashed border-gray-300"></div>
                                <svg class="w-6 h-6 text-oncf-blue mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                <div class="flex-1 border-t-2 border-dashed border-gray-300"></div>
                            </div>
                            
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($voyage->heureDarrivee)->format('H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $voyage->villeDarrivee }}</div>
                            </div>
                        </div>
                        
                        <!-- Duration -->
                        @php
                            $depart = \Carbon\Carbon::parse($voyage->heureDepart);
                            $arrivee = \Carbon\Carbon::parse($voyage->heureDarrivee);
                            $duration = $depart->diff($arrivee);
                        @endphp
                        <div class="text-sm text-gray-500 mt-2">
                            Durée: {{ $duration->format('%Hh%I') }}
                        </div>
                    </div>
                    
                    <!-- Price & Add to Cart -->
                    <div class="flex flex-col items-end gap-3">
                        <div class="text-right">
                            <div class="text-3xl font-bold text-oncf-blue">{{ number_format($voyage->prixVoyage, 2) }} DH</div>
                            <div class="text-sm text-gray-500">par personne</div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600">Qté:</label>
                            <select x-model="quantity" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue">
                                @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <form action="{{ url('/cart/add/' . $voyage->id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="quantity" :value="quantity">
                            <button type="submit" 
                                class="px-6 py-3 bg-oncf-blue text-white font-semibold rounded-lg hover:bg-blue-800 transition-all transform hover:scale-105 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

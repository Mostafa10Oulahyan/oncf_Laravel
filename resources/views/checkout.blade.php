@extends('layout')

@section('title', 'Informations Passagers - ONCF')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex items-center justify-center space-x-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">✓</div>
                <span class="ml-2 text-sm text-gray-600">Panier</span>
            </div>
            <div class="w-16 h-1 bg-oncf-blue rounded"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-oncf-blue text-white rounded-full flex items-center justify-center text-sm font-bold">2</div>
                <span class="ml-2 text-sm font-semibold text-oncf-blue">Passagers</span>
            </div>
            <div class="w-16 h-1 bg-gray-300 rounded"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                <span class="ml-2 text-sm text-gray-600">Paiement</span>
            </div>
        </div>
    </div>
    
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Informations des passagers</h1>
    <p class="text-gray-600 mb-8">Remplissez les informations pour chaque passager ({{ $totalTickets }} billet(s))</p>
    
    <form action="{{ url('/checkout') }}" method="POST" id="checkout-form">
        @csrf
        
        @php $passengerIndex = 0; @endphp
        
        @foreach($cart as $id => $item)
            @for($i = 0; $i < $item['quantity']; $i++)
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Passager {{ $passengerIndex + 1 }}
                    </h3>
                    <span class="text-sm bg-oncf-blue/10 text-oncf-blue px-3 py-1 rounded-full">
                        {{ $item['villeDepart'] }} → {{ $item['villeDarrivee'] }}
                    </span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                        <input type="text" 
                            name="passengers[{{ $passengerIndex }}][nom]" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                            placeholder="Ex: ALAMI">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                        <input type="text" 
                            name="passengers[{{ $passengerIndex }}][prenom]" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                            placeholder="Ex: Mohammed">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CIN *</label>
                        <input type="text" 
                            name="passengers[{{ $passengerIndex }}][cin]" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                            placeholder="Ex: AB123456">
                    </div>
                </div>
            </div>
            @php $passengerIndex++; @endphp
            @endfor
        @endforeach
        
        <!-- Summary -->
        <div class="bg-gray-50 rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Récapitulatif</h3>
            <div class="space-y-2">
                @foreach($cart as $item)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">{{ $item['villeDepart'] }} → {{ $item['villeDarrivee'] }} (x{{ $item['quantity'] }})</span>
                    <span class="font-medium">{{ number_format($item['prix'] * $item['quantity'], 2) }} DH</span>
                </div>
                @endforeach
                <div class="border-t pt-2 mt-2">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-oncf-blue">{{ number_format($total, 2) }} DH</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-between">
            <a href="{{ url('/cart') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-center">
                ← Retour au panier
            </a>
            <button type="submit" class="px-8 py-3 bg-oncf-blue text-white font-semibold rounded-lg hover:bg-blue-800 transition flex items-center justify-center gap-2">
                Continuer vers le paiement
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection

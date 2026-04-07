@extends('layout')

@section('title', 'Paiement - ONCF')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex items-center justify-center space-x-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">✓</div>
                <span class="ml-2 text-sm text-gray-600">Panier</span>
            </div>
            <div class="w-16 h-1 bg-green-500 rounded"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">✓</div>
                <span class="ml-2 text-sm text-gray-600">Passagers</span>
            </div>
            <div class="w-16 h-1 bg-oncf-blue rounded"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-oncf-blue text-white rounded-full flex items-center justify-center text-sm font-bold">3</div>
                <span class="ml-2 text-sm font-semibold text-oncf-blue">Paiement</span>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Order Summary -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Récapitulatif de la commande</h2>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-sm text-gray-500 mb-4">
                    Commande #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }} - {{ $commande->date_comm }}
                </div>
                
                <div class="space-y-4">
                    @foreach($commande->voyages as $voyage)
                    <div class="flex items-center justify-between py-3 border-b last:border-0">
                        <div>
                            <div class="font-semibold text-gray-800">
                                {{ $voyage->villeDepart }} → {{ $voyage->villeDarrivee }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($voyage->heureDepart)->format('H:i') }} - {{ \Carbon\Carbon::parse($voyage->heureDarrivee)->format('H:i') }}
                            </div>
                            <div class="text-xs text-gray-400">
                                Code: {{ $voyage->code_voyage }} | {{ $voyage->pivot->qte }} billet(s)
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-oncf-blue">
                                {{ number_format($voyage->prixVoyage * $voyage->pivot->qte, 2) }} DH
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-between text-xl font-bold">
                        <span>Total à payer</span>
                        <span class="text-oncf-blue">{{ number_format($total, 2) }} DH</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Payment Form -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Mode de paiement</h2>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <!-- Payment Method Tabs -->
                <div class="flex gap-2 mb-6" x-data="{ method: 'card' }">
                    <button @click="method = 'card'" 
                        :class="method === 'card' ? 'bg-oncf-blue text-white' : 'bg-gray-100 text-gray-700'"
                        class="flex-1 py-3 px-4 rounded-lg font-medium transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Carte bancaire
                    </button>
                    <button @click="method = 'cash'" 
                        :class="method === 'cash' ? 'bg-oncf-blue text-white' : 'bg-gray-100 text-gray-700'"
                        class="flex-1 py-3 px-4 rounded-lg font-medium transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Paiement en gare
                    </button>
                </div>
                
                <form action="{{ url('/payment') }}" method="POST">
                    @csrf
                    
                    <!-- Card Form (Simulation) -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de carte</label>
                            <input type="text" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                                placeholder="1234 5678 9012 3456"
                                maxlength="19">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date d'expiration</label>
                                <input type="text" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                                    placeholder="MM/AA"
                                    maxlength="5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input type="text" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                                    placeholder="123"
                                    maxlength="3">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titulaire de la carte</label>
                            <input type="text" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                                placeholder="Nom sur la carte">
                        </div>
                    </div>
                    
                    <!-- Security Note -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-gray-600">
                                <strong>Paiement sécurisé</strong><br>
                                Vos informations sont protégées par un cryptage SSL 256 bits.
                                <span class="text-xs text-gray-400 block mt-1">(Simulation - Aucune donnée réelle n'est traitée)</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" 
                        class="w-full mt-6 px-6 py-4 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all transform hover:scale-[1.02] shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Confirmer et payer {{ number_format($total, 2) }} DH
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

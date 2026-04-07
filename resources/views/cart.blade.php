@extends('layout')

@section('title', 'Mon Panier - ONCF')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">Mon Panier</h1>
    
    @if(empty($cart))
    <!-- Empty Cart -->
    <div class="text-center py-16 bg-white rounded-xl shadow-md">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Votre panier est vide</h3>
        <p class="text-gray-500 mb-6">Recherchez un voyage et ajoutez-le à votre panier</p>
        <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-oncf-blue text-white rounded-lg hover:bg-blue-800 transition">
            Rechercher un voyage
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $id => $item)
            <div class="bg-white rounded-xl shadow-md p-6 cart-item" data-id="{{ $id }}">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Trip Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-sm font-mono bg-gray-100 px-2 py-1 rounded">{{ $item['code_voyage'] }}</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="text-xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($item['heureDepart'])->format('H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $item['villeDepart'] }}</div>
                            </div>
                            
                            <svg class="w-6 h-6 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            
                            <div>
                                <div class="text-xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($item['heureDarrivee'])->format('H:i') }}</div>
                                <div class="text-sm text-gray-500">{{ $item['villeDarrivee'] }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Price & Quantity -->
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <div class="text-lg font-bold text-oncf-blue">{{ number_format($item['prix'], 2) }} DH</div>
                            <div class="text-xs text-gray-500">par billet</div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600">Qté:</label>
                            <input type="number" value="{{ $item['quantity'] }}" min="1" max="10"
                                class="quantity-input w-16 px-2 py-2 border border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-oncf-blue" />
                        </div>
                        
                        <div class="text-right">
                            <div class="text-xl font-bold text-gray-800 subtotal">
                                {{ number_format($item['prix'] * $item['quantity'], 2) }} DH
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="update-btn p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Mettre à jour">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </button>
                            <button class="remove-btn p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Récapitulatif</h2>
                
                <div class="space-y-4 mb-6">
                    @foreach($cart as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $item['villeDepart'] }} → {{ $item['villeDarrivee'] }} (x{{ $item['quantity'] }})</span>
                        <span class="font-medium">{{ number_format($item['prix'] * $item['quantity'], 2) }} DH</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t pt-4 mb-6">
                    <div class="flex justify-between text-lg">
                        <span class="font-semibold text-gray-800">Total</span>
                        <span class="font-bold text-oncf-blue text-xl" id="grand-total">{{ number_format($total, 2) }} DH</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">{{ array_sum(array_column($cart, 'quantity')) }} billet(s)</p>
                </div>
                
                @auth
                <a href="{{ url('/checkout') }}" 
                    class="w-full block text-center px-6 py-4 bg-oncf-blue text-white font-semibold rounded-xl hover:bg-blue-800 transition-all transform hover:scale-[1.02] shadow-lg">
                    Procéder au paiement
                </a>
                @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-4">
                    <div class="flex items-center text-yellow-800">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium">Connectez-vous pour procéder au paiement</span>
                    </div>
                </div>
                <a href="{{ url('/login') }}" 
                    class="w-full block text-center px-6 py-4 bg-oncf-blue text-white font-semibold rounded-xl hover:bg-blue-800 transition-all transform hover:scale-[1.02] shadow-lg">
                    Se connecter pour continuer
                </a>
                @endauth
                
                <a href="{{ url('/cart/clear') }}" 
                    class="w-full block text-center px-6 py-2 mt-3 text-red-500 hover:text-red-700 transition text-sm">
                    Vider le panier
                </a>
                
                <a href="{{ url('/') }}" 
                    class="w-full block text-center px-6 py-2 mt-2 text-gray-500 hover:text-oncf-blue transition text-sm">
                    ← Continuer mes achats
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Update quantity
    $('.update-btn').click(function(e) {
        e.preventDefault();
        var item = $(this).closest('.cart-item');
        var id = item.data('id');
        var quantity = item.find('.quantity-input').val();
        
        $.ajax({
            url: '{{ url("/cart/update") }}',
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity
            },
            success: function(response) {
                location.reload();
            }
        });
    });
    
    // Remove item
    $('.remove-btn').click(function(e) {
        e.preventDefault();
        var item = $(this).closest('.cart-item');
        var id = item.data('id');
        
        if (confirm('Voulez-vous vraiment supprimer ce voyage?')) {
            $.ajax({
                url: '{{ url("/cart/remove") }}',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
});
</script>
@endsection

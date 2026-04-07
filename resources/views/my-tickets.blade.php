@extends('layout')

@section('title', 'Mes Billets - ONCF')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Mes Billets</h1>
            <p class="text-gray-600 mt-2">Consultez tous vos billets de train ONCF</p>
        </div>

        @if($commandes->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Aucun billet trouvé</h2>
            <p class="text-gray-600 mb-8">Vous n'avez pas encore réservé de billets</p>
            <a href="{{ url('/') }}" class="inline-block bg-oncf-blue text-white px-8 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Rechercher un voyage
            </a>
        </div>
        @else
        <!-- Commandes List -->
        <div class="space-y-8">
            @foreach($commandes as $commande)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Commande Header -->
                <div class="bg-gradient-to-r from-oncf-blue to-blue-600 px-6 py-4 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">Commande #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</h3>
                            <p class="text-blue-100 text-sm">{{ \Carbon\Carbon::parse($commande->date_comm)->format('d/m/Y à H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-blue-100">{{ $commande->billets->count() }} billet(s)</div>
                            <div class="text-xl font-bold">{{ number_format($commande->billets->sum(function($b) { return $b->voyage->prixVoyage * $b->qte; }), 2) }} DH</div>
                        </div>
                    </div>
                </div>

                <!-- Billets -->
                <div class="divide-y">
                    @foreach($commande->billets as $billet)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <!-- Trip Info -->
                            <div class="flex-1">
                                <div class="flex items-center gap-6">
                                    <!-- Departure -->
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-gray-800">{{ $billet->voyage->heureDepart }}</div>
                                        <div class="text-sm text-gray-600">{{ $billet->voyage->villeDepart }}</div>
                                    </div>

                                    <!-- Arrow -->
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="text-xs text-gray-500 mb-1">
                                            @php
                                                $depart = \Carbon\Carbon::parse($billet->voyage->heureDepart);
                                                $arrivee = \Carbon\Carbon::parse($billet->voyage->heureDarrivee);
                                                $duration = $depart->diff($arrivee);
                                            @endphp
                                            {{ $duration->format('%hh%i') }}
                                        </div>
                                        <div class="w-full border-t-2 border-gray-300 relative">
                                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-2">
                                                <svg class="w-5 h-5 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">Direct</div>
                                    </div>

                                    <!-- Arrival -->
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-gray-800">{{ $billet->voyage->heureDarrivee }}</div>
                                        <div class="text-sm text-gray-600">{{ $billet->voyage->villeDarrivee }}</div>
                                    </div>
                                </div>

                                <!-- Passenger Info -->
                                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Passager</span>
                                        <div class="font-semibold text-gray-800">{{ $billet->prenom_passager }} {{ $billet->nom_passager }}</div>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">CIN</span>
                                        <div class="font-semibold text-gray-800">{{ $billet->cin_passager }}</div>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Train</span>
                                        <div class="font-semibold text-oncf-blue">{{ $billet->voyage->code_voyage }}</div>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Prix</span>
                                        <div class="font-bold text-gray-800">{{ number_format($billet->voyage->prixVoyage, 2) }} DH</div>
                                    </div>
                                </div>
                            </div>

                            <!-- QR Code -->
                            <div class="flex flex-col items-center justify-center border-l-2 border-dashed border-gray-200 pl-6">
                                <div class="w-24 h-24">
                                    <?php 
                                    $qrData = "ONCF Billet\n";
                                    $qrData .= "ID: " . str_pad($billet->id, 8, '0', STR_PAD_LEFT) . "\n";
                                    $qrData .= "Passager: " . ($billet->prenom_passager ?? 'N/A') . " " . ($billet->nom_passager ?? '') . "\n";
                                    $qrData .= "CIN: " . ($billet->cin_passager ?? 'N/A') . "\n";
                                    $qrData .= "Train: " . $billet->voyage->code_voyage . "\n";
                                    $qrData .= "De: " . $billet->voyage->villeDepart . " (" . $billet->voyage->heureDepart . ")\n";
                                    $qrData .= "A: " . $billet->voyage->villeDarrivee . " (" . $billet->voyage->heureDarrivee . ")\n";
                                    $qrData .= "Prix: " . number_format($billet->voyage->prixVoyage, 2) . " DH";
                                    ?>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=96x96&data={{ urlencode($qrData) }}" 
                                         alt="QR Code" 
                                         class="w-full h-full">
                                </div>
                                <div class="text-xs text-gray-500 mt-2">N° {{ str_pad($billet->id, 8, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Print Button -->
                <div class="bg-gray-50 px-6 py-4 border-t">
                    <button onclick="window.print()" class="w-full bg-oncf-blue text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Imprimer les billets
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center text-oncf-blue hover:text-blue-700 font-medium transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    nav, footer, button {
        display: none !important;
    }
}
</style>
@endsection

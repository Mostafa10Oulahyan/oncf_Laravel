@extends('layout')

@section('title', 'Confirmation - Vos Billets ONCF')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Success Message -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Réservation confirmée!</h1>
        <p class="text-gray-600">Vos billets sont prêts. Vous pouvez les imprimer ou les montrer sur votre téléphone.</p>
        <p class="text-sm text-gray-500 mt-2">Commande #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</p>
    </div>
    
    <!-- Tickets -->
    <div class="space-y-6">
        @foreach($billets as $index => $billet)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden print:shadow-none print:border" id="ticket-{{ $billet->id }}">
            <!-- Ticket Header -->
            <div class="gradient-oncf text-white p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('lo.png') }}" alt="ONCF" class="h-8 bg-white rounded px-2 py-1">
                    <span class="font-semibold">BILLET DE TRAIN</span>
                </div>
                <div class="text-right text-sm">
                    <div>{{ $commande->date_comm }}</div>
                    <div class="opacity-75">N° {{ str_pad($billet->id, 8, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>
            
            <!-- Ticket Body -->
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Journey Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-6">
                            <!-- Departure -->
                            <div class="text-center flex-1">
                                <div class="text-3xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($billet->voyage->heureDepart)->format('H:i') }}</div>
                                <div class="text-lg font-semibold text-oncf-blue">{{ $billet->voyage->villeDepart }}</div>
                            </div>
                            
                            <!-- Arrow -->
                            <div class="flex flex-col items-center px-4">
                                <div class="text-xs text-gray-500 mb-1">
                                    @php
                                        $depart = \Carbon\Carbon::parse($billet->voyage->heureDepart);
                                        $arrivee = \Carbon\Carbon::parse($billet->voyage->heureDarrivee);
                                        $duration = $depart->diff($arrivee);
                                    @endphp
                                    {{ $duration->format('%Hh%I') }}
                                </div>
                                <div class="w-24 flex items-center">
                                    <div class="flex-1 border-t-2 border-oncf-blue"></div>
                                    <svg class="w-4 h-4 text-oncf-blue -ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="text-xs text-gray-400">Direct</div>
                            </div>
                            
                            <!-- Arrival -->
                            <div class="text-center flex-1">
                                <div class="text-3xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($billet->voyage->heureDarrivee)->format('H:i') }}</div>
                                <div class="text-lg font-semibold text-oncf-blue">{{ $billet->voyage->villeDarrivee }}</div>
                            </div>
                        </div>
                        
                        <!-- Passenger Info -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500">Passager</span>
                                    <div class="font-semibold text-gray-800">
                                        {{ $billet->prenom_passager ?? 'N/A' }} {{ $billet->nom_passager ?? '' }}
                                    </div>
                                </div>
                                <div>
                                    <span class="text-gray-500">CIN</span>
                                    <div class="font-semibold text-gray-800">{{ $billet->cin_passager ?? 'N/A' }}</div>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-gray-500">Train</span>
                                    <div class="font-semibold text-gray-800">{{ $billet->voyage->code_voyage }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- QR Code & Price -->
                    <div class="md:w-48 flex flex-col items-center justify-center border-l-2 border-dashed border-gray-200 pl-6">
                        <!-- QR Code with Full Passenger Info -->
                        <div class="w-32 h-32 mb-4">
                            <?php 
                            $qrData = "ONCF Billet\n";
                            $qrData .= "ID: " . str_pad($billet->id, 8, '0', STR_PAD_LEFT) . "\n";
                            $qrData .= "Passager: " . ($billet->prenom_passager ?? 'N/A') . " " . ($billet->nom_passager ?? '') . "\n";
                            $qrData .= "CIN: " . ($billet->cin_passager ?? 'N/A') . "\n";
                            $qrData .= "Train: " . $billet->voyage->code_voyage . "\n";
                            $qrData .= "De: " . $billet->voyage->villeDepart . " (" . $billet->voyage->heureDepart . ")\n";
                            $qrData .= "A: " . $billet->voyage->villeDarrivee . " (" . $billet->voyage->heureDarrivee . ")\n";
                            $qrData .= "Prix: " . number_format($billet->voyage->effective_price, 2) . " DH\n";
                            $qrData .= "Date: " . date('Y-m-d H:i');
                            ?>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=128x128&data={{ urlencode($qrData) }}" 
                                 alt="QR Code" 
                                 class="w-full h-full">
                        </div>
                        
                        <div class="text-center">
                            <div class="text-sm text-gray-500">Prix</div>
                            <div class="text-2xl font-bold text-oncf-blue">{{ number_format($billet->voyage->effective_price, 2) }} DH</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Ticket Footer -->
            <div class="bg-gray-50 px-6 py-3 text-xs text-gray-500 flex items-center justify-between border-t">
                <span>Présentez ce billet avec une pièce d'identité valide</span>
                <span>ONCF - find ur set in one Second</span>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Actions -->
    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center print:hidden">
        <button onclick="window.print()" 
            class="px-8 py-3 bg-oncf-blue text-white font-semibold rounded-xl hover:bg-blue-800 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Imprimer les billets
        </button>
        
        <a href="{{ url('/') }}" 
            class="px-8 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition text-center">
            Retour à l'accueil
        </a>
    </div>
    
    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 rounded-xl p-6 print:hidden">
        <h3 class="font-semibold text-oncf-blue mb-2">Informations importantes</h3>
        <ul class="text-sm text-gray-600 space-y-1">
            <li>• Présentez-vous en gare au moins 15 minutes avant le départ</li>
            <li>• Ce billet est valable uniquement pour le train et la date indiqués</li>
            <li>• Une pièce d'identité en cours de validité sera demandée</li>
            <li>• En cas de perte, le billet ne pourra pas être remboursé</li>
        </ul>
    </div>
</div>

<style>
@media print {
    body { background: white !important; }
    nav, footer { display: none !important; }
    .print\:hidden { display: none !important; }
    .print\:shadow-none { box-shadow: none !important; }
    .print\:border { border: 1px solid #e5e7eb !important; }
}
</style>
@endsection

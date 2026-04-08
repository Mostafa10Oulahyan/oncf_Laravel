@extends('layout')

@section('title', 'Ajouter un Voyage - Admin')

@section('content')
<script src="https://unpkg.com/lucide@latest"></script>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4">
        <div class="mb-8 flex items-center gap-3">
            <div class="w-10 h-10 bg-oncf-blue rounded-xl flex items-center justify-center shadow">
                <i data-lucide="plus" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Ajouter un Voyage</h1>
                <p class="text-gray-600 mt-1">Créer un nouveau voyage ONCF</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('admin.voyages.store') }}">
                @csrf

                @if($errors->any())
                <div class="bg-red-100 text-red-700 px-6 py-4 rounded-xl mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Code Voyage -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Code du Voyage *</label>
                    <input type="text" name="code_voyage" value="{{ old('code_voyage') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                           placeholder="Ex: ONCF003">
                </div>

                <!-- Ville Départ & Arrivée -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ville de Départ *</label>
                        <input type="text" name="villeDepart" value="{{ old('villeDepart') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                               placeholder="Ex: Casablanca">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ville d'Arrivée *</label>
                        <input type="text" name="villeDarrivee" value="{{ old('villeDarrivee') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                               placeholder="Ex: Marrakech">
                    </div>
                </div>

                <!-- Heure Départ & Arrivée -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Heure de Départ *</label>
                        <input type="time" name="heureDepart" value="{{ old('heureDepart') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Heure d'Arrivée *</label>
                        <input type="time" name="heureDarrivee" value="{{ old('heureDarrivee') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent">
                    </div>
                </div>

                <!-- Prix -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix Normal (DH) *</label>
                    <input type="number" name="prixVoyage" value="{{ old('prixVoyage') }}" required min="0" step="0.01"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                           placeholder="Ex: 120.00">
                </div>

                <!-- Promo Section -->
                <div class="mb-8 bg-orange-50 border border-orange-200 rounded-xl p-5" x-data="{ isPromo: {{ old('is_promo') ? 'true' : 'false' }} }">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="font-semibold text-gray-800">🏷️ Activer une Promotion</p>
                            <p class="text-sm text-gray-500">Le prix promotionnel sera affiché avec le prix barré</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_promo" value="1" x-model="isPromo" class="sr-only peer"
                                   {{ old('is_promo') ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                        </label>
                    </div>
                    <div x-show="isPromo" x-transition class="mt-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prix Promotionnel (DH) *</label>
                        <input type="number" name="price_promo" value="{{ old('price_promo') }}" min="0" step="0.01"
                               :required="isPromo"
                               class="w-full px-4 py-3 border border-orange-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent bg-white"
                               placeholder="Ex: 75.00">
                        <p class="text-xs text-orange-600 mt-1">💡 Ce prix doit être inférieur au prix normal</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium transition">
                        ← Annuler
                    </a>
                    <button type="submit" 
                            class="bg-oncf-blue text-white px-8 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-lg">
                        Créer le voyage
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
@endsection

@extends('layout')

@section('title', 'Modifier un Voyage - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">✏️ Modifier le Voyage</h1>
            <p class="text-gray-600 mt-2">{{ $voyage->code_voyage }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('admin.voyages.update', $voyage->id) }}">
                @csrf
                @method('PUT')

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
                    <input type="text" name="code_voyage" value="{{ old('code_voyage', $voyage->code_voyage) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                           placeholder="Ex: ONCF003">
                </div>

                <!-- Ville Départ & Arrivée -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ville de Départ *</label>
                        <input type="text" name="villeDepart" value="{{ old('villeDepart', $voyage->villeDepart) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                               placeholder="Ex: Casablanca">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ville d'Arrivée *</label>
                        <input type="text" name="villeDarrivee" value="{{ old('villeDarrivee', $voyage->villeDarrivee) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                               placeholder="Ex: Marrakech">
                    </div>
                </div>

                <!-- Heure Départ & Arrivée -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Heure de Départ *</label>
                        <input type="time" name="heureDepart" value="{{ old('heureDepart', $voyage->heureDepart) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Heure d'Arrivée *</label>
                        <input type="time" name="heureDarrivee" value="{{ old('heureDarrivee', $voyage->heureDarrivee) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent">
                    </div>
                </div>

                <!-- Prix -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix (DH) *</label>
                    <input type="number" name="prixVoyage" value="{{ old('prixVoyage', $voyage->prixVoyage) }}" required min="0" step="0.01"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                           placeholder="Ex: 120.00">
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium transition">
                        ← Annuler
                    </a>
                    <button type="submit" 
                            class="bg-oncf-blue text-white px-8 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-lg">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

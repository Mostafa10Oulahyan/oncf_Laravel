@extends('layout')

@section('title', 'Inscription - ONCF')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <img src="{{ asset('lo.png') }}" alt="ONCF" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Créer un compte</h1>
            <p class="text-gray-600 mt-2">Rejoignez ONCF pour réserver vos billets</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ url('/register') }}">
                @csrf
                
                @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                            placeholder="Mohammed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                            placeholder="ALAMI">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom d'utilisateur</label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="Choisissez un nom d'utilisateur">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="votre@email.com">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                    <input type="tel" name="tel" value="{{ old('tel') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="06XXXXXXXX">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="Minimum 6 caractères">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="Confirmez votre mot de passe">
                </div>
                
                <button type="submit" 
                    class="w-full bg-oncf-blue text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-800 transition">
                    Créer mon compte
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Déjà inscrit? 
                    <a href="{{ url('/login') }}" class="text-oncf-blue font-semibold hover:underline">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

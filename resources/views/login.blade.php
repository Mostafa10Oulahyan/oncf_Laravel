@extends('layout')

@section('title', 'Connexion - ONCF')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <img src="{{ asset('lo.png') }}" alt="ONCF" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Connexion</h1>
            <p class="text-gray-600 mt-2">Accédez à votre compte ONCF</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                
                @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                    {{ $errors->first() }}
                </div>
                @endif
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom d'utilisateur</label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="Votre nom d'utilisateur">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-oncf-blue focus:border-transparent"
                        placeholder="Votre mot de passe">
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-oncf-blue focus:ring-oncf-blue">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                    <a href="#" class="text-sm text-oncf-blue hover:underline">Mot de passe oublié?</a>
                </div>
                
                <button type="submit" 
                    class="w-full bg-oncf-blue text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-800 transition">
                    Se connecter
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Pas encore de compte? 
                    <a href="{{ url('/register') }}" class="text-oncf-blue font-semibold hover:underline">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

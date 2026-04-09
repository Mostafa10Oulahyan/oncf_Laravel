@extends('layout')

@section('title', 'Page Non Trouvée - ONCF')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4">
        <div class="max-w-xl w-full text-center">
            <!-- Animated Icon Container -->
            <div class="relative mb-8 flex justify-center">
                <div class="w-48 h-48 bg-blue-50 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-32 h-32 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <!-- Decorative Dots -->
                <div class="absolute -top-4 -right-4 w-8 h-8 bg-blue-100 rounded-full animate-bounce"></div>
                <div class="absolute -bottom-2 -left-6 w-12 h-12 bg-oncf-blue/10 rounded-full animate-bounce"
                    style="animation-delay: 0.5s"></div>
            </div>

            <h1 class="text-9xl font-extrabold text-oncf-blue mb-4">404</h1>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Oups ! Ce train est déjà parti</h2>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                La page que vous recherchez semble introuvable. Elle a peut-être été déplacée ou supprimée de nos horaires.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}"
                    class="px-8 py-4 bg-oncf-blue text-white font-bold rounded-2xl hover:bg-blue-800 transition shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Retour à l'accueil
                </a>
                <a href="{{ route('contact') }}"
                    class="px-8 py-4 border-2 border-oncf-blue text-oncf-blue font-bold rounded-2xl hover:bg-blue-50 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Contacter le support
                </a>
            </div>

            <div class="mt-12 text-gray-400 text-sm italic">
                "Un voyage de mille lieues commence toujours par un premier pas... ou une page qui fonctionne !"
            </div>
        </div>
    </div>
@endsection
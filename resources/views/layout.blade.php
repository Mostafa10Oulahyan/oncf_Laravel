<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ONCF - Reservation de billets de train')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'oncf-blue': '#1e3a5f',
                        'oncf-light': '#3b82f6',
                        'oncf-cyan': '#06b6d4',
                        'oncf-purple': '#6366f1',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-oncf {
            background: linear-gradient(135deg, #1e3a5f 0%, #3b82f6 50%, #06b6d4 100%);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Nav link hover effect */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #1e3a5f;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="h-full bg-gray-50 flex flex-col" x-data="{ mobileMenu: false }">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('lo.png') }}" alt="ONCF" class="h-10">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}"
                        class="nav-link text-gray-700 hover:text-oncf-blue font-medium transition">Accueil</a>
                    <a href="{{ route('about') }}"
                        class="nav-link text-gray-700 hover:text-oncf-blue font-medium transition">A Propos</a>
                    <a href="{{ route('contact') }}"
                        class="nav-link text-gray-700 hover:text-oncf-blue font-medium transition">Contact</a>
                    <a href="{{ url('/cart') }}"
                        class="relative text-gray-700 hover:text-oncf-blue font-medium transition flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Panier
                        @if(session('cart') && count(session('cart')) > 0)
                            <span
                                class="absolute -top-2 -right-4 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                    @auth
                        @php
                            $userBilletsCount = \App\Models\Billet::whereHas('commande', function ($q) {
                                $q->where('id_client', auth()->id())->where('status', 'PAID');
                            })->count();
                        @endphp
                        @if($userBilletsCount > 0)
                            <a href="{{ route('my-tickets') }}"
                                class="relative text-gray-700 hover:text-oncf-blue font-medium transition flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                Mes Billets
                                <span
                                    class="ml-1 bg-oncf-blue text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $userBilletsCount }}
                                </span>
                            </a>
                        @endif
                        @if(strtoupper(auth()->user()->role) === 'ADMIN')
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-purple-600 hover:text-purple-800 font-medium transition flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Admin
                            </a>
                        @endif
                        <span class="text-gray-600">Bonjour, {{ auth()->user()->prenom }}</span>
                        <form method="POST" action="{{ url('/logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-gray-700 hover:text-red-500 font-medium transition">Deconnexion</button>
                        </form>
                    @else
                        <a href="{{ url('/login') }}"
                            class="text-gray-700 hover:text-oncf-blue font-medium transition">Connexion</a>
                        <a href="{{ url('/register') }}"
                            class="bg-oncf-blue text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Inscription</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-transition class="md:hidden bg-white border-t">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ url('/') }}" class="block text-gray-700 hover:text-oncf-blue font-medium">Accueil</a>
                <a href="{{ route('about') }}" class="block text-gray-700 hover:text-oncf-blue font-medium">A Propos</a>
                <a href="{{ route('contact') }}"
                    class="block text-gray-700 hover:text-oncf-blue font-medium">Contact</a>
                <a href="{{ url('/cart') }}" class="block text-gray-700 hover:text-oncf-blue font-medium">Panier</a>
                @auth
                    @php
                        $userBilletsCount = \App\Models\Billet::whereHas('commande', function ($q) {
                            $q->where('id_client', auth()->id())->where('status', 'PAID');
                        })->count();
                    @endphp
                    @if($userBilletsCount > 0)
                        <a href="{{ route('my-tickets') }}" class="block text-gray-700 hover:text-oncf-blue font-medium">
                            Mes Billets <span
                                class="bg-oncf-blue text-white text-xs rounded-full px-2 py-1">{{ $userBilletsCount }}</span>
                        </a>
                    @endif
                    @if(strtoupper(auth()->user()->role) === 'ADMIN')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block text-purple-600 hover:text-purple-800 font-medium">Admin</a>
                    @endif
                    <span class="block text-gray-600">Bonjour, {{ auth()->user()->prenom }}</span>
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 font-medium">Deconnexion</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="block text-gray-700 hover:text-oncf-blue font-medium">Connexion</a>
                    <a href="{{ url('/register') }}" class="block text-oncf-blue font-medium">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between"
                x-data="{ show: true }" x-show="show" x-transition>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-700 hover:text-green-900">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between"
                x-data="{ show: true }" x-show="show" x-transition>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-red-700 hover:text-red-900">&times;</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-oncf-blue text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <img src="{{ asset('lo.png') }}" alt="ONCF" class="h-12 mb-4 bg-white rounded px-2 py-1">
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        L'Office National des Chemins de Fer - Connecter le Maroc avec excellence depuis 1963.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-6 text-lg">Navigation</h4>
                    <ul class="space-y-3 text-gray-300 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition">Accueil</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">A Propos</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                        <li><a href="{{ url('/cart') }}" class="hover:text-white transition">Mon Panier</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="font-semibold mb-6 text-lg">Services</h4>
                    <ul class="space-y-3 text-gray-300 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition">Reservation en Ligne</a></li>
                        <li><a href="#" class="hover:text-white transition">Al Boraq TGV</a></li>
                        <li><a href="#" class="hover:text-white transition">Trains Regionaux</a></li>
                        <li><a href="#" class="hover:text-white transition">Abonnements</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-6 text-lg">Contact</h4>
                    <ul class="space-y-3 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <span class="mr-3 mt-0.5">Tel:</span>
                            <span>0800-00-ONCF (6623)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-3 mt-0.5">Email:</span>
                            <span>contact@oncf.ma</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-3 mt-0.5">Adresse:</span>
                            <span>8, bis Rue Abderrahmane El Ghafiki, Agdal, Rabat</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/20 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} ONCF - Office National des Chemins de Fer. Tous droits reserves.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Mentions Legales</a>
                        <a href="#" class="hover:text-white transition">Politique de Confidentialite</a>
                        <a href="#" class="hover:text-white transition">CGV</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>
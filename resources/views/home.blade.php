@extends('layout')

@section('title', 'ONCF Voyage - Reservez votre billet de train')

@section('content')
<!-- Lucide Icons CDN -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Hero Section with Train Background -->
<div class="relative min-h-[90vh] flex items-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('trains/hero.png') }}"
             alt="High Speed Train"
             class="w-full h-full object-cover hero-bg">
        <div class="absolute inset-0 bg-gradient-to-r from-oncf-blue/90 via-oncf-blue/70 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-20 w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-white hero-content">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    <span class="italic">Precision Meets</span><br>
                    <span class="italic text-cyan-300">Seamless Mobility.</span>
                </h1>
                <p class="text-xl text-gray-200 mb-8 max-w-lg">
                    Experience Morocco's premier high-speed rail network. Book your next journey with effortless precision across our modern network.
                </p>

                <!-- Steps Indicator -->
                <div class="flex items-center space-x-4 mb-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-white text-oncf-blue rounded-full flex items-center justify-center font-bold text-sm">1</div>
                        <div class="ml-2 text-sm font-medium">SEARCH</div>
                    </div>
                    <div class="w-12 h-0.5 bg-white/50"></div>
                    <div class="flex items-center opacity-60">
                        <div class="w-8 h-8 border-2 border-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
                        <div class="ml-2 text-sm">SELECT</div>
                    </div>
                    <div class="w-12 h-0.5 bg-white/30"></div>
                    <div class="flex items-center opacity-40">
                        <div class="w-8 h-8 border-2 border-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
                        <div class="ml-2 text-sm">BOOK</div>
                    </div>
                </div>
            </div>

            <!-- Search Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 search-card" x-data="{
                villeDepart: '{{ request('villeDepart', '') }}',
                villeDarrivee: '{{ request('villeDarrivee', '') }}',
                availableRoutes: {{ json_encode($availableRoutes ?? []) }},
                get arrivalOptions() {
                    if (!this.villeDepart) return Object.values(this.availableRoutes).flat().filter((v, i, a) => a.indexOf(v) === i).sort();
                    return this.availableRoutes[this.villeDepart] || [];
                },
                get departureOptions() {
                    return Object.keys(this.availableRoutes).sort();
                },
                swapCities() {
                    let temp = this.villeDepart;
                    this.villeDepart = this.villeDarrivee;
                    this.villeDarrivee = temp;
                }
            }">
                <form action="{{ url('/voyages/search') }}" method="GET">
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <!-- Departure City -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Departure City</label>
                            <div class="flex items-center border-b-2 border-gray-200 pb-2 focus-within:border-oncf-blue transition-colors">
                                <i data-lucide="map-pin" class="w-5 h-5 text-oncf-blue mr-2"></i>
                                <select name="villeDepart" x-model="villeDepart" @change="if(!arrivalOptions.includes(villeDarrivee)) villeDarrivee=''"
                                    class="w-full bg-transparent border-none focus:outline-none text-gray-800 font-medium cursor-pointer">
                                    <option value="">Select City</option>
                                    <template x-for="city in departureOptions" :key="city">
                                        <option :value="city" x-text="city"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <!-- Swap + Arrival -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Arrival City</label>
                            <div class="flex items-center border-b-2 border-gray-200 pb-2 focus-within:border-oncf-blue transition-colors">
                                <i data-lucide="map-pin" class="w-5 h-5 text-red-500 mr-2"></i>
                                <select name="villeDarrivee" x-model="villeDarrivee"
                                    class="w-full bg-transparent border-none focus:outline-none text-gray-800 font-medium cursor-pointer">
                                    <option value="">Select City</option>
                                    <template x-for="city in arrivalOptions" :key="city">
                                        <option :value="city" x-text="city"></option>
                                    </template>
                                </select>
                            </div>
                            <!-- Swap Button -->
                            <button type="button" @click="swapCities()"
                                class="absolute -left-6 top-8 p-2 bg-gray-100 hover:bg-oncf-blue hover:text-white rounded-full transition-all duration-300 shadow-md hover:rotate-180">
                                <i data-lucide="repeat" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <!-- Travel Date -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Travel Date</label>
                            <div class="flex items-center border-b-2 border-gray-200 pb-2 focus-within:border-oncf-blue transition-colors">
                                <i data-lucide="calendar" class="w-5 h-5 text-oncf-blue mr-2"></i>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}"
                                    class="w-full bg-transparent border-none focus:outline-none text-gray-800 font-medium cursor-pointer">
                            </div>
                        </div>

                        <!-- Passengers -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pass.</label>
                            <div class="flex items-center border-b-2 border-gray-200 pb-2 focus-within:border-oncf-blue transition-colors">
                                <i data-lucide="users" class="w-5 h-5 text-oncf-blue mr-2"></i>
                                <select name="passengers" class="w-full bg-transparent border-none focus:outline-none text-gray-800 font-medium cursor-pointer">
                                    <option value="1">1 Passenger</option>
                                    <option value="2">2 Passengers</option>
                                    <option value="3">3 Passengers</option>
                                    <option value="4">4 Passengers</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                        class="w-full bg-oncf-blue hover:bg-blue-800 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-[1.02]">
                        <i data-lucide="search" class="w-5 h-5 mr-2"></i>
                        SEARCH
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Destinations Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="grid lg:grid-cols-2 gap-12 mb-12">
            <div class="section-header">
                <span class="text-xs font-semibold text-oncf-blue uppercase tracking-wider">DESTINATIONS</span>
                <h2 class="text-5xl font-bold text-gray-900 mt-4 leading-tight">
                    Explore the Red<br>City<br>and Beyond.
                </h2>
            </div>
            <div class="flex items-end section-header-right">
                <p class="text-gray-600 text-lg">
                    Connecting the historical gems of Morocco with <span class="text-oncf-blue font-semibold underline decoration-2 underline-offset-4">record-breaking speed</span> and world-class comfort.
                </p>
            </div>
        </div>

        <!-- Destination Cards Grid - Manual -->
        <div class="grid lg:grid-cols-3 gap-6">
            
            <!-- Featured Card - Marrakech -->
            <div class="lg:row-span-2 relative rounded-3xl overflow-hidden group cursor-pointer shadow-xl destination-card">
                <!-- Change the src="" below to your custom picture path, e.g. asset('trains/marrakech.jpg') -->
                <img src="{{ asset('trains/mar.png') }}"
                     alt="Marrakech"
                     class="w-full h-full object-cover min-h-[500px] group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <span class="text-xs font-semibold uppercase tracking-wider opacity-80">Featured Destination</span>
                    <h3 class="text-4xl font-bold mt-2">Marrakech</h3>
                    <div class="flex items-center mt-3 text-sm opacity-90">
                        <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                        2h 15min from Casablanca
                    </div>
                </div>
                <a href="{{ url('/voyages/search?villeDarrivee=Marrakech') }}" class="absolute inset-0"></a>
            </div>

            <!-- Card 2 - Casablanca -->
            <div class="relative rounded-3xl overflow-hidden group cursor-pointer shadow-xl h-64 lg:h-auto destination-card" style="animation-delay: 100ms">
                <!-- Change the src="" below to your custom picture path -->
                <img src="{{ asset('trains/casa.png') }}"
                     alt="Casablanca"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h3 class="text-2xl font-bold">Casablanca</h3>
                    <p class="text-sm opacity-80 mt-1">Morocco's Economic Capital</p>
                </div>
                <a href="{{ url('/voyages/search?villeDarrivee=Casablanca') }}" class="absolute inset-0"></a>
            </div>

            <!-- Card 3 - Rabat -->
            <div class="relative rounded-3xl overflow-hidden group cursor-pointer shadow-xl h-64 lg:h-auto destination-card" style="animation-delay: 200ms">
                <!-- Change the src="" below to your custom picture path -->
                <img src="{{ asset('trains/rabat.png') }}"
                     alt="Rabat"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h3 class="text-2xl font-bold">Rabat</h3>
                    <p class="text-sm opacity-80 mt-1">Morocco's Administrative Capital</p>
                </div>
                <a href="{{ url('/voyages/search?villeDarrivee=Rabat') }}" class="absolute inset-0"></a>
            </div>

            <!-- Card 4 - Tanger -->
            <div class="relative rounded-3xl overflow-hidden group cursor-pointer shadow-xl h-48 destination-card" style="animation-delay: 300ms">
                <!-- Change the src="" below to your custom picture path -->
                <img src="{{ asset('trains/tanger.png') }}"
                     alt="Tanger"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-4 text-white">
                    <h3 class="text-xl font-bold">Tanger</h3>
                    <p class="text-xs opacity-80 mt-1">Gateway to Africa</p>
                </div>
                <a href="{{ url('/voyages/search?villeDarrivee=Tanger') }}" class="absolute inset-0"></a>
            </div>

            <!-- Card 5 - Kenitra -->
            <div class="relative rounded-3xl overflow-hidden group cursor-pointer shadow-xl h-48 destination-card" style="animation-delay: 400ms">
                <!-- Change the src="" below to your custom picture path -->
                <img src="{{ asset('trains/knitra.png') }}"
                     alt="Kenitra"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-4 text-white">
                    <h3 class="text-xl font-bold">Kenitra</h3>
                    <p class="text-xs opacity-80 mt-1">Atlantic Garden City</p>
                </div>
                <a href="{{ url('/voyages/search?villeDarrivee=Kenitra') }}" class="absolute inset-0"></a>
            </div>

        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-12">
            <!-- Feature 1 -->
            <div class="text-center feature-card">
                <div class="w-16 h-16 bg-oncf-blue rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i data-lucide="zap" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Unrivaled Velocity</h3>
                <p class="text-gray-600">
                    Reach your destination faster with Al Boraq, Africa's first high-speed train system reaching speeds up to 320 km/h.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center feature-card" style="animation-delay: 100ms">
                <div class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i data-lucide="armchair" class="w-8 h-8 text-gray-700"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">First Class Comfort</h3>
                <p class="text-gray-600">
                    Spacious seating, panoramic windows, and dedicated catering services designed for the modern traveler.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center feature-card" style="animation-delay: 200ms">
                <div class="w-16 h-16 bg-oncf-blue rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i data-lucide="smartphone" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Digital Ease</h3>
                <p class="text-gray-600">
                    Instant e-tickets, real-time schedule tracking, and seamless journey management at your fingertips.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Routes Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12 section-header">
            <span class="text-xs font-semibold text-oncf-blue uppercase tracking-wider">BEST VALUE</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4">Popular Routes</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Discover our most traveled routes with competitive prices and excellent connections.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($popularRoutes ?? [] as $index => $route)
            <a href="{{ url('/voyages/search?villeDepart=' . $route['depart'] . '&villeDarrivee=' . $route['arrivee']) }}"
               class="group bg-white border-2 border-gray-100 rounded-2xl p-6 hover:border-oncf-blue hover:shadow-xl transition-all duration-300 route-card"
               style="animation-delay: {{ $index * 100 }}ms">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-oncf-blue/10 rounded-full flex items-center justify-center">
                            <i data-lucide="train-front" class="w-6 h-6 text-oncf-blue"></i>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">{{ $route['depart'] }}</div>
                            <div class="text-sm text-gray-500">Departure</div>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-6 h-6 text-gray-400 group-hover:text-oncf-blue group-hover:translate-x-2 transition-all"></i>
                    <div class="text-right">
                        <div class="font-bold text-gray-900">{{ $route['arrivee'] }}</div>
                        <div class="text-sm text-gray-500">Arrival</div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <span class="text-sm text-gray-500">Starting from</span>
                    <span class="text-2xl font-bold text-oncf-blue">{{ number_format($route['prix'], 0) }} <span class="text-sm">DH</span></span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50" x-data="{ openFaq: null }">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12 section-header">
            <span class="text-xs font-semibold text-oncf-blue uppercase tracking-wider">SUPPORT</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4">Frequently Asked Questions</h2>
            <p class="text-gray-600 mt-4">Find answers to common questions about booking and traveling with ONCF.</p>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden faq-item">
                <button @click="openFaq = openFaq === 1 ? null : 1"
                        class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">Comment puis-je reserver un billet ?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="openFaq === 1 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openFaq === 1" x-collapse class="px-6 pb-5">
                    <p class="text-gray-600">
                        Reserver un billet est simple : selectionnez votre ville de depart et d'arrivee, choisissez votre date, puis ajoutez le voyage a votre panier. Procedez au paiement et recevez votre billet electronique instantanement.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden faq-item" style="animation-delay: 50ms">
                <button @click="openFaq = openFaq === 2 ? null : 2"
                        class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">Puis-je annuler ou modifier ma reservation ?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="openFaq === 2 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openFaq === 2" x-collapse class="px-6 pb-5">
                    <p class="text-gray-600">
                        Oui, vous pouvez modifier ou annuler votre reservation jusqu'a 2 heures avant le depart. Connectez-vous a votre compte et accedez a "Mes Billets" pour gerer vos reservations.
                    </p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden faq-item" style="animation-delay: 100ms">
                <button @click="openFaq = openFaq === 3 ? null : 3"
                        class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">Quels sont les modes de paiement acceptes ?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="openFaq === 3 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openFaq === 3" x-collapse class="px-6 pb-5">
                    <p class="text-gray-600">
                        Nous acceptons les cartes bancaires (Visa, Mastercard), les paiements en ligne securises, et le paiement en especes dans nos gares partenaires.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden faq-item" style="animation-delay: 150ms">
                <button @click="openFaq = openFaq === 4 ? null : 4"
                        class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">Qu'est-ce que le train Al Boraq ?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="openFaq === 4 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openFaq === 4" x-collapse class="px-6 pb-5">
                    <p class="text-gray-600">
                        Al Boraq est le premier train a grande vitesse d'Afrique, reliant Tanger a Casablanca en seulement 2h10 a une vitesse maximale de 320 km/h. Il offre un confort exceptionnel avec des sieges spacieux et des services premium.
                    </p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden faq-item" style="animation-delay: 200ms">
                <button @click="openFaq = openFaq === 5 ? null : 5"
                        class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-900">Les enfants beneficient-ils de reductions ?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="openFaq === 5 ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openFaq === 5" x-collapse class="px-6 pb-5">
                    <p class="text-gray-600">
                        Oui ! Les enfants de moins de 4 ans voyagent gratuitement, et ceux de 4 a 12 ans beneficient d'une reduction de 50% sur tous nos trajets.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-oncf-blue to-blue-800 cta-section">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to Start Your Journey?</h2>
        <p class="text-xl text-blue-100 mb-8">Book your next adventure with Morocco's premier railway service.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
               class="bg-white text-oncf-blue px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center justify-center">
                <i data-lucide="search" class="w-5 h-5 mr-2"></i>
                Search Trains
            </a>
            <a href="{{ url('/register') }}"
               class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 transition-all duration-300 inline-flex items-center justify-center">
                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                Create Account
            </a>
        </div>
    </div>
</section>

<!-- Initialize Lucide Icons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection

@section('scripts')
<!-- GSAP for smooth animations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Hero animations
    gsap.from('.hero-bg', {
        scale: 1.1,
        duration: 2,
        ease: 'power2.out'
    });

    gsap.from('.hero-content', {
        opacity: 0,
        x: -60,
        duration: 1,
        delay: 0.3,
        ease: 'power3.out'
    });

    gsap.from('.search-card', {
        opacity: 0,
        y: 60,
        duration: 1,
        delay: 0.5,
        ease: 'power3.out'
    });

    // Section headers animation
    gsap.utils.toArray('.section-header').forEach(el => {
        gsap.from(el, {
            opacity: 0,
            y: 40,
            duration: 0.8,
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    gsap.utils.toArray('.section-header-right').forEach(el => {
        gsap.from(el, {
            opacity: 0,
            x: 40,
            duration: 0.8,
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Destination cards staggered animation
    gsap.utils.toArray('.destination-card').forEach((el, i) => {
        gsap.from(el, {
            opacity: 0,
            y: 60,
            duration: 0.8,
            delay: i * 0.1,
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Feature cards animation
    gsap.utils.toArray('.feature-card').forEach((el, i) => {
        gsap.from(el, {
            opacity: 0,
            y: 40,
            duration: 0.6,
            delay: i * 0.15,
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Route cards animation
    gsap.utils.toArray('.route-card').forEach((el, i) => {
        gsap.from(el, {
            opacity: 0,
            scale: 0.95,
            duration: 0.6,
            delay: i * 0.1,
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // FAQ items animation
    gsap.utils.toArray('.faq-item').forEach((el, i) => {
        gsap.from(el, {
            opacity: 0,
            x: -30,
            duration: 0.5,
            delay: i * 0.08,
            scrollTrigger: {
                trigger: el,
                start: 'top 90%',
                toggleActions: 'play none none none'
            }
        });
    });

    // CTA section animation
    gsap.from('.cta-section', {
        backgroundPosition: '0% 100%',
        duration: 1.5,
        scrollTrigger: {
            trigger: '.cta-section',
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });

    gsap.from('.cta-section h2, .cta-section p, .cta-section .flex', {
        opacity: 0,
        y: 30,
        duration: 0.8,
        stagger: 0.2,
        scrollTrigger: {
            trigger: '.cta-section',
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });
});
</script>
@endsection

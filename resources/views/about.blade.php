@extends('layout')

@section('title', 'A Propos - ONCF')

@section('content')
<!-- Hero Section -->
<section class="relative h-[50vh] min-h-[400px] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('trains/story.png') }}"
             alt="Train ONCF"
             class="w-full h-full object-cover"
             data-animate="fade-in">
        <div class="absolute inset-0 bg-gradient-to-r from-oncf-blue/95 via-oncf-blue/80 to-oncf-blue/60"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 w-full">
        <div class="max-w-2xl" data-animate="slide-up">
            <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-white text-sm font-medium mb-4">A PROPOS</span>
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Notre Histoire,<br>
                <span class="text-cyan-300">Votre Voyage</span>
            </h1>
            <p class="text-xl text-white/90">
                Depuis 1963, l'ONCF connecte le Maroc avec excellence et innovation.
            </p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white relative -mt-16 z-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-2xl p-8 grid grid-cols-2 md:grid-cols-4 gap-8" data-animate="fade-in-up">
            <div class="text-center">
                <div class="text-4xl font-bold text-oncf-blue mb-2" data-counter="60">0</div>
                <div class="text-gray-600 text-sm">Annees d'Excellence</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-oncf-blue mb-2" data-counter="40">0</div>
                <div class="text-gray-600 text-sm">Millions de Voyageurs/An</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-oncf-blue mb-2" data-counter="2000">0</div>
                <div class="text-gray-600 text-sm">Km de Lignes</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-oncf-blue mb-2" data-counter="320">0</div>
                <div class="text-gray-600 text-sm">Km/h Vitesse Max</div>
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div data-animate="slide-right">
                <span class="text-oncf-blue font-semibold text-sm uppercase tracking-wider">NOTRE HISTOIRE</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                    Un Heritage de<br>Mobilite Durable
                </h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    L'Office National des Chemins de Fer (ONCF) est ne en 1963 avec une vision claire : connecter les villes marocaines et faciliter la mobilite des citoyens. Depuis, nous n'avons cesse d'innover et d'ameliorer nos services.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    En 2018, nous avons marque l'histoire en inaugurant Al Boraq, le premier train a grande vitesse d'Afrique, reliant Tanger a Casablanca en seulement 2h10.
                </p>
                <div class="flex items-center gap-6">
                    <div class="flex -space-x-3">
                        <img src="{{ asset('lo.png') }}" class="w-50 h-50 rounded-full"alt="">
                    </div>
                    <span class="text-gray-500 text-sm">Ensemble vers l'avenir</span>
                </div>
            </div>

            <div class="relative" data-animate="slide-left">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('trains/hero.png') }}"
                         alt="Train Al Boraq"
                         class="w-full h-[400px] object-cover">
                </div>
                <div class="absolute -bottom-8 -left-8 bg-oncf-blue text-white p-6 rounded-2xl shadow-xl">
                    <div class="text-3xl font-bold">2018</div>
                    <div class="text-sm opacity-80">Lancement Al Boraq</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16" data-animate="fade-in">
            <span class="text-oncf-blue font-semibold text-sm uppercase tracking-wider">NOS VALEURS</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4">Ce Qui Nous Guide</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="group p-8 rounded-3xl bg-gray-50 hover:bg-oncf-blue transition-all duration-500" data-animate="fade-in-up" data-delay="100">
                <div class="w-16 h-16 bg-oncf-blue group-hover:bg-white rounded-2xl flex items-center justify-center mb-6 transition-colors duration-500">
                    <svg class="w-8 h-8 text-white group-hover:text-oncf-blue transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-4 transition-colors duration-500">Securite</h3>
                <p class="text-gray-600 group-hover:text-white/80 transition-colors duration-500">
                    La securite de nos voyageurs est notre priorite absolue. Nous investissons continuellement dans les technologies les plus avancees.
                </p>
            </div>

            <div class="group p-8 rounded-3xl bg-gray-50 hover:bg-oncf-blue transition-all duration-500" data-animate="fade-in-up" data-delay="200">
                <div class="w-16 h-16 bg-oncf-blue group-hover:bg-white rounded-2xl flex items-center justify-center mb-6 transition-colors duration-500">
                    <svg class="w-8 h-8 text-white group-hover:text-oncf-blue transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-4 transition-colors duration-500">Innovation</h3>
                <p class="text-gray-600 group-hover:text-white/80 transition-colors duration-500">
                    De la digitalisation a la grande vitesse, nous repoussons constamment les limites pour offrir une experience de voyage exceptionnelle.
                </p>
            </div>

            <div class="group p-8 rounded-3xl bg-gray-50 hover:bg-oncf-blue transition-all duration-500" data-animate="fade-in-up" data-delay="300">
                <div class="w-16 h-16 bg-oncf-blue group-hover:bg-white rounded-2xl flex items-center justify-center mb-6 transition-colors duration-500">
                    <svg class="w-8 h-8 text-white group-hover:text-oncf-blue transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-4 transition-colors duration-500">Durabilite</h3>
                <p class="text-gray-600 group-hover:text-white/80 transition-colors duration-500">
                    Le train est le mode de transport le plus ecologique. Nous nous engageons a reduire notre empreinte carbone pour les generations futures.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Al Boraq Section -->
<section class="py-20 bg-gradient-to-br from-oncf-blue via-blue-700 to-oncf-blue overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="text-white" data-animate="slide-right">
                <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-medium mb-4">GRANDE VITESSE</span>
                <h2 class="text-5xl font-bold mb-6">
                    Al Boraq<br>
                    <span class="text-cyan-300">L'Excellence en Mouvement</span>
                </h2>
                <p class="text-white/80 text-lg mb-8 leading-relaxed">
                    Premier train a grande vitesse d'Afrique, Al Boraq represente le fleuron de notre reseau. Avec une vitesse maximale de 320 km/h, il revolutionne la mobilite au Maroc.
                </p>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5">
                        <div class="text-3xl font-bold text-cyan-300 mb-1">2h10</div>
                        <div class="text-sm text-white/70">Tanger - Casablanca</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5">
                        <div class="text-3xl font-bold text-cyan-300 mb-1">12</div>
                        <div class="text-sm text-white/70">Trains par Jour</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5">
                        <div class="text-3xl font-bold text-cyan-300 mb-1">533</div>
                        <div class="text-sm text-white/70">Places par Train</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5">
                        <div class="text-3xl font-bold text-cyan-300 mb-1">98%</div>
                        <div class="text-sm text-white/70">Ponctualite</div>
                    </div>
                </div>
            </div>

            <div class="relative" data-animate="slide-left">
                <div class="relative">
                    <img src="{{ asset('trains/download.png') }}"
                         alt="Al Boraq"
                         class="rounded-3xl shadow-2xl w-full">
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-oncf-blue/50 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Preview -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="text-oncf-blue font-semibold text-sm uppercase tracking-wider" data-animate="fade-in">NOTRE ENGAGEMENT</span>
        <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6" data-animate="fade-in">8,000+ Collaborateurs a Votre Service</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-12" data-animate="fade-in">
            Une equipe passionnee et devouee qui travaille chaque jour pour vous offrir la meilleure experience de voyage possible.
        </p>

        <a href="{{ url('/') }}"
           class="inline-flex items-center px-8 py-4 bg-oncf-blue text-white font-semibold rounded-xl hover:bg-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl"
           data-animate="fade-in-up">
            <span>Reserver Votre Voyage</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Fade in animations
    gsap.utils.toArray('[data-animate="fade-in"]').forEach(el => {
        gsap.from(el, {
            opacity: 0,
            duration: 1,
            scrollTrigger: {
                trigger: el,
                start: "top 85%",
                toggleActions: "play none none none"
            }
        });
    });

    // Slide up animations
    gsap.utils.toArray('[data-animate="slide-up"]').forEach(el => {
        gsap.from(el, {
            opacity: 0,
            y: 50,
            duration: 1,
            scrollTrigger: {
                trigger: el,
                start: "top 85%",
                toggleActions: "play none none none"
            }
        });
    });

    // Fade in up with stagger
    gsap.utils.toArray('[data-animate="fade-in-up"]').forEach(el => {
        const delay = el.dataset.delay ? parseInt(el.dataset.delay) / 1000 : 0;
        gsap.from(el, {
            opacity: 0,
            y: 40,
            duration: 0.8,
            delay: delay,
            scrollTrigger: {
                trigger: el,
                start: "top 85%",
                toggleActions: "play none none none"
            }
        });
    });

    // Slide right
    gsap.utils.toArray('[data-animate="slide-right"]').forEach(el => {
        gsap.from(el, {
            opacity: 0,
            x: -60,
            duration: 1,
            scrollTrigger: {
                trigger: el,
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });
    });

    // Slide left
    gsap.utils.toArray('[data-animate="slide-left"]').forEach(el => {
        gsap.from(el, {
            opacity: 0,
            x: 60,
            duration: 1,
            scrollTrigger: {
                trigger: el,
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });
    });

    // Counter animation
    gsap.utils.toArray('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter);
        gsap.to(el, {
            innerHTML: target,
            duration: 2,
            snap: { innerHTML: 1 },
            scrollTrigger: {
                trigger: el,
                start: "top 85%",
                toggleActions: "play none none none"
            }
        });
    });
});
</script>
@endsection

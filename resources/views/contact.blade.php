@extends('layout')

@section('title', 'Contact - ONCF')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[40vh] min-h-[350px] flex items-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('trains/contact.png') }}" alt="ONCF Contact" class="w-full h-full object-cover"
                data-animate="fade-in">
            <div class="absolute inset-0 bg-gradient-to-r from-oncf-blue/95 via-oncf-blue/80 to-oncf-blue/60"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full">
            <div class="max-w-2xl" data-animate="slide-up">
                <span
                    class="inline-block px-4 py-1 bg-white/20 rounded-full text-white text-sm font-medium mb-4">CONTACT</span>
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Parlons<br>
                    <span class="text-cyan-300">Ensemble</span>
                </h1>
                <p class="text-xl text-white/90">
                    Notre equipe est a votre disposition pour repondre a toutes vos questions.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Contact Info Cards -->
                <div class="space-y-6" data-animate="slide-right">
                    <!-- Phone -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-14 h-14 bg-oncf-blue/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Telephone</h3>
                        <p class="text-gray-600 mb-1">Service Client 24/7</p>
                        <a href="tel:0800-00-6623"
                            class="text-oncf-blue font-semibold hover:text-blue-700 transition">0800-00-ONCF (6623)</a>
                    </div>

                    <!-- Email -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-14 h-14 bg-oncf-blue/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                        <p class="text-gray-600 mb-1">Reponse sous 24h</p>
                        <a href="mailto:contact@oncf.ma"
                            class="text-oncf-blue font-semibold hover:text-blue-700 transition">contact@oncf.ma</a>
                    </div>

                    <!-- Address -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-14 h-14 bg-oncf-blue/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-oncf-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Siege Social</h3>
                        <p class="text-gray-600">
                            8, bis Rue Abderrahmane El Ghafiki<br>
                            Agdal, Rabat, Maroc
                        </p>
                    </div>

                    <!-- Hours -->
                    <div class="bg-oncf-blue rounded-2xl p-6 text-white">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Horaires d'Ouverture</h3>
                        <div class="space-y-2 text-white/80">
                            <div class="flex justify-between">
                                <span>Lundi - Vendredi</span>
                                <span class="font-semibold text-white">08:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Samedi</span>
                                <span class="font-semibold text-white">09:00 - 14:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Dimanche</span>
                                <span class="text-cyan-300">Ferme</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2" data-animate="slide-left">
                    <div class="bg-white rounded-3xl shadow-xl p-8 lg:p-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Envoyez-nous un Message</h2>
                        <p class="text-gray-600 mb-8">Remplissez le formulaire ci-dessous et nous vous repondrons dans les
                            plus brefs delais.</p>

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom
                                        Complet</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-oncf-blue focus:ring-0 transition-colors duration-300 @error('name') border-red-500 @enderror"
                                        placeholder="Votre nom">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-oncf-blue focus:ring-0 transition-colors duration-300 @error('email') border-red-500 @enderror"
                                        placeholder="votre@email.com">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Subject -->
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Sujet</label>
                                <select id="subject" name="subject" required
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-oncf-blue focus:ring-0 transition-colors duration-300 @error('subject') border-red-500 @enderror">
                                    <option value="">Selectionnez un sujet</option>
                                    <option value="reservation" {{ old('subject') == 'reservation' ? 'selected' : '' }}>
                                        Question sur une reservation</option>
                                    <option value="remboursement" {{ old('subject') == 'remboursement' ? 'selected' : '' }}>
                                        Demande de remboursement</option>
                                    <option value="reclamation" {{ old('subject') == 'reclamation' ? 'selected' : '' }}>
                                        Reclamation</option>
                                    <option value="information" {{ old('subject') == 'information' ? 'selected' : '' }}>
                                        Demande d'information</option>
                                    <option value="suggestion" {{ old('subject') == 'suggestion' ? 'selected' : '' }}>
                                        Suggestion</option>
                                    <option value="autre" {{ old('subject') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-oncf-blue focus:ring-0 transition-colors duration-300 resize-none @error('message') border-red-500 @enderror"
                                    placeholder="Decrivez votre demande en detail...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit"
                                class="w-full bg-oncf-blue text-white font-bold py-4 px-8 rounded-xl hover:bg-blue-800 transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
                                <span>Envoyer le Message</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="h-[400px] relative">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.2675099481997!2d-6.849716!3d33.991234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76b8c0a8d6b2f%3A0x4b17f66d0f82e0b0!2sONCF%20-%20Office%20National%20des%20Chemins%20de%20Fer!5e0!3m2!1sfr!2sma!4v1680000000000!5m2!1sfr!2sma"
            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent pointer-events-none"></div>
    </section>

    <!-- Quick Help Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-animate="fade-in">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Besoin d'Aide Rapide?</h2>
                <p class="text-gray-600">Consultez nos ressources en ligne ou connectez-vous a votre compte.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6" data-animate="fade-in-up">
                <a href="{{ url('/') }}"
                    class="group bg-gray-50 rounded-2xl p-6 hover:bg-oncf-blue transition-all duration-300 text-center">
                    <div
                        class="w-12 h-12 bg-oncf-blue group-hover:bg-white rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                        <svg class="w-6 h-6 text-white group-hover:text-oncf-blue" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 group-hover:text-white mb-2 transition-colors">Rechercher un Train
                    </h3>
                    <p class="text-sm text-gray-600 group-hover:text-white/80 transition-colors">Trouvez et reservez votre
                        prochain voyage</p>
                </a>

                <a href="{{ url('/login') }}"
                    class="group bg-gray-50 rounded-2xl p-6 hover:bg-oncf-blue transition-all duration-300 text-center">
                    <div
                        class="w-12 h-12 bg-oncf-blue group-hover:bg-white rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                        <svg class="w-6 h-6 text-white group-hover:text-oncf-blue" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 group-hover:text-white mb-2 transition-colors">Mon Compte</h3>
                    <p class="text-sm text-gray-600 group-hover:text-white/80 transition-colors">Gerez vos reservations et
                        billets</p>
                </a>

                <a href="{{ url('/about') }}"
                    class="group bg-gray-50 rounded-2xl p-6 hover:bg-oncf-blue transition-all duration-300 text-center">
                    <div
                        class="w-12 h-12 bg-oncf-blue group-hover:bg-white rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                        <svg class="w-6 h-6 text-white group-hover:text-oncf-blue" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 group-hover:text-white mb-2 transition-colors">A Propos</h3>
                    <p class="text-sm text-gray-600 group-hover:text-white/80 transition-colors">Decouvrez l'histoire de
                        l'ONCF</p>
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            // Fade in up
            gsap.utils.toArray('[data-animate="fade-in-up"]').forEach(el => {
                gsap.from(el, {
                    opacity: 0,
                    y: 40,
                    duration: 0.8,
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
        });
    </script>
@endsection
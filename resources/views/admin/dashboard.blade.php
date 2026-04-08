@extends('layout')

@section('title', 'Admin Dashboard - ONCF')

@section('content')
{{-- Lucide Icons CDN --}}
<script src="https://unpkg.com/lucide@latest"></script>

<div class="min-h-screen bg-gray-50 py-8" x-data="{
    commandeModal: false,
    billetModal: false,
    selectedCommande: null,
    selectedBillet: null,
    openCommande(data) { this.selectedCommande = data; this.commandeModal = true; },
    openBillet(data)   { this.selectedBillet  = data; this.billetModal   = true; }
}">
    <div class="max-w-7xl mx-auto px-4">

        {{-- ── Header ────────────────────────────────── --}}
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-oncf-blue rounded-xl flex items-center justify-center shadow">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
                    <p class="text-gray-500 text-sm">Gérer les voyages, commandes & billets ONCF</p>
                </div>
            </div>
            <a href="{{ route('admin.voyages.create') }}"
               class="bg-oncf-blue text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-blue-700 transition flex items-center gap-2 shadow-lg">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Ajouter un voyage
            </a>
        </div>

        {{-- ── Success Alert ─────────────────────────── --}}
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl mb-6 flex items-center gap-2">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 flex-shrink-0"></i>
            {{ session('success') }}
        </div>
        @endif

        {{-- ── Stats Cards ───────────────────────────── --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Voyages --}}
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-oncf-blue">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-oncf-blue">{{ $voyages->total() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Voyages</div>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center">
                        <i data-lucide="train-front" class="w-7 h-7 text-oncf-blue"></i>
                    </div>
                </div>
            </div>
            {{-- Commandes --}}
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-emerald-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-emerald-600">{{ $commandes->count() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Commandes</div>
                    </div>
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center">
                        <i data-lucide="shopping-bag" class="w-7 h-7 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            {{-- Billets --}}
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-purple-600">{{ $billets->count() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Billets vendus</div>
                    </div>
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center">
                        <i data-lucide="ticket" class="w-7 h-7 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════
             SECTION : TOUS LES VOYAGES
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-oncf-blue to-blue-600 text-white flex items-center gap-3">
                <i data-lucide="train-front" class="w-5 h-5"></i>
                <h2 class="text-lg font-bold">Tous les voyages</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Départ</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Arrivée</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Horaires</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Promo</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($voyages as $voyage)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-semibold text-oncf-blue bg-blue-50 px-2 py-1 rounded">{{ $voyage->code_voyage }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $voyage->villeDepart }}</td>
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $voyage->villeDarrivee }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-1.5 text-gray-600">
                                    <span>{{ $voyage->heureDepart }}</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-gray-400"></i>
                                    <span>{{ $voyage->heureDarrivee }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($voyage->is_promo && $voyage->price_promo)
                                    <div class="text-xs text-gray-400 line-through">{{ number_format($voyage->prixVoyage, 2) }} DH</div>
                                    <div class="font-bold text-orange-600">{{ number_format($voyage->price_promo, 2) }} DH</div>
                                @else
                                    <span class="font-bold text-gray-800">{{ number_format($voyage->prixVoyage, 2) }} DH</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($voyage->is_promo)
                                    <span class="inline-flex items-center gap-1 text-xs font-bold bg-red-100 text-red-600 px-2.5 py-1 rounded-full">
                                        <i data-lucide="tag" class="w-3 h-3"></i> Promo
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold bg-green-100 text-green-700 px-2.5 py-1 rounded-full">
                                        <i data-lucide="check" class="w-3 h-3"></i> Normal
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.voyages.edit', $voyage->id) }}"
                                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Modifier">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.voyages.delete', $voyage->id) }}"
                                          onsubmit="return confirm('Supprimer ce voyage ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Supprimer">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <i data-lucide="inbox" class="w-12 h-12"></i>
                                    <p class="font-medium">Aucun voyage trouvé</p>
                                    <p class="text-sm">Ajoutez votre premier voyage</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($voyages->hasPages())
            <div class="px-6 py-4 border-t bg-gray-50">{{ $voyages->links() }}</div>
            @endif
        </div>

        {{-- ══════════════════════════════════════════════
             SECTION : COMMANDES
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-emerald-600 to-green-500 text-white flex items-center gap-3">
                <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                <h2 class="text-lg font-bold">Toutes les commandes</h2>
                <span class="ml-auto bg-white/20 text-xs font-bold px-2.5 py-1 rounded-full">{{ $commandes->count() }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Billets</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Détail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($commandes as $commande)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm text-gray-500">#{{ $commande->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="user" class="w-4 h-4 text-emerald-600"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">
                                        {{ $commande->user ? $commande->user->prenom . ' ' . $commande->user->nom : 'N/A' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $commande->user?->email ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400"></i>
                                    {{ \Carbon\Carbon::parse($commande->date_comm)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold bg-purple-100 text-purple-700 px-2.5 py-1 rounded-full">
                                    <i data-lucide="ticket" class="w-3 h-3"></i>
                                    {{ $commande->billets->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button @click="openCommande({
                                    id: {{ $commande->id }},
                                    client: '{{ addslashes($commande->user ? $commande->user->prenom . ' ' . $commande->user->nom : 'N/A') }}',
                                    email: '{{ addslashes($commande->user?->email ?? '—') }}',
                                    tel: '{{ addslashes($commande->user?->tel ?? '—') }}',
                                    date: '{{ \Carbon\Carbon::parse($commande->date_comm)->format('d/m/Y') }}',
                                    billets: {{ $commande->billets->map(fn($b) => [
                                        'id'       => $b->id,
                                        'voyage'   => $b->voyage ? $b->voyage->villeDepart . ' → ' . $b->voyage->villeDarrivee : '?',
                                        'code'     => $b->voyage?->code_voyage ?? '?',
                                        'qte'      => $b->qte,
                                        'passager' => ($b->prenom_passager ?? '') . ' ' . ($b->nom_passager ?? ''),
                                        'cin'      => $b->cin_passager ?? '—',
                                    ])->toJson() }}
                                })"
                                class="inline-flex items-center gap-1.5 text-sm font-medium text-oncf-blue bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    Voir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <i data-lucide="inbox" class="w-12 h-12"></i>
                                    <p class="font-medium">Aucune commande</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════
             SECTION : BILLETS
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-purple-600 to-purple-500 text-white flex items-center gap-3">
                <i data-lucide="ticket" class="w-5 h-5"></i>
                <h2 class="text-lg font-bold">Tous les billets</h2>
                <span class="ml-auto bg-white/20 text-xs font-bold px-2.5 py-1 rounded-full">{{ $billets->count() }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Voyage</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Passager</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">CIN</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Qté</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Commande</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Détail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $currentVoyageId = null; @endphp
                        @forelse($billets as $billet)
                            @if($currentVoyageId !== $billet->id_voyage)
                                @php $currentVoyageId = $billet->id_voyage; @endphp
                                <tr class="bg-gray-50/50">
                                    <td colspan="7" class="px-6 py-2">
                                        <div class="flex items-center gap-2">
                                            <div class="px-2 py-0.5 bg-oncf-blue/10 text-oncf-blue rounded-md text-[10px] font-bold uppercase tracking-wider">
                                                Groupe Voyage
                                            </div>
                                            <div class="h-px flex-1 bg-gray-200"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm text-gray-500">#{{ $billet->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="train-front" class="w-4 h-4 text-oncf-blue"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-800 text-sm">
                                            {{ $billet->voyage ? $billet->voyage->villeDepart . ' → ' . $billet->voyage->villeDarrivee : '—' }}
                                        </div>
                                        <div class="text-xs text-gray-400 font-mono">{{ $billet->voyage?->code_voyage ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="user-round" class="w-4 h-4 text-gray-400"></i>
                                    <span class="text-sm text-gray-700">
                                        {{ trim(($billet->prenom_passager ?? '') . ' ' . ($billet->nom_passager ?? '')) ?: '—' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $billet->cin_passager ?? '—' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-gray-800">{{ $billet->qte }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-1.5 text-gray-600">
                                    <i data-lucide="user" class="w-3.5 h-3.5 text-gray-400"></i>
                                    {{ $billet->commande?->user ? $billet->commande->user->prenom . ' ' . $billet->commande->user->nom : '—' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button @click="openBillet({
                                    id: {{ $billet->id }},
                                    voyage: '{{ addslashes($billet->voyage ? $billet->voyage->villeDepart . ' → ' . $billet->voyage->villeDarrivee : '—') }}',
                                    code: '{{ $billet->voyage?->code_voyage ?? '?' }}',
                                    depart: '{{ $billet->voyage?->heureDepart ?? '' }}',
                                    arrivee: '{{ $billet->voyage?->heureDarrivee ?? '' }}',
                                    prix: '{{ $billet->voyage ? number_format($billet->voyage->effective_price, 2) . ' DH' : '—' }}',
                                    prenom: '{{ addslashes($billet->prenom_passager ?? '') }}',
                                    nom: '{{ addslashes($billet->nom_passager ?? '') }}',
                                    cin: '{{ $billet->cin_passager ?? '—' }}',
                                    qte: {{ $billet->qte }},
                                    commande_id: {{ $billet->id_commande }},
                                    client: '{{ addslashes($billet->commande?->user ? $billet->commande->user->prenom . ' ' . $billet->commande->user->nom : '—') }}',
                                    email: '{{ addslashes($billet->commande?->user?->email ?? '—') }}',
                                    date: '{{ $billet->commande ? \Carbon\Carbon::parse($billet->commande->date_comm)->format('d/m/Y') : '—' }}'
                                })"
                                class="inline-flex items-center gap-1.5 text-sm font-medium text-purple-600 bg-purple-50 hover:bg-purple-100 px-3 py-1.5 rounded-lg transition">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    Voir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <i data-lucide="inbox" class="w-12 h-12"></i>
                                    <p class="font-medium">Aucun billet vendu</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Back link --}}
        <div class="text-center pb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-oncf-blue hover:text-blue-700 font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════
         MODAL : DÉTAIL COMMANDE
    ═══════════════════════════════════════════════════ --}}
    <div x-show="commandeModal" x-transition.opacity
         class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4" style="display:none">
        <div @click.outside="commandeModal = false" x-transition
             class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gradient-to-r from-emerald-600 to-green-500 rounded-t-2xl text-white">
                <div class="flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                    <h3 class="font-bold text-lg" x-text="'Commande #' + selectedCommande?.id"></h3>
                </div>
                <button @click="commandeModal = false" class="p-1 hover:bg-white/20 rounded-lg transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            {{-- Modal Body --}}
            <div class="p-6" x-show="selectedCommande">
                {{-- Client Info --}}
                <div class="flex items-center gap-4 mb-6 p-4 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="user-round" class="w-6 h-6 text-emerald-600"></i>
                    </div>
                    <div>
                        <div class="font-bold text-gray-800 text-lg" x-text="selectedCommande?.client"></div>
                        <div class="text-sm text-gray-500 flex items-center gap-1">
                            <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                            <span x-text="selectedCommande?.email"></span>
                        </div>
                        <div class="text-sm text-gray-500 flex items-center gap-1">
                            <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                            <span x-text="selectedCommande?.tel"></span>
                        </div>
                    </div>
                    <div class="ml-auto text-right">
                        <div class="text-xs text-gray-400">Date commande</div>
                        <div class="font-semibold text-gray-700 flex items-center gap-1 justify-end">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                            <span x-text="selectedCommande?.date"></span>
                        </div>
                    </div>
                </div>
                {{-- Billets List --}}
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i data-lucide="ticket" class="w-4 h-4 text-purple-600"></i>
                    Billets de cette commande
                </h4>
                <div class="space-y-3">
                    <template x-for="b in selectedCommande?.billets" :key="b.id">
                        <div class="border border-gray-200 rounded-xl p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="train-front" class="w-5 h-5 text-oncf-blue"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-800" x-text="b.voyage"></div>
                                <div class="text-xs text-gray-400 font-mono" x-text="b.code"></div>
                                <div class="text-sm text-gray-600 mt-1" x-text="'Passager: ' + b.passager"></div>
                                <div class="text-xs text-gray-400" x-text="'CIN: ' + b.cin"></div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-400">Quantité</div>
                                <div class="font-bold text-purple-600 text-lg" x-text="b.qte"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════
         MODAL : DÉTAIL BILLET
    ═══════════════════════════════════════════════════ --}}
    <div x-show="billetModal" x-transition.opacity
         class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4" style="display:none">
        <div @click.outside="billetModal = false" x-transition
             class="bg-white rounded-2xl shadow-2xl max-w-lg w-full">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gradient-to-r from-purple-600 to-purple-500 rounded-t-2xl text-white">
                <div class="flex items-center gap-2">
                    <i data-lucide="ticket" class="w-5 h-5"></i>
                    <h3 class="font-bold text-lg" x-text="'Billet #' + selectedBillet?.id"></h3>
                </div>
                <button @click="billetModal = false" class="p-1 hover:bg-white/20 rounded-lg transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            {{-- Modal Body --}}
            <div class="p-6 space-y-4" x-show="selectedBillet">
                {{-- Voyage Info --}}
                <div class="bg-blue-50 rounded-xl p-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                        <i data-lucide="train-front" class="w-3.5 h-3.5"></i> Voyage
                    </div>
                    <div class="font-bold text-oncf-blue text-lg" x-text="selectedBillet?.voyage"></div>
                    <div class="font-mono text-sm text-gray-500" x-text="selectedBillet?.code"></div>
                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                        <span class="flex items-center gap-1">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                            <span x-text="selectedBillet?.depart + ' → ' + selectedBillet?.arrivee"></span>
                        </span>
                        <span class="flex items-center gap-1 font-semibold text-oncf-blue">
                            <i data-lucide="banknote" class="w-3.5 h-3.5"></i>
                            <span x-text="selectedBillet?.prix"></span>
                        </span>
                    </div>
                </div>
                {{-- Passager Info --}}
                <div class="bg-purple-50 rounded-xl p-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1">
                        <i data-lucide="user-round" class="w-3.5 h-3.5"></i> Passager
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <div class="text-xs text-gray-400">Prénom</div>
                            <div class="font-semibold text-gray-700" x-text="selectedBillet?.prenom || '—'"></div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Nom</div>
                            <div class="font-semibold text-gray-700" x-text="selectedBillet?.nom || '—'"></div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">CIN</div>
                            <div class="font-semibold text-gray-700 font-mono" x-text="selectedBillet?.cin"></div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Quantité</div>
                            <div class="font-bold text-purple-600 text-xl" x-text="selectedBillet?.qte"></div>
                        </div>
                    </div>
                </div>
                {{-- Client Info --}}
                <div class="bg-emerald-50 rounded-xl p-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                        <i data-lucide="user" class="w-3.5 h-3.5"></i> Client — Commande #<span x-text="selectedBillet?.commande_id"></span>
                    </div>
                    <div class="font-semibold text-gray-700" x-text="selectedBillet?.client"></div>
                    <div class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                        <i data-lucide="mail" class="w-3 h-3"></i>
                        <span x-text="selectedBillet?.email"></span>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                        <i data-lucide="calendar" class="w-3 h-3"></i>
                        <span x-text="selectedBillet?.date"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
    document.addEventListener('alpine:init', () => {
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
    });
    // Re-render icons after Alpine updates (for modal content)
    document.addEventListener('alpine:initialized', () => {
        window.addEventListener('click', () => setTimeout(() => lucide.createIcons(), 50));
    });
</script>
@endsection

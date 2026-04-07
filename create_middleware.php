<?php
// Setup Admin Dashboard - Complete Solution
echo "=== ONCF Admin Setup ===\n\n";

// 1. Create Middleware directory
$middlewareDir = __DIR__ . '/app/Http/Middleware';
if (!is_dir($middlewareDir)) {
    mkdir($middlewareDir, 0755, true);
    echo "✓ Created Middleware directory\n";
} else {
    echo "✓ Middleware directory exists\n";
}

// 2. Create AdminMiddleware.php
$middlewareContent = <<<'PHP'
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (strtoupper(Auth::user()->role) !== 'ADMIN') {
            abort(403, 'Accès refusé.');
        }

        return $next($request);
    }
}
PHP;

file_put_contents($middlewareDir . '/AdminMiddleware.php', $middlewareContent);
echo "✓ Created AdminMiddleware.php\n";

// 3. Create admin views directory
$adminViewsDir = __DIR__ . '/resources/views/admin';
if (!is_dir($adminViewsDir)) {
    mkdir($adminViewsDir, 0755, true);
    echo "✓ Created admin views directory\n";
} else {
    echo "✓ Admin views directory exists\n";
}

// 4. Create dashboard.blade.php
$dashboardView = <<<'BLADE'
@extends('layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">🎛️ Admin Dashboard</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="text-2xl font-bold text-blue-600">{{ $voyages->total() }}</div>
                <div class="text-gray-600">Voyages</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="text-2xl font-bold text-green-600">{{ \App\Models\Commande::count() }}</div>
                <div class="text-gray-600">Commandes</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="text-2xl font-bold text-purple-600">{{ \App\Models\Billet::count() }}</div>
                <div class="text-gray-600">Billets</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Code</th>
                        <th class="px-6 py-3 text-left">Départ</th>
                        <th class="px-6 py-3 text-left">Arrivée</th>
                        <th class="px-6 py-3 text-left">Horaires</th>
                        <th class="px-6 py-3 text-left">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($voyages as $voyage)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $voyage->code_voyage }}</td>
                        <td class="px-6 py-4">{{ $voyage->villeDepart }}</td>
                        <td class="px-6 py-4">{{ $voyage->villeDarrivee }}</td>
                        <td class="px-6 py-4">{{ $voyage->heureDepart }} → {{ $voyage->heureDarrivee }}</td>
                        <td class="px-6 py-4">{{ $voyage->prixVoyage }} DH</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $voyages->links() }}
        </div>
    </div>
</div>
@endsection
BLADE;

file_put_contents($adminViewsDir . '/dashboard.blade.php', $dashboardView);
echo "✓ Created dashboard.blade.php\n";

echo "\n=== Setup Complete! ===\n";
echo "\nNext steps:\n";
echo "1. Run: php artisan config:clear\n";
echo "2. Refresh your browser\n";
echo "3. Click the Admin link\n";

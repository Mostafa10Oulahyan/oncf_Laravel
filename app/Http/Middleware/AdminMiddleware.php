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
            return redirect('/login')->with('error', 'Veuillez vous connecter');
        }

        if (strtoupper(Auth::user()->role) !== 'ADMIN') {
            abort(403, 'Accès refusé. Vous devez être administrateur.');
        }

        return $next($request);
    }
}

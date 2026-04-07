<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Process login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Bienvenue, ' . Auth::user()->prenom . '!');
        }

        return back()->withErrors([
            'username' => 'Identifiants incorrects.',
        ])->onlyInput('username');
    }

    /**
     * Show registration form
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Process registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20|unique:users',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'tel' => $validated['tel'],
            'role' => 'USER',
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Compte créé avec succès! Bienvenue, ' . $user->prenom . '!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }
}

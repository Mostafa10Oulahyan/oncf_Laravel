<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // In production, you would send an email here
        // For now, just redirect with success message
        return redirect()->route('contact')->with('success', 'Votre message a ete envoye avec succes. Nous vous repondrons dans les plus brefs delais.');
    }
}

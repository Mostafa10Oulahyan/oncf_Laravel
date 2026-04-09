<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Billet;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Show user's tickets
     */
    public function myTickets()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Veuillez vous connecter pour voir vos billets');
        }

        // Get user's commandes with billets and voyages (only PAID ones)
        $commandes = Commande::where('id_client', Auth::id())
            ->where('status', 'PAID')
            ->with(['billets.voyage'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-tickets', compact('commandes'));
    }

    /**
     * Show checkout page (passenger info)
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Votre panier est vide');
        }

        $total = 0;
        $totalTickets = 0;

        foreach ($cart as $item) {
            $total += $item['prix'] * $item['quantity'];
            $totalTickets += $item['quantity'];
        }

        return view('checkout', compact('cart', 'total', 'totalTickets'));
    }

    /**
     * Process checkout and create order
     */
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Votre panier est vide');
        }

        // Validate passenger info
        $request->validate([
            'passengers' => 'required|array',
            'passengers.*.nom' => 'required|string|max:255',
            'passengers.*.prenom' => 'required|string|max:255',
            'passengers.*.cin' => 'required|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            // Create commande
            $commande = new Commande();
            $commande->id_client = Auth::id() ?? 1; // Default to 1 if not logged in
            $commande->date_comm = now()->toDateString();
            $commande->save();

            // Create billets
            $passengerIndex = 0;
            foreach ($cart as $id => $item) {
                for ($i = 0; $i < $item['quantity']; $i++) {
                    $passenger = $request->passengers[$passengerIndex] ?? null;

                    $billet = new Billet();
                    $billet->id_commande = $commande->id;
                    $billet->id_voyage = $item['id'];
                    $billet->qte = 1;

                    // Store passenger info if the model supports it
                    if ($passenger) {
                        $billet->nom_passager = $passenger['nom'] ?? '';
                        $billet->prenom_passager = $passenger['prenom'] ?? '';
                        $billet->cin_passager = $passenger['cin'] ?? '';
                    }

                    $billet->save();
                    $passengerIndex++;
                }
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            // Store commande ID for confirmation
            session()->put('last_commande_id', $commande->id);

            return redirect('/payment')->with('success', 'Informations enregistrées!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors de la réservation: ' . $e->getMessage());
        }
    }

    /**
     * Show payment page
     */
    public function payment()
    {
        $commandeId = session()->get('last_commande_id');

        if (!$commandeId) {
            return redirect('/')->with('error', 'Aucune commande en cours');
        }

        $commande = Commande::with(['voyages'])->find($commandeId);

        if (!$commande) {
            return redirect('/')->with('error', 'Commande non trouvée');
        }

        $total = 0;
        foreach ($commande->voyages as $voyage) {
            $total += $voyage->effective_price * $voyage->pivot->qte;
        }

        return view('payment', compact('commande', 'total'));
    }

    /**
     * Process payment (simulation)
     */
    public function processPayment(Request $request)
    {
        $commandeId = session()->get('last_commande_id');

        if (!$commandeId) {
            return redirect('/')->with('error', 'Aucune commande en cours');
        }

        // Mark order as PAID
        $commande = Commande::find($commandeId);
        if ($commande) {
            $commande->status = 'PAID';
            $commande->save();
        }

        // Simulate payment success
        session()->forget('last_commande_id');
        session()->put('confirmed_commande_id', $commandeId);

        return redirect('/confirmation')->with('success', 'Paiement effectué avec succès!');
    }

    /**
     * Show confirmation page with tickets
     */
    public function confirmation()
    {
        $commandeId = session()->get('confirmed_commande_id');

        if (!$commandeId) {
            return redirect('/')->with('error', 'Aucune confirmation en cours');
        }

        $commande = Commande::with(['voyages', 'user'])->find($commandeId);
        $billets = Billet::with('voyage')->where('id_commande', $commandeId)->get();

        return view('confirmation', compact('commande', 'billets'));
    }
    /**
     * Delete (cancel) a ticket
     */
    public function deleteTicket($id)
    {
        $billet = Billet::with('commande')->findOrFail($id);

        // Security: Check if the ticket belongs to the authenticated user
        if ($billet->commande->id_client != Auth::id()) {
            return redirect()->back()->with('error', 'Action non autorisée');
        }

        $commandeId = $billet->id_commande;
        $billet->delete();

        // Optional: If the commande has no more tickets, delete the commande too
        $remainingBillets = Billet::where('id_commande', $commandeId)->count();
        if ($remainingBillets === 0) {
            Commande::destroy($commandeId);
        }

        return redirect()->back()->with('success', 'Billet annulé avec succès');
    }
}

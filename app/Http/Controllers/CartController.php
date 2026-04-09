<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['prix'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    /**
     * Add a voyage to cart
     */
    public function add(Request $request, $id)
    {
        $voyage = Voyage::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $voyage->id,
                'code_voyage' => $voyage->code_voyage,
                'villeDepart' => $voyage->villeDepart,
                'villeDarrivee' => $voyage->villeDarrivee,
                'heureDepart' => $voyage->heureDepart,
                'heureDarrivee' => $voyage->heureDarrivee,
                'prix' => $voyage->effective_price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Voyage ajouté au panier!');
    }

    /**
     * Update cart quantity
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $id = $request->input('id');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Panier vidé!');
    }
}

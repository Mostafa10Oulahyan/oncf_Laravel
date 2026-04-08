<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voyage;

class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Voyage::query();

        if ($request->has('depart') && !empty($request->depart)) {
            $query->where('villeDepart', 'like', '%' . $request->depart . '%');
        }

        if ($request->has('arrivee') && !empty($request->arrivee)) {
            $query->where('villeDarrivee', 'like', '%' . $request->arrivee . '%');
        }

        $voyages = $query->get()->map(function ($voyage) {
            return [
                'id' => $voyage->id,
                'heure_depart' => $voyage->heureDepart,
                'gare_depart' => $voyage->villeDepart,
                'heure_arrivee' => $voyage->heureDarrivee,
                'gare_arrivee' => $voyage->villeDarrivee,
                'prix' => $voyage->prixVoyage,
            ];
        });

        return response()->json(['data' => $voyages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_voyage' => 'required|string',
            'heureDepart' => 'required|string',
            'villeDepart' => 'required|string',
            'heureDarrivee' => 'required|string',
            'villeDarrivee' => 'required|string',
            'prixVoyage' => 'required|numeric',
        ]);

        $voyage = Voyage::create($validated);
        return response()->json($voyage, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $voyage = Voyage::findOrFail($id);
        return response()->json($voyage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voyage = Voyage::findOrFail($id);
        $voyage->update($request->all());
        return response()->json($voyage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voyage = Voyage::findOrFail($id);
        $voyage->delete();
        return response()->json(null, 204);
    }
}

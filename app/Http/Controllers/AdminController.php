<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $voyages = Voyage::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard', compact('voyages'));
    }

    /**
     * Show create voyage form
     */
    public function createVoyage()
    {
        return view('admin.create-voyage');
    }

    /**
     * Store new voyage
     */
    public function storeVoyage(Request $request)
    {
        $validated = $request->validate([
            'code_voyage' => 'required|unique:voyages,code_voyage',
            'villeDepart' => 'required|string',
            'villeDarrivee' => 'required|string',
            'heureDepart' => 'required',
            'heureDarrivee' => 'required',
            'prixVoyage' => 'required|numeric|min:0',
        ]);

        Voyage::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Voyage ajouté avec succès!');
    }

    /**
     * Show edit voyage form
     */
    public function editVoyage($id)
    {
        $voyage = Voyage::findOrFail($id);
        return view('admin.edit-voyage', compact('voyage'));
    }

    /**
     * Update voyage
     */
    public function updateVoyage(Request $request, $id)
    {
        $voyage = Voyage::findOrFail($id);

        $validated = $request->validate([
            'code_voyage' => 'required|unique:voyages,code_voyage,' . $id,
            'villeDepart' => 'required|string',
            'villeDarrivee' => 'required|string',
            'heureDepart' => 'required',
            'heureDarrivee' => 'required',
            'prixVoyage' => 'required|numeric|min:0',
        ]);

        $voyage->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Voyage mis à jour avec succès!');
    }

    /**
     * Delete voyage
     */
    public function deleteVoyage($id)
    {
        $voyage = Voyage::findOrFail($id);
        $voyage->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Voyage supprimé avec succès!');
    }
}

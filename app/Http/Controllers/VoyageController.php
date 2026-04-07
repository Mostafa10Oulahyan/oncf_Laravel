<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\City;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    /**
     * Show the homepage with search form
     */
    public function index()
    {
        // Get unique cities for dropdowns from voyages table
        $departCities = Voyage::select('villeDepart')->distinct()->pluck('villeDepart');
        $arriveCities = Voyage::select('villeDarrivee')->distinct()->pluck('villeDarrivee');
        $cities = $departCities->merge($arriveCities)->unique()->sort()->values();

        // Get allowed routes for dependent dropdowns
        $routesQuery = Voyage::select('villeDepart', 'villeDarrivee')->distinct()->get();
        $availableRoutes = [];
        foreach($routesQuery as $route) {
            if (!isset($availableRoutes[$route->villeDepart])) {
                $availableRoutes[$route->villeDepart] = [];
            }
            if (!in_array($route->villeDarrivee, $availableRoutes[$route->villeDepart])) {
                $availableRoutes[$route->villeDepart][] = $route->villeDarrivee;
            }
        }

        // Get featured destinations from City model
        // $destinations = City::featured()->get();

        // Get top 3 cheapest routes from database
        $popularRoutes = Voyage::orderBy('prixVoyage', 'asc')
            ->limit(3)
            ->get()
            ->map(function($voyage) {
                return [
                    'depart' => $voyage->villeDepart,
                    'arrivee' => $voyage->villeDarrivee,
                    'prix' => $voyage->prixVoyage
                ];
            });

        return view('home', compact('cities', 'popularRoutes', 'availableRoutes'));
    }

    /**
     * Search for voyages
     */
    public function search(Request $request)
    {
        $villeDepart = $request->input('villeDepart');
        $villeDarrivee = $request->input('villeDarrivee');

        // Get cities for dropdowns
        $departCities = Voyage::select('villeDepart')->distinct()->pluck('villeDepart');
        $arriveCities = Voyage::select('villeDarrivee')->distinct()->pluck('villeDarrivee');
        $cities = $departCities->merge($arriveCities)->unique()->sort()->values();

        $routesQuery = Voyage::select('villeDepart', 'villeDarrivee')->distinct()->get();
        $availableRoutes = [];
        foreach($routesQuery as $route) {
            if (!isset($availableRoutes[$route->villeDepart])) {
                $availableRoutes[$route->villeDepart] = [];
            }
            if (!in_array($route->villeDarrivee, $availableRoutes[$route->villeDepart])) {
                $availableRoutes[$route->villeDepart][] = $route->villeDarrivee;
            }
        }

        // Build query
        $query = Voyage::query();

        if ($villeDepart) {
            $query->where('villeDepart', $villeDepart);
        }

        if ($villeDarrivee) {
            $query->where('villeDarrivee', $villeDarrivee);
        }

        $voyages = $query->orderBy('heureDepart')->get();

        return view('results', compact('voyages', 'cities', 'availableRoutes', 'villeDepart', 'villeDarrivee'));
    }
}

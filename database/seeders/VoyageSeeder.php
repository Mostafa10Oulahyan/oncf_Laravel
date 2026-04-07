<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voyage;

class VoyageSeeder extends Seeder
{
    public function run()
    {
        Voyage::insert([
            [
                'code_voyage' => 'ONCF001',
                'heureDepart' => '06:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '08:15:00',
                'villeDarrivee' => 'Marrakech',
                'prixVoyage' => 149.00,
            ],
            [
                'code_voyage' => 'ONCF002',
                'heureDepart' => '07:30:00',
                'villeDepart' => 'Rabat',
                'heureDarrivee' => '08:30:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 85.00,
            ],
            [
                'code_voyage' => 'ONCF003',
                'heureDepart' => '09:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '11:30:00',
                'villeDarrivee' => 'Fes',
                'prixVoyage' => 175.00,
            ],
            [
                'code_voyage' => 'ONCF004',
                'heureDepart' => '10:15:00',
                'villeDepart' => 'Tanger',
                'heureDarrivee' => '12:30:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 125.00,
            ],
            [
                'code_voyage' => 'ONCF005',
                'heureDepart' => '12:00:00',
                'villeDepart' => 'Marrakech',
                'heureDarrivee' => '14:15:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 149.00,
            ],
            [
                'code_voyage' => 'ONCF006',
                'heureDepart' => '14:30:00',
                'villeDepart' => 'Fes',
                'heureDarrivee' => '17:00:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 175.00,
            ],
            [
                'code_voyage' => 'ONCF007',
                'heureDepart' => '16:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '17:00:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 85.00,
            ],
            [
                'code_voyage' => 'ONCF008',
                'heureDepart' => '18:00:00',
                'villeDepart' => 'Rabat',
                'heureDarrivee' => '20:15:00',
                'villeDarrivee' => 'Tanger',
                'prixVoyage' => 125.00,
            ],
            [
                'code_voyage' => 'ONCF009',
                'heureDepart' => '08:30:00',
                'villeDepart' => 'Oujda',
                'heureDarrivee' => '14:00:00',
                'villeDarrivee' => 'Fes',
                'prixVoyage' => 195.00,
            ],
            [
                'code_voyage' => 'ONCF010',
                'heureDepart' => '15:00:00',
                'villeDepart' => 'Kenitra',
                'heureDarrivee' => '15:40:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 45.00,
            ],
            // Additional Kenitra routes
            [
                'code_voyage' => 'ONCF011',
                'heureDepart' => '06:30:00',
                'villeDepart' => 'Kenitra',
                'heureDarrivee' => '07:30:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 65.00,
            ],
            [
                'code_voyage' => 'ONCF012',
                'heureDepart' => '08:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '09:00:00',
                'villeDarrivee' => 'Kenitra',
                'prixVoyage' => 65.00,
            ],
            [
                'code_voyage' => 'ONCF013',
                'heureDepart' => '07:00:00',
                'villeDepart' => 'Rabat',
                'heureDarrivee' => '07:40:00',
                'villeDarrivee' => 'Kenitra',
                'prixVoyage' => 45.00,
            ],
            [
                'code_voyage' => 'ONCF014',
                'heureDepart' => '09:30:00',
                'villeDepart' => 'Kenitra',
                'heureDarrivee' => '11:45:00',
                'villeDarrivee' => 'Tanger',
                'prixVoyage' => 95.00,
            ],
            [
                'code_voyage' => 'ONCF015',
                'heureDepart' => '17:00:00',
                'villeDepart' => 'Tanger',
                'heureDarrivee' => '19:15:00',
                'villeDarrivee' => 'Kenitra',
                'prixVoyage' => 95.00,
            ],
        ]);
    }
}

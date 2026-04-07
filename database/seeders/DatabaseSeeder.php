<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nom' => 'Admin',
            'prenom' => 'ONCF',
            'email' => 'admin@oncf.ma',
            'tel' => '0500000000',
            'role' => 'ADMIN',
        ]);

        // Create test client
        User::create([
            'username' => 'client1',
            'password' => Hash::make('123456'),
            'nom' => 'ALAMI',
            'prenom' => 'Mohammed',
            'email' => 'client1@mail.com',
            'tel' => '0600000000',
            'role' => 'USER',
        ]);

        // Seed voyages
        $this->call(VoyageSeeder::class);

        // Seed cities
        $this->call(CitySeeder::class);
    }
}

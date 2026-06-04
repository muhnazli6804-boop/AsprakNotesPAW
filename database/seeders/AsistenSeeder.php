<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AsistenSeeder extends Seeder
{
    public function run(): void
    {
        $asistenList = [
            ['name' => 'Sarah', 'email' => 'Sarah@aspraknotes.com'],
            ['name' => 'Panji', 'email' => 'Panji@aspraknotes.com'],
            ['name' => 'Zidan', 'email' => 'Zidan@aspraknotes.com'],
        ];

        foreach ($asistenList as $asisten) {
            User::firstOrCreate(
                ['email' => $asisten['email']],
                [
                    'name' => $asisten['name'],
                    'password' => Hash::make('asisten123'),
                    'role' => 'asprak',
                ]
            );
        }
    }
}

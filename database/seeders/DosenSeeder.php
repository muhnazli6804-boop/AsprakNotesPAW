<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $dosenList = [
            ['name' => 'Nazli', 'email' => 'Nazli@aspraknotes.com'],
            ['name' => 'Reza', 'email' => 'Reza@aspraknotes.com'],
        ];

        foreach ($dosenList as $dosen) {
            User::firstOrCreate(
                ['email' => $dosen['email']],
                [
                    'name' => $dosen['name'],
                    'password' => Hash::make('dosen123'),
                    'role' => 'admin',
                ]
            );
        }
    }
}

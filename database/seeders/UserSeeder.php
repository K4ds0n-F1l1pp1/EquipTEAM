<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'master@equipteam.com'],
            [
                'name' => 'Usuário Master',
                'password' => Hash::make('sim1234'), // Senha padrão
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipamentos;

class EquipamentoSeeder extends Seeder
{
    public function run(): void
    {
        Equipamentos::create([
            'nome' => 'Multímetro Digital',
            'numero_serie' => 'SER12345',
            'valor_diaria' => 45.00,
            'status' => 'disponivel',
        ]);

        Equipamentos::create([
            'nome' => 'Osciloscópio Portátil',
            'numero_serie' => 'SER98765',
            'valor_diaria' => 120.00,
            'status' => 'alugado',
        ]);

        Equipamentos::create([
            'nome' => 'Gerador de Sinais',
            'numero_serie' => 'SER54321',
            'valor_diaria' => 85.00,
            'status' => 'disponivel',
        ]);
    }
}
